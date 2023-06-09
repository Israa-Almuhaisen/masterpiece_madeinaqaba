<?php
   if(isset($message)){
      foreach($message as $message){
         echo '
         <div class="message" style="background-color:silver !important;">
            <span style="color: black !important; font-weight:bold"> Notice : '.$message.'</span>
            <i class="fas fa-times" onclick="this.parentElement.remove();"></i>
         </div>
         ';
      }
   }


?>

<header class="header" >

   <section class="flex">

   <a href="home.php" class="logo"><img src="uploaded_img/madein.png" style="width: 90px; height:80px;" alt="0"></a>

      <nav class="navbar">
         <a href="home.php">Home</a>
         <a href="products.php?cat_id=*">Products</a>
         <a href="sale.php">Sale</a>
         <a href="about.php">About</a>
         <a href="contact.php">Contact</a>
      </nav>

      <div class="icons">
      <a href="orders.php">My Orders</a>

         <?php
            $count_wishlist_items = $conn->prepare("SELECT * FROM `favorite` WHERE user_id = ?");
            $count_wishlist_items->execute([$user_id]);
            $total_wishlist_counts = $count_wishlist_items->rowCount();

            $count_cart_items = $conn->prepare("SELECT * FROM `cart` WHERE user_id = ?");
            $count_cart_items->execute([$user_id]);
            $total_cart_counts = $count_cart_items->rowCount();
         ?>
         <div id="menu-btn" class="fas fa-bars"></div>
         <?php
            if(isset($_SESSION['user_id'])){ ?>
               <a href="wishlist.php"><i class="fas fa-heart"></i><span>(<?= $total_wishlist_counts; ?>)</span></a>
               <a href="cart.php"><i class="fas fa-shopping-cart"></i><span>(<?= $total_cart_counts; ?>)</span></a>
            <?php
            }else{ ?>
               <a href="wishlist.php"><i class="fas fa-heart"></i><span>(<?= count($_SESSION['fav']); ?>)</span></a>
               <a href="cart.php"><i class="fas fa-shopping-cart"></i><span>(<?= count($_SESSION['cart']); ?>)</span></a>
            <?php }; ?>
         
         <div id="user-btn" class="fas fa-user"></div>
         <span id="nameeeeeee" style="cursor:default;"> <?php if(!empty($_SESSION['email'])){  echo strtoupper($_SESSION['name']);}  ?></span>

      <div class="profile">
         <?php          
            $select_profile = $conn->prepare("SELECT * FROM `users` WHERE user_id = ?");
            $select_profile->execute([$user_id]);
            if($select_profile->rowCount() > 0){
            $fetch_profile = $select_profile->fetch(PDO::FETCH_ASSOC);
         ?>
         <p><?= $fetch_profile["name"]; ?></p>
         <a href="update_user.php" class="btn">update profile</a>
         <div class="flex-btn">
            
         </div>
         <!-- <a href="components/user_logout.php" class="delete-btn" onclick="return confirm('logout from the website?');">logout</a>  -->
         <a href="components/user_logout.php" class="delete-btn">logout</a> 
         <?php
            }else{
         ?>
         <p>please login or register first!</p>
         <div class="flex-btn">
            <a href="login.php?register=1" class="option-btn">register</a>
            <a href="login.php" class="option-btn">login</a>
         </div>
         <?php
            }
         ?>      
         
         
      </div>

   </section>

</header>