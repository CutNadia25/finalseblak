            <?php
            session_start();
             if (isset($_GET['x']) && $_GET['x']=='home') {
               $page = "home.php";
                include "main.php";
             }else if(isset($_GET['x']) && $_GET['x']=='menu') {
              if($_SESSION['level_SeblakKuyy']==1 || $_SESSION['level_SeblakKuyy']==2 || $_SESSION['level_SeblakKuyy']==3 || $_SESSION['level_SeblakKuyy']==4 ){
               $page = "menu.php";
                include "main.php";
             }else{
              $page = "home.php";
                include "main.php";
             }
             }else if(isset($_GET['x']) && $_GET['x']=='keranjang') {
              if($_SESSION['level_SeblakKuyy']==1 || $_SESSION['level_SeblakKuyy']==3 ){
               $page = "keranjang.php";
                include "main.php";
              }else{
                $page = "home.php";
                  include "main.php";
               }
             }else if(isset($_GET['x']) && $_GET['x']=='pelayan') {
              if($_SESSION['level_SeblakKuyy']==1 || $_SESSION['level_SeblakKuyy']==2 ){
               $page = "pelayan.php";
                include "main.php";
              }else{
                $page = "home.php";
                  include "main.php";
              }
             }else if(isset($_GET['x']) && $_GET['x']=='pengiriman') {
              if($_SESSION['level_SeblakKuyy']==1 || $_SESSION['level_SeblakKuyy']==3 || $_SESSION['level_SeblakKuyy']==4){
               $page = "pengiriman.php";
                include "main.php";
              }else{
                $page = "home.php";
                  include "main.php";
              }
              }else if(isset($_GET['x']) && $_GET['x']=='keranjangitem') {
                if($_SESSION['level_SeblakKuyy']==1 || $_SESSION['level_SeblakKuyy']==3){
                $page = "keranjang_item.php";
                 include "main.php";
                }else{
                  $page = "home.php";
                    include "main.php";
                }

              }else if(isset($_GET['x']) && $_GET['x']=='viewitem') {
                if($_SESSION['level_SeblakKuyy']==1){
                $page = "view_item.php";
                 include "main.php";
                }else{
                  $page = "home.php";
                    include "main.php";
                }

               }else if(isset($_GET['x']) && $_GET['x']=='user') {
                if($_SESSION['level_SeblakKuyy']==1)  {
                     $page = "user.php";
                      include "main.php"; 
                  }else{
                     $page = "home.php";
                   include "main.php";
                  }
             }else if(isset($_GET['x']) && $_GET['x']=='ulasanrating') {
              if($_SESSION['level_SeblakKuyy']==1 || $_SESSION['level_SeblakKuyy']==2 || $_SESSION['level_SeblakKuyy']==3){
               $page = "ulasanrating.php";
                include "main.php";
              }else{
                $page = "home.php";
              include "main.php";
             }
             }else if(isset($_GET['x']) && $_GET['x']=='report') {
               if ($_SESSION['level_SeblakKuyy']==1){
                  $page = "Report.php";
                   include "main.php"; 
               }else{
                  $page = "home.php";
                include "main.php";
               }
                  
             }else if(isset($_GET['x']) && $_GET['x']=='login') {
                  include "login.php";
             }else if(isset($_GET['x']) && $_GET['x']=='keluar') {
                include "proses/proses_keluar.php";
              
             }else {
               $page = "home.php";
               include "main.php";
            }
             
             ?>