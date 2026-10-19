<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Register | BloodBank Management System</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"/>
  <style>
    :root {
      --blood-red: #c00;
      --dark-red: #900;
      --white: #fff;
      --black: #222;
      --gray: #f5f5f5;
    }

    * {
      box-sizing: border-box;
      margin: 0;
      padding: 0;
    }

    body {
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      background: linear-gradient(rgba(0,0,0,0.5), rgba(0,0,0,0.5)), url('images/blood-donation-bg.jpg') center/cover no-repeat;
      display: flex;
      justify-content: center;
      align-items: center;
      min-height: 100vh;
    }

    .login-container {
      background-color: var(--white);
      border-radius: 10px;
      box-shadow: 0 10px 30px rgba(0,0,0,0.2);
      width: 400px;
      padding: 40px;
      text-align: center;
      animation: fadeIn 0.5s ease;
    }

    @keyframes fadeIn {
      from { opacity: 0; transform: translateY(-20px); }
      to { opacity: 1; transform: translateY(0); }
    }

    .logo {
      width: 100px;
      margin-bottom: 20px;
    }

    h1 {
      color: var(--blood-red);
      margin-bottom: 30px;
      font-size: 24px;
    }

    .form-group {
      margin-bottom: 20px;
      text-align: left;
      width: 100%;
    }

    label {
      display: block;
      margin-bottom: 8px;
      color: var(--dark-red);
      font-weight: 600;
    }

    .input-field {
      position: relative;
      width: 100%;
    }

    .input-icon {
      position: absolute;
      left: 15px;
      top: 50%;
      transform: translateY(-50%);
      color: var(--blood-red);
    }

    input {
      width: 100%;
      padding: 12px 15px 12px 40px;
      border: 1px solid #ddd;
      border-radius: 5px;
      font-size: 16px;
    }

    input:focus {
      border-color: var(--blood-red);
      outline: none;
      box-shadow: 0 0 5px rgba(200,0,0,0.2);
    }

    .btn {
      background-color: var(--blood-red);
      color: var(--white);
      border: none;
      padding: 12px 25px;
      font-size: 16px;
      border-radius: 5px;
      cursor: pointer;
      transition: all 0.3s ease;
      width: 100%;
      font-weight: 600;
      margin-top: 10px;
    }

    .btn:hover {
      background-color: var(--dark-red);
      transform: translateY(-2px);
    }

    .error, .success {
      font-weight: 600;
      text-align: center;
      margin-top: 15px;
    }

    .error {
      color: var(--blood-red);
    }

    .success {
      color: green;
    }

    .login-link {
      margin-top: 15px;
      font-size: 14px;
    }

    .login-link a {
      color: var(--dark-red);
      text-decoration: none;
    }

    .login-link a:hover {
      text-decoration: underline;
    }

    @media (max-width: 480px) {
      .login-container {
        width: 90%;
        padding: 30px 20px;
      }
    }
  </style>
</head>
<body>

<div class="login-container">
  <img src="blood-bank.jpg" alt="Blood Bank Logo" class="logo">
  <h1>Register</h1>

  <form method="POST" action="" onsubmit="return validateForm()">
    <div class="form-group">
      <label for="username">Email</label>
      <div class="input-field">
        <i class="fas fa-envelope input-icon"></i>
        <input type="email" id="username" name="username" placeholder="Enter your email" required>
      </div>
    </div>

    <div class="form-group">
      <label for="password">Password</label>
      <div class="input-field">
        <i class="fas fa-lock input-icon"></i>
        <input type="password" id="password" name="password" placeholder="Create your password" required>
      </div>
    </div>

    <button type="submit" name="register" class="btn">Register <i class="fas fa-user-plus"></i></button>
  </form>

  <?php
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['register'])) {
        include_once("connection.php");

        $email = trim($_POST['username']);
        $password = trim($_POST['password']);
        $errors = [];

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors[] = "Invalid email format.";
        }

        if (strlen($password) < 6) {
            $errors[] = "Password must be at least 6 characters.";
        }

        if (empty($errors)) {
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
            $check = $conn->prepare("SELECT username FROM login WHERE username = ?");
            $check->bind_param("s", $email);
            $check->execute();
            $check->store_result();

            if ($check->num_rows > 0) {
                echo '<div class="error">Email already registered. <a href="login.php">Login here</a>.</div>';
            } else {
                $stmt = $conn->prepare("INSERT INTO login (username, password) VALUES (?, ?)");
                $stmt->bind_param("ss", $email, $hashedPassword);

                if ($stmt->execute()) {
                    echo '<div class="success">Account created successfully! <a href="login.php">Login</a></div>';
                } else {
                    echo '<div class="error">Something went wrong. Please try again.</div>';
                }
            }
        } else {
            foreach ($errors as $err) {
                echo '<div class="error">' . $err . '</div>';
            }
        }
    }
  ?>

  <div class="login-link">
    Already have an account? <a href="login.php">Login here</a>
  </div>
</div>

<script>
  function validateForm() {
    const email = document.getElementById('username').value.trim();
    const password = document.getElementById('password').value.trim();

    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

    if (!emailRegex.test(email)) {
      alert('Please enter a valid email address.');
      return false;
    }

    if (password.length < 6) {
      alert('Password must be at least 6 characters long.');
      return false;
    }

    return true;
  }
</script>

</body>
</html>
