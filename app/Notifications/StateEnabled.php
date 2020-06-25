<?php

namespace App\Notifications;

use App\Models\User;
use App\Models\State;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class StateEnabled extends Notification
{
    use Queueable;

    /**
     * The state that was enabled.
     *
     * @var App\Models\State
     */
    protected $state;

    /**
     * The user that enabled the state.
     *
     * @var App\Models\User
     */
    protected $user;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(State $state, User $user)
    {
      $this->state = $state;
      $this->user = $user;
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
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
      return [
        'state' => $this->state->name,
        'user' => $this->user->name,
        'created_at' => now(),
      ];
    }
}
