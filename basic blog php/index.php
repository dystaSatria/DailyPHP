<?php
// Menghubungkan ke database
$host = "localhost";
$username = "root";
$password = "";
$database = "blogkategori";

$conn = mysqli_connect($host, $username, $password, $database);

if (!$conn) {
    die("Koneksi gagal: " . mysqli_connect_error());
}

// Mengambil data kategori
$kategori_query = "SELECT * FROM kategori";
$kategori_result = mysqli_query($conn, $kategori_query);

// Mengambil data artikel berdasarkan kategori
$selected_kategori = isset($_GET['kategori']) ? $_GET['kategori'] : '';

if ($selected_kategori) {
    $artikel_query = "SELECT * FROM artikel WHERE kategori='$selected_kategori' ";
} else {
    $artikel_query = "SELECT * FROM artikel ";
}
$artikel_result = mysqli_query($conn, $artikel_query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blog</title>
    <!-- Menyertakan Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-5">
    <h1 class="mb-4 text-center">Blog</h1>

    <!-- Filter Kategori -->
    <form method="GET" action="">
        <div class="form-group">
            <label for="kategori">Kategori seçin :</label>
            <select name="kategori" id="kategori" class="form-control">
                <option value="">Semua Kategori</option>
                <?php
                if (mysqli_num_rows($kategori_result) > 0) {
                    while ($row = mysqli_fetch_assoc($kategori_result)) {
                        $selected = $selected_kategori == $row['nama_kategori'] ? 'selected' : '';
                        echo "<option value='" . $row['nama_kategori'] . "' $selected>" . $row['nama_kategori'] . "</option>";
                    }
                }
                ?>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Filter</button>
    </form>

    <hr>

    <div class="row">
        <?php
        // Menampilkan artikel
        if (mysqli_num_rows($artikel_result) > 0) {
            while ($row = mysqli_fetch_assoc($artikel_result)) {
                echo "<div class='col-md-4 mb-4' style='height:500px'>";
                echo "<div class='card'  >";
                echo "<img src='uploads/" . $row['gambar'] . "' class='card-img-top' alt='Gambar Artikel' style='height:400px'>";
                echo "<div class='card-body' >";
                echo "<h5 class='card-title'>" . $row['judul'] . "</h5>";
                echo "<p class='card-text'>" . substr($row['konten'], 0, 20) . "...</p>";
                echo "<p class='text-muted'>Tarih: " . $row['tanggal'] . "</p>";
                echo "<p class='text-muted'>Kategori: " . $row['kategori'] . "</p>";
                echo "<button type='button' class='btn btn-primary' data-toggle='modal' data-target='#artikelModal" . $row['id'] . "'>Devamını oku</button>";
                echo "</div>";
                echo "</div>";
                echo "</div>";

                // Modal untuk artikel
                echo "<div class='modal fade' id='artikelModal" . $row['id'] . "' tabindex='-1' role='dialog' aria-labelledby='artikelModalLabel" . $row['id'] . "' aria-hidden='true'>";
                echo "<div class='modal-dialog modal-lg' role='document'>";
                echo "<div class='modal-content'>";
                echo "<div class='modal-header'>";
                echo "<h5 class='col-12 modal-title text-center' id='artikelModalLabel" . $row['id'] . "'>" . $row['judul'] . "</h5>";
                echo "<button type='button' class='close' data-dismiss='modal' aria-label='Close'>";
                echo "</button>";
                echo "</div>";
                echo "<div class='col-12 modal-body text-center'>";
                echo "<img src='uploads/" . $row['gambar'] . "' class='img-fluid mb-3' alt='Gambar Artikel'>";
                echo "<p>" . $row['konten'] . "</p>";
                echo "</div>";
                echo "<div class='modal-footer'>";
                echo "<button type='button' class='btn btn-danger' data-dismiss='modal'>Kapat</button>";
                echo "</div>";
                echo "</div>";
                echo "</div>";
                echo "</div>";
            }
        } else {
            echo "<div class='col-12'>";
            echo "<p class='text-center'>Bu kategoride makale yok.</p>";
            echo "</div>";
        }

        // Menutup koneksi
        mysqli_close($conn);
        ?>
    </div>
</div>

<!-- Menyertakan Bootstrap JS dan dependencies -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
