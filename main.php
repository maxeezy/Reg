<?php
session_start();
echo "<link rel=\"stylesheet\" href=\"st.css\">";
if (isset($_SESSION['logged_user'])) {
    $user = $_SESSION['logged_user'];
    echo "<div class=\"wrap\" style='color: white'>
<div>Вы зашли как . \"".$user['login'] . "\"
</div>
<button class='button'><a href='logout.php'>Выйти</a></button>
</div>";

} else {
    echo "<div class=\"wrap\">
    <button class='button'><a href=\"reg.php\">Регистрация</a></button>
    <button class='button'><a href=\"log.php\">Вход</a></button>
</div>";
}
?>


