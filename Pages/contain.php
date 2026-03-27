<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Contact - Course Platform</title>

    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            display: flex;
        }

        .navbar {
            width: 250px;
            background: #4b0082;
            color: white;
            min-height: 100vh;
            padding: 20px;
            display: flex;
            flex-direction: column;
        }

        .navbar a {
            color: white;
            text-decoration: none;
            margin: 8px 0;
            padding: 5px;
        }

        .navbar a:hover {
            background: #6a0dad;
            border-radius: 4px;
        }

        .container {
            flex: 1;
            padding: 20px;
            background: #f4f4f4;
        }

        .card {
            background: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.2);
        }

        input,
        textarea {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border-radius: 5px;
            border: 1px solid #ccc;
        }

        button {
            background: #4b0082;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        button:hover {
            background: #6a0dad;
        }
    </style>
</head>

<body>

    <div class="navbar">
        <h2>Course Platform</h2>
        <a href="index.html">Home</a>
        <a href="provider-dashboard.php">Dashboard</a>
        <a href="about.html">About</a>
        <a href="contact.html">Contact</a>
    </div>

    <div class="container">
        <div class="card">
            <h1>Contact Us</h1>
            <p>If you have any questions, feel free to send us a message.</p>

            <form>
                <input type="text" placeholder="Your Name" required>
                <input type="email" placeholder="Your Email" required>
                <textarea rows="5" placeholder="Your Message" required></textarea>
                <button type="submit">Send Message</button>
            </form>
        </div>
    </div>

</body>

</html>