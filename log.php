<?php
session_start();
require "obsh.php";
$err = [];
if (isset($_POST['butt'])) {
    if (empty($_POST['login'])) {
        $err[] = "<div style='color: red'>Не введены данные в поле логин</div>";
    }
    if (empty($_POST['password'])) {
        $err[] = "<div style='color: red'>Не введены данные в поле пороль</div>";
    }
    if (proverka("SELECT * FROM `users` WHERE `login`=" . "\"" . $_POST['login'] . "\"") > 0) {
        $res = createMySql()->query("SELECT * FROM `users` WHERE `login`=" . "\"" . $_POST['login'] . "\"");
        $us = $res->fetch_assoc();
        //$zP= "SELECT 'token' FROM `users` WHERE `login` =" . "\"" . $_POST['login'] . "\"";
        if(password_verify($_POST['password'],$us['token'])){

            $_SESSION['logged_user']=$us;
            $err[] = "<div style='color: green;margin-top: 30px;margin-bottom: 10px'>Вы  авторизованы.</div>";
            $err[] = "<button class='button'><a href=\"main.php\">Перейти на главную</a></button>" . "<br>";
        }
        else {
            $err[] = "<div style='color: red'>Неверный пороль</div>";
        }
    }
    else{
        $err[] = "<div style='color: red'>Пользователя с таким логином не существует</div>";
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
<form action="log.php" method="POST">
    <div class="wrap">
        <div class="text"></div>
        <input type="text" name="login" placeholder="Введите логин">
        <input type="password" name="password" placeholder="Введите пароль">
        <input type="submit" name="butt" class="button">
        <div class="field"><?php perebor($err);?></div>
    </div>
</form>
</body>
</html>
