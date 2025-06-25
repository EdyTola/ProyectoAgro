<x-layouts.app :title="__('Contactos')">
    <div class="p-6 bg-[#FDFDFC] dark:bg-[#0a0a0a] min-h-screen">
        <h1 class="text-4xl font-bold text-gray-800 dark:text-gray-200 mb-8 text-center">Contáctenos</h1>
        <p class="text-center text-gray-600 dark:text-gray-400 mb-10">Estamos aquí para atender sus consultas y brindarle la mejor atención. No dude en comunicarse con nosotros a través de cualquiera de los siguientes medios.</p>

        <div class="max-w-6xl mx-auto grid grid-cols-1 md:grid-cols-2 gap-8 mb-12">
            <div>
                <h2 class="text-2xl font-semibold text-gray-800 dark:text-gray-200 mb-4">Envíenos un mensaje</h2>
                {{-- Aquí va tu formulario de contacto existente --}}
                <form action="#" method="POST" class="space-y-4">
                    @csrf
                    <div>
                        <label for="full_name" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Nombre completo</label>
                        <input type="text" name="full_name" id="full_name" placeholder="Ingrese su nombre completo" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-[#8B805C] focus:border-[#8B805C] dark:bg-gray-700 dark:text-gray-200 dark:border-gray-600">
                    </div>
                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Correo electrónico</label>
                        <input type="email" name="email" id="email" placeholder="ejemplo@correo.com" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-[#8B805C] focus:border-[#8B805C] dark:bg-gray-700 dark:text-gray-200 dark:border-gray-600">
                    </div>
                    <div>
                        <label for="phone" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Teléfono</label>
                        <input type="tel" name="phone" id="phone" placeholder="+51 999 888 777" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-[#8B805C] focus:border-[#8B805C] dark:bg-gray-700 dark:text-gray-200 dark:border-gray-600">
                    </div>
                    <div>
                        <label for="subject" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Asunto</label>
                        <select name="subject" id="subject" class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-[#8B805C] focus:border-[#8B805C] sm:text-sm rounded-md dark:bg-gray-700 dark:text-gray-200 dark:border-gray-600">
                            <option>Seleccione un asunto</option>
                            <option>Consulta de producto</option>
                            <option>Soporte técnico</option>
                            <option>Reclamo/Devolución</option>
                            <option>Otros</option>
                        </select>
                    </div>
                    <div>
                        <label for="message" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Mensaje</label>
                        <textarea name="message" id="message" rows="4" placeholder="Escriba su mensaje aquí..." class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-[#8B805C] focus:border-[#8B805C] dark:bg-gray-700 dark:text-gray-200 dark:border-gray-600"></textarea>
                    </div>
                    <div class="flex items-center">
                        <input type="checkbox" name="privacy" id="privacy" class="h-4 w-4 text-[#8B805C] border-gray-300 rounded focus:ring-[#8B805C] dark:bg-gray-700 dark:border-gray-600">
                        <label for="privacy" class="ml-2 block text-sm text-gray-900 dark:text-gray-300">Acepto los términos y condiciones de privacidad</label>
                    </div>
                    <button type="submit" class="w-full px-4 py-2 bg-[#8B805C] text-white rounded-md hover:bg-[#7a704e] transition duration-300">Enviar mensaje</button>
                </form>
            </div>

            <div>
                <h2 class="text-2xl font-semibold text-gray-800 dark:text-gray-200 mb-4">Información de contacto</h2>
                <ul class="space-y-4 text-gray-600 dark:text-gray-400 text-sm">
                    <li class="flex items-start">
                        <i class="fas fa-map-marker-alt mr-3 text-lg text-[#8B805C]"></i>
                        <span>Av. Los Agricultores 1234, San Martín de Porres, Lima, Perú</span>
                    </li>
                    <li class="flex items-start">
                        <i class="fas fa-phone-alt mr-3 text-lg text-[#8B805C]"></i>
                        <span>
                            +51 1 555-7890 <br>
                            +51 999 123 456 (Ventas)
                        </span>
                    </li>
                    <li class="flex items-start">
                        <i class="fas fa-envelope mr-3 text-lg text-[#8B805C]"></i>
                        <span>
                            contacto@riccharlyhuami.com <br>
                            ventas@riccharlyhuami.com
                        </span>
                    </li>
                    <li class="flex items-start">
                        <i class="fas fa-clock mr-3 text-lg text-[#8B805C]"></i>
                        <span>
                            Horario de atención <br>
                            Lunes a Viernes: 8:00 AM - 6:00 PM <br>
                            Sábados: 9:00 AM - 1:00 PM
                        </span>
                    </li>
                </ul>
                {{-- Aquí iría el mapa de ubicación si lo tuvieras --}}
                <h2 class="text-2xl font-semibold text-gray-800 dark:text-gray-200 mt-8 mb-4">Nuestra ubicación</h2>
                <div class="bg-gray-200 dark:bg-gray-700 h-64 rounded-md overflow-hidden">
                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3901.8155577665427!2d-77.0505193851878!3d-12.057398991321045!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x9105c8d0d4e3e3b3%3A0x7d6f5f9e8e3c4e0!2sAv.%20Los%20Agricultores%201234%2C%20San%20Martin%20de%20Porres%2015102%2C%20Peru!5e0!3m2!1sen!2sus!4v1678901234567!5m2!1sen!2sus" width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                </div>
            </div>
        </div>

        <section class="max-w-4xl mx-auto mb-12">
            <h2 class="text-3xl font-bold text-gray-800 dark:text-gray-200 mb-8 text-center">Preguntas frecuentes</h2>
            <div class="space-y-6">
                <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-md">
                    <h3 class="text-xl font-semibold text-gray-800 dark:text-gray-200 mb-2">¿Cuáles son los métodos de pago aceptados?</h3>
                    <p class="text-gray-600 dark:text-gray-400">Aceptamos pagos con tarjetas de crédito/débito (Visa, Mastercard, American Express), transferencias bancarias, Yape, Plin y pagos en efectivo para compras en tienda.</p>
                </div>
                <div class="border-b border-gray-200 dark:border-gray-700 my-4"></div> <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-md">
                    <h3 class="text-xl font-semibold text-gray-800 dark:text-gray-200 mb-2">¿Realizan envíos a provincias?</h3>
                    <p class="text-gray-600 dark:text-gray-400">Sí, realizamos envíos a todo el Perú. Los costos y tiempos de entrega varían según la ubicación. Para más detalles, puede consultar nuestra política de envíos o contactarnos directamente.</p>
                </div>
                <div class="border-b border-gray-200 dark:border-gray-700 my-4"></div>

                <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-md">
                    <h3 class="text-xl font-semibold text-gray-800 dark:text-gray-200 mb-2">¿Ofrecen asesoramiento técnico para los productos?</h3>
                    <p class="text-gray-600 dark:text-gray-400">Sí, contamos con un equipo de especialistas en agricultura y ganadería que pueden brindarle asesoramiento técnico sobre el uso adecuado de nuestros productos. Puede solicitar este servicio por teléfono o correo electrónico.</p>
                </div>
                <div class="border-b border-gray-200 dark:border-gray-700 my-4"></div>

                <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-md">
                    <h3 class="text-xl font-semibold text-gray-800 dark:text-gray-200 mb-2">¿Tienen programas de capacitación para agricultores?</h3>
                    <p class="text-gray-600 dark:text-gray-400">Sí, regularmente organizamos talleres y capacitaciones para agricultores y ganaderos. Puede inscribirse a través de nuestra página web o contactándonos directamente para conocer las próximas fechas.</p>
                </div>
                <div class="border-b border-gray-200 dark:border-gray-700 my-4"></div>

                <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-md">
                    <h3 class="text-xl font-semibold text-gray-800 dark:text-gray-200 mb-2">¿Cómo puedo hacer un reclamo o devolución?</h3>
                    <p class="text-gray-600 dark:text-gray-400">Para realizar un reclamo o solicitar una devolución, debe comunicarse con nuestro servicio de atención al cliente dentro de los 7 días posteriores a la recepción del producto. Puede hacerlo a través del formulario de contacto, por teléfono o correo electrónico.</p>
                </div>
            </div>
        </section>

        <section class="max-w-2xl mx-auto text-center py-12">
            <h2 class="text-3xl font-bold text-gray-800 dark:text-gray-200 mb-8">Síguenos en redes sociales</h2>
            <div class="flex justify-center space-x-6">
                <a href="#" class="w-16 h-16 bg-gray-100 dark:bg-gray-700 rounded-full flex items-center justify-center text-[#8B805C] hover:bg-[#8B805C] hover:text-white transition duration-300 text-3xl">
                    <i class="fab fa-facebook-f"></i>
                </a>
                <a href="#" class="w-16 h-16 bg-gray-100 dark:bg-gray-700 rounded-full flex items-center justify-center text-[#8B805C] hover:bg-[#8B805C] hover:text-white transition duration-300 text-3xl">
                    <i class="fab fa-instagram"></i>
                </a>
                <a href="#" class="w-16 h-16 bg-gray-100 dark:bg-gray-700 rounded-full flex items-center justify-center text-[#8B805C] hover:bg-[#8B805C] hover:text-white transition duration-300 text-3xl">
                    <i class="fab fa-twitter"></i>
                </a>
                <a href="#" class="w-16 h-16 bg-gray-100 dark:bg-gray-700 rounded-full flex items-center justify-center text-[#8B805C] hover:bg-[#8B805C] hover:text-white transition duration-300 text-3xl">
                    <i class="fab fa-youtube"></i>
                </a>
                <a href="#" class="w-16 h-16 bg-gray-100 dark:bg-gray-700 rounded-full flex items-center justify-center text-[#8B805C] hover:bg-[#8B805C] hover:text-white transition duration-300 text-3xl">
                    <i class="fab fa-whatsapp"></i>
                </a>
            </div>
        </section>

        <section class="max-w-4xl mx-auto text-center py-12 px-6 bg-white dark:bg-gray-800 rounded-lg shadow-lg">
            <h2 class="text-3xl font-bold text-gray-800 dark:text-gray-200 mb-4">¿Necesitas ayuda con tu compra?</h2>
            <p class="text-gray-600 dark:text-gray-400 mb-8">Nuestros asesores están disponibles para ayudarte a elegir los productos adecuados para tu negocio agrícola.</p>
            <div class="flex flex-col sm:flex-row justify-center space-y-4 sm:space-y-0 sm:space-x-4">
                <a href="tel:+51999123456" class="px-8 py-3 bg-[#8B805C] text-white rounded-md hover:bg-[#7a704e] transition duration-300 text-lg font-semibold">
                    Llamar a un asesor
                </a>
                <a href="{{ route('contactos') }}" class="px-8 py-3 border border-[#8B805C] text-[#8B805C] rounded-md hover:bg-[#f3f2f0] dark:hover:bg-gray-700 transition duration-300 text-lg font-semibold">
                    Enviar mensaje
                </a>
            </div>
        </section>

    </div>
</x-layouts.app>