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

    <script src="https://kit.fontawesome.com/eb83b1af77.js" crossorigin="anonymous">9</script>
  </head>
  <body class="main_customer">
    <div id="bg">
      <img src="img/background.jpg" alt="background">
    </div>
    <?php
    include 'menu_customer.php';

    $loginID = $_SESSION['login_id'];
    $row = $Movie->getOneCustomer($loginID);

    // if(empty($_SESSION['login_id'])){
    //     header('location:signin.php');
    // }

    $movie = $Movie->viewMovie();
    $theater = $Movie->viewTheater();

    ?>
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
                <select name="theater" id="" class="form-control mt-2">
                  <option value="" selected disabled>Theater</option>
                  <?php foreach($theater as $row): ?>
                    <option value="<?php echo $row['theater_id'] ?>"><?php echo $row['theatername'] ?></option>
                  <?php endforeach; ?>
                </select>
                <button type="submit" name="search" class="btn btn-secondary btn-block mt-3">Search</button>
              </div>
            </form>
            <?php

            if(isset($_POST['search'])):
              $movie = $_POST['movie'];
              $theater = $_POST['theater'];
          
              $search = $Movie->viewSearch($movie,$theater); ?>

              <p class="lead text-center">TIME</p>
              <hr>

              <?php foreach($search as $row): ?>
                <form action="" method="post">
                  <div class="form-group">
                    <input type="hidden" name="movie2" value='<?php echo $row['movie_id']; ?>'>
                    <input type="hidden" name="theater2" value='<?php echo $row['theater_id']; ?>'>
                    <input type="hidden" name="date" value='<?php echo $row['date_id']; ?>'>
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
          $theater2 = $_POST['theater2'];
          $date = $_POST['date'];
          $time = $_POST['time'];
      
          $search2 = $Movie->viewSearch2($movie2,$theater2,$date,$time); ?>
          
          <?php foreach($search2 as $row2): ?>
          <div class="container bg-secondary">
            <div class="row">
              <div class="col-lg-4 text-right mt-3">
                <img src='uploads/<?php echo $row2['image']; ?>' style="height:450px; width:300px">
              </div>
              <div class="col-lg-8 text-center mt-3">
                <table class="table table-bordered table-danger mt-3 w-75 mx-auto">
                  <thead>
                    <th colspan="4">Title: <?php echo $row2['moviename']; ?></th>
                  </thead>
                  <tbody>
                      <td>Date:<br><?php echo $row2['date']; ?></td>
                      <td>Theater:<br><?php echo $row2['theatername']; ?></td>
                      <td>Time:<br><?php echo $row2['time']; ?></td>
                      <td>
                        <form action="action.php" method="post">
                          <div class="form-group">
                            <input type="hidden" name="cdate" value='<?php echo date("Ymd"); ?>'>
                            <input type="hidden" name="movie3" value='<?php echo $row2['movie_id']; ?>'>
                            <input type="hidden" name="theater3" value='<?php echo $row2['theater_id']; ?>'>
                            <input type="hidden" name="date3" value='<?php echo $row2['date_id']; ?>'>
                            <input type="hidden" name="time2" value='<?php echo $row2['time_id']; ?>'>
                            <?php
                            if($row2['moviecategory_id'] == "1"){
                              echo "<button type='submit' name='reserve' class='btn btn-danger btn-block'>Reserve</button>";
                            }else{
                              echo "<button type='submit' name='purchase' class='btn btn-danger btn-block'>Purchase</button>";
                            }
                            ?>
                          </div>
                        </form>
                      </td>;
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