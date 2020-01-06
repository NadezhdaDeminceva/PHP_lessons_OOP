<?php

namespace App\Validation;

class UserFormValidation
{
	public function validate($name, $age, $email)
	{
		if (empty($_POST['name']) || empty($_POST['age']) || empty($_POST['email'])) {
			throw new \Exception("Все поля должны быть заполнены");
		}
		if ($_POST['age'] < 18) {
			throw new \Exception("Возраст должен быть не менее 18 лет");
		}
		if (! filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
			throw new \Exception("email не соответствует формату");
		}
		return "Данные успешно изменены";
	}
}