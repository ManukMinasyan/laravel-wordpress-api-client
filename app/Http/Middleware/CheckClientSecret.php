<?php

namespace App\Http\Middleware;

use App\Models\OauthClient;
use Closure;
use Illuminate\Validation\Rule;

class CheckClientSecret
{
    /**
     * Handle an incoming request.
     * @param $request
     * @param Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $request->validate([
            'client_id' => 'required|int',
            'client_secret' => [
                'required',
                Rule::in([OauthClient::findOrFail($request->client_id)->secret])
            ]
        ]);

        return $next($request);
    }
}
