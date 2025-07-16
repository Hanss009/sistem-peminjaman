@foreach($peminjaman_aset as $peminjaman_aset)

<div class="modal fade" id="modal-edit-{{ $peminjaman_aset->id }}">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-success tex-white">
                <h4 class="modal-title ">Edit Data Peminjaman Aset</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{  url('peminjaman_aset/' . $peminjaman_aset->id) }}" method="post" enctype="multipart/form-data">
                    @method('PUT')
                    @csrf
                    <div class="card-body">
                        {{-- nama --}}
                        <label for="aset_id">Aset</label>
                        <select name="aset_id" id="aset_id" class="form-control @error('aset_id') is-invalid @enderror">
                            <option value="">Pilih Aset</option>
                            @foreach ($asets as $aset)
                            <option value="{{ $aset->id }}" {{ old('aset_id', $peminjaman_aset->aset_id) == $aset->id ? 'selected' : '' }}>
                                {{ $aset->nama_aset }}
                            </option>
                            @endforeach
                        </select>
                        @error('aset_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror


                        <label for="tgl_awal_pinjam">Waktu Mulai Pinjam</label>
                        <input type="datetime-local" name="tgl_awal_pinjam" class="form-control @error('tgl_awal_pinjam') is-invalid @enderror"
                            value="{{ old('tgl_awal_pinjam', $peminjaman_aset->tgl_awal_pinjam) }}">
                        @error('tgl_awal_pinjam')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror

                        <label for="tgl_akhir_pinjam">Waktu Selesai Pinjam</label>
                        <input type="datetime-local" name="tgl_akhir_pinjam" class="form-control @error('tgl_akhir_pinjam') is-invalid @enderror"
                            value="{{ old('tgl_akhir_pinjam', $peminjaman_aset->tgl_akhir_pinjam) }}">
                        @error('tgl_akhir_pinjam')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror

                        <label for="keperluan">Keperluan</label>
                        <textarea name="keperluan" class="form-control @error('keperluan') is-invalid @enderror" rows="2">{{ old('keperluan', $peminjaman_aset->keperluan)}}</textarea>
                        @error('keperluan')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror

                        <label for="nama_penerima">Nama Penerima</label>
                        <textarea name="nama_penerima" class="form-control @error('nama_penerima') is-invalid @enderror" rows="2">{{ old('nama_penerima', $peminjaman_aset->nama_penerima)}}</textarea>
                        @error('nama_penerima')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror

                        <label for="catatan">Catatan</label>
                        <textarea name="catatan" class="form-control @error('catatan') is-invalid @enderror" rows="2">{{ old('catatan', $peminjaman_aset->catatan)}}</textarea>
                        @error('catatan')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror


                    </div>

            </div>
            <!-- /.card-body -->
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save changes</button>
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