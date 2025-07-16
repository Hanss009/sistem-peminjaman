<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Form Peminjaman Kendaraan</title>

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
                            <h1>Form Peminjaman Kendaraan</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item active">Form Peminjaman</li>
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
                                    <h3 class="card-title">Formulir Peminjaman Kendaraan</h3>
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

                                    <form action="{{ url('/peminjaman') }}" method="POST">
                                        @csrf

                                        <div class="form-group">
                                            <label for="kendaraan_id">Kendaraan</label>
                                            <select name="kendaraan_id" id="kendaraan_id" class="form-control @error('kendaraan_id') is-invalid @enderror">
                                                <option value="">Pilih Kendaraan</option>
                                                @foreach ($kendaraans as $kendaraan)
                                                <option value="{{ $kendaraan->id }}" {{ old('kendaraan_id') == $kendaraan->id ? 'selected' : '' }}>
                                                    {{ $kendaraan->nama_kendaraan }} - {{ $kendaraan->plat_nomor }}
                                                </option>
                                                @endforeach
                                            </select>
                                            @error('kendaraan_id')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label for="waktu_awal_pinjam">Waktu Mulai Pinjam</label>
                                            <input type="datetime-local" name="waktu_awal_pinjam" class="form-control @error('waktu_awal_pinjam') is-invalid @enderror"
                                                value="{{ old('waktu_awal_pinjam') }}">
                                            @error('waktu_awal_pinjam')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label for="waktu_akhir_pinjam">Waktu Selesai Pinjam</label>
                                            <input type="datetime-local" name="waktu_akhir_pinjam" class="form-control @error('waktu_akhir_pinjam') is-invalid @enderror"
                                                value="{{ old('waktu_akhir_pinjam') }}">
                                            @error('waktu_akhir_pinjam')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label for="tujuan">Tujuan</label>
                                            <textarea name="tujuan" class="form-control @error('tujuan') is-invalid @enderror" rows="2">{{ old('tujuan') }}</textarea>
                                            @error('tujuan')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label for="with_driver">Pengemudi</label>
                                            <select name="with_driver" class="form-control @error('with_driver') is-invalid @enderror">
                                                <option value="">Pilih</option>
                                                <option value="driver" {{ old('with_driver') == 'driver' ? 'selected' : '' }}>Dengan Driver</option>
                                                <option value="bawa_sendiri" {{ old('with_driver') == 'bawa_sendiri' ? 'selected' : '' }}>Bawa Sendiri</option>
                                            </select>
                                            @error('with_driver')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label for="level_kepentingan">Kepentingan</label>
                                            <select name="level_kepentingan" class="form-control @error('level_kepentingan') is-invalid @enderror">
                                                <option value="penting" {{ old('level_kepentingan') == 'penting' ? 'selected' : '' }}>Penting</option>
                                                <option value="sangat_penting" {{ old('level_kepentingan') == 'sangat_penting' ? 'selected' : '' }}>Sangat Penting</option>
                                            </select>
                                            @error('level_kepentingan')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label for="keterangan">Keterangan</label>
                                            <textarea name="keterangan" class="form-control @error('keterangan') is-invalid @enderror" rows="2">{{ old('keterangan') }}</textarea>
                                            @error('keterangan')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="form-row">
                                            <div class="form-group col-md-6">
                                                <label for="km_pergi">KM Pergi</label>
                                                <input type="text" name="km_pergi" class="form-control @error('km_pergi') is-invalid @enderror"
                                                    value="{{ old('km_pergi') }}">
                                                @error('km_pergi')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="km_kembali">KM Kembali</label>
                                                <input type="text" name="km_kembali" class="form-control @error('km_kembali') is-invalid @enderror"
                                                    value="{{ old('km_kembali') }}" placeholder="Tidak Perlu Di Isi" readonly>
                                                @error('km_kembali')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                                            <button type="submit" class="btn btn-primary">Simpan</button>
                                        </div>

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