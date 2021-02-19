<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class SendVoteResume extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
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
        $params = [];
        return (new MailMessage)
                    ->subject('Confirmación de voto')
                    ->greeting('Hola, ' .$notifiable->name . '!')
                    ->line('Te informamos que tu voto se realizó correctamente!')
                    // ->action('Ver resultado', url('https://coopemphost.com.pe/'))
                    // ->line('Gracias por usar el Sistema de Elecciones 2.0!')
                    // ->view('mails.invoice', [ "params" => $params] );
                    // ->action('Ver resultados', url('https://coopemphost.com.pe/'))
                    ->from('soporte@elecciones20.com', 'Soporte Sistema de Elecciones 2.0')
                    ->line('Muchas gracias por participar del proceso de elección de delegados 2021!');
                    // ->view('mails.invoice', [ "params" => $params] );
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
