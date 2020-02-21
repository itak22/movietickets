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
    include 'menu_staff.php';

    if ($userAccess['status'] == 'U') {
        echo "<script>window.location.href='main_customer.php'</script>";
    }

    $movieID = $_GET['movie_id'];
    $viewOneMovie = $Movie->viewOneMovie($movieID);

    $nowShowing = $Movie->viewNowShowing();

    $viewReview = $Movie->viewReview($movieID);

    $avg = $Movie->viewAvg($movieID);

    $rate10 = '10';
    $viewRate10 = $Movie->viewOneRate($movieID,$rate10);

    $rate9 = '9';
    $viewRate9 = $Movie->viewOneRate($movieID,$rate9);

    $rate8 = '8';
    $viewRate8 = $Movie->viewOneRate($movieID,$rate8);

    $rate7 = '7';
    $viewRate7 = $Movie->viewOneRate($movieID,$rate7);

    $rate6 = '6';
    $viewRate6 = $Movie->viewOneRate($movieID,$rate6);

    $rate5 = '5';
    $viewRate5 = $Movie->viewOneRate($movieID,$rate5);

    $rate4 = '4';
    $viewRate4 = $Movie->viewOneRate($movieID,$rate4);

    $rate3 = '3';
    $viewRate3 = $Movie->viewOneRate($movieID,$rate3);

    $rate2 = '2';
    $viewRate2 = $Movie->viewOneRate($movieID,$rate2);

    $rate1 = '1';
    $viewRate1 = $Movie->viewOneRate($movieID,$rate1);

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
                        <a href="review_staff.php?movie_id=<?php echo $row['movie_id'] ?>"><?php echo $row['moviename'] ?></a>
                        <br>
                    <?php endforeach ?>
                </div>
            </div>
            <div class="col-lg-5">
                <a href="#review" role="button" class="btn btn-info float-right mr-3" data-toggle="modal">+Post</a>
                <p class="lead">User Reviews</p>
                <div class="modal fade" id="review">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5>Write a Review</h5>
                                <button type="button" class="close" data-dismiss="modal">
                                    <span>&times;</span>
                                </button>
                            </div>
                            <div class="modal-body w-75 mx-auto">
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
                                                    <option value="10" selected>10</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12 mt-2">
                                                <label for="">Review:</label>
                                                <textarea name="review" id="" cols="30" rows="10" class="form-control" required></textarea>
                                            </div>
                                        </div>
                                        <button type="submit" name="postA" class="btn btn-warning btn-blockn mt-3">POST</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>  
                <hr>
                <?php foreach($viewReview as $row): ?>
                    <div class="ml-4">
                        <div class="float-right">
                            <a href="#edit<?php echo $row['review_id'] ?>" role="button" class="btn btn-warning" data-toggle="modal">Edit</a>
                            <a href="#delete<?php echo $row['review_id'] ?>" role="button" class="btn btn-danger" data-toggle="modal">Delete</a>
                        </div>
                        <p><?php echo $row['nickname'] ?> | <?php echo $row['reviewdate'] ?></p>
                        <p class="mt-4">
                            <i class="fas fa-star"></i> <b><?php echo $row['rate'] ?></b> / 10
                            <br>
                            <?php echo $row['review'] ?>  
                        </p>
                    </div>
                    <div class="modal fade" id="edit<?php echo $row['review_id'] ?>"
                    >
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5>Edit Your Review</h5>
                                    <button type="button" class="close" data-dismiss="modal">
                                        <span>&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body w-75 mx-auto">
                                    <form action="action.php" method="post">
                                        <div class="form-group">
                                            <input type="hidden" name="reviewid" value="<?php echo $row['review_id'] ?>">
                                            <input type="hidden" name="movieid" value="<?php echo $movieID ?>">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <label for="">Nickname:</label>
                                                    <input type="text" name="nickname" value="<?php echo $row['nickname'] ?>" class="form-control" required>
                                                </div>
                                                <div class="col-md-6">
                                                    <label for="">Rate:</label>
                                                    <select name="rate" id="" class="form-control w-50">
                                                        <option value="" selected disabled><?php echo $row['rate'] ?></option>
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
                                                    <textarea name="review" id="" cols="30" rows="10" class="form-control" required><?php echo $row['review'] ?></textarea>
                                                </div>
                                            </div>
                                            <button type="submit" name="updateReviewA" class="btn btn-warning btn-blockn mt-3">UPDATE</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div> 
                    <div class="modal fade" id="delete<?php echo $row['review_id'] ?>">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5>Delete Your Review</h5>
                                    <button type="button" class="close" data-dismiss="modal">
                                        <span>&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body text-center">
                                <p>Are you sure to delete the review?</p>
                                </div>
                                <div class="modal-footer">
                                <form action="" method="post">
                                    <div class="form-group">
                                        <input type="hidden" name="reviewid" value="<?php echo $row['review_id'] ?>">
                                        <input type="hidden" name="movieid" value="<?php echo $movieID ?>">
                                        <button type="submit" name="deleteReviewA" class="btn btn-warning mt-3">Yes</button>
                                    </div>
                                </form>    
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>                       
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr>
                <?php endforeach ?>
            </div>
            <div class="col-lg-4">
            <p class="lead">User Rating</p>
                <div class="ml-4">   
                    <p class="float-left mr-3">Average Rate: <b><?php foreach($avg as $row){ echo round($row['averageRate'],1); } ?></b></p>
                    <p>Total Reviews: <b><?php echo count($viewReview) ?></b></p>
                    <div class="row">
                        <div class="col-md-3 text-right">
                            <p id="rate10"><i class="fas fa-star"></i> 10</p>
                        </div>
                        <div class="col-md-6">
                            <div class="progress mt-1">
                                <div class="progress-bar bg-success" role="progressbar" style="width: <?php if(count($viewReview) == 0){ echo '0'; }else{ echo count($viewRate10)*100/count($viewReview); } ?>%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"><?php if(count($viewReview) == 0){ echo '0'; }else{ echo round(count($viewRate10)*100/count($viewReview),0); } ?>%</div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <p id="review10"><i class="fas fa-pencil-alt"></i> <?php echo count($viewRate10) ?></p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-3 text-right">
                            <p><i class="fas fa-star"></i> 9</p>
                        </div>
                        <div class="col-md-6">
                            <div class="progress mt-1">
                                <div class="progress-bar bg-success" role="progressbar" style="width: <?php if(count($viewReview) == 0){ echo '0'; }else{ echo count($viewRate9)*100/count($viewReview); } ?>%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"><?php if(count($viewReview) == 0){ echo '0'; }else{ echo round(count($viewRate9)*100/count($viewReview),0); } ?>%</div>
                            </div>
                        </div>
                        <div class="col-md-3">
                        <p id="review9"><i class="fas fa-pencil-alt"></i> <?php echo count($viewRate9) ?></p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-3 text-right">
                            <p><i class="fas fa-star"></i> 8</p>
                        </div>
                        <div class="col-md-6">
                            <div class="progress mt-1">
                                <div class="progress-bar bg-success" role="progressbar" style="width: <?php if(count($viewReview) == 0){ echo '0'; }else{ echo count($viewRate8)*100/count($viewReview); } ?>%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"><?php if(count($viewReview) == 0){ echo '0'; }else{ echo round(count($viewRate8)*100/count($viewReview),0); } ?>%</div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <p id="review8"><i class="fas fa-pencil-alt"></i> <?php echo count($viewRate8) ?></p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-3 text-right">
                            <p><i class="fas fa-star"></i> 7</p>
                        </div>
                        <div class="col-md-6">
                            <div class="progress mt-1">
                                <div class="progress-bar bg-success" role="progressbar" style="width: <?php if(count($viewReview) == 0){ echo '0'; }else{ echo count($viewRate7)*100/count($viewReview); } ?>%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"><?php if(count($viewReview) == 0){ echo '0'; }else{ echo round(count($viewRate7)*100/count($viewReview),0); } ?>%</div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <p id="review7"><i class="fas fa-pencil-alt"></i> <?php echo count($viewRate7) ?></p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-3 text-right">
                            <p><i class="fas fa-star"></i> 6</p>
                        </div>
                        <div class="col-md-6">
                            <div class="progress mt-1">
                                <div class="progress-bar bg-success" role="progressbar" style="width: <?php if(count($viewReview) == 0){ echo '0'; }else{ echo count($viewRate6)*100/count($viewReview); } ?>%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"><?php if(count($viewReview) == 0){ echo '0'; }else{ echo round(count($viewRate6)*100/count($viewReview),0); } ?>%</div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <p id="review6"><i class="fas fa-pencil-alt"></i> <?php echo count($viewRate6) ?></p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-3 text-right">
                            <p><i class="fas fa-star"></i> 5</p>
                        </div>
                        <div class="col-md-6">
                            <div class="progress mt-1">
                                <div class="progress-bar bg-success" role="progressbar" style="width: <?php if(count($viewReview) == 0){ echo '0'; }else{ echo count($viewRate5)*100/count($viewReview); } ?>%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"><?php if(count($viewReview) == 0){ echo '0'; }else{ echo round(count($viewRate5)*100/count($viewReview),0); } ?>%</div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <p id="review5"><i class="fas fa-pencil-alt"></i> <?php echo count($viewRate5) ?></p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-3 text-right">
                            <p><i class="fas fa-star"></i> 4</p>
                        </div>
                        <div class="col-md-6">
                            <div class="progress mt-1">
                                <div class="progress-bar bg-success" role="progressbar" style="width: <?php if(count($viewReview) == 0){ echo '0'; }else{ echo count($viewRate4)*100/count($viewReview); } ?>%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"><?php if(count($viewReview) == 0){ echo '0'; }else{ echo round(count($viewRate4)*100/count($viewReview),0); } ?>%</div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <p id="review4"><i class="fas fa-pencil-alt"></i> <?php echo count($viewRate4) ?></p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-3 text-right">
                            <p><i class="fas fa-star"></i> 3</p>
                        </div>
                        <div class="col-md-6">
                            <div class="progress mt-1">
                                <div class="progress-bar bg-success" role="progressbar" style="width: <?php if(count($viewReview) == 0){ echo '0'; }else{ echo count($viewRate3)*100/count($viewReview); } ?>%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"><?php if(count($viewReview) == 0){ echo '0'; }else{ echo round(count($viewRate3)*100/count($viewReview),0); } ?>%</div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <p id="review3"><i class="fas fa-pencil-alt"></i> <?php echo count($viewRate3) ?></p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-3 text-right">
                            <p><i class="fas fa-star"></i> 2</p>
                        </div>
                        <div class="col-md-6">
                            <div class="progress mt-1">
                                <div class="progress-bar bg-success" role="progressbar" style="width: <?php if(count($viewReview) == 0){ echo '0'; }else{ echo count($viewRate2)*100/count($viewReview); } ?>%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"><?php if(count($viewReview) == 0){ echo '0'; }else{ echo round(count($viewRate2)*100/count($viewReview),0); } ?>%</div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <p id="review2"><i class="fas fa-pencil-alt"></i> <?php echo count($viewRate2) ?></p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-3 text-right">
                            <p><i class="fas fa-star"></i> 1</p>
                        </div>
                        <div class="col-md-6">
                            <div class="progress mt-1">
                                <div class="progress-bar bg-success" role="progressbar" style="width: <?php if(count($viewReview) == 0){ echo '0'; }else{ echo count($viewRate1)*100/count($viewReview); } ?>%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"><?php if(count($viewReview) == 0){ echo '0'; }else{ echo round(count($viewRate1)*100/count($viewReview),0); } ?>%</div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <p id="review1"><i class="fas fa-pencil-alt"></i> <?php echo count($viewRate1) ?></p>
                        </div>
                    </div>
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