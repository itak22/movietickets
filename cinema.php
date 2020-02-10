<!doctype html>
<html lang="en">
  <head>
    <title>Title</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style.css">

    <script src="https://kit.fontawesome.com/eb83b1af77.js" crossorigin="anonymous"></script>
  </head>
  <body class="cinema">
  <?php
  include 'menu_customer.php';

  $cinemaID = $_GET['cinema_id'];
  $cinema2 = $Movie->viewCinema2($cinemaID);

  $date = date("Y/m/d");
  $today = $Movie->viewToday($cinemaID,$date); 

  ?>
    <div class="container">
    <?php foreach($cinema2 as $row): ?>
      <p class="lead font-weight-bold mt-2"><?php echo $row['cinemaname'] ?></p>

      <div class="row">
        <div class="col-lg-12">
          <p class='lead font-weight-bold mt-2'>Today's Timeline:</p>
        </div>
        
        <?php foreach($today as $row):

        $movieID = $row['movie_id'];

        $time = $Movie->viewTime($cinemaID,$movieID,$date); ?>

          <div class="col-lg-4">
                <p class="lead"><?php echo $row['moviename'] ?></p>
                <img src="uploads/<?php echo $row['image'] ?>" alt="starwars">
                <table width="200" height="100" class="table tble-bordered">
                  <thead>
                        <th colspan="4"><?php echo date("Y/m/d") ?></th>
                  </thead>  
                  <tbody>
                        <?php foreach($time as $row): ?>
                        <td><?php echo $row['time'] ?></td>
                        <?php endforeach ?>
                  </tbody>
                </table>
            </div>
          <?php endforeach ?>
        </div>
    <?php endforeach ?>
    </div>
    <?php
    include 'footer.php';
      
    ?>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  </body>
</html>