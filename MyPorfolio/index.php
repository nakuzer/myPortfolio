<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pixel Portfolio</title>
    <link rel="stylesheet" href="style.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
</head>

<body>
    <!-- Video Background -->
    <div class="video-container">
        <video autoplay muted loop id="bg-video">
            <source src="videos/japan-street-fall-city-wallpaperwaifu-com.mp4" type="video/mp4">
            Your browser does not support HTML5 video.
        </video>
        <div class="video-overlay"></div>
    </div>

    <!-- Main Game Interface -->
    <div class="game-container">
        <!-- Game Header -->
        <header class="game-header">
            <div class="pixel-logo">NOK PIXIE</div>
            <nav class="game-nav">
                <ul>
                    <li><a href="#about" class="nav-btn">ABOUT</a></li>
                    <li><a href="#skills" class="nav-btn">SKILLS</a></li>
                    <li><a href="#projects" class="nav-btn">PROJECTS</a></li>
                    <li><a href="#contact" class="nav-btn">CONTACT</a></li>
                    <li><a href="#" class="nav-btn special">LOGIN</a></li>
                </ul>
            </nav>
        </header>

        <!-- Character Area -->
        <div class="character-area">
            <div class="pixel-character">
                <img src="images/pixmorg.png" alt="Pixel Character">
            </div>
            <div class="speech-bubble">
                <p>Hello! Welcome to my pixel world. I'm a <span class="typed-text"></span></p>
            </div>
        </div>

        <!-- Main Content -->
        <main class="game-content">
            <!-- About Section -->
            <section id="about" class="game-section">
                <div class="section-header">
                    <h2 class="pixel-font">ABOUT ME</h2>
                    <div class="pixel-divider"></div>
                </div>
                <div class="content-area">
                    <div class="profile-photo">
                        <div class="pixel-frame">
                            <img src="images/face1.jpg" alt="Profile Photo">
                        </div>
                    </div>
                    <div class="about-text">
                        <p>I'm a student who's really interested in technology and programming. I'm currently learning web development and hope to work in tech someday. </p>
                        <p>I enjoy working on small coding projects in my free time and am always looking to learn new skills.</p>
                        <p>When I'm not coding, you can find me exploring new technologies, playing games, or sketching pixel art for fun.</p>
                        <div class="pixel-button">
                            <a href="assets/journey.pdf" download>DOWNLOAD MY JOURNEY</a>
                        </div>
                    </div>
                </div>
            </section>

            <!-- Skills Section -->
            <section id="skills" class="game-section">
                <div class="section-header">
                    <h2 class="pixel-font">MY SKILLS</h2>
                    <div class="pixel-divider"></div>
                </div>
                <div class="skills-container">
                    <div class="skill-category">
                        <h3>Programming</h3>
                        <div class="skill-bars" id="programming-skills">
                            <!-- Programming skills will be loaded dynamically -->
                        </div>
                    </div>
                    <div class="skill-category">
                        <h3>Design</h3>
                        <div class="skill-bars" id="design-skills">
                            <!-- Design skills will be loaded dynamically -->
                        </div>
                    </div>
                </div>
            </section>

            <!-- Projects Section -->
            <section id="projects" class="game-section">
                <div class="section-header">
                    <h2 class="pixel-font">PROJECTS</h2>
                    <div class="pixel-divider"></div>
                </div>
                <div class="projects-grid" id="projects-container">
                    <!-- Projects will be loaded dynamically -->
                </div>
            </section>

            <!-- Contact Section -->
            <section id="contact" class="game-section">
                <div class="section-header">
                    <h2 class="pixel-font">CONTACT ME</h2>
                    <div class="pixel-divider"></div>
                </div>
                <div class="contact-container">
                    <div class="contact-info">
                        <div class="contact-item">
                            <div class="pixel-icon email-icon">
                                <img src="images/gmail.png" alt="Email Icon">
                            </div>
                            <p>nakuzer01@gmail.com</p>
                        </div>
                        <div class="contact-item">
                            <div class="pixel-icon phone-icon">
                                <img src="images/phone.png" alt="Phone Icon">
                            </div>
                            <p>+63 962 6125 986</p>
                        </div>
                        <div class="contact-item">
                            <div class="pixel-icon location-icon">
                                <img src="images/country.png" alt="Location Icon">
                            </div>
                            <p>Zamboanga City, Philippines</p>
                        </div>
                        <div class="social-links">
                            <a href="https://www.facebook.com/charlesmorgan.nokie" target="_blank" class="social-link facebook">
                                <img src="images/fb.png" alt="Facebook Icon">
                            </a>
                            <a href="https://www.tiktok.com/@rahhhh_4" target="_blank" class="social-link tiktok">
                                <img src="images/tiktok.png" alt="TikTok Icon">
                            </a>
                            <a href="https://github.com/nakuzer" target="_blank" class="social-link github">
                                <img src="images/gh.png" alt="GitHub Icon">
                            </a>
                            <a href="https://www.instagram.com/zioh_1/" target="_blank" class="social-link instagram">
                                <img src="images/ig.png" alt="Instagram Icon">
                            </a>
                        </div>
                    </div>
                    <div class="contact-form">
                        <form id="contact-form" action="contact-handler.php" method="post">
                            <div class="form-group">
                                <label for="contact-name">Name:</label>
                                <input type="text" id="contact-name" name="contact-name" required>
                            </div>
                            <div class="form-group">
                                <label for="contact-email">Email:</label>
                                <input type="email" id="contact-email" name="contact-email" required>
                            </div>
                            <div class="form-group">
                                <label for="contact-subject">Subject:</label>
                                <input type="text" id="contact-subject" name="contact-subject" required>
                            </div>
                            <div class="form-group">
                                <label for="contact-message">Message:</label>
                                <textarea id="contact-message" name="contact-message" required></textarea>
                            </div>
                            <button type="submit" class="pixel-button">SEND MESSAGE</button>
                        </form>
                    </div>
                </div>
            </section>

        </main>

        <!-- Footer -->
        <footer class="game-footer">
            <div class="footer-content">
                <div class="footer-logo">PIXEL PORTFOLIO</div>
                <div class="footer-text">
                    <p>&copy; 2025 All Rights Reserved</p>
                    <p>Designed with <span class="pixel-heart"></span> in a pixelated world morgy</p>
                </div>
            </div>
        </footer>
    </div>


    <!-- Modal Login Form -->
    <div id="loginModal" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="modal-title">LOGIN</h2>
                <span class="close">&times;</span>
            </div>
            <form class="modal-form" id="login-form">
                <div class="form-group">
                    <label for="username">Username</label>
                    <input type="text" id="username" name="username" required>
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" required>
                </div>
                <div class="remember-me">
                    <input type="checkbox" id="remember" name="remember">
                    <label for="remember">Remember me</label>
                </div>
                <div class="form-buttons">
                    <button type="submit" class="pixel-button">LOGIN</button>
                </div>
                <div class="form-footer">
                    <p>Forgot password? <a href="#" id="forgot-password-link">Click here</a></p>
                </div>
            </form>
        </div>
    </div>
    </div>

    <script src="scripts.js"></script>
</body>

</html>