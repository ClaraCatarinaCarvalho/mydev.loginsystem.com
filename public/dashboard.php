<?php 

session_start();
if(!isset($_SESSION['user_id'])) {
  header('Location: /login.php');
  exit;
}
?>
<?php include '../backend/includes/header.php'; ?>
<?php include '../backend/includes/sidebar.php'; ?>

<div class="container mt-4">
  <h1>Dashboard</h1>
  <p>Bem-vindo ao painel de administração.</p>

  <div class="row">
    <div class="col-md-4">
      <div class="card text-white bg-primary mb-3">
        <div class="card-body">
          <h5 class="card-title">Utilizadores</h5>
          <p class="card-text">42 ativos</p>
        </div>
      </div>
    </div>
    <div class="col-md-4">
      <div class="card text-white bg-success mb-3">
        <div class="card-body">
          <h5 class="card-title">Vendas</h5>
          <p class="card-text">5.200€ este mês</p>
        </div>
      </div>
    </div>
  </div>
</div>
<script>
  <?php if (isset($_SESSION['toastr'])): ?>
    toastr.<?= $_SESSION['toastr']['type'] ?>("<?= $_SESSION['toastr']['message'] ?>");
    <?php unset($_SESSION['toastr']); ?>
  <?php endif; ?>
</script>
<?php include '../backend/includes/footer.php'; ?>