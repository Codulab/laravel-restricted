<?php
/**
 * Created by PhpStorm.
 * User: Emmy
 * Date: 11/30/2016
 * Time: 12:51 AM
 */

namespace Codulab\Restricted;

use Illuminate\Support\ServiceProvider;
use Validator;
use Codulab\Restricted\Commands\CrawlRoutes;


class RestrictedServiceProvider extends ServiceProvider
{
    protected $message = 'That :attribute is taken. Please try another!';
    protected $fileName;

    /**
     * Publishes the config files.
     */
    public function boot()
    {
        $this->publishes([
            __DIR__.'/../resources/config/restricted.php' => config_path('restricted.php'),
        ], 'restricted_config');

        $this->fileName = config('restricted.crawl_level') ?: public_path("reserved.txt");
        $this->initialize();
    }

    /**
     * Register the application services.
     */
    public function register()
    {
        //
        $this->commands(CrawlRoutes::class);
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return ['restricted'];
    }

    /**
     * @return void
     */
    public function initialize()
    {
        $usernames = $this->getRestrictedUsernames();

        Validator::extend('restricted', function ($attribute, $value, $parameters, $validator) use ($usernames) {
            return ! $usernames->contains($value);
        }, $this->getMessage());
    }

    /**
     * @return collection
     */
    public function getRestrictedUsernames()
    {
        $path = $this->fileName;
        if(file_exists($path)){
            $content = file_get_contents($path);
            return collect(explode("\r\n", $content))
                    ->map(function($value){
                        return preg_replace("/\s/", "", $value);
                    });
        }else{
            return collect([]);
        }
    }

    /**
     * @return string
     */
    public function getMessage()
    {
        return $this->message;
    }

}