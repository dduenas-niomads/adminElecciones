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
        return (new MailMessage)
                    ->subject('Resumen de su votación')
                    ->action('Ver resultados', url('https://coopemphost.com.pe/'))
                    ->from('soporte@elecciones20.com', 'Soporte Sistema de Elecciones 2.0')
                    ->line('Estimado/a ' . $notifiable->voter->name)
                    ->line('El resumen de tu participación fue:')
                    ->line('Nominado: ' . $notifiable->nominee->name)
                    ->line('Fecha y hora de la votación: ' . $notifiable->created_at)
                    ->line('¡Gracias por usar el Sistema de Elecciones 2.0!');
                    // ->view('mails.result', [ "result" => $notifiable] );
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
