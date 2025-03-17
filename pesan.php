<?php
    // Daftar mobil beserta harga sewanya per hari
    $rentals = [
        ["Fortuner", 1000000, "fortuner.jpg"],
        ["Creta", 900000, "creta.jpg"],
        ["CRV", 700000, "crv.jpg"]
    ];

    // Inisialisasi variabel default
    $pilih_mobil = $rentals[0][0];
    $pilih_harga = $rentals[0][1];
    $supir = false;
    $durasi = '';
    $total_bayar = 0;
    $errors = [];

    // Mengecek apakah form telah dikirim (dengan metode POST)
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        // Validasi input
        $pilih_mobil = $_POST['car'] ?? $rentals[0][0];
        $pilih_harga = array_column($rentals, 1, 0)[$pilih_mobil];
        $supir = isset($_POST['supir']);
        $durasi = $_POST['durasi'] ?? '';
        $identitas = $_POST['identitas'] ?? '';


        if (!is_numeric($durasi)) {
            $errors[] = "Durasi harus berupa angka lebih dari 0";
        }
        if (!is_numeric($_POST['identitas'])) {
            $errors[] = "Identitas harus berupa angka";
        }
        
        // Validasi: Nomor identitas harus 16 digit angka
        // strlen untuk menghitung jumlah karakter yang diinputkan pada input dengan name identitas
        if (strlen($_POST['identitas']) !== 16) {
            $errors[] = "Nomor Identitas harus 16 digit angka.";
        }

        // Jika tidak ada error validasi, hitung total pembayaran
        if (empty($errors)) {
            // Menghitung biaya sewa mobil total berdasarkan durasi
            $total_harga_mobil = $pilih_harga * $durasi;

            // Memberikan diskon 10% jika durasi sewa 3 hari atau lebih
            $diskon = ($durasi >= 3) ? 0.1 * $total_harga_mobil : 0;

            // Menghitung biaya tambahan untuk supir jika dipilih (Rp 100.000 per hari)
            $biaya_supir = $supir ? 100000 * $durasi : 0;

            // Menghitung total pembayaran setelah dikurangi diskon dan ditambah biaya supir
            $total_bayar = $total_harga_mobil - $diskon + $biaya_supir;
        }

        if (isset($_POST['simpan'])) {
            $diskon = ($durasi >= 3) ? 0.1 * $total_harga_mobil : 0;
            $check = $supir == "checked" ? 'Ya' : 'Tidak';
            $nama = $_POST['nama'];
            $identitas = $_POST['identitas'];
            $gender = $_POST['gender'];
            $car = $_POST['car'] ;
            $detail_pesanan = "Pesanan Berhasil!\n\n"
                . "Nama: $nama\n"
                . "Nomor Identitas: $identitas\n"
                . "Jenis Kelamin: $gender\n"
                . "Jenis Mobil: $pilih_mobil \n"
                . "Supir: $check\n" 
                . "Durasi:$durasi \n"
                . "Diskon: $diskon  \n"
                . "Total Bayar: Rp " . number_format($total_bayar, 0, ',', '.');
    
            echo "<script>
                alert(`$detail_pesanan`);
                window.location.href = 'index.php';
            </script>";
            exit();
        }
    }
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Form Pemesanan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <div class="card">
            <div class="card-header bg-primary text-white text-center">
                <h5>Form Pemesanan</h5>
            </div>
            <div class="card-body">
                <?php if ($errors) { ?>
                    <div class="alert alert-danger">
                        <ul>
                            <?php foreach ($errors as $error) { echo "<li>$error</li>"; } ?>
                        </ul>
                    </div>
                <?php } ?>

                <form method="POST">
                    <input type="text" class="form-control mb-3" name="nama" placeholder="Nama Pemesan" value="<?= $_POST['nama'] ?? '' ?>" required>
                    
                    <div class="mb-3">
                        <label class="form-label">Jenis Kelamin</label><br>
                        <input class="form-check-input" type="radio" name="gender" value="Laki-laki" <?= ($_POST['gender'] ?? '') === 'Laki-laki' ? 'checked' : '' ?>> Laki-laki
                        <input class="form-check-input ms-3" type="radio" name="gender" value="Perempuan" <?= ($_POST['gender'] ?? '') === 'Perempuan' ? 'checked' : '' ?>> Perempuan
                    </div>
                    
                    <input type="text" class="form-control mb-3" name="identitas" placeholder="Nomor Identitas (16 digit)" value="<?= $_POST['identitas'] ?? '' ?>" required>
                    
                    <select class="form-select mb-3" name="car" onchange="this.form.submit()">
                        <?php foreach  ($rentals as $nilai) { ?>
                            <option value="<?= $nilai[0] ?>" <?= ($nilai[0] === $pilih_mobil) ? 'selected' : '' ?>>
                                <?= $nilai[0] ?>
                            </option>
                        <?php }?>
                    </select>
                   
                    <input type="text" class="form-control mb-3" name="harga" value="<?= number_format($pilih_harga, 0, ',', '.') ?>" readonly>
                    
                    <input type="date" class="form-control mb-3" name="tanggal" value="<?= $_POST['tanggal'] ?? '' ?>" required>
                    
                    <input type="number" class="form-control mb-3" name="durasi" placeholder="Durasi Sewa (hari)" value="<?= $durasi ?>" required>
                    
                    <div class="mb-3">
                        <input class="form-check-input" type="checkbox" name="supir" <?= $supir ? 'checked' : '' ?>> Termasuk Supir (Rp 100.000/hari)
                    </div>

                    <input type="text" class="form-control mb-3" value="<?= $total_bayar ? number_format($total_bayar, 0, ',', '.') : '' ?>" placeholder="Total Bayar" readonly>
                    
                    <button type="submit" class="btn btn-primary">Hitung Total</button>
                    <button type="submit" name="simpan" class="btn btn-primary">Simpan</button>
                    <button type="reset" class="btn btn-danger">Cancel</button>
                </form>
            </div>
        </div>
    </div>
</body>
</html>