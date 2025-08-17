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
url()
routing()
base64()
cipher()
hasher()
password()
scrambler()
```
### Simple use of aliases 
#### Create Enums with you aliases
```php

namespace Enums\Aliases;

use Tweaks\Enums\Interfaces\EnumInterfaceAlias;
use Tweaks\Enums\Traits\EnumTraitAlias;

enum EnumAliasAdmin implements EnumInterfaceAlias
{
    use EnumTraitAlias;

    case ALIAS_NUMBER_1;
    case ALIAS_NUMBER_2;
}

```
#### Usage in routes config
```php
use Enums\Aliases\EnumAliasAdmin;
use Tweaks\Tweaks;
use Tweaks\Enums\EnumVerbs;

EnumAliasAdmin::ALIAS_NUMBER_1->route(
    EnumVerbs::GET,
    "/admin/url1",
    [ControllerAdmin::class, 'method1'], //Hint and clickable class/method. Autodetect is static/dynamic method.
    0, //Cache none
    5 //Throttle 5kbps
);

EnumAliasAdmin::ALIAS_NUMBER_2->rest(
    "/admin/url2",
    ControllerAdmin::class
);

//Check is current alias
EnumAliasAdmin::ALIAS_NUMBER_1->isCurrentAlias();
//OR from Tweaks
Tweaks::routing()->isCurrentAlias('@ALIAS_NUMBER_2');
```
OR with group
```php
Tweaks::routing()->group("/admin", function () {
    EnumAliasAdmin::ALIAS_NUMBER_1->route(
        EnumVerbs::GET,
        "/url1",
        [ControllerAdmin::class, 'method1']
    );

    EnumAliasAdmin::ALIAS_NUMBER_2->route(
        EnumVerbs::GET,
        "/url2",
        [ControllerAdmin::class, 'method2']
    );
});
```
#### Usage in templates
```php
use Enums\Aliases\EnumAliasAdmin;
use Tweaks\Tweaks;

echo EnumAliasAdmin::ALIAS_NUMBER_1->getUrl();
```
#### Simple reroute
```php
EnumAliasAdmin::ALIAS_NUMBER_1->reroute();
```

Alias is generated uniquely name, based on enum and case. Therefore, the enum name must be unique to avoid collisions
Eg:

EnumAliasAdmin__ALIAS_NUMBER_1
EnumAliasAdmin__ALIAS_NUMBER_2
