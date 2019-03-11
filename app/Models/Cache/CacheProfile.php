<?php
/**
 * Created by PhpStorm.
 * User: Asus
 * Date: 2/11/2019
 * Time: 2:36 AM
 */

namespace App\Models\Cache;

use Carbon\Carbon;
use DateTime;
use Illuminate\Http\Request;
use Spatie\ResponseCache\CacheProfiles\CacheProfile as PackageCacheProfile;
use Symfony\Component\HttpFoundation\Response;

class CacheProfile implements PackageCacheProfile
{
    /**
     * @param Request $request
     *
     * @return bool
     */
    public function shouldCacheRequest(Request $request): bool
    {
        if ($request->ajax()) {
            return false;
        }

        if ($this->isRunningInConsole()) {
            return false;
        }

        return $request->isMethod('get');
    }

    /**
     * @param Response $response
     *
     * @return bool
     */
    public function shouldCacheResponse(Response $response): bool
    {
        return $response->isSuccessful() || $response->isRedirection();
    }

    /**
     * @param Request $request
     *
     * @return bool
     */
    public function enabled(Request $request): bool
    {
        return config('responsecache.enabled');
    }

    /*
     * Return the time when the cache must be invalided.
     */
    public function cacheRequestUntil(Request $request): DateTime
    {
        return Carbon::now()->addMinutes(
            config('responsecache.cache_lifetime_in_minutes')
        );
    }

    /*
     * Set a string to add to differentiate this request from others.
     */
    public function cacheNameSuffix(Request $request): string
    {
        if (\Auth::check()) {
            return \Auth::user()->ID;
        }

        return '';
    }

    /**
     * @return bool
     */
    public function isRunningInConsole(): bool
    {
        if (app()->environment('testing')) {
            return false;
        }

        return app()->runningInConsole();
    }
}