<div class="main-sidebar">
    <aside id="sidebar-wrapper">
      <div class="sidebar-brand">
        <a href="index.html">LH 44</a>
      </div>
      <div class="sidebar-brand sidebar-brand-sm">
        <a href="index.html">St</a>
      </div>
      <ul class="sidebar-menu">
          <li class="menu-header">Main Menu</li>
          
          <li class="nav-item dropdown {{isActive('*dashboard*')}}">
            <a href="{{route('dashboard.index')}}" class="nav-link"><i class="fas fa-fire"></i><span>Dashboard</span></a>
          </li>

          <li class="nav-item dropdown {{isActive('*kost*')}}">
            <a href="{{route('kost.index')}}" class="nav-link"><i class="fas fa-home"></i><span>Kost</span></a>
          </li>

          <li class="nav-item dropdown {{isActive('*kamar*')}}">
            <a href="{{route('kamar.index')}}" class="nav-link"><i class="fas fa-door-open"></i><span>Kamar</span></a>
          </li>

          <li class="nav-item dropdown {{isActive('*pembayaran*')}}">
            <a href="{{route('pembayaran.index')}}" class="nav-link"><i class="fas fa-receipt"></i><span>Pembayaran</span></a>
          </li>

          <li class="nav-item dropdown {{isActive('*pengeluaran*')}}">
            <a href="{{route('pengeluaran.index')}}" class="nav-link"><i class="far fa-credit-card"></i><span>Pengeluaran</span></a>
          </li>
          
          <li class="menu-header">Extra</li>
          <li class="nav-item dropdown {{isActive('*jenis-pembayaran*')}}">
            <a href="{{route('jenis_pembayaran.index')}}" class="nav-link"><i class="fas fa-list-ul"></i><span>Jenis Pembayaran</span></a>
          </li>

          <li class="nav-item dropdown {{isActive('*jenis-pengeluaran*')}}">
            <a href="{{route('jenis_pengeluaran.index')}}" class="nav-link"><i class="fas fa-list-ul"></i><span>Jenis Pengeluaran</span></a>
          </li>

        </ul>

    </aside>
  </div>