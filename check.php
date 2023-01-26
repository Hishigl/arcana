<!DOCTYPE html>
<html lang="en">

<title>Cek Tipe Kulit Wajah</title>
<?php include 'head.php';?>
<?php include 'navbar.php';?>
<?php include 'dbconnect.php';?>
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<!-- <link rel="stylesheet" href="path/to/font-awesome/css/font-awesome.min.css"> -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">



<div class="container">
    <?php
        switch (isset($_GET['act'])) {
            default:
                if (isset($_POST['submit'])) {
                    $arcolor = array('#000','#FF0000', ' #FF6100', '#FFBA52', '#FFD21C', '#A4F804', '#21A258', ' #FDCD01');
                    date_default_timezone_set("Asia/Jakarta");
                    $inptanggal = date('Y-m-d H:i:s');

                    $arbobot = array('0', '0', '0.2', '0.4', '0.6', '0.8', '1');
                    $argejala = array();

                    for ($i = 0; $i < count($_POST['kondisi']); $i++) {
                        $arkondisi = explode("_", $_POST['kondisi'][$i]);
                        if (strlen($_POST['kondisi'][$i]) > 1) {
                            $argejala += array($arkondisi[0] => $arkondisi[1]);
                        }
                    }

                    $sqlkondisi = mysqli_query($conn, "SELECT * FROM kondisi order by id+0");
                    while ($rkondisi = mysqli_fetch_array($sqlkondisi)) {
                        $arkondisitext[$rkondisi['id']] = $rkondisi['kondisi'];
                    }

                    $sqlpkt = mysqli_query($conn, "SELECT * FROM tipewajah order by kode_tipewajah+0");
                    while ($rpkt = mysqli_fetch_array($sqlpkt)) {
                        $arpkt[$rpkt['kode_tipewajah']] = $rpkt['nama_tipewajah'];
                        $ardpkt[$rpkt['kode_tipewajah']] = $rpkt['det_tipewajah'];
                        $arspkt[$rpkt['kode_tipewajah']] = $rpkt['srn_tipewajah'];
                        $argpkt[$rpkt['kode_tipewajah']] = $rpkt['gambar'];
                    }

                    // print_r($arkondisitext);

                     // -------- perhitungan (CF) ---------
                    // --------------------- START ------------------------
                    $sqltipewajah = mysqli_query($conn, "SELECT * FROM tipewajah order by kode_tipewajah");
                    $artipewajah = array();
                    while ($rtipewajah = mysqli_fetch_array($sqltipewajah)) {
                        $cftotal_temp = 0;
                        $cf = 0;
                        $sqlgejala = mysqli_query($conn, "SELECT * FROM basis_pengetahuan where kode_tipewajah=$rtipewajah[kode_tipewajah]");
                        $cflama = 0;
                        while ($rgejala = mysqli_fetch_array($sqlgejala)) {
                            $arkondisi = explode("_", $_POST['kondisi'][0]);
                            $gejala = $arkondisi[0];

                            for ($i = 0; $i < count($_POST['kondisi']); $i++) {
                                $arkondisi = explode("_", $_POST['kondisi'][$i]);
                                $gejala = $arkondisi[0];
                                if ($rgejala['kode_gejala'] == $gejala) {
                                    $cf = ($rgejala['mb']-$rgejala['md']) * $arbobot[$arkondisi[1]];
                                    if (($cf >= 0) && ($cf * $cflama >= 0)) {
                                        $cflama = $cflama + ($cf * (1-$cflama));
                                    }
                                    if ($cf * $cflama < 0) {
                                        $cflama = ($cflama + $cf) / (1-Math . Min(Math . abs($cflama), Math . abs($cf)));
                                    }
                                    if (($cf < 0) && ($cf * $cflama >= 0)) {
                                        $cflama = $cflama + ($cf * (1 + $cflama));
                                    }
                                }
                            }
                        }
                        if ($cflama > 0) {
                            $artipewajah+= array($rtipewajah["kode_tipewajah"] => number_format($cflama, 4));
                        }
                    }

                    arsort($artipewajah);

                    $inpgejala = serialize($argejala);
                    $inptipewajah = serialize($artipewajah);

                    $np1 = 0;
                    foreach ($artipewajah as $key1 => $value1) {
                        $np1++;
                        $idpkt1[$np1] = $key1;
                        $vlpkt1[$np1] = $value1;
                    }

                    mysqli_query($conn, "INSERT INTO hasil(
                        tanggal,
                        gejala,
                        tipewajah,
                        hasil_id,
                        hasil_nilai
                        ) 
                    VALUES(
                        '$inptanggal',
                        '$inpgejala',
                        '$inptipewajah',
                        '$idpkt1[1]',
                        '$vlpkt1[1]'
                        )");
                    // --------------------- END -------------------------

                    echo "<div class='content'>
                    <h2 class='text text-primary' style='margin-top:20px'>Hasil Diagnosis</h2>
                            <hr><table class='table table-bordered table-striped check.php'> 
                        <th width=8%>No</th>
                        <th>Gejala yang dialami (keluhan)</th>
                        <th width=20%>Pilihan</th>
                        </tr>";
                    $ig = 0;
                    foreach ($argejala as $key => $value) {
                        $kondisi = $value;
                        $ig++;
                        $gejala = $key;
                        $sql4 = mysqli_query($conn, "SELECT * FROM gejala where kode_gejala = '$key'");
                        $r4 = mysqli_fetch_array($sql4);
                        echo '<tr><td>' . $ig . '</td>';
                        // echo '<td>G' . str_pad($r4["kode_gejala"], 2, '0', STR_PAD_LEFT) . '</td>';
                        echo '<td><span class="hasil text text-primary">' . $r4["nama_gejala"] . "</span></td>";
                        echo '<td style="display:flex; flex-direction:column"><span class="kondisipilih" style="background-color:' . $arcolor[$kondisi] . '">' . $arkondisitext[$kondisi] . "</span></td></tr>";
                    }
                    $np = 0;
                    foreach ($artipewajah as $key => $value) {
                        $np++;
                        $idpkt[$np] = $key;
                        $nmpkt[$np] = $arpkt[$key];
                        $vlpkt[$np] = $value;
                    }
                    if ($argpkt[$idpkt[1]]) {
                        $gambar = 'asset/img/' . $argpkt[$idpkt[1]];
                    } else {
                        $gambar = 'asset/img/noimage.png';
                    }
                    echo "</table><div class='well well-small'><h1 style='text-align:center'>Hasil Diagnosa</h1>";
                    echo "<div class='callout callout-default'style='text-align:center'>Jenis Tipe kulit wajah yang dimiliki dalah <b><h3 style='text-align:center'class='text text-success'>" . $nmpkt[1] . "</b> / " . round($vlpkt[1], 4)*100 . "%<br></h3>";
                    echo"<img class='card-img-top img-bordered-sm' style='float:center; margin-left:15px; width:450px; margin-top:10px; margin-bottom:40px' src='" . $gambar . "'>";
                    echo "</div></div><div class='box box-info box-solid'><div class='box-header with-border'><h3 class='box-title'>Detail</h3></div><div class='box-body'><h4>";
                    echo $ardpkt[$idpkt[1]];
                    echo "</h4></div></div>
                    <div class='box box-warning box-solid'><div class='box-header with-border'><h3 class='box-title'>Saran</h3></div><div class='box-body'><h4>";
                    echo $arspkt[$idpkt[1]];
                    echo "</h4></div></div>
                    <div class='box box-danger box-solid'><div class='box-header with-border'><h3 class='box-title'>Kemungkinan lain:</h3></div><div class='box-body'><h4>";
                    for ($ipl = 2; $ipl < count($idpkt); $ipl++) {
                        echo " <h4><i class='fa fa-caret-square-o-right'></i> " . $nmpkt[$ipl] . "</b> / " . round($vlpkt[$ipl], 4)*100 . "%<br></h4>";
                    }
                    echo "</div></div>
                    </div>";
                    echo"<button class='float' id='print' onClick='window.print();' data-toggle='tooltip' data-placement='right' title='Klik tombol ini untuk mencetak hasil diagnosa'><i class='fa fa-print'></i> Cetak</button>";
                } else {
                    echo "
                        <h1 class='text text-primary' style='margin-top:20px'>Diagnosa Tipe Kulit Wajah</h1>  <hr>
                        <div class='alert alert-success alert-dismissible'>
                                    <h4><i class='icon fa fa-exclamation-triangle'></i>Perhatian !</h4>
                                    Silahkan memilih gejala sesuai dengan kondisi yang anda alami. Jika sudah tekan tombol proses (<i class='fa fa-search'></i>)  di bawah untuk melihat hasil.<br><span style='color:red'>Harap Memilih Lebih Dari 3 Kondisi !</span>
                                    </div>
                        <form name=text_form method=POST action='check.php' > 
                                <table class='table table-bordered table-striped konsultasi'><tbody class='pilihkondisi'>
                                <tr><th>No</th><th>Gejala</th><th width='20%'>Pilih Kondisi</th></tr>";

                    $sql3 = mysqli_query($conn, "SELECT * FROM gejala order by kode_gejala");
                    $i = 0;
                    while ($r3 = mysqli_fetch_array($sql3)) {
                        $i++;
                        echo "<tr><td class=opsi>$i</td>";
                        // echo "<td class=opsi>G" . str_pad($r3["kode_gejala"], 2, '0', STR_PAD_LEFT) . "</td>";
                        echo "<td class=gejala>$r3[nama_gejala]</td>";
                        echo '<td class="opsi"><select name="kondisi[]" id="sl' . $i . '" class="opsikondisi"/><option data-id="0" value="0">Pilih Tingkat Kesesuaian</option>';
                        $s = "select * from kondisi order by id";
                        $q = mysqli_query($conn, $s) or die($s);
                        while ($rw = mysqli_fetch_array($q)) {
                            ?>
    <option data-id="<?php echo $rw['id']; ?>" value="<?php echo $r3['kode_gejala'] . '_' . $rw['id']; ?>">
        <?php echo $rw['kondisi']; ?></option>
    <?php
                        }
                        echo '</select></td>';
                        ?>
    <script type = "text/javascript" >
        $(document).ready(function() {
            var arcolor = new Array('#ffffff', '#FF0000', '#FF6100', '#FFBA52', '#FFD21C', '#A4F804', '#21A258');
            setColor();
            $('.pilihkondisi').on('change', 'tr td select#sl<?php echo $i; ?>', function() {
                setColor();
            });

            function setColor() {
                var selectedItem = $('tr td select#sl<?php echo $i; ?> :selected');
                var color = arcolor[selectedItem.data("id")];
                $('tr td select#sl<?php echo $i; ?>.opsikondisi').css('background-color', color);
                console.log(color);
            }
        });
        </script>
                    <?php
                            echo "</tr>";
                                    }
                                    echo "
                                            <input class='float' type=submit data-toggle='tooltip' data-placement='top' title='Klik disini untuk melihat hasil diagnosa' name=submit value='&#xf002;' style='font-family:Arial, FontAwesome' >
                                            </tbody></table></form>";
                                }
                                break;
                        }
                ?>
        </div>
</html>

<style>
        select {
            padding: 5px;
            border-radius: 0.4em;
            border: 1 px solid #ddd;
            background-color: #cccccc
        }

    select option {
        margin: 40px;
        color: #000;
    border: 1px solid #ddd;
    }

    select option[data-id = "0"] {
        /* data-id not val */
        background-color: #ffffff;
    }

    select option[data-id = "1"] {
        /* data-id not val */
        background-color: #FF0000;
    }

    select option[data-id = "2"] {
        background-color: #FF6100;
    }

    select option[data-id = "3"] {
        background-color: #FFBA52;
    }

    select option[data-id = "4"] {
        background-color: #FFD21C;
    }

    select option[data-id = "5"] {
        background-color: #A4F804;
    }

    select option[data-id = "6"] {
        background-color: #21A258;
}

select option[data-id= "7"] {
        background-color: #FDCD01;
    }

    select: disabled {
        background-color: #cccccc;
    }

    #tombol {
        position: inherit;
    }

    tbody.pilihkondisi td.opsi {
            text-align: center;
            vertical-align: middle;
        }

        .float {
            position: fixed;
            width: 60px;
            height: 60px;
            bottom: 40px;
            right: 40px;
            background-color: #FF4D00;
            color: #FFF;
            border-radius: 50px;
            text-align: center;
            box-shadow: 2px 2px 3px #FF4D00;
            border-color: #FF4D00
}

.my-float {
    margin-top: 22px;
}

tbody.pilihkondisi td,
tbody.pilihkondisi td.gejala,
tbody.pilihkondisi th {
    vertical-align: middle;
}

tbody.pilihkondisi th {
    text-align: center;
    vertical-align: middle;
    background: #ecf0f1;

        }

    span.hasil {
        padding: 8px;
    }

    table.diagnosa th {
        background-color: #9b59b6;
    color: #fff;
    }

    table.diagnosa {
        border: 2px solid #9b59b6;
}

.text-primary {
    color: black !important;
    display: flex;
    justify-content: center;
    /* margin-top:30d */
}

table.table-bordered.diagnosa th {
    border: 1px solid #9b59b6;
    }

    table.table-bordered.diagnosa td {
        border: 1px solid #e9d5eb;
    }

    /*Konsultasi*/
    table.konsultasi th {
        background-color: #FF9656;
        color: #fff;
    }

    table.konsultasi {
        border: 1px solid #95afc0;
}

table.table-bordered.konsultasi th {
    border: 1px solid #95afc0;
    }

    table.table-bordered.konsultasi td {
        border: 1px solid #c9d1d9;
    }

    /*Riwayat*/
    table.riwayat th {
        background-color: #22a6b3;
    color: #fff;
    }

    table.riwayat {
        border: 1 px solid #22a6b3;
}

table.table-bordered.riwayat th {
    border: 1px solid #22a6b3;
    }

    table.table-bordered.riwayat td {
        border: 1px solid #c9d1d9;
        vertical-align: middle;
    }

    body {
        font-family: 'Rowdies'
    }

    .float {
        position: fixed;
        width: 60px;
        height: 60px;
        bottom: 40px;
        right: 40px;
        background-color: #ff721e;
        color: #FFF;
        border-radius: 50px;
        text-align: center;
        box-shadow: 2px 2px 3px #999;
}

.my-float {
    margin-top: 22px;
}

span.kondisipilih {
    /* background-color: # 2 f2130;*/
        padding: 2px 50px;
        border-radius: 4px;
        display: flex;
        justify-content: center
    }

    div.paging {
            margin-top: 25px;
        }

        .margin4 {
            margin: 4px;
        }

        .box-title {
            background-color: #FFBB92;
        }

        .well {
            overflow: hidden;
        } 
</style>