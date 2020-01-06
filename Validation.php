<?php

include 'autoload.php';

$success = false;
if (! empty($_POST)) {
	try {
        $user = new App\Validation\User;
        $user->load($_POST['id']);
		$success = (new App\Validation\UserFormValidation())->validate($_POST['name'], $_POST['age'], $_POST['email']);
        $user->save();
        echo $success;
	} catch (\Exception $e) {
		$error = $e->getMessage();
        echo $error;
	}
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>Форма</title>
</head>
<body>
	<form method="POST">
        <label for="id">Ваш id</label>
        <input name="id" id="id" value="<?=$_POST['id'] ?? ''?>">
        <label for="name">Имя</label>
        <input name="name" id="name" value="<?=$_POST['name'] ?? ''?>">
        <label for="age">Возраст</label>
        <input name="age" id="age"  value="<?=$_POST['age'] ?? ''?>">
        <label for="email">email</label>
        <input name="email" id="email" value="<?=$_POST['email'] ?? ''?>">
        <input type="submit" value="Войти">
    </form>
</body>
</html>