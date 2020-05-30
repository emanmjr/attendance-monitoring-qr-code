<?php

namespace App\Notifications\Frontend\Auth;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

/**
 * Class UserNeedsConfirmation.
 */
class UserNeedsConfirmation extends Notification
{
    use Queueable;

    /**
     * @var
     */
    protected $confirmation_code;

    protected $first_name;

    protected $tempPassword;

    protected $email;

    /**
     * UserNeedsConfirmation constructor.
     *
     * @param $confirmation_code
     * @param $user_name
     */
    public function __construct($confirmation_code, $first_name, $tempPassword, $email)
    {
        $this->confirmation_code = $confirmation_code;
        $this->first_name = $first_name;
        $this->tempPassword = $tempPassword;
        $this->email = $email;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param mixed $notifiable
     *
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param mixed $notifiable
     *
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        // return (new MailMessage())
        //     ->subject(app_name().': '.__('exceptions.frontend.auth.confirmation.confirm'))
        //     ->line(__('strings.emails.auth.click_to_confirm'))
        //     ->action(__('buttons.emails.auth.confirm_account'), route('frontend.auth.account.confirm', $this->confirmation_code), $this->user_name)
        //     ->line(__('strings.emails.auth.thank_you_for_using_app'));

        return (new MailMessage)
            ->subject(app_name().': '.__('exceptions.frontend.auth.confirmation.confirm'))
            ->view(
                'emails.confirmation', [
                    'confirmation_code' => $this->confirmation_code,
                    'first_name'        => $this->first_name,
                    'tempPassword'      => $this->tempPassword,
                    'email'      => $this->email
                ]
        );
    }
}
