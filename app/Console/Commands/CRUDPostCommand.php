<?php

namespace App\Console\Commands;

use App\Models\Post;
use App\Models\User;
use Illuminate\Console\Attributes\Description;
use Illuminate\Console\Attributes\Signature;
use Illuminate\Console\Command;

#[Signature('post:crud {userId}')]
#[Description('Command description')]
class CRUDPostCommand extends Command
{
    /**
     * Execute the console command.
     */
    public function handle()
    {
        $user = User::findOrFail($this->argument('userId'));

        $user->posts()->save(new Post(['title' => 'New Post']));
        $this->info('Created new post');
        sleep(1);

        $post = $user->posts()->latest()->first();
        $this->info('Retrived new post');
        sleep(1);

        $post->update(['title' => 'Old Post']);
        $this->info('Updated new post to old post');
        sleep(1);

        $post->delete();
        $this->info('Deleted post');
    }
}
