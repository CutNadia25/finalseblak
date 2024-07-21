<?php
$result = [];
include "proses/connect.php";
date_default_timezone_set('Asia/Jakarta');
$query = mysqli_query($conn, "SELECT tb_order.* , tb_bayar. *, nama, SUM(harga*jumlah) AS harganya FROM tb_order
       LEFT JOIN tb_user ON tb_user.id = tb_order.pelayan
       LEFT JOIN tb_list_order ON tb_list_order.kode_order = tb_order.id_order
       LEFT JOIN tb_daftar_menu ON tb_daftar_menu.id = tb_list_order.menu
       LEFT JOIN tb_bayar ON tb_bayar.id_bayar = tb_order.id_order
       GROUP BY id_order ORDER BY waktu_order DESC");
while ($record = mysqli_fetch_array($query)) {
    $result[] = $record;
}
?>



<div class="col-lg-9 mt-2">
    <div class="card">
        <div class="card-header">
            Halaman Keranjang
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col d-flex justify-content-end">
                    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#ModalTambahUser">Tambah Order</button>
                </div>
            </div>
            <!--modal tambah order-->
            <div class="modal fade" id="ModalTambahUser" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg modal-fullscreen-md-down">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah Order</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form class="needs-validation" novalidate action="proses/proses_input_order.php"     method="POST">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-floating mb-3">
                                            <input type="text" class="form-control" id="UploadFoto" name="kode_order" value="<?php echo date('ymdHi') . rand(100, 999) ?>" readonly>
                                            <label for="UploadFoto">Kode Order</label>
                                            <div class="invalid-feedback">
                                                Harap Masukkan Kode Order
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-floating mb-3">
                                            <input type="text" class="form-control" id="pelanggan" placeholder="Nama Pelanggan" name="pelanggan" required>
                                            <label for="pelanggan">Nama Pelanggan</label>
                                            <div class="invalid-feedback">
                                                Harap Masukkan Nama Pelanggan
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-4">
                                            <div class="form-floating mb-3">
                                                <select class="form-select" aria-label="Default select example" name="level_pedas" required>
                                                    <option selected hidden>Pilih Level Pedas</option>
                                                    <option value="1">1 </option>
                                                    <option value="2">2 </option>
                                                    <option value="3">3 </option>
                                                    <option value="4">4 </option>
                                                    <option value="5">5 </option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="form-floating mb-3">
                                                <select class="form-select" aria-label="Default select example" name="tipe_kuah" required>
                                                    <option selected hidden>Pilih Tipe Kuah</option>
                                                    <option value="1">Berkuah</option>
                                                    <option value="2">Nyemek</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                        <div class="form-floating mb-3">
                                            <input type="text" class="form-control" id="alamat" placeholder="alamat" name="alamat" required>
                                            <label for="pelanggan">Alamat</label>
                                            <div class="invalid-feedback">
                                                Harap Masukkan Alamat
                                            </div>
                                        </div>
                                    </div>
                                    </div>
                                </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary" name="input_order_valid" value="12345">Buat Pesanan</button>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!--end modal tambah order-->
        <?php
        if (empty($result)) {
            echo "Data menu tidak ada";
        } else {
            foreach ($result as $row) {
        ?>
                <!--modal edit-->
                <div class="modal fade" id="ModalEdit<?php echo $row['id_order'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-xl modal-fullscreen-md-down">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Menu</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                            <form class="needs-validation" novalidate action="proses/proses_edit_order.php"     method="POST">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-floating mb-3">
                                            <input readonly type="text" class="form-control" id="UploadFoto" name="kode_order" value="<?php echo $row['id_order'] ?>" readonly>
                                            <label for="UploadFoto">Kode Order</label>
                                            <div class="invalid-feedback">
                                                Harap Masukkan Kode Order
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-floating mb-3">
                                            <input type="text" class="form-control" id="pelanggan" placeholder="Nama Pelanggan" name="pelanggan" required value="<?php echo $row['pelanggan'] ?>">
                                            <label for="pelanggan">Nama Pelanggan</label>
                                            <div class="invalid-feedback">
                                                Harap Masukkan Nama Pelanggan
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-4">
                                            <div class="form-floating mb-3">
                                                <select class="form-select" aria-label="Default select example" name="level_pedas" required value="<?php echo $row['level_pedas'] ?>">
                                                    <option selected hidden>Pilih Level Pedas</option>
                                                    <option value="1">1 </option>
                                                    <option value="2">2 </option>
                                                    <option value="3">3 </option>
                                                    <option value="4">4 </option>
                                                    <option value="5">5 </option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="form-floating mb-3">
                                                <select class="form-select" aria-label="Default select example" name="tipe_kuah" required value="<?php echo $row['tipe_kuah'] ?>">
                                                    <option selected hidden>Pilih Tipe Kuah</option>
                                                    <option value="1">Berkuah</option>
                                                    <option value="2">Nyemek</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary" name="edit_order_valid" value="12345">Simpan</button>
                        </div>
                        </form>
                        </div>
                    </div>
                </div>

                <!--end modal edit-->



                <!--modal delete-->
                <div class="modal fade" id="ModalDelete<?php echo $row['id_order'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-md modal-fullscreen-md-down">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="exampleModalLabel">Hapus Data User</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form class="needs-validation" novalidate action="proses/proses_delete_order.php" method="POST">
                                    <input type="hidden" value="<?php echo $row['id_order'] ?>" name="kode_order">
                                    <div class="col-lg-12">
                                        Apakah anda ingin menghapus order atas nama <b><?php echo $row['pelanggan'] ?></b> dengan kode order <b><?php echo $row['id_order'] ?></b>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-danger" name="delete_order_valid" value="12345">Hapus</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <!--end modal delete -->

                <!--modal ubah passoword-->
                <div class="modal fade" id="ModalResetPassword<?php echo $row['id'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-md modal-fullscreen-md-down">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="exampleModalLabel">Reset Password</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form class="needs-validation" novalidate action="proses/proses_reset_password.php" method="POST">
                                    <input type="hidden" value="<?php echo $row['id'] ?>" name="id">
                                    <div class="col-lg-12">
                                        <?php
                                        if ($row['username'] == $_SESSION['username_SeblakKuyy']) {
                                            echo "<div class='alert alert-danger'>Anda Tidak Dapat Mereset Password Sendiri</div>";
                                        } else {
                                            echo "Apakah Anda Yakin Ingin Mereset Pssword User <b>$row[username]</b> Menjadi Password Bawaan Sistem Yaitu <b>password</b>";
                                        }
                                        ?>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-success" name="input_user_valid" value="12345" <?php echo ($row['username'] == $_SESSION['username_SeblakKuyy']) ? 'disabled' : ''; ?>>Reset Password</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <!--end modal ubah password -->
            <?php
            }
            ?>
            <div class="table-responsive">
                <table class="table table-striped table-hover" id="example">
                    <thead>
                        <tr class="text-nowrap">
                            <th scope="col">No</th>
                            <th scope="col">Kode Order</th>
                            <th scope="col">Pelanggan</th>
                            <th scope="col">Total Harga</th>
                            <th scope="col">Status</th>
                            <th scope="col">pelayan</th>
                            <th scope="col">Level Pedas</th>
                            <th scope="col">Tipe Kuah</th>
                            <th scope="col">Alamat</th>
                            <th scope="col">Waktu Order</th>
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
                                <td><?php echo $row['pelanggan'] ?></td>
                                <td><?php echo number_format((int)$row['harganya'],0,',','.') ?></td>
                                <td><?php echo (!empty($row['id_bayar'])) ? "<span class='badge text-bg-success'>dibayar</span>" : "" ; ?></td>
                                <td><?php echo $row['nama'] ?></td>
                                <td><?php echo $row['level_pedas'] ?></td>
                                <td><?php echo $row['tipe_kuah'] ?></td>
                                <td><?php echo $row['alamat'] ?></td>
                                <td><?php echo $row['waktu_order'] ?></td>
                                <td>
                                    <div class="d-flex">
                                        <a class="btn btn-info btn-sm me-2" href="./?x=keranjangitem&order=<?php echo $row['id_order'] . "&pelanggan=" . $row['pelanggan'] ?>"><i class="bi bi-eye-fill"></i></a>
                                        <button class="<?php echo (!empty($row['id_bayar'])) ? "btn btn-secondary btn-sm me-2 disabled" : "btn btn-warning btn-sm me-2" ; ?>" data-bs-toggle="modal" data-bs-target="#ModalEdit<?php echo $row['id_order'] ?>"><i class="bi bi-pencil-square"></i></button>
                                        <button class="<?php echo (!empty($row['id_bayar'])) ? "btn btn-secondary btn-sm me-2 disabled" : "btn btn-danger btn-sm me-2" ; ?>" data-bs-toggle="modal" data-bs-target="#ModalDelete<?php echo $row['id_order'] ?>"><i class="bi bi-trash3"></i></button>
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