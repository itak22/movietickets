<!doctype html>
<html lang="en">
  <head>
    <title>reserve</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style.css">

    <script src="https://kit.fontawesome.com/eb83b1af77.js" crossorigin="anonymous"></script>
  </head>
  <body class="review">
    <?php
    include 'menu_customer.php';

    $movieID = $_GET['movie_id'];
    $viewOneMovie = $Movie->viewOneMovie($movieID);

    $nowShowing = $Movie->viewNowShowing();

    $viewReview = $Movie->viewReview($movieID);

    $avg = $Movie->viewAvg($movieID);

    $rate10 = $Movie->viewRate10($movieID);
    $rate9 = $Movie->viewRate9($movieID);
    $rate8 = $Movie->viewRate8($movieID);
    $rate7 = $Movie->viewRate7($movieID);
    $rate6 = $Movie->viewRate6($movieID);
    $rate5 = $Movie->viewRate5($movieID);
    $rate4 = $Movie->viewRate4($movieID);
    $rate3 = $Movie->viewRate3($movieID);
    $rate2 = $Movie->viewRate2($movieID);
    $rate1 = $Movie->viewRate1($movieID);

    ?>
    <div class="container-fluid">
        <div class="row my-2">
            <div class="col-lg-3 text-center">
                <?php foreach($viewOneMovie as $row): ?>
                    <img src="uploads/<?php echo $row['image'] ?>" alt="">
                <?php endforeach ?>
                <div class="lead text-left mt-2 ml-4">
                    <?php foreach($nowShowing as $row):

                        $movieID2 = $row['movie_id'];
                        $viewReview2 = $Movie->viewReview($movieID2); ?>

                        <br>
                        <p class="float-left mr-2" id="reviewnum"><?php echo count($viewReview2) ?></p>
                        <a href="review.php?movie_id=<?php echo $row['movie_id'] ?>"><?php echo $row['moviename'] ?></a>
                        <br>
                    <?php endforeach ?>
                </div>
            </div>
            <div class="col-lg-5">
                <p class="lead">User Reviews</p>
                <hr>
                <?php foreach($viewReview as $row): ?>

                    <div class="ml-4">
                        <?php echo $row['nickname'] ?> | <?php echo $row['reviewdate'] ?>
                        <p class="mt-4">
                            <i class="fas fa-star"></i> <b><?php echo $row['rate'] ?></b> / 10
                            <br>
                            <?php echo $row['review'] ?>  
                        </p>
                    </div>
                    <hr>
                <?php endforeach ?>
            </div>
            <div class="col-lg-4">
            <p class="lead">User Rating</p>
                <div class="ml-4">   
                    <p class="float-left mr-3">Average Rate: <b><?php foreach($avg as $row){ echo round($row['averageRate'],1); } ?></b></p>
                    <p>Reviews: <b><?php echo count($viewReview) ?></b></p>
                    <div class="row">
                        <div class="col-md-3 text-right">
                            <p id="rate10"><i class="fas fa-star"></i> 10</p>
                        </div>
                        <div class="col-md-6">
                            <div class="progress mt-1">
                                <div class="progress-bar bg-success" role="progressbar" style="width: <?php echo count($rate10)*100/count($viewReview) ?>%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"><?php echo round(count($rate10)*100/count($viewReview),0) ?>%</div>
                                
                            </div>
                        </div>
                        <div class="col-md-3">
                            <p><?php echo count($rate10) ?></p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-3 text-right">
                            <p><i class="fas fa-star"></i> 9</p>
                        </div>
                        <div class="col-md-6">
                            <div class="progress mt-1">
                                <div class="progress-bar bg-success" role="progressbar" style="width: <?php echo count($rate9)*100/count($viewReview) ?>%;"><?php echo round(count($rate9)*100/count($viewReview),0) ?>%</div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <p><?php echo count($rate9) ?></p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-3 text-right">
                            <p><i class="fas fa-star"></i> 8</p>
                        </div>
                        <div class="col-md-6">
                            <div class="progress mt-1">
                                <div class="progress-bar bg-success" role="progressbar" style="width: <?php echo count($rate8)*100/count($viewReview) ?>%;"><?php echo round(count($rate8)*100/count($viewReview),0) ?>%</div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <p><?php echo count($rate8) ?></p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-3 text-right">
                            <p><i class="fas fa-star"></i> 7</p>
                        </div>
                        <div class="col-md-6">
                            <div class="progress mt-1">
                                <div class="progress-bar bg-success" role="progressbar" style="width: <?php echo count($rate7)*100/count($viewReview) ?>%;"><?php echo round(count($rate7)*100/count($viewReview),0) ?>%</div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <p><?php echo count($rate7) ?></p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-3 text-right">
                            <p><i class="fas fa-star"></i> 6</p>
                        </div>
                        <div class="col-md-6">
                            <div class="progress mt-1">
                                <div class="progress-bar bg-success" role="progressbar" style="width: <?php echo count($rate6)*100/count($viewReview) ?>%;"><?php echo round(count($rate6)*100/count($viewReview),0) ?>%</div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <p><?php echo count($rate6) ?></p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-3 text-right">
                            <p><i class="fas fa-star"></i> 5</p>
                        </div>
                        <div class="col-md-6">
                            <div class="progress mt-1">
                                <div class="progress-bar bg-success" role="progressbar" style="width: <?php echo count($rate5)*100/count($viewReview) ?>%;"><?php echo round(count($rate5)*100/count($viewReview),0) ?>%</div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <p><?php echo count($rate5) ?></p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-3 text-right">
                            <p><i class="fas fa-star"></i> 4</p>
                        </div>
                        <div class="col-md-6">
                            <div class="progress mt-1">
                                <div class="progress-bar bg-success" role="progressbar" style="width: <?php echo count($rate4)*100/count($viewReview) ?>%;"><?php echo round(count($rate4)*100/count($viewReview),0) ?>%</div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <p><?php echo count($rate4) ?></p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-3 text-right">
                            <p><i class="fas fa-star"></i> 3</p>
                        </div>
                        <div class="col-md-6">
                            <div class="progress mt-1">
                                <div class="progress-bar bg-success" role="progressbar" style="width: <?php echo count($rate3)*100/count($viewReview) ?>%;"><?php echo round(count($rate3)*100/count($viewReview),0) ?>%</div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <p><?php echo count($rate3) ?></p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-3 text-right">
                            <p><i class="fas fa-star"></i> 2</p>
                        </div>
                        <div class="col-md-6">
                            <div class="progress mt-1">
                                <div class="progress-bar bg-success" role="progressbar" style="width: <?php echo count($rate2)*100/count($viewReview) ?>%;"><?php echo round(count($rate2)*100/count($viewReview),0) ?>%</div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <p><?php echo count($rate2) ?></p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-3 text-right">
                            <p><i class="fas fa-star"></i> 1</p>
                        </div>
                        <div class="col-md-6">
                            <div class="progress    ">
                                <div class="progress-bar bg-success" role="progressbar" style="width: <?php echo count($rate1)*100/count($viewReview) ?>%;"><?php echo round(count($rate1)*100/count($viewReview),0) ?>%</div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <p><?php echo count($rate1) ?></p>
                        </div>
                    </div>
                </div>
                <p class="lead mt-2">Write a Review</p>
                <div class="ml-4 w-75">
                    <form action="action.php" method="post">
                        <div class="form-group">
                            <input type="hidden" name="loginid" value="<?php echo $loginID ?>">
                            <input type="hidden" name="movieid" value="<?php echo $movieID ?>">
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="">Nickname:</label>
                                    <input type="text" name="nickname" class="form-control" required>
                                </div>
                                <div class="col-md-6">
                                    <label for="">Rate:</label>
                                    <select name="rate" id="" class="form-control w-50">
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                        <option value="4">4</option>
                                        <option value="5">5</option>
                                        <option value="6">6</option>
                                        <option value="7">7</option>
                                        <option value="8">8</option>
                                        <option value="9">9</option>
                                        <option value="10">10</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12 mt-2">
                                    <label for="">Review:</label>
                                    <textarea name="review" id="" cols="30" rows="10" class="form-control" required></textarea>
                                </div>
                            </div>
                            <button type="submit" name="post" class="btn btn-warning btn-blockn mt-3">Post</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
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