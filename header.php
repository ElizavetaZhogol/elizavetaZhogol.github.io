<header>

        <!-- Get the number of rows in the cart table -->

        <?php include('connect.php');

            $selectCartNumber = mysqli_query($conn, "Select sum(quantity) as total from `cart`") or die('query failed');
            $fetchQuantityCart = mysqli_fetch_assoc($selectCartNumber);
            $allQuantityCart = $fetchQuantityCart['total'];
            
        ?>

        <nav class="mainNavigation">
            <ul>
                <li class="logo"><a href="index.php">Home</a></li>
                <li><a href="index.php">Home</a></li>
                <li class="dropDownMenu"><a href="menuAndDelivery.php"><p>Menu</p> <p>and</p> <p>Delivery</p></a><i class="fa-solid fa-chevron-down fa-sm dropDownArrow" id="dropDownArrow" style="color: #ffffff;"></i></li>
                <ul class="subMenu">
                        <li><a href="">Fish</a></li>
                        <li><a href="">Meat</a></li>
                        <li><a href="">Vegan</a></li>
                    </ul>
                <li><a href="contact.php">Contact</a></li>
                <li class ="cart"><a href="shoppingCart.php"><i class="fas fa-shopping-cart "></i> <span style="color: red;">
                    <?php 

                        if($allQuantityCart == 0){
                            echo 0;
                        }
                        else {
                            echo "$allQuantityCart";
                        }

                    ?>
                </span></a></li>
            </ul>
        </nav>


        <nav class="hamNavigation">
            <div class="ham-menu">
                <span></span>
                <span></span>
                <span></span>
            </div>
            <ul>
                <li class="logo"><a href="index.php">Home</a></li>
                <li class ="cart"><a href="shoppingCart.php"><i class="fas fa-shopping-cart "></i> <span style="color: red;">
                    <?php 

                         if($allQuantityCart == 0){
                            echo 0;
                        }
                        else {
                            echo "$allQuantityCart";
                        }
                        
                    ?>
                </span></a></li>
            </ul>
        </nav>

        <div class="off-screen-menu">
        <ul>
                <li><a href="index.php">Home</a></li>
                <li class="dropDownMenuOffScreen"><a href="menuAndDelivery.php"><p>Menu</p> <p>and</p> <p>Delivery</p></a><i class="fa-solid fa-chevron-down fa-sm dropDownArrowOffScreen" id="dropDownArrowOffScreen" style="color: #ffffff;"></i></li>
                <ul class="subMenuOffScreen">
                    <li><a href="">Fish</a></li>
                    <li><a href="">Meat</a></li>
                    <li><a href="">Vegan</a></li>
                </ul>
                <li><a href="contact.php">Contact</a></li>
                <li><a href="addFood.php">Add Food</a></li>
                <li><a href="viewFood.php">View Food</a></li>
            </ul>
        </div>
    </header>