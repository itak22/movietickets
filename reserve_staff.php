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

<body class="reserve">
    <?php
    include 'menu_staff.php';

    if ($userAccess['status'] == 'U') {
        echo "<script>window.location.href='main_customer.php'</script>";
    }

    $timeID = $_GET['time_id'];

    $seat = $Movie->viewSeat();
    $oneTimeline = $Movie->viewOneTimeline($timeID);


    ?>
    <div class="container">
        <div class="w-75 mx-auto m-4 p-4" id="seat">
            <p class="lead bg-secondary text-light text-center mb-4 font-weight-bold">SCREEN</p>
            <div class="row mt-5">
                <?php foreach ($seat as $row) :

                    $seatID = $row['seat_id'];
                    $oneReserve = $Movie->viewOneReserve($timeID, $seatID); ?>

                    <div class="col-lg-1">
                        <div>
                            <a href="#seat<?php echo $seatID ?>" data-toggle="modal">
                                <p style="background-color:<?php foreach ($oneReserve as $row) {
                                                                echo $row['color'];
                                                            } ?>;"><?php echo $row['seatrow'];
                                                                                                                            echo $row['seatnumber'] ?></p>
                            </a>
                        </div>
                    </div>
                <?php endforeach ?>
            </div>
            <div class="row">
                <div class="col-lg-12 text-right">
                    <a href="#addSeat" role="button" class="btn btn-outline-success" data-toggle="modal">+Seat</a>
                    <div class="modal fade" id="addSeat">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5>Add Seat</h5>
                                    <button type="button" class="close" data-dismiss="modal">
                                        <span>&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form action="action.php" method="post">
                                        <div class="form-group text-left">
                                            <input type="hidden" name="timeid" value="<?php echo $timeID ?>">
                                            <div class="row">
                                                <div class="col-lg-6">
                                                    <label for="">Seat Row:</label>
                                                    <input type="text" name="srow" class="form-control" required>
                                                </div>
                                                <div class="col-lg-6">
                                                    <label for="">Seat Number:</label>
                                                    <input type="number" name="snum" class="form-control" required>
                                                </div>
                                            </div>
                                            <button type="submit" name="addSeat" class="btn btn-danger btn-block mt-3">ADD</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="font-weight-bold mt-2">
                <span id="vacant" class="">A1</span>
                <span class="m-2">: Vacant</span>
                <span id="occupied" class="">A1</span>
                <span class="m-2">: Occupied</span>
            </div>
        </div>
        <?php foreach ($seat as $row) : ?>
            <div class="modal fade" id="seat<?php echo $row['seat_id'] ?>">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5>Reservation</h5>
                            <button type="button" class="close" data-dismiss="modal">
                                <span>&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <?php foreach ($oneTimeline as $row2) : ?>

                                <div class="row">
                                    <div class="col-lg-6">
                                        <p>Title: <?php echo $row2['moviename'] ?></p>
                                        <p>Theater: <?php echo $row2['theatername'] ?></p>
                                        <p>Hall: <?php echo $row2['hallname'] ?></p>
                                        <p>Seat: <?php echo $row['seatrow'];
                                                    echo $row['seatnumber'] ?></p>
                                    </div>
                                    <div class="col-lg-6">
                                        <p>Date: <?php echo $row2['date'] ?></p>
                                        <p>Starting Time: <?php echo $row2['startinghours'];
                                                            echo ':';
                                                            echo $row2['startingminutes'];
                                                            echo $row2['startingam_pm'] ?></p>
                                        <p>Ending Time: <?php echo $row2['endinghours'];
                                                        echo ':';
                                                        echo $row2['endingminutes'];
                                                        echo $row2['endingam_pm'] ?></p>
                                        <p>Price: <?php echo $row2['price'] ?>P</p>
                                    </div>
                                </div>
                            <?php endforeach ?>
                        </div>
                        <div class="modal-footer">
                            <a href="#editSeat<?php echo $row['seat_id'] ?>" class="text-warning mr-2" data-toggle="modal" data-dismiss="modal">Edit?</a>
                            <a href="#deleteSeat<?php echo $row['seat_id'] ?>" class="text-danger mr-3" data-toggle="modal" data-dismiss="modal">Delete?</a>
                            <form action="action.php" method="post">
                                <div class="form-group">
                                    <input type="hidden" name="time" value="<?php echo $timeID ?>">
                                    <input type="hidden" name="seat" value="<?php echo $row['seat_id'] ?>">
                                    <input type="hidden" name="loginid" value="<?php echo $loginID ?>">
                                    <button type="submit" name="reserveA" class="btn btn-info btn-block">Reserve</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach ?>
        <?php foreach ($seat as $row) : ?>
            <div class="modal fade" id="editSeat<?php echo $row['seat_id'] ?>">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5>Edit Seat</h5>
                            <button type="button" class="close" data-dismiss="modal">
                                <span>&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form action="action.php" method="post">
                                <div class="form-group text-left">
                                    <input type="hidden" name="timeid" value="<?php echo $timeID ?>">
                                    <input type="hidden" name="seatid" value="<?php echo $row['seat_id'] ?>">
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <label for="">Seat Row:</label>
                                            <input type="text" name="srow" value="<?php echo $row['seatrow'] ?>" class="form-control" required>
                                        </div>
                                        <div class="col-lg-6">
                                            <label for="">Seat Number:</label>
                                            <input type="number" name="snum" value="<?php echo $row['seatnumber'] ?>" class="form-control" required>
                                        </div>
                                    </div>
                                    <button type="submit" name="editSeat" class="btn btn-danger btn-block mt-3">UPDATE</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal fade" id="deleteSeat<?php echo $row['seat_id'] ?>">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5>Delete Seat</h5>
                            <button type="button" class="close" data-dismiss="modal">
                                <span>&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form action="action.php" method="post">
                                <div class="form-group text-center">
                                    <input type="hidden" name="timeid" value="<?php echo $timeID ?>">
                                    <input type="hidden" name="seatid" value="<?php echo $row['seat_id'] ?>">
                                    <label for="" class="font-weight-bold" style="font-size: 32px"><?php echo $row['seatrow']; echo $row['seatnumber']; ?></label>
                                    <br>
                                    <label for="">Are you sure to delete the seat  ?</label>
                                    <button type="submit" name="deleteSeat" class="btn btn-danger btn-block mt-3">DELETE</button>
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