# A Boilerplate repo for contributions


This package makes it easy to send notifications using [FacilitaMovel](link to service) with Laravel 5.5+, 6.x, 7.x and 8.x

Facilita Movel channel notification for Laravel. Simple send support only


## Contents

- [Installation](#installation)
	- [Setting up the FacilitaMovel service](#setting-up-the-FacilitaMovel-service)
- [Usage](#usage)
	- [Available Message methods](#available-message-methods)
- [Security](#security)
- [Contributing](#contributing)
- [Credits](#credits)
- [License](#license)


## Installation

You can install the package via composer:

``` bash
$ composer require vicenterusso/laravel-facilitamovel-channel
```

### Setting up the FacilitaMovel service

Configure your credentials:

```php
// config/services.php
...
'facilitamovel' => [
    'login'    => env('FACILITA_MOVEL_LOGIN', 'YOUR ACCOUNT'),
    'password' => env('FACILITA_MOVEL_PASSWORD', 'YOUR PASSWORD')
],
...

```



## Usage

You can now use the channel in your via() method inside the Notification class.

```php
use NotificationChannels\FacilitaMovel\FacilitaMovelChannel;
use Illuminate\Notifications\Notification;

class InvoicePaid extends Notification
{
    public function via($notifiable)
    {
        return [FacilitaMovelChannel::class];
    }

    public function toFacilitamovel($notifiable)
    {
        return FacilitaMovel::create()
            ->to($notifiable->phone) // your user phone
            ->content('Your invoice has been paid');
    }
}
```


### Routing a message


```php
...
/**
 * Route notifications for the FacilitaMovel channel.
 *
 * @return int
 */
public function routeNotificationForFacilitamovel()
{
    return $this->phone;
}
...
```

### Available Message methods

- `to($phone)`: (integer) Recipient's phone.
- `content('message')`: (string) SMS message.


## Security

If you discover any security related issues, please email vicente.russo@gmail.com instead of using the issue tracker.


## Credits

- [Vicente Russo Neto](https://github.com/vicenterusso)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
