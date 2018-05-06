<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use App\Ad;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();
        $this->registerAdPolicies();
    }

    public function registerAdPolicies()
    {
        Gate::define('create-ad', function ($user) {
            return $user->hasAccess(['create-ad']);
        });
        Gate::define('update-ad', function ($user, Ad $ad) {
            return $user->hasAccess(['update-ad']) or $user->id == $ad->user_id;
        });
        Gate::define('publish-ad', function ($user) {
            return $user->hasAccess(['publish-ad']);
        });
        Gate::define('see-all-drafts', function ($user) {
            return $user->inRole('editor');
        });
    }
}
