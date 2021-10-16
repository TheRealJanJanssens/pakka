<?php

namespace TheRealJanJanssens\Pakka\Http\Controllers;

use App\Http\Controllers\Controller;
//querybuilder used in sort
use Cart;
use Illuminate\Http\Request;

use Mollie\Laravel\Facades\Mollie;

use Session;
use TheRealJanJanssens\Pakka\Models\CartService;
use TheRealJanJanssens\Pakka\Models\Coupon;
use TheRealJanJanssens\Pakka\Models\Order;
use TheRealJanJanssens\Pakka\Models\OrderPayment;
use TheRealJanJanssens\Pakka\Models\Product;
use TheRealJanJanssens\Pakka\Models\ShipmentOption;
use TheRealJanJanssens\Pakka\Models\Stock;
use TheRealJanJanssens\Pakka\Models\User;

use TheRealJanJanssens\Pakka\Models\UserDetail;

class CartController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(Request $request)
    {
        constructGlobVars();
    }

    public function store(Request $request)
    {
        $post = $request->all();
        $product = Product::getProductBySKU($post['sku']);

        if ($product) {
            //prevents already set items to pass there stock quantity
            if (\Cart::get($product['sku']) == null || \Cart::get($product['sku'])->quantity < $product['quantity']) {
                \Cart::add([
                    'id' => $product['sku'],
                    'name' => $product['name'],
                    //'price' => getExclAmount($product['price']), //Excl amount
                    'price' => $product['price'], //Incl amount
                    'quantity' => 1,
                    'weight' => $product['weight'],
                    'attributes' => $product,
                    'associatedModel' => "product",
                ]);
            }
        }
    }

    public function update(Request $request)
    {
        $post = $request->all();
        $product = Product::getProductBySKU($post['sku']);

        //safety in case stock quantity live updated
        if ($product['quantity'] < $post['value']) {
            $quantity = $product['quantity'];
        } else {
            $quantity = $post['value'];
        }

        if ($product) {
            Cart::update($product['sku'], [
                'price' => $product['price'], //makes sure live price is always present
                'quantity' => [
                    'relative' => false,
                    'value' => $quantity,
                ],
                'weight' => $product['weight'],
                'attributes' => $product, //makes sure live attributes is always present
            ]);
        }
    }

    public function destroy(Request $request)
    {
        $post = $request->all();
        $product = Product::getProductBySKU($post['sku']);
        //session($userID)->
        if ($product) {
            Cart::remove($product['sku']);
        }
    }

    public function clear(Request $request)
    {
        Cart::clear();
    }

    public function redeemCoupon(Request $request)
    {
        $coupon = Coupon::redeem($request->value);
        if ($coupon) {
            if ($coupon['is_fixed'] == 1) {
                $discount = "-".$coupon['discount'];
            } else {
                $discount = "-".$coupon['discount']."%";
            }

            $condition = new \Darryldecode\Cart\CartCondition([
                'name' => 'COUPON',
                'type' => 'coupon',
                'target' => 'total', // this condition will be applied to cart's subtotal when getSubTotal() is called.
                'value' => $discount,
                'attributes' => $coupon,
            ]);

            Cart::condition($condition);

            return true;
        } else {
            return false;
        }
    }

    public function revokeCoupon(Request $request)
    {
        Cart::removeCartCondition("COUPON");
    }

    public function setRegion(Request $request)
    {
        Session::put('checkout.details.country', $request->value);
    }

    public function setDelivery(Request $request)
    {
        $shipment = ShipmentOption::getShipment($request->value);

        $condition = new \Darryldecode\Cart\CartCondition([
            'name' => 'SHIPPING',
            'type' => 'shipping',
            'target' => 'total', // this condition will be applied to cart's subtotal when getSubTotal() is called.
            'value' => $shipment['price'],
            'attributes' => $shipment,
        ]);

        Cart::condition($condition);

        Session::put('checkout.helpers.set_delivery_option', $shipment['id']);
        Session::put('checkout.helpers.preferred_delivery_method', $shipment['delivery']);
    }

    public function setService(Request $request)
    {
        $service = CartService::getCartService($request->value);

        $condition = new \Darryldecode\Cart\CartCondition([
            'name' => 'SERVICE '.$service['id'],
            'type' => 'service',
            'target' => 'total', // this condition will be applied to cart's subtotal when getSubTotal() is called.
            'value' => $service['price'],
            'attributes' => $service,
        ]);

        Cart::condition($condition);
    }

    public function removeService(Request $request)
    {
        Cart::removeCartCondition('SERVICE '.$request->value);
    }

    public function checkVat(Request $request)
    {
        //https://controleerbtwnummer.eu/api
        $vat_number = 'BE 0123 456 789';
        $vat_number = str_replace([' ', '.', '-', ',', ', '], '', trim($vat_number));

        $contents = @file_get_contents('https://controleerbtwnummer.eu/api/validate/'.$vat_number.'.json');
        if ($contents === false) {
            throw new Exception('service unavailable');
        } else {
            $res = json_decode($contents);

            if ($res->valid) {
                //vat number is valid
            } else {
                //vat number is not valid
            }
            var_dump($res);
        }
    }

    public function submit(Request $request)
    {
        $array = $request->all();
        //dd($array);
        if (! isset($array['password'])) {
            $password = generateString(20);
            $request->request->add(['password' => $password, 'password_confirmation' => $password]);
        }

        //create user
        $request->request->add([
            'name' => $array['firstname'].' '.$array['lastname'],
            'role' => 1,
        ]);
        //don't need validation because it happens in line below
        $user = User::firstOrCreate(["email" => $array['email']], $request->all());

        //creating user details
        $request->request->add([
            'user_id' => $user->id,
            'address' => $array['street'].' '.$array['apt'],
        ]);
        //don't need validation because it happens in line below
        UserDetail::updateOrCreate(["user_id" => $user->id], $request->all());

        $order = Order::prepare($request->all());

        //check if payment isset
        if (isset($array['payment_method'])) {
            $method = $array['payment_method'];
        } else {
            $method = null;
        }

        $payment = Mollie::api()->payments->create([
            "amount" => [
                "currency" => "EUR",
                "value" => sprintf("%.2f", Cart::getTotal()),
            ],
            "method" => $method,
            "description" => "Order ".$order->name,
            "redirectUrl" => url("/".session()->get('settings.role_order_confirmation')."/".$order->id."/".$user->id),
            "webhookUrl" => url('/cart/webhook/mollie'),
            // "redirectUrl" => "https://janjanssens.be",
            // "webhookUrl" => "https://janjanssens.be",
            "metadata" => [
                "order_id" => $order->id,
            ],
        ]);

        OrderPayment::create([
            'order_id' => $order->id,
            'payment_id' => $payment->id,
            'provider' => 'mollie',
            'amount' => Cart::getTotal(),
            'method' => $method,
        ]);

        $payment = Mollie::api()->payments->get($payment->id);

        // redirect customer to Mollie checkout page
        return redirect($payment->getCheckoutUrl(), 303);
    }

    public function webhookMollie(Request $request)
    {
        if (! $request->has('id')) {
            return;
        }
        $payment = Mollie::api()->payments()->get($request->id);

        switch ($payment->status) {
            case "open":
                $status = 0;

                break;
            case "paid":
                $status = 1;

                break;
            case "failed":
                $status = 2;

                break;
            case "canceled":
                $status = 3;

                break;
            case "expired":
                $status = 4;

                break;
        }

        if ($payment->isPaid()) {
            Order::confirm($payment->metadata->order_id);
        } else {
            Order::cancel($payment->metadata->order_id);
        }
    }

    public function webhookTest($id)
    {
        $payment = Mollie::api()->payments()->get($id);

        switch ($payment->status) {
            case "open":
                $status = 0;

                break;
            case "paid":
                $status = 1;

                break;
            case "failed":
                $status = 2;

                break;
            case "canceled":
                $status = 3;

                break;
            case "expired":
                $status = 4;

                break;
        }

        if ($payment->isPaid()) {
            Order::confirm($payment->metadata->order_id);
        } else {
            Order::cancel($payment->metadata->order_id);
        }
    }

    public function resendmailTest($id)
    {
        Order::resendConfirmationMail($id);
    }
}
