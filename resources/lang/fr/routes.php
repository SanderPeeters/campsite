<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Routing Language Lines
    |--------------------------------------------------------------------------
    |
    */

    'accept-reservation'            => 'accepter-réservation/{id}',
    'add-building'                  => 'campsite/batiment/nouveau',
    'add-meadow'                    => 'campsite/prairie/nouveau',
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
    'delete-building'               => 'suprimer-batiment/{id}',
    'delete-reservation'            => 'suprimer-réservation/{id}',
    'delete-meadow'                 => 'suprimer-prairie/{id}',
    'home'                          => 'home',
    'login'                         => 'login',
    'logout'                        => 'logout',
    'make-reservation'              => 'fait-réservation/campsite/{id}/{slug?}',
    'movements'                     => 'movements-de-jeunesse',
    'my-profile'                    => 'mon-profil',
    'offers'                        => 'campsite/offres',
    'offer-campsite'                => 'offre-campsite',
    'offer-campsite-new'            => 'offre-campsite/nouveau',
    'offer-campsite-save'           => 'offre-campsite/sauve',
    'offer-campsite-images-save'    => 'offre-campsite/images/sauve',
    'offer-campsite-update'         => 'offre-campsite/update',
    'profile-update'                => 'profil-de-mise-à-jour',
    'password-change'               => 'change-mot-de-passe',
    'provinces'                     => 'provinces',
    'register'                      => 'register',
    'save-campsite'                 => 'sauve-campsite',
    'search-campsites'              => 'campsite/cherche',
    'search-campsite'               => 'cherche-campsite',
    'search-campsite-with-province' => 'cherche-campsite/{id}',
    'states'                        => 'régions',
    'store-reservation'             => 'fait-reservation'
];
