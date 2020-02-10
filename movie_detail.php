<!doctype html>
<html lang="en">
  <head>
    <title>movie_detail</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style.css">

    <script src="https://kit.fontawesome.com/eb83b1af77.js" crossorigin="anonymous"></script>
  </head>
  <body class="movie_detail">
    <?php
    include 'menu_customer.php';

    $movieID = $_GET['movie_id'];
    $movie = $Movie->viewOneMovie($movieID);

    $avg = $Movie->viewAvg($movieID);

    ?>
    <div class="container">
        
        <?php foreach($movie as $row): ?>
            <div class="row mt-2">
                <div class="col-lg-12 text-center">
                    <iframe width="80%" height="400" src="https://www.youtube.com/embed/<?php echo $row['trailer'] ?>" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                </div>
            </div>
            <div class="row my-5">
                <div class="col-lg-8">
                    <p class="lead display-4 font-weight-bold"><?php echo $row['moviename'] ?></p>
                    <p class="lead font-weight-bold"><?php echo $row['runninghours'] ?>h <?php echo $row['runningminutes'] ?>m | <?php echo $row['releasedate'] ?></p>
                    <div class="w-75 mx-auto">      
                        <p class="lead">Overview:<br><?php echo $row['overview'] ?></p>
                        <p class="lead">Running Time: <?php echo $row['runninghours'] ?>h <?php echo $row['runningminutes'] ?>m</p>
                        <p class="lead">Release Date: <?php echo $row['releasedate'] ?></p>
                        <p class="lead d-inline">Rate: <i class="fas fa-star"></i> <?php foreach($avg as $row2){ echo round($row2['averageRate'],1); } ?> / 10</p>
                            <?php if($row['moviecategory_id'] == '2'): ?>
                                <a href="review.php?movie_id=<?php echo $row['movie_id'] ?>" class="ml-3">Review >></a> 
                            <?php endif ?>
                        <br>
                        <a href="" role="button" class="btn btn-danger mt-4">Reserve Ticket</a>
                        <a href="" role="button" class="btn btn-danger ml-2 mt-4">Purchase Ticket</a>
                    </div>
                </div>
                <div class="col-lg-4 text-center">
                    <img src="uploads/<?php echo $row['image'] ?>" alt="">
                </div>
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