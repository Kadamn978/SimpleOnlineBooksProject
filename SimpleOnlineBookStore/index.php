<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Online Book Store</title>
    <link rel="stylesheet" href="./css/styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" />
</head>

<body>
    <!-- Header Section -->
    <header>
        <div class="header-container">
            <div class="logo">
                <img src="images/MAINLOGO.jpg" alt="Main Logo">
            </div>
            <div class="companyname">
                <h1>Online Book Store</h1>
            </div>
        </div>
        <div class="navbar">
            <div class="nav-left">
                <img src="images/smalllogo.jpg" alt="Small Logo" class="small-logo">
                <a href="#home">Home</a>
                <a href="html/books.html">Books</a>
                <a href="#new-arrivals">New Arrivals</a>
                <a href="#about">About</a>
                <a href="#contact">Contact Us</a>
            </div>
            <div class="nav-right">
                <a href="#signup">Sign Up</a>
                <a href="#signin">Sign In</a>
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <main>
        <div id="error-message"></div>
        <div id="success-message"></div>
        <h1>Books Collection</h1>
        <div class="content-container">
            <div class="left-content">
                <h2>Left Content</h2>
                <p>This section can include additional information, promotions, or featured books.</p>
            </div>
            <div class="book-table" id="book-table">
                <table id="table-data">
                    <!-- <thead>
                        <tr>
                            <th>Photo</th>
                            <th>Name</th>
                            <th>Author</th>
                            <th>Category</th>
                            <th>Description</th>
                        </tr>
                    </thead>
                    <tbody > -->

                    <!-- Add more book rows as needed -->
                    <!-- </tbody> -->
                </table>
            </div>
            <div class="right-content">
                <h2>Right Content</h2>
                <p>This section can include ads, newsletters, or other relevant information.</p>
            </div>
        </div>
    </main>

    <!-- Footer Section -->
    <footer>
        <div class="footer-left">
            <h3>Quick Links</h3>
            <ul>
                <li><a href="#home">Home</a></li>
                <li><a href="#books">Books</a></li>
                <li><a href="#about">About</a></li>
                <li><a href="#contact">Contact Us</a></li>
            </ul>
        </div>
        <div class="footer-right">
            <h3>Contact Us</h3>
            <p>123 Book St, Book City, BK 12345</p>
            <p>Email: info@bookstore.com</p>
            <p>Phone: (123) 456-7890</p>
            <div class="social-media">
                <a href="#"><i class="fab fa-facebook"></i></a>
                <a href="#"><i class="fab fa-twitter"></i></a>
                <a href="#"><i class="fab fa-instagram"></i></a>
            </div>
        </div>
    </footer>

    <!-- Copyright Information -->
    <div class="footer-bottom">
        <p>&copy; 2024 Online Book Store | Created by Your Name</p>
    </div>

    <!-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="js/script.js"></script>
    <script src="js/jquery.js"></script>


</body>

</html>