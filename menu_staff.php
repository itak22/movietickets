<?php
include 'action.php';

$loginID = $_SESSION['login_id'];
$userAccess = $Movie->getOneUser($loginID);

$theater = $Movie->viewTheater();
$mcategory = $Movie->viewMovieCategory();

$movie = $Movie->viewMovie();
$allDate = $Movie->viewAllDate();
$allHall = $Movie->viewAllHall();
$allPrice = $Movie->viewAllPrice();


?>
<header id="home" class="bg-dark text-light">
    <nav class="navbar navbar-expand float-right">
        <ul class="nav navbar-nav">
            <li class="nav-item">
                <a href="staff.php" role="button" class="btn btn-outline-light ml-2 mt-2" style="font-size: 12px">MY PAGE</a>
            </li>
            <li class="nav-item">
                <a href="signout.php" role="button" class="btn btn-outline-light ml-2 mt-2" style="font-size: 12px">SIGN OUT</a>
            </li>
        </ul>
    </nav>
    <nav class="navbar navbar-expand">
        <ul class="nav navbar-nav">
            <li class="nav-item">
                <a href="main_staff.php" class="text-light text-decoration-none"><span>T</span>ak<span>T</span>ickets <div>.com</div></a>
            </li>
            <li class="nav-item mt-3">
                <a href="movie_staff.php" class="text-light text-decoration-none ml-5">MOVIE</a>
            </li>
            <li class="nav-item">
                <a href="#addMovie" data-toggle="modal" role="button" class="btn btn-outline-info ml-3 mt-2" style="font-size: 12px">+Movie</a>
            </li>
            <li class="nav-item dropdown mt-2">
                <a class="nav-link dropdown-toggle text-light text-decoration-none ml-3" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">THEATER</a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <?php foreach ($theater as $row) : ?>
                        <a class="dropdown-item bg-light" href="theater_staff.php?theater_id=<?php echo $row['theater_id'] ?>" style="font-size: 12px"><?php echo $row['theatername'] ?></a>
                        <a href="#editTheater<?php echo $row['theater_id'] ?>" role="button" class="btn btn-warning ml-4 my-1" data-toggle="modal" style="font-size: 10px">Edit</a>
                        <a href="#deleteTheater<?php echo $row['theater_id'] ?>" role="button" class="btn btn-danger my-1" data-toggle="modal" style="font-size: 10px">Delete</a>
                    <?php endforeach ?>
            </li>
            <li class="nav-item">
                <a href="#addTheater" data-toggle="modal" role="button" class="btn btn-outline-info ml-2 mt-2" style="font-size: 12px">+Theater</a>
            </li>
        </ul>
    </nav>
</header>
<div class="modal fade" id="addMovie">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5>Add a Movie</h5>
                <button type="button" class="close" data-dismiss="modal">
                    <span>&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="action.php" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="">Movie Title:</label>
                        <input type="text" name="title" class="form-control" required>
                        <label for="" class="mt-2">Category:</label>
                        <select name="mcategory" id="" class="form-control" required>
                            <?php foreach ($mcategory as $row) : ?>
                                <option value="<?php echo $row['moviecategory_id'] ?>"><?php echo $row['moviecategory'] ?></option>
                            <?php endforeach ?>
                        </select>
                        <label for="" class="mt-2">Image:</label>
                        <input type="file" name="img" class="form-control" required>
                        <label for="" class="mt-2">Trailer:</label>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text">https://www.youtube.com/watch?v=</span>
                            </div>
                            <input type="text" name="trailer" class="form-control" required>
                        </div>
                        <label for="">Overview:</label>
                        <textarea name="overview" cols='30' rows='10' class="form-control" required></textarea>
                        <label for="" class="mt-2">Running Time:</label>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="input-group mb-3">
                                    <input type="number" name="hours" class="form-control" required>
                                    <div class="input-group-append">
                                        <span class="input-group-text">h</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="input-group mb-3">
                                    <input type="number" name="minutes" class="form-control" required>
                                    <div class="input-group-append">
                                        <span class="input-group-text">min</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <label for="">Release Date:</label>
                        <input type="date" name="rdate" class="form-control" required>
                        <label for="" class="mt-2">Rated-R:</label>
                        <input type="text" name="rrate" class="form-control" required>
                        <label for="" class="mt-2">Cast:</label>
                        <input type="text" name="cast" class="form-control" required>
                        <label for="" class="mt-2">Directors:</label>
                        <input type="text" name="directors" class="form-control" required>
                        <button type="submit" name="addMovie" class="btn btn-danger btn-block mt-3">ADD</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="addTheater">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5>Add a Theater</h5>
                <button type="button" class="close" data-dismiss="modal">
                    <span>&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="action.php" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <input type="text" name="theater" placeholder="Theater Name" class="form-control" required>
                        <input type="text" name="location" placeholder="Location" class="form-control mt-2" required>
                        <button type="submit" name="addTheater" class="btn btn-danger btn-block mt-3">ADD</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?php foreach ($theater as $row) : ?>
    <div class="modal fade" id="editTheater<?php echo $row['theater_id'] ?>">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5>Edit the Theater</h5>
                    <button type="button" class="close" data-dismiss="modal">
                        <span>&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="action.php" method="post" enctype="multipart/form-data">
                        <div class="form-group">
                            <input type="hidden" name="theaterid" value="<?php echo $row['theater_id'] ?>" class="form-control">
                            <input type="text" name="theater" value="<?php echo $row['theatername'] ?>" class="form-control" required>
                            <input type="text" name="location" value="<?php echo $row['location'] ?>" class="form-control mt-2" required>
                            <button type="submit" name="editTheater" class="btn btn-danger btn-block mt-3 w-50 mx-auto">UPDATE</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="deleteTheater<?php echo $row['theater_id'] ?>">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5>Delete the Theater</h5>
                    <button type="button" class="close" data-dismiss="modal">
                        <span>&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p class="text-center">Are you sure to delete the theater?</p>
                </div>
                <div class="modal-footer">
                    <form action="action.php" method="post">
                        <div class="form-group">
                            <input type="hidden" name="theaterid" value="<?php echo $row['theater_id'] ?>">
                            <button type="submit" name="deleteTheater" class="btn btn-warning mt-3">Yes</button>
                        </div>
                    </form>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                </div>
            </div>
        </div>
    </div>
<?php endforeach ?>
<?php foreach ($theater as $row): ?>
<div class="modal fade" id="addTime<?php echo $row['theater_id'] ?>">
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
                        <input type="hidden" name="theaterid" value="<?php echo $row['theater_id'] ?>">
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
                        <label for="">Movie:</label>
                        <select name="movie" id="" class="form-control" required>
                            <?php foreach($movie as $row): ?>
                                <option value="<?php echo $row['movie_id'] ?>"><?php echo $row['moviename'] ?></option>
                            <?php endforeach ?>
                        </select>
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
                                <option value="<?php echo $row['price_id'] ?>"><?php echo $row['price'] ?>P</option>
                            <?php endforeach ?>
                        </select>
                        <button type="submit" name="addTime" class="btn btn-danger btn-block mt-3">ADD</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?php endforeach ?>
<?php foreach ($theater as $row): ?>
<div class="modal fade" id="addDate<?php echo $row['theater_id'] ?>">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5>Add Date</h5>
                <button type="button" class="close" data-dismiss="modal">
                    <span>&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="action.php" method="post">
                    <div class="form-group">
                        <input type="hidden" name="theaterid" value="<?php echo $row['theater_id'] ?>">
                        <input type="date" name="date" class="form-control" required>     
                        <button type="submit" name="addDate" class="btn btn-danger btn-block mt-3">ADD</button>
                    </div>
                </form>
                <div class="float-right">
                    <a href="#editDate<?php echo $row['theater_id'] ?>" class="text-warning" data-toggle="modal" data-dismiss="modal">Edit?</a>
                    <a href="#deleteDate<?php echo $row['theater_id'] ?>" class="text-danger ml-2" data-toggle="modal" data-dismiss="modal">Delete?</a>
                </div> 
            </div>
        </div>
    </div>
</div>
<?php endforeach ?>
<?php foreach ($theater as $row): ?>
<div class="modal fade" id="editDate<?php echo $row['theater_id'] ?>">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5>Edit Date</h5>
                <button type="button" class="close" data-dismiss="modal">
                    <span>&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="action.php" method="post">
                    <div class="form-group">
                        <input type="hidden" name="theaterid" value="<?php echo $row['theater_id'] ?>">
                        <label for="">Old Date:</label>
                        <select name="odate" id="" class="form-control">
                            <?php foreach ($allDate as $row): ?>
                                <option value="<?php echo $row['date_id'] ?>"><?php echo $row['date'] ?></option>
                            <?php endforeach ?>
                        </select>
                        <label for="" class="mt-2">New Date:</label>
                        <input type="date" name="ndate" class="form-control" required>
                        <button type="submit" name="editDate" class="btn btn-danger btn-block mt-3">UPDATE</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?php endforeach ?>
<?php foreach ($theater as $row): ?>
<div class="modal fade" id="deleteDate<?php echo $row['theater_id'] ?>">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5>Delete Date</h5>
                <button type="button" class="close" data-dismiss="modal">
                    <span>&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="action.php" method="post">
                    <div class="form-group text-center">
                        <input type="hidden" name="theaterid" value="<?php echo $row['theater_id'] ?>">
                        <select name="date" id="" class="form-control">
                            <option value="" selected disabled>choose the date</option> 
                            <?php foreach ($allDate as $row): ?>
                                <option value="<?php echo $row['date_id'] ?>"><?php echo $row['date'] ?></option>
                            <?php endforeach ?>
                        </select>
                        <label for="" class="mt-4">Are you sure to delete the date?</label>
                        <button type="submit" name="deleteDate" class="btn btn-danger btn-block mt-3">DELETE</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?php endforeach ?>
<?php foreach ($theater as $row): ?>
<div class="modal fade" id="addHall<?php echo $row['theater_id'] ?>">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5>Add Hall</h5>
                <button type="button" class="close" data-dismiss="modal">
                    <span>&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="action.php" method="post">
                    <div class="form-group">
                        <input type="hidden" name="theaterid" value="<?php echo $row['theater_id'] ?>">
                        <input type="text" name="hall" placeholder="Hall Name" class="form-control" required>
                        <button type="submit" name="addHall" class="btn btn-danger btn-block mt-3">ADD</button>
                    </div>
                </form>
                <div class="float-right">
                    <a href="#editHall<?php echo $row['theater_id'] ?>" class="text-warning" data-toggle="modal" data-dismiss="modal">Edit?</a>
                    <a href="#deleteHall<?php echo $row['theater_id'] ?>" class="text-danger ml-2" data-toggle="modal" data-dismiss="modal">Delete?</a>
                </div>
            </div>
        </div>
    </div>
</div>
<?php endforeach ?>
<?php foreach ($theater as $row): ?>
<div class="modal fade" id="editHall<?php echo $row['theater_id'] ?>">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5>Edit Hall</h5>
                <button type="button" class="close" data-dismiss="modal">
                    <span>&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="action.php" method="post">
                    <div class="form-group">
                        <input type="hidden" name="theaterid" value="<?php echo $row['theater_id'] ?>">
                        <label for="">Old Hall:</label>
                        <select name="ohall" id="" class="form-control">
                            <?php foreach ($allHall as $row): ?>
                                <option value="<?php echo $row['hall_id'] ?>"><?php echo $row['hallname'] ?></option>
                            <?php endforeach ?>
                        </select>
                        <label for="" class="mt-2">New Hall:</label>
                        <input type="text" name="nhall" class="form-control" required>
                        <button type="submit" name="editHall" class="btn btn-danger btn-block mt-3">UPDATE</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?php endforeach ?>
<?php foreach ($theater as $row): ?>
<div class="modal fade" id="deleteHall<?php echo $row['theater_id'] ?>">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5>Delete Hall</h5>
                <button type="button" class="close" data-dismiss="modal">
                    <span>&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="action.php" method="post">
                    <div class="form-group text-center">
                        <input type="hidden" name="theaterid" value="<?php echo $row['theater_id'] ?>">
                        <select name="date" id="" class="form-control">
                            <option value="" selected disabled>choose the hall</option> 
                            <?php foreach ($allDate as $row): ?>
                                <option value="<?php echo $row['date_id'] ?>"><?php echo $row['date'] ?></option>
                            <?php endforeach ?>
                        </select>
                        <label for="" class="mt-4">Are you sure to delete the date?</label>
                        <button type="submit" name="deleteHall" class="btn btn-danger btn-block mt-3">DELETE</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?php endforeach ?>
<?php foreach ($theater as $row): ?>
<div class="modal fade" id="addPrice<?php echo $row['theater_id'] ?>">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5>Add Price</h5>
                <button type="button" class="close" data-dismiss="modal">
                    <span>&times;</span>
                </button>
            </div>
            <div class="modal-body w-50 mx-auto">
                <form action="action.php" method="post">
                    <div class="form-group">
                        <input type="hidden" name="theaterid" value="<?php echo $row['theater_id'] ?>">
                        <label for="">Price:</label>
                        <div class="input-group">
                            <input type="number" name="price" class="form-control" required>
                            <div class="input-group-append">
                                <span class="input-group-text" id="basic-addon2">P</span>
                            </div>
                        </div>
                        <button type="submit" name="addPrice" class="btn btn-danger btn-block mt-3">ADD</button>
                    </div>
                </form>
                <div class="float-right">
                    <a href="#editPrice<?php echo $row['theater_id'] ?>" class="text-warning" data-toggle="modal" data-dismiss="modal">Edit?</a>
                    <a href="#deletePrice<?php echo $row['theater_id'] ?>" class="text-danger ml-2" data-toggle="modal" data-dismiss="modal">Delete?</a>
                </div>
            </div>
        </div>
    </div>
</div>
<?php endforeach ?>
<?php foreach ($theater as $row): ?>
<div class="modal fade" id="editPrice<?php echo $row['theater_id'] ?>">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5>Edit Price</h5>
                <button type="button" class="close" data-dismiss="modal">
                    <span>&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="action.php" method="post">
                    <div class="form-group">
                        <input type="hidden" name="theaterid" value="<?php echo $row['theater_id'] ?>">
                        <label for="">Old Price:</label>
                        <select name="oprice" id="" class="form-control">
                            <?php foreach ($allPrice as $row): ?>
                                <option value="<?php echo $row['price_id'] ?>"><?php echo $row['price'] ?></option>
                            <?php endforeach ?>
                        </select>
                        <label for="" class="mt-2">New Price:</label>
                        <input type="number" name="nprice" class="form-control" required>
                        <button type="submit" name="editPrice" class="btn btn-danger btn-block mt-3">UPDATE</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?php endforeach ?>
<?php foreach ($theater as $row): ?>
<div class="modal fade" id="deletePrice<?php echo $row['theater_id'] ?>">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5>Delete Price</h5>
                <button type="button" class="close" data-dismiss="modal">
                    <span>&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="action.php" method="post">
                    <div class="form-group text-center">
                        <input type="hidden" name="theaterid" value="<?php echo $row['theater_id'] ?>">
                        <select name="date" id="" class="form-control">
                            <option value="" selected disabled>choose the price</option> 
                            <?php foreach ($allPrice as $row): ?>
                                <option value="<?php echo $row['price_id'] ?>"><?php echo $row['price'] ?></option>
                            <?php endforeach ?>
                        </select>
                        <label for="" class="mt-4">Are you sure to delete the date?</label>
                        <button type="submit" name="deletePrice" class="btn btn-danger btn-block mt-3">DELETE</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?php endforeach ?>
