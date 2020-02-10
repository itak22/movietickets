<?php
include 'action.php';

$loginID = $_SESSION['login_id'];

$row = $Movie->getOneCustomer($loginID);

?>
<header id="home" class="bg-dark text-light">
    <nav class="navbar navbar-expand float-right">
        <ul class="nav navbar-nav">
            <li class="nav-item mt-3 mr-2"><a href="" class="text-light text-decoration-none"><?php echo $row['firstname'] ?>'s Page (Only for Staff)</a></li>
            <li class="nav-item"><a href="signout.php" role="button" class="btn btn-outline-light ml-2 mt-2">SIGN OUT</a></li>
        </ul>
    </nav>
    <nav class="navbar navbar-expand">
        <ul class="nav navbar-nav">
            <li><a href="main_customer.php" class="text-light text-decoration-none"><span>T</span>ak<span>T</span>ickets <div>.com</div></h1></li>
            <li class="nav-item mt-3"><a href="movie.php" class="text-light text-decoration-none ml-5">MOVIE</a></li>
            <li class="nav-item mt-3"><a href="cinema.php" class="text-light text-decoration-none ml-3">CINEMA</a></li>
        </ul>
    </nav>
</header>