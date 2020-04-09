<?php
session_start();

function validate($request){

    //Array of existing users
    $existingUsers = [
        'test1@email.com',
        'test2@email.com',
        'test3@email.com',
        'test4@email.com',
        'test5@email.com',
        'test6@email.com',
        'test7@email.com',
        'test8@email.com',
        'test9@email.com',
        'test10@email.com'
    ];

    //Check array to verify if email exist
    if (in_array($request["email"], $existingUsers)) {
        return "Email already exists";
    }

    $current_date = new DateTime(date("d-m-Y"));
    $birthdate = new DateTime(
        $request["day"] . "-". 
        $request["month"] . "-" . 
        $request["year"]
    );

    $agecheck = $birthdate->diff($current_date);
    $age = $agecheck->y;

    if ($age < 18) {
        return "Sorry you must be 18 or over to register";
    }

    if ($request["password"] != $request["password2"]) {
        return "Passwords do not match";
    }

    if (!preg_match('/((?=.*\d)(?=.*[a-z])).{8,}/', $request["password"])) {
        return "Password must contain 1 letter and 1 number, and be at least 8 characters";        
    }

    return true;
}

function createUser($request)
{
    // Connect to JawsDB using Heroku
    $url = getenv('JAWSDB_URL');
    $dbparts = parse_url($url);
    $hostname = $dbparts['host'];
    $username = $dbparts['user'];
    $password = $dbparts['pass'];
    $database = ltrim($dbparts['path'],'/');

    $db = new PDO("mysql:host=$hostname;dbname=$database", $username, $password);

    //Create table if it does not exist
    $sql = "CREATE TABLE IF NOT EXISTS users (
                email varchar(128) PRIMARY KEY,
                password char(60),
                birthday date
            )";

    $db->exec($sql);
    
    //Insert user
    $sql = "INSERT INTO `users` (`email`, `password`, `birthday`) VALUES (
                :email,
                :password,
                :birthday
            )";
    
    $stmt = $db->prepare($sql);
    if (!$stmt->execute([
        'email' => $request["email"],
        'password' => password_hash($request["password"], PASSWORD_BCRYPT),
        'birthday' => $request["year"] . '-' . $request["month"] . '-' . $request["day"]
    ])) {
        return false;
    }

    return true;
}

if (validate($_POST) !== true) {
    $_SESSION["message"] = [ 'response' => 'error', 'value' => validate($_POST) ];
} elseif (createUser($_POST) !== true) {
    $_SESSION["message"] = [ 'response' => 'error', 'value' => 'Error occured during registration' ];
} else { 
    $_SESSION["message"] = [ 'response' => 'success', 'value' => 'Registration Successful' ];
}

header('Location: index.php');
