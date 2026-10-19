<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | BloodBank Management System</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        * {
    box-sizing: border-box;
    margin: 0;
    padding: 0;
}

        input {
            width: 100%;
            padding: 12px 15px 12px 40px;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 16px;
            transition: all 0.3s ease;
        }
        :root {
            --blood-red: #c00;
            --dark-red: #900;
            --light-red: #fdd;
            --white: #fff;
            --black: #222;
            --gray: #f5f5f5;
        }
        
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            margin: 0;
            padding: 0;
            background-color: var(--gray);
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            background-image: linear-gradient(rgba(0,0,0,0.5), rgba(0,0,0,0.5)), url('images/blood-donation-bg.jpg');
            background-size: cover;
            background-position: center;
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
        }
        
        label {
            display: block;
            margin-bottom: 8px;
            color: var(--dark-red);
            font-weight: 600;
        }
        
        .input-field {
            position: relative;
        }
        
        input {
            width: 100%;
            padding: 12px 15px 12px 40px;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 16px;
            transition: all 0.3s ease;
        }
        
        input:focus {
            border-color: var(--blood-red);
            outline: none;
            box-shadow: 0 0 5px rgba(200,0,0,0.2);
        }
        
        .input-icon {
            position: absolute;
            left: 15px;
            top: 50%;
            transform: translateY(-50%);
            color: var(--blood-red);
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
        
        .btn-reset {
            background-color: var(--gray);
            color: var(--black);
            margin-top: 15px;
        }
        
        .btn-reset:hover {
            background-color: #e0e0e0;
        }
        
        .error-message {
            color: var(--blood-red);
            margin-top: 15px;
            font-weight: 500;
            display: none;
        }
        
        .forgot-password {
            display: block;
            margin-top: 20px;
            color: var(--dark-red);
            text-decoration: none;
            font-size: 14px;
        }
        
        .forgot-password:hover {
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
    <h1>BloodBank Management System</h1>
    
    <form name="bbms" method="post" action="connection2.php" onsubmit="return validateForm()">
        <div class="form-group">
            <label for="username">Username</label>
            <div class="input-field">
                <i class="fas fa-user input-icon"></i>
                <input type="text" id="username" name="username" placeholder="Enter your username" required>
            </div>
        </div>
        
        <div class="form-group">
            <label for="password">Password</label>
            <div class="input-field">
                <i class="fas fa-lock input-icon"></i>
                <input type="password" id="password" name="password" placeholder="Enter your password" required>
            </div>
        </div>
        
        <div id="error-message" class="error-message">
            <i class="fas fa-exclamation-circle"></i> <span id="error-text"></span>
        </div>
        
        <button type="submit" class="btn">Login <i class="fas fa-sign-in-alt"></i></button>
        <!-- <button type="reset" class="btn btn-reset">Reset <i class="fas fa-redo"></i></button> -->
        
        <a href="register.php" class="forgot-password">Register</a>
    </form>
</div>


    <script>
        function validateForm() {
            const username = document.getElementById('username').value.trim();
            const password = document.getElementById('password').value.trim();
            const errorElement = document.getElementById('error-message');
            const errorText = document.getElementById('error-text');
            
            // Reset error state
            errorElement.style.display = 'none';
            
            if (!username) {
                showError('Username cannot be blank');
                document.getElementById('username').focus();
                return false;
            }
            
            if (!password) {
                showError('Password cannot be blank');
                document.getElementById('password').focus();
                return false;
            }
            
            if (password.length < 6) {
                showError('Password must be at least 6 characters');
                document.getElementById('password').focus();
                return false;
            }
            
            return true;
            
            function showError(message) {
                errorText.textContent = message;
                errorElement.style.display = 'block';
            }
        }
        
        // Add animation to form inputs on focus
        document.querySelectorAll('input').forEach(input => {
            input.addEventListener('focus', function() {
                this.parentNode.style.transform = 'scale(1.02)';
            });
            
            input.addEventListener('blur', function() {
                this.parentNode.style.transform = 'scale(1)';
            });
        });
    </script>
</body>
</html>
