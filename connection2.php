<!DOCTYPE html>
<html>
<body>

<?php 
include_once("connection.php"); 
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (empty($_POST['username']) || empty($_POST['password'])) {
        echo "❌ Please enter both username and password.";
        echo "<br><a href='login.php'>Go back</a>";
        exit;
    }

    $inUsername = trim($_POST["username"]);
    $inPassword = trim($_POST["password"]);

    // Prepare a statement to fetch user by username
    $stmt = $conn->prepare("SELECT username, password FROM login WHERE username = ?");
    $stmt->bind_param("s", $inUsername);
    $stmt->execute();
    $stmt->store_result();
    $stmt->bind_result($UsernameDB, $PasswordDB);

    if ($stmt->fetch()) {
        // Check if entered password matches hashed one in DB
        if (password_verify($inPassword, $PasswordDB)) {
            $_SESSION['username'] = $UsernameDB;
            header("Location: index.php");
            exit;
        } else {
            echo "❌ Incorrect password.<br><a href='login.php'>Try again</a>";
        }
    } else {
        echo "❌ Username not found.<br><a href='login.php'>Try again</a>";
    }
}
?>

</body> 
</html>
