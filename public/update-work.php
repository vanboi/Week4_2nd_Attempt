<?php 



	

    // include the config file that we created before

    require "../config.php"; 

    

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



<?php include "templates/header.php"; ?>





<h2>Results</h2>



<!-- This is a loop, which will loop through each result in the array -->

<?php foreach($result as $row) { ?>



<p>

    ID:

    <?php echo $row['id']; ?><br> Artist Name:

    <?php echo $row['artistname']; ?><br> Work Title:

    <?php echo $row['worktitle']; ?><br> Work Date:

    <?php echo $row['workdate']; ?><br> Work type:

    <?php echo $row['worktype']; ?><br>

    <a href='update-work.php?id=<?php echo $row['id']; ?>'>Edit</a>

</p>



<hr>

<?php }; //close the foreach

?>


<?php include "templates/header.php"; ?>





<h2>Results</h2>



<!-- This is a loop, which will loop through each result in the array -->

<?php foreach($result as $row) { ?>



<p>

    ID:

    <?php echo $row['id']; ?><br> Artist Name:

    <?php echo $row['artistname']; ?><br> Work Title:

    <?php echo $row['worktitle']; ?><br> Work Date:

    <?php echo $row['workdate']; ?><br> Work type:

    <?php echo $row['worktype']; ?><br>

    <a href='update-work.php?id=<?php echo $row['id']; ?>'>Edit</a>

</p>



<hr>

<?php }; //close the foreach

?>











<?php include "templates/footer.php"; ?>

    //simple if/else statement to check if the id is available
    if (isset($_GET['id'])) {
        //yes the id exists 
        try {
            // standard db connection
            $connection = new PDO($dsn, $username, $password, $options);
            
            // set if as variable
            $id = $_GET['id'];
            
            //select statement to get the right data
            $sql = "SELECT * FROM works WHERE id = :id";
            
            // prepare the connection
            $statement = $connection->prepare($sql);
            
            //bind the id to the PDO id
            $statement->bindValue(':id', $id);
            
            // now execute the statement
            $statement->execute();
            
            // attach the sql statement to the new work variable so we can access it in the form
            $work = $statement->fetch(PDO::FETCH_ASSOC);
            
        } catch(PDOExcpetion $error) {
            echo $sql . "<br>" . $error->getMessage();
        }
        
        <form method="post">
    
   <label for="id">ID</label>
    <input type="text" name="id" id="id" value="<?php echo escape($work['id']); ?>" >
    
    <label for="artistname">Artist Name</label>
    <input type="text" name="artistname" id="artistname" value="<?php echo escape($work['artistname']); ?>">

    <label for="worktitle">Work Title</label>
    <input type="text" name="worktitle" id="worktitle" value="<?php echo escape($work['worktitle']); ?>">

    <label for="workdate">Work Date</label>
    <input type="text" name="workdate" id="workdate" value="<?php echo escape($work['workdate']); ?>">

    <label for="worktype">Work Type</label>
    <input type="text" name="worktype" id="worktype" value="<?php echo escape($work['worktype']); ?>">
    
    <label for="date">Work Date</label>
    <input type="text" name="date" id="date" value="<?php echo escape($work['date']); ?>">

    <input type="submit" name="submit" value="Save">

</form>


        
        // quickly show the id on the page
        echo $_GET['id'];
        
    } else {
        // no id, show error
        echo "No id - something went wrong";
        //exit;
    }


?>
