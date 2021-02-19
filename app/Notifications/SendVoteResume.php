<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\HtmlString;

class SendVoteResume extends Notification
{
    use Queueable;
    private $result;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($result)
    {
        //
        $this->result = $result;
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
        try {
            $view = view('mails.result', [ "result" => $this->result ]);
            return (new MailMessage)
                    ->subject('Resultado de elección de delegados 2021')
                    ->greeting('¡Hola, ' . $this->result->voter->name . '!')
                    ->line('Te informamos que tu voto se realizó correctamente')
                    ->line(new HtmlString($view));
        } catch (\Throwable $th) {
            throw $th;
        }
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
