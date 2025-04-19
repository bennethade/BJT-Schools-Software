<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use Carbon\Carbon;

class SendBirthdayNotifications extends Command
{
    protected $signature = 'send:birthday-notifications';
    protected $description = 'Send birthday notifications to users';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $today = Carbon::today()->format('m-d');
        
        $users = User::whereRaw("DATE_FORMAT(date_of_birth, '%m-%d') = ?", [$today])->get();

        foreach ($users as $user) {
            $this->sendEmail($user);
            $this->sendSms($user);
        }
    }

    protected function sendEmail($user)
    {
        $appName = config('app.name');
        $message = "Happy Birthday, {$user->name} {$user->other_name} {$user->last_name}!
        On this special occasion of your birthday, we at {$appName} wish you a day filled with joy, laughter and success in all your endeavors. Have an amazing year ahead!";
        
        Mail::raw($message, function ($message) use ($user) {
            $message->to($user->email)->subject('Happy Birthday!');
        });
    }


    protected function sendSms($user)
    {
        // Integration with an SMS service like Twilio
        // Example using a hypothetical SmsService class

        // SmsService::send($user->phone, "Happy Birthday, {$user->name}!");
    }
}
