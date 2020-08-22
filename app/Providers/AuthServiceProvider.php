<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use Laravel\Passport\Passport;

use Socialite;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Passport::routes();

        // Passport::loadKeysFrom('/secret-keys/oauth');

        Passport::personalAccessClientId(
            config('passport.personal_access_client.id')
        );

        Passport::personalAccessClientSecret(
            config('passport.personal_access_client.secret')
        );

        Gate::define('is-admin', function($user)
        {
            return $user->hasRole('admin');
        });

        Gate::define('is-designer', function($user){
            return $user->hasRole('designer');
        });

        Gate::define('manage-users', function($user)
        {
            return $user->hasRole('admin');
        });

        Gate::define('edit-users', function($user)
        {
            return $user->hasRole('admin');
        });

        Gate::define('delete-users', function($user)
        {
            return $user->hasRole('admin');
        });

        Gate::define('add-droids', function($user)
        {
            return $user->hasRole('admin');
        });

        Gate::define('edit-droids', function($user)
        {
            return $user->hasRole('admin');
        });

        Gate::define('delete-droids', function($user)
        {
            return $user->hasRole('admin');
        });
    }
}
