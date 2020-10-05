  
<?php 

    include("config/db_connect.php");

    //Deleting function

    if(isset($_POST['delete'])){

		$id_to_delete = mysqli_real_escape_string($conection, $_POST['id_to_delete']);

		$sql = "DELETE FROM pizzas WHERE pizza_id = $id_to_delete";

		if(mysqli_query($conection, $sql)){
			header('Location: index.php');
		} else {
			echo 'query error: '. mysqli_error($conection);
		}

	}


    // check GET request id param
    if(isset($_GET["id"])){
        
        // escape sql chars
        $id = mysqli_real_escape_string($conection, $_GET["id"]);

        // make sql
        $sql = "SELECT * FROM pizzas WHERE pizza_id = $id";

        // get the query result
        $result = mysqli_query($conection, $sql);

        // fetch result in array format
        $pizza = mysqli_fetch_assoc($result);

        mysqli_free_result($result);
        mysqli_close($conection);
    }

?>

<!DOCTYPE html>
<html>

<?php include('templates/header.php'); ?>

<div class="container center">
    <?php if($pizza): ?>
        <h4><?php echo $pizza['pizza_name']; ?></h4>
        <p>Created by <?php echo $pizza['pizza_email']; ?></p>
        <p><?php echo date($pizza['created_at']); ?></p>
        <h5>Ingredients:</h5>
        <p><?php echo $pizza['pizza_ingredientes']; ?></p>

        <form action="details.php" method="POST">
				<input type="hidden" name="id_to_delete" value="<?php echo $pizza['pizza_id']; ?>">
				<input type="submit" name="delete" value="Delete" class="btn brand z-depth-0">
		</form>

    <?php else: ?>
        <h5>No such pizza exists.</h5>
    <?php endif; ?>
</div>

<?php include('templates/footer.php'); ?>

</html>