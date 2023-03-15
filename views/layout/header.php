<!DOCTYPE html>
<html class="h-full bg-gray-100">
<head>
    <meta charset="UTF-8">
    <title>Accueil</title>
    <link href="/css/main.css" rel="stylesheet">
</head>

<body class="h-full">
<div class="min-h-full">
    <nav class="bg-indigo-800">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="flex h-16 items-center justify-between">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <img class="h-8 w-8" src="https://tailwindui.com/img/logos/mark.svg?color=indigo&shade=500" alt="Your Company">
                    </div>
                    <div class="hidden md:block">
                        <div class="ml-10 flex items-baseline space-x-4">
                            <!-- Current: "bg-gray-900 text-white", Default: "text-gray-300 hover:bg-gray-700 hover:text-white" -->
                            <a href="#" class="bg-indigo-900 text-white rounded-md px-3 py-2 text-sm font-medium" aria-current="page">Accueil</a>

                            <a href="#" class="text-gray-300 hover:bg-indigo-700 hover:text-white rounded-md px-3 py-2 text-sm font-medium">Blogs posts</a>

                            <a href="#" class="text-gray-300 hover:bg-indigo-700 hover:text-white rounded-md px-3 py-2 text-sm font-medium">Utilisateurs</a>

                            <a href="#" class="text-gray-300 hover:bg-indigo-700 hover:text-white rounded-md px-3 py-2 text-sm font-medium">Commentaires à valider</a>

                            <a href="#" class="text-gray-300 hover:bg-indigo-700 hover:text-white rounded-md px-3 py-2 text-sm font-medium">Utilisateurs à valider</a>
                        </div>
                    </div>
                </div>
                <div class="md:block">
                    <div class="ml-4 flex items-center md:ml-6">
                        <button type="button" class="rounded-full bg-indigo-800 p-1 text-gray-400 hover:text-white focus:outline-none focus:ring-2 focus:ring-white focus:ring-offset-2 focus:ring-offset-indigo-800">
                            <span class="sr-only">Connexion</span>
                            <?php require __DIR__.'/../heroicons/power.svg' ?>
                        </button>
                    </div>
                </div>

                <div class="-mr-2 flex md:hidden">
                    <!-- Mobile menu button -->
                    <button type="button" class="inline-flex items-center justify-center rounded-md bg-indigo-800 p-2 text-gray-400 hover:bg-indigo-700 hover:text-white focus:outline-none focus:ring-2 focus:ring-white focus:ring-offset-2 focus:ring-offset-gray-800" aria-controls="mobile-menu" aria-expanded="false">
                        <span class="sr-only">Ouvrir le menu</span>
                        <!-- Menu open: "hidden", Menu closed: "block" -->
                        <svg class="block h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
                        </svg>
                        <!-- Menu open: "block", Menu closed: "hidden" -->
                        <svg class="hidden h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>

        <!-- Mobile menu, show/hide based on menu state. -->
        <div class="md:hidden" id="mobile-menu">
            <div class="space-y-1 px-2 pt-2 pb-3 sm:px-3">
                <!-- Current: "bg-gray-900 text-white", Default: "text-gray-300 hover:bg-gray-700 hover:text-white" -->
                <a href="#" class="bg-indigo-900 text-white block rounded-md px-3 py-2 text-base font-medium" aria-current="page">Accueil</a>

                <a href="#" class="text-gray-300 hover:bg-indigo-700 hover:text-white block rounded-md px-3 py-2 text-base font-medium">Blogs posts</a>

                <a href="#" class="text-gray-300 hover:bg-indigo-700 hover:text-white block rounded-md px-3 py-2 text-base font-medium">Utilisateurs</a>

                <a href="#" class="text-gray-300 hover:bg-indigo-700 hover:text-white block rounded-md px-3 py-2 text-base font-medium">Commentaires à valider</a>

                <a href="#" class="text-gray-300 hover:bg-indigo-700 hover:text-white block rounded-md px-3 py-2 text-base font-medium">Utilisateurs à valider</a>
            </div>
        </div>
    </nav>

    <header class="bg-white shadow">
        <div class="mx-auto max-w-7xl py-6 px-4 sm:px-6 lg:px-8">
            <h1 class="text-3xl font-bold tracking-tight text-gray-900">Accueil</h1>
        </div>
    </header>

    <main>
        <div class="mx-auto max-w-7xl py-6 sm:px-6 lg:px-8">