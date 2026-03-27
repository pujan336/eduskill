<?php
session_start();
include "db.php";

if (!isset($_SESSION['student_id'])) {
    header("Location: login.php");
    exit();
}

$studentId = $_SESSION['student_id'];
$studentName = $_SESSION['student_name'];
$studentEmail = $_SESSION['email'] ?? 'Not Available';

/* Fetch assigned courses */
$query = "
SELECT c.title, c.description, c.status, p.fullname AS provider_name
FROM student_courses sc
JOIN courses c ON sc.course_id = c.id
JOIN providers p ON c.provider_id = p.id
WHERE sc.student_id = ?
ORDER BY sc.assigned_at DESC
";

$stmt = $conn->prepare($query);
$stmt->bind_param("i", $studentId);
$stmt->execute();
$result = $stmt->get_result();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EduSkill Dashboard</title>

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Arial, sans-serif;
        }

        body {
            display: flex;
            flex-direction: column;
            min-height: 100vh;
            background: #f0f0f0;
        }

        .page-container {
            display: flex;
            flex: 1;
        }

        .navbar {
            width: 220px;
            background: #6a0dad;
            color: white;
            display: flex;
            flex-direction: column;
            padding: 20px;
            height: 100vh;
            position: fixed;
        }

        .navbar h2 img {
            width: 120px;
            display: block;
            margin: 0 auto 20px auto;
        }

        .navbar a {
            color: white;
            text-decoration: none;
            padding: 12px;
            margin: 5px 0;
            border-radius: 5px;
            font-weight: bold;
        }

        .navbar a:hover {
            background: #4b0082;
        }

        .main-content {
            margin-left: 240px;
            padding: 30px;
            flex: 1;
        }

        .profile-box {
            max-width: 900px;
            margin-bottom: 30px;
            background: #f8f8f8;
            padding: 20px 30px;
            border-radius: 10px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }

        .profile-box h3 {
            margin-bottom: 10px;
            color: #6a0dad;
        }

        .profile-box p {
            margin: 5px 0;
            font-size: 16px;
        }

        .courses-container {
            max-width: 900px;
            margin-bottom: 30px;
            display: flex;
            flex-direction: column;
            gap: 15px;
        }

        .course-card {
            background: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }

        .course-card h4 {
            margin-bottom: 8px;
            color: #6a0dad;
        }

        .course-card p {
            font-size: 15px;
            color: #333;
        }

        .status-approved {
            color: green;
            font-weight: bold;
        }

        .status-pending {
            color: orange;
            font-weight: bold;
        }

        .status-denied {
            color: red;
            font-weight: bold;
        }

        .slider {
            position: relative;
            max-width: 900px;
            margin: 0 auto 50px auto;
            overflow: hidden;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3);
        }

        .slide {
            display: none;
            width: 100%;
            height: 400px;
            position: relative;
        }

        .slide img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .caption {
            position: absolute;
            bottom: 30px;
            left: 30px;
            background: rgba(0, 0, 0, 0.5);
            color: white;
            padding: 15px 20px;
            border-radius: 10px;
            font-size: 18px;
        }

        .prev,
        .next {
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            background: rgba(0, 0, 0, 0.5);
            color: white;
            padding: 12px;
            border-radius: 50%;
            cursor: pointer;
            font-size: 18px;
        }

        .prev {
            left: 20px;
        }

        .next {
            right: 20px;
        }

        .prev:hover,
        .next:hover {
            background: rgba(0, 0, 0, 0.8);
        }

        .dots {
            text-align: center;
            margin-top: 15px;
        }

        .dot {
            height: 12px;
            width: 12px;
            margin: 0 5px;
            background-color: #bbb;
            display: inline-block;
            border-radius: 50%;
            cursor: pointer;
        }

        .active,
        .dot:hover {
            background-color: #6a0dad;
        }

        .footer {
            text-align: center;
            padding: 20px;
            background: #6a0dad;
            color: white;
            margin-top: auto;
        }
    </style>
</head>

<body>

    <div class="page-container">

        <div class="navbar">
            <h2><img src="../image/211.png" alt="logo"></h2>
            <a href="dashboard.php">Dashboard</a>
            <a href="mycourses.php">My Courses</a>
            <a href="profile.php">Profile</a>
            <a href="logout.php">Logout</a>
        </div>

        <div class="main-content">

            <div class="profile-box">
                <h3>Welcome, <?php echo htmlspecialchars($studentName); ?>!</h3>
                <p><strong>Name:</strong> <?php echo htmlspecialchars($studentName); ?></p>
                <p><strong>Email:</strong> <?php echo htmlspecialchars($studentEmail); ?></p>
            </div>

            <div class="courses-container">
                <h3 style="color:#6a0dad;margin-bottom:10px;">Assigned Courses</h3>

                <?php if ($result->num_rows > 0): ?>
                    <?php while ($course = $result->fetch_assoc()): ?>
                        <div class="course-card">
                            <h4><?php echo htmlspecialchars($course['title']); ?></h4>
                            <p><?php echo htmlspecialchars($course['description']); ?></p>
                            <p><strong>Provider:</strong> <?php echo htmlspecialchars($course['provider_name']); ?></p>
                            <p><strong>Status:</strong>
                                <span class="status-<?php echo $course['status']; ?>">
                                    <?php echo ucfirst($course['status']); ?>
                                </span>
                            </p>
                        </div>
                    <?php endwhile; ?>
                <?php else: ?>
                    <p>No courses assigned yet.</p>
                <?php endif; ?>
            </div>

            <!-- Slider -->
            <div class="slider">
                <div class="slide">
                    <img src="../image/image1.jpg">
                    <div class="caption">Learn Web Development from scratch</div>
                </div>

                <div class="slide">
                    <img src="../image/programming_image.jpg">
                    <div class="caption">Master Python Programming</div>
                </div>

                <div class="slide">
                    <img src="../image/python.jpg">
                    <div class="caption">Boost your career with AI skills</div>
                </div>

                <a class="prev" onclick="plusSlides(-1)">&#10094;</a>
                <a class="next" onclick="plusSlides(1)">&#10095;</a>
            </div>

            <div class="dots">
                <span class="dot" onclick="currentSlide(1)"></span>
                <span class="dot" onclick="currentSlide(2)"></span>
                <span class="dot" onclick="currentSlide(3)"></span>
            </div>

        </div>
    </div>

    <div class="footer">
        &copy; <?php echo date('Y'); ?> EduSkill. All rights reserved.
    </div>

    <script>
        let slideIndex = 1;
        showSlides(slideIndex);

        function plusSlides(n) {
            showSlides(slideIndex += n);
        }

        function currentSlide(n) {
            showSlides(slideIndex = n);
        }

        function showSlides(n) {
            let i;
            let slides = document.getElementsByClassName("slide");
            let dots = document.getElementsByClassName("dot");

            if (n > slides.length) {
                slideIndex = 1
            }
            if (n < 1) {
                slideIndex = slides.length
            }

            for (i = 0; i < slides.length; i++) {
                slides[i].style.display = "none";
            }
            for (i = 0; i < dots.length; i++) {
                dots[i].className = dots[i].className.replace(" active", "");
            }

            slides[slideIndex - 1].style.display = "block";
            dots[slideIndex - 1].className += " active";
        }

        setInterval(() => {
            plusSlides(1);
        }, 5000);
    </script>

</body>

</html>