<?php

use TheRealJanJanssens\Pakka\Models\Menu;
use TheRealJanJanssens\Pakka\Models\Page;

use TheRealJanJanssens\Pakka\Http\Controllers\UserController;
use TheRealJanJanssens\Pakka\Http\Controllers\MenuController;
use TheRealJanJanssens\Pakka\Http\Controllers\ItemController;
use TheRealJanJanssens\Pakka\Http\Controllers\CartController;
use TheRealJanJanssens\Pakka\Http\Controllers\FormController;
use TheRealJanJanssens\Pakka\Http\Controllers\InputController;
use TheRealJanJanssens\Pakka\Http\Controllers\OrderController;
use TheRealJanJanssens\Pakka\Http\Controllers\ImageController;
use TheRealJanJanssens\Pakka\Http\Controllers\ClientController;
use TheRealJanJanssens\Pakka\Http\Controllers\CouponController;
use TheRealJanJanssens\Pakka\Http\Controllers\WebsiteController;
use TheRealJanJanssens\Pakka\Http\Controllers\ProjectController;
use TheRealJanJanssens\Pakka\Http\Controllers\ContentController;
use TheRealJanJanssens\Pakka\Http\Controllers\ProductController;
use TheRealJanJanssens\Pakka\Http\Controllers\BookingController;
use TheRealJanJanssens\Pakka\Http\Controllers\SettingController;
use TheRealJanJanssens\Pakka\Http\Controllers\InvoiceController;
use TheRealJanJanssens\Pakka\Http\Controllers\TemplateController;
use TheRealJanJanssens\Pakka\Http\Controllers\ShipmentController;
use TheRealJanJanssens\Pakka\Http\Controllers\ServicesController;
use TheRealJanJanssens\Pakka\Http\Controllers\DashboardController;
use TheRealJanJanssens\Pakka\Http\Controllers\ProvidersController;
use TheRealJanJanssens\Pakka\Http\Controllers\Auth\LoginController;
use TheRealJanJanssens\Pakka\Http\Controllers\CollectionController;
use TheRealJanJanssens\Pakka\Http\Controllers\CartServiceController;
use TheRealJanJanssens\Pakka\Http\Controllers\InvoicePresetController;
use TheRealJanJanssens\Pakka\Http\Controllers\Auth\ForgotPasswordController;

// :resource sets up some default routes any other has to be manually registerd. Check above examples
// If you want to check all registerd routes go to terminal and use 'php artisan route:list' sometime you first need to clear the cache 'php artisan route:clear'
/*
	Verb          Path                        Action  Route Name
	GET           /users                      index   users.index
	GET           /users/create               create  users.create
	POST          /users                      store   users.store
	GET           /users/{user}               show    users.show
	GET           /users/{user}/edit          edit    users.edit
	PUT|PATCH     /users/{user}               update  users.update
	DELETE        /users/{user}               destroy users.destroy
*/

/*
|------------------------------------------------------------------------------------
| Admin acces
|------------------------------------------------------------------------------------
*/

// ::group is used to put all routes inside it in an sort of authenticated container therefor we have a admin acces and user acces here
Route::group([
    'prefix' => config('pakka.prefix.admin'), 
    'as' => config('pakka.prefix.admin') . '.', 
    //'namespace' => "TheRealJanJanssens\Pakka\Http\Controllers", 
    'middleware'=> ['web', 'auth', 'Role:10']
    ], function () {
	
	//Route::auth();
    
    Route::resource('users', UserController::class);
    Route::resource('templates', TemplateController::class);

    //Templates
    Route::get('templates/{id}/download', [TemplateController::class, "download"])->name('templates.download');
    
    //INPUT
    Route::get('inputs/{setId}', [InputController::class, "index"])->name('inputs.index');
    
    Route::get('inputs/{setId}/create', [InputController::class, "create"])->name('inputs.create');
    Route::post('inputs/store', [InputController::class, "store"]);
    
    Route::get('inputs/{setId}/{id}/edit', [InputController::class, "edit"])->name('inputs.edit');
    Route::match(['put', 'patch'],'inputs/{id}/update', [InputController::class, "update"]);
    
    Route::delete('inputs/{id}/destroy', [InputController::class, "destroy"])->name('inputs.destroyinput');
    Route::delete('inputs/{id}/destroy/option', [InputController::class, "destroyOption"])->name('inputs.destroyinputoption');
    
    Route::post('inputs/sort', [InputController::class, "sortInputs"]);
});

/*
|------------------------------------------------------------------------------------
| User acces
|------------------------------------------------------------------------------------
*/
Route::group([
    'prefix' => config('pakka.prefix.admin'), 
    'as' => config('pakka.prefix.admin') . '.', 
    //'namespace' => "TheRealJanJanssens\Pakka\Http\Controllers", 
    'middleware'=> ['web', 'auth', 'Role:5']
    ], function () {
	
	//Route::auth();
	
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard.index');
    
    Route::resources([
        'menu' => MenuController::class,
        'users' => UserController::class,
        'forms' => FormController::class,
        'orders' => OrderController::class,
        'clients' => ClientController::class,
        'coupons' => CouponController::class,
        'bookings' => BookingController::class,
        'invoices' => InvoiceController::class,
        'products' => ProductController::class,
        'services' => ServicesController::class,
        'shipments' => ShipmentController::class,
        'providers' => ProvidersController::class,
        'collections' => CollectionController::class,
        'cart_services' => CartServiceController::class,
        'invoice_presets' => InvoicePresetController::class,
    ]);

    //MENU
    Route::get('menu/create/menu', [MenuController::class, 'createMenu'])->name('menu.createmenu');
    Route::post('menu/store/menu', [MenuController::class, 'storeMenu'])->name('menu.storemenu');
    
    Route::get('menu/{id}/edit/menu', [MenuController::class, 'editMenu'])->name('menu.editmenu');
    Route::match(['put', 'patch'],'menu/{id}/update/menu', [MenuController::class, 'updateMenu']);
    
    Route::delete('menu/{id}/destroy/menu', [MenuController::class, 'destroyMenu'])->name('menu.destroymenu');
    
    Route::get('menu/create/menuitem', [MenuController::class, 'createMenuItem'])->name('menu.createmenuitem');
    Route::post('menu/store/menuitem', [MenuController::class, 'storeMenuItem'])->name('menu.storemenuitem');
    
    Route::get('menu/{id}/edit/menuitem', [MenuController::class, 'editMenuItem'])->name('menu.editmenuitem');
    Route::match(['put', 'patch'],'menu/{id}/update/menuitem', [MenuController::class, 'updateMenuItem']);
    
    Route::delete('menu/{id}/destroy/menuitem', [MenuController::class, 'destroyMenuItem'])->name('menu.destroymenuitem');
    
    Route::post('menu/sort', [MenuController::class, 'sortMenu']);
    
    //ITEMS
    Route::get('items/{moduleId}/list', [ItemController::class, 'index'])->name('items.index');
    
    Route::get('items/{moduleId}/{id}/detail', [ItemController::class, 'show'])->name('items.show');
    
    Route::get('items/{moduleId}/create/item', [ItemController::class, 'createItem'])->name('items.createitem');
    Route::post('items/store/item', [ItemController::class, 'storeItem']);
    
    Route::get('items/{moduleId}/{id}/edit/item', [ItemController::class, 'editItem'])->name('items.edititem');
    Route::match(['put', 'patch'],'items/{id}/update/item', [ItemController::class, 'updateItem']);
    
    Route::delete('items/{id}/destroy/item', [ItemController::class, 'destroyItem'])->name('items.destroyitem');
    Route::get('items/{id}/layoutswitch', [ItemController::class, 'layoutSwitch'])->name('items.layoutswitch');
    
    //PRODUCTS
    Route::get('products/{id}/layoutswitch', [ProductController::class, 'layoutSwitch'])->name('products.layoutswitch');
    
    //CONTENT
    Route::get('content/{id}/edit/content', [ContentController::class, 'editContent'])->name('content.editcontent');
    Route::match(['put', 'patch'],'content/{id}/update/content', [ContentController::class, 'updateContent']);
    
    Route::post('content/{id}/update/section/attributes', [ContentController::class, 'updateSectionAttributes']);
    Route::post('content/update/fields', [ContentController::class, 'updateFields']);
    Route::post('content/{id}/update/images', [ContentController::class, 'updateImages']);

    Route::get('content/{id}/template/generate', [ContentController::class, 'generateTemplate'])->name('content.generatetemplate');
    
    //CLIENTS
    Route::get('clients/{id}/get/info', [ClientController::class, 'getInfo']);
    
    //INVOICES
    Route::get('invoices/{id}/copy/{credit?}/{order?}', [InvoiceController::class, 'copy'])->name('invoices.copy');
    
    //IMAGES
    Route::post('images/store', [ImageController::class, 'storeImage']);
    Route::post('images/order', [ImageController::class, 'orderImage']);
    Route::post('images/rotate', [ImageController::class, 'rotateImage']);
    Route::post('images/destroy', [ImageController::class, 'destroyImage']);
    
    //SETTINGS
    Route::get('settings/', [SettingController::class, 'index'])->name('settings.index');
	
    Route::match(['put', 'patch'],'settings/update', [SettingController::class, 'updateSettings']);
    
    //CONTENT
    Route::get('content/', [ContentController::class, 'index'])->name('content.index');
    
    Route::get('content/create/page', [ContentController::class, 'createPage'])->name('content.createpage');
    Route::post('content/store/page', [ContentController::class, 'storePage']);
    
    Route::get('content/{id}/edit/page', [ContentController::class, 'editPage'])->name('content.editpage');
    Route::match(['put', 'patch'],'content/{id}/update/page', [ContentController::class, 'updatePage']);
    
    Route::get('content/create/section/{page}', [ContentController::class, 'createSection'])->name('content.createsection');
    Route::post('content/store/section', [ContentController::class, 'storeSection']);
    
    Route::get('content/{id}/edit/section/{page}', [ContentController::class, 'editSection'])->name('content.editsection');
    Route::match(['put', 'patch'],'content/{id}/update/section', [ContentController::class, 'updateSection']);
    
    Route::get('content/create/component/{page}/{section}', [ContentController::class, 'createComponent'])->name('content.createcomponent');
    Route::post('content/store/component', [ContentController::class, 'storeComponent']);
    
    Route::get('content/{id}/edit/component/{page}/{section}', [ContentController::class, 'editComponent'])->name('content.editcomponent');
    Route::match(['put', 'patch'],'content/{id}/update/component', [ContentController::class, 'updateComponent']);
    
    Route::delete('content/{id}/destroy/page', [ContentController::class, 'destroyPage'])->name('content.destroypage');
    Route::delete('content/{id}/destroy/section', [ContentController::class, 'destroySection'])->name('content.destroysection');   
    Route::delete('content/{id}/destroy/component', [ContentController::class, 'destroyComponent'])->name('content.destroycomponent');
    
    Route::get('content/load/section/{type}/list', [ContentController::class, 'loadSectionList'])->name('content.sectionlist');
    Route::post('content/insert/section', [ContentController::class, 'insertSection']);
    Route::post('content/order/sections', [ContentController::class, 'orderSections']);
    Route::post('content/status/section', [ContentController::class, 'statusSection']);
    
    //PROJECTS
    Route::get('projects', [ProjectController::class, 'index'])->name('projects.index');
    Route::get('projects/{id}/detail', [ProjectController::class, 'detail'])->name('projects.detail');
    
    Route::get('projects/{id}/task/detail', [ProjectController::class, 'taskDetail'])->name('projects.taskdetail');
    Route::post('projects/store/task', [ProjectController::class, 'storeTask']);
    Route::post('projects/update/task', [ProjectController::class, 'updateTask']);
    Route::post('projects/order/task', [ProjectController::class, 'orderTask']);
    
    Route::post('projects/store/taskgroup', [ProjectController::class, 'storeTaskGroup']);
    Route::post('projects/update/taskgroup', [ProjectController::class, 'updateTaskGroup']);
    Route::post('projects/order/taskgroups', [ProjectController::class, 'orderTaskGroups']);
    
    Route::post('projects/store/comment', [ProjectController::class, 'storeComment']);
    
    //BOOKINGS
    Route::get('bookings/get/json', [BookingController::class, 'getJson']);
	
	//COLLECTIONS
	Route::post('collections/sort', [CollectionController::class, 'sort']);
	
	//ORDER
	Route::get('orders/{id}/mail/order-confirmation', [OrderController::class, 'resendOC']);
	Route::get('orders/{id}/mail/shipment-confirmation', [OrderController::class, 'resendSC']);
	Route::get('orders/{id}/view/packslip', [OrderController::class, 'viewPackslip']);
	Route::get('orders/{id}/download/packslip', [OrderController::class, 'downloadPackslip']);
	
	Route::get('orders/{id}/details/edit', [OrderController::class, 'editDetails']);
	Route::match(['put', 'patch'], 'orders/{id}/details/update', [OrderController::class, 'updateDetails']);
	
	Route::get('orders/{id}/shipment/edit', [OrderController::class, 'editShipment']);
	Route::match(['put', 'patch'], 'orders/{id}/shipment/update', [OrderController::class, 'updateShipment']);
	
	Route::get('orders/{id}/status/retour', [OrderController::class, 'retour'])->name('orders.retour');
	Route::get('orders/{id}/status/cancel', [OrderController::class, 'cancel'])->name('orders.cancel');
	
});

Route::group([
    'middleware' => ['web'],
    //'namespace' => "TheRealJanJanssens\Pakka\Http\Controllers", 
    ], function () {
	//CLI COMMANDS
/*
	Route::get('/clear-cache', function() {
	    $exitCode = Artisan::call('cache:clear');
	    return '<h1>Cache facade value cleared</h1>';
	});
*/
	
	//AUTH
	Route::get("logout", [LoginController::class, 'logout'])->name('logout');
    Route::get("login", [LoginController::class, 'showLoginForm'])->name('login');
    Route::post("login", [LoginController::class, 'login']);

    Route::post('password/email', [
        'as' => 'password.email',
        'uses' => [ForgotPasswordController::class, 'sendResetLinkEmail']
    ]);
    Route::get('password/reset', [
        'as' => 'password.request',
        'uses' => [ForgotPasswordController::class, 'showLinkRequestForm']
    ]);
    Route::post('password/reset', [
        'as' => 'password.update',
        'uses' => [ForgotPasswordController::class, 'reset']
    ]);
    Route::get('password/reset/{token}', [
        'as' => 'password.reset',
        'uses' => [ForgotPasswordController::class, 'howResetForm']
    ]);

	//Auth::routes(['register' => false]); //disables the register option
    
	//INVOICES
	Route::get('view/invoice/{id}', [InvoiceController::class, 'viewInvoice']);
	Route::get('download/invoice/{id}', [InvoiceController::class, 'downloadInvoice']);
	
	//ACTIONS
	Route::post('actions/mail/general/{ajax?}', [WebsiteController::class, 'sendMail']);
	
	//CART ACTIONS
	Route::post('cart/store', [CartController::class, 'store']);
	Route::post('cart/update', [CartController::class, 'update']);
	Route::post('cart/destroy', [CartController::class, 'destroy']);
	Route::post('cart/clear', [CartController::class, 'clear']);
	Route::post('cart/redeem-coupon', [CartController::class, 'redeemCoupon']);
	Route::post('cart/revoke-coupon', [CartController::class, 'revokeCoupon']);
	Route::post('cart/set-region', [CartController::class, 'setRegion']);
	Route::post('cart/set-delivery', [CartController::class, 'setDelivery']);
	Route::post('cart/set-service', [CartController::class, 'setService']);
	Route::post('cart/remove-service', [CartController::class, 'removeService']);
	Route::post('cart/submit', [CartController::class, 'submit']);
	Route::post('cart/webhook/mollie', [CartController::class, 'webhookMollie']);
	
/*
	Route::get('cart/webhook/test', 'CartController@webhookTest');
	Route::get('cart/resendmail/test', 'CartController@resendmailTest');
*/

    if(DB::connection()->getDatabaseName() && Schema::hasTable('languages')){
        $routes = Menu::generateRoutes();
        //dd($routes);
        foreach($routes as $route){
            //Fallback for when pages have no positions
            if(!Route::has("page.index") && !isset($route["slugs"]["page.index"])){
                $route["slugs"]["page.index"] = "/";
              }

            foreach($route["slugs"] as $as => $slug){
                Route::get($slug, [
                    'as' => $as,
                    'uses' => 'TheRealJanJanssens\Pakka\Http\Controllers\WebsiteController@index', 
                    'pageId' => $route['id'], 
                    'template' => $route['template'], 
                    'pageName' => $route['page_uid']
                ]);
            }

            //Fallback for when pages have no positions
            if(!Route::has("page.index")){
                $route["slugs"]["page.index"] = "/";
            }
        }
    }
	
	//Auto generates a storage link if non is present
    try{
        if(!file_exists("/public/storage")) {
            Artisan::call('storage:link');
        }
    }catch(Exception $e){
        //not all servers allow this so this catches the 500 which will be thrown
    }
});

