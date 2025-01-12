<?php require_once "./config.php"; 
session_start(); // Pastikan session dimulai
if (isset($_GET['message'])) {
    echo '<div class="alert alert-success">' . htmlspecialchars($_GET['message']) . '</div>';
}


// Periksa apakah user sudah login
if (!isset($_SESSION['user_id'])) {
    // Jika belum login, arahkan ke halaman login
    header("Location: login.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <title>About Toko Nurul SRC</title> -->
    <link rel="icon" href="assets/items/logo.png" type="image/png">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="./assets/fontawesome-free-6.6.0-web/css/all.min.css">
    <link rel="stylesheet" href="./assets/css/style.css">
</head>

<body>
    <header>
        <nav class="navbar navbar-expand-lg">
            <div class="container">
                <a style="height: 50px;" class="navbar-brand" href="index.php">
                 Radja Geprek
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav ms-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="index.php">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" href="belanja.php">Belanja</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="komentar.php">Komentar</a>
                        </li>
                        <div class="collapse navbar-collapse" id="navbarContent">
                            <ul class="navbar-nav ms-auto">
                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-bs-toggle="dropdown">
                                        <i class="fas fa-user"></i></i>
                                        <?= $_SESSION['username']; ?>
                                    </a>
                                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
                                        <li><a class="dropdown-item" href="./proses/akun_setting.php"><i class="fas fa-cog"></i> Pengaturan Akun</a></li>
                                        <li><a class="dropdown-item" href="logout.php"><i class="fas fa-sign-out-alt"></i> Logout</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                    </ul>
                </div>
            </div>
        </nav>
    </header>
    <div class="container">
        <!-- Bagian Tentang Kami -->
        <section class="py-5" style="background-color: #fdfdfd;">
            <h1 class="text-center" style="box-shadow: 0 3px #f57224; color: #f57224; padding: 10px;">Tentang Kami
            </h1>
            <p>Warung makan terpercaya, dengan varian masakan yang lezat, selalu menjadi pilihan favorit bagi banyak orang yang mencari hidangan enak dengan harga terjangkau. Dengan berbagai menu yang disajikan, mulai dari masakan tradisional hingga modern, setiap pelanggan dapat menemukan sesuatu yang sesuai dengan selera mereka. Warung ini tidak hanya dikenal karena rasa masakannya yang autentik, tetapi juga karena pelayanan yang ramah dan suasana yang nyaman. Setiap hidangan disiapkan dengan bahan-bahan segar dan bumbu pilihan, menjamin kualitas rasa yang konsisten.</p> <p>Selain itu, warung makan ini juga menawarkan berbagai paket makan yang ekonomis, cocok untuk dinikmati bersama keluarga atau teman. Tidak heran jika warung makan terpercaya ini selalu ramai dikunjungi, baik oleh penduduk lokal maupun wisatawan yang ingin mencicipi cita rasa khas daerah. Kebersihan tempat dan perhatian terhadap detail dalam penyajian makanan membuat pelanggan merasa puas dan ingin kembali lagi. Jadi, jika Anda sedang mencari tempat makan yang dapat dipercaya dengan varian masakan yang lezat, warung ini adalah pilihan yang tepat.</p>
        </section>
    </div>

    <script src="script/script.js"></script>
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
                <p><a href="contact.php" class style="text-decoration: none; color: #272727;">Hubungi
                            Kami</a></p>
                <p><a href="#" class style="text-decoration: none; color: #272727;">Pertanyaan
                            Umum</a></p>
                <p><a href="#" class style="text-decoration: none; color: #272727;">Kebijakan
                            Pengembalian</a></p>
                <p><a href="#" class style="text-decoration: none; color: #272727;">Kebijakan
                            Privasi</a></p>
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
    <script src="./assets/fontawesome-free-6.6.0-web/js/all.min.js"></script>
</body>

</html>