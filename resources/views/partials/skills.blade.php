<style>
    .hide-scroll-bar::-webkit-scrollbar { display: none; }
    .hide-scroll-bar { -ms-overflow-style: none; scrollbar-width: none; }
</style>

<div class="space-y-8">
    <div class="flex items-center justify-between border-b border-gray-200 dark:border-gray-700 pb-2 mb-4">
        <h3 class="text-2xl font-bold text-gray-800 dark:text-gray-100 flex items-center">
            <i class="fas fa-code mr-3 text-blue-600 dark:text-blue-400"></i> Habilidades Técnicas
        </h3>
        <span class="text-xs text-gray-400 hidden md:inline-block">
            <i class="fas fa-arrows-alt-h mr-1"></i> Shift+Scroll para navegar
        </span>
    </div>

    @foreach($dados['skills'] as $categoria => $habilidades)
        <div class="bg-white dark:bg-slate-800 shadow-sm rounded-xl overflow-hidden border border-gray-100 dark:border-slate-700 hover:shadow-md transition-shadow duration-300">
            
            <div class="bg-gray-50 dark:bg-slate-700 px-6 py-3 border-b border-gray-100 dark:border-slate-600 flex justify-between items-center">
                <h4 class="font-bold text-gray-700 dark:text-gray-200 uppercase tracking-wider text-sm flex items-center">
                    @if(str_contains($categoria, 'Backend')) <i class="fas fa-server mr-2 text-blue-500 dark:text-blue-400"></i>
                    @elseif(str_contains($categoria, 'Game')) <i class="fas fa-gamepad mr-2 text-purple-500 dark:text-purple-400"></i>
                    @elseif(str_contains($categoria, 'IA')) <i class="fas fa-brain mr-2 text-pink-500 dark:text-pink-400"></i>
                    @elseif(str_contains($categoria, 'Frontend')) <i class="fas fa-desktop mr-2 text-teal-500 dark:text-teal-400"></i>
                    @else <i class="fas fa-tools mr-2 text-gray-500"></i>
                    @endif
                    {{ $categoria }}
                </h4>
            </div>

            <div class="flex overflow-x-auto hide-scroll-bar py-6 px-4 gap-4 snap-x snap-mandatory scroll-smooth focus:outline-none" tabindex="0" aria-label="Carrossel de {{ $categoria }}">
                
                @foreach($habilidades as $skill)
                    <div class="snap-center shrink-0 w-32 md:w-40 bg-white dark:bg-slate-700 border border-gray-200 dark:border-slate-600 p-4 rounded-lg shadow-sm flex flex-col items-center justify-center text-center hover:border-blue-400 dark:hover:border-blue-400 hover:shadow-lg transition duration-300 group focus-within:ring-2 focus-within:ring-blue-500 relative">
                        
                        <div class="text-4xl mb-3 transition-transform duration-300 group-hover:scale-110">
                            <i class="{{ $skill['icon'] }}"></i>
                        </div>
                        
                        <span class="text-sm font-bold text-gray-700 dark:text-gray-200 group-hover:text-blue-600 dark:group-hover:text-blue-300 wrap-break-word w-full">
                            {{ $skill['name'] }}
                        </span>
                        
                        <a href="#" class="absolute inset-0 z-10 focus:outline-none" onclick="return false;"></a>
                    </div>
                @endforeach

            </div>
        </div>
    @endforeach
</div>