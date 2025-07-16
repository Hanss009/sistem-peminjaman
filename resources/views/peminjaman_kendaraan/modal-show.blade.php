@foreach($peminjaman as $peminjaman)

<div class="modal fade" id="modal-show-{{ $peminjaman->id }}">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-success tex-white">
                <h4 class="modal-title ">Detail Data Aset</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{  url('peminjaman/' . $peminjaman->id) }}" method="post" enctype="multipart/form-data">
                    @method('PUT')
                    @csrf
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

            </div>
            <!-- /.card-body -->
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
            </form>
        </div>

    </div>
    <!-- /.modal-content -->
</div>
<!-- /.modal-dialog -->
</div>

</div>

@endforeach