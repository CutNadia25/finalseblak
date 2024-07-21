<?php 
session_start();
include "connect.php";
$message = "";
$kode_order =  (isset($_POST['kode_order'])) ? htmlentities($_POST['kode_order']) : "";
$pelanggan =  (isset($_POST['pelanggan'])) ? htmlentities($_POST['pelanggan']) : "";
$level_pedas =  (isset($_POST['level_pedas'])) ? htmlentities($_POST['level_pedas']) : "";
$tipe_kuah =  (isset($_POST['tipe_kuah'])) ? htmlentities($_POST['tipe_kuah']) : "";

if(!empty($_POST['edit_order_valid'])){
           $query = mysqli_query($conn, "UPDATE tb_order SET pelanggan='$pelanggan',level_pedas='$level_pedas',tipe_kuah='$tipe_kuah' WHERE id_order = '$kode_order'");
           if($query){
            $message = '<script>alert("Data Berhasil Dimasukkan");
            window.location="../keranjang"</script>';
    }else{
        $message = '<script>alert("Data Gagal Dimasukkan");
         window.location="../keranjang"</script>';
    
  }
}
echo $message;
?>