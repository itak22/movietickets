<?php
include 'classes/Functions.php';

?>

<header id="home" class="bg-dark text-light">  
    <nav class="navbar navbar-expand float-right">
        <ul class="nav navbar-nav">
            <li class="nav-item">
                <button type="button" class="btn btn-outline-light ml-2 mt-2" data-toggle="modal" data-target="#exampleModal" style="font-size: 12px">SIGN IN</button>
            </li> 
            <li class="nav-item">
                <button type="button" class="btn btn-outline-light ml-2 mt-2" data-toggle="modal" data-target="#exampleModal2" style="font-size: 12px">REGISTER</button>
            </li>
        </ul>
    </nav>
    <nav class="navbar navbar-dark">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarToggleExternalContent">
            <span class="navbar-toggler-icon"></span>
        </button>
        <ul class="nav navbar-nav">
            <li class="nav-item float-left">
                <a href="index.php" class="text-light text-decoration-none"><span>T</span>ak<span>T</span>ickets <div>.com</div></a>
            </li>
        </ul>
    </nav>
    <div class="pos-f-t">
        <div class="collapse" id="navbarToggleExternalContent">
            <div class="bg-dark p-4">
                <h5 class="text-white h4">Collapsed content</h5>
                <span class="text-muted">Toggleable via the navbar brand.</span>
            </div>
        </div>
    </div>
</header>

<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-danger" id="exampleModalLabel">SIGN IN</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="action.php" method="post">
                    <div class="form-group w-75 mx-auto">
                        <input type="email" name="email"  placeholder="Email"class="form-control mt-2" required>
                        <input type="password" name="pword" placeholder="Password" class="form-control mt-2" required>
                        <button type="submit" name="signin" class="btn btn-danger btn-block mt-3 w-25 mx-auto">Sign In</button>
                    </div>
                </form>
                <a href="" class="float-right" data-dismiss="modal" data-toggle="modal" data-target="#exampleModal2">Register</a>
                <p>Don't have an account?</p>
                <a href="" class="float-right" data-dismiss="modal" data-toggle="modal" data-target="#exampleModal3">Change Password</a> 
                <p>Forgot Password?</p>    
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="exampleModal2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-danger" id="exampleModalLabel">REGISTER</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="action.php" method="post">
                    <div class="form-group w-75 mx-auto">
                        <input type="text" name="fname" placeholder="First Name" class="form-control" required>
                        <input type="text" name="lname" placeholder="Last Name" class="form-control mt-2" required>
                        <input type="email" name="email"  placeholder="Email"class="form-control mt-2" required>
                        <input type="password" name="pword" placeholder="Password" class="form-control mt-2" required>
                        <input type="number" name="pnum" placeholder="Phone Number" class="form-control mt-2" required>
                        <input type="checkbox" name="" id="" class="mt-2" required>
                        <label for="">I agree</label>
                        <button type="submit" name="register" class="btn btn-danger btn-block mt-3 w-25 mx-auto">Register</button>
                    </div>
                </form>
                <a href="" class="float-right" data-dismiss="modal" data-toggle="modal" data-target="#exampleModal">Sign In</a>
                <p>Already have an account?</p>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="exampleModal3" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-danger" id="exampleModalLabel">Change Password</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="action.php" method="post">
                    <div class="form-group w-75 mx-auto">
                        <input type="text" name="fname" placeholder="First Name" class="form-control" required>
                        <input type="text" name="lname" placeholder="Last Name" class="form-control mt-2" required>
                        <input type="email" name="email"  placeholder="Email"class="form-control mt-2" required>
                        <input type="number" name="pnum" placeholder="Phone Number" class="form-control mt-2" required>
                        <input type="password" name="pword1" placeholder="New Password" class="form-control mt-4" required>
                        <input type="password" name="pword2" placeholder="Comfirm Password" class="form-control mt-2" required>
                        <button type="submit" name="editPass" class="btn btn-danger btn-block mt-3 w-25 mx-auto">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>