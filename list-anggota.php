<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Anggota Perpustakaan</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <div class="card">
            <!-- card header -->
            <div class="card-header bg-info">
                <h4 class="text-white">Data Anggota Perpustakaan</h4>
            </div>

            <!-- card body -->
            <div class="card-body">
                <!-- kotak pencarian data anggota -->
                <form action="list-anggota.php" method="get">
                <input type="text" name="search"
                class="form-control mb-2"
                placeholder="Masukkan Keyword Pencarian"
                required />
                </form>
                <ul class="list-group">
                    <?php
                    include("connection.php");
                    if (isset($_GET["search"])) {
                        # jika pada saat load halaman ini
                        # akan mengecek apakah ada data dengan method
                        # GET yg bernama "search"
                        $search = $_GET["search"];
                        $sql = "select * from anggota
                        where id_anggota like '%$search%'
                        or nama_anggota like '%$search%'
                        or alamat like '%$search%'
                        or telepon like '%$search%'";
                    } else {
                        $sql = "select * from anggota";
                    }
                    
                    

                    // eksekusi perintah SQL
                    $query = mysqli_query($connect, $sql);
                    while ($anggota = mysqli_fetch_array($query)) { ?>
                       <li class="list-group-item">
                        <div class="row">
                            <!-- bagian data anggota -->
                            <div class="col-lg-8 col-md-10">
                                <h5>Nama Anggota: <?php echo $anggota["nama_anggota"]; ?></h5>
                                <h6>Alamat: <?php echo $anggota["alamat"]; ?></h6>
                                <h6>Telepon: <?php echo $anggota["telepon"]; ?></h6>
                                <h6>ID Anggota: <?php echo $anggota["id_anggota"]; ?></h6>
                            </div>

                            <!-- bagian tombol pilihan -->
                            <div class="col-lg-4 col-md-2">
                            <a href="form-anggota.php?id_anggota=<?php echo $anggota["id_anggota"]?>">
                                <button class="btn btn-block btn-info">
                                    Edit
                                </button>
                            </a>
                            <div class="card-footer">
                            <a href="delete.php?id_anggota=<?=$anggota["id_anggota"]?>">
                            <button class="btn btn-block btn-danger" onclick="return confirm('Apakah anda yakin menghapus data ini')">
                                Hapus
                            </button>
                            </a>
                            </div>
                            
                        </div>
                    </li> 
                    <?php
                    }
                    ?>
                    
                </ul>
            </div>

            <div class="card-footer">
                <a href="form-anggota.php">
                    <button class="btn btn-success">
                        Tambah Data Anggota
                    </button>
                </a>
            </div>

        </div>
    </div>
</body>
</html>