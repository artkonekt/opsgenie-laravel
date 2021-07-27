# OpsGenie Notifications Channel for Laravel

[![Tests](https://img.shields.io/github/workflow/status/artkonekt/opsgenie-laravel/tests/master?style=flat-square)](https://github.com/artkonekt/opsgenie-laravel/actions?query=workflow%3Atests)
[![Packagist Stable Version](https://img.shields.io/packagist/v/konekt/opsgenie-laravel.svg?style=flat-square&label=stable)](https://packagist.org/packages/konekt/opsgenie-laravel)
[![Packagist downloads](https://img.shields.io/packagist/dt/konekt/opsgenie-laravel.svg?style=flat-square)](https://packagist.org/packages/konekt/opsgenie-laravel)
[![StyleCI](https://styleci.io/repos/389939873/shield?branch=master)](https://styleci.io/repos/389939873)
[![MIT Software License](https://img.shields.io/badge/license-MIT-blue.svg?style=flat-square)](LICENSE.md)

This package enables Laravel 8+ Applications to send notification to OpsGenie.

## Installation

```bash
composer require konekt/opsgenie-laravel
```

### Configuration

Add your Auth Token, and endpoint config to your application's `config/services.php`:

```php
// config/services.php
...

'opsgenie' => [
    'auth_token' => env('OPSGENIE_AUTH_TOKEN'),
    'europe' => true, // OPTIONAL: if true, then the EU API endpoint will be used
    // 'endpoint' => 'https://some.custom.endpoint/v2', // VERY OPTIONAL: in case you use a non-official endpoint
],
...
```

## Usage
