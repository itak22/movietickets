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
    // public function viewSearch($movie_id,$theater_id){
    //     $sql = "SELECT * FROM time_tbl INNER JOIN movie_tbl ON time_tbl.movie_id=movie_tbl.movie_id INNER JOIN theater_tbl ON time_tbl.theater_id=theater_tbl.theater_id WHERE movie_tbl.movie_id='$movie_id' AND theater_tbl.theater_id='$theater_id'";
    //     $result = $this->conn->query($sql);

    //     if($result->num_rows >= 0){
    //         $row = array();
    //         while($rows = $result->fetch_assoc()){
    //             $row[] = $rows;
    //         }
    //         return $row;
    //     }else{
    //         return FALSE;
    //     }
    // }
    // public function viewSearch2($movie_id,$theater_id,$date_id,$time_id){
    //     $sql = "SELECT * FROM time_tbl INNER JOIN movie_tbl ON time_tbl.movie_id=movie_tbl.movie_id INNER JOIN theater_tbl ON time_tbl.theater_id=theater_tbl.theater_id INNER JOIN date_tbl ON time_tbl.date_id=date_tbl.date_id WHERE movie_tbl.movie_id='$movie_id' AND theater_tbl.theater_id='$theater_id' AND date_tbl.date_id='$date_id' AND time_tbl.time_id='$time_id'";
    //     $result = $this->conn->query($sql);

    //     if($result->num_rows >= 0){
    //         $row = array();
    //         while($rows = $result->fetch_assoc()){
    //             $row[] = $rows;
    //         }
    //         return $row;
    //     }else{
    //         return FALSE;
    //     }
    // }

    // // adding reservation data
    // public function addReserve($reservedate,$date_id,$movie_id,$theater_id,$time_id){
    //     $sql = "INSERT INTO reserve_tbl(reservedate,date_id,movie_id,theater_id,time_id)VALUES($reservedate,$date_id,$movie_id,$theater_id,$time_id)";
    //     $result = $this->conn->query($sql);

    //     if($result == FALSE){
    //         die('reservation failed '.$this->conn->error);
    //     }else{
    //         header('location:customer.php');
    //     }
    // }

    // // displaying reserveation data
    // public function viewReserve(){
    //     $sql = "SELECT * FROM reserve_tbl INNER JOIN time_tbl ON reserve_tbl.time_id=time_tbl.time_id WHERE movie_tbl.moviecategory_id='1' ORDER BY reserve_tbl.reserve_id DESC";
    //     $result = $this->conn->query($sql);

    //     if($result->num_rows >= 0){
    //         $row = array();
    //         while($rows = $result->fetch_assoc()){
    //             $row[] = $rows;
    //         }
    //         return $row;
    //     }else{
    //         return FALSE;
    //     }
    // }

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

    // displaying timeline on the specific date
    public function viewTimeline($theater_id,$date){
        $sql = "SELECT * FROM time_tbl INNER JOIN movie_tbl ON time_tbl.movie_id=movie_tbl.movie_id INNER JOIN theater_tbl ON time_tbl.theater_id=theater_tbl.theater_id INNER JOIN date_tbl ON time_tbl.date_id=date_tbl.date_id INNER JOIN hall_tbl ON time_tbl.hall_id=hall_tbl.hall_id WHERE theater_tbl.theater_id='$theater_id' AND date_tbl.date='$date' GROUP BY movie_tbl.movie_id ORDER BY movie_tbl.movie_id DESC";
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
        $sql = "SELECT * FROM time_tbl INNER JOIN movie_tbl ON time_tbl.movie_id=movie_tbl.movie_id INNER JOIN theater_tbl ON time_tbl.theater_id=theater_tbl.theater_id INNER JOIN date_tbl ON time_tbl.date_id=date_tbl.date_id INNER JOIN hall_tbl ON time_tbl.hall_id=hall_tbl.hall_id WHERE theater_tbl.theater_id='$theater_id' AND movie_tbl.movie_id='$movie_id' AND date_tbl.date='$date'";
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
        $sql = "INSERT INTO review_tbl(review,rate,reviewdate,nickname,login_id,movie_id)VALUES('$review','$rate','$reviewdate','$nickname','$login_id','$movie_id')";
        $result = $this->conn->query($sql);

        if($result == FALSE){
            die('adding review failed '.$this->conn->error);
        }else{
            header('location:review.php?movie_id='.$movie_id);
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
        $sql = "SELECT * FROM time_tbl INNER JOIN movie_tbl ON time_tbl.movie_id=movie_tbl.movie_id INNER JOIN theater_tbl ON time_tbl.theater_id=theater_tbl.theater_id INNER JOIN date_tbl ON time_tbl.date_id=date_tbl.date_id INNER JOIN hall_tbl ON time_tbl.hall_id=hall_tbl.hall_id WHERE theater_tbl.theater_id='$theater_id' GROUP BY date_tbl.date_id ORDER BY date_tbl.date ASC";
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
        $sql1 = "SELECT * FROM reserve_tbl WHERE time_id='$time_id'  AND seat_id='$seat_id' AND login_id='$login_id'";
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

    // displaying resevation data based on time ID and seat ID
    public function viewOneReserve($time_id,$seat_id,$login_id){
        $sql = "SELECT * FROM reserve_tbl INNER JOIN time_tbl ON reserve_tbl.time_id=time_tbl.time_id INNER JOIN seat_tbl ON reserve_tbl.seat_id=seat_tbl.seat_id INNER JOIN user_tbl ON reserve_tbl.login_id=user_tbl.login_id WHERE time_tbl.time_id='$time_id' AND seat_tbl.seat_id='$seat_id' AND user_tbl.login_id='$login_id'";
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
        $sql = "SELECT * FROM time_tbl INNER JOIN movie_tbl ON time_tbl.movie_id=movie_tbl.movie_id INNER JOIN theater_tbl ON time_tbl.theater_id=theater_tbl.theater_id INNER JOIN date_tbl ON time_tbl.date_id=date_tbl.date_id INNER JOIN hall_tbl ON time_tbl.hall_id=hall_tbl.hall_id WHERE movie_tbl.movie_id='$movie_id' GROUP BY theater_tbl.theater_id";
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
        $sql = "SELECT * FROM time_tbl INNER JOIN movie_tbl ON time_tbl.movie_id=movie_tbl.movie_id INNER JOIN theater_tbl ON time_tbl.theater_id=theater_tbl.theater_id INNER JOIN date_tbl ON time_tbl.date_id=date_tbl.date_id INNER JOIN hall_tbl ON time_tbl.hall_id=hall_tbl.hall_id WHERE movie_tbl.movie_id='$movie_id' AND theater_tbl.theater_id='$theater_id' AND date_tbl.date='$date' GROUP BY theater_tbl.theater_id ORDER BY date_tbl.date ASC";
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
        $sql = "SELECT * FROM time_tbl INNER JOIN movie_tbl ON time_tbl.movie_id=movie_tbl.movie_id INNER JOIN theater_tbl ON time_tbl.theater_id=theater_tbl.theater_id INNER JOIN date_tbl ON time_tbl.date_id=date_tbl.date_id INNER JOIN hall_tbl ON time_tbl.hall_id=hall_tbl.hall_id WHERE movie_tbl.movie_id='$movie_id' AND theater_tbl.theater_id='$theater_id' AND date_tbl.date='$date'";
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
        $sql = "SELECT * FROM time_tbl INNER JOIN movie_tbl ON time_tbl.movie_id=time_tbl.movie_id INNER JOIN theater_tbl ON time_tbl.theater_id=theater_tbl.theater_id INNER JOIN date_tbl ON time_tbl.date_id=date_tbl.date_id INNER JOIN hall_tbl ON time_tbl.hall_id=hall_tbl.hall_id GROUP BY movie_tbl.movie_id ORDER BY movie_tbl.movie_id DESC";
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

    // displaying one price data
    public function viewOnePrice($hall_id){
        $sql = "SELECT * FROM hall_tbl INNER JOIN price_tbl ON hall_tbl.price_id=price_tbl.price_id WHERE hall_tbl.hall_id='$hall_id'";
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
        $sql = "SELECT * FROM time_tbl INNER JOIN movie_tbl ON time_tbl.movie_id=movie_tbl.movie_id INNER JOIN theater_tbl ON time_tbl.theater_id=theater_tbl.theater_id INNER JOIN date_tbl ON time_tbl.date_id=date_tbl.date_id INNER JOIN hall_tbl ON time_tbl.hall_id=hall_tbl.hall_id WHERE time_tbl.time_id='$time_id'";
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

    // add a movie
    public function addMovie($moviename,$moviecategory_id,$image,$trailer,$overview,$runninghours,$runningminutes,$releasedate,$rated_r,$cast,$directors){
        $target_dir = 'uploads/';
        $target_file = $target_dir.basename($image);
        $sql = "INSERT INTO movie_tbl(moviename,moviecategory_id,image,trailer,overview,runninghours,runningminutes,releasedate,rated-r,cast,directors)VALUES('$moviename','$moviecategory_id','$image','$trailer','$overview','$runninghours','$runningminutes','$releasedate','$rated_r','$cast','$directors')";
        $result = $this->conn->query($sql);

        if($result == FALSE){
            die('adding movie table failed '.$this->conn->error);
        }else{
            move_uploaded_file($_FILES['img']['tmp_name'],$target_file);
            header('location:movie_staff.php');
        }
    }

    
}

?>