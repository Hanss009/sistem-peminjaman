@foreach($peminjaman_aset as $peminjaman_aset)

<div class="modal fade" id="modal-show-{{ $peminjaman_aset->id }}">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-success tex-white">
                <h4 class="modal-title ">Detail Data Aset</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{  url('peminjaman_aset/' . $peminjaman_aset->id) }}" method="post" enctype="multipart/form-data">
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
                                    <td>{{ $peminjaman_aset->user->name ?? '-' }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Nama Aset</strong></td>
                                    <td>{{ $peminjaman_aset->aset->nama_aset ?? '-' }}</td>
                                </tr>

                                <tr>
                                    <td><strong>Waktu Awal Pinjam</strong></td>
                                    <td>{{ \Carbon\Carbon::parse($peminjaman_aset->tgl_awal_pinjam)->format('d-m-Y H:i') }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Waktu Akhir Pinjam</strong></td>
                                    <td>{{ \Carbon\Carbon::parse($peminjaman_aset->tgl_akhir_pinjam)->format('d-m-Y H:i') }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Keperluan</strong></td>
                                    <td>{{ $peminjaman_aset->keperluan ?? '-' }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Nama Penerima</strong></td>
                                    <td>{{ $peminjaman_aset->nama_penerima ?? '-' }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Catatan</strong></td>
                                    <td>{{ $peminjaman_aset->catatan ?? '-' }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Status</strong></td>
                                    <td>
                                        <span class="badge badge-{{ $badgeColors[$peminjaman_aset->status] ?? 'dark' }}">
                                            {{ ucfirst(str_replace('_', ' ', $peminjaman_aset->status)) }}
                                        </span>
                                    </td>
                                </tr>
                                <tr>
                                    <td><strong>Waktu Kembali</strong></td>
                                    <td>{!! $peminjaman_aset->tgl_kembali ? \Carbon\Carbon::parse($peminjaman_aset->tgl_kembali)->format('d-m-Y H:i') : '<span class="text-muted">Belum dikembalikan</span>' !!}</td>
                                </tr>

                                <tr>
                                    <td><strong>Keterangan Setelah</strong></td>
                                    <td>{{ $peminjaman_aset->kondisi_setelah ?? '-' }}</td>
                                </tr>

                                @if($peminjaman_aset->foto_setelah)
                                <tr>
                                    <td><strong>Foto Setelah</strong></td>
                                    <td><img src="{{ asset('storage/' . $peminjaman_aset->foto_setelah) }}" width="250" class="img-fluid rounded" alt="Foto Pengembalian"></td>
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