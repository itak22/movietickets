<?php
include 'action.php';

$loginID = $_SESSION['login_id'];

$theater = $Movie->viewTheater();

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
            <li class="nav-item dropdown mt-2">
                <a class="nav-link dropdown-toggle text-light text-decoration-none ml-3" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">THEATER</a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                <?php foreach($theater as $row): ?>
                    <a class="dropdown-item" href="theater_staff.php?theater_id=<?php echo $row['theater_id'] ?>" style="font-size: 12px"><?php echo $row['theatername'] ?></a>
                <?php endforeach ?>
            </li>          
        </ul>
    </nav>
</header>
