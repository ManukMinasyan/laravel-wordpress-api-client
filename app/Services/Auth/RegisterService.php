<?php

namespace App\Services\Auth;

use App\Models\UserOld;
use App\Models\WordPress\UserWordPress;
use App\Traits\PassportToken;

/**
 * Class RegisterService
 * @package App\Services\Auth
 */
class RegisterService
{
    /**
     * Create new user in system
     *
     * @param array $request
     *
     * @return UserOld
     */
    public function register(array $request)
    {
        $wordpressUser = UserWordPress::query()->create([
            'user_login' => $request['email'],
            'user_email' => $request['email'],
            'user_pass' => $request['password']
        ]);

        $wordpressUser->saveMeta('phone_number',$request['phone']);

        return UserOld::query()->findOrFail($wordpressUser->getAuthIdentifier());
    }

}