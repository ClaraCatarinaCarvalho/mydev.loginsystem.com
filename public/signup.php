<?php

include '../backend/db.php';
include '../backend/send_email.php';

if($_SERVER['REQUEST_METHOD'] == 'POST') {
  //echo ("POST"); 
  //var_dump($_POST);
  $email = trim($_POST['email']);
  var_dump($email);

  $sqlInsert = "INSERT INTO users (email) VALUES (:email)";
  $stmt = $pdo->prepare($sqlInsert);
  $stmt->execute(['email' => $email]);
  // Apanhar o ultimo id inserido
  $userId = $pdo->lastInsertId();
  $token = bin2hex(random_bytes(16));

  $expires = date('Y-m-d H:i:s', time() + 600);
  $sqlInsertToken = "INSERT INTO signup_tokens (user_id, token, expires_at) VALUES (:user_id, :token, :expires)";
  $stmt = $pdo->prepare($sqlInsertToken);
  $stmt->execute(['user_id' => $userId, 'token' => $token, 'expires' => $expires]);

  // Enviar email
  sendVerificationEmail($email, $token);
  echo "Verifique o seu email";

}else {
  echo ("GET");
}

?>


<!-- HTML -->
<!DOCTYPE html>
<html lang="pt">

<head>
  <title>Signup</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="container mt-5">
  <h2>Registre-se</h2>
  <form method="POST">
    <div class="mb-3">
      <label>Email</label>
      <input type="email" name="email" class="form-control" required>
    </div>
    <button type="submit" class="btn btn-primary">Registar</button>
    <p class="mt-2">Já tem conta? <a href="login.php">Login</a></p>
  </form>
</body>

</html>