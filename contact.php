<?php
include('dbcon.php');
include('header.php');


?>

<html>
<body>
<head lang="en">
<title>Hotel Management</title>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
        integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"
        integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"
        integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">
    </script>
</head>
    <div class="contact-container">

        <div class="contact1">
            <div class="contact-symbol">
                <i class="fas fa-hamburger">Hotel VENICE</i>
            </div>
            <div class="book-h1">
                <h1>BOOK YOUR <br> HOTEL TODAY</h1>
            </div>
            <div class="book-p">
                <p>Hotels.com Customer Care Number, Contact Address, Email Id. Hotels.com is an <br> Indian Most Popular
                    Online Hotel Booking Platforms. Many Indian’s looking for the contact.</p>
            </div>

            <div class="location">
                <i class="fas fa-map-marker-alt"></i> <br>
                21 JACKSON BLVD 120 <br> LOS ANGELES
            </div>
            <div class="facebook">
                <i class="fab fa-facebook"></i>
                <i class="fab fa-instagram"></i>
                <i class="fab fa-twitter-square"></i>
                <i class="fab fa-youtube"></i>
            </div>
            <div class="website">
                <p>www.restaurentms.com</p>
            </div>
        </div>
        <div class="contact2">
                <section id="contact" class="contact">
                    <div class="container aos-init aos-animate" data-aos="fade-up">

                        <div class="section-header mb-5">
                        <p style="text-align: center;">Need Help? <span>Contact Us</span></p>
                        </div>

                        <div class="mb-3">
                        <iframe style="border:0; width: 100%; height: 350px;" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d238132.63727384945!2d72.68220738859044!3d21.15946270544973!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3be04e59411d1563%3A0xfe4558290938b042!2sSurat%2C%20Gujarat%2C%20India!5e0!3m2!1sen!2sus!4v1680100092361!5m2!1sen!2sus" frameborder="0" allowfullscreen=""></iframe>
                        </div><!-- End Google Maps -->

                        <div class="row gy-4">

                        <div class="col-md-6 mb-2">
                            <div class="info-item  d-flex align-items-center">
                            <i class="icon bi bi-map flex-shrink-0"></i>
                            <div>
                                <h3>Our Address</h3>
                                <p>A108 Adam Street, New York, NY 535022</p>
                            </div>
                            </div>
                        </div><!-- End Info Item -->

                        <div class="col-md-6  mb-2">
                            <div class="info-item d-flex align-items-center">
                            <i class="icon bi bi-envelope flex-shrink-0"></i>
                            <div>
                                <h3>Email Us</h3>
                                <p>contact@example.com</p>
                            </div>
                            </div>
                        </div><!-- End Info Item -->

                        <div class="col-md-6  mb-2">
                            <div class="info-item  d-flex align-items-center">
                            <i class="icon bi bi-telephone flex-shrink-0"></i>
                            <div>
                                <h3>Call Us</h3>
                                <p>+1 5589 55488 55</p>
                            </div>
                            </div>
                        </div><!-- End Info Item -->

                        <div class="col-md-6  mb-2">
                            <div class="info-item  d-flex align-items-center">
                            <i class="icon bi bi-share flex-shrink-0"></i>
                            <div>
                                <h3>Opening Hours</h3>
                                <div><strong>Mon-Sat:</strong> 11AM - 23PM;
                                <strong>Sunday:</strong> Closed
                                </div>
                            </div>
                            </div>
                        </div><!-- End Info Item -->

                        </div>

                        <form action="contact.php" method="post" role="form" class="php-email-form p-3 p-md-4" id="myform">
                        <?php
                        
                            if(isset($_POST['submit']))
                            {
                                if((isset($_POST['email']) && $_POST['email'] != null) && (isset($_POST['name']) && $_POST['name'] != null))
                                {
                            
                                    $con_name=$_POST['name'];
                                    $con_email=$_POST['email'];
                                    $con_mobile=$_POST['phone'];
                                    $con_address=$_POST['address'];
                                    $con_message=$_POST['message'];

                                    $qry="INSERT INTO contact(name,email,mobile,address,message) VALUES ('$con_name','$con_email','$con_mobile','$con_address','$con_message')";

                                    $run=mysqli_query($sql,$qry);
                                    if($run)
                                    {
                                        $_POST['name'] = null;
                                        $_POST['email']= null;
                                        $_POST['phone']= null;
                                        $_POST['address']= null;
                                        $_POST['message']= null;

                                        // echo "<script> alert('Thanks For Contacting Us'); </script>";
                                        ?>



                                        <!-- <script> 
                                        $('#name').val('');
                                        $('#email').val('');
                                        $('#phone').val('');
                                        $('#address').val('');
                                        $('#message').val('');
                                        
                                        alert('Thanks For Contacting Us'); </script> -->
                                        
                                        <?php
                                    }
                            
                                }
                            }
                        
                        ?>
                        <div class="row">
                            <div class="col-xl-6 form-group">
                                 <input type="text" name="name" class="form-control" id="name" placeholder="Your Name"  required="">
                            </div>
                            <div class="col-xl-6 form-group">
                                <input type="email" class="form-control" name="email" id="email" placeholder="Your Email"required="">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xl-6 form-group">
                                 <input type="text" name="phone" class="form-control" id="phone" placeholder="Your Phone Number" pattern="[0-9]{10}" required="">
                            </div>
                            <div class="col-xl-6 form-group">
                                <input type="text" class="form-control" name="address" id="address" placeholder="Your Address" required="">
                            </div>
                        </div>
                
                        <div class="form-group">
                            <textarea class="form-control" name="message" id="message" rows="5" placeholder="Message" required="" spellcheck="false"></textarea>
                        </div>
                        
                        <div class="text-center"><button id="submit" type="button" data-toggle="modal" data-target="#saved" name="x" class="enter">Submit</button></div>
                        </form><!--End Contact Form -->
                </div>
                <?php
                    include('footer.php');
                ?>
            </section>
               
        </div>

    </div>
    
    
                        <div class="modal fade" id="saved" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
                            aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        Thanks for contacting us.
                                    </div>
                                    <div class="modal-footer">
                                        <button form="myform" type="submit" class="btn btn-secondary" name="submit">Close</button>
                                    </div>
                                </div>
                            </div>
                        </div>

</body>
</html>


