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

// Proses penambahan kategori
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action'])) {
    $nama_kategori = $_POST['nama_kategori'];

    if ($_POST['action'] == 'add') {
        // Mengecek apakah kategori sudah ada
        $cek_kategori_query = "SELECT * FROM kategori WHERE nama_kategori = '$nama_kategori'";
        $cek_kategori_result = mysqli_query($conn, $cek_kategori_query);

        if (mysqli_num_rows($cek_kategori_result) > 0) {
            $message = "Kategori sudah ada.";
        } else {
            // Menyimpan data kategori ke database
            $insert_query = "INSERT INTO kategori (nama_kategori) VALUES ('$nama_kategori')";
            if (mysqli_query($conn, $insert_query)) {
                $message = "Kategori berhasil ditambahkan.";
            } else {
                $message = "Error: " . $insert_query . "<br>" . mysqli_error($conn);
            }
        }
    } elseif ($_POST['action'] == 'edit') {
        $id = $_POST['id'];
        $update_query = "UPDATE kategori SET nama_kategori='$nama_kategori' WHERE id='$id'";
        if (mysqli_query($conn, $update_query)) {
            $message = "Kategori berhasil diupdate.";
        } else {
            $message = "Error: " . $update_query . "<br>" . mysqli_error($conn);
        }
    }
}

// Proses penghapusan kategori
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete'])) {
    $id = $_POST['id'];
    $delete_query = "DELETE FROM kategori WHERE id ='$id'";
    if (mysqli_query($conn, $delete_query)) {
        $message = "Kategori berhasil dihapus.";
    } else {
        $message = "Error: " . $delete_query . "<br>" . mysqli_error($conn);
    }
}

// Mengambil data kategori untuk ditampilkan
$kategori_query = "SELECT * FROM kategori";
$kategori_result = mysqli_query($conn, $kategori_query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel - Tambah Kategori</title>
    <!-- Menyertakan Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-5">
    <h1 class="mb-4">Admin Panel - Tambah Kategori</h1>
    
    <?php if (isset($message)) { ?>
        <div class="alert alert-info" role="alert">
            <?php echo $message; ?>
        </div>
    <?php } ?>

    <div class="card mb-4">
        <div class="card-body">
            <h2 class="card-title">Tambah Kategori Baru</h2>
            <form action="admin_kategori.php" method="POST">
                <input type="hidden" name="action" value="add">
                <div class="form-group">
                    <label for="nama_kategori">Nama Kategori:</label>
                    <input type="text" id="nama_kategori" name="nama_kategori" class="form-control" required>
                </div>
                <button type="submit" class="btn btn-primary">Tambah Kategori</button>
            </form>
        </div>
    </div>

    <h2>Daftar Kategori</h2>
    <ul class="list-group">
        <?php
        if (mysqli_num_rows($kategori_result) > 0) {
            while ($row = mysqli_fetch_assoc($kategori_result)) {
                echo "<li class='list-group-item d-flex justify-content-between align-items-center'>";
                echo "<span>" . $row['nama_kategori'] . "</span>";
                echo "<span>";
                echo "<form action='admin_kategori.php' method='POST' class='d-inline'>
                        <input type='hidden' name='id' value='" . $row['id'] . "'>
                        <input type='hidden' name='nama_kategori' value='" . $row['nama_kategori'] . "'>
                        <input type='hidden' name='action' value='edit'>
                        <input type='text' name='nama_kategori' value='" . $row['nama_kategori'] . "' required>
                        <button type='submit' class='btn btn-primary btn-sm'>Update</button>
                      </form>";
                echo "<form action='admin_kategori.php' method='POST' class='d-inline ml-2'>
                        <input type='hidden' name='id' value='" . $row['id'] . "'>
                        <input type='hidden' name='delete' value='true'>
                        <button type='submit' class='btn btn-danger btn-sm'>Delete</button>
                      </form>";
                echo "</span>";
                echo "</li>";
            }
        } else {
            echo "<li class='list-group-item'>Belum ada kategori.</li>";
        }
        ?>
    </ul>

</div>

<footer class="d-flex flex-wrap justify-content-between align-items-center py-3 my-4 border-top">
    <div class="col-md-4 d-flex align-items-center" bis_skin_checked="1">
      <a href="/" class="mb-3 me-2 mb-md-0 text-body-secondary text-decoration-none lh-1">
        <svg class="bi" width="30" height="24"><use xlink:href="#bootstrap"></use></svg>
      </a>
      <span class="mb-3 mb-md-0 text-body-secondary">© 2024 dystaSatria</span>
    </div>

    <ul class="nav col-md-4 justify-content-end list-unstyled d-flex">
      <li class="ms-3"><a class="text-body-secondary" href="#"><svg class="bi" width="24" height="24"><use xlink:href="#twitter"></use></svg></a></li>
      <li class="ms-3"><a class="text-body-secondary" href="#"><svg class="bi" width="24" height="24"><use xlink:href="#instagram"></use></svg></a></li>
      <li class="ms-3"><a class="text-body-secondary" href="#"><svg class="bi" width="24" height="24"><use xlink:href="#facebook"></use></svg></a></li>
    </ul>
  </footer>

<!-- Menyertakan Bootstrap JS dan dependencies -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>

<?php
// Menutup koneksi
mysqli_close($conn);
?>
