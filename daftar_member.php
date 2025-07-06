<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>GIS WISATA LOMBOK UTARA - DAFTAR MEMBER</title>
    <link rel="icon" href="img/klu.png">

    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
    
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,300,400,600,700,800,900" rel="stylesheet">

    <style>
        body {
            background: url('images/hero1.jpg') no-repeat center center fixed;
      background-size: cover;
            font-family: 'Nunito', sans-serif;
        }
        .card {
            border-radius: 1rem;
        }
        .password-container {
            position: relative;
        }
        .password-container i {
            position: absolute;
            top: 50%;
            right: 1rem;
            transform: translateY(-50%);
            cursor: pointer;
        }
    </style>
</head>

<body>

    <div class="container">
        <div class="row justify-content-center align-items-center vh-100">
            <div class="col-md-6 col-lg-5">
                <div class="card shadow p-4">
                    <div class="text-center mb-4">
                        <h4 class="text-primary">Daftar Member Baru</h4>
                    </div>
                    <form method="post" action="daftar_member_cek.php" enctype="multipart/form-data">
                        <div class="mb-3">
                            <input type="text" class="form-control" name="nama_lengkap" placeholder="Nama Lengkap" required>
                        </div>
                        <div class="mb-3">
                            <input type="text" class="form-control" name="username" placeholder="Username" required>
                        </div>
                        <div class="mb-3 password-container">
                            <input type="password" id="password" class="form-control" name="password" placeholder="Password" required>
                            <i class="fas fa-eye" id="togglePassword"></i>
                        </div>
                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary">Daftar</button>
                        </div>
                    </form>
                    <hr>
                    <div class="text-center">
                        <a class="small text-decoration-none" href="login.php">Sudah punya akun? Login di sini</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS and dependencies -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        const togglePassword = document.getElementById('togglePassword');
        const password = document.getElementById('password');

        togglePassword.addEventListener('click', function () {
            const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
            password.setAttribute('type', type);
            this.classList.toggle('fa-eye-slash');
        });
    </script>
</body>

</html>
