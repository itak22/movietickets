<!doctype html>
<html lang="en">
  <head>
    <title>customer</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style.css">

    <script src="https://kit.fontawesome.com/eb83b1af77.js" crossorigin="anonymous"></script>
  </head>
  <body class="customer">
    <?php
    include 'menu_customer.php';

    $oneReserve = $Movie->viewReserve($loginID);

    ?>
      <div class="container-fluid">
          <p class="lead font-weight-bold text-center mt-2">Reservation History</p>
          <table class="table w-75 mx-auto">
            <thead>
              <th>Reservation<br>Date</th>
              <th>Movie<br>Title</th>
              <th>Theater</th>
              <th>Hall</th>
              <th>Showing<br>Date</th>
              <th>Starting<br>Time</th>
              <th>Price</th>
              <th>Seat</th>   
              <th></th>
              <th></th>
            </thead>
            <?php foreach($oneReserve as $row):
        
              $timeID = $row['time_id'];
              $oneTimeline = $Movie->viewOneTimeline($timeID);
              
              $seatID = $row['seat_id'];
              $oneSeat = $Movie->viewOneSeat($seatID);

              ?>

            <tbody>
              <td><?php echo $row['reservedate'] ?></td>
              <?php foreach($oneTimeline as $row2): ?>

                <td><?php echo $row2['moviename'] ?></td>
                <td><?php echo $row2['theatername'] ?></td>
                <td><?php echo $row2['hallname'] ?></td>
                <td><?php echo $row2['date'] ?></td>
                <td><?php echo $row2['startinghours']; echo ':'; echo $row2['startingminutes']; echo $row2['startingam_pm'] ?></td>
                <td><?php echo $row2['price'] ?>P</td>
              <?php endforeach ?>
              <?php foreach($oneSeat as $row2): ?>
                <td><?php echo $row2['seatrow']; echo $row2['seatnumber']; ?></td>
              <?php endforeach ?> 
              <td><a href="#cancel<?php echo $row['reserve_id'] ?>" role="button" class="btn btn-danger" data-toggle="modal">Cancel</a></td>
              <div class="modal fade" id="cancel<?php echo $row['reserve_id'] ?>">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5>Cancellation</h5>
                            <button type="button" class="close" data-dismiss="modal">
                                <span>&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                          <p>Are you sure to cancel the reservation?</p>
                        </div>
                        <div class="modal-footer">
                            <form action="action.php" method="post">
                              <div class="form-group">
                                  <input type="hidden" name="reserveid" value="<?php echo $row['reserve_id'] ?>">
                                  <button type="submit" name="deleteReserve" class="btn btn-warning mt-3">Yes</button> 
                              </div>
                            </form>
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>                       
                        </div>
                    </div>
                </div>
              </div>
              <?php endforeach ?> 
          </table>      
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