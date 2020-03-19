<?php
  require 'database.php';
  $message ='';


  if (!empty($_POST['email']) && !empty($_POST['nick']) && !empty($_POST['password'])) {
//inserta dentro de la tabla los valores de las variables :email y :pass en donde se remplazaran los valores          
    $sql = "INSERT INTO users (email, nick,password, age, gender) VALUES (:email, :nick,:password, :age, :gender)";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':email', $_POST['email']);
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
    $stmt->bindParam(':password', $password);

    $stmt->bindParam(':nick', $_POST['nick']);
    $stmt->bindParam(':age', $_POST['age']);
    $stmt->bindParam(':gender', $_POST['gender']);

    if ($stmt->execute()) {
      $message = 'Successfully created new user';
    } else {
      $message = 'Sorry there must have been an issue creating your account';
    }
  }


?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro</title>
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
<?php require 'partials/header.php' ?>
  <?php if(!empty($message)): ?>
      <p> <?= $message ?></p>
    <?php endif; ?>

<h1>Registrate</h1>
    <span>Have account? <a href="login.php">Login</a></span>
    
    <form action="signup.php" method="POST">
      <input name="email" type="text" placeholder="Ingresa tu correo">
      <input name="nick" type="text" placeholder="Ingresa tu Nick">
      <input name="password" type="password" placeholder="Ingresa tu contraseña">
      <input name="confirm_password" type="password" placeholder="Confirma tu contraseña">
      <input name="age" type="number" placeholder="Ingresa tu edad" min="14" max="100">
     
      <input type="radio" id="male" name="gender" value="male">
      <label for="male">Male</label><br>
      <input type="radio" id="female" name="gender" value="female">
      <label for="female">Female</label><br>
      <input type="submit" value="Restrarse">

    </form>

    
</body>
</html>