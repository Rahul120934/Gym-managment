<?php
// start session
session_start();

// connect to server and database
$conn = mysqli_connect("localhost", "root", "", "gym_management");

// check connection
if(!$conn) {
    echo "connection failed";
} else {
    // check if form submitted
    if($_SERVER["REQUEST_METHOD"] == "POST") {
        // fetch form data
        $email = $_POST['email'];
        $password = $_POST['password'];

        // optional: file handling - log login attempts
        $fp = fopen("log.txt", "a");
        fwrite($fp, "trainee_login_attempt: " . $email . "\n");
        fclose($fp);

        // execute query
        $q = "SELECT * FROM trainees WHERE email='$email' AND password='$password'";
        $r = mysqli_query($conn, $q);

        // check result and display output
        if($r && mysqli_num_rows($r) == 1) {
            $_SESSION['email'] = $email;
            header("Location: dashboard.php");
            exit();
        } else {
            echo "invalid email or password";
        }
    }

    // close connection
    mysqli_close($conn);
}
?>
