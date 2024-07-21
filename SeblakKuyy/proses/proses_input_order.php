<?php 
session_start();
include "connect.php";
$message = "";
$kode_order =  (isset($_POST['kode_order'])) ? htmlentities($_POST['kode_order']) : "";
$pelanggan =  (isset($_POST['pelanggan'])) ? htmlentities($_POST['pelanggan']) : "";
//$catatan =  (isset($_POST['catatan'])) ? htmlentities($_POST['catatan']) : "";
$level_pedas =  (isset($_POST['level_pedas'])) ? htmlentities($_POST['level_pedas']) : "";
$tipe_kuah =  (isset($_POST['tipe_kuah'])) ? htmlentities($_POST['tipe_kuah']) : "";
$alamat =  (isset($_POST['alamat'])) ? htmlentities($_POST['alamat']) : "";

if(!empty($_POST['input_order_valid'])){
    $select = mysqli_query($conn, "SELECT * FROM tb_order WHERE id_order = '$kode_order'");
    if(mysqli_num_rows($select) > 0){
        $message = '<script>alert("Order Yang Anda Masukkan Sudah Ada");
        window.location="../order"</script>
        </script>';
    }else{    
           $query = mysqli_query($conn, "INSERT INTO tb_order (id_order,pelanggan,level_pedas,tipe_kuah,pelayan,alamat) values ('$kode_order','$pelanggan','$level_pedas','$tipe_kuah','$_SESSION[id_SeblakKuyy]','$alamat')");
           if($query){
            $message = '<script>alert("Data Berhasil Dimasukkan");
            window.location="../?x=keranjangitem&order='.$kode_order.'&pelanggan='.$pelanggan.'"</script>
            </script>';
    }else{
        $message = '<script>alert("Data Gagal Dimasukkan")</script>';
    }
  }
}
echo $message;
?>