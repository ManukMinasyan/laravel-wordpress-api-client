<?php

namespace App\Models;

use Corcel\Model\User as Corcel;
use Laravel\Passport\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use App\Services\Auth\PasswordService;

class User extends Corcel
{
    use HasApiTokens, Notifiable;

    public function customMethod() {
        //
    }

    /**
     * Mutator for encrypt password
     * @param $password
     * @return mixed
     */
    public function setUserPassAttribute($password)
    {
        $passwordService = resolve(PasswordService::class);
        $this->attributes['user_pass'] = $passwordService->createHash($password);
    }
}