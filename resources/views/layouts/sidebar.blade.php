<div class="main-sidebar">
    <aside id="sidebar-wrapper">
      <div class="sidebar-brand">
        <a href="index.html">Management Kost</a>
        <p class="text-center mb-0">Hi, {{Auth::user()->nama}}</p>
        <p class="text-center mb-0">Login sebagai <b> {{userRole()}} </b></p>
      </div>
      <hr>
      <div class="sidebar-brand sidebar-brand-sm">
        <a href="index.html">KOST</a>
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
              <a href="{{route('kost.index')}}" class="nav-link"><i class="fas fa-home"></i><span>Kost</span></a>
            </li>

            <li class="nav-item dropdown {{isActive('kamar')}}">
              <a href="{{route('kamar.index')}}" class="nav-link"><i class="fas fa-door-open"></i><span>Kamar</span></a>
            </li>

            <li class="nav-item dropdown {{isActive('penyewa')}}">
              <a href="{{route('penyewa.index')}}" class="nav-link"><i class="fas fa-users"></i><span>Penyewa</span></a>
            </li>

            <li class="nav-item dropdown {{isActive('sewa')}}">
              <a href="{{route('sewa.index')}}" class="nav-link"><i class="fas fa-house-user"></i><span>Sewa</span></a>
            </li>

            <li class="nav-item dropdown {{isActive('pembayaran')}}">
              <a href="{{route('pembayaran.index')}}" class="nav-link"><i class="fas fa-receipt"></i><span>Pemasukan</span></a>
            </li>

            <li class="nav-item dropdown {{isActive('pengeluaran')}}">
              <a href="{{route('pengeluaran.index')}}" class="nav-link"><i class="far fa-credit-card"></i><span>Pengeluaran</span></a>
            </li>

          @if (userRole() == 'manager')
            <li class="menu-header">Validasi Data</li>
            
            <li class="nav-item dropdown {{isActive('validasi')}}">
              <a href="{{route('validasi.index', 'penyewaTab')}}" class="nav-link"><i class="fas fa-check-square"></i><span>Validasi Data</span></a>
            </li>
            
            <li class="menu-header">Extra</li>
            <li class="nav-item dropdown {{isActive('jenis-pembayaran')}}">
              <a href="{{route('jenis_pembayaran.index')}}" class="nav-link"><i class="fas fa-list-ul"></i><span>Jenis Pembayaran</span></a>
            </li>

            <li class="nav-item dropdown {{isActive('jenis-pengeluaran')}}">
              <a href="{{route('jenis_pengeluaran.index')}}" class="nav-link"><i class="fas fa-list-ul"></i><span>Jenis Pengeluaran</span></a>
            </li>
          @endif

        </ul>

    </aside>
  </div>