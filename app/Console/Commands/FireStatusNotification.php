<?php

namespace App\Console\Commands;

use App\Events\CreatedNotification;
use Illuminate\Console\Attributes\Description;
use Illuminate\Console\Attributes\Signature;
use Illuminate\Console\Command;

#[Signature('fire:status-notification {status}')]
class FireStatusNotification extends Command
{
    /**
     * Execute the console command.
     */
    public function handle()
    {
        CreatedNotification::dispatch($this->argument('status'));
    }
}
