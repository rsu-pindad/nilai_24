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

  </head>

  <body>
    <div class="bg-gray-50 antialiased dark:bg-gray-900">

      <main class="mx-auto h-auto p-4 pt-20">
        {{ $slot }}
      </main>

    </div>

  </body>

</html>
