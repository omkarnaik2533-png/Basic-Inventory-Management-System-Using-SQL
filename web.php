<!DOCTYPE html>
<html>
<head>
  <title>Simple Inventory</title>
  <style>
    body {
      font-family: Arial;
      padding: 20px;
      background: #f5f5f5;
    }
    h1 { text-align: center; }

    input {
      padding: 8px;
      margin: 5px;
    }

    button {
      padding: 8px 12px;
      cursor: pointer;
    }

    table {
      width: 100%;
      margin-top: 20px;
      border-collapse: collapse;
      background: white;
    }

    th, td {
      border: 1px solid #ccc;
      padding: 10px;
      text-align: center;
    }

    th {
      background: #eee;
    }
  </style>
</head>
<body>

<h1>Inventory Management</h1>


  <form method="POST" >
  <input id="name" placeholder="Product Name" name="Prod">
  <input id="qty" type="number" placeholder="Quantity" name="qtyy">
  <input id="price" type="number" placeholder="Price " name="price">
  <input type="submit"  value="Add" name="add" > 
  <input type="submit"  value="Order" name="order" > 



  
</form>

<form method="GET" style="text-align: right; margin-top: -35px;">
  <select name="sort">
    <option value="asc">Quantity: Low → High</option>
    <option value="desc">Quantity: High → Low</option>
  </select>
  <button type="submit">Sort</button>
</form>


  


<?php

$con = mysqli_connect("localhost","root","2533","inventory");

if(isset($_POST["add"]))
  {
    $name1=$_POST["Prod"];
    $quty=$_POST["qtyy"];
    $price1=$_POST["price"];

    $query= "INSERT INTO products(name1,quantity,price) values('$name1','$quty','$price1')";
    $execute=mysqli_query($con,$query);
  }



 

  if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
} else {
    echo "Database connected successfully!";
}


if(isset($_POST['update'])) {
    $id = $_POST['id'];
    $quantity = (int)$_POST['quantity'];

    
    if($quantity < 0) $quantity = 0;

   
    $query1 = "UPDATE products SET quantity = $quantity WHERE id = $id";
    mysqli_query($con, $query1);

   
    header("Location: " . $_SERVER['PHP_SELF']);
    exit;
}

if(isset($_POST['Del'])) {
    $id = $_POST['id'];
    $query2 = "DELETE FROM products WHERE id = $id";
    mysqli_query($con, $query2);

    
    header("Location: " . $_SERVER['PHP_SELF']);
    exit;
}





$result = mysqli_query($con, "SELECT * FROM products");



echo "<table>";
echo "<tr><th>ID</th><th>Name</th><th>Quantity</th><th>Price</th><th>Action</th></tr>";
$sort = "ASC"; 

if(isset($_GET['sort'])) {
    if($_GET['sort'] == "desc") {
        $sort = "DESC";
    } else {
        $sort = "ASC";
    }
}

$query3 = "SELECT * FROM products ORDER BY quantity $sort";
$result = mysqli_query($con, $query3);
while($row = mysqli_fetch_assoc($result)) {
    echo "<tr>";
    echo "<td>".$row['id']."</td>";
    echo "<td> ".$row['name1']."  </td>"  ;
    echo "<td>".$row['quantity']."</td>";
    echo "<td>".$row['price']."</td>";
    echo "<td>
            <form method='POST'>
                <input type='hidden' name='id' value='".$row['id']."'>
                <input type='number' name='quantity' value='".$row['quantity']."' min='0'><button type='submit' name='update'>Update Quantity</button>
        </td>";
    echo "<td>
                <button type='submit' name='Del'>Delete</button>
            </form>
        </td>";
    echo "</tr>";
}
echo "</table>";








mysqli_close($con);



?>

</body>
</html>