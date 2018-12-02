<?php
namespace App\Mail;
use App\Models\User;
use Crypt;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class VerifyEmail extends Mailable
{
    use Queueable, SerializesModels;
    private $member;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(User $member)
    {
        $this->member = $member;
    }
    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        // generate link
        $encryptedEmail = Crypt::encrypt($this->member->email);
        // ex: domain.com/verify?token=xxxx
        $link = route('signup.verify', ['token' => $encryptedEmail]);
        return $this->subject('Verify Your Email Address')
            ->with('link', $link)
            ->view('email.signup');
    }
}