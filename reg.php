<?php
require "obsh.php";
$err = [];

if (isset($_POST['butt'])) {
    $err = [];
    if (empty($_POST['login'])) {
        $err[] = "<div style='color: red'>Не введены данные в поле логин</div>";
    }
    if (empty($_POST['mail'])) {
        $err[] = "<div style='color: red'>Не введены данные в поле мэйл</div>";
    }
    if (empty($_POST['password'])) {
        $err[] = "<div style='color: red'>Не введены данные в поле пороль</div>";
    }
    if (proverka("SELECT * FROM `users` WHERE `login`=" . "\"" . $_POST['login'] . "\"")>0){
       $err[] = "<div style='color: red'>Пользователь с таким логином уже существует</div>";
    }
    if (proverka("SELECT * FROM `users` WHERE `mail`=" . "\"" . $_POST['mail'] . "\"")>0){
        $err[] = "<div style='color: red'>Пользователь с таким мэйлом уже существует</div>";
    }


    if (empty($err)){
        $err = [];
        $login = $_POST['login'];
        $mail = $_POST['mail'];
        $password = $_POST['password'];
        createUser($login, $mail, $password);
        $err[] = "<div style='color: green;margin-top: 30px;margin-bottom: 10px'>Вы зарегестрированы. Можете залогинится</div>";
        $err[] = "<button class='button'><a href=\"main.php\">Перейти на главную</a></button>" . "<br>";
    }

}
?>
<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="st.css">
</head>
<body>

<form action="reg.php" method="POST">
    <div class="wrap">
        <div class="text"></div>
        <input type="text" name="login" placeholder="Введите логин">
        <input type="text" name="mail" placeholder="Введите mail ">
        <input type="password" name="password" placeholder="Введите пароль">
        <input type="submit" name="butt" class="button">
        <div class="field"><?php perebor($err); ?></div>

    </div>
</form>

</body>
</html>
