@foreach($aset as $aset)

<div class="modal fade" id="modal-edit-{{ $aset->id }}">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-success tex-white">
                <h4 class="modal-title ">Edit Data Aset</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{  url('aset/' . $aset->id) }}" method="post" enctype="multipart/form-data">
                    @method('PUT')
                    @csrf
                    <div class="card-body">
                        {{-- nama --}}
                        <label for="nama aset">Nama Aset </label>
                        <input type="text" class="form-control @error ('nama_aset') is-invalid @enderror"
                            id="nama_aset" name="nama_aset" value="{{old('nama_aset', $aset->nama_aset)}}"
                            placeholder="Masukkan Nama Aset">

                        @error('nama_aset')
                        <div class="invalid-feedback">
                            {{$message}}
                        </div>
                        @enderror
                        {{-- email --}}
                        <label for="tipe aset">Tipe Aset</label>
                        <select class="form-control @error('tipe_aset') is-invalid @enderror" name="tipe_aset" id="tipe_aset">
                            <option value="">Pilih Tipe Aset</option>
                            <option value="properti" {{ old('tipe_aset', $aset->tipe_aset) == 'properti' ? 'selected' : '' }}>Properti</option>
                            <option value="elektronik_it" {{ old('tipe_aset', $aset->tipe_aset) == 'elektronik_it' ? 'selected' : '' }}>Elektronik IT</option>
                            <option value="inventaris" {{ old('tipe_aset', $aset->tipe_aset) == 'inventaris' ? 'selected' : '' }}>Inventaris</option>
                        </select>
                        @error('tipe_aset')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror

                        <label for="nomor aset">Nomor Aset</label>
                        <input type="text" class="form-control @error ('no_aset') is-invalid @enderror"
                            id="no_aset" name="no_aset" value="{{old('no_aset', $aset->no_aset)}}"
                            placeholder="Tuliskan Nomor Aset">

                        @error('no_aset')
                        <div class="invalid-feedback">
                            {{$message}}
                        </div>
                        @enderror

                        <label for="status aset">Status Aset</label>
                        <select class="form-control @error('status_aset') is-invalid @enderror" name="status_aset" id="status_aset">
                            <option value="">Pilih Status Aset</option>
                            <option value="aktif" {{ old('status_aset', $aset->status_aset) == 'aktif' ? 'selected' : '' }}>Aktif</option>
                            <option value="tidak_aktif" {{ old('status_aset', $aset->status_aset) == 'tidak_aktif' ? 'selected' : '' }}>Tidak Aktif</option>
                            <option value="services" {{ old('status_aset', $aset->status_aset) == 'services' ? 'selected' : '' }}>Services</option>
                        </select>
                        @error('status_aset')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror

                        <label for="foto aset">Foto Aset</label>
                        <input type="file" class="form-control-file @error('foto_aset') is-invalid @enderror" id="foto_aset"
                            name="foto_aset" accept="image/*">
                        <div class="mt-1">
                            <small>Gambar Lama</small><br>
                            <img src="{{asset('storage/foto_aset/' . $aset->foto_aset)}}" alt="" width="88px">
                        </div>
                        @error('foto_aset')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
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