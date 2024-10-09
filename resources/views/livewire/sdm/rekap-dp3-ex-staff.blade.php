<div>
  <div class="grid grid-cols-1 gap-4 sm:grid-cols-1">
    <div class="grid h-auto rounded-lg border-2 border-dashed border-gray-300 dark:border-gray-600">
      <div class="flex flex-row justify-around">
        <div class="m-4">
          <x-wireui-button label="Rekap DP3 Atasan"
                           wire:click="calculate('atasan')"
                           spinner
                           icon="calculator"
                           lime />
        </div>
        <div class="m-4">
          <x-wireui-button label="Rekap DP3 Rekanan"
                           wire:click="calculate('rekanan')"
                           spinner
                           icon="calculator"
                           blue />
        </div>
        <div class="m-4">
          <x-wireui-button label="Rekap DP3 Self"
                           wire:click="calculate('self')"
                           spinner
                           icon="calculator"
                           orange />
        </div>
        <div class="m-4">
          <x-wireui-button label="Rekap DP3 Staff"
                           wire:click="calculate('staff')"
                           spinner
                           icon="calculator"
                           violet />
        </div>
      </div>
      <div class="flex flex-row justify-around">
        <div class="m-4">
          <x-wireui-button label="Ekport DP3"
                           wire:click="export()"
                           spinner
                           icon="calculator"
                           light lime />
        </div>
      </div>
    </div>
    <div class="rounded-lg border-2 border-dashed border-gray-300 p-4 dark:border-gray-600">
      <livewire:Power.Sdm.Rekap.RekapDp3Table />
    </div>
  </div>

  <x-wireui-modal name="persistentModal"
                  persistent
                  width="xl3">

    <x-wireui-card title="Dokumen {{ $this->judulPdf }}">

      <div class="flex flex-row content-center">
        <div role="status"
             class="self-center"
             wire:loading>
          <svg aria-hidden="true"
               class="inline h-10 w-10 animate-spin fill-blue-600 text-gray-200 dark:text-gray-600"
               viewBox="0 0 100 101"
               fill="none"
               xmlns="http://www.w3.org/2000/svg">
            <path d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z"
                  fill="currentColor" />
            <path d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z"
                  fill="currentFill" />
          </svg>
          <span class="sr-only">Loading...</span>
        </div>
      </div>

      <div class="flex flex-row">
        <iframe src="{{ $this->urlPdf }}"
                width="800"
                height="460"
                style="border:0;"
                allowfullscreen="false"
                loading="lazy"
                referrerpolicy="no-referrer-when-downgrade"
                wire:loading.remove>
        </iframe>
      </div>

      <x-slot name="footer"
              class="flex justify-end gap-x-4">

        <x-wireui-button flat
                         label="Tutup"
                         x-on:click="close" />

        {{-- <x-wireui-button primary
                           label="I Agree"
                           wire:click="agree" /> --}}

      </x-slot>

    </x-wireui-card>

  </x-wireui-modal>

  <script type="module">
    Livewire.on('lihatPersonalDokumen', function() {
      // alert('ok via javascript');
      $openModal('persistentModal');

      document.addEventListener('contextmenu', event => event.preventDefault());
      document.addEventListener('keydown', event => {
        if (event.ctrlKey && (event.key === 'p' || event.key === 's')) {
          event.preventDefault();
        }
      });
    });
  </script>

</div>
