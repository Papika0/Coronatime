<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ResetPasswordNotification extends Notification
{
	use Queueable;

	public $token;

	public static $createUrlCallback;

	public static $toMailCallback;

	public function __construct($token)
	{
		$this->token = $token;
	}

	public function via($notifiable)
	{
		return ['mail'];
	}

	public function toMail($notifiable)
	{
		if (static::$toMailCallback) {
			return call_user_func(static::$toMailCallback, $notifiable, $this->token);
		}

		return $this->buildMailMessage($this->resetUrl($notifiable));
	}

	protected function buildMailMessage($url)
	{
		return (new MailMessage)
			->subject('Reset Password Notification')
			->markdown('email.reset-password', ['url' => $url]);
	}

	protected function resetUrl($notifiable)
	{
		if (static::$createUrlCallback) {
			return call_user_func(static::$createUrlCallback, $notifiable, $this->token);
		}

		return url(route('password.reset', [
			'token' => $this->token,
			'email' => $notifiable->getEmailForPasswordReset(),
		], false));
	}

	public static function createUrlUsing($callback)
	{
		static::$createUrlCallback = $callback;
	}

	public static function toMailUsing($callback)
	{
		static::$toMailCallback = $callback;
	}
}
