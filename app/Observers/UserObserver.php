<?php

namespace App\Observers;

use App\Models\User;
use App\Traits\FileUpload;

class UserObserver
{
    use FileUpload;

    public function saved(User $user)
    {
        if (request()->has('image')) {
            $meta = $this->uploadImage(request()->file('image'), 'public/users');
            $this->saveToDB($user, $meta);
        }
    }
}
