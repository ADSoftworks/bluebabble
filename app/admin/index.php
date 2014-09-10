<?php
require_once("../../config.php");

if($_SESSION["username"] != "100002580408386")
    die("No panel for you.");

if(isset($_POST["addbottles"])) {

    global $link;
    $sql = "UPDATE accounts SET bottles = bottles + 10;";
    $statement = $link->prepare($sql);
    $statement->execute();

} else if(isset($_POST["get_all_accounts"])) {
    
    global $link;
    $sql = "SELECT * FROM accounts";
    $statement = $link->prepare($sql);
    $statement->execute();
    $result = $statement->fetchAll(PDO::FETCH_ASSOC);
    $statement->closeCursor();
    
    $_SESSION["admin_output"] = print_r($result);
    
}

?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <h1>(Very beautiful) admin panel!</h1>
        <form action="<?php htmlentities($_SERVER['PHP_SELF']); ?>" method="POST">
            <input type="submit" name="addbottles" value="Add 10 bottles to all accounts" />
            <input type="submit" name="get_all_accounts" value="Print all accounts" />
        </form>
        <?php if(isset($_SESSION["admin_output"])) {
            echo $_SESSION["admin_output"]; 
            $_SESSION["admin_output"] = null;
        }
        ?>
    </body>
</html>
