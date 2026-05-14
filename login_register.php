<?php
session_start();
require_once "config.php";

if (isset($_POST["register"])) {
    $name = $_POST["name"];
    $email = $_POST["email"];
    $password = password_hash($_POST["password"], PASSWORD_DEFAULT);
    $role = $_POST["role"];

    $checkEmail = $conn->query("SELECT email FROM user WHERE email = '$email'");
    if ($checkEmail->num_rows > 0) {
        $_SESSION["register_error"] = "Email déjà enregistré";
        $_SESSION["active_form"] = "register";
    } else {
        $conn->query("INSERT INTO user (name, email, password, role) VALUES ('$name', '$email','$password','$role')");
        $_SESSION["register_success"] = "Inscription réussie ! Connectez-vous.";
        $_SESSION["active_form"] = "login";
    }
    header("Location: index.php");
    exit();
}

if (isset($_POST["login"])) {
    $email = $_POST["email"];
    $password = $_POST["password"];

    $result = $conn->query("SELECT * FROM user WHERE email = '$email'");

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();

        if (password_verify($password, $user['password'])) {

            $_SESSION["name"] = $user["name"];
            $_SESSION["email"] = $user["email"];
            $_SESSION["role"] = $user["role"];

            if ($user["role"] == "admin") {
                header("Location: admin_page.php");
                exit();
            } else {
                header("Location: user_page.php");
                exit();
            }
        } else {

            $_SESSION["login_error"] = "Mot de passe incorrect";
            $_SESSION["active_form"] = "login";
            header("Location: index.php");
            exit();
        }
    } else {

        $_SESSION["login_error"] = "Email non trouvé";
        $_SESSION["active_form"] = "login";
        header("Location: index.php");
        exit();
    }
}
