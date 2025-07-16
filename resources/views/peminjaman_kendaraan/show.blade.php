<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Detail Peminjaman Kendaraan</title>

    <!-- Google Font -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('front/plugins/fontawesome-free/css/all.min.css') }}">
    <!-- DataTables -->
    <link rel="stylesheet" href="{{ asset('front/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('front/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('front/plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('front/dist/css/adminlte.min.css') }}">
</head>

<body class="hold-transition sidebar-mini">
    <div class="wrapper">

        <!-- Navbar -->
        @include('layout.navbar')

        <!-- Sidebar -->
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
           
            <div class="sidebar">
                @include('layout.sidebar')
            </div>
        </aside>

        <!-- Content Wrapper -->
        <div class="content-wrapper">
            <section class="content-header">
                <div class="container-fluid">
                    <h1>Detail Peminjaman Kendaraan</h1>
                </div>
            </section>

            <section class="content">
                <div class="container-fluid">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Informasi Peminjaman</h3>
                        </div>
                        <div class="card-body">
                            @php
                            $badgeColors = [
                            'pending' => 'warning',
                            'disetujui' => 'success',
                            'tidak_disetujui' => 'danger',
                            'sedang_digunakan' => 'primary',
                            'selesai' => 'secondary',
                            ];
                            @endphp

                            <table id="example1" class="table table-bordered table-striped">
                                <tbody>
                                    <tr>
                                        <td><strong>Nama Pengguna</strong></td>
                                        <td>{{ $peminjaman->user->name ?? '-' }}</td>
                                    </tr>
                                    <tr>
                                        <td><strong>Nama Kendaraan</strong></td>
                                        <td>{{ $peminjaman->kendaraan->nama_kendaraan ?? '-' }}</td>
                                    </tr>
                                    <tr>
                                        <td><strong>Plat Nomor</strong></td>
                                        <td>{{ $peminjaman->kendaraan->plat_nomor ?? '-' }}</td>
                                    </tr>
                                    <tr>
                                        <td><strong>Waktu Awal Pinjam</strong></td>
                                        <td>{{ \Carbon\Carbon::parse($peminjaman->waktu_awal_pinjam)->format('d-m-Y H:i') }}</td>
                                    </tr>
                                    <tr>
                                        <td><strong>Waktu Akhir Pinjam</strong></td>
                                        <td>{{ \Carbon\Carbon::parse($peminjaman->waktu_akhir_pinjam)->format('d-m-Y H:i') }}</td>
                                    </tr>
                                    <tr>
                                        <td><strong>Tujuan</strong></td>
                                        <td>{{ $peminjaman->tujuan ?? '-' }}</td>
                                    </tr>
                                    <tr>
                                        <td><strong>Dengan Supir</strong></td>
                                        <td>{{ $peminjaman->with_driver === 'driver' ? 'Dengan Supir' : 'Bawa Sendiri' }}</td>
                                    </tr>
                                    <tr>
                                        <td><strong>Level Kepentingan</strong></td>
                                        <td>{{ ucfirst(str_replace('_', ' ', $peminjaman->level_kepentingan)) }}</td>
                                    </tr>
                                    <tr>
                                        <td><strong>Keterangan</strong></td>
                                        <td>{{ $peminjaman->keterangan ?? '-' }}</td>
                                    </tr>
                                    <tr>
                                        <td><strong>Status</strong></td>
                                        <td>
                                            <span class="badge badge-{{ $badgeColors[$peminjaman->status] ?? 'dark' }}">
                                                {{ ucfirst(str_replace('_', ' ', $peminjaman->status)) }}
                                            </span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><strong>Waktu Kembali</strong></td>
                                        <td>{!! $peminjaman->waktu_kembali ? \Carbon\Carbon::parse($peminjaman->waktu_kembali)->format('d-m-Y H:i') : '<span class="text-muted">Belum dikembalikan</span>' !!}</td>
                                    </tr>
                                    <tr>
                                        <td><strong>Kilometer Pergi</strong></td>
                                        <td>{{ $peminjaman->km_pergi ?? '-' }}</td>
                                    </tr>
                                    <tr>
                                        <td><strong>Kilometer Kembali</strong></td>
                                        <td>{{ $peminjaman->km_kembali ?? '-' }}</td>
                                    </tr>

                                    <tr>
                                        <td><strong>Keterangan Setelah</strong></td>
                                        <td>{{ $peminjaman->kondisi_setelah ?? '-' }}</td>
                                    </tr>

                                    @if($peminjaman->foto_setelah)
                                    <tr>
                                        <td><strong>Foto Setelah</strong></td>
                                        <td><img src="{{ asset('storage/' . $peminjaman->foto_setelah) }}" width="250" class="img-fluid rounded" alt="Foto Pengembalian"></td>
                                    </tr>
                                    @endif
                                </tbody>
                            </table>
                        </div>

                        <div class="card-footer">
                            <a href="{{ url('peminjaman') }}" class="btn btn-secondary">Kembali</a>

                            @if($peminjaman->status === 'sedang_digunakan')
                            <a href="{{ route('peminjaman.kembalikan', $peminjaman->id) }}" class="btn btn-primary">
                                Lengkapi Pengembalian
                            </a>
                            @endif
                        </div>
                    </div>
                </div>
            </section>
        </div>

    </div>

    <!-- Scripts -->
    <script src="{{ asset('front/plugins/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('front/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('front/plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('front/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('front/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('front/plugins/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('front/plugins/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('front/plugins/jszip/jszip.min.js') }}"></script>
    <script src="{{ asset('front/plugins/pdfmake/pdfmake.min.js') }}"></script>
    <script src="{{ asset('front/plugins/pdfmake/vfs_fonts.js') }}"></script>
    <script src="{{ asset('front/plugins/datatables-buttons/js/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('front/plugins/datatables-buttons/js/buttons.print.min.js') }}"></script>
    <script src="{{ asset('front/plugins/datatables-buttons/js/buttons.colVis.min.js') }}"></script>

    <script>
        $(function() {
            $("#example1").DataTable({
                responsive: true,
                lengthChange: false,
                autoWidth: false,
                paging: false,
                searching: false,
                ordering: false,
                info: false,
            });
        });
    </script>
</body>

</html>