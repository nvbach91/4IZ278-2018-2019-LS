<?php

function fetch_Users()
{
    $records = file('./users.db');
    $users = [];
    foreach ($records as $record) {
        $fields = explode(';', $record);
        $users[$fields[1]] = [
            'name' => $fields[0],
            'email' => $fields[1],
            'password' => $fields[2],
        ];
    }
    return $users;
}

function fetch_User($users, $email)
{
    $user = $users[$email];
        if (! empty($user)) {
            return $user;
        }

    return null;
}

function registerNewUser($person)
{

    $fetch = fetch_User(fetch_Users(), $person['email']);
    if ($fetch == null) {
        echo "test";
        $record = implode(";", $person);
        file_put_contents('./users.db', $record .";". "\n", FILE_APPEND);

        header("Location: login.php?email=" . $person['email']);
        die();
    } else {
        return false;
    }

}
function authenticate($email,$password)
{

    $fetch = fetch_User(fetch_Users(), $email);
    if ($fetch == null) {
        echo "<div class=\"alert alert-warning text-center\" role=\"alert\">\"This user doesn't exist\"</div>";
    } else {
        if($fetch['password']==$password){
            echo "<div class=\"alert alert-success text-center\" role=\"alert\">\"You have successfully logged in\"</div>";
        } else{
            echo "<div class=\"alert alert-warning text-center\" role=\"alert\">\"Incorrect password\"</div>";
        }

    }

}