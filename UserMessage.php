<?php

namespace UserMessage;

class User
{
	private $name;
	private $email;
	private $gender;
	private $age;
	private $phone;

	public function __construct($name, $email, $gender = '', $age = '', $phone = '')
	{
		$this->name = $name;
		$this->email = $email;
		$this->gender = $gender;
		$this->age = $age;
		$this->phone = $phone;
	}

	private function notifyOnEmail($message)
	{
		$this->send($message, 'email');
	}

	private function notifyOnPhone($message)
	{
		$this->send($message, 'телефон');
	}

	public function notify($message)
	{
		if ((($this->age ?? 0) >= 18) && ($this->phone ?? 0)) {
			$this->notifyOnPhone($message);
			$this->notifyOnEmail($message);
		} elseif (($this->age ?? 0) >= 18) {
			$this->notifyOnEmail($message);
		} elseif ((($this->age ?? 0) < 18) && ($this->phone ?? 0)) {
			$this->notifyOnPhone($this->censor($message));
			$this->notifyOnEmail($this->censor($message));
		} else {
			$this->notifyOnEmail($this->censor($message));
		}		
	}

	private function censor($message)
	{
		$badwords = ['очень', 'плохие', 'слова'];
		foreach ($badwords as $badword) {
			$message = str_replace($badword, '*цензура*', $message);
		}
		return $message;
	}

	private function send($message, $channel)
	{
		$emailOrPhone = ($channel == 'email') ? $this->email : $this->phone;
		echo "Уведомление клиенту: $this->name на $channel ($emailOrPhone): $message<br>";
	}
}



$user1 = new User('Владимир Николаевич', 'vladimir@mail.ru', 'мужской', '20', '8(858)958-22-55');
$user2 = new User('Алексей', 'aleksey@mail.ru', 'мужской', '16', '8(858)958-22-55');
$user3 = new User('Екатерина', 'ekaterina@mail.ru');
$user4 = new User('Павел', 'pavel@mail.ru', 'мужской', '18');

$user1->notify('Привет! плохие слова');
$user2->notify('Привет! плохие слова');
$user3->notify('Привет! плохие слова');
$user4->notify('Привет! плохие слова');

