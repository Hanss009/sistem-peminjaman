<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Dashboard</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{ asset ('front/plugins/fontawesome-free/css/all.min.css')}}">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Tempusdominus Bootstrap 4 -->
  <link rel="stylesheet" href="{{ asset ('front/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css')}}">
  <!-- iCheck -->
  <link rel="stylesheet" href="{{ asset ('front/plugins/icheck-bootstrap/icheck-bootstrap.min.css')}}">
  <!-- JQVMap -->
  <link rel="stylesheet" href="{{ asset ('front/plugins/jqvmap/jqvmap.min.css')}}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ asset ('front/dist/css/adminlte.min.css')}}">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="{{ asset ('front/plugins/overlayScrollbars/css/OverlayScrollbars.min.css')}}">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="{{ asset ('front/plugins/daterangepicker/daterangepicker.css')}}">
  <!-- summernote -->
  <link rel="stylesheet" href="{{ asset ('front/plugins/summernote/summernote-bs4.min.css')}}">
</head>

<body class="hold-transition sidebar-mini layout-fixed">
  <div class="wrapper">


    <!-- Navbar -->
    @include ('layout.navbar')
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4">


      <!-- Sidebar -->
      <div class="sidebar">
        <!-- Sidebar Menu -->
        @include ('layout.sidebar')
        <!-- /.sidebar-menu -->
      </div>
      <!-- /.sidebar -->
    </aside>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <div class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1 class="m-0">Dashboard</h1>
            </div>
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active">Dashboard</li>
              </ol>
            </div>
          </div>
        </div>
      </div>

      <!-- Main content -->
      <section class="content">
        <div class="container-fluid">

          <h4 class="mb-3 pb-2 border-bottom">Dashboard Peminjaman Kendaraan</h4>
          <div class="row">
            <div class="col-lg-3 col-6">
              <div class="small-box bg-info shadow rounded p-2" style="transition: transform 0.3s;" onmouseover="this.style.transform='scale(1.05)'" onmouseout="this.style.transform='scale(1)'">
                <div class="inner text-center">
                  <h3>{{ $totalPeminjamanKendaraan }}</h3>
                  <p>Total Peminjaman</p>
                </div>
                <div class="icon"><i class="ion ion-model-s"></i></div>
              </div>
            </div>
            <div class="col-lg-3 col-6">
              <div class="small-box bg-success shadow rounded p-2" style="transition: transform 0.3s;" onmouseover="this.style.transform='scale(1.05)'" onmouseout="this.style.transform='scale(1)'">
                <div class="inner text-center">
                  <h3>{{ $totalDisetujuiKendaraan }}</h3>
                  <p>Disetujui</p>
                </div>
                <div class="icon"><i class="ion ion-checkmark"></i></div>
              </div>
            </div>
            <div class="col-lg-3 col-6">
              <div class="small-box bg-warning shadow rounded p-2" style="transition: transform 0.3s;" onmouseover="this.style.transform='scale(1.05)'" onmouseout="this.style.transform='scale(1)'">
                <div class="inner text-center">
                  <h3>{{ $totalKembaliKendaraan }}</h3>
                  <p>Kembali</p>
                </div>
                <div class="icon"><i class="ion ion-android-archive"></i></div>
              </div>
            </div>
            <div class="col-lg-3 col-6">
              <div class="small-box bg-danger shadow rounded p-2" style="transition: transform 0.3s;" onmouseover="this.style.transform='scale(1.05)'" onmouseout="this.style.transform='scale(1)'">
                <div class="inner text-center">
                  <h3>{{ $totalDitolakKendaraan }}</h3>
                  <p>Ditolak</p>
                </div>
                <div class="icon"><i class="ion ion-close"></i></div>
              </div>
            </div>
          </div>

          <h4 class="mt-4 mb-3 pb-2 border-bottom">Dashboard Peminjaman Aset</h4>
          <div class="row">
            <div class="col-lg-3 col-6">
              <div class="small-box bg-primary shadow rounded p-2" style="transition: transform 0.3s;" onmouseover="this.style.transform='scale(1.05)'" onmouseout="this.style.transform='scale(1)'">
                <div class="inner text-center">
                  <h3>{{ $totalPeminjamanAset }}</h3>
                  <p>Total Peminjaman</p>
                </div>
                <div class="icon"><i class="ion ion-archive"></i></div>
              </div>
            </div>
            <div class="col-lg-3 col-6">
              <div class="small-box bg-teal shadow rounded p-2" style="transition: transform 0.3s;" onmouseover="this.style.transform='scale(1.05)'" onmouseout="this.style.transform='scale(1)'">
                <div class="inner text-center">
                  <h3>{{ $totalDisetujuiAset }}</h3>
                  <p>Disetujui</p>
                </div>
                <div class="icon"><i class="ion ion-checkmark"></i></div>
              </div>
            </div>
            <div class="col-lg-3 col-6">
              <div class="small-box bg-orange shadow rounded p-2" style="transition: transform 0.3s;" onmouseover="this.style.transform='scale(1.05)'" onmouseout="this.style.transform='scale(1)'">
                <div class="inner text-center">
                  <h3>{{ $totalKembaliAset }}</h3>
                  <p>Kembali</p>
                </div>
                <div class="icon"><i class="ion ion-android-archive"></i></div>
              </div>
            </div>
            <div class="col-lg-3 col-6">
              <div class="small-box bg-maroon shadow rounded p-2" style="transition: transform 0.3s;" onmouseover="this.style.transform='scale(1.05)'" onmouseout="this.style.transform='scale(1)'">
                <div class="inner text-center">
                  <h3>{{ $totalDitolakAset }}</h3>
                  <p>Ditolak</p>
                </div>
                <div class="icon"><i class="ion ion-close"></i></div>
              </div>
            </div>
          </div>

          <div class="row mt-4">
            <div class="col-md-6">
              <h4 class="mb-3 pb-2 border-bottom">Daftar Kendaraan</h4>
              <div class="table-responsive shadow-sm rounded">
                <table id="tableKendaraan" class="table table-bordered table-striped table-hover">
                  <thead>
                    <tr>
                      <th class="text-center">No</th>
                      <th>Nama</th>
                      <th>Plat Nomor</th>
                      <th class="text-center">Status</th>
                    </tr>
                  </thead>
                  <tbody>
                    @forelse($kendaraanSedangDipakai as $item)
                    <tr>
                      <td class="text-center">{{ $loop->iteration }}</td>
                      <td>{{ $item->nama_kendaraan }}</td>
                      <td>{{ $item->plat_nomor }}</td>
                      <td class="text-center"><span class="badge badge-warning px-2 py-1">Sedang Dipakai</span></td>
                    </tr>
                    @empty
                    @endforelse

                    @foreach($kendaraanTersedia as $item)
                    <tr>
                      <td class="text-center">{{ $loop->iteration + count($kendaraanSedangDipakai) }}</td>
                      <td>{{ $item->nama_kendaraan }}</td>
                      <td>{{ $item->plat_nomor }}</td>
                      <td class="text-center"><span class="badge badge-success px-2 py-1">Tersedia</span></td>
                    </tr>
                    @endforeach

                    @if(count($kendaraanSedangDipakai) === 0 && count($kendaraanTersedia) === 0)
                    <tr>
                      <td colspan="4" class="text-center">Tidak ada kendaraan terdaftar</td>
                    </tr>
                    @endif
                  </tbody>
                </table>
              </div>
            </div>

            <div class="col-md-6">
              <h4 class="mb-3 pb-2 border-bottom">Daftar Aset</h4>
              <div class="table-responsive shadow-sm rounded">
                <table id="tableAset" class="table table-bordered table-striped table-hover">
                  <thead>
                    <tr>
                      <th class="text-center">No</th>
                      <th>Nama</th>
                      <th>Kode</th>
                      <th class="text-center">Status</th>
                    </tr>
                  </thead>
                  <tbody>
                    @forelse($asetSedangDipakai as $item)
                    <tr>
                      <td class="text-center">{{ $loop->iteration }}</td>
                      <td>{{ $item->nama_aset }}</td>
                      <td>{{ $item->no_aset }}</td>
                      <td class="text-center"><span class="badge badge-warning px-2 py-1">Sedang Dipakai</span></td>
                    </tr>
                    @empty
                    @endforelse

                    @foreach($asetTersedia as $item)
                    <tr>
                      <td class="text-center">{{ $loop->iteration + count($asetSedangDipakai) }}</td>
                      <td>{{ $item->nama_aset }}</td>
                      <td>{{ $item->no_aset}}</td>
                      <td class="text-center"><span class="badge badge-success px-2 py-1">Tersedia</span></td>
                    </tr>
                    @endforeach

                    @if(count($asetSedangDipakai) === 0 && count($asetTersedia) === 0)
                    <tr>
                      <td colspan="4" class="text-center">Tidak ada aset terdaftar</td>
                    </tr>
                    @endif
                  </tbody>
                </table>
              </div>
            </div>
          </div>

        </div>
      </section>
    </div>

    <!-- /.content-wrapper -->
    @include('layout.footer')

    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
      <!-- Control sidebar content goes here -->
    </aside>
    <!-- /.control-sidebar -->
  </div>
  <!-- ./wrapper -->

  <!-- jQuery -->
  <script src="{{ asset ('front/plugins/jquery/jquery.min.js')}}"></script>
  <!-- jQuery UI 1.11.4 -->
  <script src="{{ asset ('front/plugins/jquery-ui/jquery-ui.min.js')}}"></script>
  <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
  <script>
    $.widget.bridge('uibutton', $.ui.button)
  </script>
  <!-- Bootstrap 4 -->
  <script src="{{ asset ('front/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
  <!-- ChartJS -->
  <script src="{{ asset ('front/plugins/chart.js/Chart.min.js')}}"></script>
  <!-- Sparkline -->
  <script src="{{ asset ('front/plugins/sparklines/sparkline.js')}}"></script>
  <!-- JQVMap -->
  <script src="{{ asset ('front/plugins/jqvmap/jquery.vmap.min.js')}}"></script>
  <script src="{{ asset ('front/plugins/jqvmap/maps/jquery.vmap.usa.js')}}"></script>
  <!-- jQuery Knob Chart -->
  <script src="{{ asset ('front/plugins/jquery-knob/jquery.knob.min.js')}}"></script>
  <!-- daterangepicker -->
  <script src="{{ asset ('front/plugins/moment/moment.min.js')}}"></script>
  <script src="{{ asset ('front/plugins/daterangepicker/daterangepicker.js')}}"></script>
  <!-- Tempusdominus Bootstrap 4 -->
  <script src="{{ asset ('front/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js')}}"></script>
  <!-- Summernote -->
  <script src="{{ asset ('front/plugins/summernote/summernote-bs4.min.js')}}"></script>
  <!-- overlayScrollbars -->
  <script src="{{ asset ('front/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js')}}"></script>
  <!-- AdminLTE App -->
  <script src="{{ asset ('front/dist/js/adminlte.js')}}"></script>
  <!-- AdminLTE for demo purposes -->

  <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
  <script src="{{ asset ('front/dist/js/pages/dashboard.js')}}"></script>

  <!-- DataTables  & Plugins -->
  <script src="{{ asset('front/plugins/datatables/jquery.dataTables.min.js')}}"></script>
  <script src="{{ asset('front/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
  <script src="{{ asset('front/plugins/datatables-responsive/js/dataTables.responsive.min.js')}}"></script>
  <script src="{{ asset('front/plugins/datatables-responsive/js/responsive.bootstrap4.min.js')}}"></script>
  <script src="{{ asset('front/plugins/datatables-buttons/js/dataTables.buttons.min.js')}}"></script>
  <script src="{{ asset('front/plugins/datatables-buttons/js/buttons.bootstrap4.min.js')}}"></script>
  <script src="{{ asset('front/plugins/jszip/jszip.min.js')}}"></script>
  <script src="{{ asset('front/plugins/pdfmake/pdfmake.min.js')}}"></script>
  <script src="{{ asset('front/plugins/pdfmake/vfs_fonts.js')}}"></script>
  <script src="{{ asset('front/plugins/datatables-buttons/js/buttons.html5.min.js')}}"></script>
  <script src="{{ asset('front/plugins/datatables-buttons/js/buttons.print.min.js')}}"></script>
  <script src="{{ asset('front/plugins/datatables-buttons/js/buttons.colVis.min.js')}}"></script>


  <script>
    $(function() {
      $("#tableKendaraan").DataTable({
        "responsive": true,
        "lengthChange": true,
        "autoWidth": false,
      }).buttons().container().appendTo('#tableKendaraan_wrapper .col-md-6:eq(0)');

      $("#tableAset").DataTable({
        "responsive": true,
        "lengthChange": true,
        "autoWidth": false,
      }).buttons().container().appendTo('#tableAset_wrapper .col-md-6:eq(0)');
    });
  </script>
</body>

</html>