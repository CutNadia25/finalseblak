<?php
include "connect.php";
$message = "";
$nama_menu =  (isset($_POST['nama_menu'])) ? htmlentities($_POST['nama_menu']) : "";
$keterangan =  (isset($_POST['keterangan'])) ? htmlentities($_POST['keterangan']) : "";
$harga =  (isset($_POST['harga'])) ? htmlentities($_POST['harga']) : "";
$stok=  (isset($_POST['stok'])) ? htmlentities($_POST['stok']) : "";

$kode_rand = rand(10000,99999)."-";
$target_dir = "../assets/img/".$kode_rand;
$target_file = $target_dir . basename($_FILES['foto']['name']);
$imagetype = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
if (!empty($_POST['input_menu_valid'])) {
    // cek apakah gambar atau bukan
    $cek = getimagesize($_FILES['foto']['tmp_name']);
    if ($cek === false) {
        $message = "Ini Bukan File Gambar";
        $statusUpload = 0;
    } else {
        $statusUpload = 1;
        if (file_exists($target_file)) {
            $message = "Maaf, File Yang Anda Masukkan Sudah Ada";
            $statusUpload = 0;
        } else {
            if ($_FILES['foto']['size'] > 500000) {  //500kb
                $message = "Maaf, File Foto Yang Anda Masukkan Terlalu Besar";
                $statusUpload = 0;
            } else {
                if ($imagetype != "jpg" && $imagetype != "png" && $imagetype != "jpeg" && $imagetype != "gif") {
                    $message = "Maaf, Hanya Diperbolehkan Gambar Yang Memiliki Format JPG,JPEG,PNG dan GIF";
                    $statusUpload = 0;
                }
            }
        }
    }


    if ($statusUpload == 0) {
        $message = '<script>alert("' . $message . ',Gambar Tidak Dapat Diupload");
        window.location="../menu"</script>';
    } else {
        $select = mysqli_query($conn, "SELECT * FROM tb_daftar_menu WHERE nama_menu = '$nama_menu'");
        if (mysqli_num_rows($select) > 0) {
            $message = '<script>alert("Nama Menu Yang Anda Masukkan Sudah Ada");
        window.location="../menu"</script>';
        } else {
            if (move_uploaded_file($_FILES['foto']['tmp_name'], $target_file)) {
                $query = mysqli_query($conn, "INSERT INTO tb_daftar_menu (foto,nama_menu,keterangan,harga,stok) values ('".$kode_rand. $_FILES['foto']['name'] . "','$nama_menu','$keterangan','$harga','$stok')");
                if ($query) {
                    $message = '<script>alert("Data Berhasil Dimasukkan");
                    window.location="../menu"</script>';
                } else {
                    $message = '<script>alert("Data Gagal Dimasukkan");
                   window.location="../menu"</script>';
                }
            } else {
                $message = '<script>alert("Maaf, Terjadi Kesalahan File Tidak Dapat Diupload");
                window.location="../menu"</script>';
            }
        }
    }
}
echo $message;
?>
