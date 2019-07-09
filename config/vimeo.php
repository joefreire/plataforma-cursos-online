<?php

/*
 * This file is part of Laravel Vimeo.
 *
 * (c) Vincent Klaiber <hello@vinkla.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

return [

    /*
    |--------------------------------------------------------------------------
    | Default Connection Name
    |--------------------------------------------------------------------------
    |
    | Here you may specify which of the connections below you wish to use as
    | your default connection for all work. Of course, you may use many
    | connections at once using the manager class.
    |
    */

    'default' => 'main',

    /*
    |--------------------------------------------------------------------------
    | Vimeo Connections
    |--------------------------------------------------------------------------
    |
    | Here are each of the connections setup for your application. Example
    | configuration has been included, but you may add as many connections as
    | you would like.
    |
    */

    'connections' => [

        'main' => [
            'client_id' => '63cb01daa00a7da3bceec3670d3f741339f17bda',
            'client_secret' => 'BlZvrpAyo85wdFJVcl/Mvzc0v4sfEyo531TCR37VajYw1nNWd2FiEYsgflFKDi7JY3ESaS3iYzdt7p6H6B0TYqcnfl/PImVjM2D/Pc04VyLK+GB3TWiivd0km7TejEjS',
            'access_token' => '8a0df70f178e82493d22ea055f32b6a8',
        ],
    ],

];
