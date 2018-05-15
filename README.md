# WP_Nonce_OOP
Wordpress Nonce OOP Implementation. Just an OOP wrap.

## Installation

```sh
$ composer require manuel-rod/wp_nonce_oop
```
## Usage

```php
$nonce = new WP_Nonce('wp_action_nonce');
```
## Public methods
```php
$nonce->createNonce()
$nonce->verifyNonce($nonce)
$nonce->nonceField($name = '_wpnonce', $referrer = true, $echo = true)
$nonce->nonceUrl($url, $name = '_wpnonce')
$nonce->checkAdminReferer($name = '_wpnonce')
$nonce->checkAjaxReferer($name = false, $die = true)
```

## Testing (phpunit)

Copy phpunit.xml.dist to phpunit.xml and modify to your needs.
```sh
$ cd vendor/manuelRod/WP_Nonce_OOP
$ composer install
$ vendor/bin/phpunit
```

## Licence
MIT


