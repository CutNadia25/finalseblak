<?php
include "connect.php";
$message = "";
$kode_order =  (isset($_POST['kode_order'])) ? htmlentities($_POST['kode_order']) : "";
if (!empty($_POST['delete_order_valid'])) {
    $select = mysqli_query($conn, "SELECT kode_order FROM tb_list_order WHERE kode_order = '$kode_order'");
    if (mysqli_num_rows($select) > 0) {
        $message = '<script>alert("Order telah memiliki item order, data order ini tidak dapat dihapus");
        window.location="../keranjang"</script>';
    } else {
        $query = mysqli_query($conn, "DELETE FROM tb_order WHERE id_order = '$kode_order'");
        if ($query) {
            $message = '<script>alert("Data Berhasil Dihapus");
        window.location="../keranjang"</script>';
        } else {
            $message = '<script>alert("Data Gagal Dihapus")
        window.location="../keranjang"</script>';
        }
    }
}
echo $message;
