<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\SiteSettings;
use App\Models\EmailSettings;
use App\Models\Fees;
use Schema;
use Config;
use View;

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
            ["route" => 'admin.dashboard', "value" => "Dashboard", "icon" => "fas fa-home"],
            ["route" => 'admin.invoice', "value" => "Invoice", "icon" => "fas fa-home"],
            ["route" => 'admin.agencies', "value" => "Agencies", "icon" => "fas fa-home"],
            ["route" => 'admin.customers', "value" => "Customers", "icon" => "fas fa-home"],
            ["route" => 'admin.reports', "value" => "Reports", "icon" => "fas fa-home"],
            ["route" => 'admin.fees', "value" => "Fees Settings", "icon" => "fas fa-home"],
            ["route" => 'admin.email_settings', "value" => "Email Settings", "icon" => "fas fa-home"],
            ["route" => 'admin.site_settings', "value" => "Site Settings", "icon" => "fas fa-home"],
        );

        View::share('menu_data', $menu_data);
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
