<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Notifications Language Lines
    |--------------------------------------------------------------------------
    |
    */

    'reservationrequest' => [
        'button'        =>  'Go to my profile',
        'subject'       =>  'Campsite - Reservation Request',
        'message'       =>
            'Someone has made a request to make a reservation for your Campsite :campsitename from :startdate to :enddate.
             It\'s a :movement movement with a total of :capacity persons.
             And heir personal message is: :extra.'
    ],
    'reservation-accepted' => [
        'button'        =>  'Go to my profile',
        'subject'       =>  'Campsite - Reservation Request Accepted',
        'message'       =>  'Good news, the owner of Campsite :campsitename has accepted your request for renting this Campsite!',
        'goodbye'       =>  'Thank you for using our application and enjoy your trip!'
    ],
];
