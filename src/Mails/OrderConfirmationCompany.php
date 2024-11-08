<?php

namespace TheRealJanJanssens\Pakka\Mails;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class OrderConfirmationCompany extends Mailable
{
    use Queueable;
    use SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($data = null)
    {
        $exclude = ['_method','_token'];
        $subjectSearch = ['subject','onderwerp'];

        if (isset($data['replyTo'])) {
            $this->replyTo($data['replyTo']);
            unset($data['replyTo']);
        }

        $this->subject(trans('pakka::mail.new_order', ['order_number' => $data['name']]));

        foreach ($data as $key => $value) {
            if (! contains($key, $exclude)) {
                $result[$key] = $value;
            }

            if (contains($key, $subjectSearch)) {
                $this->subject($value);
            }
        }

        $this->data = $result;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('pakka::emails.order.confirmation.company')->with('data', $this->data);
    }
}
