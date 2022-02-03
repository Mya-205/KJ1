<?php
error_reporting(E_ALL);
ini_set("display_errors", 1);
?>



<?php
//Main Code

session_start();//starting session

//
// Gets the users logins
// Retrieves the email input from the sign in page
// Retrieves the password input from the sign in page
// Stores both inupts into variabloes, email for email and password for the password
//
$email    = $_POST['email'];
$password = $_POST['login'];


//
// attempts to login with the email and password
// Two functions:
// Good login function if the status is loggedIn
// Bad login function if the status isnt loggedIn (loggedOUt)
//
$status = loginDB($email, $password);
if ($status == "loggedIn") {
    processGoodLogin($status);        // process good login
} else {
    processBadLogin($status);        // process bad login
}


//
// attempts to login to the account with email and password
// returns the status of either "loggedIn" or "loggedOut"
// "loggedIn" is if the email and password both match
// "loggedOut" is if the email and password dont match or dont exist
//
function loginDB($email, $password) {
    $conn = getDBConnection();
    $status = checkCreds($conn, $email, $password);
    return $status;
}


//
// Gets all the information for the database
// gets the username
// gets the password
// gets the database name
// attempts to make a connection to the database
//
function getDBConnection() {
    // get connection to MySQL database
    $servername = "localhost";
    $username = "118795";
    $password = "saltaire";
    $dbname = "118795";

    // Create connection
    $conn = mysqli_connect($servername, $username, $password, $dbname);
    // Check connection
    if (!$conn) {
      die("Connection failed: " . mysqli_connect_error());
    }
    return $conn;
}


//
// check if credentials passed are in db
// selects the email and passwords from the table "examlogin"
// compares the email and passwords to the email and password varibale from the user inputs
// if inputs are the same, then status is "loggedIn"
// if the inputs arent the same, then the status is "loggedOut"
//
function checkCreds($conn, $email, $password) {
    $sql = "SELECT email, password FROM examlogin";
    $sql = $sql . " where email='" . $email . "' AND password='" . $password . "';";
    $result = mysqli_query($conn, $sql);


    if (mysqli_num_rows($result) == 1) {
        $status = "loggedIn";
        $success ="successful Login!";
        $user = $email;

    } else {
        $status = "loggedOut";
        $success = "unsuccessful Login";
    }

    // Close the connection 
    mysqli_close($conn);

    return $status;
}

/*
$employee = 0;
$customer = 1;

$role = "SELECT role FROM examlogin WHERE email="$email"";
*/

//
// Process good login
// sends the user to their dashboard (dashboard.html)
//
function processGoodLogin($status) {
    $_SESSION["status"] = $status;
    $_SESSION['login_error_msg'] = "";
    echo "No Problems with *";
    $profileEmail = "SELECT email FROM examlogin WHERE email =('$email')";
    $profileFirstName = "SELECT firstName FROM examlogin WHERE email =('$email')";
    $profileLastName = "SELECT lastname FROM examlogin WHERE email =('$email')";
    $profilePhoneNumber = "SELECT phoneNumber FROM examlogin WHERE email =('$email')";

    header ('Location: dashboard.html');
    exit();
}


//
// Process bad login
// sends the user back to the sign-in page to try again (sign-in.html)
//
function processBadLogin($status) {
    $_SESSION["status"] = $status;
    $_SESSION['login_error_msg'] = "Sorry, that user name or password is incorrect. Please try again.";
    header("Location: sign-in.html");
    exit();
}





?>