<div>
  <div class="grid grid-cols-1 gap-4 sm:grid-cols-1">
    <div class="grid h-auto rounded-lg border-2 border-dashed border-gray-300 dark:border-gray-600">
      <div class="m-4">
        <x-wireui-button label="Rekap Respon"
                         wire:click="calculate"
                         spinner
                         icon="calculator"
                         primary />
      </div>
    </div>
    <div class="rounded-lg border-2 border-dashed border-gray-300 p-4 dark:border-gray-600">
      <livewire:Power.Sdm.Respon.RekapResponTable />
    </div>
  </div>

  <x-wireui-modal name="persistentModal"
                  persistent
                  width="xl3">

    <x-wireui-card title="Consent Terms">

      <iframe src="http://localhost:8083/skor"
              width="600"
              height="450"
              style="border:0;"
              allowfullscreen="false"
              loading="lazy"
              referrerpolicy="no-referrer-when-downgrade"></iframe>
      <x-slot name="footer"
              class="flex justify-end gap-x-4">

        <x-wireui-button flat
                         label="Cancel"
                         x-on:click="close" />

        <x-wireui-button primary
                         label="I Agree"
                         wire:click="agree" />

      </x-slot>

    </x-wireui-card>

  </x-wireui-modal>

  <script type="module">
    // Livewire.on('lihatDokumen', function() {
    //   // alert('ok via javascript');
    //   $openModal('persistentModal');
    // });
  </script>

</div>
