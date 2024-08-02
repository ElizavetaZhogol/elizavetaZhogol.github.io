<?php include 'connect.php';

    // Update query for item quantity of the cart

    


    // Delete a specific item from the cart

    if(isset($_GET['remove'])){
        $removeId = $_GET['remove'];
        mysqli_query($conn, "Delete from `cart` where id = $removeId");
        header('location:shoppingCart.php');
    }


    if(isset($_GET['deleteAll'])){
        mysqli_query($conn, "Delete from `cart`");
        header('location:shoppingCart.php');
    }



    if(isset($_POST['saladAddtoCart'])){
        $saladName = $_POST['saladName'];
        $saladDescription = $_POST['saladDescription'];
        $saladPrice = $_POST['saladPrice'];
        $saladImage = $_POST['saladImage'];
        $saladQuantity = 1;

        // Select cart data based on condition

        $selectCart = mysqli_query($conn, "Select * from `cart` where name='$saladName'");
        if(mysqli_num_rows($selectCart)>0){
            echo"product already in the cart";
        }
        else{

            // Insert data into cart table

            $insertFood = mysqli_query($conn, "Insert into `cart` (name, description, price, image, quantity)
            values ('$saladName', ' $saladDescription', '$saladPrice', '$saladImage', $saladQuantity)");
        }
    }

?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RestaurantName</title>
    <link rel="stylesheet" href="styleShoppingCart.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
</head>
<body>

    <!-- The navigation of the website for the header section -->

    <?php include('header.php') ?>

    <?php

    if(isset($_POST['updateQuantityButton'])){
        $updateValue = $_POST['updateQuantity'];
        $updateId = $_POST['updateQuantityId'];

        $rowCount = $rowCount + $updateValue;

        $updateQuantityQuery = mysqli_query($conn, "Update `cart` set quantity=$updateValue where id=$updateId");


        if($updateQuantityQuery){
            header('location: shoppingCart.php');
        }

    }

    ?>

    <main>
        <table>

            <!-- Get and display all items in the cart table -->

            <?php

                $selectCartItems = mysqli_query($conn, "Select * from `cart`");
                $num = 1;
                $grandTotal = 0;
                if(mysqli_num_rows($selectCartItems)>0){
                    echo "
                    
            <thead>
                <th>Sl No</th>
                <th>Dish Name</th>
                <th>Dish Image</th>
                <th>Ingredients</th>
                <th>Dish price</th>
                <th>Quantity</th>
                <th>Total Price</th>
                <th>Action</th>
            </thead>
            <tbody>
                    ";

                    while($fetchCartItems = mysqli_fetch_assoc($selectCartItems)){
            
            ?>

                <tr>
                    <td><?php echo $num ?></td>
                    <td><?php echo $fetchCartItems['name'] ?></td>
                    <td>
                        <img src="foodImages/<?php echo $fetchCartItems['image'] ?>" alt="<?php echo $fetchCartItems['name'] ?>" style="width: 200px; height: 200px;">
                    </td>
                    <td><?php echo $fetchCartItems['description'] ?></td>
                    <td><?php echo $fetchCartItems['price'] ?></td>
                    <td>
                        <form action="" method="post">
                            <input type="hidden" value="<?php echo $fetchCartItems['id'] ?>" name="updateQuantityId">
                            <input type="number" min="1" value="<?php echo $fetchCartItems['quantity'] ?>" name="updateQuantity">
                            <input type="submit" value="Update" name="updateQuantityButton">
                        </form>
                    </td>
                    <td><?php echo $subtotal = number_format($fetchCartItems['price'] * $fetchCartItems['quantity']) ?></td>
                    <td>
                        <a href="shoppingCart.php?remove=<?php echo $fetchCartItems['id'] ?>" onclick="return confirm('Are you sure you want to delete this item')"><i class="fas fa-trash"></i>Remove</a>
                    </td>
                </tr>

            <?php
                $grandTotal += ($fetchCartItems['price'] * $fetchCartItems['quantity']);
                $num++;
                    }

                }
                else{
                    echo "
                    
                        <h2>Your cart is empty</h2>
                    
                    ";
                }

            ?>

            </tbody>
        </table>

        <!-- Display the bottom section only when there are products in the cart -->

        <?php

                if($grandTotal > 0){
                    echo "
                     
                        <!-- Bottom area with more action options -->

                        <section class='actionOptions'>
                            <a href='menuAndDelivery.php'>Continue Shopping</a>
                            <a class='checkoutLink' href='checkout.php'>Proceed to checkout</a>
                            <h3>Grand total: <span> $grandTotal </span> &#8364;</h3>
                        </section>                    
                    ";

                    ?>

                    <a href="shoppingCart.php?deleteAll"><i class="fas fa-trash"></i>Clear cart</a>

                    <?php
                }
                else{
                    echo"";
                }

        ?>

    </main>

    <?php include('footer.php') ?>

<script src="script.js" defer></script>

</body>
</html>