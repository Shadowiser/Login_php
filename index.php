<?php

session_start();

$errors = [
  "login" => $_SESSION["login_error"] ?? "",
  "register" => $_SESSION["register_error"] ?? ""
];
$activeForm = $_SESSION["active_form"] ?? "login";
session_unset();
function showError($error)
{
  return !empty($error) ? "<p class='error-message'>$error</p>" : "";
}
?>


<!doctype html>
<html lang="fr">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Accueil</title>
  <link rel="stylesheet" href="style.css" />
</head>

<body>
  <div class="container">
    <div class="form-box active" id="login-form">
      <form action="login_register.php" method="post">
        <h2>Connexion</h2>
        <input type="email" name="email" placeholder="Mettez votre email" />
        <input
          type="password"
          name="password"
          placeholder="Mettez votre mot de passe" />
        <button type="submit" name="login">Connexion</button>
      </form>
      <p>
        Pas de compte ?
        <a href="#" onclick="showForm('register-form')">Enregistrer-vous</a>
      </p>
    </div>
    <div class="form-box" id="register-form">
      <form action="login_register.php" method="post">
        <h2>Enregistrement</h2>
        <input type="text" required name="name" placeholder="Mettez votre nom" />
        <input type="email" required name="email" placeholder="Mettez votre email" />
        <input
          type="password"
          required name="password"
          placeholder="Mettez votre mot de passe" />
        <select required name="role">
          <option value="">--Choisissez votre rôle--</option>
          <option value="user">Utilisateur</option>
          <option value="admin">Administrateur</option>
        </select>
        <button type="submit" name="register">Enregistrer</button>
      </form>
      <p>
        Déjà un compte ?
        <a href="#" onclick="showForm('login-form')">Connectez-vous</a>
      </p>
    </div>
  </div>
  <script src="main.js"></script>
</body>

</html>