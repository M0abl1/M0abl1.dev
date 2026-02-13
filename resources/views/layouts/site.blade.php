<!DOCTYPE html>
<html lang="pt-BR" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Currículo - {{ $dados['nome'] }}</title>
    
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            darkMode: 'class', // Isso é essencial!
        }
    </script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <link rel="stylesheet" type='text/css' href="https://cdn.jsdelivr.net/gh/devicons/devicon@latest/devicon.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        body { padding-top: 80px; }
        *:focus-visible {
            outline: 3px solid #3b82f6;
            outline-offset: 2px;
        }
        .hide-scroll-bar::-webkit-scrollbar { display: none; }
        .hide-scroll-bar { -ms-overflow-style: none; scrollbar-width: none; }
    </style>

    <script>
        // Verifica se tem preferência salva OU se o sistema é Dark
        if (localStorage.theme === 'dark' || (!('theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
            document.documentElement.classList.add('dark')
        } else {
            document.documentElement.classList.remove('dark')
        }
    </script>
</head>
<body class="bg-slate-100 text-slate-800 dark:bg-slate-900 dark:text-slate-100 transition-colors duration-300">

    <a href="#conteudo-principal" 
       class="absolute top-0 left-0 -translate-y-full focus:translate-y-0 z-[100] bg-blue-700 text-white font-bold p-4 transition-transform duration-300 shadow-xl rounded-br-lg focus:outline-none">
        Pular para o conteúdo principal
    </a>

    @yield('content')

    <footer class="mt-12 text-center pb-8 opacity-70 dark:opacity-50">
        <p class="text-sm text-gray-500 dark:text-gray-400">&copy; {{ date('Y') }} {{ $dados['nome'] }}. Construído com <i class="fab fa-laravel text-red-500 mx-1"></i> Laravel & TailwindCSS.</p>
    </footer>

</body>
</html>