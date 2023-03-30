<?php 
include("components/sessionInclude.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Us</title>
    <script src="https://kit.fontawesome.com/ccf160e1e6.js" crossorigin="anonymous"></script>
    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous"> -->
    
    
    <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css"> -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">

   <!-- custom css file link  -->
<style> 
<?php 
include("css/style.css");
include("css/style_israa.css");
include("css/about.css");

?>
</style>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">




</head>
<body>

<!-- ______________start nav bar_________________ -->
<?php include 'components/user_header.php'; ?>

<!-- ______________end nav bar_________________ -->
 
<!-- --------------page start-------------- -->


<section class="about" id="about">
    <div class="container">
        <div class="heading text-center">
            <h2>About
                <span>Us</span></h2>
            <p>Thank you for supporting independent artisans and small businesses by shopping with us. 
                <br>
                Happy browsing!
            </p>
        </div>
        <div class="row">
            <div class="col-lg-6">
                <img src="./uploaded_img/uuuuuuu.avif" alt="about" class="img-fluid" width="100%">
            </div>
            <div class="col-lg-6">
                <h3>Our handmade marketplace</h3><p>We offers a selection of unique items crafted with love and care by artisans, each piece is a work of art,
                    Whether you're looking for a gift or a treat for yourself, you'll find it here, We're sure you'll love it, Happy browsing!</p>
                <div class="row">
                    <div class="col-md-6">
                        <h4>
                            <i class="far fa-star"></i>handmade Product</h4>
                    </div>
                    <div class="col-md-6">
                        <h4>
                            <i class="far fa-star"></i>
                            Creative Product</h4>
                    </div>
                    <div class="col-md-6">
                        <h4>
                            <i class="far fa-star"></i>Better Client Service</h4>
                    </div>
                    <div class="col-md-6">
                        <h4>
                            <i class="far fa-star"></i>
                            Digital Marketing </h4>
                    </div>
                    <div class="col-md-6">
                        <h4>
                            <i class="far fa-star"></i>safty product</h4>
                    </div>
                    <div class="col-md-6">
                        <h4>
                            <i class="far fa-star"></i>
                            Speed And Flexibility</h4>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


<!-- --------------page end-------------- -->





    <!-- ------------------start footer-------------- -->
    <?php include 'components/footer.php'; ?>


    <!-- ------------------End footer-------------- -->



</body>
</html>