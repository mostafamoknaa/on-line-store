<?php

namespace App\Notifications;
use App\Models\carts;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\Productcontroller;
use Illuminate\Support\Facades\Auth;

class PayVisaNotification extends Notification
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
        $us=Auth::id();
        $carts=carts::get()->where('user_id',$us);
        $total=
        carts::join('products','carts.product_id','=','products.id')
        ->where('carts.user_id',$us)
        ->sum('products.price');
        $total+=5;
        return (new MailMessage)
                     
                    ->line('welcome to Store.')
                    ->line('All You Want is here.')
                    ->line('Your money is '.$total)
                    ->line('Your Deleivy Arrive withen 2 days.')
                    ->action('Return To Store', url("/sections"))
                    ->line('Thank you for using our application!');
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
