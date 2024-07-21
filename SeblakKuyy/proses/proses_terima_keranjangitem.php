<?php
session_start();
include "connect.php";
$message = "";
$id =  (isset($_POST['id'])) ? htmlentities($_POST['id']) : "";
$catatan =  (isset($_POST['catatan'])) ? htmlentities($_POST['catatan']) : "";

if (!empty($_POST['terima_keranjangitem_valid'])) {
        $query = mysqli_query($conn, "UPDATE tb_list_order SET menu=catatan='$catatan',status=1 WHERE id_list_order ='$id'");
        if ($query) {
            $message = '<script>alert("Berhasil terima order oleh pelayan");
            window.location="../pelayan"</script>';
        } else {
            $message = '<script>alert("Gagal terima order oleh pelayan");
        window.location="../pelayan"</script>';
        }
}
echo $message;
