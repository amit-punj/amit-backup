<?php
   
namespace App\Notifications;
   
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
   
class TerminationNotification extends Notification
{
    use Queueable;
  
    private $details;
   
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($details)
    {
        $this->details = $details;
    }
   
    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail','database'];
    }
   
    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        $url = url('/contract-details/'.$this->details['actionURL']);
        return (new MailMessage)
                    ->subject($this->details['subject'])
                    ->greeting($this->details['greeting'])
                    ->line($this->details['body'])
                    ->line("Click on the button to view contract details")
                    ->action('Click here', $url )
                    ->line($this->details['thanks']);
                    // ->attach($this->details['attach'],['as' => $this->details['as'] ]);
    }
  
    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toDatabase($notifiable)
    {
        return [
            
        ];
    }
}