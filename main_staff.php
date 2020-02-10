<div class="bg-main_customer">
    <img src="img/background2.jpg" alt="background">
</div>

<?php
include 'menu_staff.php';

// if(empty($_SESSION['login_id'])){
//     header('location:signin.php');
// }

$movie = $Movie->viewMovie();
$cinema = $Movie->viewCinema();
$date = $Movie->viewDate();

?>

<!doctype html>
<html lang="en">
  <head>
    <title>main</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style.css">

    <script src="https://kit.fontawesome.com/eb83b1af77.js" crossorigin="anonymous"></script>
  </head>
  <body class="main_customer">
      <div class="container-fluid" style="height:900px">
        <div class="card w-25 mx-auto my-5">
          <div class="card-header bg-info text-light text-center text-uppercase">
            <p class="lead">Quick Serach</p>
          </div>
          <div class="card-body">
            <form action="" method="post">
              <div class="form-group">
                <select name="movie" id="" class="form-control">
                  <option value="" selected disabled>Movie</option>
                  <?php foreach($movie as $row): ?>
                    <option value="<?php echo $row['movie_id'] ?>"><?php echo $row['moviename'] ?></option>
                  <?php endforeach; ?>
                </select>
                <select name="cinema" id="" class="form-control mt-2">
                  <option value="" selected disabled>Cinema</option>
                  <?php foreach($cinema as $row): ?>
                    <option value="<?php echo $row['cinema_id'] ?>"><?php echo $row['cinemaname'] ?></option>
                  <?php endforeach; ?>
                </select>
                <select name="date" id="" class="form-control mt-2">
                  <option value="" selected disabled>Date</option>
                  <?php foreach($date as $row): ?>
                    <option value="<?php echo $row['date_id'] ?>"><?php echo $row['date'] ?></option>
                  <?php endforeach; ?>
                </select>
                <button type="submit" name="search" class="btn btn-secondary btn-block mt-3">Search</button>
              </div>
            </form>
            <?php

            if(isset($_POST['search'])):
              $movie = $_POST['movie'];
              $cinema = $_POST['cinema'];
              $date = $_POST['date'];
          
              $search = $Movie->viewSearch($movie,$cinema,$date); ?>

              <p class="lead text-center">TIME</p>
              <hr>

              <?php foreach($search as $row): ?>
                <form action="" method="post">
                  <div class="form-group">
                    <input type="hidden" name="movie2" value='<?php echo $row['movie_id']; ?>'>
                    <input type="hidden" name="cinema2" value='<?php echo $row['cinema_id']; ?>'>
                    <input type="hidden" name="date2" value='<?php echo $row['date_id']; ?>'>
                    <input type="hidden" name="time" value='<?php echo $row['time_id']; ?>'>
                    <button type="submit" name="search2" class="btn btn-warning btn-block w-50 mx-auto"><?php echo $row['time']; ?></button>
                </form>
              </div>
              <?php endforeach; ?>

            <?php 
            endif;
            
            ?>
          </div>
        </div>
        <?php

        if(isset($_POST['search2'])):
    
          $movie2 = $_POST['movie2'];
          $cinema2 = $_POST['cinema2'];
          $date2 = $_POST['date2'];
          $time = $_POST['time'];
      
          $search2 = $Movie->viewSearch2($movie2,$cinema2,$date2,$time); ?>
          
          <?php foreach($search2 as $row2): ?>
          <div class="container bg-secondary">
            <div class="row">
              <div class="col-lg-4 text-center mt-3">
                <img src='uploads/<?php echo $row2['image']; ?>' style="height:450px; width:300px">
              </div>
              <div class="col-lg-8 mt-3">
                <?php echo $row2['trailer']; ?>
                <table class="table table-bordered table-danger mt-3">
                  <thead>
                    <th colspan="5">Title: <?php echo $row2['moviename']; ?></th>
                  </thead>
                  <tbody>
                      <td>Category:<br><?php echo $row2['moviecategory']; ?></td>
                      <td>Date:<br><?php echo $row2['date']; ?></td>
                      <td>Cinema:<br><?php echo $row2['cinemaname']; ?></td>
                      <td>Time:<br><?php echo $row2['time']; ?></td>
                      <?php
                      if($row2['moviecategory'] == "Upcoming"){
                        echo "<td><a href='' role='button' class='btn btn-danger btn-block'>Reserve</a></td>";
                      }else{
                        echo "<td><a href='' role='button' class='btn btn-danger btn-block'>Buy</a></td>";
                      }
                      ?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
          <?php endforeach; ?>

        <?php 
        endif;

        ?>
      </div>
      <footer class="bg-dark p-3">
        <p class="lead text-light text-center">Copyright © 2020 Takuto Imari</p>
      </footer>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  </body>
</html>