<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blood Donor Registration | LifeBlood</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
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
            color: var(--black);
        }
        
        .container {
            max-width: 800px;
            margin: 50px auto;
            padding: 30px;
            background-color: var(--white);
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(0,0,0,0.1);
        }
        
        h1 {
            color: var(--blood-red);
            text-align: center;
            margin-bottom: 30px;
            border-bottom: 2px solid var(--light-red);
            padding-bottom: 10px;
        }
        
        .form-group {
            margin-bottom: 20px;
        }
        
        label {
            display: block;
            margin-bottom: 8px;
            font-weight: 600;
            color: var(--dark-red);
        }
        
        input, select {
            width: 100%;
            padding: 12px;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 16px;
            transition: all 0.3s ease;
        }
        
        input:focus, select:focus {
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
            display: inline-block;
            text-align: center;
            width: 100%;
            font-weight: 600;
        }
        
        .btn:hover {
            background-color: var(--dark-red);
            transform: translateY(-2px);
        }
        
        .message {
            padding: 15px;
            margin-bottom: 20px;
            border-radius: 5px;
            text-align: center;
            font-weight: 500;
        }
        
        .success {
            background-color: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
        }
        
        .error {
            background-color: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
        }
        
        .required:after {
            content: " *";
            color: var(--blood-red);
        }
        
        .blood-drop {
            color: var(--blood-red);
            margin-right: 5px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1><i class="fas fa-tint blood-drop"></i> Blood Donor Registration</h1>
        
        <?php
        include "connection.php";
        
        if($_SERVER['REQUEST_METHOD']=='POST') {
            // Sanitize and validate input
            $inEmail = mysqli_real_escape_string($conn, $_POST["t1"]);
            $inName = mysqli_real_escape_string($conn, $_POST["t2"]);
            $inMob = mysqli_real_escape_string($conn, $_POST["t3"]);
            $inCity = mysqli_real_escape_string($conn, $_POST["t4"]);
            $inBg = mysqli_real_escape_string($conn, $_POST["t5"]);
            
            // Basic validation
            $errors = [];
            if(empty($inEmail)) $errors[] = "Email is required";
            if(empty($inName)) $errors[] = "Name is required";
            if(empty($inMob)) $errors[] = "Mobile number is required";
            if(empty($inBg)) $errors[] = "Blood group is required";
            
            if(!filter_var($inEmail, FILTER_VALIDATE_EMAIL)) {
                $errors[] = "Invalid email format";
            }
            
            if(count($errors) === 0) {
                $sql = "INSERT INTO register (email, name, mobile, city, blood_group) 
                        VALUES (?, ?, ?, ?, ?)";
                
                $stmt = mysqli_prepare($conn, $sql);
                mysqli_stmt_bind_param($stmt, "sssss", $inEmail, $inName, $inMob, $inCity, $inBg);
                
                if(mysqli_stmt_execute($stmt)) {
                    echo '<div class="message success">
                            <i class="fas fa-check-circle"></i> Thank you for registering as a blood donor! A representative will contact you soon.
                          </div>';
                } else {
                    echo '<div class="message error">
                            <i class="fas fa-exclamation-circle"></i> Error: ' . mysqli_error($conn) . '
                          </div>';
                }
                mysqli_stmt_close($stmt);
            } else {
                echo '<div class="message error">
                        <i class="fas fa-exclamation-circle"></i> ' . implode("<br>", $errors) . '
                      </div>';
            }
            mysqli_close($conn);
        }
        ?>
        
        <form method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
            <div class="form-group">
                <label for="email" class="required">Email Address</label>
                <input type="email" id="email" name="t1" required placeholder="Enter your email">
            </div>
            
            <div class="form-group">
                <label for="name" class="required">Full Name</label>
                <input type="text" id="name" name="t2" required placeholder="Enter your full name">
            </div>
            
            <div class="form-group">
                <label for="mobile" class="required">Mobile Number</label>
                <input type="tel" id="mobile" name="t3" required placeholder="Enter your mobile number">
            </div>
            
            <div class="form-group">
                <label for="city">City</label>
                <input type="text" id="city" name="t4" placeholder="Enter your city">
            </div>
            
            <div class="form-group">
                <label for="blood-group" class="required">Blood Group</label>
                <select id="blood-group" name="t5" required>
                    <option value="">Select your blood group</option>
                    <option value="A+">A+</option>
                    <option value="A-">A-</option>
                    <option value="B+">B+</option>
                    <option value="B-">B-</option>
                    <option value="AB+">AB+</option>
                    <option value="AB-">AB-</option>
                    <option value="O+">O+</option>
                    <option value="O-">O-</option>
                </select>
            </div>
            
            <button type="submit" class="btn">
                <i class="fas fa-heartbeat"></i> Register as Donor
            </button>
        </form>
    </div>

    <script>
        // Client-side validation
        document.querySelector('form').addEventListener('submit', function(e) {
            let isValid = true;
            const requiredFields = document.querySelectorAll('[required]');
            
            requiredFields.forEach(field => {
                if(!field.value.trim()) {
                    field.style.borderColor = 'var(--blood-red)';
                    isValid = false;
                } else {
                    field.style.borderColor = '#ddd';
                }
            });
            
            if(!isValid) {
                e.preventDefault();
                alert('Please fill in all required fields');
            }
        });
    </script>
</body>
</html>
