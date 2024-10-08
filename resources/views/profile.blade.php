<x-layout>
  <div class="mb-4 h-auto rounded-lg border-2 border-dashed border-gray-300 dark:border-gray-600">
    <div class="mx-4 py-8">
      <div class="mb-4 grid gap-4 sm:grid-cols-2 sm:gap-8 lg:gap-16">
        <div class="space-y-4">
          @if (session('status_photo'))
            <div id="alert-photo"
                 class="mb-4 flex items-center rounded-lg bg-green-50 p-4 text-green-800 dark:bg-gray-800 dark:text-green-400"
                 role="alert">
              <svg class="h-4 w-4 flex-shrink-0"
                   aria-hidden="true"
                   xmlns="http://www.w3.org/2000/svg"
                   fill="currentColor"
                   viewBox="0 0 20 20">
                <path
                      d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z" />
              </svg>
              <span class="sr-only">Info</span>
              <div class="ms-3 text-sm font-medium">
                {{ session('status_photo') }}
              </div>
              <button type="button"
                      class="-mx-1.5 -my-1.5 ms-auto inline-flex h-8 w-8 items-center justify-center rounded-lg bg-green-50 p-1.5 text-green-500 hover:bg-green-200 focus:ring-2 focus:ring-green-400 dark:bg-gray-800 dark:text-green-400 dark:hover:bg-gray-700"
                      data-dismiss-target="#alert-photo"
                      aria-label="Close">
                <span class="sr-only">Close</span>
                <svg class="h-3 w-3"
                     aria-hidden="true"
                     xmlns="http://www.w3.org/2000/svg"
                     fill="none"
                     viewBox="0 0 14 14">
                  <path stroke="currentColor"
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2"
                        d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                </svg>
              </button>
            </div>
          @endif
          <div class="flex space-x-4">
            <span class="group relative block">
              <img class="h-32 w-32 rounded-lg group-hover:opacity-50"
                   src="{{ asset('storage/photo/' . Auth::user()->foto ?? 'default.png') }}"
                   alt="user-avatar" />
              <div
                   class="translate-y-8 transform py-2 opacity-0 transition-all group-hover:translate-y-0 group-hover:opacity-100">
                <div>
                  <button type="button"
                          data-modal-target="change-photo-modal"
                          data-modal-toggle="change-photo-modal"
                          class="w-full rounded-lg bg-lime-700 px-5 py-2.5 text-center text-lg font-medium text-white hover:bg-lime-800 focus:outline-none focus:ring-4 focus:ring-lime-300 dark:bg-lime-600 dark:hover:bg-lime-700 dark:focus:ring-lime-800 sm:w-auto">
                    Ubah Foto
                  </button>
                </div>
              </div>
            </span>
            <div>
              <span
                    class="mb-2 inline-block rounded bg-primary-100 px-2.5 py-0.5 text-xs font-medium text-primary-800 dark:bg-primary-900 dark:text-primary-300">
                {{ Auth::user()->jabatan }}
              </span>
              <h2
                  class="flex items-center text-xl font-bold uppercase leading-none text-gray-900 dark:text-white sm:text-2xl">
                {{ Auth::user()->nama }}
              </h2>
            </div>
          </div>
          <dl>
            <dt class="font-semibold text-gray-900 dark:text-white">Alamat Email</dt>
            <dd class="text-gray-500 dark:text-gray-400">{{ Auth::user()->email }}</dd>
          </dl>
          <dl>
            <dt class="font-semibold text-gray-900 dark:text-white">No Handphone</dt>
            <dd class="flex items-center gap-1 text-gray-500 dark:text-gray-400">
              <svg class="hidden h-5 w-5 shrink-0 text-gray-400 dark:text-gray-500 lg:inline"
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
                      d="m4 12 8-8 8 8M6 10.5V19a1 1 0 0 0 1 1h3v-3a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v3h3a1 1 0 0 0 1-1v-8.5" />
              </svg>
              {{ Auth::user()->no_hp }}
            </dd>
          </dl>
        </div>
        <div class="space-y-4">
          <dl>
            <dt class="font-semibold text-gray-900 dark:text-white">NPP</dt>
            <dd class="text-gray-500 dark:text-gray-400">{{ Auth::user()->npp }}</dd>
          </dl>
          <dl>
            <dt class="font-semibold text-gray-900 dark:text-white">Level</dt>
            <dd class="text-gray-500 dark:text-gray-400">{{ Auth::user()->level }}</dd>
          </dl>
          <dl>
            <dt class="font-semibold text-gray-900 dark:text-white">Penempatan</dt>
            <dd class="flex items-center gap-1 text-gray-500 dark:text-gray-400">
              <svg class="hidden h-5 w-5 shrink-0 text-gray-400 dark:text-gray-500 lg:inline"
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
                      d="M6 12c.263 0 .524-.06.767-.175a2 2 0 0 0 .65-.491c.186-.21.333-.46.433-.734.1-.274.15-.568.15-.864a2.4 2.4 0 0 0 .586 1.591c.375.422.884.659 1.414.659.53 0 1.04-.237 1.414-.659A2.4 2.4 0 0 0 12 9.736a2.4 2.4 0 0 0 .586 1.591c.375.422.884.659 1.414.659.53 0 1.04-.237 1.414-.659A2.4 2.4 0 0 0 16 9.736c0 .295.052.588.152.861s.248.521.434.73a2 2 0 0 0 .649.488 1.809 1.809 0 0 0 1.53 0 2.03 2.03 0 0 0 .65-.488c.185-.209.332-.457.433-.73.1-.273.152-.566.152-.861 0-.974-1.108-3.85-1.618-5.121A.983.983 0 0 0 17.466 4H6.456a.986.986 0 0 0-.93.645C5.045 5.962 4 8.905 4 9.736c.023.59.241 1.148.611 1.567.37.418.865.667 1.389.697Zm0 0c.328 0 .651-.091.94-.266A2.1 2.1 0 0 0 7.66 11h.681a2.1 2.1 0 0 0 .718.734c.29.175.613.266.942.266.328 0 .651-.091.94-.266.29-.174.537-.427.719-.734h.681a2.1 2.1 0 0 0 .719.734c.289.175.612.266.94.266.329 0 .652-.091.942-.266.29-.174.536-.427.718-.734h.681c.183.307.43.56.719.734.29.174.613.266.941.266a1.819 1.819 0 0 0 1.06-.351M6 12a1.766 1.766 0 0 1-1.163-.476M5 12v7a1 1 0 0 0 1 1h2v-5h3v5h7a1 1 0 0 0 1-1v-7m-5 3v2h2v-2h-2Z" />
              </svg>
              {{ Auth::user()->penempatan }}
            </dd>
          </dl>
        </div>
      </div>
    </div>
  </div>
  <div class="mb-4 grid grid-cols-1 gap-4 sm:grid-cols-1 md:grid-cols-2">
    <div class="h-auto rounded-lg border-2 border-dashed border-gray-300 dark:border-gray-600 md:h-auto">
      <p class="my-3 text-center text-lg text-gray-500 dark:text-gray-400">
        Edit Profile
      </p>

      @if (session('status'))
        <div id="alert-3"
             class="mx-4 mb-4 flex items-center rounded-lg bg-green-50 p-4 text-green-800 dark:bg-gray-800 dark:text-green-400"
             role="alert">
          <svg class="h-4 w-4 flex-shrink-0"
               aria-hidden="true"
               xmlns="http://www.w3.org/2000/svg"
               fill="currentColor"
               viewBox="0 0 20 20">
            <path
                  d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z" />
          </svg>
          <span class="sr-only">Info</span>
          <div class="ms-3 text-sm font-medium">
            {{ session('status') }}
          </div>
          <button type="button"
                  class="-mx-1.5 -my-1.5 ms-auto inline-flex h-8 w-8 items-center justify-center rounded-lg bg-green-50 p-1.5 text-green-500 hover:bg-green-200 focus:ring-2 focus:ring-green-400 dark:bg-gray-800 dark:text-green-400 dark:hover:bg-gray-700"
                  data-dismiss-target="#alert-3"
                  aria-label="Close">
            <span class="sr-only">Close</span>
            <svg class="h-3 w-3"
                 aria-hidden="true"
                 xmlns="http://www.w3.org/2000/svg"
                 fill="none"
                 viewBox="0 0 14 14">
              <path stroke="currentColor"
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    stroke-width="2"
                    d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
            </svg>
          </button>
        </div>
      @endif

      <form class="mx-auto my-6 max-w-md p-4"
            action="{{ route('profile-update', Auth::user()) }}"
            method="POST">
        @csrf
        @method('PATCH')
        <div class="group relative z-0 mb-5 w-full">
          <input id="floating_nama"
                 type="text"
                 name="nama"
                 placeholder=" "
                 class="peer block w-full appearance-none border-0 border-b-2 border-gray-300 bg-transparent px-0 py-2.5 text-lg text-gray-900 focus:border-lime-600 focus:outline-none focus:ring-0 dark:border-gray-600 dark:text-white dark:focus:border-lime-50"
                 value="{{ Auth::user()->nama }}" />
          <label for="floating_nama"
                 class="absolute top-3 -z-10 origin-[0] -translate-y-6 scale-75 transform text-lg text-gray-500 duration-300 peer-placeholder-shown:translate-y-0 peer-placeholder-shown:scale-100 peer-focus:start-0 peer-focus:-translate-y-6 peer-focus:scale-75 peer-focus:font-medium peer-focus:text-lime-600 rtl:peer-focus:left-auto rtl:peer-focus:translate-x-1/4 dark:text-gray-400 peer-focus:dark:text-lime-50">
            Nama <sup>*</sup>
          </label>
          @error('nama')
            <p class="text-md mt-2 text-red-600 dark:text-red-500">
              {{ $message }}
            </p>
          @enderror
        </div>
        <div class="group relative z-0 mb-5 w-full">
          <input id="floating_email"
                 type="email"
                 name="email"
                 placeholder=" "
                 class="peer block w-full appearance-none border-0 border-b-2 border-gray-300 bg-transparent px-0 py-2.5 text-lg text-gray-900 focus:border-lime-600 focus:outline-none focus:ring-0 dark:border-gray-600 dark:text-white dark:focus:border-lime-50"
                 value="{{ old('email') ? old('email') : Auth::user()->email }}" />
          <label for="floating_email"
                 class="absolute top-3 -z-10 origin-[0] -translate-y-6 scale-75 transform text-lg text-gray-500 duration-300 peer-placeholder-shown:translate-y-0 peer-placeholder-shown:scale-100 peer-focus:start-0 peer-focus:-translate-y-6 peer-focus:scale-75 peer-focus:font-medium peer-focus:text-lime-600 rtl:peer-focus:left-auto rtl:peer-focus:translate-x-1/4 dark:text-gray-400 peer-focus:dark:text-lime-50">
            Alamat Email <sup>*</sup>
          </label>
          @error('email')
            <p class="text-md mt-2 text-red-600 dark:text-red-500">
              {{ $message }}
            </p>
          @enderror
        </div>
        <div class="group relative z-0 mb-5 w-full">
          <input id="floating_no_hp"
                 type="tel"
                 name="no_hp"
                 placeholder=" "
                 class="peer block w-full appearance-none border-0 border-b-2 border-gray-300 bg-transparent px-0 py-2.5 text-lg text-gray-900 focus:border-lime-600 focus:outline-none focus:ring-0 dark:border-gray-600 dark:text-white dark:focus:border-lime-50"
                 value="{{ old('no_hp') ? old('no_hp') : Auth::user()->no_hp }}" />
          <label for="floating_no_hp"
                 class="absolute top-3 -z-10 origin-[0] -translate-y-6 scale-75 transform text-lg text-gray-500 duration-300 peer-placeholder-shown:translate-y-0 peer-placeholder-shown:scale-100 peer-focus:start-0 peer-focus:-translate-y-6 peer-focus:scale-75 peer-focus:font-medium peer-focus:text-lime-600 rtl:peer-focus:left-auto rtl:peer-focus:translate-x-1/4 dark:text-gray-400 peer-focus:dark:text-lime-50">
            No Handphone <sup>*</sup>
          </label>
          @error('no_hp')
            <p class="text-md mt-2 text-red-600 dark:text-red-500">
              {{ $message }}
            </p>
          @enderror
        </div>
        <div class="grid md:grid-cols-2 md:gap-6">
          <div class="group relative z-0 mb-5 w-full">
            <input id="floating_level"
                   type="text"
                   name="level"
                   class="peer block w-full appearance-none border-0 border-b-2 border-gray-300 bg-transparent px-0 py-2.5 text-lg text-gray-900 hover:cursor-not-allowed focus:border-lime-600 focus:outline-none focus:ring-0 dark:border-gray-600 dark:text-white dark:focus:border-lime-50"
                   placeholder=" "
                   value="{{ Auth::user()->level }}"
                   readonly />
            <label for="floating_level"
                   class="absolute top-3 -z-10 origin-[0] -translate-y-6 scale-75 transform text-lg text-gray-500 duration-300 peer-placeholder-shown:translate-y-0 peer-placeholder-shown:scale-100 peer-focus:start-0 peer-focus:-translate-y-6 peer-focus:scale-75 peer-focus:font-medium peer-focus:text-lime-600 rtl:peer-focus:translate-x-1/4 dark:text-gray-400 peer-focus:dark:text-lime-50">
              Level
            </label>
          </div>
          <div class="group relative z-0 mb-5 w-full">
            <input id="floating_jabatan"
                   type="text"
                   name="jabatan"
                   class="peer block w-full appearance-none border-0 border-b-2 border-gray-300 bg-transparent px-0 py-2.5 text-lg text-gray-900 hover:cursor-not-allowed focus:border-lime-600 focus:outline-none focus:ring-0 dark:border-gray-600 dark:text-white dark:focus:border-lime-50"
                   placeholder=" "
                   value="{{ Auth::user()->jabatan }}"
                   readonly />
            <label for="floating_jabatan"
                   class="absolute top-3 -z-10 origin-[0] -translate-y-6 scale-75 transform text-lg text-gray-500 duration-300 peer-placeholder-shown:translate-y-0 peer-placeholder-shown:scale-100 peer-focus:start-0 peer-focus:-translate-y-6 peer-focus:scale-75 peer-focus:font-medium peer-focus:text-lime-600 rtl:peer-focus:translate-x-1/4 dark:text-gray-400 peer-focus:dark:text-lime-50">
              Jabatan
            </label>
          </div>
        </div>
        <div class="group relative z-0 mb-5 w-full">
          <input id="floating_penempatan"
                 type="text"
                 name="penempatan"
                 class="peer block w-full appearance-none border-0 border-b-2 border-gray-300 bg-transparent px-0 py-2.5 text-lg text-gray-900 hover:cursor-not-allowed focus:border-lime-600 focus:outline-none focus:ring-0 dark:border-gray-600 dark:text-white dark:focus:border-lime-50"
                 value="{{ Auth::user()->penempatan }}"
                 readonly />
          <label for="floating_penempatan"
                 class="absolute top-3 -z-10 origin-[0] -translate-y-6 scale-75 transform text-lg text-gray-500 duration-300 peer-placeholder-shown:translate-y-0 peer-placeholder-shown:scale-100 peer-focus:start-0 peer-focus:-translate-y-6 peer-focus:scale-75 peer-focus:font-medium peer-focus:text-lime-600 rtl:peer-focus:left-auto rtl:peer-focus:translate-x-1/4 dark:text-gray-400 peer-focus:dark:text-lime-50">
            Penempatan
          </label>
        </div>
        <button type="submit"
                class="w-full rounded-lg bg-lime-700 px-5 py-2.5 text-center text-lg font-medium text-white hover:bg-lime-800 focus:outline-none focus:ring-4 focus:ring-lime-300 dark:bg-lime-600 dark:hover:bg-lime-700 dark:focus:ring-lime-800 sm:w-auto">
          Perbarui
        </button>
      </form>

    </div>
    <div class="h-auto rounded-lg border-2 border-dashed border-gray-300 dark:border-gray-600 md:h-auto">
      <p class="my-3 text-center text-lg text-gray-500 dark:text-gray-400">
        Edit Password
      </p>
      @if (session('status_pass'))
        <div id="alert-pass"
             class="mx-4 mb-4 flex items-center rounded-lg bg-green-50 p-4 text-green-800 dark:bg-gray-800 dark:text-green-400"
             role="alert">
          <svg class="h-4 w-4 flex-shrink-0"
               aria-hidden="true"
               xmlns="http://www.w3.org/2000/svg"
               fill="currentColor"
               viewBox="0 0 20 20">
            <path
                  d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z" />
          </svg>
          <span class="sr-only">Info</span>
          <div class="ms-3 text-sm font-medium">
            {{ session('status_pass') }}
          </div>
          <button type="button"
                  class="-mx-1.5 -my-1.5 ms-auto inline-flex h-8 w-8 items-center justify-center rounded-lg bg-green-50 p-1.5 text-green-500 hover:bg-green-200 focus:ring-2 focus:ring-green-400 dark:bg-gray-800 dark:text-green-400 dark:hover:bg-gray-700"
                  data-dismiss-target="#alert-pass"
                  aria-label="Close">
            <span class="sr-only">Close</span>
            <svg class="h-3 w-3"
                 aria-hidden="true"
                 xmlns="http://www.w3.org/2000/svg"
                 fill="none"
                 viewBox="0 0 14 14">
              <path stroke="currentColor"
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    stroke-width="2"
                    d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
            </svg>
          </button>
        </div>
      @endif
      @if (session('status_pass_fail'))
        <div id="alert-pass-fail"
             class="mx-4 mb-4 flex items-center rounded-lg bg-red-50 p-4 text-red-800 dark:bg-gray-800 dark:text-red-400"
             role="alert">
          <svg class="h-4 w-4 flex-shrink-0"
               aria-hidden="true"
               xmlns="http://www.w3.org/2000/svg"
               fill="currentColor"
               viewBox="0 0 20 20">
            <path
                  d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z" />
          </svg>
          <span class="sr-only">Info</span>
          <div class="ms-3 text-sm font-medium">
            {{ session('status_pass_fail') }}
          </div>
          <button type="button"
                  class="-mx-1.5 -my-1.5 ms-auto inline-flex h-8 w-8 items-center justify-center rounded-lg bg-red-50 p-1.5 text-red-500 hover:bg-red-200 focus:ring-2 focus:ring-red-400 dark:bg-gray-800 dark:text-red-400 dark:hover:bg-gray-700"
                  data-dismiss-target="#alert-pass-fail"
                  aria-label="Close">
            <span class="sr-only">Close</span>
            <svg class="h-3 w-3"
                 aria-hidden="true"
                 xmlns="http://www.w3.org/2000/svg"
                 fill="none"
                 viewBox="0 0 14 14">
              <path stroke="currentColor"
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    stroke-width="2"
                    d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
            </svg>
          </button>
        </div>
      @endif

      <form class="mx-auto my-6 max-w-md p-4"
            action="{{ route('profile-update-password', Auth::user()) }}"
            method="POST">
        @csrf
        @method('PATCH')
        <div class="group relative z-0 mb-5 w-full">
          <input id="floating_old_password"
                 type="password"
                 name="oldPassword"
                 placeholder=" "
                 class="peer block w-full appearance-none border-0 border-b-2 border-gray-300 bg-transparent px-0 py-2.5 text-lg text-gray-900 focus:border-lime-600 focus:outline-none focus:ring-0 dark:border-gray-600 dark:text-white dark:focus:border-lime-50" />
          <label for="floating_old_password"
                 class="absolute top-3 -z-10 origin-[0] -translate-y-6 scale-75 transform text-lg text-gray-500 duration-300 peer-placeholder-shown:translate-y-0 peer-placeholder-shown:scale-100 peer-focus:start-0 peer-focus:-translate-y-6 peer-focus:scale-75 peer-focus:font-medium peer-focus:text-lime-600 rtl:peer-focus:left-auto rtl:peer-focus:translate-x-1/4 dark:text-gray-400 peer-focus:dark:text-lime-50">
            Password sekarang <sup>*</sup>
          </label>
          @error('oldPassword')
            <p class="text-md mt-2 text-red-600 dark:text-red-500">
              {{ $message }}
            </p>
          @enderror
        </div>
        <div class="group relative z-0 mb-5 w-full">
          <input id="floating_password"
                 type="password"
                 name="password"
                 placeholder=" "
                 class="peer block w-full appearance-none border-0 border-b-2 border-gray-300 bg-transparent px-0 py-2.5 text-lg text-gray-900 focus:border-lime-600 focus:outline-none focus:ring-0 dark:border-gray-600 dark:text-white dark:focus:border-lime-50" />
          <label for="floating_password"
                 class="absolute top-3 -z-10 origin-[0] -translate-y-6 scale-75 transform text-lg text-gray-500 duration-300 peer-placeholder-shown:translate-y-0 peer-placeholder-shown:scale-100 peer-focus:start-0 peer-focus:-translate-y-6 peer-focus:scale-75 peer-focus:font-medium peer-focus:text-lime-600 rtl:peer-focus:left-auto rtl:peer-focus:translate-x-1/4 dark:text-gray-400 peer-focus:dark:text-lime-50">
            Password baru <sup>*</sup>
          </label>
          @error('passsword')
            <p class="text-md mt-2 text-red-600 dark:text-red-500">
              {{ $message }}
            </p>
          @enderror
        </div>
        <div class="group relative z-0 mb-5 w-full">
          <input id="floating_confirm_password"
                 type="password"
                 name="confirm_password"
                 placeholder=" "
                 class="peer block w-full appearance-none border-0 border-b-2 border-gray-300 bg-transparent px-0 py-2.5 text-lg text-gray-900 focus:border-lime-600 focus:outline-none focus:ring-0 dark:border-gray-600 dark:text-white dark:focus:border-lime-50" />
          <label for="floating_confirm_password"
                 class="absolute top-3 -z-10 origin-[0] -translate-y-6 scale-75 transform text-lg text-gray-500 duration-300 peer-placeholder-shown:translate-y-0 peer-placeholder-shown:scale-100 peer-focus:start-0 peer-focus:-translate-y-6 peer-focus:scale-75 peer-focus:font-medium peer-focus:text-lime-600 rtl:peer-focus:left-auto rtl:peer-focus:translate-x-1/4 dark:text-gray-400 peer-focus:dark:text-lime-50">
            Ulangi password baru <sup>*</sup>
          </label>
          @error('confirm_password')
            <p class="text-md mt-2 text-red-600 dark:text-red-500">
              {{ $message }}
            </p>
          @enderror
        </div>
        <button type="submit"
                class="w-full rounded-lg bg-lime-700 px-5 py-2.5 text-center text-lg font-medium text-white hover:bg-lime-800 focus:outline-none focus:ring-4 focus:ring-lime-300 dark:bg-lime-600 dark:hover:bg-lime-700 dark:focus:ring-lime-800 sm:w-auto">
          Perbarui
        </button>
      </form>

    </div>

  </div>

  <!-- Modal Photo -->
  <div id="change-photo-modal"
       tabindex="-1"
       aria-hidden="true"
       class="fixed left-0 right-0 top-0 z-50 hidden h-[calc(100%-1rem)] max-h-full w-full items-center justify-center overflow-y-auto overflow-x-hidden md:inset-0">
    <div class="relative max-h-full w-full max-w-md p-4">
      <!-- Modal content -->
      <div class="relative rounded-lg bg-white shadow dark:bg-gray-700">
        <!-- Modal header -->
        <div class="flex items-center justify-between rounded-t border-b p-4 dark:border-gray-600 md:p-5">
          <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
            Ubah Photo
          </h3>
          <button type="button"
                  class="end-2.5 ms-auto inline-flex h-8 w-8 items-center justify-center rounded-lg bg-transparent text-sm text-gray-400 hover:bg-gray-200 hover:text-gray-900 dark:hover:bg-gray-600 dark:hover:text-white"
                  data-modal-hide="change-photo-modal">
            <svg class="h-3 w-3"
                 aria-hidden="true"
                 xmlns="http://www.w3.org/2000/svg"
                 fill="none"
                 viewBox="0 0 14 14">
              <path stroke="currentColor"
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    stroke-width="2"
                    d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
            </svg>
            <span class="sr-only">Close modal</span>
          </button>
        </div>
        <!-- Modal body -->
        <div class="p-4 md:p-5">
          <form class="space-y-4"
                action="{{ route('profile-update-photo', Auth::user()) }}"
                method="POST"
                enctype="multipart/form-data">
            @csrf
            @method('PATCH')
            <div>
              <label class="mb-2 block text-sm font-medium text-gray-900 dark:text-white"
                     for="photo">
                Photo
              </label>
              <input id="photo"
                     class="block w-full cursor-pointer rounded-lg border border-gray-300 bg-gray-50 text-sm text-gray-900 focus:outline-none dark:border-gray-600 dark:bg-gray-700 dark:text-gray-400 dark:placeholder-gray-400"
                     type="file"
                     name="photo">
              <p id="photo"
                 class="mt-1 text-sm text-gray-500 dark:text-gray-300">PNG, JPG(MAX. 2MB).</p>
            </div>
            <button type="submit"
                    class="w-full rounded-lg bg-lime-700 px-5 py-2.5 text-center text-sm font-medium text-white hover:bg-lime-800 focus:outline-none focus:ring-4 focus:ring-lime-300 dark:bg-lime-600 dark:hover:bg-lime-700 dark:focus:ring-lime-800">
              Unggah
            </button>
          </form>
        </div>
      </div>
    </div>
  </div>
  <!-- End Modal Photo -->

</x-layout>
