<?php
include "connect.php";
$message = "";
$id =  (isset($_POST['id'])) ? htmlentities($_POST['id']) : "";
$kode_order =  (isset($_POST['kode_order'])) ? htmlentities($_POST['kode_order']) : "";
$pelanggan =  (isset($_POST['pelanggan'])) ? htmlentities($_POST['pelanggan']) : "";
if (!empty($_POST['delete_keranjangitem_valid'])) {
        $query = mysqli_query($conn, "DELETE FROM tb_list_order WHERE id_list_order = '$id'");
        if ($query) {
            $message = '<script>alert("Data Berhasil Dihapus");
       window.location="../?x=keranjangitem&order=' . $kode_order . '&pelanggan=' . $pelanggan .'" </script>';
        } else {
            $message = '<script>alert("Data Gagal Dihapus")
        window.location="../?x=keranjangitem&order=' . $kode_order . '&pelanggan=' . $pelanggan . '"</script>';
        }
}
echo $message;
