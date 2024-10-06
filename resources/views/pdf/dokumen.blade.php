<!DOCTYPE html>
<html lang="en">

  <head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible"
          content="ie=edge">
    <title>Dokumen Penilaian</title>
    <script src="https://cdn.tailwindcss.com"></script>
  </head>

  <body>

    <div class="mx-auto max-w-xl px-2 py-8">
      <div class="mb-4 flex items-center justify-between">
        <h1>Form Penilaian Kinerja</h1>
      </div>
      <div class="text-xs">
        <div class="grid grid-cols-5 justify-items-start gap-2 border px-2 text-xs">
          <div class="col-span-5">Penilaian Kinerja</div>
          <div>Nama</div>
          <div class="col-span-3"></div>
          <div>NIK</div>
          <div>Jabatan</div>
          <div class="col-span-4"></div>
          <div>Unit Kerja</div>
          <div class="col-span-4"></div>
        </div>
        <div class="grid grid-cols-5 justify-items-start gap-2 border px-2 text-xs">
          <div class="col-span-5">Pejabat Penilai</div>
          <div>Nama</div>
          <div class="col-span-3"></div>
          <div>NIK</div>
          <div>Jabatan</div>
          <div class="col-span-4"></div>
          <div>Unit Kerja</div>
          <div class="col-span-4"></div>
        </div>
        <div class="grid grid-cols-5 justify-items-start gap-2 border px-2 text-xs">
          <div class="col-span-5">Atasan Pejabat Penilai</div>
          <div>Nama</div>
          <div class="col-span-3"></div>
          <div>NIK</div>
          <div>Jabatan</div>
          <div class="col-span-4"></div>
          <div>Unit Kerja</div>
          <div class="col-span-4"></div>
        </div>
        <div class="gird-rows-90 grid grid-flow-col justify-items-center gap-2 border px-2 text-xs">

          {{-- Row 1 --}}
          <div class="grid-rows-subgrid row-span-2 grid">
            <div class="row-start-1">
              Komponen Penilaian Kinerja
            </div>
          </div>

          {{-- Row 3 --}}
          <div>
            Bobot Kinerja
          </div>

          {{-- Row 4 --}}
          <div class="grid-rows-subgrid row-span-2 grid">
            <div class="row-start-4">
              1.Nilai-Nilai Perusahaan dan Perilaku
            </div>
          </div>

          {{-- Row 6 --}}
          <div class="grid-rows-subgrid row-span-5 grid">
            <div class="row-start-6">
            </div>
          </div>

          {{-- Row 11 --}}
          <div class="grid-rows-subgrid row-span-2 grid">
            <div class="row-start-11">
              2.Kepemimpinan
            </div>
          </div>

          {{-- Row 13 --}}
          <div class="grid-rows-subgrid row-span-6 grid">
            <div class="row-start-13">
            </div>
          </div>

          {{-- Row 19 --}}
          <div class="grid-rows-subgrid row-span-2 grid">
            <div class="row-start-19">
              3.Tugas Utama, Sasaran Kinerja dan Pengembangan Profesi
            </div>
          </div>

          {{-- Row 21 --}}
          <div class="grid-rows-subgrid row-span-6 grid">
            <div class="row-start-21">
            </div>
          </div>

          {{-- Row 27 --}}
          <div>Bobot</div>

          {{-- Row 28 --}}
          <div>Keterangan Pencapaian</div>

          {{-- Row 29 --}}
          <div class="grid-rows-subgrid row-span-2 grid">
            <div class="row-start-29">
              %
            </div>
          </div>

          {{-- Row 31 --}}
          <div>Kerjasama</div>

          {{-- Row 32 --}}
          <div>Komunikasi</div>

          {{-- Row 33 --}}
          <div>Displin dan Kehadiran/Absensi</div>

          {{-- Row 34 --}}
          <div>Dedikasi dan Integritas</div>

          {{-- Row 35 --}}
          <div>Etika</div>

          {{-- Row 36 --}}
          <div class="grid-rows-subgrid row-span-2 grid">
            <div class="row-start-36">
              %
            </div>
          </div>

          {{-- Row 38 --}}
          <div>Strategi - Perencanaan</div>

          {{-- Row 39 --}}
          <div>Strategi - Pengawasan</div>

          {{-- Row 40 --}}
          <div>Strategi - Inovasi</div>

          {{-- Row 41 --}}
          <div>Kepemimpinan</div>

          {{-- Row 42 --}}
          <div>Membimbingan dan Membangun</div>

          {{-- Row 43 --}}
          <div>Pengambilan keputusan</div>
          
          {{-- Row 44 --}}
          <div></div>

        </div>
      </div>
    </div>

  </body>

</html>
