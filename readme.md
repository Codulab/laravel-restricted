# Restricted

Restricted allows you to restrict your users from signing up with certain usernames.
For example, you have this route: www.mywebsite.com/admincpanel
and your application allows to view user profile like this: www.mywebsite.com/username
This package can crawl all your routes and return a validation message when a user tries to register with such words like "admincpanel"

## Installation

To install Restricted use composer

### Download

```
composer require codulab/restricted
```

### Add service provider

Add the following service provider to the array in: ```config/app.php```

```php
Codulab\Restricted\RestrictedServiceProvider::class,
```

### Publish the config

```
php artisan vendor:publish --tag=restricted_config
```

## Usage

First, we need to crawl and index the application routes by running the command:

```
php artisan restricted:index
```
Now, you can simply add restricted to your validations like so:

```php
    $this->validate($request, [
        'name' => 'required|string|min:5',
        'username' => 'required|restricted'
    ]);
```
You can also add a new validation message

```php
    $this->validate($request, [
        'name' => 'required|string|min:5',
        'username' => 'required|restricted'
    ],[
    	'username.restricted' => 'A user exists with that username. Please try another or add more characters'
    ]);
```
## Settings

* file_path: (string) File name and path to save the indexed words
* index_level: (int) How deep do u want us to crawl your routes? ExAMPLE => www.mywebsite.com/segment1/segmen2/segment3. setting this value to '2', will allow indexing of segment1 and segment2 and exclude segment3
* merge: (bool) should we to merge the new results with the old ones

## License

MIT license - free to use and abuse!