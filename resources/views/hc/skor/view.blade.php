<x-layout>
  <div class="grid grid-cols-1 gap-4 sm:grid-cols-1">
    <div class="my-2">
      <button type="button"
              data-modal-target="modal-skor-insert"
              data-modal-toggle="modal-skor-insert"
              class="dark:focus:ring-[#3b5998]/55 mb-2 me-2 inline-flex items-center rounded-lg bg-[#3b5998] px-5 py-2.5 text-center text-sm font-medium text-white hover:bg-[#3b5998]/90 focus:outline-none focus:ring-4 focus:ring-[#3b5998]/50">

        <svg class="me-2 h-4 w-4"
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
                d="M5 12h14m-7 7V5" />
        </svg>
        Skor
      </button>
    </div>
    <div class="border p-4">
      <table id="skor-table">
        <thead>
          <tr>
            <th>No</th>
            <th>Aspek</th>
            <th>Indikator</th>
            <th>Jawaban</th>
            <th>Skor</th>
            <th>Aksi</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($data_skor as $skr)
            <tr>
              <td>{{ $loop->iteration }}</td>
              <td>{{ $skr->aspek->nama_aspek }}</td>
              <td>{{ $skr->indikator->nama_indikator }}</td>
              <td>{{ $skr->jawaban }}</td>
              <td>{{ $skr->skor }}</td>
              <td>{{ $skr->id }}</td>
            </tr>
          @endforeach
        </tbody>
        <tfoot>

        </tfoot>
      </table>
    </div>
  </div>

  <x-slot:scripts>
    <script type="module">
      document.addEventListener("DOMContentLoaded", (event) => {
        if (document.getElementById("skor-table") && typeof DataTable !== 'undefined') {
          const dataTable = new DataTable("#skor-table", {
            searchable: false,
            sortable: true,
            // scrollY: "450",
            // scrollX:"450",
            hasHeadings: true,
            tableRender: (_data, table, type) => {
              if (type === "print") {
                return table
              }
              const tHead = table.childNodes[0]
              const filterHeaders = {
                nodeName: "TR",
                attributes: {
                  class: "search-filtering-row"
                },
                childNodes: tHead.childNodes[0].childNodes.map(
                  (_th, index) => ({
                    nodeName: "TH",
                    childNodes: [{
                      nodeName: "INPUT",
                      attributes: {
                        class: "datatable-input",
                        type: "search",
                        "data-columns": "[" + index + "]"
                      }
                    }]
                  })
                )
              }
              tHead.childNodes.push(filterHeaders)
              return table
            }
          });
        }
      });
    </script>
  </x-slot:scripts>

  <x-slot:modals>
    <!-- Main modal -->
    <div id="modal-skor-insert"
         tabindex="-1"
         aria-hidden="true"
         class="fixed left-0 right-0 top-0 z-50 hidden h-[calc(100%-1rem)] max-h-full w-full items-center justify-center overflow-y-auto overflow-x-hidden md:inset-0">
      <div class="relative max-h-full w-full max-w-2xl p-4">
        <!-- Modal content -->
        <div class="relative rounded-lg bg-white shadow dark:bg-gray-700">
          <!-- Modal header -->
          <div class="flex items-center justify-between rounded-t border-b p-4 dark:border-gray-600 md:p-5">
            <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
              Tambah Data Skor
            </h3>
            <button type="button"
                    class="ms-auto inline-flex h-8 w-8 items-center justify-center rounded-lg bg-transparent text-sm text-gray-400 hover:bg-gray-200 hover:text-gray-900 dark:hover:bg-gray-600 dark:hover:text-white"
                    data-modal-hide="modal-skor-insert">
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
          <div class="space-y-4 p-4 md:p-5">

            <form class="mx-auto max-w-md">
              <div class="group relative z-0 mb-5 w-full">
                <input id="floating_email"
                       type="email"
                       name="floating_email"
                       class="peer block w-full appearance-none border-0 border-b-2 border-gray-300 bg-transparent px-0 py-2.5 text-sm text-gray-900 focus:border-blue-600 focus:outline-none focus:ring-0 dark:border-gray-600 dark:text-white dark:focus:border-blue-500"
                       placeholder=" "
                       required />
                <label for="floating_email"
                       class="absolute top-3 -z-10 origin-[0] -translate-y-6 scale-75 transform text-sm text-gray-500 duration-300 peer-placeholder-shown:translate-y-0 peer-placeholder-shown:scale-100 peer-focus:start-0 peer-focus:-translate-y-6 peer-focus:scale-75 peer-focus:font-medium peer-focus:text-blue-600 rtl:peer-focus:left-auto rtl:peer-focus:translate-x-1/4 dark:text-gray-400 peer-focus:dark:text-blue-500">Email
                  address</label>
              </div>
              <div class="group relative z-0 mb-5 w-full">
                <input id="floating_password"
                       type="password"
                       name="floating_password"
                       class="peer block w-full appearance-none border-0 border-b-2 border-gray-300 bg-transparent px-0 py-2.5 text-sm text-gray-900 focus:border-blue-600 focus:outline-none focus:ring-0 dark:border-gray-600 dark:text-white dark:focus:border-blue-500"
                       placeholder=" "
                       required />
                <label for="floating_password"
                       class="absolute top-3 -z-10 origin-[0] -translate-y-6 scale-75 transform text-sm text-gray-500 duration-300 peer-placeholder-shown:translate-y-0 peer-placeholder-shown:scale-100 peer-focus:start-0 peer-focus:-translate-y-6 peer-focus:scale-75 peer-focus:font-medium peer-focus:text-blue-600 rtl:peer-focus:translate-x-1/4 dark:text-gray-400 peer-focus:dark:text-blue-500">Password</label>
              </div>
              <div class="group relative z-0 mb-5 w-full">
                <input id="floating_repeat_password"
                       type="password"
                       name="repeat_password"
                       class="peer block w-full appearance-none border-0 border-b-2 border-gray-300 bg-transparent px-0 py-2.5 text-sm text-gray-900 focus:border-blue-600 focus:outline-none focus:ring-0 dark:border-gray-600 dark:text-white dark:focus:border-blue-500"
                       placeholder=" "
                       required />
                <label for="floating_repeat_password"
                       class="absolute top-3 -z-10 origin-[0] -translate-y-6 scale-75 transform text-sm text-gray-500 duration-300 peer-placeholder-shown:translate-y-0 peer-placeholder-shown:scale-100 peer-focus:start-0 peer-focus:-translate-y-6 peer-focus:scale-75 peer-focus:font-medium peer-focus:text-blue-600 rtl:peer-focus:translate-x-1/4 dark:text-gray-400 peer-focus:dark:text-blue-500">Confirm
                  password</label>
              </div>
              <div class="grid md:grid-cols-2 md:gap-6">
                <div class="group relative z-0 mb-5 w-full">
                  <input id="floating_first_name"
                         type="text"
                         name="floating_first_name"
                         class="peer block w-full appearance-none border-0 border-b-2 border-gray-300 bg-transparent px-0 py-2.5 text-sm text-gray-900 focus:border-blue-600 focus:outline-none focus:ring-0 dark:border-gray-600 dark:text-white dark:focus:border-blue-500"
                         placeholder=" "
                         required />
                  <label for="floating_first_name"
                         class="absolute top-3 -z-10 origin-[0] -translate-y-6 scale-75 transform text-sm text-gray-500 duration-300 peer-placeholder-shown:translate-y-0 peer-placeholder-shown:scale-100 peer-focus:start-0 peer-focus:-translate-y-6 peer-focus:scale-75 peer-focus:font-medium peer-focus:text-blue-600 rtl:peer-focus:translate-x-1/4 dark:text-gray-400 peer-focus:dark:text-blue-500">First
                    name</label>
                </div>
                <div class="group relative z-0 mb-5 w-full">
                  <input id="floating_last_name"
                         type="text"
                         name="floating_last_name"
                         class="peer block w-full appearance-none border-0 border-b-2 border-gray-300 bg-transparent px-0 py-2.5 text-sm text-gray-900 focus:border-blue-600 focus:outline-none focus:ring-0 dark:border-gray-600 dark:text-white dark:focus:border-blue-500"
                         placeholder=" "
                         required />
                  <label for="floating_last_name"
                         class="absolute top-3 -z-10 origin-[0] -translate-y-6 scale-75 transform text-sm text-gray-500 duration-300 peer-placeholder-shown:translate-y-0 peer-placeholder-shown:scale-100 peer-focus:start-0 peer-focus:-translate-y-6 peer-focus:scale-75 peer-focus:font-medium peer-focus:text-blue-600 rtl:peer-focus:translate-x-1/4 dark:text-gray-400 peer-focus:dark:text-blue-500">Last
                    name</label>
                </div>
              </div>
              <div class="grid md:grid-cols-2 md:gap-6">
                <div class="group relative z-0 mb-5 w-full">
                  <input id="floating_phone"
                         type="tel"
                         pattern="[0-9]{3}-[0-9]{3}-[0-9]{4}"
                         name="floating_phone"
                         class="peer block w-full appearance-none border-0 border-b-2 border-gray-300 bg-transparent px-0 py-2.5 text-sm text-gray-900 focus:border-blue-600 focus:outline-none focus:ring-0 dark:border-gray-600 dark:text-white dark:focus:border-blue-500"
                         placeholder=" "
                         required />
                  <label for="floating_phone"
                         class="absolute top-3 -z-10 origin-[0] -translate-y-6 scale-75 transform text-sm text-gray-500 duration-300 peer-placeholder-shown:translate-y-0 peer-placeholder-shown:scale-100 peer-focus:start-0 peer-focus:-translate-y-6 peer-focus:scale-75 peer-focus:font-medium peer-focus:text-blue-600 rtl:peer-focus:translate-x-1/4 dark:text-gray-400 peer-focus:dark:text-blue-500">Phone
                    number (123-456-7890)</label>
                </div>
                <div class="group relative z-0 mb-5 w-full">
                  <input id="floating_company"
                         type="text"
                         name="floating_company"
                         class="peer block w-full appearance-none border-0 border-b-2 border-gray-300 bg-transparent px-0 py-2.5 text-sm text-gray-900 focus:border-blue-600 focus:outline-none focus:ring-0 dark:border-gray-600 dark:text-white dark:focus:border-blue-500"
                         placeholder=" "
                         required />
                  <label for="floating_company"
                         class="absolute top-3 -z-10 origin-[0] -translate-y-6 scale-75 transform text-sm text-gray-500 duration-300 peer-placeholder-shown:translate-y-0 peer-placeholder-shown:scale-100 peer-focus:start-0 peer-focus:-translate-y-6 peer-focus:scale-75 peer-focus:font-medium peer-focus:text-blue-600 rtl:peer-focus:translate-x-1/4 dark:text-gray-400 peer-focus:dark:text-blue-500">Company
                    (Ex. Google)</label>
                </div>
              </div>
              <button type="submit"
                      class="w-full rounded-lg bg-blue-700 px-5 py-2.5 text-center text-sm font-medium text-white hover:bg-blue-800 focus:outline-none focus:ring-4 focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800 sm:w-auto">Submit</button>
            </form>

          </div>
          <!-- Modal footer -->
          <div class="flex items-center rounded-b border-t border-gray-200 p-4 dark:border-gray-600 md:p-5">
            <button data-modal-hide="modal-skor-insert"
                    type="button"
                    class="rounded-lg bg-blue-700 px-5 py-2.5 text-center text-sm font-medium text-white hover:bg-blue-800 focus:outline-none focus:ring-4 focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">I
              accept</button>
            <button data-modal-hide="modal-skor-insert"
                    type="button"
                    class="ms-3 rounded-lg border border-gray-200 bg-white px-5 py-2.5 text-sm font-medium text-gray-900 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:outline-none focus:ring-4 focus:ring-gray-100 dark:border-gray-600 dark:bg-gray-800 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white dark:focus:ring-gray-700">Decline</button>
          </div>
        </div>
      </div>
    </div>
  </x-slot:modals>

</x-layout>
