<?php include_once "header.php"; ?>
    <body>
        <div class = "wrapper">
            <section class = "form login">
                <header>Chatting Application</header>
                <form action = "#">
                    <div class = "error-txt"></div>
                    <div class = "field input">
                        <label> Email Id </label>
                        <input type="text" name="email" placeholder="Enter Email">
                    </div>
                    <div class = "field input">
                        <label> Password </label>
                        <input type="password" name="password" placeholder="Enter Password">
                        <i class="fas fa-eye"></i>
                    </div>
                    <div class = "field button">
                        <input type="submit" value="Let's Begin 2 Chat ... ">
                    </div>
                </form>
                <div class="link">Not Yet Signed Up ? <a href="index.php">SignUp Now</a></div>
            </section>
        </div>
        <script src="javascript/pass-show-hide.js"></script>
        <script src="javascript/login.js"></script>
    </body>
</html>