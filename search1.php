<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search Donors | Blood Bank System</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap');
        
        :root {
            --primary: #c0392b;
            --secondary: #f1faee;
            --accent: #2980b9;
            --dark: #2c3e50;
            --light: #ecf0f1;
            --blood-gradient: linear-gradient(135deg, #c0392b 0%, #e74c3c 100%);
            --glass: rgba(255, 255, 255, 0.1);
            --glass-border: rgba(255, 255, 255, 0.2);
        }
        
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Poppins', sans-serif;
            line-height: 1.6;
            color: #333;
            background: linear-gradient(135deg, rgba(192, 57, 43, 0.7) 0%, rgba(231, 76, 60, 0.6) 25%, rgba(41, 128, 185, 0.7) 50%, rgba(109, 213, 237, 0.6) 75%, rgba(192, 57, 43, 0.5) 100%), url('https://images.unsplash.com/photo-1506748686214-e9df14d4d9d0?crop=entropy&cs=tinysrgb&fit=max&fm=jpg&ixid=MnwxMTc3M3wwfDF8c2VhcmNofDF8fGJsb29kJTIwYmFua2luZ3xlbnwwfHx8fDE2MjY0MjY0Mjg&ixlib=rb-1.2.1&q=80&w=1080');
            background-attachment: fixed;
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            min-height: 100vh;
            overflow-x: hidden;
        }
        
        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
        }
        
        .search-container {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border-radius: 20px;
            padding: 40px;
            margin: 30px auto;
            box-shadow: 0 20px 40px rgba(0,0,0,0.1);
            border: 1px solid var(--glass-border);
            max-width: 800px;
        }
        
        .search-title {
            text-align: center;
            color: var(--primary);
            font-size: 2.5rem;
            font-weight: 700;
            margin-bottom: 30px;
            text-shadow: 2px 2px 4px rgba(0,0,0,0.1);
        }
        
        .search-title::after {
            content: '';
            display: block;
            width: 80px;
            height: 4px;
            background: var(--blood-gradient);
            margin: 20px auto;
            border-radius: 2px;
        }
        
        .search-form {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 30px;
            margin-bottom: 30px;
        }
        
        .form-group {
            display: flex;
            flex-direction: column;
        }
        
        .form-group label {
            font-size: 1.2rem;
            font-weight: 600;
            color: var(--dark);
            margin-bottom: 10px;
            display: flex;
            align-items: center;
        }
        
        .form-group label i {
            margin-right: 10px;
            color: var(--primary);
        }
        
        .form-group select {
            padding: 15px;
            border: 2px solid #ddd;
            border-radius: 10px;
            font-size: 1.1rem;
            font-family: 'Poppins', sans-serif;
            transition: all 0.3s ease;
            background: white;
            cursor: pointer;
        }
        
        .form-group select:focus {
            outline: none;
            border-color: var(--primary);
            box-shadow: 0 0 10px rgba(192, 57, 43, 0.2);
        }
        
        .search-btn {
            grid-column: 1 / -1;
            background: var(--blood-gradient);
            color: white;
            border: none;
            padding: 15px 30px;
            font-size: 1.2rem;
            font-weight: 600;
            border-radius: 50px;
            cursor: pointer;
            transition: all 0.3s ease;
            font-family: 'Poppins', sans-serif;
            box-shadow: 0 10px 30px rgba(192, 57, 43, 0.3);
        }
        
        .search-btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 15px 40px rgba(192, 57, 43, 0.4);
        }
        
        .search-btn:active {
            transform: translateY(-1px);
        }
        
        .results-container {
            margin-top: 40px;
        }
        
        .results-table {
            width: 100%;
            border-collapse: collapse;
            background: white;
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
        }
        
        .results-table th {
            background: var(--blood-gradient);
            color: white;
            padding: 20px;
            text-align: left;
            font-weight: 600;
            font-size: 1.1rem;
        }
        
        .results-table td {
            padding: 15px 20px;
            border-bottom: 1px solid #eee;
            font-size: 1rem;
        }
        
        .results-table tr:hover {
            background: rgba(192, 57, 43, 0.05);
        }
        
        .no-results {
            text-align: center;
            padding: 40px;
            background: rgba(255, 255, 255, 0.9);
            border-radius: 15px;
            margin-top: 20px;
        }
        
        .no-results i {
            font-size: 3rem;
            color: var(--primary);
            margin-bottom: 20px;
        }
        
        .no-results h3 {
            color: var(--dark);
            margin-bottom: 10px;
        }
        
        .no-results p {
            color: #666;
        }
        
        .stats-info {
            background: rgba(192, 57, 43, 0.1);
            padding: 20px;
            border-radius: 15px;
            margin-top: 20px;
            border-left: 4px solid var(--primary);
        }
        
        .stats-info h4 {
            color: var(--primary);
            margin-bottom: 10px;
            display: flex;
            align-items: center;
        }
        
        .stats-info h4 i {
            margin-right: 10px;
        }
        
        @media (max-width: 768px) {
            .search-form {
                grid-template-columns: 1fr;
                gap: 20px;
            }
            
            .search-container {
                padding: 30px 20px;
                margin: 20px 15px;
            }
            
            .search-title {
                font-size: 2rem;
            }
            
            .results-table {
                font-size: 0.9rem;
            }
            
            .results-table th,
            .results-table td {
                padding: 10px 15px;
            }
        }
    </style>
</head>
<body>
    <?php include 'header2.php'; ?>
    
    <div class="container">
        <div class="search-container">
            <h1 class="search-title">
                <i class="fas fa-search"></i> Search Blood Donors
            </h1>
            
            <form name="Search" method="post" action="">
                <div class="search-form">
                    <div class="form-group">
                        <label for="city">
                            <i class="fas fa-map-marker-alt"></i> City
                        </label>
                        <select name="city" id="city" required>
                            <option value="">Select a city</option>
                            <option value="Mumbai">Mumbai</option>
                            <option value="Delhi">Delhi</option>
                            <option value="Bangalore">Bangalore</option>
                            <option value="Hyderabad">Hyderabad</option>
                            <option value="Chennai">Chennai</option>
                            <option value="Kolkata">Kolkata</option>
                            <option value="Pune">Pune</option>
                            <option value="Ahmedabad">Ahmedabad</option>
                            <option value="Jaipur">Jaipur</option>
                            <option value="Lucknow">Lucknow</option>
                            <option value="Kanpur">Kanpur</option>
                            <option value="Nagpur">Nagpur</option>
                            <option value="Indore">Indore</option>
                            <option value="Bhopal">Bhopal</option>
                            <option value="Jabalpur">Jabalpur</option>
                            <option value="Patna">Patna</option>
                            <option value="Varanasi">Varanasi</option>
                            <option value="Srinagar">Srinagar</option>
                            <option value="Chandigarh">Chandigarh</option>
                            <option value="Amritsar">Amritsar</option>
                            <option value="Ludhiana">Ludhiana</option>
                            <option value="Jodhpur">Jodhpur</option>
                            <option value="Udaipur">Udaipur</option>
                            <option value="Bhubaneswar">Bhubaneswar</option>
                            <option value="Guwahati">Guwahati</option>
                            <option value="Shillong">Shillong</option>
                            <option value="Imphal">Imphal</option>
                            <option value="Aizawl">Aizawl</option>
                            <option value="Kohima">Kohima</option>
                            <option value="Itanagar">Itanagar</option>
                            <option value="Dispur">Dispur</option>
                            <option value="Agartala">Agartala</option>
                            <option value="Gangtok">Gangtok</option>
                            <option value="Shimla">Shimla</option>
                            <option value="Dehradun">Dehradun</option>
                            <option value="Panaji">Panaji</option>
                            <option value="Thiruvananthapuram">Thiruvananthapuram</option>
                            <option value="Kochi">Kochi</option>
                            <option value="Kozhikode">Kozhikode</option>
                            <option value="Thrissur">Thrissur</option>
                            <option value="Kollam">Kollam</option>
                            <option value="Alappuzha">Alappuzha</option>
                            <option value="Palakkad">Palakkad</option>
                            <option value="Malappuram">Malappuram</option>
                            <option value="Kannur">Kannur</option>
                            <option value="Kasaragod">Kasaragod</option>
                            <option value="Pathanamthitta">Pathanamthitta</option>
                            <option value="Idukki">Idukki</option>
                            <option value="Wayanad">Wayanad</option>
                            <option value="Ernakulam">Ernakulam</option>
                        </select>
                    </div>
                    
                    <div class="form-group">
                        <label for="bgroup">
                            <i class="fas fa-tint"></i> Blood Group
                        </label>
                        <select name="bgroup" id="bgroup" required>
                            <option value="">Select blood group</option>
                            <option value="O+">O+ (Universal Donor)</option>
                            <option value="A+">A+</option>
                            <option value="B+">B+</option>
                            <option value="AB+">AB+ (Universal Recipient)</option>
                            <option value="O-">O- (Universal Donor)</option>
                            <option value="A-">A-</option>
                            <option value="B-">B-</option>
                            <option value="AB-">AB-</option>
                        </select>
                    </div>
                    
                    <button type="submit" name="b2" class="search-btn">
                        <i class="fas fa-search"></i> Search Donors
                    </button>
                </div>
            </form>
            
            <?php
            if(isset($_POST['b2']) && !empty($_POST['city']) && !empty($_POST['bgroup'])) {
                include "connection.php";
                
                $inCity = mysqli_real_escape_string($conn, $_POST["city"]);
                $inBloodgroup = mysqli_real_escape_string($conn, $_POST["bgroup"]);
                
                $sql = "SELECT * FROM register WHERE city = ? AND blood_group = ?";
                $stmt = mysqli_prepare($conn, $sql);
                mysqli_stmt_bind_param($stmt, "ss", $inCity, $inBloodgroup);
                mysqli_stmt_execute($stmt);
                $result = mysqli_stmt_get_result($stmt);
                
                if($result && mysqli_num_rows($result) > 0) {
                    echo '<div class="results-container">';
                    echo '<div class="stats-info">';
                    echo '<h4><i class="fas fa-info-circle"></i> Search Results</h4>';
                    echo '<p>Found <strong>' . mysqli_num_rows($result) . '</strong> donor(s) in <strong>' . htmlspecialchars($inCity) . '</strong> with blood group <strong>' . htmlspecialchars($inBloodgroup) . '</strong></p>';
                    echo '</div>';
                    
                    echo '<table class="results-table">';
                    echo '<thead>';
                    echo '<tr>';
                    echo '<th><i class="fas fa-envelope"></i> Email</th>';
                    echo '<th><i class="fas fa-user"></i> Name</th>';
                    echo '<th><i class="fas fa-phone"></i> Mobile</th>';
                    echo '<th><i class="fas fa-map-marker-alt"></i> City</th>';
                    echo '<th><i class="fas fa-tint"></i> Blood Group</th>';
                    echo '</tr>';
                    echo '</thead>';
                    echo '<tbody>';
                    
                    while($row = mysqli_fetch_assoc($result)) {
                        echo '<tr>';
                        echo '<td>' . htmlspecialchars($row["email"]) . '</td>';
                        echo '<td>' . htmlspecialchars($row["name"]) . '</td>';
                        echo '<td>' . htmlspecialchars($row["mobile"]) . '</td>';
                        echo '<td>' . htmlspecialchars($row["city"]) . '</td>';
                        echo '<td><strong>' . htmlspecialchars($row["blood_group"]) . '</strong></td>';
                        echo '</tr>';
                    }
                    
                    echo '</tbody>';
                    echo '</table>';
                    echo '</div>';
                } else {
                    echo '<div class="no-results">';
                    echo '<i class="fas fa-search"></i>';
                    echo '<h3>No Donors Found</h3>';
                    echo '<p>Sorry, no donors found in <strong>' . htmlspecialchars($inCity) . '</strong> with blood group <strong>' . htmlspecialchars($inBloodgroup) . '</strong>.</p>';
                    echo '<p>Please try searching in a different city or blood group.</p>';
                    echo '</div>';
                }
                
                mysqli_stmt_close($stmt);
                mysqli_close($conn);
            }
            ?>
        </div>
    </div>
</body>
</html>
