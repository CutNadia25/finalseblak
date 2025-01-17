<?php
$result = [];
include "proses/connect.php";


$query = mysqli_query($conn, "SELECT * , SUM(harga*jumlah) AS harganya FROM tb_list_order
       LEFT JOIN tb_order ON tb_order.id_order = tb_list_order.kode_order
       LEFT JOIN tb_daftar_menu ON tb_daftar_menu.id = tb_list_order.menu
       LEFT JOIN tb_bayar ON tb_bayar.id_bayar = tb_order.id_order
       GROUP BY id_list_order
       HAVING tb_list_order.kode_order = $_GET[order]");


$kode =  $_GET['order'];
$pelanggan =  $_GET['pelanggan'];

while ($record = mysqli_fetch_array($query)) {
    $result[] = $record;
    //$kode =  $record['id_order'];
    //$pelanggan =  $record['pelanggan'];
}
$select_menu = mysqli_query($conn, "SELECT id,nama_menu FROM tb_daftar_menu");
?>



<div class="col-lg-9 mt-2">
    <div class="card">
        <div class="card-header">
            Halaman Keranjang Item
        </div>
        <div class="card-body">
            <a href="keranjang" class="btn btn-info mb-3"><i class="bi bi-arrow-bar-left"></i></a>
            <div class="row">
                <div class="col-lg-6">
                    <div class="form-floating mb-3">
                        <input disabled type="text" class="form-control" id="kodeorder" value="<?php echo $kode; ?>">
                        <label for="KodeOrder">Kode Order</label>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="form-floating mb-3">
                        <input disabled type="text" class="form-control" id="pelanggan" value="<?php echo $pelanggan; ?>">
                        <label for="Pesanan">Pelanggan</label>
                    </div>
                </div>
            </div>
            <!--modal tambah item-->
            <div class="modal fade" id="tambahitem" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg modal-fullscreen-md-down">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah Menu</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form class="needs-validation" novalidate action="proses/proses_input_keranjangitem.php" method="POST">
                                <input type="hidden" name="kode_order" value="<?php echo $kode ?>">
                                <input type="hidden" name="pelanggan" value="<?php echo $pelanggan ?>">
                                <div class="row">
                                    <div class="col-lg-8">
                                        <div class="form-floating mb-3">
                                            <select class="form-select" name="menu" id="">
                                                <option selected hidden value="">Pilih Menu</option>
                                                <?php
                                                foreach ($select_menu as $value) {
                                                    echo "<option value=$value[id]>$value[nama_menu]</option>";
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
                                            <input type="number" class="form-control" id="floatingInput" placeholder="Jumlah Porsi" name="jumlah" required>
                                            <label for="floatingInput">Jumlah Porsi</label>
                                            <div class="invalid-feedback">
                                                Masukkan Jumlah Menu
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="form-floating mb-3">
                                            <input type="text" class="form-control" id="floatingInput" placeholder="Catatan" name="catatan" required>
                                            <label for="floatingInput">Catatan</label>
                                        </div>
                                    </div>
                                </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary" name="input_keranjangitem_valid" value="12345">Save changes</button>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!--end modal tambah item-->
        <?php
        if (empty($result)) {
            echo "Data menu tidak ada";
        } else {
            foreach ($result as $row) {
        ?>
                <!--modal edit-->
                <div class="modal fade" id="ModalEdit<?php echo $row['id_list_order'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg modal-fullscreen-md-down">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Menu</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form class="needs-validation" novalidate action="proses/proses_edit_keranjangitem.php" method="POST">
                                    <input type="hidden" name="id" value="<?php echo $row['id_list_order'] ?>">
                                    <input type="hidden" name="kode_order" value="<?php echo $kode ?>">
                                    <input type="hidden" name="pelanggan" value="<?php echo $pelanggan ?>">
                                    <div class="row">
                                        <div class="col-lg-8">
                                            <div class="form-floating mb-3">
                                                <select class="form-select" name="menu" id="">
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
                                                <input type="number" class="form-control" id="floatingInput" placeholder="Jumlah Porsi" name="jumlah" required value="<?php echo $row['jumlah'] ?>">
                                                <label for="floatingInput">Jumlah Porsi</label>
                                                <div class="invalid-feedback">
                                                    Masukkan Jumlah Menu
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="form-floating mb-3">
                                                <input type="text" class="form-control" id="floatingInput" placeholder="Catatan" name="catatan" required value="<?php echo $row['catatan'] ?>">
                                                <label for="floatingInput">Catatan</label>
                                            </div>
                                        </div>
                                    </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary" name="edit_keranjangitem_valid" value="12345">Save changes</button>
                            </div>
                            </form>
                        </div>
                    </div>
                </div>

                <!--end modal edit-->



                <!--modal delete-->
                <div class="modal fade" id="ModalDelete<?php echo $row['id_list_order'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-md modal-fullscreen-md-down">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="exampleModalLabel">Hapus Menu</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form class="needs-validation" novalidate action="proses/proses_delete_keranjangitem.php" method="POST">
                                    <input type="hidden" value="<?php echo $row['id_list_order'] ?>" name="id">
                                    <input type="hidden" name="kode_order" value="<?php echo $kode ?>">
                                    <input type="hidden" name="pelanggan" value="<?php echo $pelanggan ?>">
                                    <div class="col-lg-12">
                                        Apakah anda ingin menghapus menu <b><?php echo $row['nama_menu'] ?></b>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-danger" name="delete_keranjangitem_valid" value="12345">Hapus</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <!--end modal delete -->

            <?php
            }
            ?>

            <!--modal bayar-->
            <div class="modal fade" id="bayar" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg modal-fullscreen-md-down">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">Pembayaran</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-hover">
                                    <thead>
                                        <tr class="text-nowrap">
                                            <th scope="col">Menu</th>
                                            <th scope="col">Harga</th>
                                            <th scope="col">Qty</th>
                                            <th scope="col">Status</th>
                                            <th scope="col">Catatan</th>
                                            <th scope="col">Total</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $total = 0;
                                        foreach ($result as $row) {
                                        ?>
                                            <tr>
                                                <td><?php echo $row['nama_menu'] ?></td>
                                                <td><?php echo number_format($row['harga'], 0, ',', '.') ?></td>
                                                <td><?php echo $row['jumlah'] ?></td>
                                                <td><?php echo $row['status'] ?></td>
                                                <td><?php echo $row['catatan'] ?></td>
                                                <td><?php echo number_format($row['harganya'], 0, ',', '.') ?></td>
                                            </tr>
                                        <?php
                                            $total += $row['harganya'];
                                        }
                                        ?>
                                        <tr>
                                            <td colspan="5" class="fw-bold">
                                                Total Harga
                                            </td>
                                            <td class="fw-bold">
                                                <?php echo number_format($total, 0, ',', '.') ?>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <SPan class="text-danger fs-5 fw-semi-bold">Apakah Anda Yakin Ingin Melakukan Pembayaran?</SPan>
                            <form class="needs-validation" novalidate action="proses/proses_bayar.php" method="POST">
                                <input type="hidden" name="kode_order" value="<?php echo $kode ?>">
                                <input type="hidden" name="pelanggan" value="<?php echo $pelanggan ?>">
                                <input type="hidden" name="total" value="<?php echo $total ?>">
                                <div class="col-lg-12">
                                    <div class="form-floating mb-3">
                                        <select class="form-select" id="floatingselect" placeholder="metodebayar" name="method_bayar" required>
                                            <option selected hidden>Pilih Metode Pembayaran</option>
                                            <option value="1">Transfer</option>
                                            <option value="2">COD</option>
                                        </select>
                                        <div class="invalid-feedback">
                                            Pilih Metode Pembayaran
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary" name="bayar_valid" value="12345">Bayar</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!--end modal bayar-->
            <div class="table-responsive">
                <table class="table table-striped table-hover">
                    <thead>
                        <tr class="text-nowrap">
                            <th scope="col">Menu</th>
                            <th scope="col">Harga</th>
                            <th scope="col">Qty</th>
                            <th scope="col">Status</th>
                            <th scope="col">Catatan</th>
                            <th scope="col">Total</th>
                            <th scope="col">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $total = 0;
                        foreach ($result as $row) {
                        ?>
                            <tr>
                                <td><?php echo $row['nama_menu'] ?></td>
                                <td><?php echo number_format($row['harga'], 0, ',', '.')?></td>
                                <td><?php echo $row['jumlah'] ?></td>
                                <td><?php
                                         if($row['status']==1){
                                            echo "<span class='badge text-bg-warning'>Masuk ke pelayan</span>";
                                         }elseif($row['status']==2){
                                            echo "<span class='badge text-bg-primary'>Siap diantar</span>";
                                         }
                                      ?>
                                    </td>
                                <td><?php echo $row['catatan'] ?></td>
                                <td><?php echo number_format($row['harganya'], 0, ',', '.')?></td>
                                <td>
                                    <div class="d-flex">
                                        <button class="<?php echo (!empty($row['id_bayar'])) ? "btn btn-secondary btn-sm me-2 disabled" : "btn btn-warning btn-sm me-2"; ?>" data-bs-toggle="modal" data-bs-target="#ModalEdit<?php echo $row['id_list_order'] ?>"><i class="bi bi-pencil-square"></i></button>
                                        <button class="<?php echo (!empty($row['id_bayar'])) ? "btn btn-secondary btn-sm me-2 disabled" : "btn btn-danger btn-sm me-2"; ?>" data-bs-toggle="modal" data-bs-target="#ModalDelete<?php echo $row['id_list_order'] ?>"><i class="bi bi-trash3"></i></button>
                                    </div>
                                </td>
                            </tr>
                        <?php
                            $total += $row['harganya'];
                        }
                        ?>
                        <tr>
                            <td colspan="5" class="fw-bold">
                                Total Harga
                            </td>
                            <td class="fw-bold">
                                <?php echo number_format($total, 0, ',', '.') ?>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        <?php
        }
        ?>
        <div>
            <button class="<?php echo (!empty($row['id_bayar'])) ? "btn btn-secondary disabled" : "btn btn-success"; ?>" data-bs-toggle="modal" data-bs-target="#tambahitem"><i class="bi bi-plus-lg"></i> Item</button>
            <button class="<?php echo (!empty($row['id_bayar'])) ? "btn btn-secondary disabled" : "btn btn-primary"; ?>" data-bs-toggle="modal" data-bs-target="#bayar"><i class="bi bi-coin"></i> Bayar</button>
        </div>
    </div>
</div>
</div>