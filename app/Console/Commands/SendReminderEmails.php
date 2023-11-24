<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Borrow;
use Illuminate\Support\Facades\Mail;

class SendReminderEmails extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'reminder:emails';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send reminder emails to users two days before book return due date';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        // Fetch borrowed books where the return due date is two days ahead
        $borrowedBooks = Borrow::whereDate('due_date', now()->addDays(2))->get();

        foreach ($borrowedBooks as $borrow) {
            // Send an email reminder to each user
            $user = $borrow->user;
            $bookTitle = $borrow->book->title;

            Mail::send('emails.reminder', ['user' => $user, 'bookTitle' => $bookTitle], function ($message) use ($user) {
                $message->to($user->email)->subject('Reminder: Return Book');
            });
        }

        $this->info('Reminder emails sent successfully!');
    }
}
