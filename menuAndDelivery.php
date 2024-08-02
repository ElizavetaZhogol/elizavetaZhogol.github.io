<?php include 'connect.php';

    if(isset($_POST['saladAddtoCart'])){
        $saladName = $_POST['saladName'];
        $saladDescription = $_POST['saladDescription'];
        $saladPrice = $_POST['saladPrice'];
        $saladImage = $_POST['saladImage'];
        $saladQuantity = 1;
        $quantityVisible = 0;

        // Select cart data based on condition

        $selectCart = mysqli_query($conn, "Select * from `cart` where name='$saladName'");
        if(mysqli_num_rows($selectCart)<1){  
            // Insert data into cart table

            $insertFood = mysqli_query($conn, "Insert into `cart` (name, description, price, image, quantity)
            values ('$saladName', ' $saladDescription', '$saladPrice', '$saladImage', $saladQuantity)");         
            $quantityVisible = 1;
        }
        
        if(mysqli_num_rows($selectCart)>0){
            $selctQuantity = mysqli_query($conn, "Select quantity from `cart` where name='$saladName'");
            $fetchSelectQuantity = mysqli_fetch_assoc($selctQuantity);
            $quantityVisible = $fetchSelectQuantity['quantity'];
            $quantityVisible = $quantityVisible + 1;
            $updateQuantityQuery = mysqli_query($conn, "Update `cart` set quantity=$quantityVisible where name='$saladName'");
        }
    }


    // Delte from cart or decrease quantity

    if(isset($_POST['saladDeleteFromCart'])){
        $saladName = $_POST['saladName'];
        $saladDescription = $_POST['saladDescription'];
        $saladPrice = $_POST['saladPrice'];
        $saladImage = $_POST['saladImage'];
        $saladQuantity = 1;
        $quantityVisible = 0;

        // Select cart data based on condition

        $selectCart = mysqli_query($conn, "Select * from `cart` where name='$saladName'");

        $selctQuantity = mysqli_query($conn, "Select quantity from `cart` where name='$saladName'");
        $fetchSelectQuantity = mysqli_fetch_assoc($selctQuantity);
        $quantityVisible = $fetchSelectQuantity['quantity'];
        
        if($quantityVisible > 1){
            $quantityVisible = $quantityVisible - 1;
            $updateQuantityQuery = mysqli_query($conn, "Update `cart` set quantity=$quantityVisible where name='$saladName'");
        }

        if($quantityVisible == 1){  
            
            // Delete from cart table

            mysqli_query($conn, "Delete from `cart` where name='$saladName'");
            $quantityVisible = 0;
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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
</head>
<body>

    <!-- The navigation of the website for the header section -->

    <?php include('header.php') ?>

    <main>

        <!-- A slider with the sections of the menu that will transport a use to a desired dish type -->

        <section class="wrapper">
            <i id="leftArrow" class="fa-solid fa-circle-chevron-left fa-3x slideButton" style="color: #000000;"></i>
            <ul class="carousel">
                <li class="card card1">
                    <h4>Salad</h4>
                    <h6>See on the menu<i class="fa-solid fa-arrow-right" style="color: #ffffff;"></i></h6>
                </li>

                <li class="card card2">
                    <h4>Pizza</h4>
                    <h6>See on the menu<i class="fa-solid fa-arrow-right" style="color: #ffffff;"></i><br></h6>
                </li>

                <li class="card card3">
                    <h4>Pasta</h4>
                    <h6>See on the menu<i class="fa-solid fa-arrow-right" style="color: #ffffff;"></i></h6>
                </li>

                <li class="card card1">
                    <h4>Salad</h4>
                    <h6>See on the menu<i class="fa-solid fa-arrow-right" style="color: #ffffff;"></i></h6>
                </li>

                <li class="card card2">
                    <h4>Pizza</h4>
                    <h6>See on the menu<i class="fa-solid fa-arrow-right" style="color: #ffffff;"></i><br></h6>
                </li>

                <li class="card card3">
                    <h4>Pasta</h4>
                    <h6>See on the menu<i class="fa-solid fa-arrow-right" style="color: #ffffff;"></i></h6>
                </li>
            </ul>
            <i id="rightArrow" class="fa-solid fa-circle-chevron-right fa-3x slideButton" style="color: #000000;"></i>
        </section>

        <script>
            // Get the carousel and the arrows
            const carousel = document.querySelector('.carousel');
            const leftArrow = document.getElementById('leftArrow');
            const rightArrow = document.getElementById('rightArrow');

            // Get the width of the carousel
            const carouselWidth = carousel.offsetWidth;

            // Get the number of cards
            const cards = document.querySelectorAll('.card');
            const numCards = cards.length;

            // Set the current index
            let currentIndex = 0;

            // Function to move the carousel to the left
            function moveLeft() {
                if (currentIndex > 0) {
                    currentIndex--;
                    carousel.scrollLeft -= carouselWidth / 3;
                }
            }

            // Function to move the carousel to the right
            function moveRight() {
                if (currentIndex < numCards - 3) {
                    currentIndex++;
                    carousel.scrollLeft += carouselWidth / 3;
                }
            }

            // Add event listeners to the arrows
            leftArrow.addEventListener('click', moveLeft);
            rightArrow.addEventListener('click', moveRight);
        </script>

        <!-- The menu part of the website where people can both see what’s on the menu and add items to the shopping cart  -->

        <section class="saladHeader">
            <h2>Salad</h2>
        </section>

        <section class="saladWrapper">
            <ul class="saladCarousel">

                    <?php
                
                        $selectFood = mysqli_query($conn, "Select * from `salad`");
                        if(mysqli_num_rows($selectFood)>0){
                            while($fetchFood=mysqli_fetch_assoc($selectFood)){

                                // Set quantity in the cart for each item

                                $saladName = $fetchFood['name'];

                                $selctQuantity = mysqli_query($conn, "Select quantity from `cart` where name='$saladName'");
                                if(mysqli_num_rows($selctQuantity)<1){
                                    $quantityVisible = 0;
                                }
                                if(mysqli_num_rows($selctQuantity)>0){
                                    $fetchSelectQuantity = mysqli_fetch_assoc($selctQuantity);
                                    $quantityVisible = $fetchSelectQuantity['quantity'];  
                                }
                                  
                    ?>

                <li class="saladCard saladCard1">
                    <form action="" method="post">

                        <!-- An image of the dish -->

                        <figure>
                            <img src="foodImages/<?php echo $fetchFood['image'] ?>" alt="<?php echo $fetchFood['name'] ?>" style="width: 400px; height: 400px;"/>
                        </figure>

                        <!-- A dish name and the ingredients  -->

                        <h4><?php echo $fetchFood['name'] ?></h4>
                        <p>Ingredients:  <?php echo $fetchFood['description'] ?></p> 

                        <!-- The price and shopping cart button to add items to the wish list -->

                        <section class="priceAndQuantity">
                            <span class="price">Price: <b><?php echo $fetchFood['price'] ?> &#8364;</b></span>
                            <section>
                                <input type="hidden" name="saladName" value="<?php echo $fetchFood['name'] ?>">
                                <input type="hidden" name="saladDescription" value="<?php echo $fetchFood['description'] ?>">
                                <input type="hidden" name="saladPrice" value="<?php echo $fetchFood['price'] ?>">
                                <input type="hidden" name="saladImage" value="<?php echo $fetchFood['image'] ?>">
                                <button type="submit" name="saladDeleteFromCart"><i class="fa-solid fa-cart-shopping" style="color: #000000;"></i> <span>-</span></button>


                                <input type="text" min="0" value="<?php echo $quantityVisible ?>">


                                <button type="submit" name="saladAddtoCart"><i class="fa-solid fa-cart-shopping" style="color: #000000;"></i> <span>+</span></button>
                            </section>
                        </section>
                    </form>
                </li>

                    <?php
                            }
                        }
                        else{
                            echo"no products";
                        }

                    ?>
            </ul>
        </section>

        <section class="saladHeader">
            <h2>Pizza</h2>
        </section>

        <section class="saladWrapper">
            <ul class="saladCarousel">
                <li class="saladCard saladCard1">
                    <figure>
                        <img src="ImagesForRestaurant/greekSalad.webp" alt="restaurantWorker" style="width: 400px; height: 400px;"/>
                    </figure> 
                    <h4>Greek Salad</h4>
                    <p>Ingredients:  sliced cucumbers, tomatoes, green bell pepper, red onion, olives, and feta cheese</p> 
                    <section class="priceAndQuantity">
                        <span class="price">Price: <b>31,99 &#8364;</b></span>
                        <section>
                            <button type="button"><i class="fa-solid fa-cart-shopping" style="color: #000000;"></i> <span>-</span></button>
                            <input type="text" min="0" value="0">
                            <button type="button"><i class="fa-solid fa-cart-shopping" style="color: #000000;"></i> <span>+</span></button>
                        </section>
                    </section>
                </li>

                <li class="saladCard saladCard2">
                    <figure>
                        <img src="ImagesForRestaurant/caesarSalad.webp" alt="restaurantWorker" style="width: 400px; height: 400px;"/>
                    </figure> 
                    <h4>Greek Salad</h4>
                    <p>Ingredients:  sliced cucumbers, tomatoes, green bell pepper, red onion, olives, and feta cheese</p> 
                    <section class="priceAndQuantity">
                        <span class="price">Price: <b>31,99 &#8364;</b></span>
                        <section>
                            <button type="button"><i class="fa-solid fa-cart-shopping" style="color: #000000;"></i> <span>-</span></button>
                            <input type="text" min="0" value="0">
                            <button type="button"><i class="fa-solid fa-cart-shopping" style="color: #000000;"></i> <span>+</span></button>
                        </section>
                    </section> 
                </li>

                <li class="saladCard saladCard3">
                    <figure>
                        <img src="ImagesForRestaurant/capreseSalad.webp" alt="restaurantWorker" style="width: 400px; height: 400px;"/>
                    </figure> 
                    <h4>Greek Salad</h4>
                    <p>Ingredients:  sliced cucumbers, tomatoes, green bell pepper, red onion, olives, and feta cheese</p> 
                    <section class="priceAndQuantity">
                        <span class="price">Price: <b>31,99 &#8364;</b></span>
                        <section>
                            <button type="button"><i class="fa-solid fa-cart-shopping" style="color: #000000;"></i> <span>-</span></button>
                            <input type="text" min="0" value="0">
                            <button type="button"><i class="fa-solid fa-cart-shopping" style="color: #000000;"></i> <span>+</span></button>
                        </section>
                    </section> 
                </li>

                <li class="saladCard saladCard1">
                    <figure>
                        <img src="ImagesForRestaurant/greekSalad.webp" alt="restaurantWorker" style="width: 400px; height: 400px;"/>
                    </figure> 
                    <h4>Greek Salad</h4>
                    <p>Ingredients:  sliced cucumbers, tomatoes, green bell pepper, red onion, olives, and feta cheese</p> 
                    <section class="priceAndQuantity">
                        <span class="price">Price: <b>31,99 &#8364;</b></span>
                        <section>
                            <button type="button"><i class="fa-solid fa-cart-shopping" style="color: #000000;"></i> <span>-</span></button>
                            <input type="text" min="0" value="0">
                            <button type="button"><i class="fa-solid fa-cart-shopping" style="color: #000000;"></i> <span>+</span></button>
                        </section>
                    </section>
                </li>

                <li class="saladCard saladCard2">
                    <figure>
                        <img src="ImagesForRestaurant/caesarSalad.webp" alt="restaurantWorker" style="width: 400px; height: 400px;"/>
                    </figure> 
                    <h4>Greek Salad</h4>
                    <p>Ingredients:  sliced cucumbers, tomatoes, green bell pepper, red onion, olives, and feta cheese</p> 
                    <section class="priceAndQuantity">
                        <span class="price">Price: <b>31,99 &#8364;</b></span>
                        <section>
                            <button type="button"><i class="fa-solid fa-cart-shopping" style="color: #000000;"></i> <span>-</span></button>
                            <input type="text" min="0" value="0">
                            <button type="button"><i class="fa-solid fa-cart-shopping" style="color: #000000;"></i> <span>+</span></button>
                        </section>
                    </section> 
                </li>

                <li class="saladCard saladCard3">
                    <figure>
                        <img src="ImagesForRestaurant/capreseSalad.webp" alt="restaurantWorker" style="width: 400px; height: 400px;"/>
                    </figure> 
                    <h4>Greek Salad</h4>
                    <p>Ingredients:  sliced cucumbers, tomatoes, green bell pepper, red onion, olives, and feta cheese</p> 
                    <section class="priceAndQuantity">
                        <span class="price">Price: <b>31,99 &#8364;</b></span>
                        <section>
                            <button type="button"><i class="fa-solid fa-cart-shopping" style="color: #000000;"></i> <span>-</span></button>
                            <input type="text" min="0" value="0">
                            <button type="button"><i class="fa-solid fa-cart-shopping" style="color: #000000;"></i> <span>+</span></button>
                        </section>
                    </section> 
                </li>
            </ul>
        </section>

    </main>

     <!-- The footer section of the website  -->

    <?php include('footer.php') ?>

    <script src="script.js" defer></script>

</body>
</html>