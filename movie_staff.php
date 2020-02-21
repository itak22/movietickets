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
    include 'menu_staff.php';

    if ($userAccess['status'] == 'U') {
        echo "<script>window.location.href='main_customer.php'</script>";
    }

    $movie = $Movie->viewMovie();

    ?>
    <div class="container-fluid mb-3">
        <?php foreach ($mcategory as $row) :

            $categoryID = $row['moviecategory_id'];

            $latestMovie = $Movie->viewLatestMovie($categoryID);
            $otherMovie = $Movie->viewOtherMovie($categoryID); ?>

            <p class="lead font-weight-bold mt-3 float-left"><?php echo $row['moviecategory'] ?></p>
            <a href="#editCategory<?php echo $row['moviecategory_id'] ?>" role="button" class="btn btn-outline-warning ml-3 mt-3" data-toggle="modal">Edit</a>
            <a href="#deleteCategory<?php echo $row['moviecategory_id'] ?>" role="button" class="btn btn-outline-danger mt-3" data-toggle="modal">Delete</a>
            <div class="modal fade" id="editCategory<?php echo $row['moviecategory_id'] ?>">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5>Edit the Category</h5>
                            <button type="button" class="close" data-dismiss="modal">
                                <span>&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form action="action.php" method="post" enctype="multipart/form-data">
                                <div class="form-group">
                                    <input type="hidden" name="mcategoryid" value="<?php echo $row['moviecategory_id'] ?>">
                                    <input type="text" name="mcategory" value="<?php echo $row['moviecategory'] ?>" class="form-control" required>
                                    <button type="submit" name="editCategory" class="btn btn-danger btn-block mt-3 w-50 mx-auto">UPDATE</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal fade" id="deleteCategory<?php echo $row['moviecategory_id'] ?>">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5>Delete the Category</h5>
                            <button type="button" class="close" data-dismiss="modal">
                                <span>&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <p class="text-center">Are you sure to delete the category?</p>
                        </div>
                        <div class="modal-footer">
                            <form action="action.php" method="post">
                                <div class="form-group">
                                    <input type="hidden" name="mcategoryid" value="<?php echo $row['moviecategory_id'] ?>">
                                    <button type="submit" name="deleteCategory" class="btn btn-warning mt-3">Yes</button>
                                </div>
                            </form>
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                        </div>
                    </div>
                </div>
            </div>
            <div id="carouselExampleInterval<?php echo $row['moviecategory_id'] ?>" class="carousel slide" data-ride="carousel" data-interval="false">
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <div class="row">
                            <?php foreach ($latestMovie as $row) : ?>
                                <div class="col-lg-3">
                                    <a href="movieDetail_staff.php?movie_id=<?php echo $row['movie_id'] ?>"><img src="uploads/<?php echo $row['image'] ?>" alt=""></a>
                                    <p><?php echo $row['moviename'] ?></p>
                                    <p><?php echo $row['runninghours'] ?>h <?php echo $row['runningminutes'] ?>m | <?php echo $row['releasedate'] ?></p>
                                    <a href="#editMovie<?php echo $row['movie_id'] ?>" role="button" class="btn btn-outline-warning" data-toggle="modal" style="font-size: 14px">Edit</a>
                                    <a href="#deleteMovie<?php echo $row['movie_id'] ?>" role="button" class="btn btn-outline-danger" data-toggle="modal" style="font-size: 14px">Delete</a>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                    <div class="carousel-item">
                        <div class="row">
                            <?php foreach ($otherMovie as $row) : ?>
                                <div class="col-lg-3">
                                    <a href="movieDetail_staff.php?movie_id=<?php echo $row['movie_id'] ?>"><img src="uploads/<?php echo $row['image'] ?>" alt=""></a>
                                    <p><?php echo $row['moviename'] ?></p>
                                    <p><?php echo $row['runninghours'] ?>h <?php echo $row['runningminutes'] ?>m | <?php echo $row['releasedate'] ?></p>
                                    <a href="#editMovie<?php echo $row['movie_id'] ?>" role="button" class="btn btn-outline-warning" data-toggle="modal" style="font-size: 14px">Edit</a>
                                    <a href="#deleteMovie<?php echo $row['movie_id'] ?>" role="button" class="btn btn-outline-danger" data-toggle="modal" style="font-size: 14px">Delete</a>
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
        <?php foreach ($movie as $row) : ?>
            <div class="modal fade" id="editMovie<?php echo $row['movie_id'] ?>">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5>Edit the Movie</h5>
                            <button type="button" class="close" data-dismiss="modal">
                                <span>&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form action="action.php" method="post" enctype="multipart/form-data">
                                <div class="form-group">
                                    <input type="hidden" name="movieid" value="<?php echo $row['movie_id'] ?>">
                                    <label for="">Movie Title:</label>
                                    <input type="text" name="title" value="<?php echo $row['moviename'] ?>" class="form-control" required>
                                    <label for="" class="mt-2">Category:</label>
                                    <select name="mcategory" id="" class="form-control" required>
                                        <option value="<?php echo $row['moviecategory_id'] ?>" selected disabled><?php echo $row['moviecategory'] ?></option>
                                        <?php foreach ($mcategory as $row2): ?>
                                            <option value="<?php echo $row2['moviecategory_id'] ?>"><?php echo $row2['moviecategory'] ?></option>
                                        <?php endforeach ?>
                                    </select>
                                    <label for="" class="mt-2 float-right text-secondary">Previous upload: <b><?php echo $row['image'] ?></b></label>
                                    <label for="" class="mt-2">Image:</label>
                                    <input type="file" name="img" class="form-control" required>
                                    <label for="" class="mt-2">Trailer:</label>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">https://www.youtube.com/watch?v=</span>
                                        </div>
                                        <input type="text" name="trailer" value="<?php echo $row['trailer'] ?>" class="form-control" required>
                                    </div>
                                    <label for="">Overview:</label>
                                    <textarea name="overview" cols='30' rows='10' class="form-control" required><?php echo $row['overview'] ?></textarea>
                                    <label for="" class="mt-2">Running Time:</label>
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="input-group mb-3">
                                                <input type="number" name="hours" value="<?php echo $row['runninghours'] ?>" class="form-control" required>
                                                <div class="input-group-append">
                                                    <span class="input-group-text">h</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="input-group mb-3">
                                                <input type="number" name="minutes" class="form-control" value="<?php echo $row['runningminutes'] ?>" required>
                                                <div class="input-group-append">
                                                    <span class="input-group-text">min</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <label for="">Release Date:</label>
                                    <input type="date" name="rdate" class="form-control" value="<?php echo $row['releasedate'] ?>" required>
                                    <label for="" class="mt-2">Rated-R:</label>
                                    <input type="text" name="rrate" value="<?php echo $row['rated_r'] ?>" class="form-control" required>
                                    <label for="" class="mt-2">Cast:</label>
                                    <input type="text" name="cast" value="<?php echo $row['cast'] ?>" class="form-control" required>
                                    <label for="" class="mt-2">Directors:</label>
                                    <input type="text" name="directors" value="<?php echo $row['directors'] ?>" class="form-control" required>
                                    <button type="submit" name="editMovie" class="btn btn-danger btn-block mt-3">UPDATE</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
        <?php foreach ($movie as $row) : ?>
            <div class="modal fade" id="deleteMovie<?php echo $row['movie_id'] ?>">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5>Delete the Movie</h5>
                            <button type="button" class="close" data-dismiss="modal">
                                <span>&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <p class="text-center">Are you sure to delete the movie?</p>
                        </div>
                        <div class="modal-footer">
                            <form action="action.php" method="post">
                                <div class="form-group">
                                    <input type="hidden" name="movieid" value="<?php echo $row['movie_id'] ?>">
                                    <button type="submit" name="deleteMovie" class="btn btn-warning mt-3">Yes</button>
                                </div>
                            </form>
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
        <a href="#addCategory" data-toggle="modal" role="button" class="btn btn-outline-success ml-2">+Category</a>
        <div class="modal fade" id="addCategory">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5>Add a Catagory</h5>
                        <button type="button" class="close" data-dismiss="modal">
                            <span>&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="action.php" method="post" enctype="multipart/form-data">
                            <div class="form-group">
                                <input type="text" name="mcategory" placeholder="Category Name" class="form-control" required>
                                <button type="submit" name="addCategory" class="btn btn-danger btn-block mt-3 w-50 mx-auto">ADD</button>
                            </div>
                        </form>
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