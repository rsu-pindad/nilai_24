<x-guest>
  <section class="bg-gray-50 dark:bg-gray-900">
    <div class="mx-auto flex flex-col items-center justify-center px-6 py-8 md:h-screen lg:py-0">
      <a href="#"
         class="mb-6 flex items-center gap-2 text-2xl font-semibold text-gray-900 dark:text-white">
        <svg class="h-6 w-6 text-gray-800 dark:text-white"
             aria-hidden="true"
             xmlns="http://www.w3.org/2000/svg"
             width="24"
             height="24"
             fill="none"
             viewBox="0 0 24 24">
          <path stroke="currentColor"
                stroke-linecap="round"
                stroke-linejoin="round"
                stroke-width="2"
                d="M12 6.03v13m0-13c-2.819-.831-4.715-1.076-8.029-1.023A.99.99 0 0 0 3 6v11c0 .563.466 1.014 1.03 1.007 3.122-.043 5.018.212 7.97 1.023m0-13c2.819-.831 4.715-1.076 8.029-1.023A.99.99 0 0 1 21 6v11c0 .563-.466 1.014-1.03 1.007-3.122-.043-5.018.212-7.97 1.023" />
        </svg>
        Penilaian
      </a>
      <div
           class="w-full rounded-lg bg-white shadow dark:border dark:border-gray-700 dark:bg-gray-800 sm:max-w-md md:mt-0 xl:p-0">
        <div class="space-y-4 p-6 sm:p-8 md:space-y-6">
          <h1 class="text-xl font-bold leading-tight tracking-tight text-gray-900 dark:text-white md:text-2xl">
            Masuk
          </h1>
          <form class="space-y-4 md:space-y-6"
                action="{{ route('login-authenticate') }}"
                method="POST">
            @csrf
            <div>
              <label for="npp"
                     class="mb-2 block text-sm font-medium text-gray-900 dark:text-white">Masukan NPP</label>
              <input id="npp"
                     type="text"
                     name="npp"
                     class="block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-gray-900 focus:border-primary-600 focus:ring-primary-600 dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:placeholder-gray-400 dark:focus:border-blue-500 dark:focus:ring-blue-500"
                     placeholder="12345"
                     value="{{ old('npp') }}">
              @error('npp')
                <div class="mb-4 rounded-lg bg-yellow-50 p-4 text-sm text-yellow-800 dark:bg-gray-800 dark:text-yellow-300"
                     role="alert">
                  <span class="font-medium">{{ $message }}</span>
                </div>
              @enderror
            </div>
            <div>
              <label for="password"
                     class="mb-2 block text-sm font-medium text-gray-900 dark:text-white">Password</label>
              <input id="password"
                     type="password"
                     name="password"
                     placeholder="••••••••"
                     class="block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-gray-900 focus:border-primary-600 focus:ring-primary-600 dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:placeholder-gray-400 dark:focus:border-blue-500 dark:focus:ring-blue-500">
              @error('password')
                <div class="mb-4 rounded-lg bg-yellow-50 p-4 text-sm text-yellow-800 dark:bg-gray-800 dark:text-yellow-300"
                     role="alert">
                  <span class="font-medium">{{ $message }}</span>
                </div>
              @enderror
            </div>
            @error('auth')
              <div class="mb-4 rounded-lg bg-red-50 p-4 text-sm text-red-800 dark:bg-gray-800 dark:text-red-400"
                   role="alert">
                <span class="font-medium">{{ $message }}</span>
              </div>
            @enderror
            <div class="flex items-center justify-between">
              <div class="flex items-start">
                <div class="flex h-5 items-center">
                  <input id="remember"
                         aria-describedby="remember"
                         type="checkbox"
                         class="focus:ring-3 h-4 w-4 rounded border border-gray-300 bg-gray-50 focus:ring-primary-300 dark:border-gray-600 dark:bg-gray-700 dark:ring-offset-gray-800 dark:focus:ring-primary-600">
                </div>
                <div class="ml-3 text-sm">
                  <label for="remember"
                         class="text-gray-500 dark:text-gray-300">Ingat Saya</label>
                </div>
              </div>
              <a href="{{ route('forgot') }}"
                 class="text-sm font-medium text-primary-600 hover:underline dark:text-primary-500">
                Lupa Password?
              </a>
            </div>
            <button type="submit"
                    class="w-full rounded-lg bg-primary-600 px-5 py-2.5 text-center text-sm font-medium text-white hover:bg-primary-700 focus:outline-none focus:ring-4 focus:ring-primary-300 dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">
              Masuk
            </button>
            <p class="text-sm font-light text-gray-500 dark:text-gray-400">
              Belum punya akun? <a href="{{ route('register') }}"
                 class="font-medium text-primary-600 hover:underline dark:text-primary-500">Daftar</a>
            </p>
          </form>
        </div>
      </div>
    </div>
  </section>
</x-guest>
