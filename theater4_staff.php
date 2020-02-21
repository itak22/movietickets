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
  include 'menu_staff.php';

  if ($userAccess['status'] == 'U') {
    echo "<script>window.location.href='main_customer.php'</script>";
  }

  $theaterID = $_GET['theater_id'];
  $theater2 = $Movie->viewtheater2($theaterID);

  $viewDate = $Movie->viewDate($theaterID);

  $date = date("Y/m/d", strtotime(' +3 day'));
  $timeline = $Movie->viewTimeline($theaterID,$date); 

  ?>
    <div class="container">
    <?php foreach($theater2 as $row): ?>
      <div class="row">
        <div class="col-lg-10 mt-2">
          <p class="lead font-weight-bold display-4"><?php echo $row['theatername'] ?></p>
          <p class="lead"><i class="fas fa-map-marker-alt text-danger"></i><?php echo $row['location'] ?></p>
          <a href="#addTime<?php echo $row['theater_id'] ?>" role="button" class="btn btn-outline-primary text-primary btn-block w-25 my-4" data-toggle="modal">+Time</a>
        </div>
        <div class="col-lg-2 mt-2">
            <a href="#addDate<?php echo $row['theater_id'] ?>" role="button" class="btn btn-outline-primary text-primary btn-block" data-toggle="modal">+Date</a>
            <a href="#addHall<?php echo $row['theater_id'] ?>" role="button" class="btn btn-outline-primary text-primary btn-block" data-toggle="modal">+Hall</a>
            <a href="#addPrice<?php echo $row['theater_id'] ?>" role="button" class="btn btn-outline-primary text-primary btn-block" data-toggle="modal">+Price</a> 
        </div>
      </div>
      <div class="row">
        <div class="col-lg-12 mt-2">
          <ul class="nav nav-tabs text-center">
            <li class="nav-item">
              <a class="nav-link" href="theater_staff.php?theater_id=<?php echo $theaterID ?>"><?php echo date('D') ?><br><?php echo date('M d') ?></a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="theater2_staff.php?theater_id=<?php echo $theaterID ?>"><?php echo date('D', strtotime(' +1 day')) ?><br><?php echo date('M d', strtotime(' +1 day')) ?></a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="theater3_staff.php?theater_id=<?php echo $theaterID ?>"><?php echo date('D', strtotime(' +2 day')) ?><br><?php echo date('M d', strtotime(' +2 day')) ?></a>
            </li>
            <li class="nav-item">
              <a class="nav-link active"><?php echo date('D', strtotime(' +3 day')) ?><br><?php echo date('M d', strtotime(' +3 day')) ?></a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="theater5_staff.php?theater_id=<?php echo $theaterID ?>"><?php echo date('D', strtotime(' +4 day')) ?><br><?php echo date('M d', strtotime(' +4 day')) ?></a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="theater6_staff.php?theater_id=<?php echo $theaterID ?>"><?php echo date('D', strtotime(' +5 day')) ?><br><?php echo date('M d', strtotime(' +5 day')) ?></a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="theater7_staff.php?theater_id=<?php echo $theaterID ?>"><?php echo date('D', strtotime(' +6 day')) ?><br><?php echo date('M d', strtotime(' +6 day')) ?></a>
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
                      <td><a href="reserve_staff.php?time_id=<?php echo $row['time_id'] ?>" role="button" class="btn text-dark"><?php echo $row['startinghours']; echo ':'; echo $row['startingminutes']; echo $row['startingam_pm']; ?></a></td>
                    <?php endforeach ?>
                  </tr>
                </tbody>
              </table>
              <a href="#editTime<?php echo $row['time_id'] ?>" role="button" class="btn btn-outline-warning text-warning" data-toggle="modal">Edit</a>
              <a href="#deleteTime<?php echo $row['time_id'] ?>" role="button" class="btn btn-outline-danger text-danger ml-2" data-toggle="modal">Delete</a>
              <div class="modal fade" id="editTime<?php echo $row['time_id'] ?>">
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
                                      <input type="hidden" name="theaterid" value="<?php echo $row['theater_id'] ?>">
                                      <label for="">Old Time:</label>
                                      <select name="time" id="" class="form-control">
                                          <?php foreach ($time as $row): ?>
                                              <option value="<?php echo $row['time_id'] ?>"><?php echo $row['startinghours']; echo ':'; echo $row['startingminutes']; echo $row['startingam_pm']; echo '-'; echo $row['endinghours']; echo ':'; echo $row['endingminutes']; echo $row['endingam_pm']; ?></option>
                                          <?php endforeach ?>
                                      </select>
                                      <label for="" class="mt-2">New Starting Time:</label>
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
                                      <label for="">New Ending Time:</label>
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
                                      <button type="submit" name="editTime" class="btn btn-danger btn-block mt-3">UPDATE</button>
                                  </div>
                              </form>
                          </div>
                      </div>
                  </div>
              </div>
              <div class="modal fade" id="deleteTime<?php echo $row['time_id'] ?>">
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
                                      <input type="hidden" name="theaterid" value="<?php echo $row['theater_id'] ?>">
                                      <select name="time" id="" class="form-control">
                                          <option value="" selected disabled>choose the time</option> 
                                          <?php foreach ($time as $row): ?>
                                              <option value="<?php echo $row['time_id'] ?>"><?php echo $row['startinghours']; echo ':'; echo $row['startingminutes']; echo $row['startingam_pm']; echo '-'; echo $row['endinghours']; echo ':'; echo $row['endingminutes']; echo $row['endingam_pm']; ?></option>
                                          <?php endforeach ?>
                                      </select>
                                      <label for="" class="mt-4">Are you sure to delete the time?</label>
                                      <button type="submit" name="deleteTime" class="btn btn-danger btn-block mt-3">DELETE</button>
                                  </div>
                              </form>
                          </div>
                      </div>
                  </div>
              </div>
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