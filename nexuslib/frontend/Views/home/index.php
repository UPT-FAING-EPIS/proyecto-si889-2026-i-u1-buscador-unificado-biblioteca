    <!-- MAIN CONTENT -->
    <main class="gradient-bg min-h-screen pt-20 pb-12">
        <div class="max-w-4xl mx-auto px-6 flex flex-col items-center justify-center">
            
            <!-- Hero Section -->
            <div class="text-center mb-12">
                <h1 class="text-5xl md:text-6xl font-bold mb-4 text-white">
                    Descubre recursos académicos
                </h1>
                <p class="text-xl text-gray-300 mb-8">
                    Acceso unificado a libros digitales, bases de datos y catálogos de bibliotecas
                </p>
            </div>

            <!-- Search Input -->
            <div class="w-full max-w-2xl mb-12">
                <div class="relative">
                    <input 
                        type="text" 
                        placeholder="Buscar libros, artículos, autores..." 
                        class="w-full px-6 py-4 bg-slate-800 border border-slate-600 rounded-xl text-white placeholder-gray-400 focus:outline-none focus:border-cyan-500 focus:ring-2 focus:ring-cyan-500 focus:ring-opacity-50 text-lg shadow-xl"
                        onkeypress="if(event.key === 'Enter') goToSearch(this.value)"
                    >
                    <button onclick="goToSearch(document.querySelector('input').value)" class="absolute right-2 top-1/2 transform -translate-y-1/2 bg-cyan-500 hover:bg-cyan-600 text-white px-6 py-2 rounded-lg transition-colors font-medium">
                        Buscar
                    </button>
                </div>
            </div>

            <!-- Quick Filters Section -->
            <div class="w-full max-w-2xl grid grid-cols-1 md:grid-cols-2 gap-8">
                
                <!-- Filter Group 1: Source/Origin -->
                <div class="bg-slate-800 bg-opacity-50 backdrop-blur-sm border border-slate-700 rounded-xl p-6">
                    <h3 class="text-lg font-semibold text-white mb-4 flex items-center gap-2">
                        <svg class="w-5 h-5 text-cyan-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path>
                        </svg>
                        Origen de Recursos
                    </h3>
                    <div class="space-y-3">
                        <label class="flex items-center cursor-pointer group">
                            <input type="radio" name="origin" value="alpha-cloud" class="w-4 h-4 text-cyan-500 cursor-pointer">
                            <span class="ml-3 text-gray-300 group-hover:text-white transition-colors">Alpha Cloud</span>
                        </label>
                        <label class="flex items-center cursor-pointer group">
                            <input type="radio" name="origin" value="elibro" class="w-4 h-4 text-cyan-500 cursor-pointer">
                            <span class="ml-3 text-gray-300 group-hover:text-white transition-colors">e-Libro</span>
                        </label>
                        <label class="flex items-center cursor-pointer group">
                            <input type="radio" name="origin" value="disponibles" class="w-4 h-4 text-cyan-500 cursor-pointer">
                            <span class="ml-3 text-gray-300 group-hover:text-white transition-colors">Disponibles en UPT</span>
                        </label>
                    </div>
                </div>

                <!-- Filter Group 2: Category -->
                <div class="bg-slate-800 bg-opacity-50 backdrop-blur-sm border border-slate-700 rounded-xl p-6">
                    <h3 class="text-lg font-semibold text-white mb-4 flex items-center gap-2">
                        <svg class="w-5 h-5 text-cyan-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                        </svg>
                        Categoría
                    </h3>
                    <div class="space-y-3">
                        <label class="flex items-center cursor-pointer group">
                            <input type="checkbox" class="w-4 h-4 text-cyan-500 cursor-pointer">
                            <span class="ml-3 text-gray-300 group-hover:text-white transition-colors">Ingeniería</span>
                        </label>
                        <label class="flex items-center cursor-pointer group">
                            <input type="checkbox" class="w-4 h-4 text-cyan-500 cursor-pointer">
                            <span class="ml-3 text-gray-300 group-hover:text-white transition-colors">Administración</span>
                        </label>
                        <label class="flex items-center cursor-pointer group">
                            <input type="checkbox" class="w-4 h-4 text-cyan-500 cursor-pointer">
                            <span class="ml-3 text-gray-300 group-hover:text-white transition-colors">Ciencias</span>
                        </label>
                    </div>
                </div>

            </div>

        </div>
    </main>

    <script>
        function goToSearch(query) {
            const origin = document.querySelector('input[name="origin"]:checked')?.value || '';
            const params = new URLSearchParams();
            if (query) params.append('q', query);
            if (origin) params.append('origin', origin);
            window.location.href = '/search/results.html' + (params.toString() ? '?' + params.toString() : '');
        }
    </script>
</body>
</html>
