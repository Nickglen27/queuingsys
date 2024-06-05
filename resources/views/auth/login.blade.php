<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap');

        body {
            font-family: 'Roboto', sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            overflow: hidden; /* Remove scroll bars */
            position: relative; /* Add relative positioning */
        }

        /* Background slash effect */
        body::before {
            content: '';
            position: absolute;
            top: 0;
            left: 50%;
            width: 100%;
            height: 100%;
            background: linear-gradient(to top right, #d74e92 0%, #d74e92 50%, #72258b 50%, #72258b 100%);
            transform: skewX(-30deg); /* Adjust skew angle */
            z-index: -1; /* Ensure it's behind other content */
        }

        .login-container {
            display: flex;
            width: 800px;
            height: 400px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
            overflow: hidden;
            position: relative; /* Add relative positioning */
        }

        .login-left {
            flex: 1;
            background-image: url('https://scontent.fdvo2-2.fna.fbcdn.net/v/t39.30808-6/380583336_721468949998840_4340693062564530601_n.jpg?_nc_cat=100&ccb=1-7&_nc_sid=5f2048&_nc_eui2=AeFDbqtYHJKOu9p3b8YBHnsouBOsBfswU6C4E6wF-zBToJLJg0QMeXKHGRZNmzM-7cccFYjezp-bvEtZzVvgxpPi&_nc_ohc=MU4e61b9OHEQ7kNvgGzL12I&_nc_ht=scontent.fdvo2-2.fna&oh=00_AYCCrtB_fs4sVU6vq_MAiZSL8LwVOLQD0QU996z4UudEmA&oe=666587F6');
            background-repeat: no-repeat;
            background-size: 100% 100%; /* Stretch the image to cover the entire container */
            background-position: center; /* Center the background image */
            position: relative; /* Add relative positioning */
        }

        .login-right {
            flex: 1;
            background-color: white;
            padding: 40px;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        h2 {
            margin: 0;
            font-size: 24px;
            color: #333;
            font-weight: 700;
        }

        .nuva {
            font-weight: 700;
        }

        p {
            color: #666;
            margin: 20px 0;
            font-weight: 400;
        }

        .input-group {
            position: relative;
            margin-bottom: 20px;
        }

        .input-group i {
            position: absolute;
            left: 10px;
            top: 50%;
            transform: translateY(-50%);
            color: #aaa;
        }

        input[type="email"], input[type="password"] {
            width: calc(100% - 50px); /* Adjusted width */
            padding: 10px 10px 10px 40px;
            border: none;
            border-bottom: 2px solid #ccc;
            margin-top: 5px;
            font-family: 'Roboto', sans-serif;
            outline: none;
        }

        input[type="email"]:focus, input[type="password"]:focus {
            border-bottom-color: #72258b;
        }

        input[type="email"]:focus + label, input[type="email"]:not(:placeholder-shown) + label,
        input[type="password"]:focus + label, input[type="password"]:not(:placeholder-shown) + label {
            top: -20px;
            font-size: 12px;
            color: #72258b;
        }

        label {
            position: absolute;
            left: 40px;
            top: 50%;
            transform: translateY(-50%);
            color: #aaa;
            transition: 0.3s ease all;
            pointer-events: none;
        }

        .button-27 {
            appearance: none;
            background: linear-gradient(to top right, #d74e92 0%, #d74e92 50%, #72258b 50%, #72258b 100%);
            border: 0px solid #1A1A1A;
            border-radius: 15px;
            box-sizing: border-box;
            color: #FFFFFF;
            cursor: pointer;
            display: inline-block;
            font-family: Roobert, -apple-system, BlinkMacSystemFont, "Segoe UI", Helvetica, Arial, sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol";
            font-size: 16px;
            font-weight: 600;
            line-height: normal;
            margin: 0;
            min-height: 60px;
            min-width: 0;
            outline: none;
            padding: 16px 24px;
            text-align: center;
            text-decoration: none;
            transition: all 300ms cubic-bezier(.23, 1, 0.32, 1);
            user-select: none;
            -webkit-user-select: none;
            touch-action: manipulation;
            width: 100%;
            will-change: transform;
        }

        .button-27:hover {
            box-shadow: rgba(0, 0, 0, 0.25) 0 8px 15px;
            transform: translateY(-2px);
        }

        .button-27:active {
            box-shadow: none;
            transform: translateY(0);
        }

        .basic-version {
            display: block;
            margin-top: 10px;
            text-align: center;
            color: #7f55f6;
            text-decoration: none;
            font-weight: 400;
        }

        .basic-version:hover {
            text-decoration: underline;
        }

        /* Integrate Laravel Blade styles */
        .invalid-feedback {
            display: block;
            color: #e3342f;
            margin-top: 10px;
        }

        /* Error message below login button */
        .error-message {
            display: block;
            color: #e3342f;
            margin-top: 10px;
            text-align: center;
        }

        /* iPhone Greeting Animation */
        .greeting-message {
            position: absolute;
            top: -50px;
            left: 50%;
            transform: translateX(-50%);
            opacity: 0;
            pointer-events: none;
            transition: opacity 0.5s, top 0.5s;
            font-size: 20px; /* Enlarged font size */
            font-weight: bold;
            color: #333;
        }

        .input-group input:focus + .greeting-message {
            opacity: 1;
            top: -70px; /* Adjusted top position */
        }
    </style>
</head>
<body>

<div class="login-container">
    <div class="login-left"></div>
    <div class="login-right">
        <div class="login-box">
            <form method="POST" action="/login"> <!-- Adjust the action attribute as per your backend route -->
                @csrf <!-- Laravel CSRF token -->
                <div class="input-group">
                    <i class="fas fa-envelope"></i>
                    <input id="email" type="email" class="@error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus placeholder=" ">
                    <label for="email">Email</label>
                    <span class="greeting-message">Hello</span>
                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="input-group">
                    <i class="fas fa-lock"></i>
                    <input id="password" type="password" class="@error('password') is-invalid @enderror" name="password" required autocomplete="current-password" placeholder=" ">
                    <label for="password">Password</label>
                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <button type="submit" class="button-27">Log In</button>
                <!-- Error message span -->
                @if (session('error'))
                    <span class="error-message">{{ session('error') }}</span>
                @endif
            </form>
        </div>
    </div>
</div>

<script>
    // JavaScript to handle the greeting message animation
    const emailInput = document.getElementById('email');
    const greetingMessage = document.querySelector('.greeting-message');

    const greetingMessages = [
        'Hello',         // English
        'Bonjour',       // French
        'こんにちは',   // Japanese
        'Hola',          // Spanish
        'Hallo',         // German
        'नमस्ते',     // Hindi
        'Ciao',          // Italian
        '안녕하세요',   // Korean
        'Olá',           // Portuguese
        'Здравствуйте', // Russian
        '你好',           // Chinese (Simplified)
        'مرحبا',        // Arabic
        'Selamat pagi',  // Indonesian (Bahasa)
        'Merhaba',       // Turkish
        'Γειά σας',     // Greek
        'Salam',         // Persian (Farsi)
        'Hej',           // Swedish
        'Sawubona',      // Zulu
        'ਸਤ ਸ੍ਰੀ ਅਕਾਲ', // Punjabi
        'Hei',           // Norwegian
        'Aloha',         // Hawaiian
        'வணக்கம்',    // Tamil
        'ನಮಸ್ಕಾರ',    // Kannada
        'Բարեւ',       // Armenian
        'హలో',         // Telugu
        'നമസ്കാരം',   // Malayalam
        'سلام',         // Urdu
        'გამარჯობა', // Georgian
        'Hej',           // Danish
        'Saluton',       // Esperanto
    ];
    let index = 0;
    let greetingInterval;

    const showNextGreeting = () => {
        greetingMessage.textContent = greetingMessages[index];
        greetingMessage.style.opacity = '1';
        index = (index + 1) % greetingMessages.length;
        setTimeout(() => {
            greetingMessage.style.opacity = '0';
        }, 3500); // Hide after 3.5 seconds
    };

    emailInput.addEventListener('focus', () => {
        showNextGreeting();
        if (greetingInterval) clearInterval(greetingInterval); // Clear any previous interval
        greetingInterval = setInterval(showNextGreeting, 4000); // Show a new greeting every 4 seconds
    });

    emailInput.addEventListener('blur', () => {
        greetingMessage.style.opacity = '0';
        clearInterval(greetingInterval); // Clear interval when input loses focus
    });
</script>

</body>
</html>
