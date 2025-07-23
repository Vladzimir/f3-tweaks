# f3-tweaks
Tweaks for comfortable work with f3
* IDE auto-suggestions for system variables and easy work with them 
* works with F3 v3.9 and PHP v8.3+

### Installation
- Method 1: use composer: `composer require vladzimir/f3-tweaks`

- Method 2: copy the folder `lib/*` contents an into your F3 `lib/` directory or another directory that is known to the [AUTOLOADER](https://fatfreeframework.com/quick-reference#AUTOLOAD)

### How to use
```php
use Tweaks\Tweaks;
use Tweaks\Enums\EnumSystem as System;

//Tweak base functions f3
Tweaks::fw()->Base_Functions_F3();

//Easy access to system variables
System::SEED->set('qSwDeFr');

//Tweaks to access for PHP globals
Tweaks::headers()->get('Host');
Tweaks::params()->getAll();
```
### List tweaks
```php
cookie()
env()
files()
get()
params()
post()
request()
server()
session()
headers()
system()
cache()
```