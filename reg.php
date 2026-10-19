<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Donor Registration | LifeBlood</title>
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
        

        
        .registration-container {
            max-width: 800px;
            margin: 30px auto;
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
        
        .registration-form {
            width: 100%;
        }
        
        .form-group {
            margin-bottom: 25px;
        }
        
        .form-group label {
            display: block;
            margin-bottom: 8px;
            font-weight: 600;
            color: var(--dark-red);
            font-size: 18px;
        }
        
        .form-group input, 
        .form-group select {
            width: 100%;
            padding: 12px 15px;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 16px;
            transition: all 0.3s ease;
        }
        
        .form-group input:focus, 
        .form-group select:focus {
            border-color: var(--blood-red);
            outline: none;
            box-shadow: 0 0 5px rgba(200,0,0,0.2);
        }
        
        .submit-btn {
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
        }
        
        .submit-btn:hover {
            background-color: var(--dark-red);
            transform: translateY(-2px);
        }
        
        .message {
            padding: 15px;
            margin: 20px 0;
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
        
        @media (max-width: 768px) {
            .registration-container {
                padding: 20px;
                margin: 20px 15px;
            }
            

        }
    </style>
</head>
<body>
    <?php include 'header2.php'; ?>

    <div class="registration-container">
        <h1><i class="fas fa-tint blood-drop"></i> Donor Registration</h1>
        
        <?php
        include "connection.php";
        
        if($_SERVER['REQUEST_METHOD']=='POST') {
            // Sanitize and validate input
            $inEmail = mysqli_real_escape_string($conn, $_POST["email"]);
            $inName = mysqli_real_escape_string($conn, $_POST["name"]);
            $inMob = mysqli_real_escape_string($conn, $_POST["phn"]);
            $inCity = mysqli_real_escape_string($conn, $_POST["city"]);
            $inBg = mysqli_real_escape_string($conn, $_POST["bgroup"]);
            
            // Basic validation
            $errors = [];
            if(empty($inEmail)) $errors[] = "Email is required";
            if(empty($inName)) $errors[] = "Name is required";
            if(empty($inMob)) $errors[] = "Mobile number is required";
            if(empty($inBg)) $errors[] = "Blood group is required";
            
            if(!filter_var($inEmail, FILTER_VALIDATE_EMAIL)) {
                $errors[] = "Invalid email format";
            }
            
            if(!preg_match('/^[0-9]{10}$/', $inMob)) {
                $errors[] = "Mobile number must be 10 digits";
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
        
        <form class="registration-form" method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
            <div class="form-group">
                <label for="email" class="required"><i class="fas fa-envelope"></i> Email Address</label>
                <input type="email" id="email" name="email" required placeholder="Enter your email">
            </div>
            
            <div class="form-group">
                <label for="name" class="required"><i class="fas fa-user"></i> Full Name</label>
                <input type="text" id="name" name="name" required placeholder="Enter your full name">
            </div>
            
            <div class="form-group">
                <label for="phn" class="required"><i class="fas fa-mobile-alt"></i> Mobile Number</label>
                <input type="tel" id="phn" name="phn" required placeholder="Enter 10-digit mobile number" pattern="[0-9]{10}">
            </div>
            
            <div class="form-group">
                <label for="city"><i class="fas fa-city"></i> City</label>
                <select id="city" name="city">
                    <option value="">Select your city</option>
                    <!-- Major Indian Cities -->
                    <option value="Mumbai">Mumbai</option>
                    <option value="Delhi">Delhi</option>
                    <option value="Bangalore">Bangalore</option>
                    <option value="Hyderabad">Hyderabad</option>
                    <option value="Ahmedabad">Ahmedabad</option>
                    <option value="Chennai">Chennai</option>
                    <option value="Kolkata">Kolkata</option>
                    <option value="Pune">Pune</option>
                    <option value="Jaipur">Jaipur</option>
                    <option value="Lucknow">Lucknow</option>
                    <option value="Kanpur">Kanpur</option>
                    <option value="Nagpur">Nagpur</option>
                    <option value="Indore">Indore</option>
                    <option value="Bhopal">Bhopal</option>
                    <option value="Patna">Patna</option>
                    <option value="Vadodara">Vadodara</option>
                    <option value="Ludhiana">Ludhiana</option>
                    <option value="Agra">Agra</option>
                    <option value="Nashik">Nashik</option>
                    <option value="Faridabad">Faridabad</option>
                    <option value="Meerut">Meerut</option>
                    <option value="Rajkot">Rajkot</option>
                    <option value="Varanasi">Varanasi</option>
                    <option value="Srinagar">Srinagar</option>
                    <option value="Aurangabad">Aurangabad</option>
                    <option value="Dhanbad">Dhanbad</option>
                    <option value="Amritsar">Amritsar</option>
                    <option value="Allahabad">Allahabad</option>
                    <option value="Ranchi">Ranchi</option>
                    <option value="Howrah">Howrah</option>
                    <option value="Coimbatore">Coimbatore</option>
                    <option value="Jabalpur">Jabalpur</option>
                    <option value="Gwalior">Gwalior</option>
                    <option value="Vijayawada">Vijayawada</option>
                    <option value="Jodhpur">Jodhpur</option>
                    <option value="Madurai">Madurai</option>
                    <option value="Raipur">Raipur</option>
                    <option value="Kota">Kota</option>
                    <option value="Guwahati">Guwahati</option>
                    <option value="Chandigarh">Chandigarh</option>
                    <option value="Solapur">Solapur</option>
                    <option value="Hubli">Hubli</option>
                    <option value="Mysore">Mysore</option>
                    <option value="Tiruchirappalli">Tiruchirappalli</option>
                    <option value="Bareilly">Bareilly</option>
                    <option value="Aligarh">Aligarh</option>
                    <option value="Tiruppur">Tiruppur</option>
                    <option value="Moradabad">Moradabad</option>
                    <option value="Jalandhar">Jalandhar</option>
                    <option value="Bhubaneswar">Bhubaneswar</option>
                    <option value="Salem">Salem</option>
                    <option value="Warangal">Warangal</option>
                    <option value="Guntur">Guntur</option>
                    <option value="Bhiwandi">Bhiwandi</option>
                    <option value="Saharanpur">Saharanpur</option>
                    <option value="Gorakhpur">Gorakhpur</option>
                    <option value="Bikaner">Bikaner</option>
                    <option value="Amravati">Amravati</option>
                    <option value="Noida">Noida</option>
                    <option value="Jamshedpur">Jamshedpur</option>
                    <option value="Bhilai">Bhilai</option>
                    <option value="Cuttack">Cuttack</option>
                    <option value="Firozabad">Firozabad</option>
                    <option value="Kochi">Kochi</option>
                    <option value="Nellore">Nellore</option>
                    <option value="Bhavnagar">Bhavnagar</option>
                    <option value="Dehradun">Dehradun</option>
                    <option value="Durgapur">Durgapur</option>
                    <option value="Asansol">Asansol</option>
                    <option value="Rourkela">Rourkela</option>
                    <option value="Nanded">Nanded</option>
                    <option value="Kolhapur">Kolhapur</option>
                    <option value="Ajmer">Ajmer</option>
                    <option value="Akola">Akola</option>
                    <option value="Gulbarga">Gulbarga</option>
                    <option value="Jamnagar">Jamnagar</option>
                    <option value="Ujjain">Ujjain</option>
                    <option value="Loni">Loni</option>
                    <option value="Siliguri">Siliguri</option>
                    <option value="Jhansi">Jhansi</option>
                    <option value="Ulhasnagar">Ulhasnagar</option>
                    <option value="Jammu">Jammu</option>
                    <option value="Sangli-Miraj & Kupwad">Sangli-Miraj & Kupwad</option>
                    <option value="Mangalore">Mangalore</option>
                    <option value="Erode">Erode</option>
                    <option value="Belgaum">Belgaum</option>
                    <option value="Kurnool">Kurnool</option>
                    <option value="Ambattur">Ambattur</option>
                    <option value="Tirunelveli">Tirunelveli</option>
                    <option value="Malegaon">Malegaon</option>
                    <option value="Gaya">Gaya</option>
                    <option value="Udaipur">Udaipur</option>
                    <option value="Maheshtala">Maheshtala</option>
                    <option value="Davanagere">Davanagere</option>
                    <option value="Kozhikode">Kozhikode</option>
                    <option value="Kurnool">Kurnool</option>
                    <option value="Rajpur Sonarpur">Rajpur Sonarpur</option>
                    <option value="Bokaro">Bokaro</option>
                    <option value="South Dumdum">South Dumdum</option>
                    <!-- Major World Cities -->
                    <option value="New York">New York</option>
                    <option value="London">London</option>
                    <option value="Paris">Paris</option>
                    <option value="Tokyo">Tokyo</option>
                    <option value="Beijing">Beijing</option>
                    <option value="Shanghai">Shanghai</option>
                    <option value="Hong Kong">Hong Kong</option>
                    <option value="Singapore">Singapore</option>
                    <option value="Dubai">Dubai</option>
                    <option value="Los Angeles">Los Angeles</option>
                    <option value="Chicago">Chicago</option>
                    <option value="Toronto">Toronto</option>
                    <option value="Sydney">Sydney</option>
                    <option value="Melbourne">Melbourne</option>
                    <option value="Berlin">Berlin</option>
                    <option value="Rome">Rome</option>
                    <option value="Madrid">Madrid</option>
                    <option value="Barcelona">Barcelona</option>
                    <option value="Moscow">Moscow</option>
                    <option value="Istanbul">Istanbul</option>
                    <option value="Bangkok">Bangkok</option>
                    <option value="Seoul">Seoul</option>
                    <option value="Kuala Lumpur">Kuala Lumpur</option>
                    <option value="Mexico City">Mexico City</option>
                    <option value="Sao Paulo">Sao Paulo</option>
                    <option value="Buenos Aires">Buenos Aires</option>
                    <option value="Cairo">Cairo</option>
                    <option value="Johannesburg">Johannesburg</option>
                    <option value="Cape Town">Cape Town</option>
                    <option value="Lagos">Lagos</option>
                    <option value="Nairobi">Nairobi</option>
                    <option value="Riyadh">Riyadh</option>
                    <option value="Jeddah">Jeddah</option>
                    <option value="Tehran">Tehran</option>
                    <option value="Baghdad">Baghdad</option>
                    <option value="Karachi">Karachi</option>
                    <option value="Lahore">Lahore</option>
                    <option value="Islamabad">Islamabad</option>
                    <option value="Doha">Doha</option>
                    <option value="Abu Dhabi">Abu Dhabi</option>
                    <option value="San Francisco">San Francisco</option>
                    <option value="Boston">Boston</option>
                    <option value="Miami">Miami</option>
                    <option value="Vancouver">Vancouver</option>
                    <option value="Montreal">Montreal</option>
                    <option value="Zurich">Zurich</option>
                    <option value="Geneva">Geneva</option>
                    <option value="Brussels">Brussels</option>
                    <option value="Amsterdam">Amsterdam</option>
                    <option value="Vienna">Vienna</option>
                    <option value="Stockholm">Stockholm</option>
                    <option value="Oslo">Oslo</option>
                    <option value="Copenhagen">Copenhagen</option>
                    <option value="Helsinki">Helsinki</option>
                    <option value="Dublin">Dublin</option>
                    <option value="Prague">Prague</option>
                    <option value="Warsaw">Warsaw</option>
                    <option value="Budapest">Budapest</option>
                    <option value="Athens">Athens</option>
                    <option value="Lisbon">Lisbon</option>
                    <option value="Other">Other</option>
                </select>
            </div>
            
            <div class="form-group">
                <label for="bgroup" class="required"><i class="fas fa-tint"></i> Blood Group</label>
                <select id="bgroup" name="bgroup" required>
                    <option value="">Select your blood group</option>
                    <option value="O+">O+</option>
                    <option value="A+">A+</option>
                    <option value="B+">B+</option>
                    <option value="AB+">AB+</option>
                    <option value="O-">O-</option>
                    <option value="A-">A-</option>
                    <option value="B-">B-</option>
                    <option value="AB-">AB-</option>
                </select>
            </div>
            
            <button type="submit" name="b1" class="submit-btn">
                <i class="fas fa-save"></i> Register as Donor
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
            
            // Validate mobile number format
            const mobileField = document.getElementById('phn');
            if(mobileField && !/^[0-9]{10}$/.test(mobileField.value)) {
                mobileField.style.borderColor = 'var(--blood-red)';
                isValid = false;
            }
            
            if(!isValid) {
                e.preventDefault();
                alert('Please fill in all required fields correctly');
            }
        });
    </script>
</body>
</html>
