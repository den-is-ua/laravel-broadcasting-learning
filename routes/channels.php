<?php

use App\Models\User;
use Illuminate\Support\Facades\Broadcast;
use Illuminate\Support\Facades\Log;

Broadcast::channel('App.Models.User.{id}', function ($user, $id) {
    return $user->id == $id;
});

Broadcast::channel('private-share', function ($user = null) {
    return true;
});

Broadcast::channel('chat.{roomId}', function ($user, $roomId) {
    Log::debug('Presence', ['user' => $user, 'room' => $roomId]);
    return ['id' => $user->id, 'name' => $user->name];
});
