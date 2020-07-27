<?php
include('koneksi.php');
$query = mysqli_query($koneksi,"SELECT * FROM tb_gambar");
?>


<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="style.css">

    <link href="https://fonts.googleapis.com/css2?family=Viga&display=swap" rel="stylesheet">

    <title>JK || Jangkung Pangestu Aji</title>
  </head>
  <body>
    <!-- nav awal -->
    <nav class="navbar navbar-expand-lg navbar-light">
      <div class="container">
        <a class="navbar-brand" href="">JK</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
          <ul class="navbar-nav ml-auto">
            <li class="nav-item">
              <a class="nav-link" href="#upload">Upload</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#portofolio">Portofolio</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#contact">Contact</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#about">About</a>
            </li>
          </ul>
        </div>
      </div>
    </nav>
    <!-- nav akhir -->

    <!-- jubotron awal -->
    <div class="jumbotron">
      <div class="container">
        <h1 class="display-4">This is my <span>future</span><br> and <span>hope</span> for success</h1>
        <a href="#upload" class="btn btn-primary tombol">Let's Start</a>
      </div>
    </div>
    <!-- jumbotron akhir -->

    <!-- upload -->
    <div id="upload">
      <div class="container">
        <div class="row">
          <div class="col-sm-12">
            <h2 class="text-center">Upload</h2>
            <hr>
          </div>
        </div>

        <div class="row">
          <?php
          error_reporting(0);
          if(isset($_POST['tombol']))
          {
              if(!isset($_FILES['gambar']['tmp_name'])){
                  echo '<span style="color:red"><b><u><i>Pilih file gambar</i></u></b></span>';
              }
              else
              {
                  $file_name = $_FILES['gambar']['name'];
                  $file_size = $_FILES['gambar']['size'];
                  $file_type = $_FILES['gambar']['type'];
                  if ($file_size < 2048000 and ($file_type =='image/jpeg' or $file_type == 'image/png'))
                  {
                      $image   = addslashes(file_get_contents($_FILES['gambar']['tmp_name']));
                      $keterangan = $_POST['keterangan'];
                      mysqli_query($koneksi,"insert into tb_gambar (gambar,nama_gambar,tipe_gambar,ukuran_gambar,keterangan) values ('$image','$file_name','$file_type','$file_size','$keterangan')");
                      header('location:index.php');
                  }
                  else
                  {
                      echo '<span style="color:red"><b><u><i>Ukuruan File / Tipe File Tidak Sesuai</i></u></b></span>';
                  }
              }
          }
          ?>
          <div class="col-sm-12">
            <form method="post" action="" enctype="multipart/form-data">
              <table>
                  <tr>
                      <td>Gambar</td>
                      <td width="50%"><input type="file" name="gambar"/></td>
                  </tr>
                  <tr>
                      <td>Keterangan</td>
                      <td><textarea name="keterangan"></textarea></td>
                  </tr>
                  <tr>
                      <td></td>
                      <td><input type="submit" name="tombol"/></td>
                  </tr>
              </table>
            </form>
          </div>
        </div>
      </div>
    </div>
    <!-- akhir upload -->


    <!-- portofolio -->
    <section class=" card portofolio" id="portofolio">
      <div class="container">
        <div class="row">
          <div class="col-sm-12">
            <h2 class="text-center">Portofolio</h2>
            <hr>
          </div>
        </div>

        <div class="row galeri"> 
            <?php  
            $no = 1;
            while ($row = mysqli_fetch_array($query)) {
            ?>
          <div class="col-sm-4 text-center">
              <img src="image_view.php?id_gambar=<?php echo $row['id_gambar']; ?>" class="img-thumbnail">
              <p><?php echo $row['keterangan']; ?></p>
          </div>
          <div class="col-sm-8 text-center">
            <p>Tipe gambar : <?php echo $row['tipe_gambar']; ?></p>
            <p>Ukuran gambar : <?php echo $row['ukuran_gambar']; ?>kb</p>
            <a class="btn btn-danger" href="delete_gambar.php?id_gambar=<?php echo $row['id_gambar']; ?>">Hapus</a>
          </div>
              <?php
            }
            ?>
          </div>
      </div>
    </section>
    <!-- akhir portofolio -->

    <!-- about -->
    <section class="container about" id="about">
        <div class="row">
          <div class="col-sm-12">
            <h2 class="text-center">About</h2>
            <hr>
          </div>
        </div>

        <div class="row">
          <div class="col-sm-4">
            <p>Tempat, Tanggal Lahir </p>
            <p>Alamat </p>
            <p>No. Hp</p>
          </div>
          <div class="col-sm-8">
            <p> : Sidoarjo, 21 September 2001</p>
            <p> : Bugel, Panjatan, Kulon Progo</p>
            <p> : 08772689xxxx</p>
          </div>
        </div>
    </section>
    <!-- akhir about -->
    
    <!-- awal contact -->
    <section class="contact" id="contact">
      <div class="container">
        <div class="row">
          <div class="col-sm-12 text-center">
            <h2>Contact</h2>
            <hr>
          </div>
        </div>

        <div class="row">
          <div class="col-sm-8 col-sm-offset-2">
            <form action="" method="POST">
              <div class="form-groub">
                <label for="cnama">Nama</label><input type="text" name="cnama" id="name" class="form-control" placeholder="Masukkan nama">
              </div>

              <div class="form-groub">
                <label for="email">Email</label><input type="email" name="cemail" id="email" class="form-control" placeholder="Masukkan email">
              </div>

              <div class="form-groub">
                <label for="Telp">No. Telp</label><input type="tel" name="ctelp" id="telp" class="form-control" placeholder="Masukkan nomor telepon">
              </div>
              
              <div class="form-groub">
                <label for="pesan">Pesan</label>
                <textarea class="form-control" placeholder="Masukkan pesan" rows="10" name="ckomentar"></textarea>
              </div>
              
              <button type="submit" class="btn btn-primary" style="margin: 20px;">Kirim</button>
              <?php
                error_reporting(0);
                $fp = fopen("comment.txt", "a+");
                $nama = $_POST['cnama'];
                $email = $_POST['cemail'];
                $telp = $_POST['ctelp'];
                $komentar = $_POST['ckomentar'];

                fputs($fp, " == $nama|$email|$alamat|$telp|$komentar ==");
                fclose($fp);
              ?>
            </form>
          </div>
        </div>
      </div>
    </section>
    <!-- akhir contact -->

    <!-- awal footer -->
    <footer class="text-center">
      <div class="container">
        <div class="row">
          <div class="col-sm-12">
            <p>&copy; 2020 | <i>Built by <a href="">Jangkung Pangestu Aji</a></i></p>
          </div>
        </div>
        <div class="row">
          <div class="col-sm-12">
            <a href="https://www.youtube.com/channel/UCbU7lb0X16NmYaz8Hruff5A?view_as=subscriber" class="btn btn-danger">
              <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-play-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                <path d="M11.596 8.697l-6.363 3.692c-.54.313-1.233-.066-1.233-.697V4.308c0-.63.692-1.01 1.233-.696l6.363 3.692a.802.802 0 0 1 0 1.393z"/>
              </svg> Subscribe to YouTube</a>
          </div>
        </div>
      </div>
    </footer>
    <!-- akhir footer -->


    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script>
    $(document).ready(function(){
      // Add smooth scrolling to all links
      $("a").on('click', function(event) {

        // Make sure this.hash has a value before overriding default behavior
        if (this.hash !== "") {
          // Prevent default anchor click behavior
          event.preventDefault();

          // Store hash
          var hash = this.hash;

          // Using jQuery's animate() method to add smooth page scroll
          // The optional number (800) specifies the number of milliseconds it takes to scroll to the specified area
          $('html, body').animate({
            scrollTop: $(hash).offset().top
          }, 800, function(){

            // Add hash (#) to URL when done scrolling (default click behavior)
            window.location.hash = hash;
          });
        } // End if
      });
    });
    </script>
  </body>
</html>