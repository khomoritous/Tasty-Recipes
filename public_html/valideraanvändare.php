<?php
/*** begin our session ***/
session_start();/*** first check that both the username, password and form token have been sent ***/

if(!isset( $_POST['tasty_username'], $_POST['tasty_password'], $_POST['form_token'])) {
    $message = 'Please enter a valid username and password';
}
/*** check the form token is valid ***/
elseif( $_POST['form_token'] != $_SESSION['form_token']) {
    $message = 'Invalid form submission';
}
/*** check the username is the correct length ***/
elseif (strlen( $_POST['tasty_username']) > 20 || strlen($_POST['tasty_username']) < 4) {
    $message = 'Incorrect Length for Username';
}
/*** check the password is the correct length ***/
elseif (strlen( $_POST['tasty_password']) > 20 || strlen($_POST['tasty_password']) < 4) {
    $message = 'Incorrect Length for Password';
}
/*** check the username has only alpha numeric characters ***/
elseif (ctype_alnum($_POST['tasty_username']) != true) {
    /*** if there is no match ***/
    $message = "Username must be alpha numeric";
}
/*** check the password has only alpha numeric characters ***/
elseif (ctype_alnum($_POST['tasty_password']) != true) {
        /*** if there is no match ***/
        $message = "Password must be alpha numeric";
}
else {
    /*** if we are here the data is valid and we can insert it into database ***/
    $tasty_username = filter_var($_POST['tasty_username'], FILTER_SANITIZE_STRING);
    $tasty_password = filter_var($_POST['tasty_password'], FILTER_SANITIZE_STRING);/*** now we can encrypt the password ***/
    $tasty_password = sha1( $tasty_password );/*** connect to database ***/
    /*** mysql hostname ***/
    $mysql_hostname = 'localhost';/*** mysql username ***/
    $mysql_username = 'root';/*** mysql password ***/
    $mysql_password = 'admin';/*** database name ***/
    $mysql_dbname = 'tastyrecipe';

    try {
        $dbh = new PDO("mysql:host=$mysql_hostname;dbname=$mysql_dbname", $mysql_username, $mysql_password);
        /*** $message = a message saying we have connected ***/

        /*** set the error mode to excptions ***/

        $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);/*** prepare the insert ***/
        $stmt = $dbh->prepare("INSERT INTO tasty_users (tasty_username, tasty_password ) VALUES (:tasty_username, :tasty_password )");/*** bind the parameters ***/
        $stmt->bindParam(':tasty_username', $tasty_username, PDO::PARAM_STR);
        $stmt->bindParam(':tasty_password', $tasty_password, PDO::PARAM_STR, 40);/*** execute the prepared statement ***/
        $stmt->execute();/*** unset the form token session variable ***/
        unset( $_SESSION['form_token'] );/*** if all is done, say thanks ***/
        $message = 'New user added';
    }
    catch(Exception $e) {
        /*** check if the username already exists ***/
        if( $e->getCode() == 23000) {
            $message = 'Username already exists';
        }
        else {
            /*** if we are here, something has gone wrong with the database ***/
            $message = 'We are unable to process your request. Please try again later"';
        }
    }
}
?>

<html>
<head>
<title>TastyRecipe Login</title>
</head>
<body>
<p><?php echo $message; ?>
</body>
</html>
