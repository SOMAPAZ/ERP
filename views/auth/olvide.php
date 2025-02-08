<main class="bg-gray-50 dark:bg-gray-900">
    <div class="flex flex-col items-center justify-center px-6 py-8 mx-auto md:h-screen lg:py-0">
        <a href="/" class="flex items-center mb-6 text-2xl font-semibold text-gray-900 dark:text-white">
            <picture>
                <source srcset="build/img/log-smpz.avif" type="image/avif">
                <source srcset="build/img/log-smpz.webp" type="image/webp">
                <img class="h-8 mr-2" src="build/img/log-smpz.avif" alt="logo">
            </picture>
            SOMAPAZ
        </a>
        <div class="w-full sm:max-w-md">
            <?php include_once __DIR__ . '/../templates/alertas.php'; ?>
        </div>
        <div class="w-full bg-white rounded-lg shadow dark:border md:mt-0 sm:max-w-md xl:p-0 dark:bg-gray-800 dark:border-gray-700">
            <div class="p-6 space-y-4 md:space-y-6 sm:p-8">
                <h1 class="text-xl font-bold text-center leading-tight tracking-tight text-gray-900 md:text-2xl dark:text-white">
                    Ingresa tu email
                </h1>
                <form class="space-y-4 md:space-y-6" action="/cambiar-password" method="POST" autocomplete="on">
                    <p class="text-sm font-medium text-gray-500 dark:text-gray-400">
                        Le enviaremos un email con las instrucciones para cambiar tu password.
                    </p>
                    <div>
                        <label for="mail" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Tu email</label>
                        <input type="email" name="mail" id="mail" class="bg-gray-50 border border-gray-300 text-gray-900 rounded-lg block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white" placeholder="name@company.com">
                    </div>
                    <div class="flex items-center justify-end">
                        <a href="/" class="text-sm font-medium text-indigo-600 hover:underline dark:text-indigo-500">Iniciar sesión</a>
                    </div>
                    <button type="submit" class="w-full text-white bg-indigo-600 hover:bg-indigo-700 focus:ring-4 focus:outline-none font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-indigo-600 dark:hover:bg-indigo-700">Enviar Correo</button>
                </form>
            </div>
        </div>
    </div>
</main>