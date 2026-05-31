    <main class="min-h-screen pt-24 pb-12 px-6">
        <div class="max-w-6xl mx-auto">
            
            <!-- Back Button -->
            <a href="/search/results.html" class="inline-flex items-center gap-2 text-cyan-400 hover:text-cyan-300 mb-8 transition-colors">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                </svg>
                Volver a resultados
            </a>

            <!-- Book Title -->
            <h1 class="text-4xl md:text-5xl font-bold text-white mb-12">
                Desarrollo Web Moderno con React y Node.js
            </h1>

            <!-- Two Column Layout -->
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                
                <!-- LEFT COLUMN: Book Cover & Digital Info -->
                <div class="lg:col-span-1">
                    <!-- Book Cover Large -->
                    <div class="w-full bg-gradient-to-br from-orange-600 to-orange-900 rounded-lg flex items-center justify-center aspect-square mb-6 shadow-xl">
                        <div class="text-center text-white p-8">
                            <div class="text-5xl font-bold mb-4">馃摎</div>
                            <div class="font-bold text-lg">Desarrollo Web Moderno</div>
                            <div class="text-sm mt-2 opacity-80">con React y Node.js</div>
                        </div>
                    </div>

                    <!-- Digital Catalog Section -->
                    <div class="bg-slate-800 bg-opacity-50 border border-slate-700 rounded-lg p-6">
                        <h3 class="text-xl font-bold text-white mb-6 flex items-center gap-2">
                            <svg class="w-5 h-5 text-cyan-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4"></path>
                            </svg>
                            Cat谩logo Digital
                        </h3>

                        <div class="space-y-4">
                            <div>
                                <p class="text-gray-400 text-sm">Autor</p>
                                <p class="text-white font-semibold">Kyle Simpson</p>
                            </div>
                            <div>
                                <p class="text-gray-400 text-sm">Editorial</p>
                                <p class="text-white font-semibold">Tech Publishers Inc.</p>
                            </div>
                            <div>
                                <p class="text-gray-400 text-sm">A帽o de Publicaci贸n</p>
                                <p class="text-white font-semibold">2024</p>
                            </div>
                            <div>
                                <p class="text-gray-400 text-sm">P谩ginas</p>
                                <p class="text-white font-semibold">480</p>
                            </div>
                            <div>
                                <p class="text-gray-400 text-sm">ISBN</p>
                                <p class="text-white font-semibold text-sm">978-1-491-96734-2</p>
                            </div>
                            <div>
                                <p class="text-gray-400 text-sm mb-2">Origen</p>
                                <span class="inline-block bg-green-900 text-green-200 text-xs font-bold px-3 py-1 rounded-full">Disponible en Biblioteca F铆sica</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- RIGHT COLUMN: Sinopsis & Physical Library Info -->
                <div class="lg:col-span-2 space-y-8">
                    
                    <!-- Synopsis -->
                    <div class="bg-slate-800 bg-opacity-50 border border-slate-700 rounded-lg p-8">
                        <h2 class="text-2xl font-bold text-white mb-6">Sinopsis</h2>
                        <p class="text-gray-300 leading-relaxed mb-4">
                            Este libro completo te gu铆a a trav茅s de todos los aspectos del desarrollo web moderno. Aprender谩s c贸mo construir aplicaciones frontend escalables con React, incluyendo hooks, context API y gesti贸n de estado avanzada.
                        </p>
                        <p class="text-gray-300 leading-relaxed mb-4">
                            En la segunda parte, dominar谩s Node.js y Express para crear backends robustos con bases de datos SQL y NoSQL. Se cubren temas como autenticaci贸n, autorizaci贸n, APIs RESTful y buenas pr谩cticas de seguridad.
                        </p>
                        <p class="text-gray-300 leading-relaxed">
                            Incluye m煤ltiples proyectos pr谩cticos que te permitir谩n aplicar inmediatamente lo aprendido, desde una aplicaci贸n de gesti贸n de tareas hasta un sistema completo de e-commerce.
                        </p>
                    </div>

                    <!-- Physical Library Information -->
                    <div class="bg-gradient-to-br from-green-900 to-green-950 border-2 border-green-600 rounded-lg p-8 shadow-lg shadow-green-600/30">
                        <h2 class="text-2xl font-bold text-white mb-6 flex items-center gap-2">
                            <svg class="w-6 h-6 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5.5m0 0H9m0 0H3.5m0 0H1"></path>
                            </svg>
                            Disponible en Biblioteca F铆sica
                        </h2>

                        <div class="space-y-4">
                            <div class="bg-green-800 bg-opacity-40 border border-green-600 rounded-lg p-4">
                                <p class="text-gray-300 text-sm mb-2">Ubicaci贸n en Campus</p>
                                <p class="text-2xl font-bold text-green-300">Estante B-4</p>
                                <p class="text-gray-400 text-sm mt-2">Biblioteca Central - Secci贸n de Tecnolog铆a</p>
                            </div>

                            <div class="grid grid-cols-2 gap-4">
                                <div class="bg-green-800 bg-opacity-40 border border-green-600 rounded-lg p-4">
                                    <p class="text-gray-400 text-sm">Estado</p>
                                    <p class="text-white font-semibold">Disponible</p>
                                </div>
                                <div class="bg-green-800 bg-opacity-40 border border-green-600 rounded-lg p-4">
                                    <p class="text-gray-400 text-sm">Copias</p>
                                    <p class="text-white font-semibold">2 disponibles</p>
                                </div>
                            </div>

                            <!-- Reserve Button -->
                            <button onclick="reserveBook()" class="w-full mt-6 bg-gradient-to-r from-green-500 to-green-600 hover:from-green-600 hover:to-green-700 text-white font-bold py-4 px-6 rounded-lg transition-all transform hover:scale-105 shadow-lg text-lg flex items-center justify-center gap-2">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                Reservar Libro F铆sico
                            </button>

                            <p class="text-green-200 text-sm text-center mt-4">
                                La reserva tiene validez de 7 d铆as. Puedes recoger el libro en la Biblioteca Central.
                            </p>
                        </div>
                    </div>

                    <!-- Related Tags -->
                    <div class="bg-slate-800 bg-opacity-50 border border-slate-700 rounded-lg p-6">
                        <h3 class="text-lg font-bold text-white mb-4">Etiquetas</h3>
                        <div class="flex flex-wrap gap-3">
                            <span class="bg-blue-900 text-blue-200 px-4 py-2 rounded-full text-sm">#React</span>
                            <span class="bg-purple-900 text-purple-200 px-4 py-2 rounded-full text-sm">#Node.js</span>
                            <span class="bg-pink-900 text-pink-200 px-4 py-2 rounded-full text-sm">#JavaScript</span>
                            <span class="bg-green-900 text-green-200 px-4 py-2 rounded-full text-sm">#Programaci贸n</span>
                            <span class="bg-orange-900 text-orange-200 px-4 py-2 rounded-full text-sm">#Desarrollo Web</span>
                        </div>
                    </div>

                </div>

            </div>

        </div>
    </main>
