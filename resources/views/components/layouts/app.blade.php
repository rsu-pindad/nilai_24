<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

  <head>
    <meta charset="utf-8">
    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>{{ $title ?? 'Page Title' }}</title>
    @livewireStyles
    <link rel="stylesheet"
          href="https://rsms.me/inter/inter.css">
    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
          href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <wireui:scripts />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    {{ $styles ?? '' }}

  </head>

  <body>
    <div class="bg-gray-50 antialiased dark:bg-gray-900">

      <x-nav />

      <!-- Sidebar -->
      <x-aside />

      <main class="h-auto p-4 pt-20 md:ml-64">
        {{-- <x-wireui-notifications /> --}}
        <livewire:notifikasi.notifikasi-default />
        {{ $slot }}
      </main>

    </div>
  </body>

</html>
