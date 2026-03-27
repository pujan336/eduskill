<!-- Components/navbar.php -->
<nav class="navigation">
    <div class="logo">
        <img src="image/211.png" alt="Website Logo">
    </div>

    <div class="bar">
        <a href="index.php">Home</a>
        <a href="../Pages/contain.php">Content</a>
        <a href="#">Image</a>
        <a href="../Pages/about.php">About</a>
    </div>

    <div class="loginButton">
        <!-- Login and Signup buttons -->
        <a href="registration-system/login.php">Login</a>
        <a href="registration-system/register.php">Sign Up</a>
    </div>
</nav>

<style>
    /* NAVIGATION BAR */
    .navigation {
        height: 70px;
        width: 100%;
        display: flex;
        justify-content: space-between;
        align-items: center;
        background: #1e2a38;
        padding: 0 40px;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.15);
    }

    /* LOGO */
    .logo img {
        width: 120px;
    }

    /* NAV LINKS */
    .bar a {
        color: #ffffff;
        margin: 0 18px;
        text-decoration: none;
        font-size: 16px;
        position: relative;
    }

    /* HOVER UNDERLINE EFFECT */
    .bar a::after {
        content: "";
        position: absolute;
        width: 0%;
        height: 2px;
        background: #ff7a18;
        left: 0;
        bottom: -5px;
        transition: 0.3s;
    }

    .bar a:hover::after {
        width: 100%;
    }

    /* LOGIN AND SIGNUP BUTTONS */
    .loginButton a {
        padding: 8px 18px;
        margin-left: 10px;
        border-radius: 4px;
        font-size: 14px;
        text-decoration: none;
        transition: 0.3s;
    }

    /* LOGIN BUTTON */
    .loginButton a.login {
        background: transparent;
        color: white;
        border: 1px solid white;
    }

    .loginButton a.login:hover {
        background: white;
        color: #1e2a38;
    }

    /* SIGNUP BUTTON */
    .loginButton a.signup {
        background: #ff7a18;
        color: white;
    }

    .loginButton a.signup:hover {
        background: #e56710;
    }
</style>