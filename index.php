<?php require_once "./config.php"; ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Radja Geprek</title>
    <link rel="icon" href="assets/items/logo.png" type="image/png">

    <link href="assets/css/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css"> -->
    <link rel="stylesheet" href="assets/css/fontawesome/css/all.min.css">
    <link rel="stylesheet" href="assets/css/style.css">
</head>

<body>

    <!-- Navbar -->
    <header>
        <nav class="navbar navbar-expand-lg">
            <div class="container">
                <a class="navbar-brand" href="index.php">
                    Radja Geprek
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <div class="ms-auto">
                        <a href="login.php" class="btn btn-outline-light btn-login">Masuk</a>
                        <a href="register.php" class="btn btn-light btn-signup">Daftar</a>
                    </div>
                </div>
            </div>
        </nav>
    </header>

    <!-- Header Section -->
    <header class="text-center position-relative container" style="margin-top: 60px;">
        <div class="banner-wrapper position-relative overflow-hidden">
            <div class="banner-wrapper position-relative overflow-hidden">
                <img src="assets/items/banner.png" alt="Banner Toko" class="img-fluid w-100 banner-image">
            </div>
            <div class="overlay position-absolute top-0 start-0 w-100 h-100">

                <div class="container position-absolute top-50 start-50 translate-middle text-center text-white px-3 shadow-lg p-4 rounded">
                    </h1>
                    </p>
                    <a href="login.php" class="btn btn-primary btn-lg rounded-pill shadow fw-bold" style="animation: bounceIn 1.5s ease-out;">
                            Belanja Sekarang
                        </a>
                </div>
            </div>
        </div>

        <!-- Header Content -->
    </header>

    <!-- Featured Products Section -->
    <section class="container py-5">
        <div class="">
            <h2 class="text-center mb-4 sticky-header" style="background-color: #fafafa;">Produk Unggulan</h2>
            <div class="underline"></div>
            <div class="row">
                <!-- Product Cards -->
                 <?php
                $sql = "SELECT * FROM prodact";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) { ?>
                        <div class="col-6 col-md-4 col-lg-2 mb-4">
                            <div class="card w-100">
                                <div class="text-center">
                                    <img src="assets/<?= htmlspecialchars($row['gambar']) ?>" class="card-img-top img-fluid" alt="">
                                </div>
                                <div class="card-body">
                                    <h5 class="card-title"><?= $row['nama_barang'] ?></h5>
                                </div>
                            </div>
                            <a href="login.php" class="btn btn-success w-100 mt-2" style="margin-top: 7px; margin-bottom: 5px;">Lihat
                                    Selengkapnya</a>
                        </div> <?php
                    }
                    
                }
                 ?> 
            </div>
        </div>
    </section>
    <!-- Footer -->
    <footer class="pt-5 pb-4">
        <div class="container">
            <div class="col-md-3 col-lg-3 col-xl-3 mx-auto mt-3">
                <h5 class="text-uppercase mb-4 font-weight-bold">Radja Geprek
                </h5>
                <p>Warung makan terpercaya, dengan varian masakan yang lezat, selalu menjadi pilihan favorit bagi banyak orang yang mencari hidangan enak dengan harga terjangkau. Dengan berbagai menu yang disajikan, mulai dari masakan tradisional hingga modern, setiap pelanggan dapat menemukan sesuatu yang sesuai dengan selera mereka.</p>
            </div>

            <div class="col-md-2 col-lg-2 col-xl-2 mx-auto mt-3">
                <h5 class="text-uppercase mb-4 font-weight-bold">Pembayaran</h5>
                <ul class="list-unstyled">
                    <li>><b>COD</b></li>
                    <li><img src="assets/items/Dana.jpg" alt="Dana" class="payment-img"></li>
                    <li><img src="assets/items/Transfer_bank.jpg" alt="Transfer_bank" class="payment-img"></li>
                    <li><img src="assets/items/Gopay.jpg" alt="Gopay" class="payment-img"></li>
                </ul>
            </div>

            <div class="col-md-3 col-lg-3 col-xl-3 mx-auto mt-3">
                <h5 class="text-uppercase mb-4 font-weight-bold">Layanan Pelanggan
                </h5>
                <p><a href="contact.php" class style="text-decoration: none; color: #272727;"><b>Hubungi
                Kami</b></a></p>
                <p><a href="#" class style="text-decoration: none; color: #272727;"><b>Pertanyaan
                Umum</b></a></p>
                <p><a href="#" class style="text-decoration: none; color: #272727;"><b>Kebijakan
                Pengembalian</b></a></p>
                <p><a href="#" class style="text-decoration: none; color: #272727;"><b>Kebijakan
                Privasi</b></a></p>
            </div>

            <div class="col-md-2 col-lg-2 col-xl-2 mx-auto mt-3">
                <h5 class="text-uppercase mb-4 font-weight-bold">Ikuti Kami
                </h5>
                <ul class="list-unstyled">
                    <li><a href="#" class style="text-decoration: none; color: #272727;"><i
                                    class="fab fa-facebook fa-lg me-2"></i>Facebook</a></li>
                    <li><a href="#" class style="text-decoration: none; color: #272727;"><i
                                    class="fab fa-instagram fa-lg me-2"></i>Instagram</a></li>
                    <li><a href="#" class style="text-decoration: none; color: #272727;"><i
                                    class="fab fa-twitter fa-lg me-2"></i>Twitter</a></li>
                </ul>
            </div>

            <div class="col-md-2 col-lg-2 col-xl-2 mx-auto mt-3">
                <h5 class="text-uppercase mb-4 font-weight-bold">Pengiriman</h5>
                <ul class="list-unstyled">
                    <li>Go Food</li>
                    <li>Grab Food</li>
                    <li>Shopee Food</li>
                </ul>
            </div>
        </div>

        <div class="row align-items-center" style="margin-bottom: 12px;">
            <div class="col-md-12 col-lg-12">
                <p class="text-center mt-4">&copy; 2024 Radja Geprek. All Rights Reserved.</p>
            </div>
        </div>
        <div class="row align-items-center" style="margin-top: 20px;">
            <div class="col-md-12 col-lg-12 text-center">
                <p><strong>Lokasi Toko:</strong> <a href="https://maps.app.goo.gl/aEDsW4RV3VkzrGJX6" target="_blank" style="text-decoration: none; color: #272727;">Klik
                            di sini untuk melihat di Google Maps</a></p>
            </div>
        </div>
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>