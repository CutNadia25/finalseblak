<?php
$result = [];
include "proses/connect.php";
date_default_timezone_set('Asia/Jakarta');
$query = mysqli_query($conn, "SELECT tb_order.* , tb_bayar. *, nama, SUM(harga*jumlah) AS harganya FROM tb_order
       LEFT JOIN tb_user ON tb_user.id = tb_order.pelayan
       LEFT JOIN tb_list_order ON tb_list_order.kode_order = tb_order.id_order
       LEFT JOIN tb_daftar_menu ON tb_daftar_menu.id = tb_list_order.menu
       JOIN tb_bayar ON tb_bayar.id_bayar = tb_order.id_order
       GROUP BY id_order ORDER BY waktu_order ASC");
while ($record = mysqli_fetch_array($query)) {
    $result[] = $record;
}
?>



<div class="col-lg-9 mt-2">
    <div class="card">
        <div class="card-header">
            Halaman Report
        </div>
        <div class="card-body">
        <?php
        if (empty($result)) {
            echo "Data menu tidak ada";
        } else {
            foreach ($result as $row) {
        ?>
            <?php
            }
            ?>
            <div class="table-responsive">
                <table class="table table-striped table-hover" id="example">
                    <thead>
                        <tr class="text-nowrap">
                            <th scope="col">No</th>
                            <th scope="col">Kode Order</th>
                            <th scope="col">Waktu Order</th>
                            <th scope="col">Waktu Bayar</th>
                            <th scope="col">Pelanggan</th>
                            <th scope="col">Total Harga</th>
                            <th scope="col">pelayan</th>
                            <th scope="col">Level Pedas</th>
                            <th scope="col">Tipe Kuah</th>
                            <th scope="col">Alamat</th>
                            <th scope="col">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 1;
                        foreach ($result as $row) {
                        ?>
                            <tr>
                                <th scope="row">
                                    <?php echo $no++ ?>
                                </th>
                                <td><?php echo $row['id_order'] ?></td>
                                <td><?php echo $row['waktu_order'] ?></td>
                                <td><?php echo $row['waktu_bayar'] ?></td>
                                <td><?php echo $row['pelanggan'] ?></td>
                                <td><?php echo number_format((int)$row['harganya'],0,',','.') ?></td>
                                <td><?php echo $row['nama'] ?></td>
                                <td><?php echo $row['level_pedas'] ?></td>
                                <td><?php echo $row['tipe_kuah'] ?></td>
                                <td><?php echo $row['alamat'] ?></td>
                                <td>
                                    <div class="d-flex">
                                        <a class="btn btn-info btn-sm me-2" href="./?x=viewitem&order=<?php echo $row['id_order'] . "&pelanggan=" . $row['pelanggan'] ?>"><i class="bi bi-eye-fill"></i></a>
                                    </div>
                                </td>
                            </tr>
                        <?php
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        <?php
        }
        ?>
    </div>
</div>
</div>