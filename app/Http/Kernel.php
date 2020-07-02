<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Http;

use Illuminate\Foundation\Http\Kernel as HttpKernel;

class Kernel extends HttpKernel
{
    /**
     * The application's global HTTP middleware stack.
     *
     * @var array
     */
    protected $middleware = [
        Middleware\DatadogMetrics::class,
    ];

    protected $middlewareGroups = [
        'api' => [
            Middleware\DisableSessionCookiesForAPI::class,
            Middleware\StartSession::class,
            Middleware\AuthApi::class,
            Middleware\SetLocale::class,
            Middleware\CheckUserBanStatus::class,
        ],
        'web' => [
            Middleware\StripCookies::class,
            Middleware\EncryptCookies::class,
            \Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse::class,
            Middleware\StartSession::class,
            \Illuminate\View\Middleware\ShareErrorsFromSession::class,
            Middleware\VerifyCsrfToken::class,
            Middleware\SetLocale::class,
            Middleware\AutologinFromLegacyCookie::class,
            Middleware\UpdateUserLastvisit::class,
            Middleware\VerifyUserAlways::class,
            Middleware\CheckUserBanStatus::class,
            Middleware\TurbolinksSupport::class,
        ],
        'lio' => [
            Middleware\LegacyInterOpAuth::class,
        ],
    ];

    /**
     * The application's route middleware.
     *
     * @var array
     */
    protected $routeMiddleware = [
        'auth' => \Illuminate\Auth\Middleware\Authenticate::class,
        'auth.basic' => \Illuminate\Auth\Middleware\AuthenticateWithBasicAuth::class,
        'check-user-restricted' => Middleware\CheckUserRestricted::class,
        'guest' => Middleware\RedirectIfAuthenticated::class,
        'require-scopes' => Middleware\RequireScopes::class,
        'throttle' => \Illuminate\Routing\Middleware\ThrottleRequests::class,
        'verify-user' => Middleware\VerifyUser::class,
    ];
}
