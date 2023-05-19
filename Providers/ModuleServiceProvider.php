<?php

namespace Modules\Like\Providers;

use Konekt\Concord\BaseModuleServiceProvider;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Schema;

class ModuleServiceProvider extends BaseModuleServiceProvider
{
    /**
     * The namespace for the module's models.
     *
     * @var string
     */
    protected $modelNamespace = 'Modules\Like\Models';

    /**
     * Bootstrap the module services.
     *
     * @return void
     */
    public function boot()
    {
        // Your module's boot logic here
        $this->app->register(RouteServiceProvider::class);
        $this->app->register(GateServiceProvider::class);
        $this->app->register(PluginServiceProvider::class);
        $this->ViewPaths();
        $this->adminViewPaths();
    }

    /**
     * Register the module services.
     *
     * @return void
     */
    public function register()
    {
        // Your module's register logic here
    }
    
    public function ViewPaths() {
        $moduleLower = lcfirst('Like');
        if (Schema::hasTable('settings')) {
            $setting = DB::table('settings')->where('id', 'site.theme')->first();
            $currentTheme = $setting->value;
        } else {
            $currentTheme = 'default';
        }
        $views = [
            base_path("themes/$currentTheme/views/modules/Like"),
            module_Viewpath('Like', $currentTheme),
            base_path("themes/default/views/modules/Like"),
            module_Viewpath('Like', 'default'),
            base_path("resources/views/modules/Like"),
        ];

        return $this->loadViewsFrom($views, $moduleLower);
    }

    public function adminViewPaths() {
        $moduleLower = lcfirst('Like');
        $currentTheme = 'admin';
        $views = [
            module_Viewpath('Like', $currentTheme),
            base_path("themes/$currentTheme/views/modules/Like"),
        ];

        return $this->loadViewsFrom($views, $moduleLower.'-admin');
    }
}

