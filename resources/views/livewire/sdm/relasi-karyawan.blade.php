<div>

  <div class="grid grid-cols-1 gap-4 sm:grid-cols-1">
    <div class="grid h-auto rounded-lg border-2 border-dashed border-gray-300 dark:border-gray-600">
      <div class="m-4">
        <x-wireui-button label="Synchonize Spreadsheet Relasi"
                         wire:click="sync"
                         spinner
                         icon="arrow-path"
                         primary />
      </div>
    </div>
    <div class="rounded-lg border-2 border-dashed border-gray-300 p-4 dark:border-gray-600">
      <livewire:Power.Sdm.RelasiKaryawanTable />
    </div>
  </div>

</div>
