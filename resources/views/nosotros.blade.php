<x-layouts.app :title="__('Nosotros')">
    <div class="p-6 bg-[#FDFDFC] dark:bg-[#0a0a0a] min-h-screen">
        <h1 class="text-4xl font-bold text-gray-800 dark:text-gray-200 mb-8 text-center">Nosotros</h1>

        <section class="max-w-4xl mx-auto mb-12 bg-white dark:bg-gray-800 p-8 rounded-lg shadow-md">
            <h2 class="text-3xl font-bold text-gray-800 dark:text-gray-200 mb-6 text-center">Nuestra Historia</h2>
            <p class="text-gray-700 dark:text-gray-300 leading-relaxed mb-4">
                Fundada en 1998 por la familia Huami en las alturas de Puno, Riccharly Huami Agropecuaria nació como un pequeño emprendimiento familiar dedicado al cultivo de papas nativas y la crianza de alpacas. Con el paso de los años, hemos crecido hasta convertirnos en una referencia en la producción agropecuaria sostenible de la región.
            </p>
            <p class="text-gray-700 dark:text-gray-300 leading-relaxed mb-4">
                Nuestro nombre "Riccharly" proviene del quechua y significa "despertar abundante", reflejando nuestra conexión con la tierra y el compromiso con prácticas agrícolas que respetan los ciclos naturales y las tradiciones ancestrales de nuestros antepasados.
            </p>
            <p class="text-gray-700 dark:text-gray-300 leading-relaxed">
                Hoy, con más de dos décadas de experiencia, seguimos fieles a nuestras raíces mientras incorporamos tecnologías modernas que nos permiten mejorar la calidad de nuestros productos sin comprometer nuestros valores fundamentales.
            </p>
        </section>

        <section class="max-w-6xl mx-auto mb-12">
            <h2 class="text-3xl font-bold text-gray-800 dark:text-gray-200 mb-8 text-center">Nuestra Misión y Valores</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 text-center">
                <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-md flex flex-col items-center">
                    <div class="w-20 h-20 bg-gray-100 dark:bg-gray-700 rounded-full flex items-center justify-center text-[#8B805C] text-4xl mb-4">
                        <i class="fas fa-leaf"></i>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-800 dark:text-gray-200 mb-2">Sostenibilidad</h3>
                    <p class="text-gray-600 dark:text-gray-400 text-sm">Implementamos prácticas agrícolas que preservan el suelo, conservan el agua y protegen la biodiversidad local, garantizando la salud de nuestras tierras para las generaciones futuras.</p>
                </div>
                <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-md flex flex-col items-center">
                    <div class="w-20 h-20 bg-gray-100 dark:bg-gray-700 rounded-full flex items-center justify-center text-[#8B805C] text-4xl mb-4">
                        <i class="fas fa-handshake"></i>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-800 dark:text-gray-200 mb-2">Comunidad</h3>
                    <p class="text-gray-600 dark:text-gray-400 text-sm">Trabajamos en estrecha colaboración con las comunidades locales, generando empleo justo y apoyando iniciativas que mejoran la calidad de vida en la región de Puno.</p>
                </div>
                <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-md flex flex-col items-center">
                    <div class="w-20 h-20 bg-gray-100 dark:bg-gray-700 rounded-full flex items-center justify-center text-[#8B805C] text-4xl mb-4">
                        <i class="fas fa-seedling"></i>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-800 dark:text-gray-200 mb-2">Calidad</h3>
                    <p class="text-gray-600 dark:text-gray-400 text-sm">Nos comprometemos a ofrecer productos agropecuarios de la más alta calidad, cultivados con cuidado y respeto por los ciclos naturales y las tradiciones ancestrales andinas.</p>
                </div>
            </div>
        </section>

        <section class="max-w-6xl mx-auto mb-12">
            <h2 class="text-3xl font-bold text-gray-800 dark:text-gray-200 mb-8 text-center">Nuestro Equipo</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8 text-center">
                <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-md">
                    <img src="{{ asset('images/equipo-ricardo.jpg') }}" alt="Ricardo Huami" class="w-32 h-32 rounded-full mx-auto mb-4 object-cover">
                    <h3 class="text-xl font-semibold text-gray-800 dark:text-gray-200">Ricardo Huami</h3>
                    <p class="text-gray-600 dark:text-gray-400 text-sm">Fundador y Director General</p>
                </div>
                <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-md">
                    <img src="{{ asset('images/equipo-maria.jpg') }}" alt="María Quispe" class="w-32 h-32 rounded-full mx-auto mb-4 object-cover">
                    <h3 class="text-xl font-semibold text-gray-800 dark:text-gray-200">María Quispe</h3>
                    <p class="text-gray-600 dark:text-gray-400 text-sm">Directora de Producción Agrícola</p>
                </div>
                <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-md">
                    <img src="{{ asset('images/equipo-carlos.jpg') }}" alt="Carlos Huami" class="w-32 h-32 rounded-full mx-auto mb-4 object-cover">
                    <h3 class="text-xl font-semibold text-gray-800 dark:text-gray-200">Carlos Huami</h3>
                    <p class="text-gray-600 dark:text-gray-400 text-sm">Director de Ganadería</p>
                </div>
                <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-md">
                    <img src="{{ asset('images/equipo-laura.jpg') }}" alt="Laura Mamani" class="w-32 h-32 rounded-full mx-auto mb-4 object-cover">
                    <h3 class="text-xl font-semibold text-gray-800 dark:text-gray-200">Laura Mamani</h3>
                    <p class="text-gray-600 dark:text-gray-400 text-sm">Directora de Sostenibilidad</p>
                </div>
            </div>
        </section>

        <section class="max-w-4xl mx-auto mb-12 bg-white dark:bg-gray-800 p-8 rounded-lg shadow-md">
            <h2 class="text-3xl font-bold text-gray-800 dark:text-gray-200 mb-6 text-center">Nuestra Ubicación</h2>
            <p class="text-gray-700 dark:text-gray-300 leading-relaxed mb-4">
                Estamos ubicados en el corazón de la región de Puno, a 3,850 metros sobre el nivel del mar; en un entorno privilegiado que combina la belleza del altiplano andino con condiciones ideales para nuestros cultivos especializados.
            </p>
            <p class="text-gray-700 dark:text-gray-300 leading-relaxed mb-4">
                Nuestras instalaciones principales se encuentran a 45 minutos de la ciudad de Puno, en la comunidad de Huancané, donde mantenemos más de 200 hectáreas de terrenos cultivables y zonas de pastoreo para nuestro ganado.
            </p>
            <div class="text-gray-700 dark:text-gray-300 mt-6">
                <h3 class="text-xl font-semibold mb-2">Visítanos</h3>
                <p>Comunidad de Huancané, Km 45 Carretera Puno-Juliaca</p>
                <p>+51 951 234 567</p>
                <p>contacto@riccharlyhuami.pe</p>
            </div>
        </section>


        <section class="max-w-6xl mx-auto py-12">
            <h2 class="text-3xl font-bold text-gray-800 dark:text-gray-200 mb-8 text-center">Nuestros Métodos de Producción</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-md flex items-start">
                    <div class="w-16 h-16 bg-gray-100 dark:bg-gray-700 rounded-full flex items-center justify-center text-[#8B805C] text-3xl mr-4 flex-shrink-0">
                        <i class="fas fa-tractor"></i>
                    </div>
                    <div>
                        <h3 class="text-xl font-semibold text-gray-800 dark:text-gray-200 mb-2">Agricultura Sostenible</h3>
                        <p class="text-gray-600 dark:text-gray-400 mb-4">Combinamos técnicas ancestrales andinas con innovaciones modernas para cultivar más de 15 variedades de papas nativas, quinua, cañihua y otros cultivos andinos.</p>
                        <ul class="list-none space-y-2 text-gray-700 dark:text-gray-300">
                            <li class="flex items-center"><i class="fas fa-check-circle text-[#8B805C] mr-2"></i> Rotación de cultivos para mantener la fertilidad del suelo</li>
                            <li class="flex items-center"><i class="fas fa-check-circle text-[#8B805C] mr-2"></i> Uso de abonos orgánicos producidos en nuestra propia granja</li>
                            <li class="flex items-center"><i class="fas fa-check-circle text-[#8B805C] mr-2"></i> Sistemas de riego por goteo que optimizan el uso del agua</li>
                            <li class="flex items-center"><i class="fas fa-check-circle text-[#8B805C] mr-2"></i> Control biológico de plagas sin uso de pesticidas químicos</li>
                        </ul>
                    </div>
                </div>

                <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-md flex items-start">
                    <div class="w-16 h-16 bg-gray-100 dark:bg-gray-700 rounded-full flex items-center justify-center text-[#8B805C] text-3xl mr-4 flex-shrink-0">
                        <i class="fas fa-horse-head"></i>
                    </div>
                    <div>
                        <h3 class="text-xl font-semibold text-gray-800 dark:text-gray-200 mb-2">Ganadería Responsable</h3>
                        <p class="text-gray-600 dark:text-gray-400 mb-4">Criamos alpacas, llamas y ganado vacuno adaptado a la altura, siguiendo prácticas que garantizan el bienestar animal y la calidad de nuestros productos.</p>
                        <ul class="list-none space-y-2 text-gray-700 dark:text-gray-300">
                            <li class="flex items-center"><i class="fas fa-check-circle text-[#8B805C] mr-2"></i> Pastoreo rotativo en praderas naturales de altura</li>
                            <li class="flex items-center"><i class="fas fa-check-circle text-[#8B805C] mr-2"></i> Alimentación complementaria con forrajes cultivados en nuestra granja</li>
                            <li class="flex items-center"><i class="fas fa-check-circle text-[#8B805C] mr-2"></i> Manejo sanitario preventivo con medicina tradicional andina</li>
                            <li class="flex items-center"><i class="fas fa-check-circle text-[#8B805C] mr-2"></i> Esquila responsable de alpacas y procesamiento artesanal de la fibra</li>
                        </ul>
                    </div>
                </div>
            </div>
        </section>

    </div>
</x-layouts.app>