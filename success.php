<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Successful | LifeBlood</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --blood-red: #c00;
            --dark-red: #900;
            --light-red: #fdd;
            --white: #fff;
            --black: #222;
            --gray: #f5f5f5;
            --blue: #0066cc;
            --yellow: #ffcc00;
            --green: #009933;
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
            text-align: center;
        }
        
        .success-container {
            background-color: var(--white);
            border-radius: 10px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
            padding: 40px;
            max-width: 600px;
            width: 90%;
            animation: fadeIn 0.5s ease;
        }
        
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(-20px); }
            to { opacity: 1; transform: translateY(0); }
        }
        
        .success-title {
            font-size: 3rem;
            font-weight: bold;
            margin-bottom: 30px;
            line-height: 1.2;
        }
        
        .blue { color: var(--blue); }
        .red { color: var(--blood-red); }
        .yellow { color: var(--yellow); }
        .green { color: var(--green); }
        
        .success-icon {
            font-size: 5rem;
            color: var(--green);
            margin-bottom: 20px;
            animation: bounce 1s infinite alternate;
        }
        
        @keyframes bounce {
            from { transform: translateY(0); }
            to { transform: translateY(-10px); }
        }
        
        .success-message {
            font-size: 1.2rem;
            margin-bottom: 30px;
            color: var(--black);
            line-height: 1.6;
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
            text-decoration: none;
            display: inline-block;
            font-weight: 600;
        }
        
        .btn:hover {
            background-color: var(--dark-red);
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        }
        
        .next-steps {
            margin-top: 30px;
            text-align: left;
            background-color: var(--light-red);
            padding: 20px;
            border-radius: 5px;
        }
        
        .next-steps h3 {
            color: var(--dark-red);
            margin-top: 0;
        }
        
        @media (max-width: 480px) {
            .success-title {
                font-size: 2rem;
            }
            
            .success-icon {
                font-size: 3rem;
            }
        }
    </style>
</head>
<body>
    <div class="success-container">
        <div class="success-icon">
            <i class="fas fa-check-circle"></i>
        </div>
        
        <h1 class="success-title">
            <span class="blue">Regist</span>
            <span class="red">ration</span>
            <span class="yellow"> Succe</span>
            <span class="green">ssful</span>
        </h1>
        
        <p class="success-message">
            Thank you for registering as a blood donor with LifeBlood! Your information has been successfully saved in our system. 
            A representative may contact you soon to discuss next steps.
        </p>
        
        <div class="next-steps">
            <h3><i class="fas fa-info-circle"></i> What happens next?</h3>
            <ul>
                <li>You'll receive a confirmation email with your donor details</li>
                <li>Our team will verify your information within 24 hours</li>
                <li>You may be contacted for additional health screening</li>
            </ul>
        </div>
        
        <a href="index.php" class="btn">
            <i class="fas fa-home"></i> Return to Home
        </a>
    </div>
</body>
</html>
