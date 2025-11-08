<?php 
    
namespace Hexters\Rolevel\Providers;
use Hexters\Rolevel\Helpers\Permission;

use Illuminate\Support\ServiceProvider;

use Gate;
use App\User;

class RolevelServiceProvider extends ServiceProvider {
    
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {

        if(!is_dir(base_path('/resources/views/vendor/rolevel'))) {
            @mkdir(base_path('/resources/views/vendor/rolevel'));
        }

        $this->publishes([
            __DIR__ . '/../Config/rolevel.php' => config_path('rolevel.php'),
            __DIR__ . '/../Migrations/' => database_path('migrations'),
            __DIR__ . '/../Models/' => base_path('/app'),
            __DIR__ . '/../Roles/' => app_path('/Roles'),
            __DIR__ . '/../Views/rolevel' => base_path('/resources/views/vendor/rolevel')
        ], 'rolevel');
        
        $this->mergeConfigFrom(
            __DIR__ . '/../Config/rolevel.php', 'rolevel'
        );

        $this->loadRoutesFrom(__DIR__ . '/../Routes/routes.php');
        $this->loadViewsFrom(__DIR__ . '/../Views/', 'rolevel');

        /**
         * Gate for access permission
         */
        if(file_exists(app_path('/Roles/menu_and_permissions.php'))) {
            $permission = new Permission;
            if(is_array($permission->keys())) {
                foreach($permission->keys() as $key) {
                    Gate::define($key, function(User $user) use ($key) {
                        foreach($user->roles as $role) {
                            return in_array($key, $role->permissions);
                        }
                    });
                }
            }
        }

    }
}