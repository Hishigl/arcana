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
    <section id="gallery" style="margin-top:50px">
    <div class="container">
    <div class="row">
    <?php
        $sqlnews = mysqli_query($conn, "SELECT * FROM news order by id_news+1");            
        while ($rnews = mysqli_fetch_array($sqlnews)):
      ?>

            <div class="col-lg-4 mb-4">
            <div class="card">
              <img src="<?php echo $rnews['gambar']?>" alt="" class="card-img-top">
              <div class="card-body">
                <h5 class="card-title"><?php echo $rnews['judul']?></h5>
                <p class="card-text"style="overflow: hidden; text-overflow: ellipsis;display: -webkit-box;-webkit-line-clamp: 6; line-clamp: 6; -webkit-box-orient: vertical;"><?php echo $rnews['berita']?></p>
              <a href="<?php echo $rnews['link']?>" class="btn btn-outline-success btn-sm">Read More</a>
              </div>
            </div>
            </div>


        <?php
endwhile
?>
        </section>


    </div>
</body>
</html>

