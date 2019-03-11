<?php

namespace App\Providers;

use Carbon\Carbon;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Laravel\Passport\Passport;
use Laravel\Passport\RouteRegistrar;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
//        UserOld::class => UserPolicy::class
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {

        $this->registerPolicies();

        Passport::tokensExpireIn(Carbon::now()->addDays(30));
        Passport::refreshTokensExpireIn(Carbon::now()->addDays(35));
        Passport::personalAccessTokensExpireIn(Carbon::now()->addDays(30));

        Passport::routes(function (RouteRegistrar $routeRegistrar) {
            $routeRegistrar->forAccessTokens();
            $routeRegistrar->forTransientTokens();
        }, [
            'prefix' => 'api/mobile/v1'
        ]);

    }
}
