<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\BroadcastableModelEventOccurred;
use Illuminate\Database\Eloquent\BroadcastsEvents;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

#[Fillable(['title'])]
class Post extends Model
{
    use BroadcastsEvents;

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function broadcastOn(string $event): array
    {
        return match ($event) {
            'created' => [$this, $this->user],
            'updated' => [$this, $this->user],
            default => [],
        };
    }
}
