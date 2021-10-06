<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>List Buku</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <div class="card">
            <div class="card-header bg-dark">
                <h4 class="text-white">
                    Daftar Buku
                </h4>
            </div>

            <div class="card-body">
                <form action="list-buku.php" method="get">
                    <input type="text" name="search" class="form-control mb-2" placeholder="Masukkan Keyword Pencarian" />
                </form>

                <ul class="list-group">
                    <?php
                    include "connection.php";
                    if (isset($_GET["search"])) {
                        $cari = $_GET["search"];
                        $sql = "select * from buku where judul_buku like '%$cari%' or penerbit like '%$cari%' 
                        or genre like '%$cari%'";
                    }else {
                        $sql = "select * from buku";
                    }

                    $hasil = mysqli_query($connect, $sql);
                    while ($buku = mysqli_fetch_array($hasil)) {
                        ?>
                        <li class="list-group-item">
                            <div class="row">
                                <div class="col-lg-4">
                                    <!--untuk gambar -->
                                    <img src="cover/<?=$buku["cover"]?>" 
                                    width="300" />
                                </div>
                                <div class="col-lg-6">
                                    <!-- deskripsi buku -->
                                    <h5><?=$buku["judul_buku"]?></h5>
                                    <h6>Penulis : <?=$buku["penulis"]?></h6>
                                    <h6>Penerbit : <?=$buku["penerbit"]?></h6>
                                    <h6>Genre : <?=$buku["genre"]?></h6>
                                    <h6>Jumlah Halaman : <?=$buku["jumlah_halaman"]?></h6>
                                </div>

                                <div class="col-lg-2">
                                    <a href="form-buku.php?isbn=<?=$buku["isbn"]?>">
                                        <button class="btn btn-info btn-block mb-1">
                                            Edit
                                        </button>
                                    </a>
                                    

                                    <button class="btn btn-danger btn-block">
                                        Hapus
                                    </button>
                                </div>
                            </div>
                        </li>
                        <?php
                    }
                    ?>
                </ul>
            </div>
            <div class="card-footer">
                <a href="form-buku.php">
                    <button class="btn btn-success">
                        Tambah Data Buku
                    </button>
                </a>
            </div>
        </div>
    </div>
</body>
</html>