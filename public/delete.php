<?php 

// this code will only execute after the submit button is clicked

	
    // include the config file that we created before
    require "../config.php"; 
    require "common.php";
// This code will only run if the delete button is clicked
    if (isset($_GET["id"])) {
	    // this is called a try/catch statement 
        try {
            // define database connection
            $connection = new PDO($dsn, $username, $password, $options);
            
            // set id variable
            $id = $_GET["id"];
            
            // Create the SQL 
            $sql = "DELETE FROM works WHERE id = :id";

            // Prepare the SQL
            $statement = $connection->prepare($sql);
            
            // bind the id to the PDO
            $statement->bindValue(':id', $id);
            
            // execute the statement
            $statement->execute();

            // Success message
            $success = "Work successfully deleted";

        } catch(PDOException $error) {
            // if there is an error, tell us what it is
            echo $sql . "<br>" . $error->getMessage();
        }
    };

    // This code runs on page load

    // this is called a try/catch statement 
	try {
        // FIRST: Connect to the database
        $connection = new PDO($dsn, $username, $password, $options);
		
        // SECOND: Create the SQL 
        $sql = "SELECT * FROM works";
        
        // THIRD: Prepare the SQL
        $statement = $connection->prepare($sql);
        $statement->execute();
        
        // FOURTH: Put it into a $result object that we can access in the page
        $result = $statement->fetchAll();

	} catch(PDOException $error) {
        // if there is an error, tell us what it is
		echo $sql . "<br>" . $error->getMessage();
	}	

?>

<?php include "template/header.php"; ?>

<h2>Results</h2>

<?php 
                // This is a loop, which will loop through each result in the array
                foreach($result as $row) { 
            ?>

<p>
    ID:
    <?php echo $row["id"]; ?><br> Artist Name:
    <?php echo $row['artistname']; ?><br> Work Title:
    <?php echo $row['worktitle']; ?><br> Work Date:
    <?php echo $row['workdate']; ?><br> Work type:
    <?php echo $row['worktype']; ?><br>
    
    <a href=delete.php?id=<?php echo $row['id']; ?>'>Delete</a>
</p>
<?php 
                            // this willoutput all the data from the array
                            //echo '<pre>'; var_dump($row); 
                        ?>

<hr>
<?php }; //close the foreach
         
    
?>




<form method="post">

    <input type="submit" name="Submit" value="View all">

</form>



<?php include "template/footer.php"; ?>