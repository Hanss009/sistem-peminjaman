<div class="modal fade" id="modal-default">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-success tex-white">
                <h4 class="modal-title ">Tambah Kendaraan</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ url('/kendaraan') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="card-body">

                        <div class="form-group">
                            <label for="nama">Nama Kendaraan</label>
                            <input type="text" class="form-control @error ('nama_kendaraan') is-invalid @enderror"
                                id="nama_kendaraan" name="nama_kendaraan" value="{{old('nama_kendaraan')}}"
                                placeholder="Masukkan Nama Kendaraan">

                            @error('nama_kendaraan')
                            <div class="invalid-feedback">
                                {{$message}}
                            </div>
                            @enderror

                            <label for="plat nomor">Nomor Plat Kendaraan</label>
                            <input type="text" class="form-control @error ('plat_nomor') is-invalid @enderror"
                                id="plat_nomor" name="plat_nomor" value="{{old('plat_nomor')}}"
                                placeholder="Tuliskan Nomor Plat Kendaraan">

                            @error('plat_nomor')
                            <div class="invalid-feedback">
                                {{$message}}
                            </div>
                            @enderror

                            <label for="jenis kendaraan">Jenis Kendaraan</label>
                            <select class="form-control @error('jenis_kendaraan') is-invalid @enderror" name="jenis_kendaraan" id="jenis_kendaraan">
                                <option value="">Pilih Jenis Kendaraan</option>
                                <option value="mobil" {{ old('jenis_kendaraan') == 'mobil' ? 'selected' : '' }}>Mobil</option>
                                <option value="sepeda_motor" {{ old('jenis_kendaraan') == 'sepeda_motor' ? 'selected' : '' }}>Sepeda Motor</option>
                            </select>
                            @error('jenis_kendaraan')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror

                            <label for="merk kendaraan">Merek Kendaraan</label>
                            <select class="form-control @error('merk_kendaraan') is-invalid @enderror" name="merk_kendaraan" id="merk_kendaraan">
                                <option value="">Pilih Merek Kendaraan</option>
                                <option value="daihatsu" {{ old('merk_kendaraan') == 'daihatsu' ? 'selected' : '' }}>Daihatsu</option>
                                <option value="toyota" {{ old('merk_kendaraan') == 'toyota' ? 'selected' : '' }}>Toyota</option>
                                <option value="mitsubishi" {{ old('merk_kendaraan') == 'mitsubishi' ? 'selected' : '' }}>Mitsubishi</option>
                                <option value="honda" {{ old('merk_kendaraan') == 'honda' ? 'selected' : '' }}>Honda</option>
                                <option value="dll" {{ old('merk_kendaraan') == 'dll' ? 'selected' : '' }}>Dan lainnya</option>
                            </select>
                            @error('merk_kendaraan')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror

                            <label for="warna kendaraan">Warna Kendaraan</label>
                            <input type="text" class="form-control @error ('warna_kendaraan') is-invalid @enderror"
                                id="warna_kendaraan" name="warna_kendaraan" value="{{old('warna_kendaraan')}}"
                                placeholder="Tuliskan Warna Kendaraan">

                            @error('warna_kendaraan')
                            <div class="invalid-feedback">
                                {{$message}}
                            </div>
                            @enderror

                            <label for="foto kendaraan">Foto kendaraan</label>
                            <input type="file" class="form-control-file @error('foto_kendaraan') is-invalid @enderror" id="foto_kendaraan"
                                name="foto_kendaraan" accept="image/*">
                            @error('foto_kendaraan')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                            <br>

                            <label for="tanggal berakhir stnk">Tanggal Berakhir STNK</label>
                            <input type="date" class="form-control-file @error('tgl_berakhir_stnk') is-invalid @enderror" id="tgl_berakhir_stnk"
                                name="tgl_berakhir_stnk" accept="image/*">
                            @error('tgl_berakhir_stnk')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror

                            <label for="status kepemilikan">Status Kepemilikan</label>
                            <select class="form-control @error('status_kepemilikan') is-invalid @enderror" name="status_kepemilikan" id="status_kepemilikan">
                                <option value="">Pilih Status Kepemilikan</option>
                                <option value="pribadi" {{ old('status_kepemilikan') == 'pribadi' ? 'selected' : '' }}>Pribadi</option>
                                <option value="yayasan" {{ old('status_kepemilikan') == 'yayasan' ? 'selected' : '' }}>Yayasan</option>
                                <option value="sewa" {{ old('status_kepemilikan') == 'sewa' ? 'selected' : '' }}>Sewa</option>
                            </select>
                            @error('status_kepemilikan')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror

                            <label for="status kendaraan">Status Kendaraan</label>
                            <select class="form-control @error('status_kendaraan') is-invalid @enderror" name="status_kendaraan" id="status_kendaraan">
                                <option value="">Pilih Status Kendaraan</option>
                                <option value="aktif" {{ old('status_kendaraan') == 'aktif' ? 'selected' : '' }}>Aktif</option>
                                <option value="tidak_aktif" {{ old('status_kendaraan') == 'tidak_aktif' ? 'selected' : '' }}>Tidak Aktif</option>
                                <option value="services" {{ old('status_kendaraan') == 'services' ? 'selected' : '' }}>Services</option>
                                <option value="rusak" {{ old('status_kendaraan') == 'rusak' ? 'selected' : '' }}>Rusak</option>
                            </select>
                            @error('status_kendaraan')
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