<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>GIS UMKM - Login</title>
  <link rel="icon" href="img/klu.png">

  <!-- Bootstrap 5 -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <!-- Font Awesome -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
  <!-- Google Font -->
  <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;700&display=swap" rel="stylesheet">

  <style>
    body {
      background: url('images/hero1.jpg') no-repeat center center fixed;
      background-size: cover;
      font-family: 'Nunito', sans-serif;
      height: 100vh;
      display: flex;
      align-items: center;
      justify-content: center;
    }

    .card {
      background: rgba(255, 255, 255, 0.95);
      border-radius: 15px;
      padding: 2rem;
      box-shadow: 0 8px 20px rgba(0, 0, 0, 0.2);
      width: 100%;
      max-width: 420px;
    }

    .form-control {
      border-radius: 50px;
      padding: 12px 20px;
    }

    .form-group i {
      margin-right: 10px;
      color: #888;
    }

    .toggle-password {
      position: absolute;
      right: 20px;
      top: 50%;
      transform: translateY(-50%);
      cursor: pointer;
      color: #888;
    }

    .btn-primary {
      border-radius: 50px;
      padding: 10px 0;
    }

    .btn-danger {
      border-radius: 50px;
      padding: 10px 0;
    }
  </style>
</head>
<body>

<div class="card text-center">
  <h4 class="mb-4">Silakan Login</h4>

  <!-- Alert jika ada pesan -->
  <?php if (isset($_GET['pesan'])): ?>
    <div class="alert alert-success">
      <?= htmlspecialchars($_GET['pesan']) ?>
    </div>
  <?php endif; ?>

  <!-- Form Login -->
  <form method="post" action="login_cek.php">
    <div class="form-group mb-3">
      <div class="input-group">
        <span class="input-group-text"><i class="fas fa-user"></i></span>
        <input type="text" name="username" class="form-control" placeholder="Username" required>
      </div>
    </div>

    <div class="form-group mb-3 position-relative">
      <div class="input-group">
        <span class="input-group-text"><i class="fas fa-lock"></i></span>
        <input type="password" name="password" id="password" class="form-control" placeholder="Password" required>
        <span class="fa fa-eye toggle-password" id="togglePassword"></span>
      </div>
    </div>

    <div class="row mb-3">
  <div class="col-6 pe-1">
    <a href="index.php" class="btn btn-danger w-100">Kembali</a>
  </div>
  <div class="col-6 ps-1">
    <button type="submit" class="btn btn-primary w-100">Login</button>
  </div>
</div>
<div class="text-center">
  <a href="daftar_member.php" class="small">Daftar Member Baru</a>
</div>
  </form>
</div>

<!-- Bootstrap & JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
  document.getElementById('togglePassword').addEventListener('click', function () {
    const passwordField = document.getElementById('password');
    const type = passwordField.type === 'password' ? 'text' : 'password';
    passwordField.type = type;
    this.classList.toggle('fa-eye-slash');
  });
</script>
</body>
</html>
