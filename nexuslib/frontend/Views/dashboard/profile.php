    <main class="min-h-screen pt-24 pb-12 px-6">
        <div class="max-w-6xl mx-auto">
            
            <!-- Profile Header -->
            <div class="mb-12">
                <div class="flex flex-col md:flex-row items-start md:items-center justify-between gap-6 bg-slate-800 bg-opacity-50 border border-slate-700 rounded-lg p-8">
                    <div class="flex items-center gap-4">
                        <div class="w-20 h-20 bg-gradient-to-br from-cyan-400 to-blue-600 rounded-full flex items-center justify-center">
                            <span class="text-white font-bold text-2xl">LD</span>
                        </div>
                        <div>
                            <h1 class="text-3xl font-bold text-white" id="profile-name">Leandro Dhoskey</h1>
                            <p class="text-gray-400" id="profile-email">leandro@universidad.edu</p>
                            <p class="text-cyan-400 text-sm mt-1">Miembro desde Enero 2024</p>
                        </div>
                    </div>
                    <button onclick="editProfile()" class="px-6 py-2 bg-cyan-500 hover:bg-cyan-600 text-white rounded-lg transition-colors font-medium">
                        Editar Perfil
                    </button>
                </div>
            </div>

            <!-- Two Panel Layout -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                
                <!-- LEFT PANEL: My Saved Books -->
                <div class="bg-slate-800 bg-opacity-50 border border-slate-700 rounded-lg p-8">
                    <h2 class="text-2xl font-bold text-white mb-6 flex items-center gap-2">
                        <svg class="w-6 h-6 text-cyan-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 5a2 2 0 012-2h6a2 2 0 012 2v12a2 2 0 01-2 2H7a2 2 0 01-2-2V5z"></path>
                        </svg>
                        Mis Libros Guardados (Favoritos)
                    </h2>

                    <div class="space-y-4">
                        <!-- Saved Book 1 -->
                        <div class="bg-slate-700 bg-opacity-40 border border-slate-600 rounded-lg p-4 hover:border-cyan-500 transition-colors group cursor-pointer">
                            <div class="flex gap-4">
                                <div class="w-16 h-24 bg-gradient-to-br from-blue-600 to-blue-900 rounded flex-shrink-0"></div>
                                <div class="flex-1">
                                    <h4 class="text-white font-semibold group-hover:text-cyan-400 transition-colors">Programación en Python</h4>
                                    <p class="text-gray-400 text-sm">Mark Lutz</p>
                                    <p class="text-cyan-400 text-xs mt-1">Alpha Cloud</p>
                                    <button onclick="removeSaved(this)" class="text-red-400 hover:text-red-300 text-xs mt-2">Eliminar</button>
                                </div>
                            </div>
                        </div>

                        <!-- Saved Book 2 -->
                        <div class="bg-slate-700 bg-opacity-40 border border-slate-600 rounded-lg p-4 hover:border-cyan-500 transition-colors group cursor-pointer">
                            <div class="flex gap-4">
                                <div class="w-16 h-24 bg-gradient-to-br from-purple-600 to-purple-900 rounded flex-shrink-0"></div>
                                <div class="flex-1">
                                    <h4 class="text-white font-semibold group-hover:text-cyan-400 transition-colors">Bases de Datos SQL Avanzadas</h4>
                                    <p class="text-gray-400 text-sm">Elizabeth Tory</p>
                                    <p class="text-purple-400 text-xs mt-1">e-Libro</p>
                                    <button onclick="removeSaved(this)" class="text-red-400 hover:text-red-300 text-xs mt-2">Eliminar</button>
                                </div>
                            </div>
                        </div>

                        <!-- Saved Book 3 -->
                        <div class="bg-slate-700 bg-opacity-40 border border-slate-600 rounded-lg p-4 hover:border-cyan-500 transition-colors group cursor-pointer">
                            <div class="flex gap-4">
                                <div class="w-16 h-24 bg-gradient-to-br from-green-600 to-green-900 rounded flex-shrink-0"></div>
                                <div class="flex-1">
                                    <h4 class="text-white font-semibold group-hover:text-cyan-400 transition-colors">Desarrollo Web Moderno</h4>
                                    <p class="text-gray-400 text-sm">Kyle Simpson</p>
                                    <p class="text-green-400 text-xs mt-1">Disponible en Biblioteca Física</p>
                                    <button onclick="removeSaved(this)" class="text-red-400 hover:text-red-300 text-xs mt-2">Eliminar</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Empty State (commented out) -->
                    <!-- 
                    <div class="text-center py-12">
                        <svg class="w-16 h-16 text-slate-600 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 5a2 2 0 012-2h6a2 2 0 012 2v12a2 2 0 01-2 2H7a2 2 0 01-2-2V5z"></path>
                        </svg>
                        <p class="text-gray-400">No tienes libros guardados aún</p>
                        <a href="/home/index.html" class="text-cyan-400 hover:text-cyan-300 text-sm mt-2 inline-block">Explorar libros</a>
                    </div>
                    -->
                </div>

                <!-- RIGHT PANEL: My Reserved Books -->
                <div class="bg-slate-800 bg-opacity-50 border border-slate-700 rounded-lg p-8">
                    <h2 class="text-2xl font-bold text-white mb-6 flex items-center gap-2">
                        <svg class="w-6 h-6 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        Mis Libros Reservados
                    </h2>

                    <div class="space-y-4">
                        <!-- Reserved Book 1 -->
                        <div class="bg-green-900 bg-opacity-30 border border-green-600 rounded-lg p-4 hover:border-green-500 transition-colors group">
                            <div class="flex gap-4">
                                <div class="w-16 h-24 bg-gradient-to-br from-orange-600 to-orange-900 rounded flex-shrink-0"></div>
                                <div class="flex-1">
                                    <h4 class="text-white font-semibold">Desarrollo Web Moderno</h4>
                                    <p class="text-gray-400 text-sm">Kyle Simpson</p>
                                    <div class="mt-2 bg-green-900 bg-opacity-50 border border-green-600 rounded px-2 py-1">
                                        <p class="text-green-300 text-xs"><strong>Estado:</strong> Listo para recoger</p>
                                        <p class="text-green-300 text-xs"><strong>Ubicación:</strong> Estante B-4</p>
                                        <p class="text-green-300 text-xs"><strong>Fecha límite:</strong> 15 Jun 2024</p>
                                    </div>
                                    <div class="flex gap-2 mt-3">
                                        <button onclick="pickupBook()" class="text-green-400 hover:text-green-300 text-xs font-semibold">✓ Confirmar Recogida</button>
                                        <button onclick="cancelReservation()" class="text-red-400 hover:text-red-300 text-xs font-semibold">✕ Cancelar</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Reserved Book 2 -->
                        <div class="bg-yellow-900 bg-opacity-30 border border-yellow-600 rounded-lg p-4 hover:border-yellow-500 transition-colors group">
                            <div class="flex gap-4">
                                <div class="w-16 h-24 bg-gradient-to-br from-indigo-600 to-indigo-900 rounded flex-shrink-0"></div>
                                <div class="flex-1">
                                    <h4 class="text-white font-semibold">Algoritmos Avanzados</h4>
                                    <p class="text-gray-400 text-sm">Robert Sedgewick</p>
                                    <div class="mt-2 bg-yellow-900 bg-opacity-50 border border-yellow-600 rounded px-2 py-1">
                                        <p class="text-yellow-300 text-xs"><strong>Estado:</strong> En procesamiento</p>
                                        <p class="text-yellow-300 text-xs"><strong>Posición en cola:</strong> 1 de 3</p>
                                        <p class="text-yellow-300 text-xs"><strong>Estimado:</strong> 3-5 días hábiles</p>
                                    </div>
                                    <div class="flex gap-2 mt-3">
                                        <button onclick="cancelReservation()" class="text-red-400 hover:text-red-300 text-xs font-semibold">✕ Cancelar</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Empty State (commented out) -->
                    <!-- 
                    <div class="text-center py-12">
                        <svg class="w-16 h-16 text-slate-600 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        <p class="text-gray-400">No tienes reservas activas</p>
                    </div>
                    -->
                </div>

            </div>

        </div>
    </main>
