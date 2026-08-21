<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Default Hash Driver
    |--------------------------------------------------------------------------
    |
    | This option controls the default hash driver that will be used to hash
    | passwords for your application. By default, the bcrypt algorithm is
    | used; however, you are free to modify this option if you wish.
    |
    | Supported: "bcrypt", "argon", "argon2id"
    |
    */

    'driver' => env('HASH_DRIVER', 'bcrypt'),

    /*
    |--------------------------------------------------------------------------
    | Bcrypt Options
    |--------------------------------------------------------------------------
    |
    | Here you may specify the configuration options for when passwords are
    | hashed using the Bcrypt algorithm. This will allow you to control
    | the amount of time it takes to hash the given credentials.
    |
    */

    'bcrypt' => [
        'rounds' => env('BCRYPT_ROUNDS', 10),
        'verify' => true,
    ],

    /*
    |--------------------------------------------------------------------------
    | Argon Options
    |--------------------------------------------------------------------------
    |
    | Here you may specify the configuration options for when passwords are
    | hashed using the Argon algorithm. These will allow you to control
    | the amount of time and resources it takes to hash passwords.
    |
    */

    'argon' => [
        'memory' => env('ARGON_MEMORY', 65536),
        'threads' => env('ARGON_THREADS', 1),
        'time' => env('ARGON_TIME', 4),
        'verify' => true,
    ],

    /*
    |--------------------------------------------------------------------------
    | Rehash Passwords
    |--------------------------------------------------------------------------
    |
    | Here you may specify whether password hashes should automatically be
    | upgraded to the current algorithm / work factor when a user signs in.
    |
    */

    'rehash_on_login' => false,

];
