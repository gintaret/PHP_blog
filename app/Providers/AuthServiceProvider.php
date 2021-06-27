<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::define('update',function($user, $post){
            return $user->id === $post->user_id; //kai prisijungusio userio id atitinka posto userio id, tuomet leidziame redaguoti posta (kai useris yra posto savininkas)
        });

        Gate::define('delete',function($user, $post){
            return $user->id === $post->user_id;
        });
    }
}
