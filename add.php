<?php
    

    include('config/db_connect.php');
    
    $email = $name = $ingredients = '';
    $errors = array('email' => '', 'name' => '', 'ingredients' => '');

    if(isset($_POST['submit'])){ //checks if any data has been set through the GET method

        //email validation
        if(empty($_POST['email'])){
            $errors['email'] = 'An email is required <br />';
        }else{
           // echo htmlspecialchars($_POST['email']); //adding function to avoid XSS attacks
           $email = $_POST['email'];
           if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
            $errors['email'] = 'enter an valid email adress';
           }
        }
        //name validation
        if(empty($_POST['name'])){
            $errors['name'] = 'An pizza name is required <br />';
        }else{
            //echo htmlspecialchars($_POST['name']);
            $name = $_POST['name'];
            if(!preg_match('/^[a-zA-Z\s]+$/', $name)){
                $errors['name'] = 'No special characters allowed <br />';
            } 
        }
        //ingredients validation
        if(empty($_POST['ingredients'])){
            $errors['ingredients'] = 'At least one ingredient is required <br />';
        }else{
            //echo htmlspecialchars($_POST['ingredients']); 
            $ingredients = $_POST['ingredients'];
            if(!preg_match('/^([a-zA-Z\s]+)(,\s*[a-zA-Z\s]*)*$/', $ingredients)){
                $errors['ingredients'] = 'No special characters allowed <br />';
            } 
        }

        if(array_filter($errors)){
            //echo 'errors while filling the form';
        } else {
            //echo 'everything ok';
            $email = mysqli_real_escape_string($conection, $_POST['email']);
            $name = mysqli_real_escape_string($conection, $_POST['name']);
            $ingredients = mysqli_real_escape_string($conection, $_POST['ingredients']);

            //query request
            $sql = "INSERT INTO pizzas(pizza_name, pizza_email, pizza_ingredientes) VALUES ('$name', '$email', '$ingredients')";

            //saving into db
            if(mysqli_query($conection, $sql)){
                header('Location: index.php');
            } else {
                echo 'query error: ' . mysqli_error($conection);
            }
        }
    } 

?>

<!DOCTYPE html>
<html lang="en">

    <?php include('templates/header.php'); ?>

    <section class="container grey-text">
        <h4 class="center">Add a pizza</h4>
        <form action="add.php" method='POST' class="white">
            <label>Your email</label>
            <input type="text" name='email' value= '<?php echo htmlspecialchars($email) ?>'>
            <div class="red-text"> <?php echo $errors['email'] ?> </div>
            <label> Pizza name: </label>
            <input type="text" name='name' value= '<?php echo htmlspecialchars($name) ?>'>
            <div class="red-text"> <?php echo $errors['name'] ?> </div>
            <label>Pizza ingredients: </label>
            <input type="text" name='ingredients' value= '<?php echo htmlspecialchars($ingredients) ?>'>
            <div class="red-text"> <?php echo $errors['ingredients'] ?> </div>
            <div class="center">
                <input type="submit" name='submit' value='submit' class='btn brand z-depth-0'>
            </div>
        </form>
    </section>


    <?php include ('templates/footer.php'); ?>

</html>