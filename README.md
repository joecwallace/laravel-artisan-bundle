# Artisan bundle for Laravel

## Description

This bundle exposes artisan to the web. As such, it probably should not be used in a production environment. You can password protect it, I guess, but it's still risky. I wrote it primarily to use migrations in a PHP Fog app, where it also worked nicely for running tasks to generate test data.

## Installation

#### Add something like this to ```application/bundles.php```:

    return array(
    	'artisan' => array(
    		'handles' => 'artisan',
    	),
    );

## Usage

Use URLs like artisan tasks, replacing spaces with ```/```, double colons (```::```) with ```+```, and colons (```:```) with ```.```.

For example, the migrate command

    php artisan migrate

becomes

    http://my.awesome.app/artisan/migrate

and the task

    php artisan admin::generate:list

would be

    http://my.awesome.app/artisan/admin+generate.list

Parameters are allowed too.

    php artisan notify someone

is

    http://my.awesome.app/artisan/notify/someone

## Enjoy

I hope someone else finds this useful at some point.

## License

MIT license - [http://www.opensource.org/licenses/mit-license.php](http://www.opensource.org/licenses/mit-license.php)
