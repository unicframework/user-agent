## User Agent

  User agent library parse client browsers all data from request.

  - **ip** : get user ip address.
  - **os** : get user device os name.
  - **osVersion** : get user device os version.
  - **browser** : get user browser name.
  - **browserVersion** : get user browser version.
  - **deviceType** : get user device type.
  - **deviceBrand** : get user device brand.
  - **referrer** : get http referrer.
  - **isReferred** : check request is referred or not.
  - **userAgent** : get browser user agent.


### Installation

  - Install `composer` if you have not installed.

```shell
composer require unicframework/user-agent
```

### Example

```php
use UserAgent\UserAgent;

// Parse current request user agent
$user = new UserAgent();

// Parse custom user agent string
$user = new UserAgent($_SERVER['HTTP_USER_AGENT']);

// Get client ip address
echo $user->ip;

// Get client os
echo $user->os;

// Get client os version
echo $user->osVersion;

// Get client browser
echo $user->browser;

// Get client browser version
echo $user->browserVersion;

// Get client device type (Phone, iPhone, Computer, etc.)
echo $user->deviceType;

// Get client device brand name (Apple, Samsung, Lenovo, etc.)
echo $user->deviceBrand;

// Get client referrer
echo $user->referrer;

// Check client is referred or not
if($user->isReferred) {
  //Client is referred
}

// Get client user agent
echo $user->userAgent;
```

## License

  [MIT License](https://github.com/unicframework/user-agent/blob/main/LICENSE)
