<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Collection;
use App\Models\SiteSettings;
use App\Models\EmailSettings;
use App\Models\TaxTypes;
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

        $this->shareCommonData();

        $this->registerCollectionMacro();
        $this->registerBladeDirectives();

        if(env('DB_DATABASE') != '') {
            if(Schema::hasTable('site_settings')) {
                $this->bindModels();
                
                $site_settings = resolve('site_settings');
                if($site_settings->count() && $site_settings[1]->value == '' && @$_SERVER['HTTP_HOST'] && !\App::runningInConsole()) {
                    $url  = "http://".$_SERVER['HTTP_HOST'];
                    $url .= str_replace(basename($_SERVER['SCRIPT_NAME']),"",$_SERVER['SCRIPT_NAME']);

                    SiteSettings::where('name','site_url')->update(['value' =>  $url]);
                }
                $site_name = $site_settings->where('name','site_name')->first()->value;
                View::share('site_name',$site_name);
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
            ["route" => 'admin.admin_users', "value" => Lang::get("admin_messages.admin_users"), "icon" => "fas fa-users-cog"],
            ["route" => 'admin.invoice', "value" => Lang::get("admin_messages.invoice"), "icon" => "fas fa-file-invoice"],
            // ["route" => 'admin.agencies', "value" => Lang::get("admin_messages.agencies"), "icon" => "fas fa-id-card"],
            ["route" => 'admin.customers', "value" => Lang::get("admin_messages.customers"), "icon" => "fas fa-users"],
            ["route" => 'admin.reports', "value" => Lang::get("admin_messages.reports"), "icon" => "fas fa-clipboard-list"],
            ["route" => 'admin.tax_types', "value" => Lang::get("admin_messages.tax_types"), "icon" => "fas fa-dollar-sign"],
            ["route" => 'admin.email_settings', "value" => Lang::get("admin_messages.email_settings"), "icon" => "fas fa-envelope"],
            ["route" => 'admin.site_settings', "value" => Lang::get("admin_messages.site_settings"), "icon" => "fas fa-sliders-h"],
        );

        $version = \Str::random(4);

        View::share('menu_data', $menu_data);
        View::share('version', $version);
        View::share('currency_symbol', "$");
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

        $this->app->singleton('tax_types', function() {
            return TaxTypes::get();
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
            'mail.driver'     => email_settings('driver'),
            'mail.host'       => email_settings('host'),
            'mail.port'       => email_settings('port'),
            'mail.from'       => ['address' => email_settings('from_address'), 'name' => email_settings('from_name')],
            'mail.encryption' => email_settings('encryption'),
            'mail.username'   => email_settings('username'),
            'mail.password'   => email_settings('password'),
        ]);
    }
}
