<?php

namespace App\Listeners\Auth;

use App\Events\Auth\AccountCreatedByAdmin;
use App\Events\Auth\AccountUpdatedByAdmin;
use App\Mail\Auth\PleaseActivateYourAccount;
use App\Mail\Auth\YourAccountHasBeenUpdated;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class ActivateAccount
{
    /**
     * Handle the account created by an admin event.
     *
     * @param  AccountCreatedByAdmin  $event
     * @return void
     */
    public function sendAccessCredentials(AccountCreatedByAdmin $event)
    {
        Mail::to($event->user)
            ->send(new PleaseActivateYourAccount($event->user->activationToken, $event->password));
    }

    public function sendUpdatedAccessCredentials(AccountUpdatedByAdmin $event)
    {
        Mail::to($event->email)
            ->send(new YourAccountHasBeenUpdated($event->email, $event->password));
    }
}
