<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Success</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" integrity="sha384-k6RqeWeci5ZR/Lv4MR0sA0FfDOMRQ5jqja2BQPrj69e3hMew3K1rLMwH8M1wBZP" crossorigin="anonymous">
    <style>
        /* General Styling */
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            font-family: Arial, sans-serif;
            background: linear-gradient(to bottom right, #f0f8ff, #d0e8ff);
            margin: 0;
            overflow: hidden;
        }

        /* Message Box */
        .message-box {
            text-align: center;
            padding: 30px;
            border: 1px solid #007bff;
            background: #ffffff;
            border-radius: 10px;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.2);
            animation: slide-in 0.8s ease-out;
            z-index: 2;
        }

        @keyframes slide-in {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Text Elements */
        h1 {
            color: #007bff;
            margin-top: 10px;
            animation: fade-in 1.2s ease-in-out;
        }

        p {
            color: #333;
            margin: 10px 0;
            animation: fade-in 1.5s ease-in-out;
        }

        @keyframes fade-in {
            from {
                opacity: 0;
            }
            to {
                opacity: 1;
            }
        }

        /* Icon */
        .icon {
            font-size: 50px;
            color: #28a745;
            animation: bounce 1.2s infinite;
        }

        @keyframes bounce {
            0%, 100% {
                transform: translateY(0);
            }
            50% {
                transform: translateY(-10px);
            }
        }

        /* Button */
        button {
            margin-top: 20px;
            padding: 10px 20px;
            font-size: 16px;
            color: #fff;
            background-color: #007bff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease, transform 0.2s ease;
            animation: fade-in 1.8s ease-in-out;
        }

        button:hover {
            background-color: #0056b3;
            transform: scale(1.05);
        }

        /* Confetti */
        .confetti {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            pointer-events: none;
            overflow: hidden;
            z-index: 1;
        }

        .confetti-piece {
            position: absolute;
            width: 10px;
            height: 10px;
            background-color: transparent;
            opacity: 0.8;
            animation: confetti-fall 3s linear infinite;
        }

        @keyframes confetti-fall {
            0% {
                transform: translateY(-100%) rotate(0deg);
            }
            100% {
                transform: translateY(100vh) rotate(360deg);
            }
        }
    </style>
</head>
<body>
    <div class="confetti"></div>
    <div class="message-box">
        <i class="fas fa-check-circle icon"></i>
        <h1>Success!</h1>
        <p>Your PDF is now being reviewd by the admin. You will be notified when the admin has already approved your material. Thank you!</p>
        <p>Click the button below to go back.</p>
        <button onclick="redirectToQuiz()">Proceed</button>
    </div>

    <script>
        // Redirect to Quiz Page
        function redirectToQuiz() {
            window.location.href = "cpa_uploadmaterials.php";
        }

        // Confetti Generator
        const confettiContainer = document.querySelector('.confetti');
        const colors = ['#FF5733', '#FFC300', '#DAF7A6', '#FFC0CB', '#8E44AD'];

        function createConfetti() {
            for (let i = 0; i < 100; i++) {
                const confetti = document.createElement('div');
                confetti.classList.add('confetti-piece');
                confetti.style.left = Math.random() * 100 + 'vw';
                confetti.style.backgroundColor =
                    colors[Math.floor(Math.random() * colors.length)];
                confetti.style.animationDelay = Math.random() * 3 + 's';
                confetti.style.width = Math.random() * 10 + 5 + 'px';
                confetti.style.height = confetti.style.width; // Keep it square
                confettiContainer.appendChild(confetti);
            }
        }

        createConfetti();
    </script>
</body>
</html>
