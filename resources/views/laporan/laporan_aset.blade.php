<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Peminjaman Aset</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('front/plugins/fontawesome-free/css/all.min.css')}}">
    <!-- DataTables -->
    <link rel="stylesheet" href="{{ asset('front/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')}}">
    <link rel="stylesheet" href="{{ asset('front/plugins/datatables-responsive/css/responsive.bootstrap4.min.css')}}">
    <link rel="stylesheet" href="{{ asset('front/plugins/datatables-buttons/css/buttons.bootstrap4.min.css')}}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('front/dist/css/adminlte.min.css')}}">
</head>

<body class="hold-transition sidebar-mini">
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
            <section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1>Laporan Peminjaman Aset</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item active">Laporan Peminjaman</li>
                            </ol>
                        </div>
                    </div>
                </div><!-- /.container-fluid -->
            </section>

            <!-- Main content -->
            <section class="content">
                <div class="container">

                    <form method="GET" action="{{ route('laporan.peminjaman') }}" class="mb-4">
                        <div class="row">
                            <div class="col-md-4">
                                <label>Tanggal Awal</label>
                                <input type="date" name="tanggal_awal" class="form-control" value="{{ request('tanggal_awal') }}">
                            </div>
                            <div class="col-md-4">
                                <label>Tanggal Akhir</label>
                                <input type="date" name="tanggal_akhir" class="form-control" value="{{ request('tanggal_akhir') }}">
                            </div>
                            <div class="col-md-4 mt-4">
                                <button type="submit" class="btn btn-primary mt-2">Filter</button>
                                <a href="{{ route('laporan.peminjaman_aset') }}" class="btn btn-secondary mt-2">Reset</a>
                            </div>
                        </div>
                    </form>
                    <table id="example1" class="table table-bordered table-striped">
                        <thead class="thead-dark">
                            <tr>
                                <th>No</th>
                                <th>Nama User</th>
                                <th>Aset</th>
                                <th>Waktu Awal Pinjam</th>
                                <th>Waktu Akhir Pinjam</th>
                                <th>Tujuan</th>
                                <th>Waktu Kembali</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($data as $item)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $item->user->name ?? '-' }}</td>
                                <td>{{ $item->aset->nama_aset ?? '-' }}</td>
                                <td>{{ date('d-m-Y H:i', strtotime($item->tgl_awal_pinjam)) }}</td>
                                <td>{{ date('d-m-Y H:i', strtotime($item->tgl_akhir_pinjam)) }}</td>
                                <td>{{ $item->keperluan }}</td>
                                <td>{{ $item->tgl_kembali }}</td>
                                <td>
                                    <span class="badge badge-{{ match($item->status) {
                        'disetujui' => 'success',
                        'tidak_disetujui' => 'danger',
                        'sedang_digunakan' => 'warning',
                        'selesai' => 'info',
                        'menunggu_approval', 'pending' => 'secondary',
                        default => 'dark',
                    } }}">
                                        {{ ucfirst(str_replace('_', ' ', $item->status)) }}
                                    </span>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="6" class="text-center">Tidak ada data peminjaman</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
        </section>
        <!-- /.content -->
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
    <script src="{{ asset('front/plugins/jquery/jquery.min.js')}}"></script>
    <!-- Bootstrap 4 -->
    <script src="{{ asset('front/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
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
    <!-- AdminLTE App -->
    <script src="{{ asset('front/dist/js/adminlte.min.js')}}"></script>
    <!-- AdminLTE for demo purposes -->

    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


    <!-- Page specific script -->
    <script>
        $(function() {
            $("#example1").DataTable({
                "responsive": true,
                "lengthChange": false,
                "autoWidth": false,
                "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
            }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
            $('#example2').DataTable({
                "paging": true,
                "lengthChange": false,
                "searching": false,
                "ordering": true,
                "info": true,
                "autoWidth": false,
                "responsive": true,
            });
        });
    </script>

    {{-- perbesar foto saat di klik --}}
    <script>
        $(document).ready(function() {
            $('#fotoModal').on('show.bs.modal', function(event) {
                var img = $(event.relatedTarget) // gambar yang diklik
                var src = img.data('img') // ambil URL gambar dari attribute data-img
                var modal = $(this)
                modal.find('#modalImage').attr('src', src)
            })
        })
    </script>
    <script>
        // Fungsi hapus dengan SweetAlert2
        function deleteUser(id) {
            Swal.fire({
                title: 'Yakin ingin menghapus?',
                text: "Data yang dihapus tidak bisa dikembalikan!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Ya, hapus!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById(`delete-form-${id}`).submit();
                }
            });
        }
    </script>

    @if(session('success'))
    <script>
        Swal.fire({
            icon: 'success',
            title: 'Berhasil',
            text: '{{ session("success") }}',
            timer: 2000,
            showConfirmButton: false
        });
    </script>
    @endif

</body>

</html>