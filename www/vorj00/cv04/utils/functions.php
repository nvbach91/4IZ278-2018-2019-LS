<?php
$dbPath = './database/users.db';
$usersList = file($dbPath);

function fetchUsers($email)
{
    global $usersList;

    foreach ($usersList as $user) {
        $fields = explode(';', $user);
        $record = [
            'name' => $fields[0],
            'email' => $fields[1],
            'password' => $fields[2],
        ];

        if ($email == $record['email']) {
            return $record;
        }
    }

    return null;
}

function registerNewUser($name, $email, $password)
{
    global $dbPath;
    global $usersList;

    $fetchSuccess = fetchUsers($email);

    if (!$fetchSuccess) {
        $dbRecord = "$name;$email;$password;\n";
        file_put_contents($dbPath, $dbRecord, FILE_APPEND);
        header("Location: login.php?email=$email");
        mail($email,"Registration successful!","Yeah!");
        return true;
    } else {
        return false;
    }
}

function authenticate($email, $password){
    $record = fetchUsers($email);
    
    if ($record && $password == $record['password']) {
        header("Location: profile.php?email=$email");
    }

    return false;
}