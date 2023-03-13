<?php



namespace App\Mail;



use Illuminate\Bus\Queueable;

use Illuminate\Contracts\Queue\ShouldQueue;

use Illuminate\Mail\Mailable;

use Illuminate\Queue\SerializesModels;



class ContactMail extends Mailable

{

    use Queueable, SerializesModels;



    /**

     * Create a new message instance.

     *

     * @return void

     */

    private $data;

    public function __construct($data)
    {
        $this->data = $data;
    }



    /**

     * Build the message.

     *

     * @return $this

     */

    public function build()

    {

        return $this->from('no_reply@corespl.com')

        ->subject('Contact Us')

        ->markdown('mail.contact_us')

        ->with('data', $this->data);
        
    }

}

