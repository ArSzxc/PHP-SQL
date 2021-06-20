<?php
    $email =filter_var(trim($_POST["email"]),
    FILTER_SANITIZE_STRING);
    $password =filter_var(trim($_POST["password"]),
    FILTER_SANITIZE_STRING);
    $repeat_password = filter_var(trim($_POST["password_repeat"]),
    FILTER_SANITIZE_STRING);

    if(mb_strlen($email) < 8 || mb_strlen($email) > 90){
        echo "Недопустимая длина символов"."<br>".'<a href="/">BACK</a>';
        exit();
    }else if($password != $repeat_password){
        echo "Пароли не совпадают"."<br>".'<a href="register.html">BACK</a>';
        exit();
    }else if(mb_strlen($password) < 3){
        echo "Не корректная длина пароля"."<br>".'<a href="register.html">BACK</a>';
        exit();
    }

    $password = md5($password."dlyabezopasnosti");

    $mysql = new mysqli("localhost","root","root","register-bd");
    $mysql ->query("INSERT INTO `users`(`email`,`password`) 
    VALUES('$email','$password')");
    $mysql->close();

    header("Location:index.html")
?>