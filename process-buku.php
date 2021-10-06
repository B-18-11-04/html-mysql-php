<?php
include "connection.php";
if (isset($_POST["simpan_buku"])) {
    # menampung data yang dikirim ke dalam variable
    $isbn = $_POST["isbn"];
    $judul_buku = $_POST["judul_buku"];
    $penulis = $_POST["penulis"];
    $penerbit = $_POST["penerbit"];
    $jumlah_halaman = $_POST["jumlah_halaman"];
    $genre = $_POST["genre"];

    # manage upload file
    $fileName = $_FILES["cover"]["name"]; // file name
    $extension = pathinfo($_FILES["cover"]["name"]);
    $ext = $extension["extension"]; //ekstensi file 

    $cover = time()."-".$fileName;

    # proses upload
    $folderName = "cover/$cover";
    if (move_uploaded_file($_FILES["cover"]["tmp_name"],$folderName)) {
        # proses insert data ke table buku 
        $sql ="insert into buku values
        ('$isbn','$judul_buku','$penulis','$penerbit',
        '$jumlah_halaman','$genre','$cover')";

        # eksekusi perintah sql
        mysqli_query($connect, $sql);

        echo "Data buku berhasil ditambahkan!";
        #direct ke halaman list buku
        header("location:list-buku.php");
    }
    else{
        echo "Upload data buku gagal, silahkan coba lagi";
    }

}
elseif (isset($_POST["update_buku"])) {
    # menampung data yang dikirim ke dalam variable
    $isbn = $_POST["isbn"];
    $judul_buku = $_POST["judul_buku"];
    $penulis = $_POST["penulis"];
    $penerbit = $_POST["penerbit"];
    $jumlah_halaman = $_POST["jumlah_halaman"];
    $genre = $_POST["genre"];

    # jika update data beserta gambar
    if (!empty($_FILES["cover"]["name"])) {
        #ambil data nama file yg akan dihapus
        $sql = "select * from buku where isbn='$isbn'";
        $hasil = mysqli_query($connect, $sql);
        $buku = mysqli_fetch_array($hasil);
        $oldFileName = $buku["cover"];

        # membuat path file yang lama
        $path = "cover/$oldFileName";

        # cek eksistensi file yg lama
        if (file_exists($path)) {
            # hapus file yg lama
            unlink($path); # menghapus sebuah file
        }

        # membuat file nama baru
        $cover = time()."-".$_FILES["cover"]["name"];
        $folder = "cover/$cover";

        #proses upload file yg baru
        if (move_uploaded_file($_FILES["cover"]["tmp_name"],$folder)) {
            $sql = "update buku set judul_buku='$judul_buku',
            penulis='$penulis',penerbit='$penerbit',
            jumlah_halaman='$jumlah_halaman',genre='$genre',
            cover='$cover'
            where isbn='$isbn'";

            if (mysqli_query($connect, $sql)) {
                # jika update berhasil
                header("location:list-buku.php");
            } else {
                # jika update gagal
                echo $sql;
                echo mysqli_error($connect);
            }
            
        }
    }
    #jika update data saja
    else {
        $sql = "update buku set judul_buku='$judul_buku',
            penulis='$penulis',penerbit='$penerbit',
            jumlah_halaman='$jumlah_halaman',genre='$genre'
            where isbn='$isbn'";

            if (mysqli_query($connect, $sql)) {
                # jika update berhasil
                header("location:list-buku.php");
            } else {
                # jika update gagal
                echo $sql;
                echo mysqli_error($connect);
            }
    }
}
?>