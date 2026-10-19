<!DOCTYPE html>
<html lang="en">
<head>
    <title>LifeSaver Blood Bank System</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap');
        
        :root {
            --primary: #c0392b; /* Darker red */
            --secondary: #f1faee;
            --accent: #2980b9; /* Darker blue */
            --dark: #2c3e50; /* Darker navy */
            --light: #ecf0f1; /* Light grey */
            --gradient: linear-gradient(135deg, #2980b9 0%, #6dd5ed 100%); /* Updated gradient */
            --blood-gradient: linear-gradient(135deg, #c0392b 0%, #e74c3c 100%); /* Updated blood gradient */
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
        
        /* Animated Background */
        .bg-animation {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: -1;
            opacity: 0.1;
        }
        
        .bg-animation::before {
            content: '';
            position: absolute;
            width: 100%;
            height: 100%;
            background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><defs><pattern id="grain" width="100" height="100" patternUnits="userSpaceOnUse"><circle cx="50" cy="50" r="1" fill="%23c0392b" opacity="0.1"/></pattern></defs><rect width="100" height="100" fill="url(%23grain)"/></svg>');
            animation: float 20s ease-in-out infinite;
        }
        
        @keyframes float {
            0%, 100% { transform: translateY(0px) rotate(0deg); }
            50% { transform: translateY(-20px) rotate(180deg); }
        }
        

        
        /* Hero Section */
        .hero {
            text-align: center;
            padding: 80px 20px;
            position: relative;
            overflow: hidden;
        }
        
        .hero::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: radial-gradient(circle at center, rgba(255,255,255,0.1) 0%, transparent 70%);
            animation: pulse 4s ease-in-out infinite;
        }
        
        @keyframes pulse {
            0%, 100% { opacity: 0.5; transform: scale(1); }
            50% { opacity: 1; transform: scale(1.1); }
        }
        
        .hero h1 {
            font-size: 4rem;
            font-weight: 700;
            color: white;
            margin-bottom: 20px;
            text-shadow: 2px 2px 4px rgba(0,0,0,0.3);
            animation: slideInDown 1s ease-out;
        }
        
        .hero h1::after {
            content: '';
            display: block;
            width: 100px;
            height: 4px;
            background: var(--blood-gradient);
            margin: 20px auto;
            border-radius: 2px;
            animation: expandWidth 1.5s ease-out 0.5s both;
        }
        
        @keyframes slideInDown {
            from {
                opacity: 0;
                transform: translateY(-50px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        
        @keyframes expandWidth {
            from { width: 0; }
            to { width: 100px; }
        }
        
        .hero p {
            font-size: 1.3rem;
            color: rgba(255,255,255,0.9);
            margin-bottom: 40px;
            animation: fadeInUp 1s ease-out 0.3s both;
        }
        
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        
        /* Container */
        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
        }
        
        /* Cards */
        .card {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border-radius: 20px;
            padding: 30px;
            margin: 30px 0;
            box-shadow: 0 20px 40px rgba(0,0,0,0.1);
            border: 1px solid var(--glass-border);
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            position: relative;
            overflow: hidden;
        }
        
        .card::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(230, 57, 70, 0.1), transparent);
            transition: left 0.6s;
        }
        
        .card:hover::before {
            left: 100%;
        }
        
        .card:hover {
            transform: translateY(-10px) scale(1.02);
            box-shadow: 0 30px 60px rgba(0,0,0,0.15);
        }
        
        /* Stats Container */
        .stats-container {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 30px;
            margin: 50px 0;
        }
        
        .stat-box {
            background: var(--blood-gradient);
            color: white;
            border-radius: 20px;
            padding: 30px;
            text-align: center;
            box-shadow: 0 15px 35px rgba(230, 57, 70, 0.3);
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            position: relative;
            overflow: hidden;
        }
        
        .stat-box::before {
            content: '';
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: radial-gradient(circle, rgba(255,255,255,0.1) 0%, transparent 70%);
            transform: rotate(45deg);
            transition: all 0.6s;
            opacity: 0;
        }
        
        .stat-box:hover::before {
            opacity: 1;
            transform: rotate(45deg) translate(50%, 50%);
        }
        
        .stat-box:hover {
            transform: translateY(-15px) scale(1.05);
            box-shadow: 0 25px 50px rgba(230, 57, 70, 0.4);
        }
        
        .stat-number {
            font-size: 3.5rem;
            font-weight: 700;
            color: white;
            margin: 15px 0;
            text-shadow: 2px 2px 4px rgba(0,0,0,0.3);
            animation: countUp 2s ease-out;
        }
        
        @keyframes countUp {
            from {
                opacity: 0;
                transform: scale(0.5);
            }
            to {
                opacity: 1;
                transform: scale(1);
            }
        }
        
        /* Blood Types */
        .blood-types {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 30px;
            margin: 50px 0;
        }
        
        .blood-type {
            padding: 30px;
            border-radius: 20px;
            text-align: center;
            color: white;
            font-weight: 600;
            position: relative;
            overflow: hidden;
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            cursor: pointer;
        }
        
        .blood-type::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(45deg, transparent 30%, rgba(255,255,255,0.1) 50%, transparent 70%);
            transform: translateX(-100%);
            transition: transform 0.6s;
        }
        
        .blood-type:hover::before {
            transform: translateX(100%);
        }
        
        .blood-type:hover {
            transform: translateY(-10px) scale(1.05);
            box-shadow: 0 20px 40px rgba(0,0,0,0.3);
        }
        
        .type-a { 
            background: linear-gradient(135deg, #c0392b 0%, #e74c3c 100%);
            box-shadow: 0 10px 30px rgba(230, 57, 70, 0.3);
        }
        .type-b { 
            background: linear-gradient(135deg, #2980b9 0%, #3498db 100%);
            box-shadow: 0 10px 30px rgba(69, 123, 157, 0.3);
        }
        .type-ab { 
            background: linear-gradient(135deg, #2c3e50 0%, #34495e 100%);
            box-shadow: 0 10px 30px rgba(29, 53, 87, 0.3);
        }
        .type-o { 
            background: linear-gradient(135deg, #ecf0f1 0%, #bdc3c7 100%);
            color: #333;
            box-shadow: 0 10px 30px rgba(168, 218, 220, 0.3);
        }
        
        /* Donate Button */
        .donate-btn {
            display: inline-block;
            background: var(--blood-gradient);
            color: white;
            text-align: center;
            padding: 20px 40px;
            border-radius: 50px;
            text-decoration: none;
            font-weight: 600;
            font-size: 1.3rem;
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            box-shadow: 0 10px 30px rgba(230, 57, 70, 0.3);
            position: relative;
            overflow: hidden;
            margin: 40px auto;
            animation: bounce 2s infinite;
        }
        
        @keyframes bounce {
            0%, 20%, 50%, 80%, 100% {
                transform: translateY(0);
            }
            40% {
                transform: translateY(-10px);
            }
            60% {
                transform: translateY(-5px);
            }
        }
        
        .donate-btn::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.3), transparent);
            transition: left 0.5s;
        }
        
        .donate-btn:hover::before {
            left: 100%;
        }
        
        .donate-btn:hover {
            transform: translateY(-5px) scale(1.05);
            box-shadow: 0 20px 40px rgba(230, 57, 70, 0.5);
        }
        
        /* Timeline */
        .timeline {
            position: relative;
            max-width: 1200px;
            margin: 60px auto;
        }
        
        .timeline::before {
            content: '';
            position: absolute;
            left: 50%;
            top: 0;
            bottom: 0;
            width: 4px;
            background: var(--blood-gradient);
            transform: translateX(-50%);
            border-radius: 2px;
        }
        
        .timeline-item {
            padding: 30px;
            position: relative;
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border-radius: 20px;
            margin-bottom: 40px;
            box-shadow: 0 15px 35px rgba(0,0,0,0.1);
            border: 1px solid var(--glass-border);
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            width: 45%;
            margin-left: 5%;
        }
        
        .timeline-item:nth-child(even) {
            margin-left: 50%;
        }
        
        .timeline-item::before {
            content: '';
            position: absolute;
            width: 20px;
            height: 20px;
            background: var(--primary);
            border-radius: 50%;
            top: 30px;
            border: 4px solid white;
            box-shadow: 0 0 0 4px var(--primary);
        }
        
        .timeline-item:nth-child(odd)::before {
            right: -60px;
        }
        
        .timeline-item:nth-child(even)::before {
            left: -60px;
        }
        
        .timeline-item:hover {
            transform: translateY(-5px) scale(1.02);
            box-shadow: 0 25px 50px rgba(0,0,0,0.15);
        }
        
        /* Section Headers */
        h2 {
            color: white;
            text-align: center;
            margin: 60px 0 30px;
            font-size: 2.5rem;
            font-weight: 600;
            text-shadow: 2px 2px 4px rgba(0,0,0,0.3);
            position: relative;
        }
        
        h2::after {
            content: '';
            position: absolute;
            bottom: -10px;
            left: 50%;
            transform: translateX(-50%);
            width: 80px;
            height: 4px;
            background: var(--blood-gradient);
            border-radius: 2px;
        }
        
        /* Footer */
        .footer {
            background: rgba(44, 62, 80, 0.95);
            backdrop-filter: blur(10px);
            color: white;
            text-align: center;
            padding: 40px 20px;
            margin-top: 80px;
            border-top: 1px solid var(--glass-border);
        }
        
        .footer a {
            color: white;
            margin: 0 15px;
            font-size: 1.5rem;
            transition: all 0.3s ease;
        }
        
        .footer a:hover {
            color: var(--primary);
            transform: translateY(-3px);
        }
        
        /* Responsive Design */
        @media (max-width: 768px) {
            .hero h1 {
                font-size: 2.5rem;
            }
            
            .stats-container,
            .blood-types {
                grid-template-columns: 1fr;
            }
            
            .timeline::before {
                left: 20px;
            }
            
            .timeline-item {
                width: calc(100% - 60px);
                margin-left: 60px;
            }
            
            .timeline-item:nth-child(even) {
                margin-left: 60px;
            }
            
            .timeline-item::before {
                left: -50px !important;
            }
            

        }
        
        /* Loading Animation */
        .loading {
            opacity: 0;
            animation: fadeIn 0.8s ease-out forwards;
        }
        
        @keyframes fadeIn {
            to { opacity: 1; }
        }
        
        /* Scroll Animations */
        .scroll-animate {
            opacity: 0;
            transform: translateY(50px);
            transition: all 0.8s ease-out;
        }
        
        .scroll-animate.visible {
            opacity: 1;
            transform: translateY(0);
        }
    </style>
</head>
<body>
    <div class="bg-animation"></div>
    
    <?php include 'header2.php'; ?>

    <div class="hero">
        <h1>Welcome to LifeSaver Blood Bank</h1>
        <p>Every drop counts. Your donation can save up to <strong>3 lives</strong>.</p>
        <a href="reg.php" class="donate-btn">Donate Now <i class="fas fa-heartbeat"></i></a>
    </div>

    <div class="container">
        <div class="card loading scroll-animate">
            <p style="text-align: center; font-size: 1.3rem; font-weight: 500;">
                <i class="fas fa-quote-left" style="color: var(--primary); margin-right: 10px;"></i>
                A blood donation truly is a "gift of life" that a healthy individual can give to others in their community who are sick or injured.
                <i class="fas fa-quote-right" style="color: var(--primary); margin-left: 10px;"></i>
            </p>
        </div>
        
        <div class="stats-container">
            <div class="stat-box scroll-animate">
                <i class="fas fa-history" style="font-size: 2rem; margin-bottom: 15px;"></i>
                <div class="stat-number">1937</div>
                <p>First blood bank established in Chicago</p>
            </div>
            <div class="stat-box scroll-animate">
                <i class="fas fa-tint" style="font-size: 2rem; margin-bottom: 15px;"></i>
                <div class="stat-number">16M</div>
                <p>Blood donations collected annually in US</p>
            </div>
            <div class="stat-box scroll-animate">
                <i class="fas fa-hospital" style="font-size: 2rem; margin-bottom: 15px;"></i>
                <div class="stat-number">1/7</div>
                <p>Hospital patients need blood</p>
            </div>
            <div class="stat-box scroll-animate">
                <i class="fas fa-clock" style="font-size: 2rem; margin-bottom: 15px;"></i>
                <div class="stat-number">2s</div>
                <p>Someone needs blood every 2 seconds</p>
            </div>
        </div>

        <h2 class="scroll-animate"><i class="fas fa-tint"></i> Understanding Blood Groups</h2>
        
        <div class="blood-types">
            <div class="blood-type type-a scroll-animate">
                <i class="fas fa-droplet" style="font-size: 3rem; margin-bottom: 20px;"></i>
                <h3>Type A</h3>
                <p>Has A antigens, anti-B antibodies</p>
                <p><strong>Can donate to A & AB</strong></p>
            </div>
            <div class="blood-type type-b scroll-animate">
                <i class="fas fa-droplet" style="font-size: 3rem; margin-bottom: 20px;"></i>
                <h3>Type B</h3>
                <p>Has B antigens, anti-A antibodies</p>
                <p><strong>Can donate to B & AB</strong></p>
            </div>
            <div class="blood-type type-ab scroll-animate">
                <i class="fas fa-droplet" style="font-size: 3rem; margin-bottom: 20px;"></i>
                <h3>Type AB</h3>
                <p>Universal recipient</p>
                <p><strong>Has both antigens, no antibodies</strong></p>
            </div>
            <div class="blood-type type-o scroll-animate">
                <i class="fas fa-droplet" style="font-size: 3rem; margin-bottom: 20px;"></i>
                <h3>Type O</h3>
                <p>Universal donor</p>
                <p><strong>No antigens, both antibodies</strong></p>
            </div>
        </div>

        <h2 class="scroll-animate"><i class="fas fa-history"></i> History of Blood Banking</h2>
        
        <div class="timeline">
            <div class="timeline-item scroll-animate">
                <h3><i class="fas fa-calendar" style="color: var(--primary);"></i> 1937</h3>
                <p>The first hospital blood bank was established at Cook County Hospital in Chicago, marking the beginning of modern blood banking.</p>
            </div>
            <div class="timeline-item scroll-animate">
                <h3><i class="fas fa-user-md" style="color: var(--primary);"></i> 1940</h3>
                <p>Dr. Charles Drew developed revolutionary methods for processing and storing blood plasma, saving countless lives during World War II.</p>
            </div>
            <div class="timeline-item scroll-animate">
                <h3><i class="fas fa-cogs" style="color: var(--primary);"></i> 1971</h3>
                <p>Apheresis technology was introduced, allowing specific blood components to be collected and used more efficiently.</p>
            </div>
        </div>

        <h2 class="scroll-animate"><i class="fas fa-ambulance"></i> Why Donate Blood?</h2>
        
        <div class="card scroll-animate">
            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 30px;">
                <div>
                    <h3 style="color: var(--primary); margin-bottom: 15px;">
                        <i class="fas fa-car-crash"></i> Accident Victims
                    </h3>
                    <p>A single car accident victim can require as many as <strong>100 units of blood</strong>. In the US alone, there are about 6 million car accidents annually, with 2.5 million people injured.</p>
                </div>
                <div>
                    <h3 style="color: var(--primary); margin-bottom: 15px;">
                        <i class="fas fa-user-injured"></i> Cancer Patients
                    </h3>
                    <p>Chemotherapy patients often need platelet transfusions. A single leukemia patient can require up to 8 units of blood per week during treatment.</p>
                </div>
                <div>
                    <h3 style="color: var(--primary); margin-bottom: 15px;">
                        <i class="fas fa-procedures"></i> Surgical Patients
                    </h3>
                    <p>Open heart surgery can require 6 units of blood, while organ transplants may need 40 units or more to ensure successful outcomes.</p>
                </div>
            </div>
        </div>

        <h2 class="scroll-animate"><i class="fas fa-calendar-alt"></i> Donation Frequency</h2>
        
        <div class="card scroll-animate">
            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 25px;">
                <div style="text-align: center; padding: 20px; background: rgba(230, 57, 70, 0.1); border-radius: 15px;">
                    <i class="fas fa-tint" style="font-size: 2rem; color: var(--primary); margin-bottom: 15px;"></i>
                    <h4>Whole Blood</h4>
                    <p><strong>Every 56 days</strong><br>(about 6 times per year)</p>
                </div>
                <div style="text-align: center; padding: 20px; background: rgba(69, 123, 157, 0.1); border-radius: 15px;">
                    <i class="fas fa-plate-wheat" style="font-size: 2rem; color: var(--accent); margin-bottom: 15px;"></i>
                    <h4>Platelets</h4>
                    <p><strong>Every 7 days</strong><br>(up to 24 times per year)</p>
                </div>
                <div style="text-align: center; padding: 20px; background: rgba(29, 53, 87, 0.1); border-radius: 15px;">
                    <i class="fas fa-droplet" style="font-size: 2rem; color: var(--dark); margin-bottom: 15px;"></i>
                    <h4>Plasma</h4>
                    <p><strong>Every 28 days</strong><br>(about 13 times per year)</p>
                </div>
                <div style="text-align: center; padding: 20px; background: rgba(168, 218, 220, 0.1); border-radius: 15px;">
                    <i class="fas fa-heart" style="font-size: 2rem; color: var(--light); margin-bottom: 15px;"></i>
                    <h4>Double Red Cells</h4>
                    <p><strong>Every 112 days</strong><br>(about 3 times per year)</p>
                </div>
            </div>
            
            <div style="margin-top: 30px; padding: 20px; background: var(--blood-gradient); color: white; border-radius: 15px; text-align: center;">
                <p><strong>Did you know?</strong> The average adult has about 10 pints of blood in their body. A standard donation is 1 pint. Your body replaces the fluid within 24 hours and red cells in 4-6 weeks.</p>
            </div>
        </div>

        <h2 class="scroll-animate"><i class="fas fa-microscope"></i> The Science of Blood</h2>
        
        <div class="card scroll-animate">
            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 30px;">
                <div>
                    <h3 style="color: var(--primary); margin-bottom: 15px;">
                        <i class="fas fa-atom"></i> Blood Composition
                    </h3>
                    <p>Blood is a complex connective tissue composed of <strong>plasma</strong> (55%) and <strong>formed elements</strong> (45%). Plasma contains water, proteins, electrolytes, and nutrients, while formed elements include red blood cells (erythrocytes), white blood cells (leukocytes), and platelets (thrombocytes).</p>
                    <p>Red blood cells contain <strong>hemoglobin</strong>, a protein that binds oxygen and gives blood its characteristic red color. Each RBC lives for about 120 days and is continuously replaced by the bone marrow.</p>
                </div>
                <div>
                    <h3 style="color: var(--primary); margin-bottom: 15px;">
                        <i class="fas fa-dna"></i> Blood Group Genetics
                    </h3>
                    <p>Blood groups are determined by <strong>antigens</strong> on the surface of red blood cells. The ABO system is based on A and B antigens, while the Rh system depends on the presence of the D antigen. These antigens are inherited from parents and follow Mendelian genetics.</p>
                    <p>Type O blood is considered the <strong>universal donor</strong> because it lacks A and B antigens, while Type AB is the <strong>universal recipient</strong> because it has both antigens and no antibodies.</p>
                </div>
                <div>
                    <h3 style="color: var(--primary); margin-bottom: 15px;">
                        <i class="fas fa-shield-alt"></i> Immune Response
                    </h3>
                    <p>When incompatible blood types are mixed, the immune system produces <strong>antibodies</strong> that attack foreign antigens, causing agglutination (clumping) and hemolysis (destruction of red cells). This can lead to serious complications including kidney failure and death.</p>
                    <p>Cross-matching tests are essential before any transfusion to ensure compatibility and prevent adverse reactions.</p>
                </div>
            </div>
        </div>

        <h2 class="scroll-animate"><i class="fas fa-cogs"></i> Blood Banking Process</h2>
        
        <div class="card scroll-animate">
            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)); gap: 25px;">
                <div style="text-align: center; padding: 25px; background: rgba(230, 57, 70, 0.1); border-radius: 15px; border-left: 4px solid var(--primary);">
                    <i class="fas fa-user-check" style="font-size: 2.5rem; color: var(--primary); margin-bottom: 20px;"></i>
                    <h4>1. Donor Screening</h4>
                    <p>Comprehensive health questionnaire, vital signs check, and hemoglobin testing to ensure donor safety and blood quality. Donors must meet age, weight, and health requirements.</p>
                </div>
                <div style="text-align: center; padding: 25px; background: rgba(69, 123, 157, 0.1); border-radius: 15px; border-left: 4px solid var(--accent);">
                    <i class="fas fa-tint" style="font-size: 2.5rem; color: var(--accent); margin-bottom: 20px;"></i>
                    <h4>2. Blood Collection</h4>
                    <p>Sterile collection using single-use equipment. Whole blood donation takes 8-10 minutes and collects approximately 450ml. Apheresis procedures can collect specific components.</p>
                </div>
                <div style="text-align: center; padding: 25px; background: rgba(29, 53, 87, 0.1); border-radius: 15px; border-left: 4px solid var(--dark);">
                    <i class="fas fa-flask" style="font-size: 2.5rem; color: var(--dark); margin-bottom: 20px;"></i>
                    <h4>3. Testing & Processing</h4>
                    <p>Blood is tested for infectious diseases (HIV, Hepatitis B/C, Syphilis, etc.), blood type, and antibodies. Components are separated using centrifugation for optimal use.</p>
                </div>
                <div style="text-align: center; padding: 25px; background: rgba(168, 218, 220, 0.1); border-radius: 15px; border-left: 4px solid var(--light);">
                    <i class="fas fa-warehouse" style="font-size: 2.5rem; color: var(--light); margin-bottom: 20px;"></i>
                    <h4>4. Storage & Distribution</h4>
                    <p>Blood components are stored under specific conditions: RBCs at 1-6°C for 42 days, platelets at 20-24°C for 5 days, plasma frozen at -18°C for 1 year.</p>
                </div>
            </div>
        </div>

        <h2 class="scroll-animate"><i class="fas fa-graduation-cap"></i> Blood Banking Theory</h2>
        
        <div class="card scroll-animate">
            <h3 style="color: var(--primary); margin-bottom: 20px; text-align: center;">
                <i class="fas fa-book-medical"></i> Comprehensive Blood Banking Knowledge
            </h3>
            
            <div style="margin-bottom: 30px;">
                <h4 style="color: var(--accent); margin-bottom: 15px;">
                    <i class="fas fa-history"></i> Historical Development
                </h4>
                <p>The concept of blood transfusion dates back to the 17th century, but modern blood banking began in the early 20th century. Dr. Karl Landsteiner's discovery of blood groups in 1901 revolutionized transfusion medicine. The first blood bank was established in 1937 at Cook County Hospital in Chicago, marking the beginning of organized blood collection and storage.</p>
                <p>During World War II, Dr. Charles Drew developed methods for processing and storing blood plasma, which could be shipped overseas without refrigeration. This innovation saved countless lives and established the foundation for modern blood banking practices.</p>
            </div>

            <div style="margin-bottom: 30px;">
                <h4 style="color : var(--accent); margin-bottom: 15px;">
                    <i class="fas fa-microscope"></i> Blood Component Therapy
                </h4>
                <p>Modern blood banking practices focus on <strong>component therapy</strong>, where whole blood is separated into its individual components (red cells, platelets, plasma, cryoprecipitate) to maximize the utility of each donation. This approach allows multiple patients to benefit from a single donation and reduces the risk of volume overload in recipients.</p>
                <p>Red blood cell concentrates are used to treat anemia and blood loss, platelets for bleeding disorders and cancer treatment, plasma for coagulation factor deficiencies, and cryoprecipitate for specific clotting factor needs.</p>
            </div>

            <div style="margin-bottom: 30px;">
                <h4 style="color: var(--accent); margin-bottom: 15px;">
                    <i class="fas fa-shield-virus"></i> Safety Protocols
                </h4>
                <p>Blood safety is paramount in modern blood banking. Multiple layers of protection include donor screening, laboratory testing, and post-donation monitoring. All donated blood is tested for HIV-1/2, Hepatitis B and C, Human T-lymphotropic virus (HTLV), Syphilis, West Nile virus, and other emerging pathogens.</p>
                <p>Quality assurance programs ensure that blood products meet strict standards for purity, potency, and safety. Regular audits, proficiency testing, and continuous monitoring help maintain the highest standards of blood banking practice.</p>
            </div>

            <div style="margin-bottom: 30px;">
                <h4 style="color: var(--accent); margin-bottom: 15px;">
                    <i class="fas fa-chart-line"></i> Supply Chain Management
                </h4>
                <p>Blood banking involves complex supply chain management to ensure adequate blood supply while minimizing waste. Blood has a limited shelf life, requiring careful inventory management and demand forecasting. Regional blood centers coordinate with hospitals to maintain optimal blood product levels.</p>
                <p>Emergency protocols ensure rapid response to mass casualty events, natural disasters, and other situations requiring large volumes of blood products. Mobile blood collection units and community outreach programs help maintain donor recruitment.</p>
            </div>

            <div style="margin-bottom: 30px;">
                <h4 style="color: var(--accent); margin-bottom: 15px;">
                    <i class="fas fa-globe"></i> Global Blood Banking
                </h4>
                <p>Blood banking practices vary globally, with developed countries having sophisticated systems and developing nations facing challenges in infrastructure, testing, and donor recruitment. The World Health Organization (WHO) promotes safe blood transfusion practices worldwide.</p>
                <p>International collaboration in blood banking includes sharing best practices, developing standardized protocols, and providing technical assistance to improve blood safety globally. Regular international conferences and research initiatives advance the field.</p>
            </div>

            <div style="background: var(--blood-gradient); color: white; padding: 25px; border-radius: 15px; text-align: center; margin-top: 30px;">
                <h4 style="margin-bottom: 15px;">
                    <i class="fas fa-lightbulb"></i> Future of Blood Banking
                </h4>
                <p>Emerging technologies in blood banking include pathogen reduction systems, artificial blood substitutes, and advanced testing methods. Research continues on extending blood product shelf life, improving donor experience, and developing synthetic blood components.</p>
                <p>Digital transformation is revolutionizing blood banking with electronic donor records, automated testing systems, and real-time inventory management. These innovations improve efficiency, safety, and accessibility of blood products worldwide.</p>
            </div>
        </div>

        <h2 class="scroll-animate"><i class="fas fa-heart"></i> The Impact of Blood Donation</h2>
        
        <div class="card scroll-animate">
            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 30px;">
                <div style="background: rgba(230, 57, 70, 0.05); padding: 25px; border-radius: 15px; border: 1px solid rgba(230, 57, 70, 0.2);">
                    <h3 style="color: var(--primary); margin-bottom: 15px;">
                        <i class="fas fa-users"></i> Community Impact
                    </h3>
                    <p>Blood donation creates a <strong>safety net</strong> for communities, ensuring that blood products are available when needed. Regular donors help maintain stable blood supplies and reduce dependency on emergency donations during crises.</p>
                    <p>Community blood drives foster a sense of solidarity and civic responsibility. They provide opportunities for education about health and wellness while building stronger, more resilient communities.</p>
                </div>
                <div style="background: rgba(69, 123, 157, 0.05); padding: 25px; border-radius: 15px; border: 1px solid rgba(69, 123, 157, 0.2);">
                    <h3 style="color: var(--accent); margin-bottom: 15px;">
                        <i class="fas fa-hospital-user"></i> Medical Advances
                    </h3>
                    <p>Blood banking supports <strong>medical innovation</strong> by providing essential resources for research, clinical trials, and new treatment protocols. Blood products are crucial for organ transplantation, cancer treatment, and emergency medicine.</p>
                    <p>Advances in blood banking technology have improved patient outcomes and expanded treatment options for various medical conditions, contributing to overall healthcare quality.</p>
                </div>
                <div style="background: rgba(29, 53, 87, 0.05); padding: 25px; border-radius: 15px; border: 1px solid rgba(29, 53, 87, 0.2);">
                    <h3 style="color: var(--dark); margin-bottom: 15px;">
                        <i class="fas fa-globe-americas"></i> Global Health
                    </h3>
                    <p>Blood donation contributes to <strong>global health security</strong> by ensuring adequate blood supplies for routine healthcare and emergency response. International blood banking networks support disaster relief and humanitarian efforts.</p>
                    <p>Safe blood transfusion practices prevent the spread of infectious diseases and improve maternal and child health outcomes worldwide, particularly in developing regions.</p>
                </div>
            </div>
        </div>
    </div>

    <div class="footer">
        <p style="font-size: 1.2rem; margin-bottom: 10px;">© LifeSaver Blood Bank System | Saving Lives One Donation at a Time</p>
        <p style="margin-bottom: 20px;">Contact us: sumtimehta.01@gmail.com | Emergency: 1-800-BLOOD-911</p>
        <div>
            <a href="#"><i class="fab fa-facebook-f"></i></a>
            <a href="#"><i class="fab fa-twitter"></i></a>
            <a href="#"><i class="fab fa-instagram"></i></a>
            <a href="#"><i class="fab fa-linkedin-in"></i></a>
        </div>
    </div>

    <script>
        // Intersection Observer for scroll animations
        const observerOptions = {
            threshold: 0.1,
            rootMargin: '0px 0px -50px 0px'
        };

        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('visible');
                }
            });
        }, observerOptions);

        // Observe all scroll-animate elements
        document.querySelectorAll('.scroll-animate').forEach(el => {
            observer.observe(el);
        });

        // Add loading animation delay
        document.querySelectorAll('.loading').forEach((el, index) => {
            el.style.animationDelay = `${index * 0.2}s`;
        });

        // Parallax effect for hero section
        window.addEventListener('scroll', () => {
            const scrolled = window.pageYOffset;
            const hero = document.querySelector('.hero');
            if (hero) {
                hero.style.transform = `translateY(${scrolled * 0.5}px)`;
            }
        });

        // Add hover sound effect (optional)
        document.querySelectorAll('.stat-box, .blood-type, .donate-btn').forEach(el => {
            el.addEventListener('mouseenter', () => {
                el.style.transform = el.style.transform + ' scale(1.05)';
            });
            
            el.addEventListener('mouseleave', () => {
                el.style.transform = el.style.transform.replace(' scale(1.05)', '');
            });
        });

        // Smooth scrolling for anchor links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    target.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                }
            });
        });
    </script>
</body>
</html>