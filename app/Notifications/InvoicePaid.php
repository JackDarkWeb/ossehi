<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class InvoicePaid extends Notification
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
        return ['mail', 'database'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return MailMessage
     */
    public function toMail($notifiable)
    {
        $number = '5484';
        $firstDate = '06 November 2020';
        $secondDate = '06 November 2020';

        return (new MailMessage)
            ->subject('Invoice')
            ->greeting('Thank!')
                    ->line(__('We send you enclosed our invoice number :number of the :firstDate corresponding to your order form finalized on the :secondDate.',['number' => $number, 'firstDate' => $firstDate, 'secondDate' => $secondDate]))
                    ->line('We wish you a good reception')
                    ->action('e-ossehi', url('/'))
                    ->line('Thank you for using our application!');
    }

    /**
     * @param $notifiable
     * @return array
     */
    public function toDatabase($notifiable)
    {
        return [
            'invoice_id' => 4,
            'amount' => 2000,
            'invoice_action' => 'Pay now .....'
        ];
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
