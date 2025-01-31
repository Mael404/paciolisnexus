<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Terms of Service</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" integrity="sha384-k6RqeWeci5ZR/Lv4MR0sA0FfDOMRQ5jqja2BQPrj69e3hMew3K1rLMwH8M1wBZP" crossorigin="anonymous">
    <style>
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

        .terms-box {
            text-align: center;
            padding: 30px;
            border: 1px solid #007bff;
            background: #ffffff;
            border-radius: 10px;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.2);
            animation: slide-in 0.8s ease-out;
            max-width: 800px;
            overflow-y: auto;
            max-height: 90vh;
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

        h1 {
            color: #007bff;
        }

        p, ul {
            color: #333;
            text-align: left;
        }

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
        }

        button:hover {
            background-color: #0056b3;
            transform: scale(1.05);
        }
    </style>
</head>
<body>
    <div class="terms-box">
        <h1>Terms of Service for Pacioli’s Nexus</h1>
        <p><strong>Effective Date:</strong> January 31, 2025</p>
        <p>Welcome to Pacioli's Nexus. By accessing or using our website, you agree to comply with and be bound by these Terms of Service ("Terms"). Please read them carefully before logging in.</p>
        
        <h3>1. Acceptance of Terms</h3>
        <p>By logging into Pacioli's Nexus, you acknowledge that you have read, understood, and agree to be bound by these Terms. If you do not agree with any part of these Terms, you must not log into our site.</p>
        
        <h3>2. Modifications to Terms</h3>
        <p>Pacioli's Nexus reserves the right to modify these Terms at any time. Any changes will be effective immediately upon posting on the website. Your continued use of the site after modifications constitutes acceptance of the revised Terms.</p>
        
        <h3>3. Use of the Services</h3>
        <p>You agree to use Pacioli's Nexus solely for lawful purposes and in a manner that does not infringe the rights of others, including their rights to privacy, data protection, and intellectual property. You must not:</p>
        <ul>
            <li>Use any automated means to access the Website.</li>
            <li>Attempt to gain unauthorized access to any portion or feature of the Website.</li>
            <li>Engage in any conduct that restricts or inhibits anyone's use or enjoyment of the Website.</li>
        </ul>
        
        <h3>4. User Accounts</h3>
        <p>To access certain features of our Website, you may be required to create an account. You agree to provide accurate, current, and complete information when creating your account. You are responsible for maintaining the confidentiality of your account credentials and for all activities that occur under your account.</p>
        
        <h3>5. Data Privacy</h3>
        <p>Pacioli's Nexus respects your privacy and is committed to protecting your personal information. We adhere to the Philippine Data Privacy Act of 2012 (Republic Act No. 10173) and have implemented necessary measures to secure your data.</p>
        
        <h3>6. Intellectual Property</h3>
        <p>All content on Pacioli's Nexus, including text, graphics, logos, and software, is the property of Pacioli’s Nexus or its licensors and is protected by applicable intellectual property laws. You may not use, reproduce, modify, or distribute any content from our Website without prior permission.</p>
        
        <h3>7. Limitation of Liability</h3>
        <p>Pacioli's Nexus shall not be liable for any direct, indirect, incidental, special, consequential, or punitive damages arising from your access to or use of our Website, including damages for loss of data or profits.</p>
        
        <h3>8. Governing Law</h3>
        <p>These Terms shall be governed by and construed in accordance with the laws of the Philippines, without regard to its conflict of law principles.</p>
        
        <h3>9. Contact Us</h3>
        <p>For any questions or concerns regarding these Terms or your personal data, please contact us at:</p>
        <p>Email: pacioli’snexus@gmail.com</p>
        
        <p>By logging in to Pacioli's Nexus, you agree to these Terms of Service. Thank you for choosing Pacioli's Nexus!</p>
        <button onclick="goBack()">Go Back</button>
    </div>

    <script>
        function goBack() {
            window.history.back();
        }
    </script>
</body>
</html>
