<?php

namespace App\Console\Commands;

use App\Models\User;
use App\Notifications\PrivateBroadcast;
use Illuminate\Console\Attributes\Description;
use Illuminate\Console\Attributes\Signature;
use Illuminate\Console\Command;

#[Signature('fire:notification {userId} {message}')]
class FireNotification extends Command
{
    /**
     * Execute the console command.
     */
    public function handle()
    {
        $user = User::findOrFail($this->argument('userId'));
        $user->notify(new PrivateBroadcast($this->argument('message')));
    }
}
