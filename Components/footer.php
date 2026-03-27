<!-- footer.php -->
<footer>
    <div class="footer-container">
        <!-- Brand / Logo -->
        <div class="footer-brand">
            <img src="image/211.png" alt="footerlogo">
            <p>Empowering Skills for the Future</p>
        </div>

        <!-- Quick Links -->
        <div class="footer-links">
            <h3>Quick Links</h3>
            <ul>
                <li><a href="index.php">Home</a></li>
                <li><a href="courses.php">Courses</a></li>
                <li><a href="about.php">About Us</a></li>
                <li><a href="contact.php">Contact</a></li>
            </ul>
        </div>

        <!-- Contact Info -->
        <div class="footer-contact">
            <h3>Contact Us</h3>
            <p>Email: info@sduskill.com</p>
            <p>Phone: +977 980xxxxxxx</p>
        </div>

        <!-- Social Media -->
        <div class="footer-social">
            <h3>Follow Us</h3>
            <a href="#" target="_blank">Facebook</a>
            <a href="#" target="_blank">Instagram</a>
            <a href="#" target="_blank">LinkedIn</a>
        </div>
    </div>

    <div class="footer-bottom">
        <p>&copy; <?php echo date("Y"); ?> SDU Skill. All Rights Reserved.</p>
    </div>
</footer>

<style>
    /* FOOTER BASE */
    footer {
        background: #1f1e1e;
        /* Dark like navbar */
        color: #fff;
        padding: 40px 20px 20px 20px;
        font-family: Arial, sans-serif;
    }

    /* FLEX CONTAINER */
    .footer-container {
        display: flex;
        flex-wrap: wrap;
        justify-content: space-between;
        align-items: flex-start;
        max-width: 1200px;
        margin: auto;
        gap: 20px;
    }

    /* EACH SECTION */
    .footer-container>div {
        flex: 1 1 200px;
        margin: 10px 0;
    }

    /* BRAND */
    .footer-brand img {
        width: 180px;
        margin-bottom: 10px;
    }

    .footer-brand p {
        font-size: 0.9rem;
        color: #ccc;
    }

    /* LINKS */
    .footer-links h3,
    .footer-contact h3,
    .footer-social h3 {
        margin-bottom: 10px;
        font-size: 1.1rem;
        color: #fff;
    }

    .footer-links ul {
        list-style: none;
        padding: 0;
    }

    .footer-links ul li {
        margin: 6px 0;
    }

    .footer-links ul li a {
        color: #ccc;
        text-decoration: none;
        transition: color 0.3s;
    }

    .footer-links ul li a:hover {
        color: #ff6600;
        /* match hero button color */
    }

    /* CONTACT INFO */
    .footer-contact p {
        margin: 5px 0;
        color: #ccc;
        font-size: 0.9rem;
    }

    /* SOCIAL LINKS */
    .footer-social a {
        display: inline-block;
        margin-right: 10px;
        color: #ccc;
        text-decoration: none;
        transition: color 0.3s;
    }

    .footer-social a:hover {
        color: #ff6600;
    }

    /* BOTTOM TEXT */
    .footer-bottom {
        text-align: center;
        border-top: 1px solid #333;
        margin-top: 30px;
        padding-top: 15px;
        font-size: 0.9rem;
        color: #ccc;
    }

    /* RESPONSIVE */
    @media (max-width: 768px) {
        .footer-container {
            flex-direction: column;
            align-items: center;
            text-align: center;
        }

        .footer-links ul li,
        .footer-social a {
            display: inline-block;
            margin: 5px 10px;
        }
    }
</style>