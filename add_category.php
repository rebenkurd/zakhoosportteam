
<?php

include './config.php';

if(!isset($_SESSION['username'])){
    header('location:login.php');
}

$success = "";
$error = "";

if(isset($_POST['add'])) {

    $name = $_POST['name'];

    if(empty($name)) {
        $error = "Name fields are required.";
    }else{

    $query = "INSERT INTO category (name) VALUES ('$name')";
    $result = $conn->query( $query);

    if($result) {
        $success = "Category inserted successfully.";
    } else {
        $error = "Error inserting Category.";
    }
    }

}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Category</title>
    <link rel="stylesheet" href="./assets/css/bootstrap.min.css">
</head>
<body>
    

<div class="container">
<?php include './navbar.php';?>

    <h1>Add Category</h1>
    
   <?php include './message.php';?>


    <div class="row  mt-5 ">
        <div class="card p-3 col-12 mb-2 shadow">
            <h2>Add Category</h2>
            
            <form method="post" action="add_category.php">
                <div class="col-12 mb-2">
                    <label for="name" class="form-label">Category Name</label>
                    <input type="text" class="form-control" id="name" name="name">
                </div>

                <div class="col-12">
                    <button type="submit" class="btn btn-primary" name="add">Add Category</button>
                </div>

            </form>
        </div>
    </div>
</div>


<script src="./assets/js/bootstrap.bundle.min.js"></script>
</body>
</html>