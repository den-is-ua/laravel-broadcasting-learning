<?php

namespace App\Console\Commands;

use App\Events\CreatedPublic;
use Illuminate\Console\Attributes\Description;
use Illuminate\Console\Attributes\Signature;
use Illuminate\Console\Command;

#[Signature('fire:public {status}')]
class FirePublic extends Command
{
    /**
     * Execute the console command.
     */
    public function handle()
    {
        CreatedPublic::dispatch($this->argument('status'));
    }
}
