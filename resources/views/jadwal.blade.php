<x-layout>
  <div class="mb-4 grid grid-cols-2 gap-4 sm:grid-cols-1 lg:grid-cols-2">
    <div class="grid h-auto justify-items-center rounded-lg border-2 border-dashed border-gray-300 dark:border-gray-600">
      @if (isset($jadwalberjalan['jadwal']))
        <div id="datepicker-inline"
             class="p-4"
             datepicker
             datepicker-title="Jadwal Penilaian"
             data-date="
           {{ \Illuminate\Support\Carbon::createFromFormat('Y-m-d', $jadwalberjalan['jadwal'])->format('m/d/Y') }}
           ">
        </div>
      @else
        <div id="datepicker-inline"
             class="p-4"
             datepicker
             datepicker-title="Jadwal Penilaian"
             data-date="
           {{ \Illuminate\Support\Carbon::now()->format('m/d/Y') }}
           ">
        </div>
      @endif
    </div>
    <div
         class="grid h-auto justify-items-center rounded-lg border-2 border-dashed border-gray-300 dark:border-gray-600">

      <div class="py-4">
        <svg class="h-[48px] w-[48px] text-gray-800 dark:text-white"
             aria-hidden="true"
             xmlns="http://www.w3.org/2000/svg"
             width="24"
             height="24"
             fill="currentColor"
             viewBox="0 0 24 24">
          <path d="M9 7V2.221a2 2 0 0 0-.5.365L4.586 6.5a2 2 0 0 0-.365.5H9Z" />
          <path fill-rule="evenodd"
                d="M11 7V2h7a2 2 0 0 1 2 2v16a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V9h5a2 2 0 0 0 2-2Zm4.707 5.707a1 1 0 0 0-1.414-1.414L11 14.586l-1.293-1.293a1 1 0 0 0-1.414 1.414l2 2a1 1 0 0 0 1.414 0l4-4Z"
                clip-rule="evenodd" />
        </svg>
      </div>
      <div>
        <p class="my-3 text-center text-lg text-gray-500 dark:text-gray-400">
          Dokumen
          @if (isset($jadwalberjalan->lihat_dokumen) == true)
            Diperlihatkan
          @else
            Disembunyikan
          @endif
        </p>
      </div>

      <div class="py-4">
        <svg class="h-[48px] w-[48px] text-gray-800 dark:text-white"
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
                d="M5 17v-5h1.5a1.5 1.5 0 1 1 0 3H5m12 2v-5h2m-2 3h2M5 10V7.914a1 1 0 0 1 .293-.707l3.914-3.914A1 1 0 0 1 9.914 3H18a1 1 0 0 1 1 1v6M5 19v1a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1v-1M10 3v4a1 1 0 0 1-1 1H5m6 4v5h1.375A1.627 1.627 0 0 0 14 15.375v-1.75A1.627 1.627 0 0 0 12.375 12H11Z" />
        </svg>

      </div>
      <div>
        <p class="my-3 text-center text-lg text-gray-500 dark:text-gray-400">
          Nilai
          @if (isset($jadwalberjalan->lihat_skor) == true)
            Diperlihatkan
          @else
            Disembunyikan
          @endif
        </p>
      </div>

    </div>
  </div>

  <div class="grid grid-cols-2 gap-4 sm:grid-cols-1 md:grid-cols-2">
    <div class="h-auto rounded-lg border-2 border-dashed border-gray-300 dark:border-gray-600 md:h-auto">
      <p class="my-3 text-center text-lg text-gray-500 dark:text-gray-400">
        Form Setting Jadwal Penilaian
      </p>
      @if (session('status'))
        <div id="alert-3"
             class="mx-4 flex items-center rounded-lg bg-green-50 p-4 text-green-800 dark:bg-gray-800 dark:text-green-400"
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
            action="{{ route('atur-jadwal-store') }}"
            method="POST">
        @csrf
        <div class="group mb-5">
          <h3 class="mb-2 font-semibold text-gray-900 dark:text-white">Jadwal</h3>
          <div id="date-range-picker"
               date-rangepicker
               class="mb-5 flex items-center">
            <div class="relative">
              <div class="pointer-events-none absolute inset-y-0 start-0 flex items-center ps-3">
                <svg class="h-4 w-4 text-gray-500 dark:text-gray-400"
                     aria-hidden="true"
                     xmlns="http://www.w3.org/2000/svg"
                     fill="currentColor"
                     viewBox="0 0 20 20">
                  <path
                        d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z" />
                </svg>
              </div>
              <input id="datepicker-range-start"
                     name="start"
                     type="text"
                     value="{{ old('start', date('m/d/Y')) ? old('start', date('m/d/Y')) : '' }}"
                     class="block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 ps-10 text-sm text-gray-900 focus:border-blue-500 focus:ring-blue-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:placeholder-gray-400 dark:focus:border-blue-500 dark:focus:ring-blue-500"
                     placeholder="tanggal mulai">
            </div>
            <span class="mx-4 text-gray-500">-</span>
            <div class="relative">
              <div class="pointer-events-none absolute inset-y-0 start-0 flex items-center ps-3">
                <svg class="h-4 w-4 text-gray-500 dark:text-gray-400"
                     aria-hidden="true"
                     xmlns="http://www.w3.org/2000/svg"
                     fill="currentColor"
                     viewBox="0 0 20 20">
                  <path
                        d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z" />
                </svg>
              </div>
              <input id="datepicker-range-end"
                     name="end"
                     type="text"
                     value="{{ old('end', date('m/d/Y')) ? old('end', date('m/d/Y')) : '' }}"
                     class="block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 ps-10 text-sm text-gray-900 focus:border-blue-500 focus:ring-blue-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:placeholder-gray-400 dark:focus:border-blue-500 dark:focus:ring-blue-500"
                     placeholder="tanggal selesai">
            </div>
            <div>
              @if (session('status_fails'))
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
                    {{ session('status_fails') }}
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
            </div>
          </div>
        </div>

        <div class="group mb-5">
          <h3 class="mb-2 font-semibold text-gray-900 dark:text-white">Perlihatkan</h3>
          <div class="flex justify-around border p-4">
            <div class="me-4 flex items-center px-2">
              <input id="inline-checkbox"
                     @if (isset($jadwalberjalan->lihat_skor) == true) checked @endif
                     type="checkbox"
                     name="nilaiCheck"
                     class="h-4 w-4 rounded border-gray-300 bg-gray-100 text-blue-600 focus:ring-2 focus:ring-blue-500 dark:border-gray-600 dark:bg-gray-700 dark:ring-offset-gray-800 dark:focus:ring-blue-600">
              <label for="inline-checkbox"
                     class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">Nilai</label>
            </div>
            <div class="me-4 flex items-center px-2">
              <input id="inline-2-checkbox"
                     type="checkbox"
                     name="dokumenCheck"
                     @if (isset($jadwalberjalan->lihat_dokumen) == true) checked @endif
                     class="h-4 w-4 rounded border-gray-300 bg-gray-100 text-blue-600 focus:ring-2 focus:ring-blue-500 dark:border-gray-600 dark:bg-gray-700 dark:ring-offset-gray-800 dark:focus:ring-blue-600">
              <label for="inline-2-checkbox"
                     class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">Dokumen</label>
            </div>
          </div>
        </div>

        <button type="submit"
                class="w-full rounded-lg bg-lime-700 px-5 py-2.5 text-center text-lg font-medium text-white hover:bg-lime-800 focus:outline-none focus:ring-4 focus:ring-lime-300 dark:bg-lime-600 dark:hover:bg-lime-700 dark:focus:ring-lime-800 sm:w-auto">
          Tetapkan
        </button>
      </form>

    </div>
  </div>
</x-layout>
