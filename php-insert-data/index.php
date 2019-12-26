<?php

// Configure your mysql database connection details:
$mysqlserverhost = 'localhost';
$database_name = 'idmphp';
$username_mysql = 'root';
$password_mysql = '';
// ------------------------- Do not modify code nder this field -------------------------- //

function sanitize( $variable ) {
    $clean_variable = strip_tags( $variable );
    $clean_variable = htmlentities( $clean_variable, ENT_QUOTES, 'UTF-8' );
    return $clean_variable;
}

function connect_to_mysqli( $mysqlserverhost, $username_mysql, $password_mysql, $database_name ) {
    $connect = mysqli_connect( $mysqlserverhost, $username_mysql, $password_mysql, $database_name );
    if ( !$connect ) {
        die( 'Connection failed mysql: ' . mysqli_connect_error() );
    }
    return $connect;

}
if ( isset( $_POST['processform'] ) ) {
    $connection = connect_to_mysqli( $mysqlserverhost, $username_mysql, $password_mysql, $database_name );
    $name = mysqli_real_escape_string( $connection, sanitize( $_POST['name'] ) );
    $address = mysqli_real_escape_string( $connection, sanitize( $_POST['address'] ) );
    $mobile = mysqli_real_escape_string( $connection, sanitize( $_POST['mobile'] ) );
    $rooms = mysqli_real_escape_string( $connection, sanitize( $_POST['rooms'] ) );

    $sql = "INSERT INTO personaldetails (name,address,mobile,rooms) VALUES ('$name', '$address', '$mobile', '$rooms')";
    if ( mysqli_query( $connection, $sql ) ) {
        echo '<h2><font color=blue>New record added to database.</font></h2>';
    } else {
        echo 'Error: ' . $sql . '<br>' . mysqli_error( $connection );
    }
    mysqli_close( $connection );
}
?>


<!DOCTYPE html>
<html>
<head>
<title>php</title>
<meta name = 'viewport' content = 'width=device-width, initial-scale=1'>

<link href = "css/index.css" rel = "stylesheet" type = "text/css">

</head>
<body>

<div class = 'container'>
<form action = 'index.php' method = 'post' name = 'Form' >
<input type = 'hidden' name = 'processform' value = '1'>
<div class = 'row'>
<div class = 'col-25'>
<label for = 'field'>* Name :</label>
</div>
<div class = 'col-75'>
<input type = 'text' id = 'name' name = 'name' placeholder = 'Value...'>
</div>
</div>
<div class = 'row'>
<div class = 'col-25'>
<label for = 'field'>* Address :</label>
</div>
<div class = 'col-75'>
<input type = 'text' id = 'address' name = 'address' placeholder = 'Value...'>
</div>
</div>
<div class = 'row'>
<div class = 'col-25'>
<label for = 'field'>* Mobile :</label>
</div>
<div class = 'col-75'>
<input type = 'text' id = 'mobile' name = 'mobile' placeholder = 'Value...'>
</div>
</div>
<div class = 'row'>
<div class = 'col-25'>
<label for = 'field'>* Rooms :</label>
</div>
<div class = 'col-75'>
<input type = 'text' id = 'rooms' name = 'rooms' placeholder = 'Value...'>
</div>
</div>
<div class = 'row'>
<input type = 'submit' value = 'Submit'>
</div>
</form>
* Required fields.
</div>

</body>
</html>