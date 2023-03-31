<?php

include 'components/connect.php';

session_start();

if(isset($_SESSION['user_id'])){
   $user_id = $_SESSION['user_id'];
}else{
   $user_id = '';
};


if($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['addTOcart'])){
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
}
}


if(isset($_POST['add_to_wishlist'])){

   if($user_id == ''){

      $flag = true;
      $pid = $_POST['product_id'];

      foreach($_SESSION['fav'] as $id){
         if (in_array($pid,$id)){
            $flag = false;
            break;
         }
      };
      if($flag==true){
         $array_fav = [$pid];
         array_push($_SESSION['fav'], $array_fav);
         // echo'<pre>';
         // print_r($_SESSION['fav']);
         // echo'</pre>';
      }

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
   <title>Products</title>
   
   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
   <link rel="icon" type="image/x-icon" href="./images/madein.png">

   

   <!-- custom css file link  -->
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


<!-- products -->
<div class="product-section">

<h1 class="heading">Our products</h1>

		<div class="container">

		<div class="row">
		<div class="col-md-12">


</div>


			<div class="row product-lists">
			<?php					
					// $sql = "SELECT * FROM `products` WHERE category_id=" . $_GET['cat_id'];
					$sql = "SELECT * FROM `products`";
					$select_products= $conn->query($sql);
					foreach($select_products as $product){
					?>

							<form action="" method="post" class="col-lg-4 col-md-6 text-center <?= $product['category_id']; ?>">
							<input type="hidden" name="product_id" value="<?= $product['product_id']; ?>">
				            <input type="hidden" name="name" value="<?= $product['name']; ?>">
							<?php 
										if ($product['is_sale'] == 1){
										?>
										<input type="hidden" name="price" value="<?=$product['price_discount'];?>">
										<?php
										} else {
										?>
										<input type="hidden" name="price" value="<?=$product['price'];?>">
										<?php
										}
										?>
										<input type="hidden" name="image" value="<?= $product['image']; ?>">
								<div class="single-product-item">
									<div class="product-image">
										<a href="quick_view.php?pid=<?= $product['product_id']; ?>">
										<img width=200px height=200px src='./uploaded_img/<?= $product['image']; ?>' alt="">
										</a>
										<h2 STYLE="font-size:27px"><?= $product['name']; ?></h2>
										
										<button class="fas fa-heart" type="submit" name="add_to_wishlist"></button>
										<a href="quick_view.php?pid=<?= $product['product_id']; ?>" class="fas fa-eye"></a>
												
										<?php if ($product['is_sale'] == 1){ ?>

										<div class="price" style="padding:0px 0px"><span><del style="text-decoration:line-through; color:silver">$<?= $product['price']; ?></del><ins style="color:rgb(0, 0, 69) !important;;"> $<?=$product['price_discount'];?></ins> </span></div>

										<?php } else { ?>

										<div class="name" style="color:rgb(0, 0, 69) !important; padding:0px 0px">$<?= $product['price']; ?></div> <?php } ?>

										<?php if (($product['store']-$product['sold']) != '1'){?>

										<input style="margin-left: 160px ;" type="number" name="quantity" class="qty" min="1" max="<?= $product['store']-$product['sold'];?>" value="1">

										<?php } else { ?>
										<input type="hidden" name="quantity" value="1">
										<?php } ?> 

										<button type="submit" class="btn" name="addTOcart"><i class="fas fa-shopping-cart"></i> Add to Cart</button>
										
										
										<!-- <a href="add_to_cart.php?productid=<?= $product['product_id']; ?>" class="cart-btn"> <SPAN STYLE="font-size:16pt">Add to Cart</SPAN> </a>					 -->

										<?php
											// if ($_SERVER['REQUEST_METHOD']=="POST") {
											//  $_SESSION["added_products"] = [];
											// 	// $added_product = [$product["product_id"],$_POST["qun"],$product["product_name"],$product["description"],$product["model_year"],$product["brand"],$product["price"],$product["category_id"],$product["pic_main"],$product["rate"],$product["in_stock"],$product["is_discount"],$product["discount"]];
											// 	// $added_product = array($_POST["selected_prod"]);
											// 	$added_product = unserialize($_POST["selected_prod"]);
											// 	// print_r($added_product);
											// 	// if (! isset($_SESSION["added_products"])){
											// 	// $_SESSION["added_products"] = [];
											// 	// }
											// 	array_push($_SESSION["added_products"],$added_product);
											// 	print_r($_SESSION["added_products"]);
											// }
										?>
									</div>
								</div>
						</form>
					<?php
					}
					?>
				
			</div>

			<!-- <div class="row">
				<div class="col-lg-12 text-center">
					<div class="pagination-wrap">
						<ul>
							<li><a href="#">Prev</a></li>
							<li><a class="active" href="#">1</a></li>
							<li><a href="#">2</a></li>
							<li><a href="#">3</a></li>
							<li><a href="#">Next</a></li>
						</ul>
					</div>
				</div>
			</div> -->
		</div>
	</div>
	<!-- end products -->



<?php include 'components/footer.php'; ?>

<!-- <script src="js/script.js"></script> -->
	<!-- jquery -->
	<script src="js2/jquery-1.11.3.min.js"></script>
	<!-- bootstrap -->
	<!-- <script src="js2/bootstrap.min.js"></script> -->
	<!-- count down -->
	<!-- <script src="js2/jquery.countdown.js"></script> -->
	<!-- isotope -->
	<script src="js2/jquery.isotope-3.0.6.min.js"></script>
	<!-- waypoints -->
	<!-- <script src="js2/waypoints.js"></script> -->
	<!-- owl carousel -->
	<script src="js2/owl.carousel.min.js"></script>
	<!-- magnific popup -->
	<!-- <script src="js2/jquery.magnific-popup.min.js"></script> -->
	<!-- mean menu -->
	<!-- <script src="js2/jquery.meanmenu.min.js"></script> -->
	<!-- sticker js -->
	<!-- <script src="js2/sticker.js"></script> -->
	<!-- main js -->
	<script src="js2/main.js"></script>

<script>
	       // projects filters isotop
		//    $(".product-filters li").on('click', function () {
            
        //     $(".product-filters li").removeClass("active");
        //     $(this).addClass("active");

            // var selector = $3.attr('data-filter');

            // $(".product-lists").isotope({
            //     filter: selector,
            // });
            
        // });



</script>



</body>
</html>