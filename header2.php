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
    
    /* Navigation */
    .topnav {
        background: linear-gradient(135deg, rgba(192, 57, 43, 0.95) 0%, rgba(231, 76, 60, 0.9) 50%, rgba(192, 57, 43, 0.95) 100%);
        backdrop-filter: blur(10px);
        overflow: hidden;
        box-shadow: 0 8px 32px rgba(192, 57, 43, 0.3);
        position: sticky;
        top: 0;
        z-index: 1000;
        border-bottom: 2px solid rgba(231, 76, 60, 0.5);
    }
    
    .topnav a {
        float: left;
        color: white;
        text-align: center;
        padding: 20px 25px;
        text-decoration: none;
        font-size: 16px;
        font-weight: 500;
        transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        position: relative;
        overflow: hidden;
    }
    
    .topnav a::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent);
        transition: left 0.5s;
    }
    
    .topnav a:hover::before {
        left: 100%;
    }
    
    .topnav a:hover {
        background: var(--blood-gradient);
        transform: translateY(-2px);
        box-shadow: 0 10px 20px rgba(230, 57, 70, 0.3);
    }
    
    .topnav a.active {
        background: linear-gradient(135deg, rgba(231, 76, 60, 0.9) 0%, rgba(192, 57, 43, 0.8) 100%);
        font-weight: 600;
        box-shadow: 0 5px 15px rgba(192, 57, 43, 0.5);
        border: 1px solid rgba(255, 255, 255, 0.3);
    }
    
    /* Responsive Design */
    @media (max-width: 768px) {
        .topnav a {
            padding: 15px 10px;
            font-size: 14px;
        }
    }
</style>

<div class="topnav">
    <a class="active" href="index.php"><i class="fas fa-home"></i> Home</a>
    <a href="reg.php"><i class="fas fa-user-plus"></i> Donor Register</a>
    <a href="search1.php"><i class="fas fa-search"></i> Search</a>
    <a href="login.php"><i class="fas fa-book"></i>Login</a>
    <a href="logout.php"><i class="fas fa-sign-out-alt"></i> Log Out</a>
</div> 