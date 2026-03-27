<?php
$enrollMessage = "";
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['course_name'])) {
    $course = htmlspecialchars($_POST['course_name']);
    $enrollMessage = "You have successfully enrolled in <b>$course</b>!";
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EduSkill LMS</title>

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Arial;
        }

        body {
            background: #f4f6f9;
        }

        /* NAVBAR */
        nav {
            background: #0d1b2a;
            color: white;
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 15px 40px;
            position: sticky;
            top: 0;
            z-index: 1000;
        }

        nav a {
            color: white;
            margin-left: 20px;
            text-decoration: none;
        }

        nav a:hover {
            color: #ff6600;
        }

        .logo img {
            width: 150px;
        }

        /* HERO */
        .slider {
            position: relative;
            height: 70vh;
            overflow: hidden;
        }

        .slide {
            position: absolute;
            width: 100%;
            height: 100%;
            object-fit: cover;
            opacity: 0;
            transition: 1s;
        }

        .slide.active {
            opacity: 1;
        }

        .slider::after {
            content: "";
            position: absolute;
            inset: 0;
            background: linear-gradient(to right, rgba(0, 0, 0, 0.8), rgba(0, 0, 0, 0.2));
        }

        .hero-text {
            position: absolute;
            top: 35%;
            left: 8%;
            color: white;
            z-index: 2;
            max-width: 500px;
        }

        .hero-text h1 {
            font-size: 3rem;
            margin-bottom: 10px;
        }

        .hero-text button {
            padding: 12px 25px;
            background: #ff6600;
            border: none;
            color: white;
            cursor: pointer;
            margin-top: 10px;
        }

        /* TITLES */
        .section-title {
            text-align: center;
            margin: 70px 0 30px;
            font-size: 2rem;
            color: #0d1b2a;
        }

        /* CATEGORIES */
        .categories {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
            max-width: 1200px;
            margin: auto;
            padding: 0 20px;
        }

        .card {
            position: relative;
            overflow: hidden;
            border-radius: 8px;
        }

        .card img {
            width: 100%;
            height: 220px;
            object-fit: cover;
            transition: .4s;
        }

        .card:hover img {
            transform: scale(1.1);
        }

        .overlay {
            position: absolute;
            inset: 0;
            background: rgba(0, 0, 0, .5);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 1.5rem;
            font-weight: bold;
        }

        /* COURSES */
        .courses-container {
            display: flex;
            gap: 20px;
            overflow-x: auto;
            padding: 20px;
        }

        .course-card {
            background: white;
            min-width: 270px;
            border-radius: 8px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            transition: .3s;
        }

        .course-card:hover {
            transform: translateY(-6px);
        }

        .course-card img {
            width: 100%;
            height: 150px;
            object-fit: cover;
        }

        .course-info {
            padding: 15px;
        }

        .course-info h3 {
            margin-bottom: 5px;
        }

        .course-info p {
            font-size: .9rem;
            color: #555;
            margin-bottom: 10px;
        }

        .price {
            padding: 4px 10px;
            border-radius: 5px;
            color: white;
            font-size: .8rem;
        }

        .free {
            background: #28a745;
        }

        .paid {
            background: #dc3545;
        }

        .rating {
            color: #f4b400;
            margin: 5px 0;
            font-size: 14px;
        }

        .enroll-btn {
            margin-top: 8px;
            padding: 8px 15px;
            border: none;
            background: #ff6600;
            color: white;
            cursor: pointer;
            border-radius: 4px;
            width: 100%;
        }

        .enroll-btn:hover {
            background: #e65c00;
        }

        /* LEARNING TOOLS */
        .tools {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
            max-width: 1100px;
            margin: 40px auto;
            padding: 0 20px;
        }

        .tool-card {
            background: white;
            padding: 25px;
            text-align: center;
            border-radius: 8px;
            box-shadow: 0 5px 10px rgba(0, 0, 0, .1);
        }

        .tool-card h3 {
            margin-bottom: 10px;
        }

        /* ABOUT */
        .about {
            display: flex;
            gap: 40px;
            max-width: 1100px;
            margin: 60px auto;
            align-items: center;
            padding: 0 20px;
        }

        .about img {
            width: 50%;
            border-radius: 8px;
        }

        .about ul {
            margin-top: 10px;
        }

        .about li {
            margin-bottom: 6px;
        }

        /* TESTIMONIALS */
        .testimonials {
            background: #e9ecef;
            padding: 50px 20px;
            text-align: center;
        }

        .review {
            background: white;
            padding: 20px;
            margin: 15px auto;
            max-width: 420px;
            border-radius: 8px;
            box-shadow: 0 3px 8px rgba(0, 0, 0, .1);
        }

        .review .stars {
            color: #f4b400;
            font-size: 18px;
            margin-bottom: 8px;
        }

        /* CTA */
        .cta {
            background: #ff6600;
            color: white;
            text-align: center;
            padding: 60px 20px;
        }

        .cta button {
            margin-top: 15px;
            padding: 12px 30px;
            background: white;
            color: #ff6600;
            border: none;
            font-weight: bold;
        }

        /* FOOTER */
        footer {
            background: #0d1b2a;
            color: white;
            padding: 40px 20px;
        }

        .footer-container {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
            max-width: 1200px;
            margin: auto;
        }

        .footer-container div {
            flex: 1 1 200px;
        }

        .footer-container a {
            color: #ccc;
            text-decoration: none;
        }

        .footer-container a:hover {
            color: #ff6600;
        }

        .footer-bottom {
            text-align: center;
            border-top: 1px solid #333;
            margin-top: 20px;
            padding-top: 10px;
        }

        @media(max-width:768px) {
            .about {
                flex-direction: column;
            }

            .about img {
                width: 100%;
            }
        }
    </style>
</head>

<body>

    <?php include './Components/navbar.php' ?>

    <div class="slider">
        <div class="hero-text">
            <h1>Upgrade Your Skills Today</h1>
            <p>Learn from industry experts and get certified.</p>
            <button>Browse Courses</button>
        </div>

        <?php
        $images = glob("image/*.{jpg,jpeg,png}", GLOB_BRACE);
        $first = true;
        foreach ($images as $img) {
            echo "<img src='$img' class='slide " . ($first ? 'active' : '') . "'>";
            $first = false;
        }
        ?>
    </div>

    <h2 class="section-title">Explore Categories</h2>
    <section class="categories">
        <div class="card"><img src="image/programming_image.jpg">
            <div class="overlay">Programming</div>
        </div>
        <div class="card"><img src="image/python.jpg">
            <div class="overlay">Design</div>
        </div>
        <div class="card"><img src="image/python.jpg">
            <div class="overlay">Marketing</div>
        </div>
        <div class="card"><img src="image/python.jpg">
            <div class="overlay">Business</div>
        </div>
        <div class="card"><img src="image/python.jpg">
            <div class="overlay">Business</div>
        </div>
        <div class="card"><img src="image/python.jpg">
            <div class="overlay">Business</div>
        </div>
    </section>

    <h2 class="section-title">Popular Courses</h2>

    <?php if ($enrollMessage): ?>
        <div style="text-align:center;background:#d4edda;padding:10px;margin:20px;">
            <?php echo $enrollMessage; ?>
        </div>
    <?php endif; ?>

    <div class="courses-container">

        <div class="course-card">
            <img src="image/programming_image.jpg">
            <div class="course-info">
                <h3>HTML & CSS</h3>
                <p>Learn the basics of web development.</p>
                <div class="rating">★★★★★</div>
                <span class="price free">Free</span>
                <form method="POST">
                    <input type="hidden" name="course_name" value="HTML & CSS">
                    <button class="enroll-btn">Enroll Now</button>
                </form>
            </div>
        </div>

        <div class="course-card">
            <img src="image/python.jpg">
            <div class="course-info">
                <h3>Python Programming</h3>
                <p>Start coding using Python.</p>
                <div class="rating">★★★★☆</div>
                <span class="price paid">$49</span>
                <form method="POST">
                    <input type="hidden" name="course_name" value="Python Programming">
                    <button class="enroll-btn">Enroll Now</button>
                </form>
            </div>
        </div>
        <div class="course-card">
            <img src="image/python.jpg">
            <div class="course-info">
                <h3>Python Programming</h3>
                <p>Start coding using Python.</p>
                <div class="rating">★★★★☆</div>
                <span class="price paid">$49</span>
                <form method="POST">
                    <input type="hidden" name="course_name" value="Python Programming">
                    <button class="enroll-btn">Enroll Now</button>
                </form>
            </div>
        </div>
        <div class="course-card">
            <img src="image/python.jpg">
            <div class="course-info">
                <h3>Python Programming</h3>
                <p>Start coding using Python.</p>
                <div class="rating">★★★★☆</div>
                <span class="price paid">$49</span>
                <form method="POST">
                    <input type="hidden" name="course_name" value="Python Programming">
                    <button class="enroll-btn">Enroll Now</button>
                </form>
            </div>
        </div>
        <div class="course-card">
            <img src="image/python.jpg">
            <div class="course-info">
                <h3>Python Programming</h3>
                <p>Start coding using Python.</p>
                <div class="rating">★★★★☆</div>
                <span class="price paid">$49</span>
                <form method="POST">
                    <input type="hidden" name="course_name" value="Python Programming">
                    <button class="enroll-btn">Enroll Now</button>
                </form>
            </div>
        </div>
        <div class="course-card">
            <img src="image/python.jpg">
            <div class="course-info">
                <h3>Python Programming</h3>
                <p>Start coding using Python.</p>
                <div class="rating">★★★★☆</div>
                <span class="price paid">$49</span>
                <form method="POST">
                    <input type="hidden" name="course_name" value="Python Programming">
                    <button class="enroll-btn">Enroll Now</button>
                </form>
            </div>
        </div>
        <div class="course-card">
            <img src="image/python.jpg">
            <div class="course-info">
                <h3>Python Programming</h3>
                <p>Start coding using Python.</p>
                <div class="rating">★★★★☆</div>
                <span class="price paid">$49</span>
                <form method="POST">
                    <input type="hidden" name="course_name" value="Python Programming">
                    <button class="enroll-btn">Enroll Now</button>
                </form>
            </div>
        </div>

    </div>

    <h2 class="section-title">Learning Tools</h2>
    <section class="tools">
        <div class="tool-card">
            <h3>Interactive Quizzes</h3>
            <p>Test your knowledge after every lesson.</p>
        </div>
        <div class="tool-card">
            <h3>Certificates</h3>
            <p>Earn certificates after course completion.</p>
        </div>
        <div class="tool-card">
            <h3>Student Community</h3>
            <p>Discuss and learn with other students.</p>
        </div>
    </section>

    <section class="about">
        <img src="image/image1.jpg">
        <div>
            <h2>Why Choose EduSkill?</h2>
            <ul>
                <li>Certified Trainers</li>
                <li>Flexible Learning</li>
                <li>Career Growth</li>
            </ul>
        </div>
    </section>

    <section class="testimonials">
        <h2>Student Reviews</h2>

        <div class="review">
            <div class="stars">★★★★★</div>
            <p>"EduSkill helped me land my first IT job."</p>
            <b>- Sita Sharma</b>
        </div>

        <div class="review">
            <div class="stars">★★★★☆</div>
            <p>"The courses are easy to understand and practical."</p>
            <b>- Ram Thapa</b>
        </div>

    </section>

    <section class="cta">
        <h2>Ready to Start Learning?</h2>
        <a href="./registration-system//register.html"><button>Register</button></a>
    </section>

    <?php include './Components/footer.php'; ?>

    <script>
        let slides = document.querySelectorAll('.slide');
        let index = 0;
        setInterval(() => {
            slides[index].classList.remove('active');
            index = (index + 1) % slides.length;
            slides[index].classList.add('active');
        }, 4000);
    </script>

</body>

</html>