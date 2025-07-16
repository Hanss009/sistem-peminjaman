 <!-- Brand Logo -->
 <a href="../../index3.html" class="brand-link">
   <img src="{{ asset('/logoykpi.jpeg')}}" alt="AdminLTE Logo"
     class="brand-image img-circle elevation-3" style="width: 50px; height: 50px; opacity: .9;">
   <span class="brand-text font-weight-bold" style="font-size: 18px;">
     YKPI Al-Ittihad
   </span>
 </a>

 <!-- logo user -->
 @php
 $user = Auth::user();
 @endphp

 <div class="user-panel mt-3 pb-3 mb-3 d-flex">
   <div class="image">
     <img src="{{ $user->foto ? asset('storage/foto/' . $user->foto) : asset('front/dist/img/user2-160x160.jpg') }}"
       class="img-circle elevation-2" alt="User Image" style="width: 40px; height: 40px; object-fit: cover;">
   </div>
   <div class="info">
     <a href="#" class="d-block">{{ $user->name }}</a>
   </div>
 </div>



 <nav class="mt-2">
   <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

     @php
     $role = Auth::user()->role;
     @endphp

     <li class="nav-item">
       <a href="{{ url('dashboard') }}" class="nav-link {{ request()->is('dashboard') ? 'active' : '' }}">
         <i class="nav-icon fas fa-tachometer-alt"></i>
         <p>Dashboard</p>
       </a>
     </li>

     <li class="nav-header">PEMINJAMAN</li>

     <li class="nav-item">
       <a href="{{ url('/peminjaman') }}" class="nav-link {{ request()->is('peminjaman') ? 'active' : '' }}">
         <i class="nav-icon fas fa-key"></i>
         <p>Pinjam Kendaraan</p>
       </a>
     </li>

     <li class="nav-item">
       <a href="{{ url('/peminjaman_aset') }}" class="nav-link {{ request()->is('peminjaman_aset') ? 'active' : '' }}">
         <i class="nav-icon fas fa-box"></i>
         <p>Pinjam Aset</p>
       </a>
     </li>

     {{-- KELOLA --}}
     @if(in_array($role, ['admin', 'gs']))
     <li class="nav-header">KELOLA</li>

     <li class="nav-item">
       <a href="{{ url('/admin') }}" class="nav-link {{ request()->is('admin') ? 'active' : '' }}">
         <i class="nav-icon fas fa-user"></i>
         <p>User</p>
       </a>
     </li>

     <li class="nav-item">
       <a href="{{ url('/kendaraan') }}" class="nav-link {{ request()->is('kendaraan') ? 'active' : '' }}">
         <i class="nav-icon fas fa-car"></i>
         <p>Kendaraan</p>
       </a>
     </li>

     <li class="nav-item">
       <a href="{{ url('/aset') }}" class="nav-link {{ request()->is('aset') ? 'active' : '' }}">
         <i class="nav-icon fas fa-copy"></i>
         <p>Aset</p>
       </a>
     </li>
     @endif

     {{-- LAPORAN --}}
     @if(in_array($role, ['admin', 'gs']))
     <li class="nav-header">LAPORAN</li>

     <li class="nav-item">
       <a href="{{ url('/laporan/peminjaman') }}" class="nav-link {{ request()->is('laporan/peminjaman') ? 'active' : '' }}">
         <i class="nav-icon fas fa-folder"></i>
         <p>Peminjaman Kendaraan</p>
       </a>
     </li>

     <li class="nav-item">
       <a href="{{ url('/laporan/peminjaman_aset') }}" class="nav-link {{ request()->is('laporan/peminjaman_aset') ? 'active' : '' }}">
         <i class="nav-icon fas fa-folder"></i>
         <p>Peminjaman Aset</p>
       </a>
     </li>
     @endif

     <li class="nav-header">RIWAYAT</li>

     <li class="nav-item">
       <a href="{{ url('/riwayat-peminjaman-kendaraan') }}" class="nav-link {{ request()->is('riwayat-peminjaman-kendaraan') ? 'active' : '' }}">
         <i class="nav-icon 	fas fa-history"></i>
         <p>Peminjaman Kendaraan</p>
       </a>
     </li>

     <li class="nav-item">
       <a href="{{ url('/riwayat-peminjaman-aset') }}" class="nav-link {{ request()->is('riwayat-peminjaman-aset') ? 'active' : '' }}">
         <i class="nav-icon fas fa-history"></i>
         <p>Peminjaman Aset</p>
       </a>
     </li>

     <li class="nav-item mt-2">
       <a href="{{ route('logout') }}" class="nav-link"
         onclick="event.preventDefault(); 
              if(confirm('Apakah Anda yakin ingin logout?')) {
                document.getElementById('logout-form').submit();
              }">
         <i class="nav-icon fas fa-sign-out-alt"></i>
         <p>Logout</p>
       </a>

       <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
         @csrf
       </form>
     </li>



   </ul>
 </nav>