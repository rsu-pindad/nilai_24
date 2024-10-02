<div>

  <div class="grid grid-cols-1 gap-4 sm:grid-cols-1">
    <div class="grid h-auto rounded-lg border-2 border-dashed border-gray-300 dark:border-gray-600">
      <div class="m-4">
        <x-wireui-button label="Skor"
                         x-on:click="$openModal('skorModal')"
                         icon="plus"
                         primary />
      </div>
    </div>
    <div class="rounded-lg border-2 border-dashed border-gray-300 p-4 dark:border-gray-600">
      <livewire:Power.Sdm.SkorTable />
    </div>
  </div>

  <!-- Skor Modal -->
  <x-wireui-modal name="skorModal"
                  align="center"
                  blur="sm">

    <x-wireui-card title="Tambah Skor Data">
      <form>
        <div class="mb-3 grid grid-cols-2 gap-4 sm:grid-cols-2">
          <x-wireui-button label="Aspek"
                           x-on:click="$openModal('aspekModal')"
                           icon="plus"
                           blue />
          <x-wireui-button label="Indikator"
                           x-on:click="$openModal('indikatorModal')"
                           icon="plus"
                           indigo />
        </div>
        <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
          <x-wireui-native-select wire:model.live="skorForm.aspek"
                                  label="Aspek">
            <option hidden>pilih aspek</option>
            @foreach ($this->aspeks as $aspek)
              <option value="{{ $aspek->id }}">{{ $aspek->nama_aspek }}</option>
            @endforeach
          </x-wireui-native-select>
          @if (!is_null($this->skorForm->aspek))
            <x-wireui-native-select wire:model.live="skorForm.indikator"
                                    label="Indikator">
              <option hidden>pilih indikator</option>
              @foreach ($this->indikators as $indikator)
                <option value="{{ $indikator->id }}">{{ $indikator->nama_indikator }}</option>
              @endforeach
            </x-wireui-native-select>
          @else
            <x-wireui-native-select label="Indikator">
              <option hidden>pilih aspek dulu</option>
            </x-wireui-native-select>
          @endif
          <div class="col-span-1 sm:col-span-2">
            <x-wireui-textarea wire:model="skorForm.jawaban"
                               label="Jawaban"
                               placeholder="masukan jawaban" />
          </div>

          <div class="col-span-1 sm:col-span-2">
            <x-wireui-input wire:model="skorForm.skorJawaban"
                            label="Skor"
                            type="number"
                            placeholder="masukan Skor" />
          </div>

        </div>
        <x-slot name="footer"
                class="flex justify-end gap-x-4">

          <x-wireui-button flat
                           label="Tutup"
                           x-on:click="$closeModal('skorModal')" />

          <x-wireui-button primary
                           wire:click="insertSkor"
                           spinner
                           label="Tambah">
          </x-wireui-button>

        </x-slot>
      </form>
    </x-wireui-card>

  </x-wireui-modal>
  <!-- End Skor Modal -->

  <!-- Aspek Modal -->
  <x-wireui-modal name="aspekModal"
                  align="center"
                  blur="sm">

    <x-wireui-card title="Tambah Aspek Data">

      <form>
        <div class="grid grid-cols-1">
          <x-wireui-textarea wire:model="aspekForm.aspek"
                             label="Nama Aspek"
                             placeholder="masukan nama aspek" />

        </div>
        <x-slot name="footer"
                class="flex justify-end gap-x-4">

          <x-wireui-button flat
                           label="Tutup"
                           x-on:click="$closeModal('aspekModal')" />

          <x-wireui-button primary
                           label="Tambah"
                           spinner
                           wire:click="insertAspek" />

        </x-slot>
      </form>

    </x-wireui-card>

  </x-wireui-modal>
  <!-- End Aspek Modal -->

  <!-- Indikator Modal -->
  <x-wireui-modal name="indikatorModal"
                  align="center"
                  blur="sm">

    <x-wireui-card title="Tambah Indikator Data">

      <form>
        <div class="grid grid-cols-1 gap-4">
          <x-wireui-native-select wire:model.live="indikatorForm.aspek"
                                  label="Aspek">
            <option hidden>pilih aspek</option>
            @foreach ($this->aspeks as $aspek)
              <option value="{{ $aspek->id }}">{{ $aspek->nama_aspek }}</option>
            @endforeach
          </x-wireui-native-select>
          @if (!is_null($this->indikatorForm->aspek))
            <x-wireui-textarea wire:model="indikatorForm.indikator"
                               label="Indikator"
                               placeholder="masukan indikator" />
          @else
            <x-wireui-textarea label="Indikator"
                               placeholder="mohon pilih aspek"
                               readonly />
          @endif

        </div>
        <x-slot name="footer"
                class="flex justify-end gap-x-4">

          <x-wireui-button flat
                           label="Cancel"
                           x-on:click="$closeModal('indikatorModal')" />

          <x-wireui-button primary
                           label="Tambah"
                           spinner
                           wire:click="insertIndikator" />

        </x-slot>
      </form>

    </x-wireui-card>

  </x-wireui-modal>
  <!-- End Indikator Modal -->

  <x-slot:scripts>
    <script type="module">
      // Livewire.hook('wireui:onselected', function(){
      //   alert('ok')
      // });
      // Livewire.hook('wireui:selected', function(){
      //   alert('okx')
      // })

      Wireui.hook('load', () => console.log('wireui is ready to use'))
    </script>
  </x-slot:scripts>

</div>
