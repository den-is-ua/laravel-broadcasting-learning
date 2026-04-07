<?php

namespace App\Console\Commands;

use App\Events\CreatedPresense;
use Illuminate\Console\Attributes\Description;
use Illuminate\Console\Attributes\Signature;
use Illuminate\Console\Command;

#[Signature('fire:presense {roomId}')]
class FirePresense extends Command
{
    /**
     * Execute the console command.
     */
    public function handle()
    {
        CreatedPresense::dispatch(
            $this->argument('roomId')
        );
    }
}
