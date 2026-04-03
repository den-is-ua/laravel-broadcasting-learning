<?php

namespace App\Console\Commands;

use App\Events\CreatedPrivate;
use Illuminate\Console\Attributes\Description;
use Illuminate\Console\Attributes\Signature;
use Illuminate\Console\Command;

#[Signature('fire:private {userId} {status}')]
#[Description('Command description')]
class FirePrivate extends Command
{
    /**
     * Execute the console command.
     */
    public function handle()
    {
        CreatedPrivate::dispatch(
            $this->argument('userId'),
            $this->argument('status')
        );
    }
}
