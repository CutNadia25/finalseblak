<?php
$result = [];
include "proses/connect.php";

$query = mysqli_query($conn, "SELECT * FROM tb_list_order
       LEFT JOIN tb_order ON tb_order.id_order = tb_list_order.kode_order
       LEFT JOIN tb_daftar_menu ON tb_daftar_menu.id = tb_list_order.menu
       LEFT JOIN tb_bayar ON tb_bayar.id_bayar = tb_order.id_order ORDER BY waktu_order ASC");

while ($record = mysqli_fetch_array($query)) {
    if ($record['status'] == 2) {
        $result[] = $record;
    }
}

$select_menu = mysqli_query($conn, "SELECT id,nama_menu FROM tb_daftar_menu");
?>

<div class="col-lg-9 mt-2">
    <div class="card">
        <div class="card-header">
            Halaman Pengiriman
        </div>
        <div class="card-body">
            <?php
            if (empty($result)) {
                echo "Data menu tidak ada";
            } else {
                foreach ($result as $row) {

                    
            ?>

                    <!--modal selesai dibuat -->
                    <div class="modal fade" id="selesaidiantar<?php echo $row['id_list_order'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg modal-fullscreen-md-down">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Apakah anda sudah mengantar pesanan ini?</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form class="needs-validation" novalidate action="proses/proses_selesaidiantar_keranjangitem.php" method="POST">
                                        <input type="hidden" name="id" value="<?php echo $row['id_list_order'] ?>">
                                        <div class="row">
                                            <div class="col-lg-8">
                                                <div class="form-floating mb-3">
                                                    <select disabled class="form-select" name="menu" id="">
                                                        <option selected hidden value="">Pilih Menu</option>
                                                        <?php
                                                        foreach ($select_menu as $value) {
                                                            if ($row['menu'] == $value['id']) {
                                                                echo "<option selected value=$value[id]>$value[nama_menu]</option>";
                                                            } else {
                                                                echo "<option value=$value[id]>$value[nama_menu]</option>";
                                                            }
                                                        }
                                                        ?>
                                                    </select>
                                                    <label for="menu">Menu Makanan</label>
                                                    <div class="invalid-feedback">
                                                        Pilih Menu
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-4">
                                                <div class="form-floating mb-3">
                                                    <input disabled type="number" class="form-control" id="floatingInput" placeholder="Jumlah Porsi" name="jumlah" required value="<?php echo $row['jumlah'] ?>">
                                                    <label for="floatingInput">Jumlah Porsi</label>
                                                    <div class="invalid-feedback">
                                                        Masukkan Jumlah Menu
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary" name="selesaidiantar_keranjangitem_valid" value="12345">Antar</button>
                                </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    <!--end modal selesai dibuat-->

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
                                <th scope="col">Menu</th>
                                <th scope="col">Qty</th>
                                <th scope="col">Catatan</th>
                                <th scope="col">Status</th>
                                <th scope="col">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $no = 1;
                            foreach ($result as $row) {
                                if($row['status'] !=3 ){
                            ?>
                                <tr>
                                    <td><?php echo $no++ ?></td>
                                    <td><?php echo $row['kode_order'] ?></td>
                                    <td><?php echo $row['waktu_order'] ?></td>
                                    <td><?php echo $row['nama_menu'] ?></td>
                                    <td><?php echo $row['jumlah'] ?></td>
                                    <td><?php echo $row['catatan'] ?></td>
                                    <td><?php
                                         if($row['status']==1){
                                            echo "<span class='badge text-bg-warning'>Masuk ke pelayan</span>";
                                         }elseif($row['status']==2){
                                            echo "<span class='badge text-bg-primary'>Siap diantar</span>";
                                         }
                                      ?>
                                    </td>
                                    <td>
                                        <div class="d-flex">
                                            <button class="btn btn-success btn-sm me-2 text-nowrap" data-bs-toggle="modal" data-bs-target="#selesaidiantar<?php echo $row['id_list_order'] ?>">Kirim</button>
                                        </div>
                                    </td>
                                </tr>
                            <?php
                            }
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