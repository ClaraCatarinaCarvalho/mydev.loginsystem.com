<?php

include '../backend/db.php';
// falta o try
if($_SERVER['REQUEST_METHOD'] == 'POST') {
  //echo ("POST"); 
  //var_dump($_POST);
  $email = trim($_POST['email']);
  $password = trim($_POST['password']);
  //var_dump($email);

  $sql = "SELECT * FROM users WHERE email = :email";
  $stmt = $pdo->prepare($sql);
  $stmt->execute(['email' => $email]);
  $user = $stmt->fetch(PDO::FETCH_ASSOC);

  if($user && password_verify($password, $user['password'])) {
    session_start();
    $_SESSION['user_id'] = $user['id'];
    $_SESSION['is_admin'] = $user['id'] == 16 ? TRUE : FALSE;
    $_SESSION['user'] = $user;
    if($_SESSION['is_admin']){
      header('Location: /admin/index.php');
    }else{
      header('Location: /dashboard.php');
    }

    exit;
  } else {
    echo "Email ou senha inválidos.";
  }
} else {
  echo ("GET");
}
?>

<!-- HTML -->
<!DOCTYPE html>
<html>

<head>
  <title>Login</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="container mt-5">
  <h2>Login</h2>
  <form method="POST">
    <div class="mb-3">
      <label>Email</label>
      <input type="email" name="email" class="form-control" required>
    </div>
    <div class="mb-3">
      <label>Senha</label>
      <input type="password" name="password" class="form-control" required>
    </div>
    <button class="btn btn-primary">Entrar</button>
    <p class="mt-2">Ainda não tem conta? <a href="/signup.php">Registe-se</a></p>
  </form>
</body>

</html>