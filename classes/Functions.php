<?php
include 'Connection.php';

class Functions extends Connection{
    public function register($email,$password,$firstname,$lastname,$phonenumber){
        $sql1 = "SELECT * FROM login_tbl INNER JOIN user_tbl ON login_tbl.login_id=user_tbl.login_id WHERE login_tbl.email='$email' OR user_tbl.phonenumber='$phonenumber'";
        $result1 = $this->conn->query($sql1);
        
        if($result1->num_rows == 0){
            $sql2 = "INSERT INTO login_tbl(email,password)VALUES('$email','$password')";
            $result2 = $this->conn->query($sql2);

            if($result2 == TRUE){
                $login_id = $this->conn->insert_id;
                $sql3 = "INSERT INTO user_tbl(firstname,lastname,phonenumber,login_id)VALUES('$firstname','$lastname','$phonenumber','$login_id')";
                $result3 = $this->conn->query($sql3);
                
                if($result3 == FALSE){
                    die('adding user table failed '.$this->conn->error);
                }else{
                    header('location:signin.php');
                }   
            }else{
                die('adding login table failed '.$this->conn->error);
            }
        }else{
            die("<div class='card w-25 mt-5 mx-auto text-center font-weight-bold text-uppercase'><div class='card-header bg-danger'>⚠error</div><div class='card-body'><div class='alert alert-danger'>this account already exists</div></div><div class='card-footer bg-light'><a href='register.php' role='button' class='btn btn-secondary btn-block w-50 mx-auto'>try again</a></div></div>".$this->conn->error);
        }
    }
    public function signin($email,$password){
        $sql = "SELECT * FROM login_tbl INNER JOIN user_tbl ON login_tbl.login_id=user_tbl.login_id WHERE login_tbl.email='$email' AND login_tbl.password='$password'";
        $result = $this->conn->query($sql);

        if($result->num_rows == 1){
            $row = $result->fetch_assoc();
            $_SESSION['login_id'] = $row['login_id'];

            if($row['status'] == 'U'){
                header('location:main_customer.php');
            }else{
                header('location:main_staff.php');
            }
        }else{
            die("<div class='card w-25 mt-5 mx-auto text-center font-weight-bold text-uppercase'><div class='card-header bg-danger'>⚠error</div><div class='card-body'><div class='alert alert-danger'>wrong username and password</div></div><div class='card-footer bg-light'><a href='signin.php' role='button' class='btn btn-secondary btn-block w-50 mx-auto'>try again</a></div></div>".$this->conn->error);
        }
    }

    //changing password
    public function EditPass($firstname,$lastname,$phonenumber,$email,$password){
        $sql = "SELECT * FROM login_tbl INNER JOIN user_tbl ON login_tbl.login_id=user_tbl.login_id WHERE user_tbl.firstname='$firstname' AND user_tbl.lastname='$lastname' AND user_tbl.phonenumber='$phonenumber' AND login_tbl.email='$email'";
        $result = $this->conn->query($sql);

        if($result->num_rows == 1){
            $row = $result->fetch_assoc();
            $login_id = $row['login_id'];

            $sql2 = "UPDATE login_tbl SET password='$password' WHERE login_id='$login_id'";
            $result2 = $this->conn->query($sql2);

            if($result2 == FALSE){
                die('updating password error '.$this->conn->error);
            }else{
                header('location:signin.php');
            }
        }else{
            die("<div class='card w-25 mt-5 mx-auto text-center font-weight-bold text-uppercase'><div class='card-header bg-danger'>⚠error</div><div class='card-body'><div class='alert alert-danger'>cannot find you</div></div><div class='card-footer bg-light'><a href='password.php' role='button' class='btn btn-secondary btn-block w-50 mx-auto'>try again</a></div></div>".$this->conn->error);
        }
        
    }
    public function getOneCustomer($login_id){
        $sql = "SELECT * FROM user_tbl WHERE login_id='$login_id'";
        $result = $this->conn->query($sql);

        if($result == FALSE){
            die('cannot get one customer'.$this->conn->error);
        }else{
            return $result->fetch_assoc();
        }
    }
    public function viewMovie(){
        $sql = "SELECT * FROM movie_tbl";
        $result = $this->conn->query($sql);

        if($result->num_rows >= 0){
            $row = array();
            while($rows = $result->fetch_assoc()){
                $row[] = $rows;
            }
            return $row;
        }else{
            return FALSE;
        }
    }
    public function viewCinema(){
        $sql = "SELECT * FROM cinema_tbl";
        $result = $this->conn->query($sql);

        if($result->num_rows >= 0){
            $row = array();
            while($rows = $result->fetch_assoc()){
                $row[] = $rows;
            }
            return $row;
        }else{
            return FALSE;
        }
    }
    public function viewSearch($movie_id,$cinema_id){
        $sql = "SELECT * FROM time_tbl INNER JOIN movie_tbl ON time_tbl.movie_id=movie_tbl.movie_id INNER JOIN cinema_tbl ON time_tbl.cinema_id=cinema_tbl.cinema_id WHERE movie_tbl.movie_id='$movie_id' AND cinema_tbl.cinema_id='$cinema_id'";
        $result = $this->conn->query($sql);

        if($result->num_rows >= 0){
            $row = array();
            while($rows = $result->fetch_assoc()){
                $row[] = $rows;
            }
            return $row;
        }else{
            return FALSE;
        }
    }
    public function viewSearch2($movie_id,$cinema_id,$date_id,$time_id){
        $sql = "SELECT * FROM time_tbl INNER JOIN movie_tbl ON time_tbl.movie_id=movie_tbl.movie_id INNER JOIN cinema_tbl ON time_tbl.cinema_id=cinema_tbl.cinema_id INNER JOIN date_tbl ON time_tbl.date_id=date_tbl.date_id WHERE movie_tbl.movie_id='$movie_id' AND cinema_tbl.cinema_id='$cinema_id' AND date_tbl.date_id='$date_id' AND time_tbl.time_id='$time_id'";
        $result = $this->conn->query($sql);

        if($result->num_rows >= 0){
            $row = array();
            while($rows = $result->fetch_assoc()){
                $row[] = $rows;
            }
            return $row;
        }else{
            return FALSE;
        }
    }

    // adding reservation data
    public function addReserve($reservedate,$date_id,$movie_id,$cinema_id,$time_id){
        $sql = "INSERT INTO reserve_tbl(reservedate,date_id,movie_id,cinema_id,time_id)VALUES($reservedate,$date_id,$movie_id,$cinema_id,$time_id)";
        $result = $this->conn->query($sql);

        if($result == FALSE){
            die('reservation failed '.$this->conn->error);
        }else{
            header('location:customer.php');
        }
    }

    //adding purchase data
    public function addPurchase($reservedate,$date_id,$movie_id,$cinema_id,$time_id){
        $sql = "INSERT INTO reserve_tbl(reservedate,date_id,movie_id,cinema_id,time_id)VALUES($reservedate,$date_id,$movie_id,$cinema_id,$time_id)";
        $result = $this->conn->query($sql);

        if($result == FALSE){
            die('reservation failed '.$this->conn->error);
        }else{
            header('location:purchase.php');
        }
    }

    // displaying reserveation data
    public function viewReserve(){
        $sql = "SELECT * FROM reserve_tbl INNER JOIN date_tbl ON reserve_tbl.date_id=date_tbl.date_id INNER JOIN movie_tbl ON reserve_tbl.movie_id=movie_tbl.movie_id INNER JOIN cinema_tbl ON reserve_tbl.cinema_id=cinema_tbl.cinema_id INNER JOIN time_tbl ON reserve_tbl.time_id=time_tbl.time_id WHERE movie_tbl.moviecategory_id='1' ORDER BY reserve_tbl.reserve_id DESC";
        $result = $this->conn->query($sql);

        if($result->num_rows >= 0){
            $row = array();
            while($rows = $result->fetch_assoc()){
                $row[] = $rows;
            }
            return $row;
        }else{
            return FALSE;
        }
    }

    // displaying purchcase data
    public function viewPurchase(){
        $sql = "SELECT * FROM reserve_tbl INNER JOIN date_tbl ON reserve_tbl.date_id=date_tbl.date_id INNER JOIN movie_tbl ON reserve_tbl.movie_id=movie_tbl.movie_id INNER JOIN cinema_tbl ON reserve_tbl.cinema_id=cinema_tbl.cinema_id INNER JOIN time_tbl ON reserve_tbl.time_id=time_tbl.time_id WHERE movie_tbl.moviecategory_id='2' ORDER BY reserve_tbl.reserve_id DESC";
        $result = $this->conn->query($sql);

        if($result->num_rows >= 0){
            $row = array();
            while($rows = $result->fetch_assoc()){
                $row[] = $rows;
            }
            return $row;
        }else{
            return FALSE;
        }
    }

    //displaying movie categories
    public function viewMovieCategory(){
        $sql = "SELECT * FROM moviecategory_tbl";
        $result = $this->conn->query($sql);

        if($result->num_rows >= 0){
            $row = array();
            while($rows = $result->fetch_assoc()){
                $row[] = $rows;
            }
            return $row;
        }else{
            return FALSE;
        }
    }

    //displaying 4 latest movies of each category
    public function viewMovie2($moviecategory_id){
        $sql = "SELECT * FROM movie_tbl WHERE moviecategory_id='$moviecategory_id' ORDER BY movie_id DESC LIMIT 4";
        $result = $this->conn->query($sql);

        if($result->num_rows >= 0){
            $row = array();
            while($rows = $result->fetch_assoc()){
                $row[] = $rows;
            }
            return $row;
        }else{
            return FALSE;
        }
    }
    
    //displaying 4 other movies of each category
    public function viewMovie3($moviecategory_id){
        $sql = "SELECT * FROM movie_tbl WHERE moviecategory_id='$moviecategory_id' ORDER BY movie_id DESC LIMIT 4 OFFSET 4";
        $result = $this->conn->query($sql);
        
        if($result->num_rows >= 0){
            $row = array();
            while($rows = $result->fetch_assoc()){
                $row[] = $rows;
            }
            return $row;
        }else{
            return FALSE;
        }
    }

    // displaying today's movie
    public function viewToday($cinema_id,$date){
        $sql = "SELECT * FROM time_tbl INNER JOIN movie_tbl ON time_tbl.movie_id=movie_tbl.movie_id INNER JOIN cinema_tbl ON time_tbl.cinema_id=cinema_tbl.cinema_id INNER JOIN date_tbl ON time_tbl.date_id=date_tbl.date_id WHERE cinema_tbl.cinema_id='$cinema_id' AND date_tbl.date='$date' GROUP BY movie_tbl.movie_id ORDER BY movie_tbl.movie_id DESC";
        $result = $this->conn->query($sql);

        if($result->num_rows >= 0){
            $row = array();
            while($rows = $result->fetch_assoc()){
                $row[] = $rows;
            }
            return $row;
        }else{
            return FALSE;
        }
    }

    //displaying time
    public function viewTime($cinema_id,$movie_id,$date){
        $sql = "SELECT * FROM time_tbl INNER JOIN movie_tbl ON time_tbl.movie_id=movie_tbl.movie_id INNER JOIN cinema_tbl ON time_tbl.cinema_id=cinema_tbl.cinema_id INNER JOIN date_tbl ON time_tbl.date_id=date_tbl.date_id WHERE movie_tbl.moviecategory_id='2' AND cinema_tbl.cinema_id='$cinema_id' AND movie_tbl.movie_id='$movie_id' AND date_tbl.date='$date'";
        $result = $this->conn->query($sql);

        if($result->num_rows >= 0){
            $row = array();
            while($rows = $result->fetch_assoc()){
                $row[] = $rows;
            }
            return $row;
        }else{
            return FALSE;
        }
    }

    // daisplaying one movie detail
    public function viewOneMovie($movie_id){
        $sql = "SELECT * FROM movie_tbl WHERE movie_id='$movie_id'";
        $result = $this->conn->query($sql);
        
        if($result->num_rows == 1){
            $row = array();
            while($rows = $result->fetch_assoc()){
                $row[] = $rows;
            }
            return $row;
        }else{
            return FALSE;
        }
    }

    // displaying the review of a movie
    public function viewReview($movie_id){
        $sql = "SELECT * FROM review_tbl INNER JOIN movie_tbl ON review_tbl.movie_id=movie_tbl.movie_id INNER JOIN page_tbl ON review_tbl.review_id=page_tbl.review_id WHERE movie_tbl.movie_id='$movie_id' ORDER BY review_tbl.review_id DESC";
        $result = $this->conn->query($sql);

        if($result->num_rows >= 0){
            $row = array();
            while($rows = $result->fetch_assoc()){
                $row[] = $rows;
            }
            return $row;
        }else{
            return FALSE;
        }
    }

    //adding a review
    public function addReview($review,$rate,$reviewdate,$nickname,$login_id,$movie_id,$pagenumber){
        $sql = "INSERT INTO review_tbl(review,rate,reviewdate,nickname,login_id,movie_id)VALUES('$review','$rate','$reviewdate','$nickname','$login_id','$movie_id')";
        $result = $this->conn->query($sql);

        if($result == TRUE){
            $review_id = $this->conn->insert_id;
            $sql2 = "INSERT INTO page_tbl(pagenumber,review_id)VALUES('$pagenumber','$review_id')";
            $result2 = $this->conn->query($sql2);

            if($result2 == FALSE){
                die('adding page failed '.$this->conn->error);
            }else{
                header('location:review.php?movie_id='.$movie_id);
            }
        }else{
            die('adding review failed '.$this->conn->error);
        }

    }

    // displaying the reviews of each rate
    public function viewRate10($movie_id){
        $sql = "SELECT * FROM review_tbl INNER JOIN movie_tbl ON review_tbl.movie_id=movie_tbl.movie_id WHERE movie_tbl.movie_id='$movie_id' AND review_tbl.rate='10'";
        $result = $this->conn->query($sql);

        if($result->num_rows >= 0){
            $row = array();
            while($rows = $result->fetch_assoc()){
                $row[] = $rows;
            }
            return $row;
        }else{
            return FALSE;
        }
    }
    public function viewRate9($movie_id){
        $sql = "SELECT * FROM review_tbl INNER JOIN movie_tbl ON review_tbl.movie_id=movie_tbl.movie_id WHERE movie_tbl.movie_id='$movie_id' AND review_tbl.rate='9'";
        $result = $this->conn->query($sql);

        if($result->num_rows >= 0){
            $row = array();
            while($rows = $result->fetch_assoc()){
                $row[] = $rows;
            }
            return $row;
        }else{
            return FALSE;
        }
    }
    public function viewRate8($movie_id){
        $sql = "SELECT * FROM review_tbl INNER JOIN movie_tbl ON review_tbl.movie_id=movie_tbl.movie_id WHERE movie_tbl.movie_id='$movie_id' AND review_tbl.rate='8'";
        $result = $this->conn->query($sql);

        if($result->num_rows >= 0){
            $row = array();
            while($rows = $result->fetch_assoc()){
                $row[] = $rows;
            }
            return $row;
        }else{
            return FALSE;
        }
    }
    public function viewRate7($movie_id){
        $sql = "SELECT * FROM review_tbl INNER JOIN movie_tbl ON review_tbl.movie_id=movie_tbl.movie_id WHERE movie_tbl.movie_id='$movie_id' AND review_tbl.rate='7'";
        $result = $this->conn->query($sql);

        if($result->num_rows >= 0){
            $row = array();
            while($rows = $result->fetch_assoc()){
                $row[] = $rows;
            }
            return $row;
        }else{
            return FALSE;
        }
    }
    public function viewRate6($movie_id){
        $sql = "SELECT * FROM review_tbl INNER JOIN movie_tbl ON review_tbl.movie_id=movie_tbl.movie_id WHERE movie_tbl.movie_id='$movie_id' AND review_tbl.rate='6'";
        $result = $this->conn->query($sql);

        if($result->num_rows >= 0){
            $row = array();
            while($rows = $result->fetch_assoc()){
                $row[] = $rows;
            }
            return $row;
        }else{
            return FALSE;
        }
    }
    public function viewRate5($movie_id){
        $sql = "SELECT * FROM review_tbl INNER JOIN movie_tbl ON review_tbl.movie_id=movie_tbl.movie_id WHERE movie_tbl.movie_id='$movie_id' AND review_tbl.rate='5'";
        $result = $this->conn->query($sql);

        if($result->num_rows >= 0){
            $row = array();
            while($rows = $result->fetch_assoc()){
                $row[] = $rows;
            }
            return $row;
        }else{
            return FALSE;
        }
    }
    public function viewRate4($movie_id){
        $sql = "SELECT * FROM review_tbl INNER JOIN movie_tbl ON review_tbl.movie_id=movie_tbl.movie_id WHERE movie_tbl.movie_id='$movie_id' AND review_tbl.rate='4'";
        $result = $this->conn->query($sql);

        if($result->num_rows >= 0){
            $row = array();
            while($rows = $result->fetch_assoc()){
                $row[] = $rows;
            }
            return $row;
        }else{
            return FALSE;
        }
    }
    public function viewRate3($movie_id){
        $sql = "SELECT * FROM review_tbl INNER JOIN movie_tbl ON review_tbl.movie_id=movie_tbl.movie_id WHERE movie_tbl.movie_id='$movie_id' AND review_tbl.rate='3'";
        $result = $this->conn->query($sql);

        if($result->num_rows >= 0){
            $row = array();
            while($rows = $result->fetch_assoc()){
                $row[] = $rows;
            }
            return $row;
        }else{
            return FALSE;
        }
    }
    public function viewRate2($movie_id){
        $sql = "SELECT * FROM review_tbl INNER JOIN movie_tbl ON review_tbl.movie_id=movie_tbl.movie_id WHERE movie_tbl.movie_id='$movie_id' AND review_tbl.rate='2'";
        $result = $this->conn->query($sql);

        if($result->num_rows >= 0){
            $row = array();
            while($rows = $result->fetch_assoc()){
                $row[] = $rows;
            }
            return $row;
        }else{
            return FALSE;
        }
    }
    public function viewRate1($movie_id){
        $sql = "SELECT * FROM review_tbl INNER JOIN movie_tbl ON review_tbl.movie_id=movie_tbl.movie_id WHERE movie_tbl.movie_id='$movie_id' AND review_tbl.rate='1'";
        $result = $this->conn->query($sql);

        if($result->num_rows >= 0){
            $row = array();
            while($rows = $result->fetch_assoc()){
                $row[] = $rows;
            }
            return $row;
        }else{
            return FALSE;
        }
    }

    // displaying an average of the rates
    public function viewAvg($movie_id){
        $sql = "SELECT AVG(review_tbl.rate) AS averageRate FROM review_tbl INNER JOIN user_tbl ON review_tbl.login_id=user_tbl.login_id INNER JOIN movie_tbl ON review_tbl.movie_id=movie_tbl.movie_id WHERE movie_tbl.movie_id='$movie_id'";;
        $result = $this->conn->query($sql);

        if($result->num_rows == 1){
            $row = array();
            while($rows = $result->fetch_assoc()){
                $row[] = $rows;
            }
            return $row;
        }else{
            return FALSE;
        }
    }

    // displaying now showing movies
    public function viewNowShowing(){
        $sql = "SELECT * FROM review_tbl INNER JOIN movie_tbl ON review_tbl.movie_id=movie_tbl.movie_id WHERE movie_tbl.moviecategory_id='2' GROUP BY movie_tbl.movie_id ORDER BY review_tbl.review_id DESC";
        $result = $this->conn->query($sql);

        if($result->num_rows >= 0){
            $row = array();
            while($rows = $result->fetch_assoc()){
                $row[] = $rows;
            }
            return $row;
        }else{
            return FALSE;
        }
    }
    

    // displaying cinema based on cinema_id
    public function viewCinema2($cinema_id){
        $sql = "SELECT * FROM cinema_tbl WHERE cinema_id='$cinema_id'";
        $result = $this->conn->query($sql);

        if($result->num_rows >= 0){
            $row = array();
            while($rows = $result->fetch_assoc()){
                $row[] = $rows;
            }
            return $row;
        }else{
            return FALSE;
        }
    }

    
}

?>