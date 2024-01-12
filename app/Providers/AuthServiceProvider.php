<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use App\Models\Permission;
use App\Models\User;
class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        //
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        Gate::define('update-post', function (User $user, Article $course) {
            return $user === $course->user_id;
        });


        // Gate::define('show-comment', function (User $user) {
        //     return $user->hasRole(Permissioin::whereName('show-comment')->first()->roles);
        // });
   
            $this->registerPolicies();
    
            foreach ($this->getPermissions() as $permission) {
                Gate::define($permission->name , function ($user) use($permission){
                    return $user->hasRole($permission->roles);
                });
            }
    
        }
    
        protected function getPermissions()
        {
            return Permission::with('roles')->get();
        }


    
}