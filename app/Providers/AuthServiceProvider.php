<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use App\Models\User;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array<class-string, class-string>
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

        // Gate::define('admin', function (User $user) {
        //     return $user->is_admin;
        // });
        // Gate::define('admin', function(User $user){
        //     return $user->email === 'rianseptiangandi25372@gmail.com';
        // });       

        // startdefinisi lama
        // Gate untuk melihat data (dapat diakses oleh semua peran)
        Gate::define('view', function (User $user) {
            return in_array($user->jabatan, ['admin', 'sarana', 'kaprog', 'toolman']);
        });

        Gate::define('action', function (User $user) {
            return in_array($user->jabatan, ['admin', 'sarana', 'kaprog']);
        });

        Gate::define('import-excel', function (User $user) {
            return in_array($user->jabatan,  ['admin', 'sarana', 'kaprog']);
        });

        Gate::define('changepass-user', function (User $user) {
            return in_array($user->jabatan, ['admin', 'sarana', 'kaprog', 'toolman']);
        });
        //end

        Gate::define('isAdmin', function ($user) {
            return $user->jabatan == 'admin';
        });

        // Gate::define('isSarana', function ($user) {
        //     return $user->jabatan == 'sarana';
        // });

        // Gate::define('isKaprog', function ($user) {
        //     return $user->jabatan == 'kaprog';
        // });

        // Gate::define('isToolman', function ($user) {
        //     return $user->jabatan == 'toolman';
        // });
    }
}
