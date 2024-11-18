<nav class="navbarx" id="sidebar">
  <a href="/" class="top_navbar text-decoration-none">
    <div class="text_logo">
      E-Lapor
    </div>
  </a>
  <div class="mid_navbar">
    <ul class="sidebar-nav w-100">
      <li class="nav-item mb-2">
        <a href="{{ route('dashboard.index') }}"
          class="nav-link nav-link-custom text-decoration-none {{Request::is('*dashboard*') ? 'active-nav-link' : ''}}">
          <div class="list_nav">
            <i class="ri ri-dashboard-2-line iconSidebarList"></i>
            <div class="{{Request::is('*dashboard*') ? 'active-nav-link-text' : ''}}">
              Dashboard
            </div>
          </div>
        </a>
      </li>

      {{-- Program --}}
      <li class="nav-title-custom">Program</li>
      <li class="nav-item">
        <a href="{{ route('program.index') }}"
          class="nav-link nav-link-custom {{Request::is('*program*') ? 'active-nav-link' : ''}} text-decoration-none">
          <div class="list_nav">
            <i class="ri ri-computer-line iconSidebarList"></i>
            <div class="{{Request::is('*program*') ? 'active-nav-link-text' : ''}}">
              Data Program
            </div>
          </div>
        </a>
      </li>
      <li class="nav-item">
        <a href="{{ route('indikator.index') }}"
          class="nav-link nav-link-custom {{ Request::is('back-office/indikator') || Request::is('back-office/realisasi*') ? 'active-nav-link' : '' }} text-decoration-none">
          <div class="list_nav">
            <i class="ri ri-line-chart-line iconSidebarList"></i>
            <div
              class="{{ Request::is('back-office/indikator') || Request::is('back-office/realisasi*') ? 'active-nav-link-text' : '' }}">
              Indikator Program
            </div>
          </div>
        </a>
      </li>

      {{-- Kegiatan --}}
      <li class="nav-title-custom">Kegiatan</li>
      <li class="nav-item">
        <a href="{{ route('kegiatan.index') }}"
          class="nav-link nav-link-custom {{ Request::is('back-office/kegiatan') ? 'active-nav-link' : '' }} text-decoration-none">
          <div class="list_nav">
            <i class="ri ri-database-line iconSidebarList"></i>
            <div class="{{ Request::is('back-office/kegiatan') ? 'active-nav-link-text' : '' }}">
              Kegiatan
            </div>
          </div>
        </a>
      </li>
      <li class="nav-item">
        <a href="{{ route('indikatorKegiatan.index') }}"
          class="nav-link nav-link-custom {{ Request::is('back-office/indikator-kegiatan*')|| Request::is('back-office/kegiatan-realisasi') ? 'active-nav-link' : '' }} text-decoration-none">
          <div class="list_nav">
            <i class="ri ri-line-chart-line iconSidebarList"></i>
            <div
              class="{{ Request::is('back-office/indikator-kegiatan') || Request::is('back-office/kegiatan-realisasi') ? 'active-nav-link-text' : '' }}">
              Indikator Kegiatan
            </div>
          </div>
        </a>
      </li>


      {{-- Sub Kegiatan --}}
      <li class="nav-title-custom">Sub Kegiatan</li>
      <li class="nav-item">
        <a href="{{ route('subKegiatan.index') }}"
          class="nav-link nav-link-custom {{Request::is('back-office/sub-kegiatan') ? 'active-nav-link' : ''}} text-decoration-none">
          <div class="list_nav">
            <i class="ri ri-folder-line iconSidebarList"></i>
            <div class="{{Request::is('back-office/sub-kegiatan') ? 'active-nav-link-text' : ''}}">
              Sub Kegiatan
            </div>
          </div>
        </a>
      </li>
      <li class="nav-item">
        <a href="{{ route('indikatorSubKegiatan.index') }}"
          class="nav-link nav-link-custom {{Request::is('*indikator-sub-kegiatan') || Request::is('back-office/sub-kegiatan-realisasi') ? 'active-nav-link' : ''}} text-decoration-none">
          <div class="list_nav">
            <i class="ri ri-line-chart-line iconSidebarList"></i>
            <div class="{{Request::is('*indikator-sub-kegiatan') || Request::is('back-office/sub-kegiatan-realisasi') ? 'active-nav-link-text' : ''}}">
              Indikator Sub Kegiatan
            </div>
          </div>
        </a>
      </li>

      {{-- Laporan --}}
      <li class="nav-title-custom">Laporan</li>
      <li class="nav-item">
        <a href="{{ route('cetakLaporan.index') }}"
          class="nav-link nav-link-custom {{Request::is('*cetak-laporan*') ? 'active-nav-link' : ''}} text-decoration-none">
          <div class="list_nav">
            <i class="ri ri-printer-line iconSidebarList"></i>
            <div class="{{Request::is('*cetak-laporan*') ? 'active-nav-link-text' : ''}}">
              Cetak Laporan
            </div>
          </div>
        </a>
      </li>

      <li class="nav-title-custom">Pengaturan</li>
      <li class="nav-item">
        <a href="{{ route('bidang.index') }}"
          class="nav-link nav-link-custom {{Request::is('*bidang*') ? 'active-nav-link' : ''}} text-decoration-none">
          <div class="list_nav">
            <i class="ri-building-3-line iconSidebarList"></i>
            <div class="{{Request::is('*bidang*') ? 'active-nav-link-text' : ''}}">
              Data Bidang
            </div>
          </div>
        </a>
      </li>
      <li class="nav-item">
        <a href="{{ route('satuan.index') }}"
          class="nav-link nav-link-custom {{Request::is('*satuan*') ? 'active-nav-link' : ''}} text-decoration-none">
          <div class="list_nav">
            <i class="ri-weight-line iconSidebarList"></i>
            <div class="{{Request::is('*satuan*') ? 'active-nav-link-text' : ''}}">
              Data Satuan
            </div>
          </div>
        </a>
      </li>
      <li class="nav-item">
        <a href="{{ route('triwulan.index') }}"
          class="nav-link nav-link-custom {{Request::is('*triwulan*') ? 'active-nav-link' : ''}} text-decoration-none">
          <div class="list_nav">
            <i class="ri-time-line iconSidebarList"></i>
            <div class="{{Request::is('*triwulan*') ? 'active-nav-link-text' : ''}}">
              Data Triwulan
            </div>
          </div>
        </a>
      </li>
      <li class="nav-item">
        <a href="{{ route('puskesmas.index') }}"
          class="nav-link nav-link-custom {{Request::is('*puskesmas*') ? 'active-nav-link' : ''}} text-decoration-none">
          <div class="list_nav">
            <i class="ri-community-line iconSidebarList"></i>
            <div class="{{Request::is('*puskesmas*') ? 'active-nav-link-text' : ''}}">
              Data Puskesmas
            </div>
          </div>
        </a>
      </li>
      <li class="nav-item">
        <a href="{{ route('user.index') }}"
          class="nav-link nav-link-custom {{Request::is('*user*') ? 'active-nav-link' : ''}} text-decoration-none">
          <div class="list_nav">
            <i class="ri ri-user-line iconSidebarList"></i>
            <div class="{{Request::is('*user*') ? 'active-nav-link-text' : ''}}">
              User
            </div>
          </div>
        </a>
      </li>
    </ul>
  </div>
  @include('layouts.components.logout-modal')

  <div class="bottom_navbar">
    {{-- <form action="{{ route('logout') }}" method="POST">
      @csrf
    </form> --}}
    <button class="btn btn_logout d-flex align-items-center column-gap-1" id="buttonOpenLogout">
      <div class="" style="font-size: 1rem; font-weight: 400; line-height: 1.5rem">
        Logout
      </div>
      <i class="ri-logout-box-line"></i>
    </button>
  </div>
</nav>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>
<script type="text/javascript">
  $(document).ready(function() {
    // Save data is open collapse to session storage
    const isCollapse = sessionStorage.getItem('isCollapseDataMaster')
    if(!isCollapse) {
      sessionStorage.setItem('isCollapseDataMaster', 'hide')
    }
    $("#collapseDataMaster").on("hide.bs.collapse", function(){
      sessionStorage.setItem('isCollapseDataMaster', 'hide')
    });

    $("#collapseDataMaster").on("show.bs.collapse", function(){
      sessionStorage.setItem('isCollapseDataMaster', 'show')
    });

    $('#collapseDataMaster').collapse(isCollapse ? isCollapse : 'hide')

    $('#buttonOpenLogout').on('click', function() {
      $('#ModalLogout').modal('show')
    })
  })



</script>
