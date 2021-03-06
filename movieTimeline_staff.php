<!doctype html>
<html lang="en">
  <head>
    <title>movie_timeline</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style.css">

    <script src="https://kit.fontawesome.com/eb83b1af77.js" crossorigin="anonymous"></script>
  </head>
  <body class="movie_timeline">
  <?php
  include 'menu_staff.php';

  if ($userAccess['status'] == 'U') {
    echo "<script>window.location.href='main_customer.php'</script>";
    }

  $movieID = $_GET['movie_id'];

  $oneMovie = $Movie->viewOneMovie($movieID);
  $movie4 = $Movie->viewMovie4();
  
  $theater3 = $Movie->viewtheater3($movieID);

  $allTime = $Movie->viewAllTime();

  ?>
    <div class="container">
        <div class="row my-2">
            <div class="col-md-3">
                <div class="list-group" id="list-tab" role="tablist">
                    <?php foreach($oneMovie as $row): ?>
                        <a class="list-group-item list-group-item-action active lead font-weight-bold bg-warning text-dark text-center" data-toggle="list" href="#list" role="tab">Title:<br><?php echo $row['moviename'] ?></a>
                    <?php endforeach ?>
                    <?php foreach($theater3 as $row): ?>
                        <a class="list-group-item list-group-item-action bg-light text-dark" data-toggle="list" href="#list<?php echo $row['theater_id'] ?>" role="tab"><?php echo $row['theatername'] ?></a>
                    <?php endforeach ?>
                </div>
            </div>
            <div class="col-md-9">
                <div class="tab-content" id="nav-tabContent">
                    <div class="tab-pane fade show active" id="list" role="tabpanel">
                        <?php foreach($oneMovie as $row): ?>
                        <div class="row">
                            <div class="col-lg-6">
                                <img src="uploads/<?php echo $row['image'] ?>" alt="">
                            </div>
                            <div class="col-lg-6 mt-4">
                                <p class="lead font-weight-bold">More Movies:</p>
                                <?php foreach($movie4 as $row): ?>
                                <div class="lead">
                                    <a href="movieTimeline_staff.php?movie_id=<?php echo $row['movie_id'] ?>"><?php echo $row['moviename'] ?></a>
                                </div>
                                    
                                
                                <?php endforeach ?>
                            </div>
                        </div>
                        <?php endforeach ?>
                    </div>
                    <?php foreach($theater3 as $row):

                    $theaterID = $row['theater_id'];

                    $date1 = date("Y/m/d");
                    $timeline2_1 = $Movie->viewTimeline2($movieID,$theaterID,$date1);
                    
                    $date2 = date("Y/m/d", strtotime(' +1 day'));
                    $timeline2_2 = $Movie->viewTimeline2($movieID,$theaterID,$date2);

                    $date3 = date("Y/m/d", strtotime(' +2 day'));
                    $timeline2_3 = $Movie->viewTimeline2($movieID,$theaterID,$date3);

                    $date4 = date("Y/m/d", strtotime(' +3 day'));
                    $timeline2_4 = $Movie->viewTimeline2($movieID,$theaterID,$date4);

                    $date5 = date("Y/m/d", strtotime(' +4 day'));
                    $timeline2_5 = $Movie->viewTimeline2($movieID,$theaterID,$date5);

                    $date6 = date("Y/m/d", strtotime(' +5 day'));
                    $timeline2_6 = $Movie->viewTimeline2($movieID,$theaterID,$date6);

                    $date7 = date("Y/m/d", strtotime(' +6 day'));
                    $timeline2_7 = $Movie->viewTimeline2($movieID,$theaterID,$date7); ?>

                        <div class="tab-pane fade" id="list<?php echo $theaterID ?>" role="tabpanel">
                            <p class="lead display-4">Timeline</p>
                            <a href="#addTime2<?php echo $theaterID ?>" role="button" class="btn btn-outline-primary text-primary btn-block w-25 my-4" data-toggle="modal">+Time</a>
                            <div class="modal fade" id="addTime2<?php echo $theaterID ?>">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5>Add Time</h5>
                                            <button type="button" class="close" data-dismiss="modal">
                                                <span>&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="action.php" method="post">
                                                <div class="form-group">
                                                    <input type="hidden" name="movieid" value="<?php echo $movieID ?>">
                                                    <input type="hidden" name="theaterid" value="<?php echo $theaterID ?>">
                                                    <label for="">Starting Time:</label>
                                                    <div class="row">
                                                        <div class="col-lg-4">
                                                            <div class="input-group">
                                                                <input type="number" name="shours" class="form-control" required>
                                                                <div class="input-group-append">
                                                                    <span class="input-group-text" id="basic-addon2">h</span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-4">
                                                            <div class="input-group">
                                                                <input type="number" name="sminutes" class="form-control" required>
                                                                <div class="input-group-append">
                                                                    <span class="input-group-text" id="basic-addon2">min</span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-4">
                                                            <select name="sampm" id="" class="form-control" required>
                                                                <option value="am">AM</option>
                                                                <option value="pm">PM</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <label for="">Ending Time:</label>
                                                    <div class="row">
                                                        <div class="col-lg-4">
                                                            <div class="input-group">
                                                                <input type="number" name="ehours" class="form-control" required>
                                                                <div class="input-group-append">
                                                                    <span class="input-group-text" id="basic-addon2">h</span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-4">
                                                            <div class="input-group">
                                                                <input type="number" name="eminutes" class="form-control" required>
                                                                <div class="input-group-append">
                                                                    <span class="input-group-text" id="basic-addon2">min</span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-4">
                                                            <select name="eampm" id="" class="form-control" required>
                                                                <option value="am">AM</option>
                                                                <option value="pm">PM</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <label for="" class="mt-2">Date:</label>
                                                    <select name="date" id="" class="form-control" required>
                                                        <?php foreach($allDate as $row): ?>
                                                            <option value="<?php echo $row['date_id'] ?>"><?php echo $row['date'] ?></option>
                                                        <?php endforeach ?>
                                                    </select>
                                                    <label for="" class="mt-2">Hall:</label>
                                                    <select name="hall" id="" class="form-control" required>
                                                        <?php foreach($allHall as $row): ?>
                                                            <option value="<?php echo $row['hall_id'] ?>"><?php echo $row['hallname'] ?></option>
                                                        <?php endforeach ?>
                                                    </select>
                                                    <label for="" class="mt-2">Price:</label>
                                                    <select name="price" id="" class="form-control" required>
                                                        <?php foreach($allPrice as $row): ?>
                                                            <option value="<?php echo $row['price_id'] ?>"><?php echo $row['price'] ?><P></P></option>
                                                        <?php endforeach ?>
                                                    </select>
                                                    <button type="submit" name="addTime2" class="btn btn-danger btn-block mt-3">ADD</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <?php foreach($timeline2_1 as $row):
                            
                            $time2_1 = $Movie->viewTime2($movieID,$theaterID,$date1); ?>

                                <div class="ml-4">
                                    <p class="lead font-weight-bold"><?php echo date('D d M', strtotime(' +1 day')) ?></p>
                                    <p class="lead float-left mr-4"><b><?php echo $row['hallname'] ?></p>
                                    <p class="lead"><?php echo $row['price'] ?>P</b></p>
                                    <div class="row text-center">
                                    <?php foreach($time2_1 as $row): ?>
                                        <div class="col-lg-3">
                                            <a href="reserve_staff.php?time_id=<?php echo $row['time_id'] ?>" role="button" class="btn btn-block jumbotron">
                                            <p class="lead font-weight-bold"><?php echo $row['startinghours']; echo ':'; echo $row['startingminutes']; echo $row['startingam_pm'] ?></p>~<?php echo $row['endinghours']; echo ':'; echo $row['endingminutes']; echo $row['endingam_pm'] ?>
                                            </a>
                                            <br>
                                            <a href="#editTime2<?php echo $row['time_id'] ?>" role="button" class="btn btn-outline-warning text-warning" data-toggle="modal">Edit</a>
                                            <a href="#deleteTime2<?php echo $row['time_id'] ?>" role="button" class="btn btn-outline-danger text-danger" data-toggle="modal">Delete</a>
                                        </div>
                                    <?php endforeach ?>
                                    </div>
                                    <hr> 
                                </div>    
                            <?php endforeach ?>
                            <?php foreach($timeline2_2 as $row):
                            
                            $time2_2 = $Movie->viewTime2($movieID,$theaterID,$date2); ?>

                                <div class="ml-4">
                                    <p class="lead font-weight-bold"><?php echo date('D d M', strtotime(' +1 day')) ?></p>
                                    <p class="lead float-left mr-4"><b><?php echo $row['hallname'] ?></p>
                                    <p class="lead"><?php echo $row['price'] ?>P</b></p>
                                    <div class="row text-center">
                                    <?php foreach($time2_2 as $row): ?>
                                        <div class="col-lg-3">
                                            <a href="reserve_staff.php?time_id=<?php echo $row['time_id'] ?>" role="button" class="btn btn-block jumbotron">
                                            <p class="lead font-weight-bold"><?php echo $row['startinghours']; echo ':'; echo $row['startingminutes']; echo $row['startingam_pm'] ?></p>~<?php echo $row['endinghours']; echo ':'; echo $row['endingminutes']; echo $row['endingam_pm'] ?>
                                            </a>
                                            <br>
                                            <a href="#editTime2<?php echo $row['time_id'] ?>" role="button" class="btn btn-outline-warning text-warning" data-toggle="modal">Edit</a>
                                            <a href="#deleteTime2<?php echo $row['time_id'] ?>" role="button" class="btn btn-outline-danger text-danger" data-toggle="modal">Delete</a>
                                        </div>
                                    <?php endforeach ?>
                                    </div>
                                    <hr> 
                                </div>   
                            <?php endforeach ?>
                            <?php foreach($timeline2_3 as $row):
                            
                            $time2_3 = $Movie->viewTime2($movieID,$theaterID,$date3); ?>

                                <div class="ml-4">
                                    <p class="lead font-weight-bold"><?php echo date('D d M', strtotime(' +2 day')) ?></p>
                                    <p class="lead float-left mr-4"><b><?php echo $row['hallname'] ?></p>
                                    <p class="lead"><?php echo $row['price'] ?>P</b></p>
                                    <div class="row text-center">
                                    <?php foreach($time2_3 as $row): ?>
                                        <div class="col-lg-3">
                                            <a href="reserve_staff.php?time_id=<?php echo $row['time_id'] ?>" role="button" class="btn btn-block jumbotron">
                                            <p class="lead font-weight-bold"><?php echo $row['startinghours']; echo ':'; echo $row['startingminutes']; echo $row['startingam_pm'] ?></p>~<?php echo $row['endinghours']; echo ':'; echo $row['endingminutes']; echo $row['endingam_pm'] ?>
                                            </a>
                                            <br>
                                            <a href="#editTime2<?php echo $row['time_id'] ?>" role="button" class="btn btn-outline-warning text-warning" data-toggle="modal">Edit</a>
                                            <a href="#deleteTime2<?php echo $row['time_id'] ?>" role="button" class="btn btn-outline-danger text-danger" data-toggle="modal">Delete</a>
                                        </div>
                                    <?php endforeach ?>
                                    </div>
                                    <hr> 
                                </div>   
                            <?php endforeach ?>
                            <?php foreach($timeline2_4 as $row):
                            
                            $time2_4 = $Movie->viewTime2($movieID,$theaterID,$date4); ?>

                                <div class="ml-4">
                                    <p class="lead font-weight-bold"><?php echo date('D d M', strtotime(' +3 day')) ?></p>
                                    <p class="lead float-left mr-4"><b><?php echo $row['hallname'] ?></p>
                                    <p class="lead"><?php echo $row['price'] ?>P</b></p>
                                    <div class="row text-center">
                                    <?php foreach($time2_4 as $row): ?>
                                        <div class="col-lg-3">
                                            <a href="reserve_staff.php?time_id=<?php echo $row['time_id'] ?>" role="button" class="btn btn-block jumbotron">
                                            <p class="lead font-weight-bold"><?php echo $row['startinghours']; echo ':'; echo $row['startingminutes']; echo $row['startingam_pm'] ?></p>~<?php echo $row['endinghours']; echo ':'; echo $row['endingminutes']; echo $row['endingam_pm'] ?>
                                            </a>
                                            <br>
                                            <a href="#editTime2<?php echo $row['time_id'] ?>" role="button" class="btn btn-outline-warning text-warning" data-toggle="modal">Edit</a>
                                            <a href="#deleteTime2<?php echo $row['time_id'] ?>" role="button" class="btn btn-outline-danger text-danger" data-toggle="modal">Delete</a>
                                        </div>
                                    <?php endforeach ?>
                                    </div>
                                    <hr> 
                                </div>   
                            <?php endforeach ?>
                            <?php foreach($timeline2_5 as $row):
                            
                            $time2_5 = $Movie->viewTime2($movieID,$theaterID,$date5); ?>

                                <div class="ml-4">
                                    <p class="lead font-weight-bold"><?php echo date('D d M', strtotime(' +4 day')) ?></p>
                                    <p class="lead float-left mr-4"><b><?php echo $row['hallname'] ?></p>
                                    <p class="lead"><?php echo $row['price'] ?>P</b></p>
                                    <div class="row text-center">
                                    <?php foreach($time2_5 as $row): ?>
                                        <div class="col-lg-3">
                                            <a href="reserve_staff.php?time_id=<?php echo $row['time_id'] ?>" role="button" class="btn btn-block jumbotron">
                                            <p class="lead font-weight-bold"><?php echo $row['startinghours']; echo ':'; echo $row['startingminutes']; echo $row['startingam_pm'] ?></p>~<?php echo $row['endinghours']; echo ':'; echo $row['endingminutes']; echo $row['endingam_pm'] ?>
                                            </a>
                                            <br>
                                            <a href="#editTime2<?php echo $row['time_id'] ?>" role="button" class="btn btn-outline-warning text-warning" data-toggle="modal">Edit</a>
                                            <a href="#deleteTime2<?php echo $row['time_id'] ?>" role="button" class="btn btn-outline-danger text-danger" data-toggle="modal">Delete</a>
                                        </div>
                                    <?php endforeach ?>
                                    </div>
                                    <hr> 
                                </div>   
                            <?php endforeach ?>
                            <?php foreach($timeline2_6 as $row):
                            
                            $time2_6 = $Movie->viewTime2($movieID,$theaterID,$date6); ?>

                                <div class="ml-4">
                                    <p class="lead font-weight-bold"><?php echo date('D d M', strtotime(' +5 day')) ?></p>
                                    <p class="lead float-left mr-4"><b><?php echo $row['hallname'] ?></p>
                                    <p class="lead"><?php echo $row['price'] ?>P</b></p>
                                    <div class="row text-center">
                                    <?php foreach($time2_6 as $row): ?>
                                        <div class="col-lg-3">
                                            <a href="reserve_staff.php?time_id=<?php echo $row['time_id'] ?>" role="button" class="btn btn-block jumbotron">
                                            <p class="lead font-weight-bold"><?php echo $row['startinghours']; echo ':'; echo $row['startingminutes']; echo $row['startingam_pm'] ?></p>~<?php echo $row['endinghours']; echo ':'; echo $row['endingminutes']; echo $row['endingam_pm'] ?>
                                            </a>
                                            <br>
                                            <a href="#editTime2<?php echo $row['time_id'] ?>" role="button" class="btn btn-outline-warning text-warning" data-toggle="modal">Edit</a>
                                            <a href="#deleteTime2<?php echo $row['time_id'] ?>" role="button" class="btn btn-outline-danger text-danger" data-toggle="modal">Delete</a>
                                        </div>
                                    <?php endforeach ?>
                                    </div>
                                    <hr> 
                                </div>   
                            <?php endforeach ?>
                            <?php foreach($timeline2_7 as $row):
                            
                            $time2_7 = $Movie->viewTime2($movieID,$theaterID,$date7); ?>

                                <div class="ml-4">
                                    <p class="lead font-weight-bold"><?php echo date('D d M', strtotime(' +6 day')) ?></p>
                                    <p class="lead float-left mr-4"><b><?php echo $row['hallname'] ?></p>
                                    <p class="lead"><?php echo $row['price'] ?>P</b></p>
                                    <div class="row text-center">
                                    <?php foreach($time2_7 as $row): ?>
                                        <div class="col-lg-3">
                                            <a href="reserve_staff.php?time_id=<?php echo $row['time_id'] ?>" role="button" class="btn btn-block jumbotron">
                                            <p class="lead font-weight-bold"><?php echo $row['startinghours']; echo ':'; echo $row['startingminutes']; echo $row['startingam_pm'] ?></p>~<?php echo $row['endinghours']; echo ':'; echo $row['endingminutes']; echo $row['endingam_pm'] ?>
                                            </a>
                                            <br>
                                            <a href="#editTime2<?php echo $row['time_id'] ?>" role="button" class="btn btn-outline-warning text-warning" data-toggle="modal">Edit</a>
                                            <a href="#deleteTime2<?php echo $row['time_id'] ?>" role="button" class="btn btn-outline-danger text-danger" data-toggle="modal">Delete</a>
                                        </div>
                                    <?php endforeach ?>
                                    </div>
                                    <hr> 
                                </div>   
                            <?php endforeach ?>
                        </div>
                    <?php endforeach ?>
                </div>
            </div>
        </div>
        <?php foreach($allTime as $row): ?>
        <div class="modal fade" id="editTime2<?php echo $row['time_id'] ?>">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5>Edit Time</h5>
                        <button type="button" class="close" data-dismiss="modal">
                            <span>&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="action.php" method="post">
                            <div class="form-group">
                                <input type="hidden" name="movieid" value="<?php echo $movieID ?>">
                                <input type="hidden" name="timeid" value="<?php echo $row['time_id'] ?>">
                                <label for="" class="mt-2">Starting Time:</label>
                                <div class="row">
                                    <div class="col-lg-4">
                                        <div class="input-group">
                                            <input type="number" name="shours" value="<?php echo $row['startinghours'] ?>" class="form-control" required>
                                            <div class="input-group-append">
                                                <span class="input-group-text" id="basic-addon2">h</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="input-group">
                                            <input type="number" name="sminutes" value="<?php echo $row['startingminutes'] ?>" class="form-control" required>
                                            <div class="input-group-append">
                                                <span class="input-group-text" id="basic-addon2">min</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <select name="sampm" id="" class="form-control" required>
                                            <option value="" selected disabled><?php echo $row['startingam_pm'] ?></option>
                                            <option value="am">AM</option>
                                            <option value="pm">PM</option>
                                        </select>
                                    </div>
                                </div>
                                <label for="">Ending Time:</label>
                                <div class="row">
                                    <div class="col-lg-4">
                                        <div class="input-group">
                                            <input type="number" name="ehours" value="<?php echo $row['endinghours'] ?>" class="form-control" required>
                                            <div class="input-group-append">
                                                <span class="input-group-text" id="basic-addon2">h</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="input-group">
                                            <input type="number" name="eminutes" value="<?php echo $row['endingminutes'] ?>" class="form-control" required>
                                            <div class="input-group-append">
                                                <span class="input-group-text" id="basic-addon2">min</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <select name="eampm" id="" class="form-control" required>
                                            <option value="" selected disabled><?php echo $row['endingam_pm'] ?></option>
                                            <option value="am">AM</option>
                                            <option value="pm">PM</option>
                                        </select>
                                    </div>
                                </div>
                                <button type="submit" name="editTime2" class="btn btn-danger btn-block mt-3">UPDATE</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="deleteTime2<?php echo $row['time_id'] ?>">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5>Delete Time</h5>
                        <button type="button" class="close" data-dismiss="modal">
                            <span>&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="action.php" method="post">
                            <div class="form-group text-center">
                                <input type="hidden" name="movieid" value="<?php echo $movieID ?>">
                                <input type="hidden" name="timeid" value="<?php echo $row['time_id'] ?>">
                                <label for="" class="font-weight-bold" style="font-size: 32px"><?php echo $row['startinghours']; echo ':'; echo $row['startingminutes']; echo $row['startingam_pm']; echo '~'; echo $row['endinghours']; echo ':'; echo $row['endingminutes']; echo $row['endingam_pm'] ?></label>
                                <label for="" class="mt-4">Are you sure to delete the time?</label>
                                <button type="submit" name="deleteTime2" class="btn btn-danger btn-block mt-3">DELETE</button>
                            </div>
                        </form>
                    </div>
                </div>
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