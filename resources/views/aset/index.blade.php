<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Data Aset</title>

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
                            <h1>Data Aset</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item active">DataTables</li>
                            </ol>
                        </div>
                    </div>
                </div><!-- /.container-fluid -->
            </section>

            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12">

                            <!-- /.card -->

                            <div class="card">
                                <div class="card-header">
                                    <a href="{{ url('aset/create') }}" class="btn btn-primary" data-toggle="modal"
                                        data-target="#modal-default">Tambah Data</a>

                                    <div class="my-3">
                                        @if ($errors->any())
                                        <div class="alert alert-danger">
                                            <ul>
                                                @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                                @endforeach
                                            </ul>
                                            @endif

                                            @if(session('success'))
                                            <div class="alert alert-success">
                                                {{ session('success') }}
                                            </div>
                                            @endif



                                        </div>
                                    </div>
                                </div>

                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead class="thead-dark">
                                        <tr>
                                            <th>No</th>
                                            <th>Nama Aset</th>
                                            <th>Tipe Aset</th>
                                            <th>Nomor Aset</th>
                                            <th>Status Aset</th>
                                            <th>foto Aset</th>

                                            <th>
                                                <center>Aksi</center>
                                            </th>


                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($aset as $item)
                                        <tr>
                                            <td> {{ $loop->iteration }}</td>
                                            <td> {{ $item->nama_aset}} </td>
                                            <td> {{ $item->tipe_aset}} </td>
                                            <td> {{ $item->no_aset}} </td>
                                            <td> {{ $item->status_aset }} </td>
                                            <td>
                                                @if ($item->foto_aset)
                                                <img src="{{ asset('storage/foto_aset/' . $item->foto_aset) }}" alt="Foto" width="60" style="cursor:pointer;"
                                                    data-toggle="modal" data-target="#fotoModal" data-img="{{ asset('storage/foto_aset/' . $item->foto_aset) }}">
                                                @else
                                                <span class="text-muted">Tidak ada foto</span>
                                                @endif
                                            </td>

                                            <td>
                                                <center>

                                                    <!-- Tombol Edit -->
                                                    <button data-toggle="modal" class="btn btn-sm btn-primary" data-target="#modal-edit-{{ $item->id }}"><i class="fas fa-pencil-alt"></i></i> </button>


                                                    <!-- Tombol Hapus -->
                                                    <button type="button" class="btn btn-sm btn-danger" onclick="deleteUser('{{ $item->id }}')">
                                                        <i class="fas fa-trash"></i>
                                                    </button>

                                                    <!-- Form Hapus (disembunyikan) -->
                                                    <form id="delete-form-{{ $item->id }}" action="{{ url('aset/' . $item->id) }}" method="POST" style="display:none;">
                                                        @csrf
                                                        @method('DELETE')
                                                    </form>
                                                </center>

                                            </td>

                                        </tr>
                                        @endforeach
                                    </tbody>

                                </table>

                                <div class="modal fade" id="fotoModal" tabindex="-1" aria-labelledby="fotoModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-body text-center">
                                                <img src="" id="modalImage" style="width: 100%; height: auto;" alt="Foto Besar">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>

    <!-- modal create -->
    @include('aset.modal-create')

    @include ('aset.modal-edit', ['item' => $item])


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