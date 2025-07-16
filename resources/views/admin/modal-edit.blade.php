@foreach($user as $user)

<div class="modal fade" id="modal-edit-{{ $user->id }}">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-success tex-white">
                <h4 class="modal-title ">Tambah User</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{  url('admin/' . $user->id) }}" method="post" enctype="multipart/form-data">
                    @method('PUT')
                    @csrf
                    <div class="card-body">
                        {{-- nama --}}
                        <div class="form-group">
                            <label for="name">Nama</label>
                            <input type="text" class="form-control @error ('name') is-invalid @enderror" id="name"
                                name="name" value="{{ old('name', $user->name) }}" placeholder="Masukkan Nama User">

                            @error('name')
                            <div class="invalid-feedback">
                                {{$message}}
                            </div>
                            @enderror
                            {{-- email --}}
                            <label for="email">Email</label>
                            <input type="text" class="form-control @error ('email') is-invalid @enderror" id="email"
                                name="email" value="{{ old('email', $user->email) }}" placeholder="Tuliskan Email">

                            @error('email')
                            <div class="invalid-feedback">
                                {{$message}}
                            </div>
                            @enderror
                            <!-- {{-- password --}}
                            <label for="password">Password</label>
                            <input type="password" class="form-control @error ('password') is-invalid @enderror"
                                id="password" name="password" value="{{old('password')}}"
                                placeholder="Tuliskan Password">

                            @error('passowrd')
                            <div class="invalid-feedback">
                                {{$message}}
                            </div>
                            @enderror

                            <label for="password_confirmation">Konfirmasi Password</label>
                            <input type="password" class="form-control" id="password_confirmation"
                                name="password_confirmation" placeholder="Ulangi Password"> -->

                            {{-- role --}}
                            <label for="role">Role</label>
                            <select class="form-control @error('role') is-invalid @enderror" name="role" id="role">
                                <option value="">Pilih Role</option>
                                <option value="admin" {{ old('role', $user->role) == 'admin' ? 'selected' : '' }}>Admin</option>
                                <option value="gs" {{ old('role', $user->role) == 'gs' ? 'selected' : '' }}>GS</option>
                                <option value="pegawai" {{ old('role', $user->role) == 'pegawai' ? 'selected' : '' }}>Pegawai</option>

                            </select>
                            @error('role')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror

                            <label for="unit">Unit</label>
                            <select class="form-control @error('unit') is-invalid @enderror" name="unit" id="unit">
                                <option value="">Pilih Unit</option>
                                <option value="masjid" {{ old('unit', $user->unit) == 'masjid' ? 'selected' : '' }}>Masjid</option>
                                <option value="bmt" {{ old('unit', $user->unit) == 'bmt' ? 'selected' : '' }}>BMT</option>
                                <option value="tkit" {{ old('unit', $user->unit) == 'tkit' ? 'selected' : '' }}>TKIT</option>
                                <option value="sdit" {{ old('unit', $user->unit) == 'sdit' ? 'selected' : '' }}>SDIT</option>
                                <option value="mts" {{ old('unit', $user->unit) == 'mts' ? 'selected' : '' }}>MTS</option>
                                <option value="smpit" {{ old('unit', $user->unit) == 'smpit' ? 'selected' : '' }}>SMPIT</option>
                                <option value="smait" {{ old('unit', $user->unit) == 'smait' ? 'selected' : '' }}>SMAIT</option>
                                <option value="sekretariat" {{ old('unit', $user->unit) == 'sekretariat' ? 'selected' : '' }}>
                                    sekretariat</option>
                                <option value="Keuangan" {{ old('unit', $user->unit) == 'Keuangan' ? 'selected' : '' }}>Keuangan
                                </option>
                                <option value="tpa" {{ old('unit', $user->unit) == 'tpa' ? 'selected' : '' }}>TPA</option>
                                <option value="warung" {{ old('unit', $user->unit) == 'warung' ? 'selected' : '' }}>Warung</option>
                                <option value="dapur" {{ old('unit', $user->unit) == 'dapur' ? 'selected' : '' }}>Dapur</option>
                                <option value="direktorat" {{ old('unit', $user->unit) == 'direktorat' ? 'selected' : '' }}>Direktorat
                                </option>
                            </select>
                            @error('unit')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror

                            <label for="nip">NIP</label>
                            <input type="text" class="form-control @error('nip') is-invalid @enderror" id="nip"
                                name="nip" value="{{ old('nip', $user->nip) }}" placeholder="Masukkan NIP">
                            @error('nip')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror

                            <label for="foto">Foto</label>
                            <input type="file" class="form-control-file @error('foto') is-invalid @enderror" id="foto"
                                name="foto" accept="image/*">
                            <div class="mt-1">
                                <small>Gambar Lama</small><br>
                                <img src="{{asset('storage/foto/' . $user->foto)}}" alt="" width="88px">
                            </div>
                            @error('foto')
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