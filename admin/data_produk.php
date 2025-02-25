<?php
include "../config.php"; // File konfigurasi untuk koneksi database

// Inisialisasi variabel pencarian
$search = isset($_GET['search']) ? $_GET['search'] : '';

// Ambil halaman saat ini dari parameter URL, jika tidak ada, setel ke halaman 1
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$limit = 10; // Jumlah barang per halaman
$offset = ($page - 1) * $limit; // Offset data

// Query pencarian jika ada kata kunci pencarian
$sql = "SELECT * FROM prodact";
if (!empty($search)) {
    $sql .= " WHERE nama_barang LIKE '%$search%' OR kategori LIKE '%$search%'";
}
$sql .= " LIMIT $limit OFFSET $offset";
$result = $conn->query($sql);

// Hitung jumlah total produk untuk pagination
$totalItemsSql = "SELECT COUNT(*) as total FROM prodact";
if (!empty($search)) {
    $totalItemsSql .= " WHERE nama_barang LIKE '%$search%' OR kategori LIKE '%$search%'";
}
$totalItemsResult = $conn->query($totalItemsSql);
$totalItems = $totalItemsResult->fetch_assoc()['total'];
$totalPages = ceil($totalItems / $limit); // Jumlah halaman total
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Produk</title>
    <link rel="icon" href="assets/items/logo.png" type="image/png">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<style>
    body {
    background-color: #f8f9fa;
    color: #212529;
    font-family: 'Arial', sans-serif;
    margin: 0;
    padding: 0;
}

.container {
    background-color: #ffffff;
    padding: 20px;
    border-radius: 4px;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
}

h2 {
    color: #343a40;
    font-size: 30px;
    margin-bottom: 20px;
    font-weight: bold;
}

.input-group {
    max-width: 500px;
    margin: 0 auto 20px;
}

.table {
    margin-bottom: 30px;
    background-color: #fff;
    border-radius: 12px;
    overflow: hidden;
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
    border-collapse: separate;
    border-spacing: 0;
}

.table th:first-child, .table td:first-child {
    border-top-left-radius: 12px;
}

.table th:last-child, .table td:last-child {
    border-top-right-radius: 12px;
}

.table tbody tr:last-child td:first-child {
    border-bottom-left-radius: 12px;
}

.table tbody tr:last-child td:last-child {
    border-bottom-right-radius: 12px;
}

.table th, .table td {
    padding: 15px;
    text-align: center;
    vertical-align: middle;
    border-bottom: 1px solid #ddd;
}

.table tbody tr:last-child td {
    border-bottom: none; /* Remove the last border to maintain the border-radius look */
}


.btn {
    transition: background-color 0.3s ease;
}

.btn-primary {
    background-color: #007bff;
    border-color: #007bff;
}

.btn-primary:hover {
    background-color: #0056b3;
    border-color: #0056b3;
}

.btn-success {
    background-color: #28a745;
    border-color: #28a745;
}

.btn-success:hover {
    background-color: #218838;
    border-color: #1e7e34;
}

.btn-warning {
    background-color: #ffc107;
    border-color: #ffc107;
}

.btn-warning:hover {
    background-color: #e0a800;
    border-color: #d39e00;
}

.btn-danger {
    background-color: #dc3545;
    border-color: #dc3545;
}

.btn-danger:hover {
    background-color: #c82333;
    border-color: #bd2130;
}

.pagination {
    margin-top: 20px;
}

.pagination .page-item.active .page-link {
    background-color: #007bff;
    border-color: #007bff;
}

.pagination .page-link {
    color: #007bff;
}

.pagination .page-link:hover {
    background-color: #e9ecef;
    border-color: #dee2e6;
}

.pagination .page-item.active .page-link:hover {
    background-color: #0056b3;
    border-color: #0056b3;
}

</style>
<body class="bg-light">
    <div class="container my-5">
        <h2 class="text-center mb-4">Data Produk</h2>
        
        <!-- Formulir Pencarian -->
        <form method="GET" action="data_produk.php" class="mb-3">
            <div class="input-group">
                <input type="text" name="search" class="form-control" placeholder="Cari nama barang atau kategori..." value="<?= htmlspecialchars($search) ?>">
                <div class="input-group-append">
                    <button class="btn btn-primary" type="submit">Cari</button>
                </div>
            </div>
        </form>

        <!-- Tombol Tambah Produk -->
        <div class="text-right mb-3">
            <a href="tambah_produk.php" class="btn btn-success">Tambah Produk</a>
        </div>

        <!-- Tabel Produk -->
        <table class="table table-striped table-bordered" style="">
            <thead class="thead-dark">
                <tr>
                    <th>No</th>
                    <th>Gambar</th>
                    <th>Nama Barang</th>
                    <th>Harga</th>
                    <th>Harga Awal</th>
                    <th>Kategori</th>
                    <th>Stok</th>
                    <!-- <th>Deskripsi</th> -->
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($result->num_rows > 0): ?>
                    <?php $no = $offset + 1; ?>
                    <?php while ($row = $result->fetch_assoc()): ?>
                        <tr>
                            <td><?= $no++; ?></td>
                            <td><img src="../assets/<?= htmlspecialchars($row['gambar']); ?>" alt="<?= htmlspecialchars($row['nama_barang']); ?>" style="width: 100px; height: auto;"></td>
                            <td><?= htmlspecialchars($row['nama_barang']); ?></td>
                            <td>Rp <?= number_format($row['harga'], 0, ',', '.'); ?></td>
                            <td>Rp <?= number_format($row['harga_awal'], 0, ',', '.'); ?></td>
                            <td><?= htmlspecialchars($row['kategori']); ?></td>
                            <td><?= htmlspecialchars($row['stok']); ?></td>
                            <!-- <td><?= htmlspecialchars($row['deskripsi']); ?></td> -->
                            <td>
                                <a href="ubah_produk.php?id=<?= $row['id']; ?>" class="btn btn-warning btn-sm">Ubah</a>
                                <a href="hapus_produk.php?id=<?= $row['id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus produk ini?');">Hapus</a>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="8" class="text-center">Tidak ada produk tersedia.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>

        <!-- Pagination -->
        <?php if ($totalPages > 1): ?>
            <!-- Cek apakah jumlah halaman lebih dari 1, jika ya tampilkan navigasi -->
            <nav>
                <ul class="pagination justify-content-center">
                    <?php for ($i = 1; $i <= $totalPages; $i++): ?> <!-- Loop untuk menampilkan setiap nomor halaman -->
                        <li class="page-item <?= ($i == $page) ? 'active' : '' ?>"> <!-- Cek apakah ini halaman aktif, jika iya beri kelas 'active' -->
                            <a class="page-link" href="?page=<?= $i ?>&search=<?= htmlspecialchars($search) ?>"><?= $i ?></a>
                        </li>
                    <?php endfor; ?>
                </ul>
            </nav>
        <?php endif; ?>
    </div>

    <!-- Bootstrap JavaScript and dependencies -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
