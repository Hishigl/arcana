<!DOCTYPE html>
<html lang="en">

<head>
    <title>Skincare Product</title>
    <?php include 'head.php';?>
    <?php include 'navbar.php';?>
    <?php include 'dbconnect.php';?>
    
</head>

<body>
    <div class="container">
        <div class="row" style="margin-top:50px; margin-bottom:50px">
            <div id="carouselExampleFade" class="carousel slide carousel-fade" data-bs-ride="carousel">
                <div class="carousel-inner">
                    <div class="carousel-item active" data-bs-interval="2000">
                    <img src="asset/img/banner.jpg" class="d-block w-100" width="1200" height="598" style="border-radius: 25px;"alt="...">
                    </div>
                    <div class="carousel-item" data-bs-interval="2000">
                    <img src="https://static.sehatq.com/content/review/image/1652192089.jpeg" width="1200" height="598"  style="border-radius: 25px;" class="d-block w-100" alt="...">
                    </div>
                    <div class="carousel-item" data-bs-interval="2000">
                    <img src="https://images.tokopedia.net/img/cache/1200/BgtCLw/2021/7/22/1fdcfd1e-8641-4e4d-8343-d93b27b9becc.jpg?ect=4g"  width="1200" height="598"  style="border-radius: 25px;" class="d-block w-100" alt="...">
                    </div>
                    <div class="carousel-item" data-bs-interval="2000">
                    <img src="https://1.bp.blogspot.com/-npA0ws6QlMo/YOG4yP-ZW8I/AAAAAAAAr4E/u5XdTpwXsdkiaaWa4wgQJ31hBStS-3SdgCLcBGAsYHQ/w1200-h630-p-k-no-nu/face%2Bcare%2Bscarlett%2Bwhitening.jpg"  width="1200" height="598"  style="border-radius: 25px;" class="d-block w-100" alt="...">
                    </div>
                </div>
                    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleFade" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleFade" data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                </div>
        </div>

        <div class="row">

            <?php
                $sqlproduct = mysqli_query($conn, "SELECT * FROM produk order by id_product+1");
            while ($rproduct = mysqli_fetch_array($sqlproduct)):
                ?>
                    <div class="col-md-3 col-sm-6" style="margin-bottom:50px">
                        <div class="product-grid">
                            <div class="product-image">
                                <a href="#" class="image">
                                    <img src="<?php echo $rproduct['gbr_produk']?>">
                                </a>
                                <a href="" class="add-to-cart" style="text-decoration:none">Beli Produk</a>
                            </div>
                            <div class="product-content">
                                <h3 class="title"
                                    style="overflow: hidden; text-overflow: ellipsis;display: -webkit-box;-webkit-line-clamp: 2; line-clamp: 2; -webkit-box-orient: vertical;">
                                    <a href="#" style="text-decoration:none"><?php echo $rproduct['judul_produk']?></a></h3>
                                <div class="price"><?php echo $rproduct['dsc_produk']?>
                                    <span><?php echo $rproduct['harga_produk']?></span></div>
                            </div>
                        </div>
                    </div>

                    <?php
            endwhile
            ?>

        </div>
    </div>

</body>

</html>

<style>
.product-grid {
    font-family: 'Poppins', sans-serif;
    text-align: center;
}

.product-grid .product-image {
    overflow: hidden;
    position: relative;
    z-index: 1;
}

.product-grid .product-image a.image {
    display: block;
}

.product-grid .product-image img {
    width: 100%;
    height: auto;
}

.product-grid .product-discount-label {
    color: #fff;
    background: #A5BA8D;
    font-size: 13px;
    font-weight: 600;
    line-height: 25px;
    padding: 0 20px;
    position: absolute;
    top: 10px;
    left: 0;
}

.product-grid .product-links {
    padding: 0;
    margin: 0;
    list-style: none;
    position: absolute;
    top: 10px;
    right: -50px;
    transition: all .5s ease 0s;
}

.product-grid:hover .product-links {
    right: 10px;
}

.product-grid .product-links li a {
    color: #333;
    background: transparent;
    font-size: 17px;
    line-height: 38px;
    width: 38px;
    height: 38px;
    border: 1px solid #333;
    border-bottom: none;
    display: block;
    transition: all 0.3s;
}

.product-grid .product-links li:last-child a {
    border-bottom: 1px solid #333;
}

.product-grid .product-links li a:hover {
    color: #fff;
    background: #333;
}

.product-grid .add-to-cart {
    /* background: #A5BA8D; */
    background-color: #FFA46C;
    color: black;
    font-size: 16px;
    font-weight: bold;
    text-transform: uppercase;
    letter-spacing: 2px;
    width: 100%;
    padding: 10px 26px;
    position: absolute;
    left: 0;
    bottom: -60px;
    transition: all 0.3s ease 0s;
}

.product-grid:hover .add-to-cart {
    bottom: 0;
}

.product-grid .add-to-cart:hover {
    text-shadow: 4px 4px rgba(0, 0, 0, 0.2);
}

.product-grid .product-content {
    background: #fff;
    padding: 15px;
    box-shadow: 0 0 0 5px rgba(0, 0, 0, 0.1) inset;
}

.product-grid .title {
    font-size: 16px;
    font-weight: 600;
    text-transform: capitalize;
    margin: 0 0 7px;
}

.product-grid .title a {
    color: #777;
    transition: all 0.3s ease 0s;
}

.product-grid .title a:hover {
    color: #FF914D;
}

.product-grid .price {
    color: #0d0d0d;
    font-size: 14px;
    font-weight: 600;
}

.product-grid .price span {
    color: #888;
    font-size: 13px;
    font-weight: 400;
    text-decoration: line-through;
}

@media screen and (max-width: 990px) {
    .product-grid {
        margin-bottom: 30px;
    }
}
</style>