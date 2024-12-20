<?php

namespace App\Mail;

use App\Models\User;
use App\Models\Post;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ApplicationStatus extends Mailable
{
    use Queueable, SerializesModels;

    public $user;
    public $post;
    public $status;

    /**
     * Create a new message instance.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Post  $post
     * @param  string  $status
     * @return void
     */
    public function __construct(User $user, Post $post, $status)
    {
        $this->user = $user;
        $this->post = $post;
        $this->status = $status;
    }

    /**
     * Build the message.
     *
     * @return \Illuminate\Mail\Mailable
     */
    public function build()
    {
        $view = ($this->status == 'shortlisted')
            ? 'emails.emailShortListed'
            : 'emails.emailRejected';

        return $this->subject('Application Status Update')
            ->view($view);
    }
}
