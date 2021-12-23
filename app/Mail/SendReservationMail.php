<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendReservationMail extends Mailable
{
	use Queueable, SerializesModels;

	protected $content;
	protected $type;
	private const SUBJECT = '予約のお問い合わせについて';
	private const VIEW = 'reservation.mail';

	/**
	 * Create a new message instance.
	 *
	 * @return void
	 */
	public function __construct(array $content,string $type)
	{
		$this->content = $content;
		$this->type = $type;
	}

	/**
	 * Build the message.
	 *
	 * @return $this
	 */
	public function build()
	{
		$admin = config('add.mail.mail_admin');
		$cc = config('add.mail.mail_cc');
		$bcc = config('add.mail.mail_bcc');

		if($this->type === 'admin'){
			return $this->from($admin,config('app.name'))
				->subject(self::SUBJECT)
				->view(self::VIEW)
				->cc($cc)
				->bcc($bcc)
				->with(['content' => $this->content,'type' => $this->type]);
		}

		if($this->type === 'client'){
			return $this->from($admin,config('app.name'))
				->subject(self::SUBJECT)
				->view(self::VIEW)
				->with(['content' => $this->content,'type' => $this->type]);
		}
	}
}
