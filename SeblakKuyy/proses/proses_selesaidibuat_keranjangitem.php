<?php
session_start();
include "connect.php";
$message = "";
$id =  (isset($_POST['id'])) ? htmlentities($_POST['id']) : "";
$catatan =  (isset($_POST['catatan'])) ? htmlentities($_POST['catatan']) : "";

if (!empty($_POST['selesaidibuat_keranjangitem_valid'])) {
        $query = mysqli_query($conn, "UPDATE tb_list_order SET menu=catatan='$catatan',status=2 WHERE id_list_order ='$id'");
        if ($query) {
            $message = '<script>alert("Order siap diantar oleh kurir");
            window.location="../pelayan"</script>';
        } else {
            $message = '<script>alert("Order gagal diantar oleh kurir");
        window.location="../pelayan"</script>';
        }
}
echo $message;
