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
              <img src="https://images.unsplash.com/photo-1477862096227-3a1bb3b08330?ixlib=rb-1.2.1&auto=format&fit=crop&w=700&q=60" alt="" class="card-img-top">
              <div class="card-body">
                <h5 class="card-title"><?php echo $rnews['judul']?></h5>
                <p class="card-text">Lorem ipsum dolor sit amet consectetur, adipisicing elit. Ut eum similique repellat a laborum, rerum voluptates ipsam eos quo tempore iusto dolore modi dolorum in pariatur. Incidunt repellendus praesentium quae!</p>
              <a href="" class="btn btn-outline-success btn-sm">Read More</a>
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

