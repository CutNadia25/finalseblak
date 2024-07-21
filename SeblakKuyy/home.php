<?php 
include "proses/connect.php";
$query_chart = mysqli_query($conn, "SELECT nama_menu, tb_daftar_menu.id, SUM(tb_list_order.jumlah) AS total_jumlah FROM tb_daftar_menu
LEFT JOIN tb_list_order ON tb_daftar_menu.id = tb_list_order.menu
GROUP BY tb_daftar_menu.id
ORDER BY tb_daftar_menu.id ASC");
//$result_chart  = array();
while ($record_chart = mysqli_fetch_array($query_chart)){
  $result_chart[] = $record_chart;
}


$array_menu = array_column($result_chart, 'nama_menu');
$array_menu_quote = array_map(function ($menu){
  return "'".$menu."'";
}, $array_menu);
$string_menu = implode(',', $array_menu_quote);

//echo $string_menu."\n";

$array_jumlah_pesanan = array_column($result_chart, 'total_jumlah');
$string_jumlah_pesanan = implode (',', $array_jumlah_pesanan);
//echo $string_jumlah_pesanan;
?> 
 



<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>     
      <div class="col-lg-9 mt-2">
          <!-- carousel -->
          <div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="carousel">
              <div class="carousel-indicators">
                  <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                  <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1" aria-label="Slide 2"></button>
                  <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2" aria-label="Slide 3"></button>
                  <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="3" aria-label="Slide 4"></button>
                  <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="4" aria-label="Slide 5"></button>
              </div>
              <div class="carousel-inner rounded">
                  <div class="carousel-item active">
                      <img src="assets/img/1.jpg" class="img-fluid" style="height: 300px; width:1000px; object-fit:cover" alt="...">
                      <div class="carousel-caption d-none d-md-block">
                          <h5 style="color: black;"><strong>Seblak Cuanki</strong></h5>
                          <p style="color: black;"><strong><b>Pesan Sekarang!!! Dapatkan Potongan Harga sebesar 5000 dengan membeli 3 porsi.</b></strong></p>
                      </div>

                  </div>
                  <div class="carousel-item">
                      <img src="assets/img/11444-chikuwa.jpg" class="img-fluid" style="height: 300px; width:1000px; object-fit:cover" alt="...">
                      <div class="carousel-caption d-none d-md-block">
                          <h5 style="color: black;"><strong>Chikuwa</strong></h5>
                          <p style="color: black;"><strong><b>Pesan Sekarang!!! Dapatkan Potongan Harga sebesar 1000 dengan membeli 10.</b></strong></p>
                      </div>
                  </div>
                  <div class="carousel-item">
                      <img src="assets/img/5.jpg" class="img-fluid" style="height: 300px; width:1000px; object-fit:cover" alt="...">
                      <div class="carousel-caption d-none d-md-block">
                          <h5 style="color: black;"><strong>Seblak Ceker</strong></h5>
                          <p style="color: black;"><strong><b>Pesan Sekarang!!! Dapatkan Potongan Harga sebesar 3000 dengan membeli 5 porsi.</b></strong></p>
                      </div>
                  </div>
                  <div class="carousel-item">
                      <img src="assets/img/66048-toping4.jpg" class="img-fluid" style="height: 300px; width:1000px; object-fit:cover" alt="...">
                      <div class="carousel-caption d-none d-md-block">
                          <h5 style="color: black;"><strong>Crab Stick</strong></h5>
                          <p style="color: black;"><strong><b>Pesan Sekarang!!! Dapatkan Potongan Harga sebesar 2000 dengan membeli 20.</b></strong></p>
                      </div>
                  </div>
                  <div class="carousel-item">
                      <img src="assets/img/17740-bolakepiting.jpg" class="img-fluid" style="height: 300px; width:1000px; object-fit:cover" alt="...">
                      <div class="carousel-caption d-none d-md-block">
                          <h5 style="color: black;"><strong>Bola Kepiting</strong></h5>
                          <p style="color: black;"><strong><b>Pesan Sekarang!!! Dapatkan Potongan Harga sebesar 500 dengan membeli 15.</b></strong></p>
                      </div>
                  </div>
              </div>
              <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
                  <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                  <span class="visually-hidden">Previous</span>
              </button>
              <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
                  <span class="carousel-control-next-icon" aria-hidden="true"></span>
                  <span class="visually-hidden">Next</span>
              </button>
          </div>
          <!--  end carousel -->

          <!--  judul -->
          <div class="card mt-4 border-0 bg-light">
              <div class="card-body text-center">
                  <h5 class="card-title">Seblak Kuyy - APLIKASI PEMESANAN SEBLAK DAN ANEKA TOPINGNYA</h5>
                  <p class="card-text">Seblak Kuyy adalah aplikasi pemesanan seblak dan topingnya secara online. Aplikasi ini sangat memudahkan pembeli untuk menikmati seblak tanpa harus datang langsung ketempatnya. Aplikasi ini dilengkapi berbagai fitur canggih yang pastinya mudah dipahami. Pesan, bayar, lacak pesanan anda, dan nikmati.</p>
                  <a href="keranjang" class="btn btn-primary">🍜Order Now</a>
              </div>
          </div>
          <!--  end judul -->

          <!--  chart -->
          <div class="card mt-4 border-0 bg-light">
              <div class="card-body text-center">
                  <div>
                      <canvas id="myChart"></canvas>
                  </div>
                  <script>
                      const ctx = document.getElementById('myChart');

                      new Chart(ctx, {
                          type: 'bar',
                          data: {
                              labels: [<?php echo $string_menu ?>],
                              datasets: [{
                                  label: 'Jumlah Porsi Terjual',
                                  data: [<?php echo $string_jumlah_pesanan ?>],
                                  borderWidth: 1,
                                  backgroundColor:[
                                    'rgba(157, 181, 203, 0.8)',
                                    'rgba(211, 173, 204, 0.8)',
                                    'rgba(255, 144, 92, 0.8)',
                                    'rgba(237, 108, 185, 0.8)',
                                    'rgba(165, 241, 112, 0.8)',
                                    'rgba(226, 240, 55, 0.8)'
                                  ]
                              }]
                          },
                          options: {
                              scales: {
                                  y: {
                                      beginAtZero: true
                                  }
                              }
                          }
                      });
                  </script>
              </div>
          </div>
          <!--  end chart -->
      </div>