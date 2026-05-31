    <main class="min-h-screen pt-24 pb-12 px-6">
        <div class="max-w-6xl mx-auto">
            
            <!-- Search Bar Top -->
            <div class="mb-8">
                <div class="relative max-w-2xl">
                    <input 
                        type="text" 
                        placeholder="Buscar..." 
                        value="Programación en Python"
                        class="w-full px-6 py-3 bg-slate-800 border border-slate-600 rounded-lg text-white placeholder-gray-400 focus:outline-none focus:border-cyan-500 focus:ring-2 focus:ring-cyan-500 focus:ring-opacity-50"
                        onkeypress="if(event.key === 'Enter') search(this.value)"
                    >
                    <button onclick="search(document.querySelector('input').value)" class="absolute right-2 top-1/2 transform -translate-y-1/2 bg-cyan-500 hover:bg-cyan-600 text-white px-4 py-1 rounded transition-colors text-sm">
                        Buscar
                    </button>
                </div>
            </div>

            <!-- Results Count -->
            <p class="text-gray-400 mb-6">Se encontraron <span class="text-cyan-400 font-bold">3</span> resultados</p>

            <!-- Results Grid -->
            <div class="space-y-6">

                <!-- Result Card 1: Alpha Cloud Badge -->
                <div class="bg-slate-800 bg-opacity-50 backdrop-blur-sm border border-slate-700 rounded-lg overflow-hidden hover:border-cyan-500 transition-all hover:shadow-lg hover:shadow-cyan-500/20 group cursor-pointer" onclick="goToDetails(1)">
                    <div class="flex flex-col md:flex-row gap-6 p-6">
                        <!-- Book Cover -->
                        <div class="w-full md:w-40 flex-shrink-0">
                            <div class="w-full h-56 bg-gradient-to-br from-blue-600 to-blue-900 rounded-lg flex items-center justify-center text-center p-4 relative">
                                <div class="text-white font-bold text-lg">Programación en Python</div>
                                <!-- Badge -->
                                <div class="absolute top-2 right-2 bg-blue-500 text-white text-xs font-bold px-3 py-1 rounded-full">
                                    Alpha Cloud
                                </div>
                            </div>
                        </div>

                        <!-- Book Info -->
                        <div class="flex-1">
                            <h3 class="text-2xl font-bold text-white mb-2 group-hover:text-cyan-400 transition-colors">
                                Programación en Python: Guía Completa
                            </h3>
                            <p class="text-cyan-400 font-semibold mb-3">Autor: Mark Lutz</p>
                            <p class="text-gray-300 mb-4">
                                Una guía exhaustiva sobre programación en Python, cubriendo desde conceptos básicos hasta técnicas avanzadas. Incluye ejemplos prácticos y ejercicios para reforzar el aprendizaje.
                            </p>
                            <div class="flex flex-wrap gap-2 mb-4">
                                <span class="bg-slate-700 text-gray-200 text-xs px-3 py-1 rounded-full">Python</span>
                                <span class="bg-slate-700 text-gray-200 text-xs px-3 py-1 rounded-full">Programación</span>
                                <span class="bg-slate-700 text-gray-200 text-xs px-3 py-1 rounded-full">2024</span>
                            </div>
                            <button class="bg-cyan-500 hover:bg-cyan-600 text-white px-4 py-2 rounded transition-colors font-medium">
                                Ver detalles
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Result Card 2: e-Libro Badge -->
                <div class="bg-slate-800 bg-opacity-50 backdrop-blur-sm border border-slate-700 rounded-lg overflow-hidden hover:border-cyan-500 transition-all hover:shadow-lg hover:shadow-cyan-500/20 group cursor-pointer" onclick="goToDetails(2)">
                    <div class="flex flex-col md:flex-row gap-6 p-6">
                        <!-- Book Cover -->
                        <div class="w-full md:w-40 flex-shrink-0">
                            <div class="w-full h-56 bg-gradient-to-br from-purple-600 to-purple-900 rounded-lg flex items-center justify-center text-center p-4 relative">
                                <div class="text-white font-bold text-lg">Bases de Datos SQL</div>
                                <!-- Badge -->
                                <div class="absolute top-2 right-2 bg-purple-500 text-white text-xs font-bold px-3 py-1 rounded-full">
                                    e-Libro
                                </div>
                            </div>
                        </div>

                        <!-- Book Info -->
                        <div class="flex-1">
                            <h3 class="text-2xl font-bold text-white mb-2 group-hover:text-cyan-400 transition-colors">
                                Bases de Datos SQL Avanzadas
                            </h3>
                            <p class="text-cyan-400 font-semibold mb-3">Autor: Elizabeth Tory</p>
                            <p class="text-gray-300 mb-4">
                                Estudio profundo de SQL y sistemas de gestión de bases de datos. Perfecto para profesionales que deseen dominar consultas complejas y optimización de rendimiento.
                            </p>
                            <div class="flex flex-wrap gap-2 mb-4">
                                <span class="bg-slate-700 text-gray-200 text-xs px-3 py-1 rounded-full">SQL</span>
                                <span class="bg-slate-700 text-gray-200 text-xs px-3 py-1 rounded-full">Bases de Datos</span>
                                <span class="bg-slate-700 text-gray-200 text-xs px-3 py-1 rounded-full">2023</span>
                            </div>
                            <button class="bg-cyan-500 hover:bg-cyan-600 text-white px-4 py-2 rounded transition-colors font-medium">
                                Ver detalles
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Result Card 3: Available in Physical Library (Green Badge) -->
                <div class="bg-slate-800 bg-opacity-50 backdrop-blur-sm border border-slate-700 rounded-lg overflow-hidden hover:border-cyan-500 transition-all hover:shadow-lg hover:shadow-cyan-500/20 group cursor-pointer" onclick="goToDetails(3)">
                    <div class="flex flex-col md:flex-row gap-6 p-6">
                        <!-- Book Cover -->
                        <div class="w-full md:w-40 flex-shrink-0">
                            <div class="w-full h-56 bg-gradient-to-br from-orange-600 to-orange-900 rounded-lg flex items-center justify-center text-center p-4 relative">
                                <div class="text-white font-bold text-lg">Desarrollo Web Moderno</div>
                                <!-- Green Available Badge -->
                                <div class="absolute top-2 right-2 bg-green-500 text-white text-xs font-bold px-3 py-1 rounded-full animate-pulse">
                                    ✓ Disponible en Biblioteca Física
                                </div>
                            </div>
                        </div>

                        <!-- Book Info -->
                        <div class="flex-1">
                            <h3 class="text-2xl font-bold text-white mb-2 group-hover:text-cyan-400 transition-colors">
                                Desarrollo Web Moderno con React y Node.js
                            </h3>
                            <p class="text-cyan-400 font-semibold mb-3">Autor: Kyle Simpson</p>
                            <p class="text-gray-300 mb-4">
                                Aprende a construir aplicaciones web completas utilizando React para frontend y Node.js para backend. Incluye arquitectura moderna y mejores prácticas de desarrollo.
                            </p>
                            <div class="flex flex-wrap gap-2 mb-4">
                                <span class="bg-slate-700 text-gray-200 text-xs px-3 py-1 rounded-full">Web</span>
                                <span class="bg-slate-700 text-gray-200 text-xs px-3 py-1 rounded-full">React</span>
                                <span class="bg-slate-700 text-gray-200 text-xs px-3 py-1 rounded-full">Node.js</span>
                                <span class="bg-green-900 text-green-200 text-xs px-3 py-1 rounded-full">Físico</span>
                            </div>
                            <button class="bg-cyan-500 hover:bg-cyan-600 text-white px-4 py-2 rounded transition-colors font-medium">
                                Ver detalles
                            </button>
                        </div>
                    </div>
                </div>

            </div>

        </div>
    </main>
