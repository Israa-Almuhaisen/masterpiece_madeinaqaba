<?php

include 'components/connect.php';

session_start();

if(isset($_SESSION['user_id'])){
   $user_id = $_SESSION['user_id'];
}else{
   $user_id = '';
};

if(isset($_POST['submit'])){

   $email = $_POST['email'];
   $email =  htmlspecialchars($email, ENT_QUOTES);
   $pass = $_POST['pass'];
   $pass = htmlspecialchars($pass, ENT_QUOTES);


   $select_user = $conn->prepare("SELECT * FROM `users` WHERE email = ? AND password = ?");
   $select_user->execute([$email, $pass]);
   $row = $select_user->fetch(PDO::FETCH_ASSOC);

   if($select_user->rowCount() > 0){
      $_SESSION['user_id'] = $row['user_id'];
      $_SESSION['email'] = $row['email'];
      $_SESSION['name']= $row['name'];
      header('location:home.php');
   }else{
      $message[] = '<span style="color:red">Incorrect</span> Username Or Password!';
   }
   $message[] = 'login...';
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>


    <script src="https://kit.fontawesome.com/ccf160e1e6.js" crossorigin="anonymous"></script>
    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous"> -->
    
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    
    <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css"> -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">

    <style> 
<?php 
include("css/style.css");
include("css/style_israa.css");
include("login.css");
?>
</style>

</head>
<body>

<?php include 'components/user_header.php'; ?>
<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script> -->
<!-- ______________end nav bar_________________ -->


    <div class="cont explore">
      <div class="form sign-in">
        <h2>Welcome back,</h2>
        <form action="" method="post">
        <label>
          <span>Email</span>
          <input type="email" name="email"  />
        </label>
        <label>
          <span>Password</span>
          <input type="password" name="pass" />
        </label>
        <!-- <p class="forgot-pass">Forgot password?</p> -->
        <button type="submit" name="submit" class="btn btn-lg explorebtn">Sign In</button>
        
        <!-- <button type="button" class="fb-btn">Connect with <span>facebook</span></button> -->
        </form>
      </div>
      <div class="sub-cont">
        <div class="img">
          <div class="img__text m--up">
            <h2>New here?</h2>
            <p>Sign up and Discover the beauty and creativity of handmade product!<h3>If You Don’t Have an Account</h3></p>
          </div>
          <div class="img__text m--in">
            <h2>One of us?</h2>
            <p>If you already have an account, just sign in. Explore a new product!</p>
          </div>
          <div class="img__btn">
            <span class="m--up">Sign Up</span>
            <span class="m--in">Sign In</span>
          </div>
        </div>
        <div class="form sign-up">
          <h2>Time to feel like home,</h2>
          <form  action="" method="post">
              <label>
                <!-- <span>Name</span> -->
                <input placeholder="Name"  type="text" />
              </label>
              <label>
                <!-- <span>Email</span> -->
                <input placeholder="email address" type="email" />
              </label>
              <label>
                <!-- <span>Phone Number</span> -->
                <input placeholder="Phone Number" type="text" />
              </label>
              <label>
                <!-- <span>Password</span> -->
                <input placeholder="Password" type="password" />
              </label>
              <label>
                <!-- <span>Confirm Password</span> -->
                <input placeholder="Confirm Password" type="password" />
              </label>
              <p>&nbsp;</p>
              <button type="button" class="btn btn-lg explorebtn">Sign Up</button>
              <!-- <button type="button" class="fb-btn">Join with <span>facebook</span></button> -->
          </form>
        </div>
      </div>
    </div>


    <!-- ------------------start footer-------------- -->

    <?php include 'components/footer.php'; ?>


    <!-- ------------------End footer-------------- -->
    
      <script src="./login.js"></script>
      <!-- <script> 
          document.querySelector('.cont').classList.toggle('s--signup');
      </script> -->
      <?php
        $registerValue = $_GET['register'] ?? ''; // Assign the value of $_GET['register'] to $registerValue, or an empty string if it's not set
      ?>
      <script>
        var register = "<?php echo $registerValue; ?>"; // Output the value of $registerValue as a JavaScript string variable
        if (register === '1') { // Use the register variable in a JavaScript condition
          document.querySelector('.cont').classList.toggle('s--signup');
        }
      </script>
</body>
</html>