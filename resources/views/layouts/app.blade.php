<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="description" content="Gerenciador de Contatos">

    <title>{{ config('app.name', 'Gerenciador de Contatos') }}</title>

    <!-- Scripts & Styles -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>
<body class="font-sans antialiased h-full">
    <div class="min-h-screen bg-gray-100 dark:bg-gray-900">
        @livewire('layout.navigation')
        
        <!-- Page Heading -->
        @if (isset($header))
            <header class="bg-white dark:bg-gray-800 shadow">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    {{ $header }}
                </div>
            </header>
        @endif

        <!-- Page Content -->
        <main class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <!-- Success Message -->
                @if(session('success'))
                    <div class="mb-4 rounded-md bg-green-50 dark:bg-green-900 p-4">
                        <div class="flex">
                            <div class="flex-shrink-0">
                                <svg class="h-5 w-5 text-green-400" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                                </svg>
                            </div>
                            <div class="ml-3">
                                <p class="text-sm font-medium text-green-800 dark:text-green-200">
                                    {{ session('success') }}
                                </p>
                            </div>
                        </div>
                    </div>
                @endif

                <!-- Livewire Notification -->
                <div 
                    x-data="{ show: false, message: '' }"
                    @notify.window="show = true; message = $event.detail; setTimeout(() => { show = false }, 3000)"
                    x-show="show"
                    x-transition
                    class="fixed bottom-4 right-4"
                >
                    <div class="bg-green-500 text-white px-6 py-3 rounded-lg shadow-lg">
                        <span x-text="message"></span>
                    </div>
                </div>

                {{ $slot }}
            </div>
        </main>
    </div>

    @livewireScripts
    <script>
        // Listener para eventos do Livewire
        Livewire.on('profile-updated', () => {
            window.dispatchEvent(new CustomEvent('notify', { 
                detail: 'Perfil atualizado com sucesso!' 
            }));
        });
    </script>
</body>
</html>