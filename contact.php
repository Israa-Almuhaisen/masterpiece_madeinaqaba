<?php 
include("components/sessionInclude.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact</title>
    <script src="https://kit.fontawesome.com/ccf160e1e6.js" crossorigin="anonymous"></script>
    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous"> -->
    
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    
    <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css"> -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">

   <!-- custom css file link  -->
<style> 
<?php 
include("css/contact.css");
include("css/style.css");
include("css/style_israa.css");
?>
</style>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">



</head>
<body>

<!-- ______________start nav bar_________________ -->
<?php include 'components/user_header.php'; ?>

<!-- ______________end nav bar_________________ -->
 
<!-- --------------page start-------------- -->


<section class="contact-page-section">
    <div class="container">
        <div class="sec-title">
              <h2>Let's Get in Touch.</h2>
          </div>
          <div class="inner-container">
            <div class="row clearfix">
              
                <!--Form Column-->
                  <div class="form-column col-md-8 col-sm-12 col-xs-12">
                    <div class="inner-column">
                        
                          <!--Contact Form-->
                          <div class="contact-form">
                              <form method="post" action="sendemail.php" id="contact-form">
                                  <div class="row clearfix">
                                      <div class="form-group col-md-6 col-sm-6 co-xs-12">
                                          <input type="text" name="name" value="" placeholder="Name" required>
                                      </div>
                                      <div class="form-group col-md-6 col-sm-6 co-xs-12">
                                          <input type="email" name="email" value="" placeholder="Email" required>
                                      </div>
                                      <div class="form-group col-md-6 col-sm-6 co-xs-12">
                                          <input type="text" name="subject" value="" placeholder="Subject" required>
                                      </div>
                                      <div class="form-group col-md-6 col-sm-6 co-xs-12">
                                          <input type="text" name="phone" value="" placeholder="Phone" required>
                                      </div>
                                      <div class="form-group col-md-12 col-sm-12 co-xs-12">
                                          <textarea name="message" placeholder="Massage"></textarea>
                                      </div>
                                      <div class="form-group col-md-12 col-sm-12 co-xs-12">
                                          <button type="submit" class="theme-btn btn-style-one">Send Now</button>
                                      </div>
                                  </div>
                              </form>
                          </div>
                          <!--End Contact Form-->
                          
                      </div>
                  </div>
                  
                  <!--Info Column-->
                  <div class="info-column col-md-4 col-sm-12 col-xs-12">
                    <div class="inner-column">
                        <h2>Contact Info</h2>
                          <ul class="list-info">
                            <li><i class="fas fa-globe"></i>Jordan,Aqaba.</li>
                              <li><i class="far fa-envelope"></i>handmade@gmail.com</li>
                              <li><i class="fas fa-phone"></i>0777222777 <br> 0777111777</li>
                          </ul>
                          <ul class="social-icon-four">
                              <li class="follow">Follow on: </li>
                              <li><a href="#"><i class="fab fa-facebook-f"></i></a></li>
                              <li><a href="#"><i class="fa-brands fa-square-snapchat"></i></a></li>
                          </ul>
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