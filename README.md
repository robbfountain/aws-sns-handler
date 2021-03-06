# Handle AWS SNS Messages in your Laravel Application

[![Build Status](https://travis-ci.org/robbfountain/aws-sns-handler.svg?branch=master)](https://travis-ci.org/robbfountain/aws-sns-handler) [![StyleCI](https://github.styleci.io/repos/252278727/shield?branch=master)](https://github.styleci.io/repos/252278727)

This is a Laravel package for validating and handling AWS SNS messages


## Installation
You can install the package with composer

```
composer require onethirtyone/aws-sns-handler
```

## CSRF
Since SNS messages are sent via a HTTP Post Request you will need to add your webhook route to your ```VerifyCsrfToken.php```
```php
/**
     * The URIs that should be excluded from CSRF verification.
     *
     * @var array
     */
    protected $except = [
        '/webhook'
    ];
```

## Usage
Edit your ```routes/web.php``` and add a route to your the webhook handler
```php
Route::any('callback', 'OneThirtyOne\Sns\Controllers\SnsController@handle');
```

### Events
The package will fire an ```SnsSubscriptionConfirmation``` event when a new subscription is added and needs to be confirmed and will fire an ```SnsEvent``` event when a message is delivered after confirmation.

You should listen for these events in your application.

## Contributing
Pull requests are welcome.  For major changes, please open an issue first to discuss what you would like to change

## License
[MIT](https://choosealicense.com/licenses/mit/)


