<?php

include 'components/connect.php';

session_start();

if(isset($_SESSION['user_id'])){
   $user_id = $_SESSION['user_id'];
}else{
   $user_id = '';
};

if($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['addTOcart'])){

   if($user_id == ''){
      $message[] = 'Your are <span style="color:red">NOT </span> logged in!';
   }else{

   $product_id = $_POST['product_id'];
   $product_name = $_POST['name'];
   $product_price = $_POST['price'];
   $product_image = $_POST['image'];
   $product_quantity = $_POST['quantity'];

   $check_product_id = $conn->prepare("SELECT product_id FROM `cart` WHERE user_id = '$user_id'");
   $check_product_id->execute();
   

   $flag = true;

   while($fetch_product = $check_product_id->fetch(PDO::FETCH_ASSOC)){
      if (in_array($product_id, $fetch_product)){
         $flag = false;
         break;
      }
   };
   if($flag==true){
      if($user_id > 0){
      $send_to_cart = $conn->prepare("INSERT INTO `cart` (user_id , product_id , name , price , image , quantity)
                                    VALUES (? , ? , ? , ?, ? , ?)"); 
      $send_to_cart->execute([$user_id , $product_id , $product_name , $product_price, $product_image, $product_quantity]);

   }else {
      $array_cart = [$product_id , $product_name , $product_price, $product_image, $product_quantity];
      array_push($_SESSION['cart'], $array_cart);
      // echo'<pre>';
      // print_r($_SESSION['cart']);
      // echo'</pre>';
   }
}else{$message[] = 'Your Product <span style="color:red">Already</span> Added To Cart!';}
}
}



if(isset($_POST['add_to_wishlist'])){

   if($user_id == ''){
      $message[] = 'Your are <span style="color:red">NOT </span> logged in!';

      // $flag = true;
      // $pid = $_POST['product_id'];

      // foreach($_SESSION['fav'] as $id){
      //    if (in_array($pid,$id)){
      //       $flag = false;
      //       break;
      //    }
      // };
      // if($flag==true){
      //    $array_fav = [$pid];
      //    array_push($_SESSION['fav'], $array_fav);
         // echo'<pre>';
         // print_r($_SESSION['fav']);
         // echo'</pre>';
      // }

   }else{

      $pid = $_POST['product_id'];


      $check_wishlist_numbers = $conn->prepare("SELECT * FROM `favorite` WHERE product_id = ? AND user_id = ?");
      $check_wishlist_numbers->execute([$pid, $user_id]);

      $check_cart_numbers = $conn->prepare("SELECT * FROM `cart` WHERE product_id = ? AND user_id = ?");
      $check_cart_numbers->execute([$pid, $user_id]);

      if($check_wishlist_numbers->rowCount() > 0){
         $message[] = 'Your Product <span style="color:red">Already</span> Added To Wishlist!';
      }elseif($check_cart_numbers->rowCount() > 0){
         $message[] = 'Your Product <span style="color:red">Already</span> Added To Cart!';
      }else{
         $insert_wishlist = $conn->prepare("INSERT INTO `favorite`(user_id, product_id) VALUES(?,?)");
         $insert_wishlist->execute([$user_id, $pid]);
         $message[] = 'Your Product <span style="color:green">Added</span> To Wishlist!';
      }

   }

}



?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>quick view</title>
   
   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
   <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
   <link rel="icon" type="image/x-icon" href="./images/madein.png">
   <!-- custom css file link  -->
   <!-- <link rel="stylesheet" href="css/style.css"> -->
   <style> 
<?php 
include("css/style.css");
include("css/style_israa.css");
include("css/style_productFilters.css");
?>
</style>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

</head>
<body>
   
<?php include 'components/user_header.php'; ?>

<section class="quick-view">

   <h1 class="heading">quick view</h1>

   <?php
     $pid = $_GET['pid'];
     $select_products = $conn->prepare("SELECT * FROM `products` WHERE product_id = ?"); 
     $select_products->execute([$pid]);
     if($select_products->rowCount() > 0){
      while($fetch_product = $select_products->fetch(PDO::FETCH_ASSOC)){
   ?>
   <form action="" method="post" class="box">
      <input type="hidden" name="product_id" value="<?= $fetch_product['product_id']; ?>">
      <input type="hidden" name="name" value="<?= $fetch_product['name']; ?>">
      <input type="hidden" name="price" value="<?= $fetch_product['price']; ?>">
      <input type="hidden" name="image" value="<?= $fetch_product['image']; ?>">
      <div class="row">
         <div class="image-container">
            <div class="main-image">
               <img src="uploaded_img/<?= $fetch_product['image']; ?>" alt="">
            </div>
         </div>
         <div class="content">
            <div class="name"><?= $fetch_product['name']; ?></div>
            <div class="flex">
            <?php if ($fetch_product['is_sale'] == 1){ ?>

               <div class="price" style="padding:7px 0px"><span><del style="text-decoration:line-through; color:silver">$<?= $fetch_product['price']; ?></del><ins style="color:rgb(0, 0, 69) !important;"> $<?=$fetch_product['price_discount'];?></ins> </span></div>

               <?php } else { ?>

               <div class="name" style="color:rgb(0, 0, 69) !important; padding:20px 0px">$<?= $fetch_product['price']; ?></div> <?php } ?>

               <?php if (($fetch_product['store']-$fetch_product['sold']) != '1'){?>



               <input style="margin-left: 160px ;" type="number" name="quantity" class="qty" min="1" max="<?= $fetch_product['store']-$fetch_product['sold'];?>" value="1">

               <?php } else { ?>
               <input type="hidden" name="quantity" value="1">
               <?php } ?> 

            </div>
            <div class="details"><?= $fetch_product['details']; ?></div>
            <div class="flex-btn">
               <input type="submit" value="add to cart" class="btn" name="addTOcart">
               <input class="option-btn" type="submit" name="add_to_wishlist" value="add to wishlist">
            </div>
         </div>
      </div>
   </form>
   <?php
      }
   }else{
      echo '<p class="empty">no products added yet!</p>';
   }
   ?>

</section>

<section class="quick-view">

   <h1 class="heading">Product Comments</h1>



        <?php

        //   ADD COMMENT


        $query = "SELECT * FROM review INNER JOIN users 
                ON (review.user_id = users.user_id) WHERE product_id = ? ";
                $stmt = $conn->prepare($query);
                $stmt->execute([$pid]); ?>

                  <section style="background-color:rgb(0, 0, 69) ;">

  <div class="container my-5 py-5">
    <div class="row d-flex justify-content-center">
      <div class="col-md-12 col-lg-12">
        <div class="card text-dark">
          <div class="card-body p-4">
            <h4 class="mb-0" style="font-size: 25px;">Recent comments</h4>

            <?php while ($comment = $stmt->fetch()) {
            $comment_id = $comment['review_id'];
            $product_id = $comment['product_id'];
            $comment_date = $comment['review_date'];
            $comment_content = $comment['review_text'];
            $user_name = $comment['name'];
            ?>
            <div class="card-body p-4">
            <div class="d-flex flex-start">
              <div>
                <h6 class="fw-bold mb-1" style="font-size: 14px;"><?php echo $user_name ?></h6>
                <div class="d-flex align-items-center mb-3">
                  <p class="mb-0" style="font-size: 12px;">
                  <?php echo $comment_date ?>
                  </p>
                </div>
                <p class="mb-0" style="font-size: 20px;">
                <?php echo  $comment_content; ?>
                </p>
            
              </div>
            </div>
          </div>

          <hr class="my-0" style="border: 1px solid gray;"/><?php } ?>
        </div>
      </div>
    </div>
  </div>
</section>


      
         <?php if (isset($_POST['comment_text'])) {
            if (isset($_SESSION['user_id'])) {
               $comment_text = $_POST['comment_text'];
               $sqlInserComment = "INSERT INTO review (user_id,product_id,review_text,review_date) 
               VALUES ('$user_id','$pid','$comment_text ',NOW())";
               $stmt = $conn->query($sqlInserComment);
               // header("location:./quick_view.php?pid=$pid");
               echo "<script>window.location='./quick_view.php?pid=$pid'</script>";
            }
         }
         // if (!$stmt->execute([$pid])) {
         //    echo "NO";
         // }
         ?>



         <?php
         if(isset($_SESSION['user_id'])){ ?>
            <form action="" method="post">
            <div >
               <div >
                  <textarea style="width:1110px;font-size:20px; border:2px solid silver"  class="form-control" name="comment_text" cols="12"  rows="3" placeholder="Add your comment" value=""></textarea>
               </div>
            </div>
            <div class="col-md-12 text-right">
               <input type="submit" name="submit_comment" value="Submit Now" class="btn submit_btn" style="background-color:#C6861A ; font-size : 20px;">

                  <!-- Submit Now -->
               <!-- </button> -->
            </div>
            </form>

         <?php } echo "<br>"; echo "<br>"?> 



</section>


<?php include 'components/footer.php'; ?>

<script src="js/script.js"></script>

</body>
</html>