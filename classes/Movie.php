<?php
include 'Connection.php';

class Movie extends Connection{
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
    public function getOneUser($login_id){
        $sql = "SELECT * FROM user_tbl WHERE login_id='$login_id'";
        $result = $this->conn->query($sql);

        if($result == FALSE){
            die('cannot get one customer'.$this->conn->error);
        }else{
            return $result->fetch_assoc();
        }
    }
    public function viewMovie(){
        $sql = "SELECT * FROM movie_tbl INNER JOIN moviecategory_tbl ON movie_tbl.moviecategory_id=moviecategory_tbl.moviecategory_id";
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
    public function viewTheater(){
        $sql = "SELECT * FROM theater_tbl";
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
    public function viewLatestMovie($moviecategory_id){
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
    public function viewOtherMovie($moviecategory_id){
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

    // displaying timeline on the specific date
    public function viewTimeline($theater_id,$date){
        $sql = "SELECT * FROM time_tbl INNER JOIN movie_tbl ON time_tbl.movie_id=movie_tbl.movie_id INNER JOIN theater_tbl ON time_tbl.theater_id=theater_tbl.theater_id INNER JOIN date_tbl ON time_tbl.date_id=date_tbl.date_id INNER JOIN hall_tbl ON time_tbl.hall_id=hall_tbl.hall_id INNER JOIN price_tbl ON time_tbl.price_id=price_tbl.price_id WHERE theater_tbl.theater_id='$theater_id' AND date_tbl.date='$date' GROUP BY movie_tbl.movie_id ORDER BY movie_tbl.movie_id DESC";
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
    public function viewTime($theater_id,$movie_id,$date){
        $sql = "SELECT * FROM time_tbl INNER JOIN movie_tbl ON time_tbl.movie_id=movie_tbl.movie_id INNER JOIN theater_tbl ON time_tbl.theater_id=theater_tbl.theater_id INNER JOIN date_tbl ON time_tbl.date_id=date_tbl.date_id INNER JOIN hall_tbl ON time_tbl.hall_id=hall_tbl.hall_id INNER JOIN price_tbl ON time_tbl.price_id=price_tbl.price_id WHERE theater_tbl.theater_id='$theater_id' AND movie_tbl.movie_id='$movie_id' AND date_tbl.date='$date'";
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
        $sql = "SELECT * FROM review_tbl INNER JOIN movie_tbl ON review_tbl.movie_id=movie_tbl.movie_id WHERE movie_tbl.movie_id='$movie_id' ORDER BY review_tbl.review_id DESC";
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
    public function addReview($review,$rate,$reviewdate,$nickname,$login_id,$movie_id){
        $review = $this->conn->real_escape_string($review);
        $sql = "INSERT INTO review_tbl(review,rate,reviewdate,nickname,login_id,movie_id)VALUES('$review','$rate','$reviewdate','$nickname','$login_id','$movie_id')";
        $result = $this->conn->query($sql);

        if($result == FALSE){
            die('adding review failed '.$this->conn->error);
        }else{
            header('location:review.php?movie_id='.$movie_id);
        }

    }

    //adding a review in admin page
    public function addReviewA($review,$rate,$reviewdate,$nickname,$login_id,$movie_id){
        $review = $this->conn->real_escape_string($review);
        $sql = "INSERT INTO review_tbl(review,rate,reviewdate,nickname,login_id,movie_id)VALUES('$review','$rate','$reviewdate','$nickname','$login_id','$movie_id')";
        $result = $this->conn->query($sql);

        if($result == FALSE){
            die('adding review failed '.$this->conn->error);
        }else{
            header('location:review_staff.php?movie_id='.$movie_id);
        }

    }

    // displaying the reviews of each rate
    public function viewOneRate($movie_id,$rate){
        $sql = "SELECT * FROM review_tbl INNER JOIN movie_tbl ON review_tbl.movie_id=movie_tbl.movie_id WHERE movie_tbl.movie_id='$movie_id' AND review_tbl.rate='$rate'";
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
        $sql = "SELECT * FROM movie_tbl WHERE moviecategory_id='2' GROUP BY movie_id ORDER BY movie_id DESC";
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
    
    //updating the review data
    public function updateReview($review_id,$review,$rate,$nickname,$movie_id){
        $sql = "UPDATE review_tbl SET review='$review',rate='$rate',nickname='$nickname' WHERE review_id='$review_id'";
        $result = $this->conn->query($sql);

        if($result == FALSE){
            die('updating review failed '.$this->conn->error);
        }else{
            header('location:review.php?movie_id='.$movie_id);
        }
    }

    //deleting teh review data
    public function deleteReview($review_id,$movie_id){
        $sql = "DELETE FROM review_tbl WHERE review_id='$review_id'";
        $result = $this->conn->query($sql);

        if($result == FALSE){
            die('deleting reservation failed '.$this->conn->error);
        }else{
            header('location:review.php?movie_id='.$movie_id);
        }
    }

    //updating the review data in admin page
    public function updateReviewA($review_id,$review,$rate,$nickname,$movie_id){
        $sql = "UPDATE review_tbl SET review='$review',rate='$rate',nickname='$nickname' WHERE review_id='$review_id'";
        $result = $this->conn->query($sql);

        if($result == FALSE){
            die('updating review failed '.$this->conn->error);
        }else{
            header('location:review_staff.php?movie_id='.$movie_id);
        }
    }

    //deleting teh review data in admin page
    public function deleteReviewA($review_id,$movie_id){
        $sql = "DELETE FROM review_tbl WHERE review_id='$review_id'";
        $result = $this->conn->query($sql);

        if($result == FALSE){
            die('deleting reservation failed '.$this->conn->error);
        }else{
            header('location:review_staff.php?movie_id='.$movie_id);
        }
    }

    // displaying cinema based on cinema_id
    public function viewTheater2($theater_id){
        $sql = "SELECT * FROM theater_tbl WHERE theater_id='$theater_id'";
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

    // displaying date
    public function viewDate($theater_id){
        $sql = "SELECT * FROM time_tbl INNER JOIN movie_tbl ON time_tbl.movie_id=movie_tbl.movie_id INNER JOIN theater_tbl ON time_tbl.theater_id=theater_tbl.theater_id INNER JOIN date_tbl ON time_tbl.date_id=date_tbl.date_id INNER JOIN hall_tbl ON time_tbl.hall_id=hall_tbl.hall_id INNER JOIN price_tbl ON time_tbl.price_id=price_tbl.price_id WHERE theater_tbl.theater_id='$theater_id' GROUP BY date_tbl.date_id ORDER BY date_tbl.date ASC";
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
    public function addReserve($reservedate,$time_id,$seat_id,$login_id){
        $sql1 = "SELECT * FROM reserve_tbl WHERE time_id='$time_id'  AND seat_id='$seat_id'";
        $result1 = $this->conn->query($sql1);

        if($result1->num_rows == 0){
            $sql2 = "INSERT INTO reserve_tbl(reservedate,time_id,seat_id,login_id)VALUES($reservedate,$time_id,$seat_id,$login_id)";
            $result2 = $this->conn->query($sql2);

            if($result2 == FALSE){
                die('reservation failed '.$this->conn->error);
            }else{
                echo "<div class='card w-25 mt-5 mx-auto text-center font-weight-bold text-uppercase'><div class='card-header bg-success'>✔success</div><div class='card-body'><div class='alert alert-success'>reservation successful</div></div><div class='card-footer bg-light'><a href='customer.php' role='button' class='btn btn-secondary btn-block w-50 mx-auto'>my page</a></div></div>";
            }
        }else{
            die("<div class='card w-25 mt-5 mx-auto text-center font-weight-bold text-uppercase'><div class='card-header bg-danger'>⚠error</div><div class='card-body'><div class='alert alert-danger'>already occupied</div></div><div class='card-footer bg-light'><a href='reserve.php?time_id=".$time_id."' role='button' class='btn btn-secondary btn-block w-50 mx-auto'>try again</a></div></div>".$this->conn->error);
        }
    }

    // adding reservation data in admin page
    public function addReserveA($reservedate,$time_id,$seat_id,$login_id){
        $sql1 = "SELECT * FROM reserve_tbl WHERE time_id='$time_id'  AND seat_id='$seat_id'";
        $result1 = $this->conn->query($sql1);

        if($result1->num_rows == 0){
            $sql2 = "INSERT INTO reserve_tbl(reservedate,time_id,seat_id,login_id)VALUES($reservedate,$time_id,$seat_id,$login_id)";
            $result2 = $this->conn->query($sql2);

            if($result2 == FALSE){
                die('reservation failed '.$this->conn->error);
            }else{
                echo "<div class='card w-25 mt-5 mx-auto text-center font-weight-bold text-uppercase'><div class='card-header bg-success'>✔success</div><div class='card-body'><div class='alert alert-success'>reservation successful</div></div><div class='card-footer bg-light'><a href='staff.php' role='button' class='btn btn-secondary btn-block w-50 mx-auto'>my page</a></div></div>";
            }
        }else{
            die("<div class='card w-25 mt-5 mx-auto text-center font-weight-bold text-uppercase'><div class='card-header bg-danger'>⚠error</div><div class='card-body'><div class='alert alert-danger'>already occupied</div></div><div class='card-footer bg-light'><a href='reserve.php?time_id=".$time_id."' role='button' class='btn btn-secondary btn-block w-50 mx-auto'>try again</a></div></div>".$this->conn->error);
        }
    }


    // displaying resevation data based on time ID and seat ID
    public function viewOneReserve($time_id,$seat_id){
        $sql = "SELECT * FROM reserve_tbl INNER JOIN time_tbl ON reserve_tbl.time_id=time_tbl.time_id INNER JOIN seat_tbl ON reserve_tbl.seat_id=seat_tbl.seat_id INNER JOIN user_tbl ON reserve_tbl.login_id=user_tbl.login_id WHERE time_tbl.time_id='$time_id' AND seat_tbl.seat_id='$seat_id'";
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

    // displaying seat data
    public function viewSeat(){
        $sql = "SELECT * FROM seat_tbl";
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

    // displaying theater based on movie ID
    public function viewTheater3($movie_id){
        $sql = "SELECT * FROM time_tbl INNER JOIN movie_tbl ON time_tbl.movie_id=movie_tbl.movie_id INNER JOIN theater_tbl ON time_tbl.theater_id=theater_tbl.theater_id INNER JOIN date_tbl ON time_tbl.date_id=date_tbl.date_id INNER JOIN hall_tbl ON time_tbl.hall_id=hall_tbl.hall_id INNER JOIN price_tbl ON time_tbl.price_id=price_tbl.price_id WHERE movie_tbl.movie_id='$movie_id' GROUP BY theater_tbl.theater_id";
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

    // displaying timeline based on theater ID
    public function viewTimeline2($movie_id,$theater_id,$date){
        $sql = "SELECT * FROM time_tbl INNER JOIN movie_tbl ON time_tbl.movie_id=movie_tbl.movie_id INNER JOIN theater_tbl ON time_tbl.theater_id=theater_tbl.theater_id INNER JOIN date_tbl ON time_tbl.date_id=date_tbl.date_id INNER JOIN hall_tbl ON time_tbl.hall_id=hall_tbl.hall_id INNER JOIN price_tbl ON time_tbl.price_id=price_tbl.price_id WHERE movie_tbl.movie_id='$movie_id' AND theater_tbl.theater_id='$theater_id' AND date_tbl.date='$date' GROUP BY theater_tbl.theater_id ORDER BY date_tbl.date ASC";
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

    // displaying time based on theater ID, movie ID and date
    public function viewTime2($movie_id,$theater_id,$date){
        $sql = "SELECT * FROM time_tbl INNER JOIN movie_tbl ON time_tbl.movie_id=movie_tbl.movie_id INNER JOIN theater_tbl ON time_tbl.theater_id=theater_tbl.theater_id INNER JOIN date_tbl ON time_tbl.date_id=date_tbl.date_id INNER JOIN hall_tbl ON time_tbl.hall_id=hall_tbl.hall_id INNER JOIN price_tbl ON time_tbl.price_id=price_tbl.price_id WHERE movie_tbl.movie_id='$movie_id' AND theater_tbl.theater_id='$theater_id' AND date_tbl.date='$date'";
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

    // displaying movies 
    public function viewMovie4(){
        $sql = "SELECT * FROM time_tbl INNER JOIN movie_tbl ON time_tbl.movie_id=time_tbl.movie_id INNER JOIN theater_tbl ON time_tbl.theater_id=theater_tbl.theater_id INNER JOIN date_tbl ON time_tbl.date_id=date_tbl.date_id INNER JOIN hall_tbl ON time_tbl.hall_id=hall_tbl.hall_id INNER JOIN price_tbl ON time_tbl.price_id=price_tbl.price_id GROUP BY movie_tbl.movie_id ORDER BY movie_tbl.movie_id DESC";
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

    //displaying one timline including movie, theater, time and hall based on time ID
    public function viewOneTimeline($time_id){
        $sql = "SELECT * FROM time_tbl INNER JOIN movie_tbl ON time_tbl.movie_id=movie_tbl.movie_id INNER JOIN theater_tbl ON time_tbl.theater_id=theater_tbl.theater_id INNER JOIN date_tbl ON time_tbl.date_id=date_tbl.date_id INNER JOIN hall_tbl ON time_tbl.hall_id=hall_tbl.hall_id INNER JOIN price_tbl ON time_tbl.price_id=price_tbl.price_id WHERE time_tbl.time_id='$time_id'";
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

    // displaying one resevation data based on login ID
    public function viewReserve($login_id){
        $sql = "SELECT * FROM reserve_tbl INNER JOIN time_tbl ON reserve_tbl.time_id=time_tbl.time_id INNER JOIN seat_tbl ON reserve_tbl.seat_id=seat_tbl.seat_id INNER JOIN user_tbl ON reserve_tbl.login_id=user_tbl.login_id WHERE user_tbl.login_id='$login_id' ORDER BY reserve_tbl.reserve_id DESC";
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

    // displaying one resevation data based on login ID in admin page
    public function viewReserveA(){
        $sql = "SELECT * FROM reserve_tbl INNER JOIN time_tbl ON reserve_tbl.time_id=time_tbl.time_id INNER JOIN seat_tbl ON reserve_tbl.seat_id=seat_tbl.seat_id INNER JOIN user_tbl ON reserve_tbl.login_id=user_tbl.login_id ORDER BY reserve_tbl.reserve_id DESC";
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

    // displaying seat data based on Seat ID
    public function viewOneSeat($seat_id){
        $sql = "SELECT * FROM seat_tbl WHERE seat_id='$seat_id'";
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

    //deleting reservation data
    public function deleteReserve($reserve_id){
        $sql = "DELETE FROM reserve_tbl WHERE reserve_id='$reserve_id'";
        $result = $this->conn->query($sql);

        if($result == FALSE){
            die('deleting reservation failed '.$this->conn->error);
        }else{
            echo "<div class='card w-25 mt-5 mx-auto text-center font-weight-bold text-uppercase'><div class='card-header bg-success'>✔success</div><div class='card-body'><div class='alert alert-success'>cancellation successful</div></div><div class='card-footer bg-light'><a href='customer.php' role='button' class='btn btn-secondary btn-block w-50 mx-auto'>my page</a></div></div>";
        }
    }

    //deleting reservation data in admin page
    public function deleteReserveA($reserve_id){
        $sql = "DELETE FROM reserve_tbl WHERE reserve_id='$reserve_id'";
        $result = $this->conn->query($sql);

        if($result == FALSE){
            die('deleting reservation failed '.$this->conn->error);
        }else{
            echo "<div class='card w-25 mt-5 mx-auto text-center font-weight-bold text-uppercase'><div class='card-header bg-success'>✔success</div><div class='card-body'><div class='alert alert-success'>cancellation successful</div></div><div class='card-footer bg-light'><a href='staff.php' role='button' class='btn btn-secondary btn-block w-50 mx-auto'>my page</a></div></div>";
        }
    }

    // add a movie
    public function addMovie($moviename,$moviecategory_id,$image,$trailer,$overview,$runninghours,$runningminutes,$releasedate,$rated_r,$cast,$directors){
        $target_dir = 'uploads/';
        $target_file = $target_dir.basename($image);
        $moviename = $this->conn->real_escape_string($moviename);
        $overview = $this->conn->real_escape_string($overview);
        $sql = "INSERT INTO movie_tbl(moviename,moviecategory_id,image,trailer,overview,runninghours,runningminutes,releasedate,rated_r,cast,directors)VALUES('$moviename','$moviecategory_id','$image','$trailer','$overview','$runninghours','$runningminutes','$releasedate','$rated_r','$cast','$directors')";
        $result = $this->conn->query($sql);

        if($result == FALSE){
            die('adding failed '.$this->conn->error);
        }else{
            move_uploaded_file($_FILES['img']['tmp_name'],$target_file);
            header('location:movie_staff.php');
        }
    }

    // update a movie
    public function editMovie($movie_id,$moviename,$moviecategory_id,$image,$trailer,$overview,$runninghours,$runningminutes,$releasedate,$rated_r,$cast,$directors){
        $target_dir = 'uploads/';
        $target_file = $target_dir.basename($image);
        $moviename = $this->conn->real_escape_string($moviename);
        $overview = $this->conn->real_escape_string($overview);
        $sql = "UPDATE movie_tbl SET moviename='$moviename',moviecategory_id='$moviecategory_id',image='$image',trailer='$trailer',overview='$overview',runninghours='$runninghours',runningminutes='$runningminutes',releasedate='$releasedate',rated_r='$rated_r',cast='$cast',directors='$directors' WHERE movie_id='$movie_id'";
        $result = $this->conn->query($sql);

        if($result == FALSE){
            die('adding failed '.$this->conn->error);
        }else{
            move_uploaded_file($_FILES['img']['tmp_name'],$target_file);
            header('location:movie_staff.php');
        }
    }

    //deleting a movie
    public function deleteMovie($movie_id){
        $sql = "DELETE FROM movie_tbl WHERE movie_id='$movie_id'";
        $result = $this->conn->query($sql);

        if($result == FALSE){
            die('deleting movie failed '.$this->conn->error);
        }else{
            header('location:movie_staff.php');
        }
    }

    // adding a category
    public function addCategory($moviecategory){
        $sql = "INSERT INTO moviecategory_tbl(moviecategory)VALUES('$moviecategory')";
        $result = $this->conn->query($sql);

        if($result == FALSE){
            die('adding failed '.$this->conn->error);
        }else{
            header('location:movie_staff.php');
        }
    }

    // updating a category
    public function editCategory($moviecategory_id,$moviecategory){
        $sql = "UPDATE moviecategory_tbl SET moviecategory='$moviecategory' WHERE moviecategory_id='$moviecategory_id'";
        $result = $this->conn->query($sql);

        if($result == FALSE){
            die('updating failed '.$this->conn->error);
        }else{
            header('location:movie_staff.php');
        }
    }

    //deleting a category
    public function deleteCategory($moviecategory_id){
        $sql = "DELETE FROM moviecategory_tbl WHERE moviecategory_id='$moviecategory_id'";
        $result = $this->conn->query($sql);

        if($result == FALSE){
            die('deleting category failed '.$this->conn->error);
        }else{
            header('location:movie_staff.php');
        }
    }

    // adding a theater
    public function addTheater($theatername,$location){
        $sql = "INSERT INTO theater_tbl(theatername,location)VALUES('$theatername','$location')";
        $result = $this->conn->query($sql);

        if($result == FALSE){
            die('adding failed '.$this->conn->error);
        }else{
            $theater_id = $this->conn->insert_id;
            header('location:theater_staff.php?theater_id='.$theater_id);
        }
    }

    // updating a theater
    public function editTheater($theater_id,$theatername,$location){
        $sql = "UPDATE theater_tbl SET theatername='$theatername',location='$location' WHERE theater_id='$theater_id'";
        $result = $this->conn->query($sql);

        if($result == FALSE){
            die('updating failed '.$this->conn->error);
        }else{
            header('location:theater_staff.php?theater_id='.$theater_id);
        }
    }

    //deleting a theater
    public function deleteTheater($theater_id){
        $sql = "DELETE FROM theater_tbl WHERE theater_id='$theater_id'";
        $result = $this->conn->query($sql);

        if($result == FALSE){
            die('deleting theater failed '.$this->conn->error);
        }else{
            header('location:main_staff.php');
        }
    }

    // adding Time
    public function addTime($startinghours,$startingminutes,$startingam_pm,$endinghours,$endingminutes,$endingam_pm,$date_id,$movie_id,$theater_id,$hall_id,$price_id){
        $sql = "INSERT INTO time_tbl(startinghours,startingminutes,startingam_pm,endinghours,endingminutes,endingam_pm,date_id,movie_id,theater_id,hall_id,price_id)VALUES('$startinghours','$startingminutes','$startingam_pm','$endinghours','$endingminutes','$endingam_pm','$date_id','$movie_id','$theater_id','$hall_id','$price_id')";
        $result = $this->conn->query($sql);

        if($result == FALSE){
            die('adding failed '.$this->conn->error);
        }else{
            header('location:theater_staff.php?theater_id='.$theater_id);
        }
    }

    // updating time
    public function editTime($time_id,$startinghours,$startingminutes,$startingam_pm,$endinghours,$endingminutes,$endingam_pm,$theater_id){
        $sql = "UPDATE time_tbl SET startinghours='$startinghours',startingminutes='$startingminutes',startingam_pm='$startingam_pm',endinghours='$endinghours',endingminutes='$endingminutes',endingam_pm='$endingam_pm' WHERE time_id='$time_id'";
        $result = $this->conn->query($sql);

        if($result == FALSE){
            die('updating failed '.$this->conn->error);
        }else{
            header('location:theater_staff.php?theater_id='.$theater_id);
        }
    }

    //deleting time
    public function deleteTime($time_id,$theater_id){
        $sql = "DELETE FROM time_tbl WHERE time_id='$time_id'";
        $result = $this->conn->query($sql);

        if($result == FALSE){
            die('deleting failed '.$this->conn->error);
        }else{
            header('location:theater_staff.php?theater_id='.$theater_id);
        }
    }

    // adding Date
    public function addDate($date,$theater_id){
        $sql = "INSERT INTO date_tbl(date)VALUES('$date')";
        $result = $this->conn->query($sql);

        if($result == FALSE){
            die('adding failed '.$this->conn->error);
        }else{
            header('location:theater_staff.php?theater_id='.$theater_id);
        }
    }

    // updating date
    public function editDate($date_id,$date,$theater_id){
        $sql = "UPDATE date_tbl SET date='$date' WHERE date_id='$date_id'";
        $result = $this->conn->query($sql);

        if($result == FALSE){
            die('updating failed '.$this->conn->error);
        }else{
            header('location:theater_staff.php?theater_id='.$theater_id);
        }
    }

    //deleting date
    public function deleteDate($date_id,$theater_id){
        $sql = "DELETE FROM date_tbl WHERE date_id='$date_id'";
        $result = $this->conn->query($sql);

        if($result == FALSE){
            die('deleting failed '.$this->conn->error);
        }else{
            header('location:theater_staff.php?theater_id='.$theater_id);
        }
    }

    // adding a hall data
    public function addHall($hallname,$theater_id){
        $sql = "INSERT INTO hall_tbl(hallname)VALUES('$hallname')";
        $result = $this->conn->query($sql);

        if($result == FALSE){
            die('adding failed '.$this->conn->error);
        }else{
            header('location:theater_staff.php?theater_id='.$theater_id);
        }
    }

     // updating a hall data
     public function editHall($hall_id,$hallname,$theater_id){
        $sql = "UPDATE hall_tbl SET date='$hallname' WHERE hall_id='$hall_id'";
        $result = $this->conn->query($sql);

        if($result == FALSE){
            die('updating failed '.$this->conn->error);
        }else{
            header('location:theater_staff.php?theater_id='.$theater_id);
        }
    }

    //deleting date
    public function deleteHall($date_id,$theater_id){
        $sql = "DELETE FROM date_tbl WHERE date_id='$date_id'";
        $result = $this->conn->query($sql);

        if($result == FALSE){
            die('deleting movie failed '.$this->conn->error);
        }else{
            header('location:theater_staff.php?theater_id='.$theater_id);
        }
    }

    // adding a price data
    public function addPrice($price,$theater_id){
        $sql = "INSERT INTO price_tbl(price)VALUES('$price')";
        $result = $this->conn->query($sql);

        if($result == FALSE){
            die('adding failed '.$this->conn->error);
        }else{
            header('location:theater_staff.php?theater_id='.$theater_id);
        }
    }

     // updating a price data
     public function editPrice($price_id,$price,$theater_id){
        $sql = "UPDATE price_tbl SET price='$price' WHERE price_id='$price_id'";
        $result = $this->conn->query($sql);

        if($result == FALSE){
            die('updating failed '.$this->conn->error);
        }else{
            header('location:theater_staff.php?theater_id='.$theater_id);
        }
    }

    //deleting a price data
    public function deletePrice($price_id,$theater_id){
        $sql = "DELETE FROM date_tbl WHERE date_id='$price_id'";
        $result = $this->conn->query($sql);

        if($result == FALSE){
            die('deleting failed '.$this->conn->error);
        }else{
            header('location:theater_staff.php?theater_id='.$theater_id);
        }
    }

    // adding a seat data
    public function addSeat($seatrow,$seatnumber,$time_id){
        $sql = "INSERT INTO seat_tbl(seatrow,seatnumber)VALUES('$seatrow','$seatnumber')";
        $result = $this->conn->query($sql);

        if($result == FALSE){
            die('adding failed '.$this->conn->error);
        }else{
            header('location:reserve_staff.php?time_id='.$time_id);
        }
    }

     // updating a seat data
     public function editSeat($seat_id,$seatrow,$seatnumber,$time_id){
        $sql = "UPDATE seat_tbl SET seatrow='$seatrow',seatnumber='$seatnumber' WHERE seat_id='$seat_id'";
        $result = $this->conn->query($sql);

        if($result == FALSE){
            die('updating seat table failed '.$this->conn->error);
        }else{
            header('location:reserve_staff.php?time_id='.$time_id);
        }
    }

    //deleting a seat data
    public function deleteSeat($seat_id,$time_id){
        $sql = "DELETE FROM seat_tbl WHERE seat_id='$seat_id'";
        $result = $this->conn->query($sql);

        if($result == FALSE){
            die('deleting seat table failed '.$this->conn->error);
        }else{
            header('location:reserve_staff.php?time_id='.$time_id);
        }
    }

    // displaying all data from Date table
    public function viewAllDate(){
        $sql = "SELECT * FROM date_tbl ORDER BY date ASC";
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

    // displaying all data from hall table
    public function viewAllHall(){
        $sql = "SELECT * FROM hall_tbl";
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

    // displaying all data from price table
    public function viewAllPrice(){
        $sql = "SELECT * FROM price_tbl";
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

    // dispplaying all time data
    public function viewAllTime(){
        $sql = "SELECT * FROM time_tbl INNER JOIN movie_tbl ON time_tbl.movie_id=movie_tbl.movie_id INNER JOIN theater_tbl ON time_tbl.theater_id=theater_tbl.theater_id INNER JOIN date_tbl ON time_tbl.date_id=date_tbl.date_id INNER JOIN hall_tbl ON time_tbl.hall_id=hall_tbl.hall_id INNER JOIN price_tbl ON time_tbl.price_id=price_tbl.price_id";
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

    // adding Time in movie Timeline page
    public function addTime2($startinghours,$startingminutes,$startingam_pm,$endinghours,$endingminutes,$endingam_pm,$date_id,$movie_id,$theater_id,$hall_id,$price_id){
        $sql = "INSERT INTO time_tbl(startinghours,startingminutes,startingam_pm,endinghours,endingminutes,endingam_pm,date_id,movie_id,theater_id,hall_id,price_id)VALUES('$startinghours','$startingminutes','$startingam_pm','$endinghours','$endingminutes','$endingam_pm','$date_id','$movie_id','$theater_id','$hall_id','$price_id')";
        $result = $this->conn->query($sql);

        if($result == FALSE){
            die('adding failed '.$this->conn->error);
        }else{
            header('location:movieTimeline_staff.php?movie_id='.$movie_id);
        }
    }

    // updating time in movie timline page
    public function editTime2($time_id,$startinghours,$startingminutes,$startingam_pm,$endinghours,$endingminutes,$endingam_pm,$movie_id){
        $sql = "UPDATE time_tbl SET startinghours='$startinghours',startingminutes='$startingminutes',startingam_pm='$startingam_pm',endinghours='$endinghours',endingminutes='$endingminutes',endingam_pm='$endingam_pm' WHERE time_id='$time_id'";
        $result = $this->conn->query($sql);

        if($result == FALSE){
            die('updating failed '.$this->conn->error);
        }else{
            header('location:movieTimeline_staff.php?movie_id='.$movie_id);
        }
    }

    //deleting time in move timline page
    public function deleteTime2($time_id,$movie_id){
        $sql = "DELETE FROM time_tbl WHERE time_id='$time_id'";
        $result = $this->conn->query($sql);

        if($result == FALSE){
            die('deleting failed '.$this->conn->error);
        }else{
            header('location:movieTimeline_staff.php?movie_id='.$movie_id);
        }
    }
    
}

?>