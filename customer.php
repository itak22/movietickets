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
    <div id="bg">
        <img src="img/background.jpg" alt="background">
    </div>
    <?php
    include 'menu_customer.php';

    $rlist = $Movie->viewReserve();
    $plist = $Movie->viewPurchase();

    ?>
      <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12 text-center">
                <p class="lead display-4 text-light font-weight-bold">Reservation History</p>
                <table class="table table-secondary text-center w-75 mx-auto">
                    <thead>
                        <tr>
                            <th colspan="6">Latest</th>
                        </tr>
                        <tr>
                            <th>Reservation ID</th>
                            <th>Reservation Date</th>
                            <th>Showing Date</th>
                            <th>movie</th>
                            <th>cinema</th>
                            <th>time</th>
                        </tr>
                    </thead>
                    <?php foreach($rlist as $row): ?>
                    <tbody>
                        <td><?php echo $row['reserve_id'] ?></td>
                        <td><?php echo $row['reservedate'] ?></td>
                        <td><?php echo $row['date'] ?></td>
                        <td><?php echo $row['moviename'] ?></td>
                        <td><?php echo $row['cinemaname'] ?></td>
                        <td><?php echo $row['time'] ?></td>
                    </tbody>
                    <?php endforeach; ?>
                    
                </table>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12 text-center">
                <p class="lead display-4 text-light font-weight-bold">Purchase History</p>
                <table class="table table-secondary text-center w-75 mx-auto">
                    <thead>
                        <tr>
                            <th colspan="6">Latest</th>
                        </tr>
                        <tr>
                            <th>Purchase ID</th>
                            <th>Purchase Date</th>
                            <th>Showing Date</th>
                            <th>movie</th>
                            <th>cinema</th>
                            <th>time</th>
                        </tr>
                    </thead>
                    <?php foreach($plist as $row): ?>
                    <tbody>
                        <td><?php echo $row['reserve_id'] ?></td>
                        <td><?php echo $row['reservedate'] ?></td>
                        <td><?php echo $row['date'] ?></td>
                        <td><?php echo $row['moviename'] ?></td>
                        <td><?php echo $row['cinemaname'] ?></td>
                        <td><?php echo $row['time'] ?></td>
                    </tbody>
                    <?php endforeach; ?>
                    
                </table>
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