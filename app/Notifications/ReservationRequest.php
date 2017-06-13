<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class ReservationRequest extends Notification
{
    use Queueable;
    public $reservation;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($reservation)
    {
        $this->reservation = $reservation;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject(trans('notifications.reservationrequest.subject'))
            ->greeting('Hello!')
            ->line(trans('notifications.reservationrequest.message',
                ['campsitename' => $this->reservation->campsite->campsite_name, 'startdate' => $this->reservation->start_date->format('d/m/y'),
                    'enddate' => $this->reservation->end_date->format('d/m/y'), 'movement' => trans('movements.'.$this->reservation->movement_id),
                    'capacity' => $this->reservation->capacity, 'extra' => $this->reservation->extra_info]))
            ->action(trans('notifications.reservationrequest.button'), route('my-profile'));
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
