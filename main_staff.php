<!doctype html>
<html lang="en">

<head>
  <title>main</title>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <link rel="stylesheet" href="css/style.css">

  <script src="https://kit.fontawesome.com/eb83b1af77.js" crossorigin="anonymous">
    9
  </script>
</head>

<body class="main_staff">
  <div id="bg">
    <img src="img/background.jpg" style="height: 100vh;" alt="background">
  </div>
  <?php
  include 'menu_staff.php';

  if(empty($_SESSION['login_id'])){
    echo "<script>window.location.href='signin.php'</script>";
  }
  
  if($userAccess['status'] == 'U'){
    echo "<script>window.location.href='main_customer.php'</script>";
  }

  ?>
  <div class="container-fluid">

  </div>
    <div class="fixed-bottom">
    <?php
    include 'footer.php';

    ?>
    </div>
  <!-- Optional JavaScript -->
  <!-- jQuery first, then Popper.js, then Bootstrap JS -->
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>

</html>