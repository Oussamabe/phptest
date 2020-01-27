<?php
	$host_name="localhost";
	$database_name="test";
	$user_name="root";
	$password="";
try{
	$conn = new PDO("mysql:host=$host_name;dbname=$database_name", $user_name, $password);
	echo "Connexion, OK!";
}
catch(Exception $e){
 	die ($e->getMessage());
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" 
    integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>
<body>
 
<!-- container -->
<div class="container">
  
  <div class="page-header">
      <h1>list client</h1>
  </div>

  <?php
 




// delete message prompt will be here

// select all data
$query = "SELECT *  FROM client";
$stmt = $conn->prepare($query);
$stmt->execute();

$num = $stmt->rowCount();


// link to create record form
echo "<a href='create.php' class='btn btn-primary m-b-1em'>new client</a>";

//check if more than 0 record found
if($num>0){

echo "<table class='table table-hover table-responsive table-bordered'>";//start table

//creating our table heading
echo "<tr>";
  echo "<th>ID</th>";
  echo "<th>nom</th>";
  echo "<th>prenom</th>";
  echo "<th>age</th>";
 
echo "</tr>";

// retrieve our table contents
// fetch() is faster than fetchAll()
// http://stackoverflow.com/questions/2770630/pdofetchall-vs-pdofetch-in-a-loop
while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
// extract row
// this will make $row['firstname'] to
// just $firstname only
extract($row);

// creating new table row per record
echo "<tr>";
  echo "<td>{$id}</td>";
  echo "<td>{$nom}</td>";
  echo "<td>{$prenom}</td>";
  echo "<td>&#36;{$age}</td>";
  echo "<td>";
      // read one record 
      echo "<a href='readone.php?id={$id}' class='btn btn-info m-r-1em'>Read</a>";
       
      // we will use this links on next part of this post
      echo "<a href='update.php?id={$id}' class='btn btn-primary m-r-1em'>Edit</a>";

      // we will use this links on next part of this post
      echo "<a href='#' onclick='delete_user({$id});'  class='btn btn-danger'>Delete</a>";
  echo "</td>";
echo "</tr>";
}

// end table
echo "</table>";
// PAGINATION
// count total number of rows
/*$query = "SELECT COUNT(*) as total_rows FROM products";
$stmt = $conn->prepare($query);*/

// execute query
$stmt->execute();

// get total rows
/*$row = $stmt->fetch(PDO::FETCH_ASSOC);
$total_rows = $row['total_rows']; */   
}

// if no records found
else{
echo "<div class='alert alert-danger'>No records found.</div>";
}
?>
   
</div> <!-- end .container -->




    
</body>
</html>