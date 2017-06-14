<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Routing Language Lines
    |--------------------------------------------------------------------------
    |
    */

    'accept-reservation'            => 'accepteer-reservatie/{id}',
    'add-building'                  => 'campsite/gebouw/nieuw',
    'add-meadow'                    => 'campsite/weide/nieuw',
    'auth'                          => [
        'login'     =>  'login',
        'logout'    =>  'logout',
        'password'  =>  [
            'email' =>  'email',
            'reset' =>  'reset',
        ],
        'register'  =>  'registreer',
    ],
    'campsite'                      => 'campsite/{id}/{slug?}',
    'delete-building'               => 'verwijder-gebouw/{id}',
    'delete-reservation'            => 'verwijder-reservatie/{id}',
    'delete-meadow'                 => 'verwijder-veld/{id}',
    'home'                          => 'home',
    'login'                         => 'login',
    'logout'                        => 'logout',
    'make-reservation'              => 'reservatie-aanvragen/campsite/{id}/{slug?}',
    'movements'                     => 'jeugdbewegingen',
    'my-profile'                    => 'mijn-profiel',
    'offers'                        => 'campsite/aanbiedingen',
    'offer-campsite'                => 'campsite-aanbieden',
    'offer-campsite-new'            => 'campsite-aanbieden/nieuw',
    'offer-campsite-save'           => 'campsite-offer/opslaan',
    'offer-campsite-images-save'    => 'campsite-offer/afbeeldingen/opslaan',
    'offer-campsite-update'         => 'campsite-offer/wijzig',
    'profile-update'                => 'update-profiel',
    'password-change'               => 'wijzig-wachtwoord',
    'provinces'                     => 'provincies',
    'register'                      => 'register',
    'save-campsite'                 => 'campsite-opslaan',
    'search-campsites'              => 'campsite/zoek',
    'search-campsite'               => 'campsite-zoeken',
    'search-campsite-with-province' => 'campsite-zoeken/{id}',
    'states'                        => 'gewesten',
    'store-reservation'             => 'maak-reservatie'
];
