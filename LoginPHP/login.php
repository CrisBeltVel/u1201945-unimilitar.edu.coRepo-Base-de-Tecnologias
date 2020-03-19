<?php

session_start();


if (isset($_SESSION['user_id'])) {
    header('Location: /WikiA/LoginPHP');
  }

  require 'database.php';

if (!empty($_POST['nick']) && !empty($_POST['password'])) {
    $records = $conn->prepare('SELECT id, nick, password FROM users WHERE nick = :nick'); //ejecutar la consulta a la tabla user
    $records->bindParam(':nick', $_POST['nick']); 
    $records->execute();
    $results = $records->fetch(PDO::FETCH_ASSOC);

    $message = '';

    
    if (count($results) > 0 ) {
        $_SESSION['user_id'] = $results['id'];
        header("Location: /WikiA/LoginPHP");
      } else {
        $message = 'Sorry, those credentials do not match';
      }
    }
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>

<?php require 'partials/header.php' ?>

<?php if(!empty($message)): ?>
      <p> <?= $message ?></p>
    <?php endif; ?>

    <h1>Ingresa</h1>
<form action="login.php" method="POST">
      <input name="nick" type="text" placeholder="Nick">
      <input name="password" type="password" placeholder="Contraseña">
      <input type="submit" value="Login">
      <input type="submit" value="Iniciar sesión con Google">
</form>

<span>Don't have account? <a href="signup.php">REGISTER HERE</a></span>

</body>
</html>