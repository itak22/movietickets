<!doctype html>
<html lang="en">
  <head>
    <title>register</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style.css">

    <script src="https://kit.fontawesome.com/eb83b1af77.js" crossorigin="anonymous"></script>
  </head>
  <body class="register">
      <?php
      include 'menu.php';
      
      if(!empty($_SESSION['login_id'])){
              header('location:main_customer.php');
          }

      ?>
      <div class="container-fluid">
          <div class="card w-25 mx-auto mt-5">
              <div class="card-header bg-info text-light text-center text-uppercase">
                  <p class="lead">register</p>
              </div>
              <div class="card-body">
                <form action="action.php" method="post">
                    <div class="form-group">
                        <input type="text" name="fname" placeholder="First Name" class="form-control" required>
                        <input type="text" name="lname" placeholder="Last Name" class="form-control mt-2" required>
                        <input type="email" name="email"  placeholder="Email"class="form-control mt-2" required>
                        <input type="password" name="pword" placeholder="Password" class="form-control mt-2" required>
                        <input type="number" name="pnum" placeholder="Phone Number" class="form-control mt-2" required>
                        <button type="submit" name="register" class="btn btn-secondary btn-block mt-3 w-50 mx-auto">Register</button>
                    </div>
                </form>
              </div>
          </div>
      </div>
      
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  </body>
</html>