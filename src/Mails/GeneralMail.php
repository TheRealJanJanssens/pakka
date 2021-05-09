<?php

namespace TheRealJanJanssens\Pakka\Mails;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class GeneralMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($data = null)
    {
		$exclude = array('_method','_token');
		$subjectSearch = array('subject','onderwerp');
		
		if( isset( $data['replyTo'] ) ){
			$this->replyTo($data['replyTo']);
			unset( $data['replyTo'] );
		}
		
		foreach($data as $key => $value){
			if(!contains($key,$exclude)){
				$result[$key] = $value;
			}
			
			if(contains($key,$subjectSearch)){
				$this->subject($value);
			}
		}

    $this->subject(trans('mail.contact_submission')." - ".array_values($result)[0]);

		$this->data = $result;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {	    
	    return $this->markdown('pakka::emails.general')->with('data', $this->data);
    }
}
