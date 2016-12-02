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

    /**
     * Publishes the config files.
     */
    public function boot()
    {
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
        $message = $this->getMessage();
        $usernames = $this->getRestrictedUsernames();

        Validator::extend('restricted', function ($attribute, $value, $parameters, $validator) use ($usernames) {
            return !in_array($value, $usernames);
        }, $this->message);
    }

    /**
     * @return string
     */
    public function getRestrictedUsernames()
    {
        $path = public_path('restricted-usernames.txt');
        $data = explode("\r\n", file_get_contents($path));
        $data = array_map(function($value){
            return preg_replace("/\s/", "", $value);
        }, $data);
        return $data;
    }

    /**
     * @return string
     */
    public function getMessage()
    {
        return $this->message;
    }

}