<?php

namespace App\Http\Controllers\Author;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Mail\ApplicationStatus;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;

class AuthorApplicationStatusController extends Controller
{
    public function checkStatus($jobId)
    {
        // Fetch the job post and application status
        $jobPost = Post::find($jobId);

        if ($jobPost) {
            $status = $jobPost->status;

            // Send the email based on status
            if ($status == 'shortlisted') {
                // Send shortlisted email
                Mail::to($jobPost->applicant_email)->send(new ApplicationStatus('shortlisted', $jobPost));
            } elseif ($status == 'rejected') {
                // Send rejected email
                Mail::to($jobPost->applicant_email)->send(new ApplicationStatus('rejected', $jobPost));
            }

            return response()->json(['message' => 'Status updated and email sent']);
        }

        return response()->json(['message' => 'Job not found'], 404);
    }
}
