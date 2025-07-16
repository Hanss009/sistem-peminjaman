<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Form Pengembalian Aset</title>

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
                            <h1>Form Pengembalian Aset</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item active">Form Pengembalian</li>
                            </ol>
                        </div>
                    </div>
                </div><!-- /.container-fluid -->
            </section>

            <!-- Main content -->
            <div class="content">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-md-12">
                            <div class="card card-primary">
                                <div class="card-header">
                                    <h3 class="card-title">Formulir Pengembalian Aset</h3>
                                </div>
                                <div class="card-body">
                                    {{-- Tampilkan error global --}}
                                    @if ($errors->any())
                                    <div class="alert alert-danger">
                                        <strong>Oops!</strong> Ada kesalahan saat mengisi form:
                                        <ul>
                                            @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                    @endif


                                    <form action="{{ route('admin.form-pengembalian_aset', $peminjaman_aset->id) }}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        @method('PUT')

                                        <div class="form-group">
                                            <label>Aset</label>
                                            <input type="text" class="form-control" value="{{ $peminjaman_aset->aset->nama_aset }}" readonly>
                                        </div>

                                        <div class="form-group">
                                            <label>Tanggal Awal Pinjam</label>
                                            <input type="datetime-local" class="form-control" value="{{ $peminjaman_aset->tgl_awal_pinjam }}" readonly>
                                        </div>

                                        <div class="form-group">
                                            <label>Tanggal Akhir Pinjam</label>
                                            <input type="datetime-local" class="form-control" value="{{ $peminjaman_aset->tgl_akhir_pinjam }}" readonly>
                                        </div>

                                        <div class="form-group">
                                            <label for="tgl_kembali">Waktu Kembali</label>
                                            <input type="datetime-local" name="tgl_kembali" class="form-control @error('tgl_kembali') is-invalid @enderror" value="{{ old('tgl_kembali') }}">
                                            @error('tgl_kembali') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                        </div>

                                        <div class="form-group">
                                            <label for="kondisi_setelah">kondisi </label>
                                            <textarea name="kondisi_setelah" class="form-control @error('kondisi_setelah') is-invalid @enderror">{{ old('kondisi_setelah') }}</textarea>
                                            @error('kondisi_setelah') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                        </div>

                                        <div class="form-group">
                                            <label for="foto_setelah">Foto</label>
                                            <input type="file" name="foto_setelah" class="form-control-file @error('foto_setelah') is-invalid @enderror">
                                            @error('foto_setelah') <div class="invalid-feedback d-block">{{ $message }}</div> @enderror
                                        </div>

                                        <button type="submit" class="btn btn-primary">Simpan Pengembalian</button>
                                        <a href="{{ route('admin.pengembalian_aset.index') }}" class="btn btn-secondary">Batal</a>

                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
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





</body>

</html>