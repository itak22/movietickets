<!doctype html>
<html lang="en">
  <head>
    <title>theater</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style.css">

    <script src="https://kit.fontawesome.com/eb83b1af77.js" crossorigin="anonymous"></script>
  </head>
  <body class="theater">
  <?php
  include 'menu_customer.php';

  $theaterID = $_GET['theater_id'];
  $theater2 = $Movie->viewtheater2($theaterID);

  $viewDate = $Movie->viewDate($theaterID);

  $date = date("Y/m/d");
  $timeline = $Movie->viewTimeline($theaterID,$date); 

  ?>
    <div class="container">
    <?php foreach($theater2 as $row): ?>
      <p class="lead font-weight-bold mt-2 display-4"><?php echo $row['theatername'] ?></p>
      <p class="lead"><i class="fas fa-map-marker-alt text-danger"></i> <?php echo $row['location'] ?></p>
      <div class="row">
        <div class="col-lg-12 mt-2">
          <ul class="nav nav-tabs text-center">
            <li class="nav-item">
              <a class="nav-link active"><?php echo date('D') ?><br><?php echo date('M d') ?></a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="theater2.php?theater_id=<?php echo $theaterID ?>"><?php echo date('D', strtotime(' +1 day')) ?><br><?php echo date('M d', strtotime(' +1 day')) ?></a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="theater3.php?theater_id=<?php echo $theaterID ?>"><?php echo date('D', strtotime(' +2 day')) ?><br><?php echo date('M d', strtotime(' +2 day')) ?></a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="theater4.php?theater_id=<?php echo $theaterID ?>"><?php echo date('D', strtotime(' +3 day')) ?><br><?php echo date('M d', strtotime(' +3 day')) ?></a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="theater5.php?theater_id=<?php echo $theaterID ?>"><?php echo date('D', strtotime(' +4 day')) ?><br><?php echo date('M d', strtotime(' +4 day')) ?></a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="theater6.php?theater_id=<?php echo $theaterID ?>"><?php echo date('D', strtotime(' +5 day')) ?><br><?php echo date('M d', strtotime(' +5 day')) ?></a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="theater7.php?theater_id=<?php echo $theaterID ?>"><?php echo date('D', strtotime(' +6 day')) ?><br><?php echo date('M d', strtotime(' +6 day')) ?></a>
            </li>
          </ul>
        </div>
      </div>
      <div class="row mt-4 mb-2">
        <?php foreach($timeline as $row):

          $movieID = $row['movie_id'];
          $time = $Movie->viewTime($theaterID,$movieID,$date); ?>

          <div class="col-lg-4 mb-2">
            <div>
              <img src="uploads/<?php echo $row['image'] ?>" alt=""> 
              <table width="200" height="100" class="table">
                <thead>
                    <th colspan="4" class="lead font-weight-bold"><?php echo $row['moviename'] ?></th>
                </thead>  
                <tbody>
                  <tr class="font-weight-bold">
                    <td colspan="2"><?php echo $row['hallname'] ?></td>
                    <td colspan="2"><?php echo $row['price'] ?>P</td>
                  </tr>
                  <tr>
                    <?php foreach($time as $row): ?>
                      <td><a href="reserve.php?time_id=<?php echo $row['time_id'] ?>" role="button" class="btn text-dark"><?php echo $row['startinghours']; echo ':'; echo $row['startingminutes']; echo $row['startingam_pm']; ?></a></td>
                    <?php endforeach ?>
                  </tr>
                </tbody>
              </table>
            </div>
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