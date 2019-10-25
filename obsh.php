<?php
function createMySql(): mysqli
{
    $mysqli = new mysqli("localhost", "user2", "228jopa", "user2");
    if ($mysqli->connect_errno) {
        throw new Exception("Failed to connect to MySql(" . $mysqli->connect_errno . ")" . $mysqli->connect_errno);
    }
    return $mysqli;
}

function createUser(string $login, string $email, string $password): bool
{
    $mysqli = createMySql();
    $passwordToken = createPassword($password);
    $query = "INSERT INTO `users` (`id`, `login`, `mail`, `token`) VALUES (NULL, '$login', '$email', '$passwordToken')";
    return $mysqli->query($query);
}

function createPassword($password): string
{
    return password_hash($password, PASSWORD_BCRYPT);
}

function proverka($que)
{
    $mysqli = createMySql();
    if ($result = $mysqli->query($que)) {
        $row = $result->num_rows;
    }
    return $row;
}

function perebor($err)
{
    foreach ($err as $item)
        echo $item;
}


?>


