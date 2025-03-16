<?php
$rentals = [
    ["Fortuner", 1000000, "fortuner.jpg"],
    ["Creta", 900000, "creta.jpg"],
    ["CRV", 700000, "crv.jpg"]
];
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Rental Kami</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .product-card {
            text-align: center;
            padding: 15px;
            border: 1px solid #ddd;
            border-radius: 10px;
            margin-bottom: 20px;
            box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
        }
        .product-card img {
            width: 100%;
            height: 200px;
            object-fit: cover;
            border-radius: 10px;
        }
        .carousel-item img {
            height: 450px;
            object-fit: cover;
        }
        .pesan-btn-container {
            text-align: center;
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="#">Rental Kami</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link" href="#produk">Produk</a></li>
                    <li class="nav-item"><a class="nav-link" href="#tentang">Tentang Kami</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <div id="carouselExampleCaptions" class="carousel slide">
      <div class="carousel-indicators">
        <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
        <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1" aria-label="Slide 2"></button>
        <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2" aria-label="Slide 3"></button>
      </div>
      <div class="carousel-inner">
        <div class="carousel-item active">
          <img src="img/fortuner.jpg" class="d-block w-100" alt="Fortuner">
          <div class="carousel-caption d-none d-md-block">
            <h5>Fortuner</h5>
            <p>Rp. 1.000.000 /malam</p>
          </div>
        </div>
        <div class="carousel-item">
          <img src="img/creta.jpg" class="d-block w-100" alt="Creta">
          <div class="carousel-caption d-none d-md-block">
            <h5>Creta</h5>
            <p>Rp. 900.000</p>
          </div>
        </div>
        <div class="carousel-item">
          <img src="img/crv.jpg" class="d-block w-100" alt="CRV">
          <div class="carousel-caption d-none d-md-block">
            <h5>CRV</h5>
            <p>Rp. 700.000</p>
          </div>
        </div>
      </div>
      <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
      </button>
      <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
      </button>
    </div>

    <div class="container mt-5">
        <section id="produk">
            <h2 class="text-center">Jenis Mobil</h2>
            <div class="row">
                <?php foreach ($rentals as $rental) { ?>
                <div class="col-md-4">
                    <div class="product-card">
                        <img src="img/<?= $rental[2] ?>" alt="<?= $rental[0] ?>">
                        <h5 class="mt-2"> <?= $rental[0] ?> </h5>
                        <h5 class="mt-2">Rp <?= $rental[1]?></h5>
                    </div>
                </div>
                <?php } ?>
            </div>
        </section>
    </div>

    <div class="pesan-btn-container">
        <a href="pesan.php" class="btn btn-lg btn-success">Pesan Sekarang</a>
    </div>

    <div class="container mt-4 text-center">
    <h3>Video Kolesi kami Fortuner</h3>
    <video width="100%" controls>
        <source src="vid/fortuner.mp4" type="video/mp4">
        Browser Anda tidak mendukung tag video.
    </video>
</div>

    <div class="container mt-5">
        <section id="tentang">
            <div class="card shadow-lg">
                <div class="card-body text-center">
                    <h2 class="card-title">Tentang Kami</h2>
                    <p class="card-text">Selamat datang di <strong>Rental Kami</strong>, penyedia layanan rental terpercaya yang siap memenuhi kebutuhan transportasi Anda.</p>
                    <p class="card-text">Kami berlokasi di <strong>Jalan Flamboyan III</strong>, dengan berbagai pilihan kendaraan yang nyaman, terawat, dan siap digunakan untuk perjalanan bisnis, wisata, atau keperluan pribadi.</p>
                    <p class="card-text">Kami selalu mengutamakan kepuasan pelanggan dengan menyediakan layanan profesional, harga kompetitif, serta kemudahan dalam proses penyewaan.</p>
                    <hr>
                    <h5>Hubungi Kami</h5>
                    <p><strong>📍 Alamat:</strong> Jalan Flamboyan III</p>
                    <p><strong>📞 Telepon:</strong> <a href="tel:+62895383875089">+62895383875089</a></p>
                    <p><strong>📧 Email:</strong> <a href="mailto:rentalkami@gmail.com">rentalkami@gmail.com</a></p>
                </div>
            </div>
        </section>
    </div>

    <footer class="bg-dark text-white text-center py-3 mt-5">
        <p>&copy; 2025 Rental.</p>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>