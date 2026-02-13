<nav class="fixed top-0 w-full z-50 bg-slate-900 dark:bg-slate-950 text-white shadow-lg border-b border-slate-700 transition-colors duration-300">
    <div class="container mx-auto px-6 py-4 flex justify-between items-center">
        
        <div class="flex flex-col">
            <a href="#" class="text-xl font-bold tracking-wider hover:text-blue-400 focus:text-blue-400 transition rounded px-2 focus:bg-slate-800 focus:outline-none">
                {{ strtoupper($dados['nome']) }}
            </a>
            <span class="text-xs text-gray-400 hidden md:block px-2">{{ $dados['cargo'] }}</span>
        </div>

        <div class="flex items-center space-x-4">
            
            <button id="theme-toggle" type="button" 
                class="p-2 rounded-full text-yellow-300 hover:bg-slate-700 focus:bg-slate-700 transition focus:outline-none mr-2 border border-transparent focus:border-blue-400"
                aria-label="Alternar Tema">
                <i id="theme-toggle-dark-icon" class="fas fa-moon hidden"></i>
                <i id="theme-toggle-light-icon" class="fas fa-sun hidden"></i>
            </button>
            
            <div class="h-6 w-px bg-slate-700 mx-2 hidden sm:block"></div>

            <a href="https://{{ $dados['contato']['github'] }}" target="_blank" title="GitHub" 
               class="p-2 rounded-full hover:bg-slate-700 focus:bg-slate-700 hover:text-white focus:text-white transition duration-300 transform hover:scale-110 focus:outline-none">
                <i class="fab fa-github fa-2x"></i>
            </a>

            <a href="https://{{ $dados['contato']['linkedin'] }}" target="_blank" title="LinkedIn" 
               class="p-2 rounded-full hover:bg-blue-900 focus:bg-blue-900 hover:text-blue-400 focus:text-blue-400 transition duration-300 transform hover:scale-110 focus:outline-none">
                <i class="fab fa-linkedin fa-2x"></i>
            </a>

            <div class="relative group">
                <button id="btn-copy-email" 
                   data-email="{{ $dados['contato']['email'] }}"
                   title="Copiar Email para Área de Transferência" 
                   class="p-2 rounded-full hover:bg-red-900 focus:bg-red-900 hover:text-red-400 focus:text-red-400 transition duration-300 transform hover:scale-110 focus:outline-none">
                    
                    <i id="icon-email" class="fas fa-envelope fa-2x"></i>
                    
                    <i id="icon-success" class="fas fa-check fa-2x hidden text-green-400"></i>
                </button>
                
                <span id="tooltip-msg" class="absolute top-full left-1/2 -translate-x-1/2 mt-2 px-2 py-1 bg-gray-700 text-white text-xs rounded opacity-0 group-hover:opacity-100 transition-opacity pointer-events-none whitespace-nowrap">
                    Copiar Email
                </span>
            </div>

        </div>
    </div>
</nav>

<script>
    // --- LÓGICA DO TEMA (JÁ EXISTIA) ---
    var themeToggleBtn = document.getElementById('theme-toggle');
    var darkIcon = document.getElementById('theme-toggle-dark-icon');
    var lightIcon = document.getElementById('theme-toggle-light-icon');

    function updateIcons() {
        if (document.documentElement.classList.contains('dark')) {
            darkIcon.classList.add('hidden');
            lightIcon.classList.remove('hidden');
        } else {
            lightIcon.classList.add('hidden');
            darkIcon.classList.remove('hidden');
        }
    }
    updateIcons();

    themeToggleBtn.addEventListener('click', function() {
        document.documentElement.classList.toggle('dark');
        localStorage.setItem('theme', document.documentElement.classList.contains('dark') ? 'dark' : 'light');
        updateIcons();
    });

    // --- NOVA LÓGICA: COPIAR EMAIL ---
    const btnCopy = document.getElementById('btn-copy-email');
    const iconEmail = document.getElementById('icon-email');
    const iconSuccess = document.getElementById('icon-success');
    const tooltipMsg = document.getElementById('tooltip-msg');

    btnCopy.addEventListener('click', function() {
        const email = this.getAttribute('data-email');

        // Comando mágico que copia para o clipboard
        navigator.clipboard.writeText(email).then(() => {
            
            // 1. Troca o ícone de carta para check
            iconEmail.classList.add('hidden');
            iconSuccess.classList.remove('hidden');
            
            // 2. Muda o texto do tooltip
            tooltipMsg.innerText = "Email Copiado!";
            tooltipMsg.classList.remove('opacity-0'); // Força aparecer mesmo sem hover momentâneo

            // 3. Volta ao normal depois de 2 segundos
            setTimeout(() => {
                iconEmail.classList.remove('hidden');
                iconSuccess.classList.add('hidden');
                tooltipMsg.innerText = "Copiar Email";
                tooltipMsg.classList.add('opacity-0'); // Reseta estilo
            }, 2000);
        }).catch(err => {
            console.error('Erro ao copiar: ', err);
            alert('Erro ao copiar email. Tente manualmente.');
        });
    });
</script>