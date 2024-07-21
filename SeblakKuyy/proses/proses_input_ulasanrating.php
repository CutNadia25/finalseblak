<?php 
include "connect.php";
$message = "";
$id = (isset($_POST['id'])) ? htmlentities($_POST['id']) : "";
$email = (isset($_POST['email'])) ? htmlentities($_POST['email']) : "";
$nama = (isset($_POST['nama'])) ? htmlentities($_POST['nama']) : "";
$rating_bintang = (isset($_POST['rating_bintang'])) ? htmlentities($_POST['rating_bintang']) : "";
$ktitik = (isset($_POST['ktitik'])) ? htmlentities($_POST['ktitik']) : "";
$saran = (isset($_POST['saran'])) ? htmlentities($_POST['saran']) : "";

if (!empty($_POST['input_ulasan_valid'])) {
    $select = mysqli_query($conn, "SELECT * FROM tb_ulasan_rating WHERE id = '$id'");
    if (mysqli_num_rows($select) > 0) {
        $message = '<script>alert("ID Yang Anda Masukkan Sudah Ada");
        window.location="../ulasanrating"</script>';
    } else {
        $query = mysqli_query($conn, "INSERT INTO tb_ulasan_rating (email, nama, rating_bintang, ktitik, saran) VALUES ('$email', '$nama', '$rating_bintang', '$ktitik', '$saran')");
        if ($query) {
            $message = '<script>alert("Ulasan dan Rating Berhasil Dimasukkan");
            window.location="../ulasanrating"</script>';
        } else {
            $message = '<script>alert("Ulasan dan Rating Gagal Dimasukkan")</script>';
        }
    }
}
echo $message;
?>
