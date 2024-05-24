<?php
// Menghubungkan ke database
$host = "localhost";
$username = "root";
$password = "";
$database = "blogkategori";

$conn = mysqli_connect($host, $username, $password, $database);

if (!$conn) {
    die("Bağlantı başarısız oldu. " . mysqli_connect_error());
}

// Mengambil data kategori
$kategori_query = "SELECT * FROM kategori";
$kategori_result = mysqli_query($conn, $kategori_query);

// Proses penambahan atau pengeditan artikel
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action'])) {
    $judul = isset($_POST['judul']) ? $_POST['judul'] : '';
    $konten = isset($_POST['konten']) ? $_POST['konten'] : '';
    $tanggal = date('Y-m-d');
    $kategori = isset($_POST['kategori']) ? $_POST['kategori'] : '';

    $gambar = isset($_FILES['gambar']['name']) ? $_FILES['gambar']['name'] : null;
    $gambar_tmp = isset($_FILES['gambar']['tmp_name']) ? $_FILES['gambar']['tmp_name'] : null;
    $gambar_folder = $gambar ? 'uploads/' . $gambar : null;

    if ($_POST['action'] == 'add') {
        $cek_judul_query = "SELECT * FROM artikel WHERE judul='$judul'";
        $cek_judul_result = mysqli_query($conn, $cek_judul_query);

        if (mysqli_num_rows($cek_judul_result) > 0) {
            $message = "Makale başlığı zaten mevcut, lütfen başka bir başlık kullanın.";
        } else {
            if ($gambar && move_uploaded_file($gambar_tmp, $gambar_folder)) {
                $insert_query = "INSERT INTO artikel (judul, konten, tanggal, kategori, gambar) VALUES ('$judul', '$konten', '$tanggal', '$kategori', '$gambar')";
                if (mysqli_query($conn, $insert_query)) {
                    $message = "Makale başarıyla eklendi.";
                } else {
                    $message = "Hata: " . $insert_query . "<br>" . mysqli_error($conn);
                }
            } else {
                $message = "Resim yüklenemedi.";
            }
        }
    } elseif ($_POST['action'] == 'edit') {
        $id = $_POST['id'];
        if ($gambar) {
            if (move_uploaded_file($gambar_tmp, $gambar_folder)) {
                $update_query = "UPDATE artikel SET judul='$judul', konten='$konten', kategori='$kategori', gambar='$gambar' WHERE id='$id'";
            } else {
                $message = "Resim yüklenemedi.";
            }
        } else {
            $update_query = "UPDATE artikel SET judul='$judul', konten='$konten', kategori='$kategori' WHERE id='$id'";
        }

        if (mysqli_query($conn, isset($update_query) ? $update_query : "")) {
            $message = "Makale başarıyla güncellendi.";
        } else {
            $message = "Error: " . $update_query . "<br>" . mysqli_error($conn);
        }
    }
}

// Proses penghapusan artikel
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete'])) {
    $id = $_POST['id'];
    $delete_query = "DELETE FROM artikel WHERE id='$id'";
    if (mysqli_query($conn, $delete_query)) {
        $message = "Artikel berhasil dihapus.";
    } else {
        $message = "Error: " . $delete_query . "<br>" . mysqli_error($conn);
    }
}

// Mengambil data artikel untuk ditampilkan
$artikel_query = "SELECT * FROM artikel";
$artikel_result = mysqli_query($conn, $artikel_query);

// Mengambil artikel yang akan diedit
$edit_artikel = null;
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] == 'edit_form') {
    $id = $_POST['id'];
    $edit_query = "SELECT * FROM artikel WHERE id='$id'";
    $edit_result = mysqli_query($conn, $edit_query);
    if ($edit_result) {
        $edit_artikel = mysqli_fetch_assoc($edit_result);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel - Tambah Artikel</title>
    <!-- Menyertakan Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-5">
    <h1 class="mb-4">Admin Panel - Tambah Artikel</h1>

    <?php if (isset($message)) { ?>
        <div class="alert alert-info" role="alert">
            <?php echo $message; ?>
        </div>
    <?php } ?>

    <div class="card mb-4">
        <div class="card-body">
            <h2 class="card-title"><?php echo $edit_artikel ? 'Edit Artikel' : 'Tambah Artikel Baru'; ?></h2>
            <form action="admin.php" method="POST" enctype="multipart/form-data">
                <input type="hidden" name="action" value="<?php echo $edit_artikel ? 'edit' : 'add'; ?>">
                <?php if ($edit_artikel) { ?>
                    <input type="hidden" name="id" value="<?php echo $edit_artikel['id']; ?>">
                <?php } ?>
                <div class="form-group">
                    <label for="judul">Judul:</label>
                    <input type="text" id="judul" name="judul" class="form-control" value="<?php echo $edit_artikel ? $edit_artikel['judul'] : ''; ?>" required>
                </div>

                <div class="form-group">
                    <label for="konten">Konten:</label>
                    <textarea id="konten" name="konten" class="form-control" rows="10" required><?php echo $edit_artikel ? $edit_artikel['konten'] : ''; ?></textarea>
                </div>

                <div class="form-group">
                    <label for="kategori">Kategori:</label>
                    <select id="kategori" name="kategori" class="form-control" required>
                        <?php
                        if (mysqli_num_rows($kategori_result) > 0) {
                            while ($row = mysqli_fetch_assoc($kategori_result)) {
                                $selected = $edit_artikel && $edit_artikel['kategori'] == $row['nama_kategori'] ? 'selected' : '';
                                echo "<option value='" . $row['nama_kategori'] . "' $selected>" . $row['nama_kategori'] . "</option>";
                            }
                        }
                        ?>
                    </select>
                </div>

                <div class="form-group">
                    <label for="gambar">Gambar:</label>
                    <input type="file" id="gambar" name="gambar" class="form-control-file" accept="image/*">
                </div>

                <button type="submit" class="btn btn-primary"><?php echo $edit_artikel ? 'Update Artikel' : 'Tambah Artikel'; ?></button>
            </form>
        </div>
    </div>

    <h2>Daftar Artikel</h2>
    <ul class="list-group">
        <?php
        if (mysqli_num_rows($artikel_result) > 0) {
            while ($row = mysqli_fetch_assoc($artikel_result)) {
                echo "<li class='list-group-item d-flex justify-content-between align-items-center'>";
                echo "<span>" . $row['judul'] . " - " . $row['kategori'] . "</span>";
                echo "<span>";
                echo "<form action='admin.php' method='POST' class='d-inline'>
                        <input type='hidden' name='id' value='" . $row['id'] . "'>
                        <input type='hidden' name='action' value='edit_form'>
                        <button type='submit' class='btn btn-primary btn-sm'>Edit</button>
                      </form>";
                echo "<form action='admin.php' method='POST' class='d-inline ml-2'>
                        <input type='hidden' name='id' value='" . $row['id'] . "'>
                        <input type='hidden' name='delete' value='true'>
                        <button type='submit' class='btn btn-danger btn-sm'>Delete</button>
                      </form>";
                echo "</span>";
                echo "</li>";
            }
        } else {
            echo "<li class='list-group-item'>Belum ada artikel.</li>";
        }
        ?>
    </ul>
</div>

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
