<?php
// Mulai sesi
session_start();

// Koneksi ke database
$servername = "localhost";
$username = "root"; // Ganti dengan username database Anda
$password = ""; // Ganti dengan password database Anda
$dbname = "toko_royal"; // Ganti dengan nama database Anda

// Membuat koneksi
$conn = new mysqli($servername, $username, $password, $dbname);

// Cek koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Fungsi untuk mendapatkan daftar kategori
function getCategoriesEnum() {
    global $conn;
    
    // Query untuk mendapatkan definisi enum
    $sql = "SHOW COLUMNS FROM prodact LIKE 'kategori'";
    $result = $conn->query($sql);
    
    if ($result) {
        $row = $result->fetch_assoc();
        // Ekstrak nilai enum dari definisi kolom
        preg_match("/^enum\(\'(.*)\'\)$/", $row['Type'], $matches);
        $enumValues = explode("','", $matches[1]);
        
        return $enumValues;
    } else {
        return [];
    }
}


// Cek apakah user sudah login
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

// Dapatkan daftar kategori
$categories = getCategoriesEnum();

// Ambil user_id dari sesi
$user_id = $_SESSION['user_id'];
?>

<!DOCTYPE html>
<html lang="en"
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Radja Geprek</title>
    <link rel="icon" href="assets/items/logo.png" type="image/png">

    <link href="assets/css/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="./assets/fontawesome-free-6.6.0-web/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="./assets/css/style.css">
</head>
<style>
    .banner-wrapper {
        height: 300px; /* Menetapkan tinggi default untuk layar yang lebih besar */
    }

    @media (max-width: 768px) {
        .banner-wrapper {
            height: 200px; /* Mengurangi tinggi untuk layar lebih kecil */
        }

        .container {
            font-size: 14px; /* Mengurangi ukuran teks pada layar kecil */
        }

        h1.display-5 {
            font-size: 1.5rem; /* Mengurangi ukuran judul pada layar kecil */
        }

        .lead {
            font-size: 1rem; /* Mengurangi ukuran teks deskripsi pada layar kecil */
        }
    }

    @media (max-width: 576px) {
        .banner-wrapper {
            height: 150px; /* Mengurangi lebih jauh tinggi pada layar yang sangat kecil */
        }

        h1.display-5 {
            font-size: 1.2rem; /* Menyesuaikan ukuran judul lebih kecil lagi */
        }

        .lead {
            font-size: 0.9rem; /* Menyesuaikan ukuran teks deskripsi lebih kecil lagi */
        }
    }
    /* Menyesuaikan ikon pengguna */
.bi-person-circle {
    font-size: 1.8rem;  /* Ukuran ikon */
    margin-right: 8px;  /* Memberikan jarak dengan teks */
}

/* Menyesuaikan dropdown */
.navbar-nav .dropdown-menu {
    background-color: #f57224; /* Warna dropdown */
    border-radius: 5px;
}

.dropdown-item {
    color: white;
}

.dropdown-item:hover {
    background-color: #ffdb00;
}

</style>
<body>
    <!-- Navbar -->
    <header>
        <nav class="navbar navbar-expand-lg">
            <div class="container-fluid">
                <a  class="navbar-brand" href="index.php">
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
                            <a class="nav-link" href="about.php">About Us</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="komentar.php">Komentar</a>
                        </li>
                        <!-- Cek apakah pengguna sudah login -->
                        <div class="collapse navbar-collapse" id="navbarContent">
                            <ul class="navbar-nav ms-auto">
                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-bs-toggle="dropdown">
                                        <i class="fas fa-user"></i></i> <?= $_SESSION['username']; ?>
                                    </a>
                                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
                                        <li><a class="dropdown-item" href="./proses/akun_setting.php"><i class="fas fa-cog"></i> Pengaturan Akun</a></li>
                                        <li><a class="dropdown-item" href="logout.php"><i class="fas fa-sign-out-alt"></i> Logout</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                        <li class="nav-item">
                            <button class="btn btn-keranjang btn-cart ms-2" onclick="showCartItems()">
                                <i class="bi bi-cart"></i>
                            </button>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>

    <header class="text-center position-relative" style="margin-top: 50px;">
        <div class="banner-wrapper position-relative overflow-hidden">
            <div class="banner-wrapper position-relative overflow-hidden">
                <img src="assets/items/banner.png" alt="Banner Toko" class="img-fluid w-100 banner-image">
            </div>
            <!-- <div class="overlay position-absolute top-0 start-0 w-100 h-100">

                <div class="container position-absolute top-50 start-50 translate-middle text-center text-white px-3 shadow-lg p-4 rounded">
                    <h1 class="display-5 fw-bold">
                    </h1>
                    <p class="lead mb-4 fw-bold">Toko Grosir Termurah Dan Terpercaya
                    </p>
                    </p>
                </div>
            </div>
        </div> -->
    </header>
    <div class="container">
        <div class="row mb-4">
            <div class="col-12 d-flex">
                <form action="" method="GET" style="width: 100%; max-width: 900px; margin-top: 30px; margin-bottom: 2px;">
                    <div class="input-group">
                        <input type="text" name="term" class="form-control" placeholder="Cari produk...">
                        <button type="submit" class="btn btn-success">Cari</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Kategori dan Pencarian -->
    <section class="kategori my-5">
        <div class="container">
            <h3>KATEGORI</h3>
            <div class="box border rounded my-3">
                <div class="row w-100 m-auto">
                    <?php foreach ($categories as $category): ?>
                        <div class="col text-center py-3">
                            <a href="?category=<?= urlencode($category) ?>" class="text-decoration-none text-dark">
                                <span><?= htmlspecialchars($category) ?></span>
                            </a>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </section>

    <!-- Daftar Produk -->
    <section class="py-5">
        <div class="container">
            <h2 class="text-center mb-4 sticky-header" style="background-color: #fafafa;">Daftar Produk</h2>
            <div class="underline"></div>
            <div class="row">
                <?php
                    // include './config.php'; // Pastikan koneksi database sudah terhubung

                    // Ambil kata kunci pencarian dari parameter GET
                    $term = isset($_GET['term']) ? $_GET['term'] : '';
                    $selectedCategory = isset($_GET['category']) ? $_GET['category'] : '';

                    // Query produk dengan filter pencarian
                    $sql = "SELECT * FROM prodact WHERE 1=1";
                    
                    // Jika ada kategori yang dipilih, tambahkan kondisi kategori
                    if (!empty($selectedCategory)) {
                        $sql .= " AND kategori = ?";
                    }

                    // Jika ada kata kunci pencarian, tambahkan kondisi LIKE
                    if (!empty($term)) {
                        $sql .= " AND (nama_barang LIKE ? OR id LIKE ?)";
                    }

                    // Siapkan dan eksekusi statement
                    $stmt = $conn->prepare($sql);
                    
                    // Bind parameter berdasarkan filter yang ada
                    if (!empty($selectedCategory) && !empty($term)) {
                        $likeTerm = "%$term%";
                        $stmt->bind_param("sss", $selectedCategory, $likeTerm, $likeTerm);
                    } elseif (!empty($selectedCategory)) {
                        $stmt->bind_param("s", $selectedCategory);
                    } elseif (!empty($term)) {
                        $likeTerm = "%$term%";
                        $stmt->bind_param("ss", $likeTerm, $likeTerm);
                    }

                    $stmt->execute();
                    $result = $stmt->get_result();

                    // Tampilkan produk berdasarkan kategori
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) { 
                            $stok = $row['stok']; ?>
                            <div class="col-6 col-md-4 col-lg-2 mb-4">
                                <div class="card w-100">
                                    <div class="text-center">
                                        <img src="assets/<?= htmlspecialchars($row['gambar']) ?>" class="card-img-top img-fluid" alt="<?= htmlspecialchars($row['nama_barang']) ?>">
                                    </div>
                                    <div class="card-body">
                                        <h5 class="card-title"><?= htmlspecialchars($row['nama_barang']) ?></h5>
                                        <p class="card-text small text-muted">Stok: <?= $stok ?></p> <!-- Jumlah stok yang tersedia -->
                                        <p class="card-text"><strong>Rp. <?= number_format($row['harga'], 0, ',', '.') ?></strong></p>
                                        
                                        <!-- Jika stok habis, tampilkan pesan "Stok Habis" -->
                                        <?php if ($stok > 0) { ?>
                                            <div class="d-flex align-items-center">
                                                <input type="number" min="1" max="<?= $stok ?>" value="1" class="form-control quantity-input" style="width: 70px; margin-bottom: 8px;" id="quantity-<?= $row['id'] ?>" oninput="validateQuantity(this, <?= $stok ?>)">
                                                <button class="btn btn-primary btn-cart ms-2" onclick="addToCart(<?= $row['id'] ?>)">
                                                    <i class="bi bi-cart"></i>
                                                </button>
                                            </div>
                                            <small class="text-danger d-none" id="stock-warning-<?= $row['id'] ?>">Stok terbatas</small>
                                        <?php } else { ?>
                                            <p class="text-danger">Stok Habis</p>
                                        <?php } ?>
                                    </div>
                                </div>
                            </div>
                        <?php }
                    } else { ?>
                        <p>Produk Kosong Momplong</p>
                    <?php }
                ?>
            </div>
        </div>
    </section>
    <section class="py-5">
        <div class="container">
            <span class="fw-bold">Berikan Ulasan Anda</span>
            <p>Jika Anda memiliki saran atau kritik mengenai toko kami silahkan <a href="komentar.php">Tinggalkan Komentar Anda</a>. Kami siap mendengarnya!</p>
        </div>
    </section>
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
    <!-- Bootstrap JS -->
     <script>
        function showCartItems() {
            // Arahkan pengguna ke halaman daftar keranjang
            window.location.href = "daftar_keranjang.php";
        }
        function addToCart(productId) {
                let quantity = document.getElementById('quantity-' + productId).value;
                fetch('keranjang.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded'
                    },
                    body: 'product_id=' + productId + '&quantity=' + quantity
                })
                .then(response => response.text())
                .then(data => {
                    alert(data);  // Menampilkan pesan dari server
                })
                .catch(error => console.error('Error:', error));
            }
            // Validasi jumlah kuantitas agar tidak melebihi stok
        function validateQuantity(input, stok) {
            const warningMessage = document.getElementById("stock-warning-" + input.id.split('-')[1]);
            if (input.value > stok) {
                input.value = stok; // Set jumlah sesuai stok maksimum
                warningMessage.classList.remove('d-none'); // Tampilkan pesan stok terbatas
            } else {
                warningMessage.classList.add('d-none'); // Sembunyikan pesan jika jumlah valid
            }
        }
        function fetchMessageCount() {
        fetch('./proses/get_new_messages.php')
            .then(response => response.json())
            .then(data => {
                // Update badge dengan jumlah pesan baru
                const messageCount = document.getElementById('messageCount');
                if (data.new_messages > 0) {
                    messageCount.textContent = data.new_messages;
                    messageCount.style.display = 'inline'; // Tampilkan badge
                } else {
                    messageCount.style.display = 'none'; // Sembunyikan badge jika tidak ada pesan baru
                }
            })
            .catch(error => console.error('Error fetching message count:', error));
    }

    // Perbarui jumlah pesan setiap 10 detik
    setInterval(fetchMessageCount, 10000);

    // Panggil saat halaman dimuat
    fetchMessageCount();
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js "></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>
    <script src="./assets/fontawesome-free-6.6.0-web/js/all.min.js "></script>
</body>
</html>