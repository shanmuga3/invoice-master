<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Collection;
use App\Models\SiteSettings;
use App\Models\EmailSettings;
use App\Models\Fees;
use Schema;
use Config;
use View;
use Lang;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        // Load All helper files
        foreach (glob(app_path() . '/Helpers/*.php') as $file) {
            require_once($file);
        }
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);

        // Set HTTPS everywhere in production
        if (config('app.env') === 'production') {
            // $this->app['request']->server->set('HTTPS', true);
        }

        $this->bindModels();

        $this->shareCommonData();

        $this->registerCollectionMacro();
        $this->registerBladeDirectives();

        if(env('DB_DATABASE') != '') {
            if(Schema::hasTable('site_settings')) {
                $this->bindModels();
            }

            if(Schema::hasTable('email_settings')) {
                $this->setEmailConfig();
            }
        }
    }

    protected function shareCommonData()
    {
        $menu_data = array(
            ["route" => 'admin.dashboard', "value" => Lang::get("admin_messages.dashboard"), "icon" => "fas fa-home"],
            ["route" => 'admin.invoice', "value" => Lang::get("admin_messages.invoice"), "icon" => "fas fa-file-invoice"],
            ["route" => 'admin.agencies', "value" => Lang::get("admin_messages.agencies"), "icon" => "fas fa-id-card"],
            ["route" => 'admin.customers', "value" => Lang::get("admin_messages.customers"), "icon" => "fas fa-users"],
            ["route" => 'admin.reports', "value" => Lang::get("admin_messages.reports"), "icon" => "fas fa-clipboard-list"],
            ["route" => 'admin.fees', "value" => Lang::get("admin_messages.fees"), "icon" => "fas fa-dollar-sign"],
            ["route" => 'admin.email_settings', "value" => Lang::get("Email admin_messages.email_settings"), "icon" => "fas fa-envelope"],
            ["route" => 'admin.site_settings', "value" => Lang::get("Site admin_messages.site_settings"), "icon" => "fas fa-sliders-h"],
        );

        $version = \Str::random(4);

        View::share('menu_data', $menu_data);
        View::share('version', $version);
    }

    // Bind or Singleton common Models
    protected function bindModels()
    {
        $this->app->singleton('site_settings', function() {
            return SiteSettings::get();
        });

        $this->app->singleton('email_settings', function() {
            return EmailSettings::get();
        });

        $this->app->singleton('fees', function() {
            return Fees::get();
        });
    }

    /**
     * Register Collective Form Macro to day,month and year dropdown with attributes
     *
     * @return void
     */
    protected function registerBladeDirectives()
    {
        // Blade Directive to check Permission of current Admin User
        \Blade::if('checkPermission', function($permission) {
            return auth()->guard('admin')->user()->can($permission);
        });

        // Blade Directive to check Given Id is currently login user or not
        \Blade::if('checkUser', function($id) {
            return auth()->id() === $id;
        });
    }

    /**
     * Register Collection Macro to update Append attributes run time
     *
     * @return void
     */
    protected function registerCollectionMacro()
    {
        Collection::macro('setAppends', function ($attributes) {
            return $this->each->setAppends($attributes);
        });
    }

    /**
     * Update Email Configuration
     *
     * @return void
     */
    protected function setEmailConfig()
    {                  
        Config::set([
            'mail.driver'     => email_config('driver'),
            'mail.host'       => email_config('host'),
            'mail.port'       => email_config('port'),
            'mail.from'       => ['address' => email_config('from_address'), 'name' => email_config('from_name')],
            'mail.encryption' => email_config('encryption'),
            'mail.username'   => email_config('username'),
            'mail.password'   => email_config('password'),
        ]);
    }
}
