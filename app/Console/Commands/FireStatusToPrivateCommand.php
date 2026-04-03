<?php

namespace App\Console\Commands;

use App\Events\CreatedPrivateShare;
use Illuminate\Console\Attributes\Description;
use Illuminate\Console\Attributes\Signature;
use Illuminate\Console\Command;

#[Signature('fire:private-share {status}')]
class FireStatusToPrivateCommand extends Command
{
    /**
     * Execute the console command.
     */
    public function handle()
    {
        CreatedPrivateShare::dispatch($this->argument('status'));
    }
}
