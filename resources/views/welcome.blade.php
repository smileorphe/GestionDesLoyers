<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion Des Loyers - Simplifiez votre gestion immobilière</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        /* Uiverse.io button style with application colors */
        .ui-btn {
            --btn-default-bg: rgb(59, 130, 246); /* Blue-500 */
            --btn-hover-bg: rgb(37, 99, 235); /* Blue-600 */
            --btn-padding: 12px 20px;
            --btn-transition: .3s;
            --btn-letter-spacing: .1rem;
            --btn-animation-duration: 1.2s;
            --btn-shadow-color: rgba(59, 130, 246, 0.2);
            --btn-shadow: 0 2px 10px 0 var(--btn-shadow-color);
            --hover-btn-color: #fff;
            --default-btn-color: #fff;
            --font-size: 16px;
            --font-weight: 600;
            --font-family: 'Inter', sans-serif;
        }

        .ui-btn {
            box-sizing: border-box;
            padding: var(--btn-padding);
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--default-btn-color);
            font: var(--font-weight) var(--font-size) var(--font-family);
            background: var(--btn-default-bg);
            border: none;
            cursor: pointer;
            transition: var(--btn-transition);
            overflow: hidden;
            box-shadow: var(--btn-shadow);
            text-decoration: none;
            border-radius: 0.375rem; /* Tailwind rounded */
            margin: 0 0.5rem;
        }

        .ui-btn-register {
            --btn-default-bg: rgb(34, 197, 94); /* Green-500 */
            --btn-hover-bg: rgb(22, 163, 74); /* Green-600 */
        }

        .ui-btn span {
            letter-spacing: var(--btn-letter-spacing);
            transition: var(--btn-transition);
            box-sizing: border-box;
            position: relative;
            background: inherit;
        }

        .ui-btn span::before {
            box-sizing: border-box;
            position: absolute;
            content: "";
            background: inherit;
        }

        .ui-btn:hover, .ui-btn:focus {
            background: var(--btn-hover-bg);
        }

        .ui-btn:hover span, .ui-btn:focus span {
            color: var(--hover-btn-color);
        }

        .ui-btn:hover span::before, .ui-btn:focus span::before {
            animation: chitchat linear both var(--btn-animation-duration);
        }

        @keyframes chitchat {
            0% { content: "#"; }
            5% { content: "."; }
            10% { content: "^{"; }
            15% { content: "-!"; }
            20% { content: "#$_"; }
            25% { content: "№:0"; }
            30% { content: "#{+."; }
            35% { content: "@}-?"; }
            40% { content: "?{4@%"; }
            45% { content: "=.,^!"; }
            50% { content: "?2@%"; }
            55% { content: "\;1}]"; }
            60% { content: "?{%:%"; right: 0; }
            65% { content: "|{f[4"; right: 0; }
            70% { content: "{4%0%"; right: 0; }
            75% { content: "'1_0<"; right: 0; }
            80% { content: "{0%"; right: 0; }
            85% { content: "]>'"; right: 0; }
            90% { content: "4"; right: 0; }
            95% { content: "2"; right: 0; }
            100% { content: ""; right: 0; }
        }
    </style>
<body class="bg-gray-100 font-sans leading-normal tracking-normal">
    <nav class="bg-white shadow-lg">
        <div class="max-w-6xl mx-auto px-4">
            <div class="flex justify-between">
                <div class="flex space-x-7">
                    <a href="#" class="flex items-center py-4 px-2">
                        <span class="font-semibold text-gray-500 text-lg">Gestion Des Loyers</span>
                    </a>
                </div>
                <div class="flex items-center space-x-3">
                    @guest
                        <a href="{{ route('login') }}" class="ui-btn ui-btn-login">
                            <span>Connexion</span>
                        </a>
                        <a href="{{ route('register') }}" class="ui-btn ui-btn-register">
                            <span>Inscription</span>
                        </a>
                    @endguest
                    @auth
                        <a href="{{ route('dashboard') }}" class="py-2 px-4 bg-blue-500 text-white rounded hover:bg-blue-600 transition duration-300">
                            Tableau de Bord
                        </a>
                    @endauth
                </div>
            </div>
        </div>
    </nav>

    <main class="container mx-auto mt-10 px-4">
        <div class="grid md:grid-cols-2 gap-8 items-center">
            <div>
                <h1 class="text-4xl font-bold text-gray-800 mb-4">Gérez vos biens immobiliers simplement</h1>
                <p class="text-gray-600 mb-6">
                    Gestion Des Loyers est votre solution tout-en-un pour suivre vos locations, gérer vos revenus et simplifier votre comptabilité locative.
                </p>
                <div class="flex space-x-4">
                    @guest
                        <a href="{{ route('register') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded transition duration-300">
                            Commencer
                        </a>
                    @endguest
                    @auth
                        <a href="{{ route('dashboard') }}" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded transition duration-300">
                            Accéder au Tableau de Bord
                        </a>
                    @endauth
                </div>
            </div>
            <div>
                <img style="width: 600px; height: 600px; object-fit: cover;margin-top: 50px;margin-bottom: 50px;" src="{{ asset('images/welcome1.png') }}" alt="Gestion Locative" class="w-full h-auto max-h-96 object-cover">
            </div>
        </div>

        <section class="mt-16 text-center">
            <h2 class="text-3xl font-bold mb-8">Fonctionnalités Clés</h2>
            <div class="grid md:grid-cols-3 gap-8">
                <div class="bg-white p-6 rounded-lg shadow-md">
                    <h3 class="font-bold text-xl mb-4">Suivi des Loyers</h3>
                    <p>Suivez facilement vos revenus locatifs et historique de paiements.</p>
                </div>
                <div class="bg-white p-6 rounded-lg shadow-md">
                    <h3 class="font-bold text-xl mb-4">Gestion des Charges</h3>
                    <p>Enregistrez et catégorisez toutes vos dépenses liées à vos biens.</p>
                </div>
                <div class="bg-white p-6 rounded-lg shadow-md">
                    <h3 class="font-bold text-xl mb-4">Transactions</h3>
                    <p>Visualisez et analysez toutes vos transactions immobilières.</p>
                </div>
            </div>
        </section>
    </main>

    <footer class="bg-gray-800 text-white py-8 mt-16">
        <div class="container mx-auto text-center">
            <p>&copy; {{ date('Y') }} Gestion Des Loyers. Tous droits réservés.</p>
        </div>
    </footer>
</body>
</html>
