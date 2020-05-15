<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use Laravel\Passport\Passport;

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

        Passport::tokensCan([
            'admin' => 'Edit/Delete Users primarily',
            'manager' => 'Edit/Create Jobs',
            'engineer' => 'Edit/Create information for job/machine',
            'maintenance' => 'Edit/View Maintenance requests',
            'operator' => 'Basic use of website'
        ]);

        Passport::setDefaultScope([
            'operator'
        ]);

        //
    }
}
