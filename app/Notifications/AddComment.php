<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use App\Models\Comment;
use Illuminate\Support\Facades\Auth;
class AddComment extends Notification
{
    use Queueable;
    private $comment_id;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($comment_id)
    {
          $this->comment_id = $comment_id;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    // public function toMail($notifiable)
    // {
    //     return (new MailMessage)
    //                 ->line('The introduction to the notification.')
    //                 ->action('Notification Action', url('/'))
    //                 ->line('Thank you for using our application!');
    // }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toDatabase($notifiable)
    {
        return [
            //'data' => $this->comment_id['body']
            'id' => $this->comment_id,
            'title' => 'There is a new comment',
            'user'=> auth::user()->name,
        
        ];
    }
}
