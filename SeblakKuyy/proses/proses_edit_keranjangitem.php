<?php
session_start();
include "connect.php";
$message = "";
$id =  (isset($_POST['id'])) ? htmlentities($_POST['id']) : "";
$kode_order =  (isset($_POST['kode_order'])) ? htmlentities($_POST['kode_order']) : "";
$pelanggan =  (isset($_POST['pelanggan'])) ? htmlentities($_POST['pelanggan']) : "";
$catatan =  (isset($_POST['catatan'])) ? htmlentities($_POST['catatan']) : "";
//$level_pedas =  (isset($_POST['level_pedas'])) ? htmlentities($_POST['level_pedas']) : "";
//$tipe_kuah =  (isset($_POST['tipe_kuah'])) ? htmlentities($_POST['tipe_kuah']) : "";
$menu =  (isset($_POST['menu'])) ? htmlentities($_POST['menu']) : "";
$jumlah =  (isset($_POST['jumlah'])) ? htmlentities($_POST['jumlah']) : "";

if (!empty($_POST['edit_keranjangitem_valid'])) {
    $select = mysqli_query($conn, "SELECT * FROM tb_list_order WHERE menu = '$menu' && kode_order = '$kode_order' && id_list_order != '$id'");
    if (mysqli_num_rows($select) > 0) {
        $message = '<script>alert("Item Yang Anda Masukkan Sudah Ada");
         window.location="../?x=keranjangitem&order=' . $kode_order . '&pelanggan=' . $pelanggan . '"</script>';
    } else {
        $query = mysqli_query($conn, "UPDATE tb_list_order SET menu='$menu',jumlah='$jumlah',catatan='$catatan' WHERE id_list_order ='$id'");
        if ($query) {
            $message = '<script>alert("Data Berhasil Dimasukkan");
            window.location="../?x=keranjangitem&order=' . $kode_order . '&pelanggan=' . $pelanggan . '"</script>
            </script>';
        } else {
            $message = '<script>alert("Data Gagal Dimasukkan");
        window.location="../?x=keranjangitem&order=' . $kode_order . '&pelanggan=' . $pelanggan . '"</script>
            </script>';
        }
    }
}
echo $message;
