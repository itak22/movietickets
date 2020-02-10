<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

<?php
include 'classes/Functions.php';

$Movie = new Functions;

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

}elseif(isset($_POST['reserve'])){
    $cdate = $_POST['cdate'];
    $movie3 = $_POST['movie3'];
    $cinema3 = $_POST['cinema3'];
    $date3 = $_POST['date3'];
    $time2 = $_POST['time2'];
      
    $Movie->addReserve($cdate,$date3,$movie3,$cinema3,$time2);

}elseif(isset($_POST['purchase'])){
    $cdate = $_POST['cdate'];
    $movie3 = $_POST['movie3'];
    $cinema3 = $_POST['cinema3'];
    $date3 = $_POST['date3'];
    $time2 = $_POST['time2'];
      
    $Movie->addPurchase($cdate,$date3,$movie3,$cinema3,$time2);

}elseif(isset($_POST['post'])){
    $review = $_POST['review'];
    $rate = $_POST['rate'];
    $date = date('Ymd');
    $nickname = $_POST['nickname'];
    $loginID = $_POST['loginid'];
    $movieID = $_POST['movieid'];
      
    $Movie->addReview($review,$rate,$date,$nickname,$loginID,$movieID);

}


?>