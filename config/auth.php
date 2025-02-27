<?php

return [
  'defaults' => [
    'guard' => 'admin',
    'passwords' => 'admins',
  ],

  'guards' => [
    'web' => [
      'driver' => 'session',
      'provider' => 'patients',
    ],

    'admin' => [
      'driver' => 'session',
      'provider' => 'admins',
    ],

    'doctor' => [
      'driver' => 'session',
      'provider' => 'doctors',
    ],

    'patient' => [
      'driver' => 'session',
      'provider' => 'patients',
    ],

    'api' => [
      'driver' => 'token',
      'provider' => 'admins',
      'hash' => false,
    ],
  ],

  'providers' => [
    'admins' => [
      'driver' => 'eloquent',
      'model' => App\Models\Admin::class,
    ],

    'doctors' => [
      'driver' => 'eloquent',
      'model' => App\Models\Doctor::class,
    ],

    'patients' => [
      'driver' => 'eloquent',
      'model' => App\Models\Patient::class,
    ],
  ],

  'passwords' => [
    'admins' => [
      'provider' => 'admins',
      'table' => 'password_resets',
      'expire' => 60,
      'throttle' => 60,
    ],

    'doctors' => [
      'provider' => 'doctors',
      'table' => 'password_resets',
      'expire' => 60,
      'throttle' => 60,
    ],

    'patients' => [
      'provider' => 'patients',
      'table' => 'password_resets',
      'expire' => 60,
      'throttle' => 60,
    ],
  ],

  'password_timeout' => 10800,
];
