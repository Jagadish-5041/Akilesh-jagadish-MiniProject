<?php include_once "header.php"; ?>
    <body>
        <div class = "wrapper">
            <section class = "form signup">
                <header>Sign Up - Details</header>
                <form action = "#" enctype="multipart/form-data">
                    <div class = "error-txt"></div>
                    <div class = "name-details">
                        <div class = "field input">
                            <label> First Name </label>
                            <input type="text" name="fname" placeholder="First Name" required>
                        </div>
                        <div class = "field input">
                            <label> Last Name </label>
                            <input type="text" name="lname" placeholder="Last Name" required>
                        </div>
                    </div>
                    <div class = "field input">
                        <label> Email Id </label>
                        <input type="text" name="email" placeholder="Enter New Email" required>
                    </div>
                    <div class = "field input">
                        <label> Password </label>
                        <input type="password" name="password" placeholder="Enter New Password" required>
                        <i class="fas fa-eye"></i>
                    </div>
                    <div class = "field image">
                        <label> Select Image </label>
                        <input type="file" name="image" required>
                    </div>
                    <div class = "field button">
                        <input type="submit" value="Let's Begin 2 Chat ... ">
                    </div>
                </form>
                <div class="link">Signed Up Already ? <a href="login.php">Login Now</a></div>
            </section>
        </div>
        <script src="javascript/pass-show-hide.js"></script>
        <script src="javascript/signup.js"></script>
    </body>
</html>