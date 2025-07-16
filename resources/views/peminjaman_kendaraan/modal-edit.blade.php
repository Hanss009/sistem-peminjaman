@foreach($peminjaman as $peminjaman)

<div class="modal fade" id="modal-edit-{{ $peminjaman->id }}">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-success tex-white">
                <h4 class="modal-title ">Edit Data Peminjaman</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{  url('peminjaman/' . $peminjaman->id) }}" method="post" enctype="multipart/form-data">
                    @method('PUT')
                    @csrf
                    <div class="card-body">
                        {{-- nama --}}
                        <label for="kendaraan_id">Kendaraan</label>
                        <select name="kendaraan_id" id="kendaraan_id" class="form-control @error('kendaraan_id') is-invalid @enderror">
                            <option value="">Pilih Kendaraan</option>
                            @foreach ($kendaraans as $kendaraan)
                            <option value="{{ $kendaraan->id }}" {{ old('kendaraan_id', $peminjaman->kendaraan_id) == $kendaraan->id ? 'selected' : '' }}>
                                {{ $kendaraan->nama_kendaraan }} - {{ $kendaraan->plat_nomor }}
                            </option>
                            @endforeach
                        </select>
                        @error('kendaraan_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror


                        <label for="waktu_awal_pinjam">Waktu Mulai Pinjam</label>
                        <input type="datetime-local" name="waktu_awal_pinjam" class="form-control @error('waktu_awal_pinjam') is-invalid @enderror"
                            value="{{ old('waktu_awal_pinjam', $peminjaman->waktu_awal_pinjam) }}">
                        @error('waktu_awal_pinjam')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror

                        <label for="waktu_akhir_pinjam">Waktu Selesai Pinjam</label>
                        <input type="datetime-local" name="waktu_akhir_pinjam" class="form-control @error('waktu_akhir_pinjam') is-invalid @enderror"
                            value="{{ old('waktu_akhir_pinjam', $peminjaman->waktu_akhir_pinjam) }}">
                        @error('waktu_akhir_pinjam')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror

                        <label for="tujuan">Tujuan</label>
                        <textarea name="tujuan" class="form-control @error('tujuan') is-invalid @enderror" rows="2">{{ old('tujuan', $peminjaman->tujuan)}}</textarea>
                        @error('tujuan')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror

                        <label for="with_driver">Pengemudi</label>
                        <select name="with_driver" class="form-control @error('with_driver') is-invalid @enderror">
                            <option value="">Pilih</option>
                            <option value="driver" {{ old('with_driver', $peminjaman->with_driver) == 'driver' ? 'selected' : '' }}>Dengan Driver</option>
                            <option value="bawa_sendiri" {{ old('with_driver', $peminjaman->with_driver) == 'bawa_sendiri' ? 'selected' : '' }}>Bawa Sendiri</option>
                        </select>
                        @error('with_driver')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror

                        <label for="level_kepentingan">Kepentingan</label>
                        <select name="level_kepentingan" class="form-control @error('level_kepentingan') is-invalid @enderror">
                            <option value="penting" {{ old('level_kepentingan', $peminjaman->level_kepentingan) == 'penting' ? 'selected' : '' }}>Penting</option>
                            <option value="sangat_penting" {{ old('level_kepentingan', $peminjaman->level_kepentingan ) == 'sangat_penting' ? 'selected' : '' }}>Sangat Penting</option>
                        </select>
                        @error('level_kepentingan')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror

                        <label for="keterangan">Keterangan</label>
                        <textarea name="keterangan" class="form-control @error('keterangan') is-invalid @enderror" rows="2"> {{ old('keterangan', $peminjaman->keterangan)}}</textarea>
                        @error('keterangan')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror

                        <label for="km_pergi">KM Pergi</label>
                        <input type="text" name="km_pergi" class="form-control @error('km_pergi') is-invalid @enderror"
                            value="{{ old('km_pergi', $peminjaman->km_pergi) }}">
                        @error('km_pergi')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror

                        <label for="km_kembali">KM Kembali</label>
                        <input type="text" name="km_kembali" class="form-control @error('km_kembali') is-invalid @enderror"
                            value="{{ old('km_kembali', $peminjaman->km_kembali) }}" placeholder="Tidak Perlu Di Isi" readonly>
                        @error('km_kembali')
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