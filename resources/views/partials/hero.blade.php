<div class="bg-white dark:bg-slate-800 shadow-lg rounded-lg overflow-hidden mb-8 transform transition hover:-translate-y-1 duration-300 border border-gray-100 dark:border-slate-700">
    <div class="bg-gradient-to-r from-blue-700 to-indigo-800 p-8 text-white">
        <h1 class="text-3xl md:text-5xl font-bold mb-2 tracking-tight">{{ $dados['nome'] }}</h1>
        <p class="text-lg md:text-xl opacity-90 font-light border-l-4 border-blue-400 pl-4 mt-2">{{ $dados['cargo'] }}</p>
        
        <div class="mt-6 flex flex-wrap gap-4 text-sm opacity-90">
            <span class="bg-blue-800 bg-opacity-50 px-3 py-1 rounded-full flex items-center">
                <i class="fas fa-map-marker-alt mr-2"></i> Bahia, Brasil
            </span>

            @if(isset($dados['contato']['telefone']))
                <a href="tel:{{ preg_replace('/[^0-9]/', '', $dados['contato']['telefone']) }}" class="bg-blue-800 bg-opacity-50 px-3 py-1 rounded-full flex items-center hover:bg-white hover:text-blue-800 transition cursor-pointer focus:outline-none">
                    <i class="fas fa-phone mr-2"></i> {{ $dados['contato']['telefone'] }}
                </a>
            @endif
        </div>
    </div>
    
    <div class="p-8">
        <h2 class="text-2xl font-bold text-gray-800 dark:text-gray-100 mb-4 flex items-center">
            <i class="fas fa-user-circle mr-3 text-blue-600 dark:text-blue-400"></i> Resumo Profissional
        </h2>
        <p class="text-gray-700 dark:text-gray-300 leading-relaxed text-lg text-justify border-l-4 border-gray-200 dark:border-gray-600 pl-4">
            {{ $dados['resumo'] }}
        </p>
    </div>
</div>