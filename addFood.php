
<!-- Insert data into the table -->

<?php include 'connect.php';

    if(isset($_POST['addFood'])){
        $foodName = $_POST['foodName'];
        $foodDescription = $_POST['foodDescription'];
        $foodPrice = $_POST['foodPrice'];
        $foodImage = $_FILES['foodImage']['name'];
        $foodImage_temp_name = $_FILES['foodImage']['tmp_name'];
        $foodImage_folder = 'foodImages/'.$foodImage;

        $insertQuery = mysqli_query($conn, "insert into `salad` (name, description, price, image) values('$foodName', '$foodDescription', '$foodPrice', '$foodImage')")
        or die("Insert failed");
        if($insertQuery){
            move_uploaded_file($foodImage_temp_name, $foodImage_folder);
            $displayMessage = "Food insert successful";
        }
        else {
            $displayMessage = "There is some error inserting product";
        }
    }

?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RestaurantName</title>
    <link rel="stylesheet" href="styleMenu.css">
    <link rel="stylesheet" href="addFood.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
</head>
<body>

   

    <!-- The navigation of the website for the header section -->

    <?php include('header.php') ?>

    <main>
        <!-- Message display -->

        <!-- + Container in which a php message will be displayes and closed -->

        <?php

            if(isset($displayMessage)){
                echo "<section class='displayMessage'>
            <span>$displayMessage</span>
            <i class='fas fa-times' onclick='this.parentElement.style.display=`none`';></i>
        </section>";
            }

        ?>

        <!-- Section with add food form -->

        <section class="addFoodContainer">
            <h3>Add Food</h3>

            <form action="" class="addFoodForm" method="post" enctype="multipart/form-data">
                <input type="text" name="foodName" placeholder="Enter product name" class="inputFields" required>
                <input type="text" name="foodDescription" placeholder="Enter product description" class="inputFields" required>
                <input type="number" name="foodPrice" min="0" placeholder="Enter product price" class="inputFields" required>
                <input type="file" name="foodImage" class="inputFields" required accept="image/png, image/jpg, image/jpeg, image/webp">
                <input type="submit" name="addFood" class="submitButton" value="Add Food">
            </form>

        </section>

    </main>

    <?php include('footer.php') ?>

<script src="script.js" defer></script>
    
</body>
</html>