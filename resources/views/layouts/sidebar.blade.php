<div class="main-sidebar">
    <aside id="sidebar-wrapper">
      <div class="sidebar-brand">
        {{-- <a href="index.html">Management Kos</a> --}}
        {{-- <p class="text-center mb-0">Hi, {{Auth::user()->nama}}</p>
        <p class="text-center mb-0">Login sebagai <b> {{userRole()}} </b></p> --}}
 <img class="img-fluid" src="{{asset('images/logo.jpeg')}}" alt="Responsive image" width="150" height="150">
      </div>
      {{-- <hr> --}}
      <div class="sidebar-brand sidebar-brand-sm">
        {{-- <a href="index.html">KOST</a> --}}
      </div>
      <ul class="sidebar-menu">
          <li class="menu-header">Main Menu</li>

            <li class="nav-item dropdown {{isActive('dashboard')}}">
              <a href="{{route('dashboard.index')}}" class="nav-link"><i class="fas fa-fire"></i><span>Dashboard</span></a>
            </li>

            @if (userRole() == 'owner')
              <li class="nav-item dropdown {{isActive('user')}}">
                <a href="{{route('user.index')}}" class="nav-link"><i class="fas fa-users"></i><span>User</span></a>
              </li>
            @endif

            <li class="nav-item dropdown {{isActive('kost')}}">
              <a href="{{route('kost.index')}}" class="nav-link"><i class="fas fa-home"></i><span>Kos</span></a>
            </li>

            {{-- <li class="nav-item dropdown {{isActive('kamar')}}">
              <a href="{{route('kamar.index')}}" class="nav-link"><i class="fas fa-door-open"></i><span>Kamar</span></a>
            </li> --}}

            <li class="nav-item dropdown {{isActive('penyewa') }} {{isActive('sewa')}}">
              <a href="#" class="nav-link has-dropdown"><i class="fas fa-users"></i><span>Sewa</span></a>
              <ul class="dropdown-menu">
                <li class="{{isActive('sewa')}}"> <a href="{{route('sewa.index')}}" class="nav-link">Sewa</a> </li>
                <li class="{{isActive('penyewa')}}"> <a href="{{route('penyewa.index')}}" class="nav-link">Penyewa</a> </li>
              </ul>
            </li>

            <li class="nav-item dropdown {{isActive('jenis-pemasukan') }} {{isActive('pemasukan')}}">
              <a href="#" class="nav-link has-dropdown"><i class="fas fa-users"></i><span>Pemasukan</span></a>
              <ul class="dropdown-menu">
                <li class="{{isActive('jenis-pemasukan')}}"> <a href="{{route('jenis_pemasukan.index')}}" class="nav-link">Jenis Pemasukan</a> </li>
                <li class="{{isActive('pemasukan')}}"> <a href="{{route('pemasukan.index')}}" class="nav-link">Pemasukan</a> </li>
              </ul>
            </li>

            @if (userRole() != 'pegawai')
              <li class="nav-item dropdown {{isActive('jenis-pengeluaran') }} {{isActive('pengeluaran')}}">
                <a href="#" class="nav-link has-dropdown"><i class="fas fa-users"></i><span>Pengeluaran</span></a>
                <ul class="dropdown-menu">
                  <li class="{{isActive('jenis-pengeluaran')}}"> <a href="{{route('jenis_pengeluaran.index')}}" class="nav-link">Jenis Pengeluaran</a> </li>
                  <li class="{{isActive('pengeluaran')}}"> <a href="{{route('pengeluaran.index')}}" class="nav-link">Pengeluaran</a> </li>
                </ul>
              </li>
            @endif

          @if (userRole() == 'manager')
            <li class="menu-header">Validasi Data</li>
            
            <li class="nav-item dropdown {{isActive('validasi')}}">
              <a href="{{route('validasi.index', 'sewaTab')}}" class="nav-link"><i class="fas fa-check-square"></i><span>Validasi Data</span></a>
            </li>
          @endif

        </ul>

    </aside>
  </div>