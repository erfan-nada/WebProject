<!DOCTYPE html>
<html>
<head>
    <title>UTOPIA Login Page</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-image: url('gym.jpg'); 
            background-size: cover;
            background-repeat: repeat;
            background-attachment: fixed;
            display: flex;
            flex-direction: column;
            height: 100vh;
            justify-content: space-between;
            margin: 0;
            padding: 0;
        }

        .login-box {
            width: 450px;
            margin: 70px auto 0;
            background-color: #fff;
            border-radius: 5px;
            padding: 40px;
        }

        .login-box h2 {
            text-align: center;
            margin-bottom: 30px;
        }

        .user-box {
            position: relative;
            margin-bottom: 20px;
        }

        .user-box input {
            width: 100%;
            padding: 10px 0;
            font-size: 16px;
            border: none;
            border-bottom: 1px solid #ccc;
            outline: none;
        }

        .user-box label {
            position: absolute;
            top: 0;
            left: 0;
            padding: 10px 0;
            font-size: 16px;
            color: #999;
            transition: 0.5s;
            cursor: pointer;
        }

        .user-box input:focus ~ label,
        .user-box input:valid ~ label {
            top: -20px;
            font-size: 12px;
            color: #555;
        }

        .user-box input:focus,
        .user-box input:valid {
            border-bottom: 2px solid #555;
        }

        .password-toggle {
            position: absolute;
            top: 12px;
            right: 10px;
            font-size: 12px;
            font-weight: bold;
            color: #808080;
            cursor: pointer;
            text-decoration: none;
            transition: color 0.3s;
        }

        .password-toggle:hover {
            color: #131415;
        }

        button {
            width: 100%;
            padding: 15px 0;
            margin-top: 20px;
            border: none;
            background-color: #808080;
            color: #fff;
            font-size: 16px;
            border-radius: 5px;
            cursor: pointer;
        }

        button:hover {
            background-color: #131415;
        }

        .signup-box {
            width: 450px;
            margin: 20px auto 40px; 
            text-align: center;
            padding: 15px;
            background-color: #fff;
            border-radius: 5px;
        }

        .signup-box p {
            margin: 0;
            font-size: 14px;
            color: #555;
        }

        .signup-box a {
            text-decoration: none;
            color: #808080;
            font-weight: bold;
            cursor: pointer;
            transition: 0.3s;
        }

        .signup-box a:hover {
            color: #131415;
        }

        footer {
            background-color: rgb(52, 49, 49);
            padding: 30px 0;
            text-align: center;
            margin-top: auto;
        }

        .social-icons a {
            margin: 0 10px;
        }

        .social-icons img {
            width: 30px;
            height: 30px;
        }

        .rights,
        .contactus,
        .contactus2 {
            font-size: 14px;
            color: grey;
            margin-top: 10px;
        }

        .contactus a {
            text-decoration: none;
            color: #131415;
        }
    </style>
</head>
<body>
    <?php
    session_start();

    // Database connection
    $servername = "localhost";
    $username = "root"; // Replace with your database username
    $password = "";     // Replace with your database password
    $dbname = "gym";    // Replace with your database name

    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Login handler
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $username = $_POST['username'];
        $password = $_POST['password'];

        $sql = "SELECT `Password` FROM `user` WHERE `username` = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows > 0) {
            $stmt->bind_result($hashedPassword);
            $stmt->fetch();

            if (password_verify($password, $hashedPassword)) {
                $_SESSION['user'] = $username;
                echo "<script>alert('Login successful!');</script>";
                echo "<script>window.location.href = 'index.html';</script>"; // Redirect to the homepage
            } else {
                echo "<script>alert('Invalid password. Please try again.');</script>";
            }
        } else {
            echo "<script>alert('No account found with this username.');</script>";
        }

        $stmt->close();
    }

    $conn->close();
    ?>
    <div class="logo">
        <a href="index.html">
            <img src="utopialogo.png" alt="UTOPIA" style="width: 70px; height: 60px; margin-right: 90%;">
        </a>
    </div>
    <div class="login-box">
        <h2>Login</h2>
        <form>
            <div class="user-box">
                <input type="text" id="username" name="username" required=""/>
                <label for="username">Username</label>
            </div>
            <div class="user-box" style="position: relative;">
                <input type="password" id="password" name="password" required=""/>
                <label for="password">Password</label>
                <span class="password-toggle" id="togglePassword">Show</span>
            </div>
            <button type="submit">Submit</button>
        </form>
    </div>
    
    <div class="signup-box">
        <p>Don't have an account? <a href="http://localhost/WebProject/SignUp.php">Sign up</a></p>
    </div>

    <footer>
        <div class="social-icons">
            <a href="https://www.instagram.com/la7gym/?hl=en" target="_blank">
                <img src="https://www.aloyoga.com/cdn/shop/files/instagram2021.svg?v=15745790383220268811" alt="Instagram" />
            </a>
            <a href="https://www.facebook.com/la7gym/?locale=ar_AR" target="_blank">
                <img src="https://www.aloyoga.com/cdn/shop/files/facebook2021.svg?v=4098279864862808269" alt="Facebook" />
            </a>
            <a href="https://www.youtube.com/channel/UCZ4NEgJB0svYpss5RTus59A" target="_blank">
                <img src="https://www.aloyoga.com/cdn/shop/files/youtube2021.svg?v=13243599999976738993" alt="YouTube" />
            </a>
        </div>
        <p class="rights">&copy; 2024 UTOPIA Gym. All rights reserved.</p>
        <p class="contactus">
            Contact us:<br>
            New Giza | +20 111 811 9701<br>
            Uptown   | +20 115 038 8119<br>
            Arkan    | +20 115 449 9747<br><br>
            Email : info@Utopiagym.com
        </p>
        <p class="contactus2">
            We are dedicated to the pursuit of peak performance. Whether you are looking for a fun workout, achieving some set goals or just maintaining a healthy lifestyle, we’re in it together. You will never feel lost, confused or bored. 
            <br><br>
            “Your Wellbeing is what we do”
        </p>
    </footer>

    <script>
        const form = document.querySelector('form');
        const passwordInput = document.getElementById('password');
        const togglePassword = document.getElementById('togglePassword');

        togglePassword.addEventListener('click', () => {
            const isPasswordVisible = passwordInput.getAttribute('type') === 'password';
            passwordInput.setAttribute('type', isPasswordVisible ? 'text' : 'password');
            togglePassword.textContent = isPasswordVisible ? 'Hide' : 'Show';
        });

        form.addEventListener('submit', (event) => {
            event.preventDefault();

            const username = document.querySelector('[name="username"]').value;
            const password = document.querySelector('[name="password"]').value;

            console.log('Username:', username);
            console.log('Password:', password);
        });
    </script>
</body>
</html>