<aside id="drawer-navigation"
       class="fixed left-0 top-0 z-40 h-screen w-64 -translate-x-full border-r border-gray-200 bg-white pt-14 transition-transform dark:border-gray-700 dark:bg-gray-800 md:translate-x-0"
       aria-label="Sidenav">
  <div class="h-full overflow-y-auto bg-white px-3 py-5 dark:bg-gray-800">
    <ul class="space-y-2">
      <li>
        <a href="#"
           class="group flex items-center rounded-lg p-2 text-base font-medium text-gray-900 hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700">
          <svg aria-hidden="true"
               class="h-6 w-6 text-gray-500 transition duration-75 group-hover:text-gray-900 dark:text-gray-400 dark:group-hover:text-white"
               fill="currentColor"
               viewBox="0 0 20 20"
               xmlns="http://www.w3.org/2000/svg">
            <path d="M2 10a8 8 0 018-8v8h8a8 8 0 11-16 0z"></path>
            <path d="M12 2.252A8.014 8.014 0 0117.748 8H12V2.252z"></path>
          </svg>
          <span class="ml-3">Beranda</span>
        </a>
      </li>
      <li>
        <button type="button"
                class="group flex w-full items-center rounded-lg p-2 text-base font-medium text-gray-900 transition duration-75 hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700"
                aria-controls="dropdown-interface-2024"
                data-collapse-toggle="dropdown-interface-2024">
          <svg aria-hidden="true"
               class="h-6 w-6 flex-shrink-0 text-gray-500 transition duration-75 group-hover:text-gray-900 dark:text-gray-400 dark:group-hover:text-white"
               fill="currentColor"
               viewBox="0 0 20 20"
               xmlns="http://www.w3.org/2000/svg">
            <path fill-rule="evenodd"
                  d="M4 4a2 2 0 012-2h4.586A2 2 0 0112 2.586L15.414 6A2 2 0 0116 7.414V16a2 2 0 01-2 2H6a2 2 0 01-2-2V4zm2 6a1 1 0 011-1h6a1 1 0 110 2H7a1 1 0 01-1-1zm1 3a1 1 0 100 2h6a1 1 0 100-2H7z"
                  clip-rule="evenodd"></path>
          </svg>
          <span class="ml-3 flex-1 whitespace-nowrap text-left">Interface 2024</span>
          <svg aria-hidden="true"
               class="h-6 w-6"
               fill="currentColor"
               viewBox="0 0 20 20"
               xmlns="http://www.w3.org/2000/svg">
            <path fill-rule="evenodd"
                  d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                  clip-rule="evenodd"></path>
          </svg>
        </button>
        <ul id="dropdown-interface-2024"
        class="@if (request()->routeIs(['atur-jadwal','skor'])) space-y-2 py-2 @else hidden space-y-2 py-2 @endif">
          <li>
            <a href="{{ route('atur-jadwal') }}"
               class="@if (Route::currentRouteName() === 'atur-jadwal') active bg-blue-200 @endif group flex w-full items-center rounded-lg p-2 pl-11 text-base font-medium text-gray-900 transition duration-75 hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700">
              <svg class="h-6 w-6 flex-shrink-0 text-gray-500 transition duration-75 group-hover:text-gray-900 dark:text-gray-400 dark:group-hover:text-white"
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
                      d="M4 10h16m-8-3V4M7 7V4m10 3V4M5 20h14a1 1 0 0 0 1-1V7a1 1 0 0 0-1-1H5a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1Zm3-7h.01v.01H8V13Zm4 0h.01v.01H12V13Zm4 0h.01v.01H16V13Zm-8 4h.01v.01H8V17Zm4 0h.01v.01H12V17Zm4 0h.01v.01H16V17Z" />
              </svg>

              <span class="ml-3 text-left">
                Jadwal
              </span>
            </a>
          </li>
          <li>
            <a href="{{ route('skor') }}"
               class="@if (Route::currentRouteName() === 'skor') active bg-blue-200 @endif group flex w-full items-center rounded-lg p-2 pl-11 text-base font-medium text-gray-900 transition duration-75 hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700">
              <svg class="h-[24px] w-[24px] text-gray-800 dark:text-white"
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
                      d="M5 19V4a1 1 0 0 1 1-1h12a1 1 0 0 1 1 1v13H7a2 2 0 0 0-2 2Zm0 0a2 2 0 0 0 2 2h12M9 3v14m7 0v4" />
              </svg>

              <span class="ml-3 text-left">
                Skor
              </span>
            </a>
          </li>
        </ul>
      </li>
      <li>
        <button type="button"
                class="group flex w-full items-center rounded-lg p-2 text-base font-medium text-gray-900 transition duration-75 hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700"
                aria-controls="dropdown-users"
                data-collapse-toggle="dropdown-users">
          <svg class="h-6 w-6 flex-shrink-0 text-gray-500 transition duration-75 group-hover:text-gray-900 dark:text-gray-400 dark:group-hover:text-white"
               aria-hidden="true"
               xmlns="http://www.w3.org/2000/svg"
               width="24"
               height="24"
               fill="none"
               viewBox="0 0 24 24">
            <path stroke="currentColor"
                  stroke-linecap="round"
                  stroke-width="2"
                  d="M4.5 17H4a1 1 0 0 1-1-1 3 3 0 0 1 3-3h1m0-3.05A2.5 2.5 0 1 1 9 5.5M19.5 17h.5a1 1 0 0 0 1-1 3 3 0 0 0-3-3h-1m0-3.05a2.5 2.5 0 1 0-2-4.45m.5 13.5h-7a1 1 0 0 1-1-1 3 3 0 0 1 3-3h3a3 3 0 0 1 3 3 1 1 0 0 1-1 1Zm-1-9.5a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0Z" />
          </svg>
          <span class="ml-3 flex-1 whitespace-nowrap text-left">Users</span>
          <svg aria-hidden="true"
               class="h-6 w-6"
               fill="currentColor"
               viewBox="0 0 20 20"
               xmlns="http://www.w3.org/2000/svg">
            <path fill-rule="evenodd"
                  d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                  clip-rule="evenodd"></path>
          </svg>
        </button>
        <ul id="dropdown-users"
        class="@if (request()->routeIs(['user-mgmt','relasi-karyawan'])) space-y-2 py-2 @else hidden space-y-2 py-2 @endif">
          <li>
            <a href="{{ route('user-mgmt') }}"
               class="@if (Route::currentRouteName() === 'user-mgmt') active bg-blue-200 @endif group flex w-full items-center rounded-lg p-2 pl-11 text-base font-medium text-gray-900 transition duration-75 hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700">
              <svg class="h-[24px] w-[24px] text-gray-800 dark:text-white"
                   aria-hidden="true"
                   xmlns="http://www.w3.org/2000/svg"
                   width="24"
                   height="24"
                   fill="none"
                   viewBox="0 0 24 24">
                <path stroke="currentColor"
                      stroke-linecap="round"
                      stroke-width="2"
                      d="M16 19h4a1 1 0 0 0 1-1v-1a3 3 0 0 0-3-3h-2m-2.236-4a3 3 0 1 0 0-4M3 18v-1a3 3 0 0 1 3-3h4a3 3 0 0 1 3 3v1a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1Zm8-10a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
              </svg>
              <span class="ml-3 text-left">
                User MGMT
              </span>
            </a>
          </li>
          <li>
            <a href="{{ route('relasi-karyawan') }}"
               class="@if (Route::currentRouteName() === 'relasi-karyawan') active bg-blue-200 @endif group flex w-full items-center rounded-lg p-2 pl-11 text-base font-medium text-gray-900 transition duration-75 hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700">
              <svg class="h-[24px] w-[24px] text-gray-800 dark:text-white"
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
                      d="m16 4 3 3H5v3m3 10-3-3h14v-3m-9-2.5 2-1.5v4" />
              </svg>

              <span class="ml-3 text-left">
                Relasi Karyawan
              </span>
            </a>
          </li>
        </ul>
      </li>
      <li>
        <button type="button"
                class="group flex w-full items-center rounded-lg p-2 text-base font-medium text-gray-900 transition duration-75 hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700"
                aria-controls="dropdown-google"
                data-collapse-toggle="dropdown-google">
          <svg class="h-6 w-6 flex-shrink-0 text-gray-500 transition duration-75 group-hover:text-gray-900 dark:text-gray-400 dark:group-hover:text-white"
               aria-hidden="true"
               xmlns="http://www.w3.org/2000/svg"
               width="24"
               height="24"
               fill="currentColor"
               viewBox="0 0 24 24">
            <path fill-rule="evenodd"
                  d="M12.037 21.998a10.313 10.313 0 0 1-7.168-3.049 9.888 9.888 0 0 1-2.868-7.118 9.947 9.947 0 0 1 3.064-6.949A10.37 10.37 0 0 1 12.212 2h.176a9.935 9.935 0 0 1 6.614 2.564L16.457 6.88a6.187 6.187 0 0 0-4.131-1.566 6.9 6.9 0 0 0-4.794 1.913 6.618 6.618 0 0 0-2.045 4.657 6.608 6.608 0 0 0 1.882 4.723 6.891 6.891 0 0 0 4.725 2.07h.143c1.41.072 2.8-.354 3.917-1.2a5.77 5.77 0 0 0 2.172-3.41l.043-.117H12.22v-3.41h9.678c.075.617.109 1.238.1 1.859-.099 5.741-4.017 9.6-9.746 9.6l-.215-.002Z"
                  clip-rule="evenodd" />
          </svg>
          <span class="ml-3 flex-1 whitespace-nowrap text-left">Google</span>
          <svg aria-hidden="true"
               class="h-6 w-6"
               fill="currentColor"
               viewBox="0 0 20 20"
               xmlns="http://www.w3.org/2000/svg">
            <path fill-rule="evenodd"
                  d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                  clip-rule="evenodd"></path>
          </svg>
        </button>
        <ul id="dropdown-google"
        class="@if (request()->routeIs(['google-respon','skor'])) space-y-2 py-2 @else hidden space-y-2 py-2 @endif">
          <li>
            <a href="{{ route('google-respon') }}"
               class="@if (Route::currentRouteName() === 'google-respon') active bg-blue-200 @endif group flex w-full items-center rounded-lg p-2 pl-11 text-base font-medium text-gray-900 transition duration-75 hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700">
              <svg class="h-[24px] w-[24px] text-gray-800 dark:text-white"
                   aria-hidden="true"
                   xmlns="http://www.w3.org/2000/svg"
                   width="24"
                   height="24"
                   fill="currentColor"
                   viewBox="0 0 24 24">
                <path fill-rule="evenodd"
                      d="M9 7V2.221a2 2 0 0 0-.5.365L4.586 6.5a2 2 0 0 0-.365.5H9Zm2 0V2h7a2 2 0 0 1 2 2v16a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V9h5a2 2 0 0 0 2-2Zm2-2a1 1 0 1 0 0 2h3a1 1 0 1 0 0-2h-3Zm0 3a1 1 0 1 0 0 2h3a1 1 0 1 0 0-2h-3Zm-6 4a1 1 0 0 1 1-1h8a1 1 0 0 1 1 1v6a1 1 0 0 1-1 1H8a1 1 0 0 1-1-1v-6Zm8 1v1h-2v-1h2Zm0 3h-2v1h2v-1Zm-4-3v1H9v-1h2Zm0 3H9v1h2v-1Z"
                      clip-rule="evenodd" />
              </svg>

              <span class="ml-3 text-left">
                Form Respon
              </span>
            </a>
          </li>
        </ul>
      </li>
      <li>
        <button type="button"
                class="group flex w-full items-center rounded-lg p-2 text-base font-medium text-gray-900 transition duration-75 hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700"
                aria-controls="dropdown-skor-respon"
                data-collapse-toggle="dropdown-skor-respon">
          <svg class="h-6 w-6 flex-shrink-0 text-gray-500 transition duration-75 group-hover:text-gray-900 dark:text-gray-400 dark:group-hover:text-white"
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
                  d="M10 3v4a1 1 0 0 1-1 1H5m4 10v-2m3 2v-6m3 6v-3m4-11v16a1 1 0 0 1-1 1H6a1 1 0 0 1-1-1V7.914a1 1 0 0 1 .293-.707l3.914-3.914A1 1 0 0 1 9.914 3H18a1 1 0 0 1 1 1Z" />
          </svg>
          <span class="ml-3 flex-1 whitespace-nowrap text-left">Respon</span>
          <svg aria-hidden="true"
               class="h-6 w-6"
               fill="currentColor"
               viewBox="0 0 20 20"
               xmlns="http://www.w3.org/2000/svg">
            <path fill-rule="evenodd"
                  d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                  clip-rule="evenodd"></path>
          </svg>
        </button>
        <ul id="dropdown-skor-respon"
        class="@if (request()->routeIs(['skor-respon','rekap-respon','rekap-dp-except-staff'])) space-y-2 py-2 @else hidden space-y-2 py-2 @endif">
          <li>
            <a href="{{ route('skor-respon') }}"
               class="@if (Route::currentRouteName() === 'skor-respon') active bg-blue-200 @endif group flex w-full items-center rounded-lg p-2 pl-11 text-base font-medium text-gray-900 transition duration-75 hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700">
              <svg class="h-[24px] w-[24px] text-gray-800 dark:text-white"
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
                      d="M18 5V4a1 1 0 0 0-1-1H8.914a1 1 0 0 0-.707.293L4.293 7.207A1 1 0 0 0 4 7.914V20a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1v-5M9 3v4a1 1 0 0 1-1 1H4m11.383.772 2.745 2.746m1.215-3.906a2.089 2.089 0 0 1 0 2.953l-6.65 6.646L9 17.95l.739-3.692 6.646-6.646a2.087 2.087 0 0 1 2.958 0Z" />
              </svg>
              <span class="ml-3 text-left">
                Skor Respon
              </span>
            </a>
          </li>
          <li>
            <a href="{{ route('rekap-respon') }}"
               class="@if (Route::currentRouteName() === 'rekap-respon') active bg-blue-200 @endif group flex w-full items-center rounded-lg p-2 pl-11 text-base font-medium text-gray-900 transition duration-75 hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700">
              <svg class="h-[24px] w-[24px] text-gray-800 dark:text-white"
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
                      d="M10 3v4a1 1 0 0 1-1 1H5m4 10v-2m3 2v-6m3 6v-3m4-11v16a1 1 0 0 1-1 1H6a1 1 0 0 1-1-1V7.914a1 1 0 0 1 .293-.707l3.914-3.914A1 1 0 0 1 9.914 3H18a1 1 0 0 1 1 1Z" />
              </svg>
              <span class="ml-3 text-left">
                Rekap Respon
              </span>
            </a>
          </li>
          <li>
            <a href="{{ route('rekap-dp-except-staff') }}"
               class="@if (Route::currentRouteName() === 'rekap-dp-except-staff') active bg-blue-200 @endif group flex w-full items-center rounded-lg p-2 pl-11 text-base font-medium text-gray-900 transition duration-75 hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700">
              <svg class="h-[24px] w-[24px] text-gray-800 dark:text-white"
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
                      d="M10 3v4a1 1 0 0 1-1 1H5m4 6 2 2 4-4m4-8v16a1 1 0 0 1-1 1H6a1 1 0 0 1-1-1V7.914a1 1 0 0 1 .293-.707l3.914-3.914A1 1 0 0 1 9.914 3H18a1 1 0 0 1 1 1Z" />
              </svg>

              <span class="ml-3 text-left">
                Rekap DP3
              </span>
            </a>
          </li>
        </ul>
      </li>
    </ul>
    <ul class="mt-5 space-y-2 border-t border-gray-200 pt-5 dark:border-gray-700">
      <li>
        <a href="#"
           class="group flex items-center rounded-lg p-2 text-base font-medium text-gray-900 transition duration-75 hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700">
          <svg aria-hidden="true"
               class="h-6 w-6 flex-shrink-0 text-gray-500 transition duration-75 group-hover:text-gray-900 dark:text-gray-400 dark:group-hover:text-white"
               fill="currentColor"
               viewBox="0 0 20 20"
               xmlns="http://www.w3.org/2000/svg">
            <path fill-rule="evenodd"
                  d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-2 0c0 .993-.241 1.929-.668 2.754l-1.524-1.525a3.997 3.997 0 00.078-2.183l1.562-1.562C15.802 8.249 16 9.1 16 10zm-5.165 3.913l1.58 1.58A5.98 5.98 0 0110 16a5.976 5.976 0 01-2.516-.552l1.562-1.562a4.006 4.006 0 001.789.027zm-4.677-2.796a4.002 4.002 0 01-.041-2.08l-.08.08-1.53-1.533A5.98 5.98 0 004 10c0 .954.223 1.856.619 2.657l1.54-1.54zm1.088-6.45A5.974 5.974 0 0110 4c.954 0 1.856.223 2.657.619l-1.54 1.54a4.002 4.002 0 00-2.346.033L7.246 4.668zM12 10a2 2 0 11-4 0 2 2 0 014 0z"
                  clip-rule="evenodd"></path>
          </svg>
          <span class="ml-3">Bantuan</span>
        </a>
      </li>
    </ul>
  </div>
</aside>
