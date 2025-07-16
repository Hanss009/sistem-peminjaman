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
                            <h1>Data Peminjaman Aset</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item active">Data Peminjaman</li>
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
                                    <a href="{{ url('peminjaman_aset/create') }}" class="btn btn-primary">Tambah Data Pinjaman</a>

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
                                            <th>User</th>
                                            <th>Nama Aset</th>
                                            <th>Waktu Awal Pinjam</th>
                                            <th>Waktu Akhir Pinjam</th>
                                            <th>Keperluan</th>
                                            <th>Nama Penerima</th>
                                            <th>Status</th>
                                            <th class="text-center">Aksi</th>
                                            <th class="text-center">Approval</th>


                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($peminjaman_aset as $pinjam)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $pinjam->user->name ?? '-' }}</td>
                                            <td>{{ $pinjam->aset->nama_aset ?? '-' }}</td>
                                            <td>{{ date('d-m-Y H:i', strtotime($pinjam->tgl_awal_pinjam)) }}</td>
                                            <td>{{ date('d-m-Y H:i', strtotime($pinjam->tgl_akhir_pinjam)) }}</td>
                                            <td>{{ $pinjam->keperluan}}</td>
                                            <td>{{ $pinjam->nama_penerima}}</td>
                                            <td>
                                                <span class="badge badge-{{ match($pinjam->status) {
                                                        'disetujui' => 'success',
                                                        'tidak_disetujui' => 'danger',
                                                        'sedang_digunakan' => 'warning',
                                                        'selesai' => 'info',
                                                        'menunggu_approval', 'pending' => 'secondary',
                                                        default => 'dark',
                                                    } }}">
                                                    {{ ucfirst(str_replace('_', ' ', $pinjam->status)) }}
                                                </span>
                                            </td>
                                            <td class="text-center">
                                                <!-- tombol detail  -->
                                                <button data-toggle="modal" class="btn btn-sm btn-primary" data-target="#modal-show-{{ $pinjam->id }}"><i class="fa fa-eye"></i></button>
                                                <!-- tombol edit -->

                                                @if(in_array(Auth::user()->role, ['admin', 'gs']))
                                                @if($pinjam->status == 'menunggu_approval')
                                                <button data-toggle="modal" class="btn btn-sm btn-primary" data-target="#modal-edit-{{ $pinjam->id }}"><i class="fas fa-pencil-alt"></i></button>
                                                @elseif ($pinjam->user_id == Auth::id())
                                                <button data-toggle="modal" class="btn btn-sm btn-primary" data-target="#modal-edit-{{ $pinjam->id }}"><i class="fas fa-pencil-alt"></i></button>
                                                @endif
                                                @endif
                                                <!-- tombol delete -->
                                                @if(in_array(Auth::user()->role, ['admin', 'gs']))
                                                <button type="button" class="btn btn-sm btn-danger" onclick="deleteUser('{{ $pinjam->id }}')"><i class="fas fa-trash"></i></button>
                                                <form id="delete-form-{{ $pinjam->id }}" action="{{ url('peminjaman_aset/' . $pinjam->id) }}" method="POST" style="display:none;">
                                                    @csrf
                                                    @method('DELETE')
                                                </form>
                                                @endif

                                                <!-- tombol pengembalian -->
                                                @if($pinjam->status == 'disetujui')
                                                @if(Auth::user()->role == 'admin' || Auth::user()->role == 'gs')
                                                <a href="{{ route ('admin.form-pengembalian_aset', $pinjam->id )}}" class="btn btn-sm btn-info mt-2">Kembalikan</a>
                                                @elseif($pinjam->user_id == Auth::id())
                                                <a href="{{ route('admin.form-pengembalian_aset', $pinjam->id )}}" class="btn btn-sm btn-info mt-2">Kembalikan</a>
                                                @endif
                                                @endif
                                            </td>
                                            <!-- tombol approve -->
                                            <td>
                                                @if(in_array(Auth::user()->role, ['admin', 'gs']))
                                                @if($pinjam->status == 'menunggu_approval')
                                                <button type="button" class="btn btn-sm btn-success btn-ubah-status" data-id="{{ $pinjam->id }}" data-status="disetujui">
                                                    Setujui
                                                </button>
                                                <button type="button" class="btn btn-sm btn-danger btn-ubah-status" data-id="{{ $pinjam->id }}" data-status="tidak_disetujui">
                                                    Tolak
                                                </button>
                                                <button type="button" class="btn btn-sm btn-warning btn-ubah-status" data-id="{{ $pinjam->id }}" data-status="sedang_digunakan">
                                                    Sedang Digunakan
                                                </button>
                                                <button type="button" class="btn btn-sm btn-secondary btn-ubah-status mt-2" data-id="{{ $pinjam->id }}" data-status="pending">
                                                    Pending
                                                </button>
                                                @else
                                                <span class="badge badge-{{ match($pinjam->status) {
                                                'disetujui' => 'success',
                                                'tidak_disetujui' => 'danger',
                                                'sedang_digunakan' => 'warning',
                                                'selesai' => 'info',
                                                'menunggu_approval', 'pending' => 'secondary',
                                                default => 'dark',
                                            } }}">
                                                    {{ ucfirst(str_replace('_', ' ', $pinjam->status)) }}
                                                </span>
                                                @endif
                                                @else
                                                <span class="badge badge-{{ match($pinjam->status) {
                                                'disetujui' => 'success',
                                                'tidak_disetujui' => 'danger',
                                                'sedang_digunakan' => 'warning',
                                                'selesai' => 'info',
                                                'menunggu_approval', 'pending' => 'secondary',
                                                default => 'dark',
                                            } }}">
                                                    {{ ucfirst(str_replace('_', ' ', $pinjam->status)) }}
                                                </span>
                                                @endif
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

    @include('peminjaman_aset.modal-show', ['peminjaman_aset' => $peminjaman_aset, 'asets' => $asets])
    @include('peminjaman_aset.modal-edit', ['peminjaman_aset' => $peminjaman_aset, 'asets' => $asets])

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


    <script>
        $(document).ready(function() {
            $('.btn-ubah-status').on('click', function() {
                let id = $(this).data('id');
                let status = $(this).data('status');
                let button = $(this);
                let row = button.closest('tr');

                let statusText = {
                    'disetujui': 'Disetujui',
                    'tidak_disetujui': 'Tidak Disetujui',
                    'sedang_digunakan': 'Sedang Digunakan',
                    'pending': 'Pending'
                };

                Swal.fire({
                    title: `Yakin ingin ${statusText[status]} peminjaman ini?`,
                    icon: 'question',
                    showCancelButton: true,
                    confirmButtonColor: '#28a745',
                    cancelButtonColor: '#d33',
                    confirmButtonText: `Ya, ${statusText[status]}`
                }).then((result) => {
                    if (result.isConfirmed) {
                        // Tampilkan loading sementara di kolom STATUS & APPROVAL
                        row.find('td').eq(7).html('<span class="spinner-border spinner-border-sm text-primary"></span>');
                        row.find('td').eq(9).html('<span class="spinner-border spinner-border-sm text-primary"></span>');

                        $.ajax({
                            url: `/admin/approval_aset/${id}`,
                            type: 'POST',
                            data: {
                                _token: '{{ csrf_token() }}',
                                _method: 'PUT',
                                status: status
                            },
                            success: function() {
                                const statusBadge = `<span class="badge badge-${getBadgeColor(status)}">${statusText[status]}</span>`;
                                row.find('td').eq(7).html(statusBadge); // kolom Status
                                row.find('td').eq(9).html(statusBadge); // kolom Approval

                                // cek kalau disetujui
                                if (status === 'disetujui') {
                                    let pinjamId = id;
                                    let tombolKembali = `<a href="/admin/pengembalian/${pinjamId}" class="btn btn-sm btn-info">Kembalikan</a>`;
                                    row.find('td').eq(8).append(tombolKembali);
                                }

                                Swal.fire('Berhasil!', `Status peminjaman diubah menjadi ${statusText[status]}.`, 'success');
                            },
                        });
                    }
                });
            });

            function getBadgeColor(status) {
                switch (status) {
                    case 'disetujui':
                        return 'success';
                    case 'tidak_disetujui':
                        return 'danger';
                    case 'sedang_digunakan':
                        return 'warning';
                    case 'selesai':
                        return 'info';
                    case 'pending':
                    case 'menunggu_approval':
                        return 'secondary';
                    default:
                        return 'dark';
                }
            }
        });
    </script>

</body>

</html>