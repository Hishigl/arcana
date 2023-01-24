<!DOCTYPE html>
<html lang="en">
<head>
    <title>News</title>
    <?php include 'head.php';?>
    <?php include 'navbar.php';?>
    <?php include 'dbconnect.php';?>
</head>
<body>
    <div class="container">
            <?php
          echo "
          <h2 class='text text-primary'>Berita</h2><hr>
          <div class='alert alert-success alert-dismissible'>
                        <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>
                        <h4><i class='icon fa fa-exclamation-triangle'></i>Perhatian !</h4>
                        Silahkan memilih gejala sesuai dengan kondisi kulit wajah anda, anda dapat memilih tingkat kepastian kondisi kulit wajah anda dari pasti tidak sampai pasti ya, jika sudah tekan tombol proses (<i class='fa fa-search-plus'></i>)  di bawah untuk melihat hasil.
                      </div>
            <form name=text_form method=POST action='diagnosa' >
                  <table class='table table-bordered table-striped konsultasi'><tbody class='pilihkondisi'>
                  <tr><th>No</th><th>Kode</th><th>Gejala</th><th width='20%'>Pilih Kondisi</th></tr>";
    
    ?>
    </div>
</body>
</html>