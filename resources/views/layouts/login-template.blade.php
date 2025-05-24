<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion des loyers - Connexion</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --background: 0 0% 100%;
            --foreground: 240 10% 3.9%;
            --card: 0 0% 100%;
            --card-foreground: 240 10% 3.9%;
            --primary: 217 91% 60%;
            --primary-foreground: 210 40% 98%;
            --secondary: 210 40% 96.1%;
            --secondary-foreground: 222.2 47.4% 11.2%;
            --border: 214.3 31.8% 91.4%;
            --input: 214.3 31.8% 91.4%;
            --radius: 0.5rem;
        }

        * {
            font-family: 'Inter', sans-serif;
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            background-color: #f3f4f6;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .container {
            max-width: 420px;
            width: 100%;
            padding: 2rem;
            background: white;
            border-radius: 1rem;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.05);
            background: linear-gradient(135deg, #f6f8fd 0%, #f1f5ff 100%);
            border: 1px solid rgba(59, 130, 246, 0.1);
        }

        .heading {
            font-size: 1.5rem;
            font-weight: 700;
            color: #111827;
            margin-bottom: 1.5rem;
            text-align: center;
        }

        .form {
            display: flex;
            flex-direction: column;
            gap: 1.25rem;
        }

        .input {
            width: 100%;
            padding: 0.75rem 1rem;
            border: 1px solid #e5e7eb;
            border-radius: 0.5rem;
            font-size: 0.875rem;
            color: #374151;
            transition: border-color 0.15s ease;
        }

        .input:focus {
            outline: none;
            border-color: #3b82f6;
            box-shadow: 0 0 0 2px rgba(59, 130, 246, 0.1);
        }

        .input.is-invalid {
            border-color: #ef4444;
        }

        .invalid-feedback {
            color: #ef4444;
            font-size: 0.75rem;
            margin-top: 0.25rem;
        }

        .forgot-password {
            display: block;
            text-align: right;
            font-size: 0.75rem;
            color: #6b7280;
            margin-bottom: 0.5rem;
        }

        .forgot-password a {
            color: #3b82f6;
            text-decoration: none;
            font-weight: 500;
        }

        .login-button {
            background-color: #3b82f6;
            color: white;
            font-weight: 600;
            padding: 0.75rem 1.5rem;
            border-radius: 0.5rem;
            border: none;
            cursor: pointer;
            transition: background-color 0.2s ease;
        }

        .login-button:hover {
            background-color: #2563eb;
        }

        .social-account-container {
            margin-top: 2rem;
            text-align: center;
        }

        .title {
            display: block;
            color: #6b7280;
            font-size: 0.75rem;
            margin-bottom: 1rem;
        }

        .social-accounts {
            display: flex;
            justify-content: center;
            gap: 1rem;
        }

        .social-button {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 2.5rem;
            height: 2.5rem;
            border-radius: 9999px;
            background-color: #f3f4f6;
            border: none;
            cursor: pointer;
            transition: background-color 0.2s ease;
        }

        .social-button:hover {
            background-color: #e5e7eb;
        }

        .social-button.google {
            color: #ea4335;
        }

        .social-button.apple {
            color: #000000;
        }

        .social-button.twitter {
            color: #1da1f2;
        }

        .social-button svg {
            width: 1.25rem;
            height: 1.25rem;
            fill: currentColor;
        }

        .agreement {
            display: block;
            text-align: center;
            font-size: 0.75rem;
            color: #6b7280;
            margin-top: 1.5rem;
        }

        .agreement a {
            color: #3b82f6;
            text-decoration: none;
            font-weight: 500;
        }

        .back-button {
            position: fixed;
            top: 1.5rem;
            left: 1.5rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.5rem 1rem;
            background-color: white;
            border: 1px solid #e5e7eb;
            border-radius: 0.5rem;
            color: #374151;
            font-size: 0.875rem;
            font-weight: 500;
            text-decoration: none;
            transition: all 0.2s ease;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
        }

        .back-button:hover {
            background-color: #f9fafb;
            border-color: #d1d5db;
            transform: translateY(-1px);
        }

        .back-button svg {
            width: 1rem;
            height: 1rem;
            stroke: currentColor;
        }

        /* Responsive */
        @media (max-width: 640px) {
            .container {
                padding: 1.5rem;
                margin: 0 1rem;
            }
        }
    </style>
</head>
<body>
    <a href="/" class="back-button">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
        </svg>
        Retour à l'accueil
    </a>
    <main class="flex-grow">
        <div class="w-full max-w-7xl mx-auto sm:px-6 lg:px-8">
            @yield('content')
        </div>
    </main>
</body>
</html>