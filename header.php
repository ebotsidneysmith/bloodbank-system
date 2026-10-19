<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LifeBlood Donation System</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap');
        
        :root {
            --primary: #e63946;
            --secondary: #f1faee;
            --accent: #457b9d;
            --dark: #1d3557;
            --light: #a8dadc;
            --blood-gradient: linear-gradient(135deg, #e63946 0%, #c1121f 100%);
            --glass: rgba(255, 255, 255, 0.1);
            --glass-border: rgba(255, 255, 255, 0.2);
            --white: #fff;
            --black: #222;
        }
        
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            background-image: 
                linear-gradient(135deg, rgba(102, 126, 234, 0.95) 0%, rgba(118, 75, 162, 0.95) 100%),
                url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1200 800"><defs><pattern id="header-pattern" x="0" y="0" width="100" height="100" patternUnits="userSpaceOnUse"><circle cx="25" cy="25" r="3" fill="%23e63946" opacity="0.08"/><circle cx="75" cy="45" r="2" fill="%23e63946" opacity="0.06"/><circle cx="45" cy="75" r="1.5" fill="%23e63946" opacity="0.04"/><path d="M15 60 Q35 40 55 60 T95 60" stroke="%23e63946" stroke-width="0.8" fill="none" opacity="0.03"/><rect x="10" y="10" width="5" height="5" fill="%23e63946" opacity="0.05"/><rect x="85" y="85" width="3" height="3" fill="%23e63946" opacity="0.04"/></pattern></defs><rect width="1200" height="800" fill="url(%23header-pattern)"/></svg>');
            background-attachment: fixed;
            background-size: cover;
            min-height: 100vh;
            overflow-x: hidden;
        }
        
        /* Animated Background Elements */
        body::before {
            content: '';
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: 
                radial-gradient(circle at 20% 80%, rgba(230, 57, 70, 0.1) 0%, transparent 50%),
                radial-gradient(circle at 80% 20%, rgba(69, 123, 157, 0.1) 0%, transparent 50%),
                radial-gradient(circle at 40% 40%, rgba(168, 218, 220, 0.05) 0%, transparent 50%);
            pointer-events: none;
            z-index: -1;
            animation: float 20s ease-in-out infinite;
        }
        
        @keyframes float {
            0%, 100% { transform: translateY(0px) rotate(0deg); }
            50% { transform: translateY(-20px) rotate(180deg); }
        }
        
        #page {
            max-width: 1200px;
            margin: 0 auto;
            position: relative;
        }
        
        #header {
            background: rgba(29, 53, 87, 0.95);
            backdrop-filter: blur(15px);
            padding: 0 20px;
            position: sticky;
            top: 0;
            z-index: 1000;
            box-shadow: 0 8px 32px rgba(0,0,0,0.1);
            border-bottom: 1px solid var(--glass-border);
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        }
        
        #header:hover {
            background: rgba(29, 53, 87, 0.98);
            box-shadow: 0 12px 40px rgba(0,0,0,0.15);
        }
        
        #header > div {
            display: flex;
            justify-content: space-between;
            align-items: center;
            height: 80px;
        }
        
        .logo {
            height: 60px;
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            position: relative;
            overflow: hidden;
        }
        
        .logo::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent);
            transition: left 0.6s;
        }
        
        .logo:hover::before {
            left: 100%;
        }
        
        .logo:hover {
            transform: scale(1.05) rotate(2deg);
            filter: drop-shadow(0 10px 20px rgba(230, 57, 70, 0.3));
        }
        
        .logo img {
            height: 100%;
            width: auto;
            filter: drop-shadow(0 2px 4px rgba(0,0,0,0.2));
        }
        
        #navigation {
            display: flex;
            list-style: none;
            margin: 0;
            padding: 0;
            gap: 5px;
        }
        
        #navigation li {
            position: relative;
        }
        
        #navigation li a {
            color: var(--white);
            text-decoration: none;
            font-weight: 500;
            padding: 12px 18px;
            border-radius: 25px;
            display: block;
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            position: relative;
            overflow: hidden;
            font-size: 14px;
        }
        
        #navigation li a::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.1), transparent);
            transition: left 0.5s;
        }
        
        #navigation li a:hover::before {
            left: 100%;
        }
        
        #navigation li a::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 50%;
            width: 0;
            height: 3px;
            background: var(--blood-gradient);
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            transform: translateX(-50%);
            border-radius: 2px;
        }
        
        #navigation li a:hover {
            background: rgba(255,255,255,0.1);
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0,0,0,0.2);
        }
        
        #navigation li a:hover::after {
            width: 70%;
        }
        
        #navigation li.selected a {
            background: var(--blood-gradient);
            box-shadow: 0 5px 15px rgba(230, 57, 70, 0.3);
        }
        
        #navigation li.selected a::after {
            width: 70%;
            background: var(--white);
        }
        
        .menu ul {
            position: absolute;
            top: 100%;
            left: 0;
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(15px);
            list-style: none;
            padding: 0;
            margin: 0;
            width: 220px;
            box-shadow: 0 15px 35px rgba(0,0,0,0.1);
            border-radius: 15px;
            opacity: 0;
            visibility: hidden;
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            transform: translateY(10px) scale(0.95);
            border: 1px solid var(--glass-border);
        }
        
        .menu:hover ul {
            opacity: 1;
            visibility: visible;
            transform: translateY(0) scale(1);
        }
        
        .menu ul li a {
            color: var(--dark);
            padding: 15px 20px;
            border-bottom: 1px solid rgba(0,0,0,0.05);
            border-radius: 0;
            font-weight: 400;
        }
        
        .menu ul li a:hover {
            background: var(--blood-gradient);
            color: var(--white);
            transform: translateX(5px);
        }
        
        .menu ul li:first-child a {
            border-radius: 15px 15px 0 0;
        }
        
        .menu ul li:last-child a {
            border-bottom: none;
            border-radius: 0 0 15px 15px;
        }
        
        .pulse {
            animation: pulse 2s infinite;
        }
        
        @keyframes pulse {
            0% { 
                box-shadow: 0 0 0 0 rgba(230, 57, 70, 0.4);
                transform: scale(1);
            }
            50% { 
                box-shadow: 0 0 0 10px rgba(230, 57, 70, 0);
                transform: scale(1.02);
            }
            100% { 
                box-shadow: 0 0 0 0 rgba(230, 57, 70, 0);
                transform: scale(1);
            }
        }
        
        .donate-btn {
            background: var(--blood-gradient) !important;
            color: var(--white) !important;
            font-weight: 600;
            padding: 12px 25px !important;
            border-radius: 50px;
            margin-left: 10px;
            animation: pulse 2s infinite;
            box-shadow: 0 5px 15px rgba(230, 57, 70, 0.3);
            border: 2px solid rgba(255,255,255,0.2);
        }
        
        .donate-btn:hover {
            background: linear-gradient(135deg, #c1121f 0%, #a00 100%) !important;
            transform: translateY(-3px) scale(1.05);
            box-shadow: 0 10px 25px rgba(230, 57, 70, 0.4);
        }
        
        .donate-btn::before {
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.3), transparent);
        }
        
        .mobile-menu-btn {
            display: none;
            color: white;
            font-size: 24px;
            cursor: pointer;
            padding: 10px;
            border-radius: 8px;
            transition: all 0.3s ease;
        }
        
        .mobile-menu-btn:hover {
            background: rgba(255,255,255,0.1);
            transform: scale(1.1);
        }
        
        /* Enhanced Mobile Styles */
        @media (max-width: 768px) {
            .mobile-menu-btn {
                display: block;
            }
            
            #navigation {
                position: fixed;
                top: 80px;
                left: 0;
                width: 100%;
                background: rgba(29, 53, 87, 0.98);
                backdrop-filter: blur(15px);
                flex-direction: column;
                padding: 20px 0;
                transform: translateY(-150%);
                transition: transform 0.4s cubic-bezier(0.4, 0, 0.2, 1);
                border-bottom: 1px solid var(--glass-border);
            }
            
            #navigation.active {
                transform: translateY(0);
            }
            
            #navigation li {
                margin: 5px 0;
                width: 100%;
            }
            
            #navigation li a {
                padding: 15px 25px;
                border-radius: 0;
                text-align: center;
                font-size: 16px;
            }
            
            .menu ul {
                position: static;
                width: 100%;
                box-shadow: none;
                border-radius: 0;
                display: none;
                background: rgba(255,255,255,0.1);
                backdrop-filter: blur(10px);
            }
            
            .menu:hover ul {
                display: block;
                transform: none;
            }
            
            .menu ul li a {
                color: var(--white);
                border-bottom: 1px solid rgba(255,255,255,0.1);
            }
            
            .menu ul li a:hover {
                background: rgba(230, 57, 70, 0.3);
                color: var(--white);
            }
            
            .donate-btn {
                margin: 10px 0;
                width: 90%;
                text-align: center;
            }
        }
        
        /* Loading Animation */
        .fade-in {
            opacity: 0;
            animation: fadeIn 0.8s ease-out forwards;
        }
        
        @keyframes fadeIn {
            to { opacity: 1; }
        }
        
        /* Glow Effect */
        .glow {
            box-shadow: 0 0 20px rgba(230, 57, 70, 0.3);
        }
        
        /* Hover Effects */
        .hover-lift {
            transition: transform 0.3s ease;
        }
        
        .hover-lift:hover {
            transform: translateY(-5px);
        }
    </style>
</head>
<body>
    <div id="page">
        <div id="header">
            <div>
                <a href="index.html" class="logo hover-lift">
                    <img src="images/logo.png" alt="LifeBlood Logo">
                </a>
                <div class="mobile-menu-btn">
                    <i class="fas fa-bars"></i>
                </div>
                <ul id="navigation">
                    <li class="selected fade-in">
                        <a href="index.html"><i class="fas fa-home"></i> Home</a>
                    </li>
                    <li class="fade-in">
                        <a href="about.html"><i class="fas fa-info-circle"></i> About</a>
                    </li>
                    <li class="menu fade-in">
                        <a href="projects.html"><i class="fas fa-project-diagram"></i> Projects <i class="fas fa-chevron-down"></i></a>
                        <ul class="primary">
                            <li>
                                <a href="proj1.html">Blood Drive 2025</a>
                            </li>
                            <li>
                                <a href="proj2.html">Community Outreach</a>
                            </li>
                            <li>
                                <a href="proj3.html">Mobile Donation Units</a>
                            </li>
                        </ul>
                    </li>
                    <li class="menu fade-in">
                        <a href="blog.html"><i class="fas fa-newspaper"></i> Blog <i class="fas fa-chevron-down"></i></a>
                        <ul class="secondary">
                            <li>
                                <a href="singlepost.html">Success Stories</a>
                            </li>
                            <li>
                                <a href="news.html">Latest News</a>
                            </li>
                        </ul>
                    </li>
                    <li class="fade-in">
                        <a href="contact.html"><i class="fas fa-envelope"></i> Contact</a>
                    </li>
                    <li class="fade-in">
                        <a href="donate.html" class="donate-btn glow"><i class="fas fa-tint"></i> Donate Now</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>

    <script>
        // Mobile menu toggle with enhanced animation
        document.querySelector('.mobile-menu-btn').addEventListener('click', function() {
            const nav = document.getElementById('navigation');
            nav.classList.toggle('active');
            
            // Add rotation to hamburger icon
            const icon = this.querySelector('i');
            icon.style.transform = nav.classList.contains('active') ? 'rotate(90deg)' : 'rotate(0deg)';
        });
        
        // Add active class to current page with smooth transition
        const currentPage = window.location.pathname.split('/').pop();
        const navLinks = document.querySelectorAll('#navigation li a');
        
        navLinks.forEach(link => {
            if (link.getAttribute('href') === currentPage) {
                link.parentElement.classList.add('selected');
                link.parentElement.style.animationDelay = '0.2s';
            }
        });
        
        // Enhanced smooth scroll for anchor links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function(e) {
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
        
        // Add scroll effect to header
        window.addEventListener('scroll', () => {
            const header = document.getElementById('header');
            if (window.scrollY > 50) {
                header.style.background = 'rgba(29, 53, 87, 0.98)';
                header.style.boxShadow = '0 12px 40px rgba(0,0,0,0.15)';
            } else {
                header.style.background = 'rgba(29, 53, 87, 0.95)';
                header.style.boxShadow = '0 8px 32px rgba(0,0,0,0.1)';
            }
        });
        
        // Add staggered animation delay to navigation items
        document.querySelectorAll('#navigation li').forEach((item, index) => {
            item.style.animationDelay = `${index * 0.1}s`;
        });
        
        // Add hover sound effect simulation
        document.querySelectorAll('#navigation li a').forEach(link => {
            link.addEventListener('mouseenter', () => {
                link.style.transform = 'translateY(-2px) scale(1.02)';
            });
            
            link.addEventListener('mouseleave', () => {
                link.style.transform = 'translateY(0) scale(1)';
            });
        });
    </script>
</body>
</html>
