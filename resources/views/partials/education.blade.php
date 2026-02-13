<div class="space-y-6">
    <div class="bg-white dark:bg-slate-800 shadow-md rounded-lg p-6 border-t-4 border-blue-500 hover:shadow-xl transition duration-300">
        <h3 class="text-xl font-bold text-gray-800 dark:text-gray-100 mb-6 flex items-center pb-2 border-b border-gray-100 dark:border-gray-700">
            <i class="fas fa-graduation-cap mr-3 text-blue-500"></i> Formação Acadêmica
        </h3>
        
        @foreach($dados['educacao'] as $edu)
            <div class="relative pl-8 border-l-2 border-blue-100 dark:border-slate-600 pb-8 last:pb-0 group">
                <div class="absolute -left-[9px] top-0 w-4 h-4 rounded-full bg-blue-500 border-4 border-white dark:border-slate-800 group-hover:scale-125 transition duration-300 shadow-sm"></div>
                <h4 class="text-xl font-bold text-gray-900 dark:text-white">{{ $edu['curso'] }}</h4>
                <p class="text-gray-600 dark:text-gray-300 font-medium text-lg">{{ $edu['instituicao'] }}</p>
                <span class="inline-block mt-2 bg-blue-50 dark:bg-slate-700 text-blue-700 dark:text-blue-300 text-xs px-3 py-1 rounded-full font-bold uppercase tracking-wide border border-blue-100 dark:border-slate-600">
                    {{ $edu['periodo'] }}
                </span>
            </div>
        @endforeach
    </div>

    <div class="bg-white dark:bg-slate-800 shadow-md rounded-lg p-6 border-t-4 border-purple-500 hover:shadow-xl transition duration-300">
        <h3 class="text-xl font-bold text-gray-800 dark:text-gray-100 mb-4 flex items-center pb-2 border-b border-gray-100 dark:border-gray-700">
            <i class="fas fa-rocket mr-3 text-purple-500"></i> Destaques & Projetos
        </h3>
        <ul class="space-y-3">
            <li class="flex items-start">
                <i class="fas fa-check-circle text-purple-500 mt-1 mr-3"></i>
                <span class="text-gray-700 dark:text-gray-300">Desenvolvimento de TCC em <strong class="text-purple-700 dark:text-purple-400">Visão Computacional</strong> e acessibilidade.</span>
            </li>
            <li class="flex items-start">
                <i class="fas fa-gamepad text-purple-500 mt-1 mr-3"></i>
                <span class="text-gray-700 dark:text-gray-300">Game Dev independente utilizando <strong class="text-purple-700 dark:text-purple-400">Godot Engine</strong>.</span>
            </li>
            <li class="flex items-start">
                <i class="fas fa-server text-purple-500 mt-1 mr-3"></i>
                <span class="text-gray-700 dark:text-gray-300">Containerização com <strong class="text-purple-700 dark:text-purple-400">Docker</strong> e Testes Automatizados.</span>
            </li>
        </ul>
    </div>
</div>