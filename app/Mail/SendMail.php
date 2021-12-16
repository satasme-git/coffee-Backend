<?php
 
namespace App\Mail;
 
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
 
class SendMail extends Mailable
{
    use Queueable, SerializesModels;
 
    	public $userData;
  
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($userData='')
    {
        $this->userData = $userData;
    }
    
    public function build()
    {
        // return $this->view('email.message');
        return $this->subject('Forgot Password')
            ->view('email.message')
            ->from('info@boxesfree.shop');
    }
}
