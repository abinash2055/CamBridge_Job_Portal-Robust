<?php

namespace App\Mail;

use App\Models\Post;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ApplicationStatus extends Mailable
{
    use Queueable, SerializesModels;

    public $status;
    public $jobPost;

    public function __construct($status, Post $jobPost)
    {
        $this->status = $status;
        $this->jobPost = $jobPost;
    }

    public function build()
    {
        if ($this->status == 'shortlisted') {
            return $this->view('emails.emailShortListed')
                ->with(['jobPost' => $this->jobPost]);
        }

        return $this->view('emails.emailRejected')
            ->with(['jobPost' => $this->jobPost]);
    }
}
