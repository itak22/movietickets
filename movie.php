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
  <body class="movie">
    <?php
    include 'menu_customer.php';

    $category = $Movie->viewMovieCategory(); 

    ?>
    <div class="container-fluid">
        <?php foreach($category as $row):
        
        $categoryID = $row['moviecategory_id']; 
        
        $movie2 = $Movie->viewMovie2($categoryID);
        $movie3 = $Movie->viewMovie3($categoryID); ?>

        <p class="lead font-weight-bold mt-2"><?php echo $row['moviecategory'] ?></p>
        <div id="carouselExampleInterval<?php echo $row['moviecategory_id'] ?>" class="carousel slide" data-ride="carousel" data-interval="false">
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <div class="row">
                        <?php foreach($movie2 as $row): ?>
                        <div class="col-lg-3">
                            <a href="movie_detail.php?movie_id=<?php echo $row['movie_id'] ?>"><img src="uploads/<?php echo $row['image'] ?>" alt="starwars"></a>
                            <p><?php echo $row['moviename'] ?></p>
                            <p><?php echo $row['runninghours'] ?>h <?php echo $row['runningminutes'] ?>m | <?php echo $row['releasedate'] ?></p>
                        </div>    
                        <?php endforeach; ?>
                    </div> 
                </div>
                <div class="carousel-item">
                    <div class="row">
                        <?php foreach($movie3 as $row): ?>
                            <div class="col-lg-3">
                                <a href="movie_detail.php?movie_id=<?php echo $row['movie_id'] ?>"><img src="uploads/<?php echo $row['image'] ?>" alt="starwars"></a>
                                <p><?php echo $row['moviename'] ?></p>
                                <p><?php echo $row['runninghours'] ?>h <?php echo $row['runningminutes'] ?>m | <?php echo $row['releasedate'] ?></p>
                            </div>    
                        <?php endforeach; ?>
                        </div> 
                </div>
            </div>
            <a class="carousel-control-prev" href="#carouselExampleInterval<?php echo $row['moviecategory_id'] ?>" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon bg-dark" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#carouselExampleInterval<?php echo $row['moviecategory_id'] ?>" role="button" data-slide="next">
                <span class="carousel-control-next-icon bg-dark" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
        </div>
        <?php endforeach; ?>
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