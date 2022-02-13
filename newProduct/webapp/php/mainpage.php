
<?php
include_once("../dbconnect.php");
$sqlproduct = "SELECT * FROM tbl_lab3 ORDER BY dateCreated DESC";
$stmt = $conn->prepare($sqlproduct);
$stmt->execute();
$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
$rows = $stmt->fetchAll();

$results_per_page = 4;

if (isset($_GET['pageno']))
{
    $pageno = (int)$_GET['pageno'];
    $page_first_result = ($pageno - 1) * $results_per_page;
}
else
{
    $pageno = 1;
    $page_first_result = 0;
}

$stmt = $conn->prepare($sqlproduct);
$stmt->execute();
$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
$rows = $stmt->fetchAll();
$number_of_result = $stmt->rowCount();
$number_of_page = ceil($number_of_result / $results_per_page);
$sqlproduct = $sqlproduct . " LIMIT $page_first_result , $results_per_page";
$stmt = $conn->prepare($sqlproduct);
$stmt->execute();
$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
$rows = $stmt->fetchAll();

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css">
    <link rel="stylesheet" type="text/css" href="../style/style.css">
    <script src="../javascript/script.js"></script>
<title>Home Page</title>
</head>

<body>

<!-- Sidebar -->
<div class="w3-sidebar w3-bar-block w3-border-right" style="display:none" id="mySidebar">
  <button onclick="w3_close()" class="w3-bar-item w3-large">Close &times;</button>
  <a href=login.php class="w3-bar-item w3-button">Login</a>
  <a href=mainpage.php class="w3-bar-item w3-button">Products</a>
  <a href=newitem.php class="w3-bar-item w3-button">New Products</a>
  <a href=load_carthistory.php class="w3-bar-item w3-button">Cart</a>
  <a href="#" class="w3-bar-item w3-button">Payment</a>
  <a href="#" class="w3-bar-item w3-button">Logout</a>
</div>

<!-- Page Content -->
<div class="w3-teal">
  <button class="w3-button w3-teal w3-xlarge" onclick="w3_open()">☰</button>
  <div class="w3-header w3-container w3-teal w3-padding-32 w3-center">
  <h1 style="font-size:calc(8px + 4vw) ;">D'Shah Homemix Bundle</h1>
  <p style="font-size:calc(8px + 1vw);;">Buy more, cut more</p>
  </div>
</div>
     
     </div>



<div class="w3-grid-template">
<?php
foreach($rows as $item){
    $title = $item['title'];
    $description = $item['description'];
    $color = $item['color'];
    $price = $item['price'];
    $state = $item['state'];
    echo "<div class='w3-center w3-padding'>";
    echo "<div class='w3-card-4 w3-pale-green'>";
    echo "<header class='w3-container w3-teal'>";
    echo "<h5>$title</h5>";
    echo "</header>";
    echo "<img class='w3-image' src=../res/images/$title.png" . " onerror=this.onerror=null;this.src='../res/images/home.png'" . " style='width:100%;height:250px'>";
    echo "<div class='w3-container w3-left-align'><hr>";
    echo "
    <i class='fa fa-info icon' style='font-size 20px;'>  Description: </i> <br> &nbsp&nbsp$description<br>
    <i class='fa fa-info icon' style='font-size 20px;'>  Color: </i> <br> &nbsp&nbsp$color<br>
    <i class='fa fa-dollar icon' style='font-size 20px;'>  Price: </i> <br> &nbsp&nbsp$price<br>
    <i class='fa fa-location-arrow icon' style='font-size 20px;'>  Import from: </i><br>  &nbsp&nbsp$state<br>
    <br>
    <a href=http://localhost/newProduct/webapp/php/details.php>Details</a>
    <a href=http://localhost/newProduct/webapp/php/view_cart.php><p><button>Add to Cart</button></a></p>


    </p><hr>";
    
    echo "</div>";
    echo "</div>";
    echo "</div>";

}
?>
</div>


<?php
    $num = 1;
    if ($pageno == 1) {
        $num = 1;
    } else if ($pageno == 2) {
        $num = ($num) + $results_per_page;
    } else {
        $num = $pageno * $results_per_page - 9;
    }
    echo "<div class='w3-container w3-row'>";
    echo "<center>";
    for ($page = 1; $page <= $number_of_page; $page++) {
        echo '<a href = "mainpage.php?pageno=' . $page . '" style=
        "text-decoration: none">&nbsp&nbsp' . $page . ' </a>';
    }
    echo " ( " . $pageno . " )";
    echo "</center>";
    echo "</div>";
    ?>
    
     <footer class="w3-footer w3-center w3-teal">
       <p>D'Shah Homemix Bundle</p>
       <script>function w3_open(){
        document.getElementById("mySidebar").style.display = "block";
        }

        function w3_close(){
            document.getElementById("mySidebar").style.display = "none";
        }</script>
    </footer>


</body>

</html>