<?php
session_start();
include "connect.php";
$message = "";
$kode_order = (isset($_POST['kode_order'])) ? htmlentities($_POST['kode_order']) : "";
$pelanggan = (isset($_POST['pelanggan'])) ? htmlentities($_POST['pelanggan']) : "";
$total = (isset($_POST['total'])) ? htmlentities($_POST['total']) : "";
$method_bayar = (isset($_POST['method_bayar'])) ? htmlentities($_POST['method_bayar']) : "";


if (!empty($_POST['bayar_valid'])) {
    $select = mysqli_query($conn, "SELECT * FROM tb_bayar WHERE id_bayar = '$kode_order'");
    if (mysqli_num_rows($select) > 0) {
        $message = '<script>alert("Produk ini Sudah Dibayar");
                    window.location="../keranjang"</script>';
    } else {
        $query = mysqli_query($conn, "INSERT INTO tb_bayar (id_bayar,metode_bayar,total_bayar) 
        values ('$kode_order','$method_bayar','$total')");
        if ($query) {
            $message = '<script>alert("Pembayaran Berhasil");
                        window.location="../?x=keranjangitem&order='.$kode_order.' &pelanggan='.$pelanggan.' "</script>';
        } else {
            $message = '<script>alert("Pembayaran Gagal");
                        window.location="../?x=keranjangitem&order=' . $kode_order . ' &pelanggan=' . $pelanggan . ' "</script>';
        }
    }
}
echo $message;
?>