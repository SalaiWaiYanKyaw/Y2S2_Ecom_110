<?php
require_once "dbconnect.php";
if (!isset($_SESSION)) {
    session_start();
}
if (isset($_GET['eid'])) {
    //echo "edit button clicked";
    $productID = $_GET['eid'];
    try
    {
        $sql = "";
    }
    catch(PDOException $e)
    {

    }
} else if (isset($_GET['did'])) {
    try {
        //echo"delete button clicked";
        $productID = $_GET['did'];
        $sql = "delete from products where productID=?";
        $stmt = $conn->prepare($sql); //prevent sql injection attack using prepare
        $status = $stmt->execute([$productID]);
        if ($status) {
            $_SESSION['deleteSuccess'] = "Product ID $productID hsa been deleted.";
            header("Location:viewProduct.php");
        }
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
}
