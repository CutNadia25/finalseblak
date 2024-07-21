<?php
include "proses/connect.php";
$query = mysqli_query($conn, "SELECT * FROM tb_ulasan_rating");
while ($record = mysqli_fetch_array($query)) {
    $result[] = $record;
}
?>

<div class="col-lg-9 mt-2">
    <div class="card">
        <div class="card-header">
            Halaman Ulasan dan Rating
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col d-flex justify-content-end">
                    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#ModalTambahUlasanRating">Tambah Ulasan dan Rating</button>
                </div>
            </div>
            <!--modal tambah ulasan rating-->
            <div class="modal fade" id="ModalTambahUlasanRating" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-xl modal-fullscreen-md-down">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah Ulasan dan Rating</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form class="needs-validation" novalidate action="proses/proses_input_ulasanrating.php" method="POST">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-floating mb-3">
                                            <input type="email" class="form-control" id="floatingInput" placeholder="name@example.com" name="email" required>
                                            <label for="floatingInput">Email</label>
                                            <div class="invalid-feedback">
                                                Harap Masukkan Email
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-floating mb-3">
                                            <input type="text" class="form-control" id="floatingInput" placeholder="nama" name="nama" required>
                                            <label for="floatingInput">Nama</label>
                                            <div class="invalid-feedback">
                                                Harap Masukkan Nama Anda
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-4">
                                        <div class="form-floating mb-3">
                                            <select class="form-select" aria-label="Default select example" name="rating_bintang" required>
                                                <option selected hidden>Pilih Rating Bintang</option>
                                                <option value="1">1 Bintang</option>
                                                <option value="2">2 Bintang</option>
                                                <option value="3">3 Bintang</option>
                                                <option value="4">4 Bintang</option>
                                                <option value="5">5 Bintang</option>
                                            </select>
                                            <label for="floatingInput">Rating Bintang</label>
                                            <div class="invalid-feedback">
                                                Harap Pilih Rating Bintang
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-8">
                                        <div class="form-floating mb-3">
                                            <input type="text" class="form-control" id="floatingInput" placeholder="ktitik" name="kritik" required>
                                            <label for="floatingInput">Kritik</label>
                                            <div class="invalid-feedback">
                                                Harap Masukkan Kritik Anda.
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="form-floating mb-3">
                                            <input type="text" class="form-control" id="floatingInput" placeholder="saran" name="saran">
                                            <label for="floatingInput">Saran</label>
                                            <div class="invalid-feedback">
                                                Harap Masukkan Saran Anda.
                                            </div>
                                        </div>
                                    </div>
                                </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary" name="input_ulasan_valid" value="12345">Save changes</button>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!--end modal tambah ulasan dan rating-->


        <?php
        foreach ($result as $row) {
        ?>

        <?php
        }
        if (empty($result)) {
            echo "Data user tidak ada";
        } else {
        ?>
            <div class="table-responsive">
                <table class="table table-striped table-hover" id="example">
                    <thead>
                        <tr>
                            <th scope="col">No</th>
                            <th scope="col">Email</th>
                            <th scope="col">Nama</th>
                            <th scope="col">Rating Bintang</th>
                            <th scope="col">Kritik</th>
                            <th scope="col">Saran</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 1;
                        foreach ($result as $row) {

                        ?>

                            <tr>
                                <th scope="row"><?php echo $no++ ?></th>
                                <td><?php echo $row['email'] ?></td>
                                <td><?php echo $row['nama'] ?></td>
                                <td><?php echo $row['rating_bintang'] ?></td>
                                <td><?php echo $row['ktitik'] ?></td>
                                <td><?php echo $row['saran'] ?></td>
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