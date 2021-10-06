<?php
include("connection.php");
if (isset($_POST["simpan_anggota"])) {
    # proses insert new data
    // tampung data input anggota dari user
    $id_anggota = $_POST["id_anggota"];
    $nama_anggota = $_POST["nama_anggota"];
    $telepon = $_POST["telepon"];
    $alamat = $_POST["alamat"];
    $tgl_lahir = $_POST["tgl_lahir"];

    // membuat perintah SQL utk insert data ke tbl anggota
    $sql = "insert into anggota values ('$id_anggota',
    '$nama_anggota','$tgl_lahir','$alamat','$telepon')";

    // eksekusi perintah / menjalankan perintah SQL
    mysqli_query($connect, $sql);

    // direct / dikembalikan ke halaman list anggota
    header("location:list-anggota.php");
}

if (isset($_POST["edit_anggota"])) {
    # tampung data yg akan diupdate
    $id_anggota = $_POST["id_anggota"];
    $nama_anggota = $_POST["nama_anggota"];
    $telepon = $_POST["telepon"];
    $alamat = $_POST["alamat"];
    $tgl_lahir = $_POST["tgl_lahir"];

    # perintah SQL update ke table anggota
    $sql = "update anggota set nama_anggota='$nama_anggota',
    telepon='$telepon',alamat='$alamat',tgl_lahir='$tgl_lahir' where id_anggota='$id_anggota'";

    # eksekusi perintah SQL
    mysqli_query($connect, $sql);

    # direct / dikembalikan ke halaman list anggota
    header("location:list-anggota.php");
}
?>