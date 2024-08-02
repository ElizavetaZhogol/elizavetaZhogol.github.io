
<?php include 'connect.php'; ?>

<?php require("sendOrder.php"); ?>

<?php require("configCheckout.php"); ?>


<?php

    if(isset($_POST['sendOrder'])){

        $response = sendMail($email, $subject, $message);

    if($response == "Success"){
        echo "<script>alert('Email sent successfully!');</script>";

        mysqli_query($conn, "Delete from `cart`");
        header('location:index.php');

    }
    else{
        echo "<script>alert('Email not sent. Please try again!');</script>";
    }

}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RestaurantName</title>
    <link rel="stylesheet" href="checkout.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
</head>
<body>

    <!-- The navigation of the website for the header section -->

    <?php include('header.php') ?>

    <main>


        <h2>Contact us</h2>

        <section class="contactContainer">
            <form method="post" action="" enctype="multipart/form-data">
                <div>
                    <label for="name">Name</label>
                    <br>
                    <input type="text" name="name" id="name" required placeholder="Enter your name...">
                </div>

                <br>

                <div>
                    <label for="email">Email</label>
                    <br>
                    <input type="text" name="email" id="email" required placeholder="Enter your email address...">
                </div>

                <br>

                <div>
                    <label for="phone">Enter your phone number:</label>
                    <br>
                    <input type="tel" id="phone" name="phone" >
                </div>

                <br>

                <div class="messageContainer">
                    <label for="address">Address</label>
                    <br>
                    <textarea name="address" id="address" placeholder="Enter your address..."></textarea>
                </div>

                <br>

                <div class="formButtons">
                    <button>Clear</button>
                    <button type="submit" name="sendOrder">Send order</button>
                </div>
            </form>
                
        </section>

    </main>

<!-- The footer section of the website  -->

<?php include('footer.php') ?>

<script src="script.js" defer></script>