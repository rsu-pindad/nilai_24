<li class="nav-header">PENILAIAN 2023</li>
<li class="nav-item">
  <a href="{{ route('response') }}"
     class="nav-link {{ Route::currentRouteName() == 'response' ? 'active' : '' }}">
    <i class="nav-icon fas fa-square"></i>
    <p>Respon</p>
  </a>
</li>
<li class="nav-header">INTERFACE 2024</li>
<li class="nav-item">
  <a href="{{ route('atur-jadwal') }}"
     class="nav-link {{ Route::currentRouteName() == 'atur-jadwal' ? 'active' : '' }}">
    <i class="nav-icon fas fa-square"></i>
    <p>Jadwal</p>
  </a>
</li>
<li class="nav-item">
  <a href="{{ Route('skor') }}"
     class="nav-link {{ Route::currentRouteName() == 'skor' ? 'active' : '' }}">
    <i class="nav-icon fas fa-square"></i>
    <p>Tabel Skor</p>
  </a>
</li>
<!--
<li class="nav-item">
    <a href="{{ route('link-nilai') }}" class="nav-link {{ Route::currentRouteName() == 'link-nilai' ? 'active' : '' }}">
        <i class="nav-icon fas fa-square"></i>
        <p>Atur Link</p>
    </a>
</li>
-->
<li class="nav-header">INTERFACE 2024</li>
<li class="nav-item menu-is-opening menu-open">
  <!--
    <ul class="nav nav-treeview" style="display: block;">
        <li class="nav-item {{ Route::is('skor') ? 'block;' : '' }}">
            <a href="#" class="nav-link">
                <i class="nav-icon fas fa-circle"></i>
                <p>
                Skor
                <i class="right fas fa-angle-left"></i>
                </p>
            </a>
            <ul class="nav nav-treeview" style="display: {{ Route::is('skor') ? 'block;' : 'none;' }}">
            <li class="nav-item">
                <a href="{{ Route('skor') }}" class="nav-link {{ Route::currentRouteName() == 'skor' ? 'active' : '' }}">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Tabel Skor</p>
                </a>
            </li>
            </ul>
        </li>
    </ul>
-->
  <ul class="nav nav-treeview"
      style="display: block;">
    <li class="nav-item">
      <a href="{{ Route('relasi-user') }}"
         class="nav-link {{ Route::currentRouteName() == 'relasi-user' ? 'active' : '' }}">
        <i class="far fa-circle nav-icon"></i>
        <p>User MGMT</p>
      </a>
    </li>
    <li class="nav-item">
      <a href="{{ Route('relasi-karyawan') }}"
         class="nav-link {{ Route::currentRouteName() == 'relasi-karyawan' ? 'active' : '' }}">
        <i class="far fa-circle nav-icon"></i>
        <p>Relasi Karyawan</p>
      </a>
    </li>
    <li class="nav-item {{ Route::is('gform') ? 'block;' : '' }}">
      <a href="#"
         class="nav-link">
        <i class="nav-icon fas fa-circle"></i>
        <p>Google Form<i class="right fas fa-angle-left"></i>
        </p>
      </a>
      <ul class="nav nav-treeview"
          style="display: {{ Route::is('gform') ? 'block;' : 'none;' }}">
        <li class="nav-item">
          <a href="{{ Route('gform') }}"
             class="nav-link {{ Route::currentRouteName() == 'gform' ? 'active' : '' }}">
            <i class="far fa-circle nav-icon"></i>
            <p>Response Form</p>
          </a>
        </li>
      </ul>
    </li>
  </ul>
  <ul class="nav nav-treeview"
      style="display: block;">
    <li class="nav-item {{ request()->is('skor/pool/*') ? 'menu-is-opening menu-open' : '' }}">
      <a href="#"
         class="nav-link">
        <i class="nav-icon fas fa-circle"></i>
        <p>
          Hitung
          <i class="right fas fa-angle-left"></i>
        </p>
      </a>
      <ul class="nav nav-treeview"
          style="display: {{ Route::is('pool.*') ? 'block;' : '' }}">
        <li class="nav-item">
          <a href="{{ Route('skor-index-pool-all') }}"
             class="nav-link {{ Route::currentRouteName() == 'skor-index-pool-all' ? 'active' : '' }}">
            <i class="far fa-circle nav-icon"></i>
            <p>Semua Relasi</p>
          </a>
        </li>
        <!--
                <li class="nav-item">
                    <a href="{{ Route('skor-index-pool-self') }}" class="nav-link {{ Route::currentRouteName() == 'skor-index-pool-self' ? 'active' : '' }}">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Self</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ Route('skor-index-pool-atasan') }}" class="nav-link {{ Route::currentRouteName() == 'skor-index-pool-atasan' ? 'active' : '' }}">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Atasan</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ Route('skor-index-pool-rekanan') }}" class="nav-link {{ Route::currentRouteName() == 'skor-index-pool-rekanan' ? 'active' : '' }}">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Rekan</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ Route('skor-index-pool-staff') }}" class="nav-link {{ Route::currentRouteName() == 'skor-index-pool-staff' ? 'active' : '' }}">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Staff</p>
                    </a>
                </li>
                -->
      </ul>
    </li>
  </ul>
  <!--
    <ul class="nav nav-treeview" style="display: none;">
        <li class="nav-item {{ request()->is('rekap/*') ? 'menu-is-opening menu-open' : '' }}">
            <a href="#" class="nav-link">
                <i class="nav-icon fas fa-circle"></i>
                <p> Rekap Non Bobot<i class="right fas fa-angle-left"></i></p>
            </a>
            <ul class="nav nav-treeview" style="display: {{ request()->is('rekap/*') ? 'block;' : 'none;' }}">
            <li class="nav-item">
                <a href="{{ Route('rekap-non-bobot-kepemimpinan') }}" class="nav-link {{ Route::currentRouteName() == 'rekap-non-bobot-kepemimpinan' ? 'active' : '' }}">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Kepemimpinan</p>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ Route('rekap-non-bobot-perilaku') }}" class="nav-link {{ Route::currentRouteName() == 'rekap-non-bobot-perilaku' ? 'active' : '' }}">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Perilaku</p>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ Route('rekap-non-bobot-sasaran') }}" class="nav-link {{ Route::currentRouteName() == 'rekap-non-bobot-sasaran' ? 'active' : '' }}">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Sasaran</p>
                </a>
            </li>
            </ul>
        </li>
    </ul>
    <ul class="nav nav-treeview" style="display: none;">
        <li class="nav-item {{ request()->is('bobot-rekap/*') ? 'menu-is-opening menu-open' : '' }}">
            <a href="#" class="nav-link">
                <i class="nav-icon fas fa-circle"></i>
                <p> Rekap Bobot<i class="right fas fa-angle-left"></i></p>
            </a>
            <ul class="nav nav-treeview" style="display: {{ request()->is('bobot-rekap/*') ? 'block;' : 'none;' }}">
            <li class="nav-item">
                <a href="{{ Route('rekap-bobot-kepemimpinan') }}" class="nav-link {{ Route::currentRouteName() == 'rekap-bobot-kepemimpinan' ? 'active' : '' }}">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Kepemimpinan</p>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ Route('rekap-bobot-perilaku') }}" class="nav-link {{ Route::currentRouteName() == 'rekap-bobot-perilaku' ? 'active' : '' }}">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Perilaku</p>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ Route('rekap-bobot-sasaran') }}" class="nav-link {{ Route::currentRouteName() == 'rekap-bobot-sasaran' ? 'active' : '' }}">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Sasaran</p>
                </a>
            </li>
            </ul>
        </li>
    </ul>
    -->
  <ul class="nav nav-treeview"
      style="display: block;">
    <li class="nav-item {{ request()->is('penilai-rekap-all') ? 'menu-is-opening menu-open' : '' }}">
      <a href="#"
         class="nav-link">
        <i class="nav-icon fas fa-circle"></i>
        <p> Rekap Nilai<i class="right fas fa-angle-left"></i></p>
      </a>
      <ul class="nav nav-treeview"
          style="display: {{ request()->is('penilai-rekap/*') ? 'block;' : 'none;' }}">
        <li class="nav-item">
          <a href="{{ Route('penilai-rekap-all') }}"
             class="nav-link {{ Route::currentRouteName() == 'penilai-rekap-all' ? 'active' : '' }}">
            <i class="far fa-circle nav-icon"></i>
            <p>Total Skor DP3</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="{{ route('penilai-rekap-personal') }}"
             class="nav-link {{ Route::currentRouteName() == 'penilai-rekap-personal' ? 'active' : '' }}">
            <i class="far fa-circle nav-icon"></i>
            <p>Rekap Personal</p>
          </a>
        </li>
        <!--
            <li class="nav-item">
                <a href="{{ Route('penilai-rekap-self') }}" class="nav-link {{ Route::currentRouteName() == 'penilai-rekap-self' ? 'active' : '' }}">
                    <i class="far fa-circle nav-icon"></i>
                    <p>DP3 Self</p>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ Route('penilai-rekap-atasan') }}" class="nav-link {{ Route::currentRouteName() == 'penilai-rekap-atasan' ? 'active' : '' }}">
                    <i class="far fa-circle nav-icon"></i>
                    <p>DP3 Atasan</p>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ Route('penilai-rekap-rekanan') }}" class="nav-link {{ Route::currentRouteName() == 'penilai-rekap-rekanan' ? 'active' : '' }}">
                    <i class="far fa-circle nav-icon"></i>
                    <p>DP3 Rekan</p>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ Route('penilai-rekap-staff') }}" class="nav-link {{ Route::currentRouteName() == 'penilai-rekap-staff' ? 'active' : '' }}">
                    <i class="far fa-circle nav-icon"></i>
                    <p>DP3 Staff</p>
                </a>
            </li>
            -->
      </ul>
    </li>
  </ul>
</li>
<!--
<li class="nav-header">INTERFACE 3</li>
<li class="nav-item">
    <a href="{{ route('penilai-rekap-personal') }}" class="nav-link {{ Route::currentRouteName() == 'penilai-rekap-personal' ? 'active' : '' }}">
        <i class="nav-icon fas fa-square"></i>
        <p>Rekap Personal</p>
    </a>
</li>
-->
<!-- <li class="nav-header">INTERFACE 3</li>
<li class="nav-item">
    <a href="{{ route('rekap-personal') }}" class="nav-link {{ Route::currentRouteName() == 'rekap-personal' ? 'active' : '' }}">
        <i class="nav-icon fas fa-square"></i>
        <p>Rekap Personal</p>
    </a>
</li> -->
