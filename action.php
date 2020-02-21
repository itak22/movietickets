<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

<?php
include 'classes/Movie.php';

$Movie = new Movie;

if(isset($_POST['register'])){
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $email = $_POST['email'];
    $pword = md5($_POST['pword']);
    $pnum = $_POST['pnum'];

    $Movie->register($email,$pword,$fname,$lname,$pnum);

}elseif(isset($_POST['signin'])){
    $email = $_POST['email'];
    $pword = md5($_POST['pword']);

    $Movie->signin($email,$pword);
    
}elseif(isset($_POST['editPass'])){
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $email = $_POST['email'];
    $pnum = $_POST['pnum'];
    $pword1 = md5($_POST['pword1']);
    $pword2 = md5($_POST['pword2']);

    if($pword1 === $pword2){
        $Movie->editPass($fname,$lname,$pnum,$email,$pword1);
    }else{
        echo "<div class='card w-25 mt-5 mx-auto text-center font-weight-bold text-uppercase'><div class='card-header bg-danger'>⚠error</div><div class='card-body'><div class='alert alert-danger'>password no match</div></div><div class='card-footer bg-light'><a href='password.php' role='button' class='btn btn-secondary btn-block w-50 mx-auto'>try again</a></div></div>";
    }

}elseif(isset($_POST['post'])){
    $review = $_POST['review'];
    $rate = $_POST['rate'];
    $date = date('Ymd');
    $nickname = $_POST['nickname'];
    $loginID = $_POST['loginid'];
    $movieID = $_POST['movieid'];
      
    $Movie->addReview($review,$rate,$date,$nickname,$loginID,$movieID);

}elseif(isset($_POST['postA'])){
    $review = $_POST['review'];
    $rate = $_POST['rate'];
    $date = date('Ymd');
    $nickname = $_POST['nickname'];
    $loginID = $_POST['loginid'];
    $movieID = $_POST['movieid'];
      
    $Movie->addReviewA($review,$rate,$date,$nickname,$loginID,$movieID);

}elseif(isset($_POST['reserve'])){
    $date = date('Ymd');
    $time = $_POST['time'];
    $seat = $_POST['seat'];
    $loginID = $_POST['loginid'];
      
    $Movie->addReserve($date,$time,$seat,$loginID);

}elseif(isset($_POST['reserveA'])){
    $date = date('Ymd');
    $time = $_POST['time'];
    $seat = $_POST['seat'];
    $loginID = $_POST['loginid'];
      
    $Movie->addReserveA($date,$time,$seat,$loginID);

}elseif(isset($_POST['deleteReserve'])){
    $reserveID = $_POST['reserveid'];

    $Movie->deleteReserve($reserveID);

}elseif(isset($_POST['deleteReserveA'])){
    $reserveID = $_POST['reserveid'];

    $Movie->deleteReserveA($reserveID);

}elseif(isset($_POST['updateReview'])){
    $reviewID = $_POST['reviewid'];
    $movieID = $_POST['movieid'];
    $nickname = $_POST['nickname'];
    $rate = $_POST['rate'];
    $review = $_POST['review'];

    $Movie->updateReview($reviewID,$review,$rate,$nickname,$movieID);

}elseif(isset($_POST['deleteReview'])){
    $reviewID = $_POST['reviewid'];
    $movieID = $_POST['movieid'];

    $Movie->deleteReview($reviewID,$movieID);

}elseif(isset($_POST['updateReviewA'])){
    $reviewID = $_POST['reviewid'];
    $movieID = $_POST['movieid'];
    $nickname = $_POST['nickname'];
    $rate = $_POST['rate'];
    $review = $_POST['review'];

    $Movie->updateReviewA($reviewID,$review,$rate,$nickname,$movieID);

}elseif(isset($_POST['deleteReviewA'])){
    $reviewID = $_POST['reviewid'];
    $movieID = $_POST['movieid'];

    $Movie->deleteReviewA($reviewID,$movieID);

}elseif(isset($_POST['addMovie'])){
    $title = $_POST['title'];
    $mcategory = $_POST['mcategory'];
    $file = $_FILES['img']['name'];
    $trailer = $_POST['trailer'];
    $overview = $_POST['overview'];
    $hours = $_POST['hours'];
    $minutes = $_POST['minutes'];
    $rdate = $_POST['rdate'];
    $rrate = $_POST['rrate'];
    $cast = $_POST['cast'];
    $directors = $_POST['directors'];

    $Movie->addMovie($title,$mcategory,$file,$trailer,$overview,$hours,$minutes,$rdate,$rrate,$cast,$directors);

}elseif(isset($_POST['editMovie'])){
    $movieID = $_POST['movieid'];
    $title = $_POST['title'];
    $mcategory = $_POST['mcategory'];
    $file = $_FILES['img']['name'];
    $trailer = $_POST['trailer'];
    $overview = $_POST['overview'];
    $hours = $_POST['hours'];
    $minutes = $_POST['minutes'];
    $rdate = $_POST['rdate'];
    $rrate = $_POST['rrate'];
    $cast = $_POST['cast'];
    $directors = $_POST['directors'];

    $Movie->editMovie($movieID,$title,$mcategory,$file,$trailer,$overview,$hours,$minutes,$rdate,$rrate,$cast,$directors);

}elseif(isset($_POST['deleteMovie'])){
    $movieID = $_POST['movieid'];

    $Movie->deleteMovie($movieID);

}elseif(isset($_POST['addCategory'])){
    $mcategory = $_POST['mcategory'];

    $Movie->addCategory($mcategory);

}elseif(isset($_POST['editCategory'])){
    $mcategoryID = $_POST['mcategoryid'];
    $mcategory = $_POST['mcategory'];

    $Movie->editCategory($mcategoryID,$mcategory);

}elseif(isset($_POST['deleteCategory'])){
    $mcategoryID = $_POST['mcategoryid'];

    $Movie->deleteCategory($mcategoryID);

}elseif(isset($_POST['addTheater'])){
    $theater = $_POST['theater'];
    $location = $_POST['location'];

    $Movie->addTheater($theater,$location);

}elseif(isset($_POST['editTheater'])){
    $theaterID = $_POST['theaterid'];
    $theater = $_POST['theater'];
    $location = $_POST['location'];

    $Movie->editTheater($theaterID,$theater,$location);

}elseif(isset($_POST['deleteTheater'])){
    $theaterID = $_POST['theaterid'];

    $Movie->deleteTheater($theaterID);

}elseif(isset($_POST['addTime'])){
    $theaterid = $_POST['theaterid'];
    $shours = $_POST['shours'];
    $sminutes = $_POST['sminutes'];
    $sampm = $_POST['sampm'];
    $ehours = $_POST['ehours'];
    $eminutes = $_POST['eminutes'];
    $eampm = $_POST['eampm'];
    $movie = $_POST['movie'];
    $date = $_POST['date'];
    $hall = $_POST['hall'];
    $price = $_POST['price'];

    $Movie->addTime($shours,$sminutes,$sampm,$ehours,$eminutes,$eampm,$date,$movie,$theaterid,$hall,$price);

}elseif(isset($_POST['editTime'])){
    $theaterID = $_POST['theaterid'];
    $time = $_POST['time'];
    $shours = $_POST['shours'];
    $sminutes = $_POST['sminutes'];
    $sampm = $_POST['sampm'];
    $ehours = $_POST['ehours'];
    $eminutes = $_POST['eminutes'];
    $eampm = $_POST['eampm'];

    $Movie->editTime($time,$shours,$sminutes,$sampm,$ehours,$eminutes,$eampm,$theaterID);

}elseif(isset($_POST['deleteTime'])){
    $theaterID = $_POST['theaterid'];
    $time = $_POST['time'];

    $Movie->deleteTime($time,$theaterID);

}elseif(isset($_POST['addDate'])){
    $theaterID = $_POST['theaterid'];
    $date = $_POST['date'];

    $Movie->addDate($date,$theaterID);

}elseif(isset($_POST['editDate'])){
    $theaterID = $_POST['theaterid'];
    $odate = $_POST['odate'];
    $ndate = $_POST['ndate'];

    $Movie->editDate($odate,$ndate,$theaterID);

}elseif(isset($_POST['deleteDate'])){
    $theaterID = $_POST['theaterid'];
    $date = $_POST['date'];

    $Movie->deleteDate($date,$theaterID);

}elseif(isset($_POST['addHall'])){
    $theaterID = $_POST['theaterid'];
    $hall = $_POST['hall'];

    $Movie->addHall($hall,$theaterID);

}elseif(isset($_POST['editHall'])){
    $theaterID = $_POST['theaterid'];
    $ohall = $_POST['ohall'];
    $nhall = $_POST['nhall'];

    $Movie->editHall($odate,$ndate,$theaterID);

}elseif(isset($_POST['deleteHall'])){
    $theaterID = $_POST['theaterid'];
    $hall = $_POST['hall'];

    $Movie->deleteHall($date,$theaterID);

}elseif(isset($_POST['addPrice'])){
    $theaterID = $_POST['theaterid'];
    $price = $_POST['price'];

    $Movie->addPrice($price,$theaterID);

}elseif(isset($_POST['editPrice'])){
    $theaterID = $_POST['theaterid'];
    $oprice = $_POST['oprice'];
    $nprice = $_POST['nprice'];

    $Movie->editPrice($oprice,$nprice,$theaterID);

}elseif(isset($_POST['deletePrice'])){
    $theaterID = $_POST['theaterid'];
    $hall = $_POST['price'];

    $Movie->deletePrice($date,$theaterID);

}elseif(isset($_POST['addSeat'])){
    $timeID = $_POST['timeid'];
    $srow = $_POST['srow'];
    $snum = $_POST['snum'];

    $Movie->addSeat($srow,$snum,$timeID);

}elseif(isset($_POST['editSeat'])){
    $timeID = $_POST['timeid'];
    $seatID = $_POST['seatid'];
    $srow = $_POST['srow'];
    $snum = $_POST['snum'];

    $Movie->editSeat($seatID,$srow,$snum,$timeID);

}elseif(isset($_POST['deleteSeat'])){
    $timeID = $_POST['timeid'];
    $seatID = $_POST['seatid'];

    $Movie->deleteSeat($seatID,$timeID);

}elseif(isset($_POST['addTime2'])){
    $movieID = $_POST['movieid'];
    $theaterid = $_POST['theaterid'];
    $shours = $_POST['shours'];
    $sminutes = $_POST['sminutes'];
    $sampm = $_POST['sampm'];
    $ehours = $_POST['ehours'];
    $eminutes = $_POST['eminutes'];
    $eampm = $_POST['eampm'];
    $date = $_POST['date'];
    $hall = $_POST['hall'];
    $price = $_POST['price'];

    $Movie->addTime2($shours,$sminutes,$sampm,$ehours,$eminutes,$eampm,$date,$movieID,$theaterid,$hall,$price);

}elseif(isset($_POST['editTime2'])){
    $movieID = $_POST['movieid'];
    $timeID = $_POST['timeid'];
    $shours = $_POST['shours'];
    $sminutes = $_POST['sminutes'];
    $sampm = $_POST['sampm'];
    $ehours = $_POST['ehours'];
    $eminutes = $_POST['eminutes'];
    $eampm = $_POST['eampm'];

    $Movie->editTime2($timeID,$shours,$sminutes,$sampm,$ehours,$eminutes,$eampm,$movieID);

}elseif(isset($_POST['deleteTime2'])){
    $movieID = $_POST['movieid'];
    $timeID = $_POST['timeid'];

    $Movie->deleteTime2($timeID,$movieID);

}

?>