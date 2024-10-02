<!DOCTYPE html>
<html lang="en">

  <head>
    <meta charset="utf-8">
    <meta name="viewport"
          content="width=device-width, initial-scale=1">
    <title>PT PINDAD MEDIKA UTAMA | {{ $title ?? 'RSU PINDAD' }}</title>
    <link rel="stylesheet"
          href="https://rsms.me/inter/inter.css">
    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
          href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    {{ $styles ?? '' }}

  </head>

  <body>
    <div class="bg-gray-50 antialiased dark:bg-gray-900">

      <x-nav />

      <!-- Sidebar -->
      <x-aside />

      <main class="h-auto p-4 pt-20 md:ml-64">
        {{ $slot }}
        <div class="mb-4 grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-4">
          <div class="h-32 rounded-lg border-2 border-dashed border-gray-300 dark:border-gray-600 md:h-64"></div>
          <div class="h-32 rounded-lg border-2 border-dashed border-gray-300 dark:border-gray-600 md:h-64"></div>
          <div class="h-32 rounded-lg border-2 border-dashed border-gray-300 dark:border-gray-600 md:h-64"></div>
          <div class="h-32 rounded-lg border-2 border-dashed border-gray-300 dark:border-gray-600 md:h-64"></div>
        </div>
        <div class="mb-4 h-96 rounded-lg border-2 border-dashed border-gray-300 dark:border-gray-600"></div>
        <div class="mb-4 grid grid-cols-2 gap-4">
          <div class="h-48 rounded-lg border-2 border-dashed border-gray-300 dark:border-gray-600 md:h-72"></div>
          <div class="h-48 rounded-lg border-2 border-dashed border-gray-300 dark:border-gray-600 md:h-72"></div>
          <div class="h-48 rounded-lg border-2 border-dashed border-gray-300 dark:border-gray-600 md:h-72"></div>
          <div class="h-48 rounded-lg border-2 border-dashed border-gray-300 dark:border-gray-600 md:h-72"></div>
        </div>
      </main>

    </div>
    {{ $scripts ?? '' }}
    {{ $modals ?? '' }}
  </body>

</html>
