<?php
if (!isset($ROOT)) {
    require_once __DIR__ . '/paths.php';
}
?>
<footer class="site-footer">
    <div class="footer-grid">
        <div class="footer-brand">
            <img src="<?php echo htmlspecialchars($ROOT); ?>image/211.png" alt="EduSkill">
            <p>Practical courses, clear outcomes, and support that fits real schedules.</p>
        </div>
        <div>
            <h3>Explore</h3>
            <ul>
                <li><a href="<?php echo htmlspecialchars($ROOT); ?>index.php">Home</a></li>
                <li><a href="<?php echo htmlspecialchars($ROOT); ?>Pages/courses.php">Courses</a></li>
                <li><a href="<?php echo htmlspecialchars($ROOT); ?>Pages/about.php">About</a></li>
                <li><a href="<?php echo htmlspecialchars($ROOT); ?>Pages/faq.php">FAQ</a></li>
            </ul>
        </div>
        <div>
            <h3>Contact</h3>
            <div class="footer-contact">
                <p>Email: <a href="mailto:info@eduskill.com">info@eduskill.com</a></p>
                <p>Phone: +977 980xxxxxxx</p>
            </div>
        </div>
        <div>
            <h3>Follow</h3>
            <div class="footer-social">
                <a href="#" target="_blank" rel="noopener">Facebook</a>
                <a href="#" target="_blank" rel="noopener">Instagram</a>
                <a href="#" target="_blank" rel="noopener">LinkedIn</a>
            </div>
        </div>
    </div>
    <div class="footer-bottom">
        <p>&copy; <?php echo date('Y'); ?> EduSkill. All rights reserved.</p>
    </div>
</footer>
