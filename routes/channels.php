<?php

use Illuminate\Support\Facades\Broadcast;
use Illuminate\Support\Facades\Log;

Broadcast::channel('App.Models.User.{id}', function ($user, $id) {
    return $user->id == $id;
});

Broadcast::channel('private', function ($user = null) {
    return true;
});
