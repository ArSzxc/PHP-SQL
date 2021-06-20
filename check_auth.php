<?php   
$email =filter_var(trim($_POST["email"]),
FILTER_SANITIZE_STRING);
$password =filter_var(trim($_POST["password"]),
FILTER_SANITIZE_STRING);

$password = md5($password."dlyabezopasnosti");

    $mysql = new mysqli("localhost","root","root","register-bd");

    $result_auth = $mysql ->query("SELECT * FROM `users` WHERE `email` = '$email' AND `password` = '$password'");
    $user = $result_auth->fetch_assoc();

    if(count($user) == 0){
        echo "Пользователь не найден"."<br>".'<a href="/">BACK</a>';
        exit();
    };

    setcookie("user", $user["email"],time() + 5000,"/");
    echo "Здраствуйте, $email"."<br>".'<a href="/">BACK</a>';
    exit();

    $mysql->close();
    header("Location:index.html")
?>