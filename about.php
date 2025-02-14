<?php
include('header.php');
?>


                    <div class="container">
                    <br/><br/>
            		<h2><b> ABOUT US:</b></h2>
                    <h3>About Online GiftKart</h3>
                    
                    <p style="text-align:justify;">At GiftKart, we aim to revolutionize the way people shop for gifts by providing a seamless and enjoyable online shopping experience. GiftKart is a modern e-commerce platform that allows customers to buy gifts for every occasion directly through a web browser or mobile app. Whether you're celebrating a birthday, anniversary, festival, or any special moment, we ensure you find the perfect gift at the click of a button.

Online shopping has become an integral part of modern life, enabling consumers to explore a wide range of products from the comfort of their homes. Our platform showcases an extensive collection of gift items, neatly categorized for easy navigation, and comes equipped with powerful search functionality to compare prices, availability, and features.

In today's fast-paced world, people shop using a variety of devices, including desktop computers, laptops, tablets, and smartphones. GiftKart is designed to adapt to these trends, offering a responsive design that works flawlessly across all devices. We integrate the latest technologies and features, such as secure payment gateways, social login options, and personalized recommendations, to ensure a smooth and secure shopping experience.

GiftKart is more than just a platform—it's a partner in making your special moments unforgettable. By combining convenience, variety, and security, we strive to be the ultimate destination for all your gifting needs.

                    </p><br>


            
            	</div>


                <?php 


include("connection.php");
if(isset($_POST["message_submit"]))
{
    $name=$_POST['name'];
    $email=$_POST['email'];
    $message=$_POST['message'];

    $insert="insert into messages(name,email,message) values ('$name','$email', '$message')";

    if ($con->query($insert) === TRUE) {
     echo "<script>alert('Message Sent Successfully')</script>";
    echo "<script>window.open('contact.php','_self')</script>";
    
  } else {
      echo "Error: " . $insert . "<br>" . $con->error;
  }
}




?>


<div class="wrapper " style="background-color: white">
                <div class="content " style="background-color: white">
                    <div class="container a1 ">
                        <div class="col-md-3">
                            
                        </div>
                        <div class="col-md-7 pannel" style="margin-top: 20px">
                           <h1>Message</h1>

                           <form action="" method="POST">
                            <input type="text" name="name" placeholder="Name" style="width:100%;height: 42px"><br><br>
                            <input type="text" name="email" placeholder="Example@gmail.com" style="width:100%;height: 42px"><br><br>
                            <input type="text" style="width:100%;height: 140px" name="message">
                                
                            <br><br>
                            <input type="submit" name="message_submit" style="color: black">
                            </form>

                        </div>
                    </div>

                </div>
                </div>
                

                </footer>
                <?php
                include('footer.php');

                ?>