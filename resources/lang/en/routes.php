<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Routing Language Lines
    |--------------------------------------------------------------------------
    |
    */

    'accept-reservation'            => 'accept-reservation/{id}',
    'add-building'                  => 'campsite/builing/new',
    'add-meadow'                    => 'campsite/meadow/new',
    'auth'                          => [
        'login'     =>  'login',
        'logout'    =>  'logout',
        'password'  =>  [
            'email' =>  'email',
            'reset' =>  'reset',
        ],
        'register'  =>  'register',
    ],
    'campsite'                      => 'campsite/{id}/{slug?}',
    'delete-building'               => 'delete-building/{id}',
    'delete-reservation'            => 'delete-reservation/{id}',
    'delete-meadow'                 => 'delete-meadow/{id}',
    'home'                          => 'home',
    'login'                         => 'login',
    'logout'                        => 'logout',
    'make-reservation'              => 'make-reservation/campsite/{id}/{slug?}',
    'movements'                     => 'movements',
    'my-profile'                    => 'my-profile',
    'offers'                        => 'campsite/offers',
    'offer-campsite'                => 'offer-campsite',
    'offer-campsite-new'            => 'offer-campsite/new',
    'offer-campsite-save'           => 'campsite-offer/store',
    'offer-campsite-images-save'    => 'campsite-offer/images/store',
    'offer-campsite-update'         => 'campsite-offer/update',
    'profile-update'                => 'update-profile',
    'password-change'               => 'change-password',
    'provinces'                     => 'provinces',
    'register'                      => 'register',
    'save-campsite'                 => 'save-campsite',
    'search-campsites'              => 'campsite/search',
    'search-campsite'               => 'search-campsite',
    'search-campsite-with-province' => 'search-campsite/{id}',
    'states'                        => 'states',
    'store-reservation'             => 'make-reservation'
];
