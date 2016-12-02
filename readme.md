# Restricted

Restricted allows you to restrict your users from registring with certain usernames.
For example, you have this route: www.mywebsite.com/admincpanel
and your application allows to view user profile like this: www.mywebsite.com/username
This package can crawl all your routes and return a validation message when a user tris to register with such words like "admincpanel"

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

