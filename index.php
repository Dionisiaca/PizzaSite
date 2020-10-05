<?php

    include('config/db_connect.php');


    //Write query for all pizzas

    $sql = 'SELECT pizza_name, pizza_ingredientes, pizza_id FROM pizzas ORDER BY created_at';

    //get result
    $result = mysqli_query($conection, $sql);

    //fetch the results as an array
    $pizzas = mysqli_fetch_all($result, MYSQLI_ASSOC);

    //free result from memory
    mysqli_free_result($result);

    //close connection
    mysqli_close($conection);
    //print_r($pizzas);
?>

<!DOCTYPE html>
<html lang="en">

    <?php include('templates/header.php'); ?>
    <h4 class="center grey-text">Pizzas! Pizzas! Pizzas!</h4>
    <div class="container">
        <div class="row">
            <?php foreach($pizzas as $pizza): ?>
                <div class="col s6 md3">
                    <div class="card z-depth-0">
                        <img src="img/pizza.svg" class="pizza">
                        <div class="card-content center">
                            <h6> <?php echo htmlspecialchars($pizza['pizza_name']); ?> </h6>
                            <ul>
                                <?php foreach(explode(',', $pizza['pizza_ingredientes']) as $ingredient): ?>
                                    <li> <?php  echo htmlspecialchars($ingredient) ?></li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                        <div class='card-action right-align'>
                            <a href="details.php?id=<?php echo $pizza['pizza_id']?>" class="brand-text">More info</a>
                        </div>
                    </div>
                </div>
            <?php endforeach;  ?>
        </div>
    </div>
    <?php include ('templates/footer.php'); ?>

</html>