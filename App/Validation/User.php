<?php

namespace App\Validation;

class User
{
	public function load($id)
	{
		if ($id > 10) {
			throw new \Exception("id не найден в базе данных");
		}	
	}

	public function save()
	{
		if (rand(0, 1)) {
			throw new \Exception("Не удалось сохранить пользователя в базе данных");
		}
	}
}