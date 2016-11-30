<?php
/**
 * Created by PhpStorm.
 * User: Emmy
 * Date: 11/30/2016
 * Time: 12:51 AM
 */

namespace Codulab\Username;

use Illuminate\Support\ServiceProvider;
use Validator;


class RestrictedUsernameServiceProvider extends ServiceProvider
{
    protected $message = 'That username is taken. Please try another!';

    /**
     * Publishes the config files.
     */
    public function boot()
    {
        $message = $this->getMessage();
        $usernames = $this->getRestrictedUsernames();

        Validator::extend('restricted', function ($attribute, $value, $parameters, $validator) use ($usernames) {
            return !in_array($value, $usernames);
        }, $this->message);
    }

    /**
     * Register the application services.
     */
    public function register()
    {
        //
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return ['laravel-username'];
    }

    /**
     * @return string
     */
    public function getRestrictedUsernames()
    {
        $path = public_path('usernames.txt');
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
        return config('restricted.message') ?: $this->message;
    }
}