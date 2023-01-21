# Filter

[![Latest Version on Packagist][ico-version]][link-packagist]
[![Total Downloads][ico-downloads]][link-downloads]

This is where your description should go. Take a look at [contributing.md](contributing.md) to see a to do list.

## Installation

Via Composer

``` bash
$ composer require fugazi-code/laravel-eloquent-filter
```

## Usage

## Change log

Please see the [changelog](changelog.md) for more information on what has changed recently.

## Install

``` bash
$ php artisan make:filter UserFilter
```

## Filter Class
``` php
<?php

namespace App\Http\Controllers\Filters;

use FugaziCode\Filter\Filter;

class UserFilter extends Filter
{
    public function email($value)
    {
        $this->query->where('email', 'like', "%$value%");
    }

    public function permanent($value)
    {
        $this->query->whereHas('address', function($query) use ($value) {
            $query->where('permanent', 'like', "%$value%");
        });
    }
}
```
## Eloquent Implementation
``` php
Route::get('/', function () {
    return User::query()->with(['address'])->filter(new UserFilter)->get();
});
```
## Contributing

Please see [contributing.md](contributing.md) for details and a todolist.

## Security

If you discover any security related issues, please email author@email.com instead of using the issue tracker.

## Credits

- [Renier Trenuela II][link-author]
- [All Contributors][link-contributors]

## License

MIT. Please see the [license file](license.md) for more information.

[ico-version]: https://img.shields.io/packagist/v/fugazi-code/filter.svg?style=flat-square
[ico-downloads]: https://img.shields.io/packagist/dt/fugazi-code/filter.svg?style=flat-square
[ico-travis]: https://img.shields.io/travis/fugazi-code/filter/master.svg?style=flat-square
[ico-styleci]: https://styleci.io/repos/12345678/shield

[link-packagist]: https://packagist.org/packages/fugazi-code/filter
[link-downloads]: https://packagist.org/packages/fugazi-code/filter
[link-travis]: https://travis-ci.org/fugazi-code/filter
[link-styleci]: https://styleci.io/repos/12345678
[link-author]: https://github.com/fugazi-code
[link-contributors]: ../../contributors
