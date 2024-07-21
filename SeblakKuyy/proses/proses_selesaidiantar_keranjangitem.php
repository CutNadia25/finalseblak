<?php
session_start();
include "connect.php";
$message = "";
$id =  (isset($_POST['id'])) ? htmlentities($_POST['id']) : "";
//$catatan =  (isset($_POST['catatan'])) ? htmlentities($_POST['catatan']) : "";

if (!empty($_POST['selesaidiantar_keranjangitem_valid'])) {
    $query = mysqli_query($conn, "UPDATE tb_list_order SET status=3 WHERE id_list_order ='$id'");
    if ($query) {
        $message = '<script>alert("Order sudah diantar oleh kurir");
        window.location="../pengiriman"</script>';
    } else {
        $message = '<script>alert("Order gagal diantar oleh kurir");
        window.location="../pengiriman"</script>';
    }
}
echo $message;
?>
