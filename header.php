<!DOCTYPE html>
<html lang="zxx" class="no-js">

<head>
    <!-- Mobile Specific Meta -->
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Favicon-->
    <link rel="shortcut icon" href="img/fav.png">
    <!-- Author Meta -->
    <meta name="author" content="colorlib">
    <!-- Meta Description -->
    <meta name="description" content="">
    <!-- Meta Keyword -->
    <meta name="keywords" content="">
    <!-- meta character set -->
    <meta charset="UTF-8">
    <!-- Site Title --><!DOCTYPE html>
<html lang="id" class="no-js">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="author" content="UMKM Desa Pemenang Barat">
    <meta name="description" content="Sistem Informasi Geografis UMKM Desa Pemenang Barat - Lombok Utara">
    <meta name="keywords" content="UMKM, Desa Pemenang Barat, Lombok Utara, SIG, Sistem Informasi Geografis">
    
    <title>SIG UMKM DESA PEMENANG BARAT</title>
    <link rel="icon" href="img/klu.png">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <!--
			CSS
			============================================= -->
    <link href="assets/css/style.css" rel="stylesheet">
    <link rel="stylesheet" href="travelista-master/css/linearicons.css">
    <link rel="stylesheet" href="travelista-master/css/font-awesome.min.css">
    <link rel="stylesheet" href="travelista-master/css/bootstrap.css">
    <link rel="stylesheet" href="travelista-master/css/magnific-popup.css">
    <link rel="stylesheet" href="travelista-master/css/jquery-ui.css">
    <link rel="stylesheet" href="travelista-master/css/nice-select.css">
    <link rel="stylesheet" href="travelista-master/css/animate.min.css">
    <link rel="stylesheet" href="travelista-master/css/owl.carousel.css">
    <link rel="stylesheet" href="travelista-master/css/main.css">
    <script src="//ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Poppins', sans-serif;
            line-height: 1.6;
        }

        /* Header Styles */


        .main-header {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
            position: sticky;
            top: 0;
            z-index: 1000;
            transition: all 0.3s ease;
        }

        .main-header.scrolled {
            background: rgba(255, 255, 255, 0.98);
            box-shadow: 0 6px 30px rgba(0, 0, 0, 0.15);
        }

        .navbar-brand {
            display: flex;
            align-items: center;
            gap: 20px;
            font-weight: 700;
            color: #333 !important;
            text-decoration: none;
            font-size: 1.2rem;
            transition: all 0.3s ease;
            
        }

        .navbar-brand:hover {
            color: #0056b3 !important;
            transition: all 0.3s ease;
        }

        .navbar-brand img {
            width: 60px;
            height: 60px;
            border-radius: 50%;
            border: 3px solid #0056b3;
            transition: all 0.3s ease;
        }

        .navbar-brand:hover img {
            border-color: #0056b3;
            transform: rotate(360deg);
        }

        .navbar-brand .brand-text {
            display: flex;
            flex-direction: column;
            line-height: 1.2;
        }

        .navbar-brand .brand-text .main-title {
            font-size: 1.1rem;
            font-weight: 700;
            color: #333;
        }

        .navbar-brand .brand-text .sub-title {
            font-size: 0.8rem;
            color: #666;
            font-weight: 700;
        }

        .navbar-nav .nav-link {
            color: #333 !important;
            font-weight: 600;
            padding: 6px 12px !important;
            margin: 0 5px;
            border-radius: 25px;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
            gap: 8px;
        }

        .navbar-nav .nav-link::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(135deg, #0056b3, #00b7eb);
            transition: all 0.3s ease;
            z-index: -1;
    
        }

        .navbar-nav .nav-link:hover::before {
            left: 0;
        }

        .navbar-nav .nav-link:hover {
            color: white !important;
            transform: translateY(-2px);
        }

        .navbar-nav .nav-link.active {
            background: linear-gradient(135deg, #0056b3, #00b7eb);
            color: white !important;
        }

        .contact-btn {
            color: #333 !important;
            border: none;
            padding: 5px 10px;
            border-radius: 25px;
            font-weight: 600;
            text-decoration: none;
            transition: all 0.3s ease;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            margin-left: 10px;
        }

        .contact-btn:hover {
            background: linear-gradient(135deg, #20c997 0%, #28a745 100%);
            color: white !important;
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(40, 167, 69, 0.3);
        }

        .login-btn {
            color: #333 !important;
            border: none;
            padding: 5px 10px;
            border-radius: 25px;
            font-weight: 600;
            text-decoration: none;
            transition: all 0.3s ease;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            margin-left: 10px;
        }

        .login-btn:hover {
            background: linear-gradient(135deg, #ee5a52 0%, #ff6b6b 100%);
            color: white !important;
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(255, 107, 107, 0.3);
        }

        /* Mobile Responsiveness */
        @media (max-width: 991px) {
            .navbar-brand .brand-text .main-title {
                font-size: 1rem;
            }
            
            .navbar-brand .brand-text .sub-title {
                font-size: 0.7rem;
            }
            
            .navbar-brand img {
                width: 40px;
                height: 40px;
            }
            
            .contact-btn, .login-btn {
                margin: 10px 0;
                justify-content: center;
            }
        }

        @media (max-width: 576px) {
            .header-top {
                display: none;
            }
            
            .navbar-brand .brand-text .main-title {
                font-size: 0.9rem;
            }
            
            .navbar-brand .brand-text .sub-title {
                display: none;
            }
        }

        /* Smooth scrolling */
        html {
            scroll-behavior: smooth;
        }

        /* Animation keyframes */
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .animate-fadein {
            animation: fadeInUp 0.6s ease-out;
        }
    </style>
</head>

<body>


    <!-- Main Header -->
    <header class="main-header p-1">
        <nav class="navbar navbar-expand-lg navbar-light">
            <div class="container">
                <!-- Brand -->
                <a class="navbar-brand d-flex animate-fadein" href="index.php">
                    <img src="img/klu.png" alt="Logo UMKM Desa Pemenang Barat" class="img-fluid">
                    <div class="brand-text">
                        <span class="main-title">UMKM DESA PEMENANG BARAT</span>
                    </div>
                </a>

                <!-- Mobile Toggle Button -->
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" 
                        aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <!-- Navigation Menu -->
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav ms-auto align-items-center">
                        <li class="nav-item">
                            <a class="nav-link active" href="index.php">
                                <i class="fas fa-home me-2"></i>Home
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="data_umkm.php">
                                <i class="fas fa-store me-2"></i>UMKM
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="maps.php">
                                <i class="fas fa-map me-2"></i>Maps
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="faq.php">
                                <i class="fas fa-question-circle me-2"></i>FAQ
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="https://wa.me/+6287862238625?text=Hai%20Admin" target="_blank" class="contact-btn">
                                <i class="fab fa-whatsapp"></i>
                                Kontak Kami
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="login.php" class="login-btn">
                                <i class="fas fa-sign-in-alt"></i>
                                Login
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <!-- Custom JavaScript -->
    <script>
        // Header scroll effect
        window.addEventListener('scroll', function() {
            const header = document.querySelector('.main-header');
            if (window.scrollY > 50) {
                header.classList.add('scrolled');
            } else {
                header.classList.remove('scrolled');
            }
        });

        // Set active menu item based on current page
        document.addEventListener('DOMContentLoaded', function() {
            const currentPage = window.location.pathname.split('/').pop();
            const navLinks = document.querySelectorAll('.nav-link');
            
            navLinks.forEach(link => {
                link.classList.remove('active');
                const href = link.getAttribute('href');
                if (href === currentPage || (currentPage === '' && href === 'index.php')) {
                    link.classList.add('active');
                }
            });
        });

        // Smooth scrolling for anchor links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    target.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                }
            });
        });
    </script>

  
</body>
<!-- Google Maps (pindahkan ke bawah body jika pakai async defer) -->
<script src="https://maps.googleapis.com/maps/api/js?key=YOUR_API_KEY&callback=initMap" async defer></script>

</html>