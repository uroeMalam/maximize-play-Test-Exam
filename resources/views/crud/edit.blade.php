<div class="container-fluid">
    <form method="POST" id="formEdit">
        @csrf
        @method("POST")
        <input type="hidden" class="form-control" id="id" name="id" value="{{ $id}}">
        <div class="row">
            <div class="col-sm-12">
                <div class="form-group">
                    <label for="daftar_nomor_id">ID Pengguna Baru</label>
                    <input readonly type="text" class="form-control" id="daftar_nomor_id" name="daftar_nomor_id" value="{{ $pengguna->id_pengguna_baru}}" aria-describedby="daftar_nomor_id">
                    <small class="d-none text-danger" id="daftar_nomor_id"></small>
                </div>
            </div>
        </div>
        <br>
        <div class="row">
            <div class="col-sm-12">
                <div class="form-group">
                    <label for="uperline">Uperline</label>
                    <input readonly type="text" class="form-control" id="uperline" name="uperline" value="{{ $pengguna->daftar_nomor_id .' - '. $pengguna->nama }}" aria-describedby="uperline">
                    <small class="d-none text-danger" id="uperline"></small>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-6">
                <div class="form-group">
                    <label for="notelp">Nomor Telephone</label>
                    <input readonly type="text" class="form-control" id="notelp" name="notelp" value="{{ $pengguna->nomor_telepon}}" aria-describedby="notelp">
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-group">
                    <label for="almt">Alamat</label>
                    <input readonly type="text" class="form-control" id="almt" name="almt" value="{{  $pengguna->alamat }}" aria-describedby="almt">
                </div>
            </div>
        </div>

        <hr>
        <br>
        <div class="row">
            <div class="col-sm-6">
                <div class="form-group">
                    <label for="nama">Nama Pengguna</label>
                    <input  type="text" class="form-control" id="nama" name="nama" value="{{ $pengguna->nama_pengguna }}" aria-describedby="nama">
                    <small class="d-none text-danger" id="nama"></small>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-group">
                    <label for="nomor_telepon">No HP Pengguna</label>
                    <input  type="number" class="form-control" id="nomor_telepon" name="nomor_telepon" value="{{ $pengguna->nomor_telepon }}" aria-describedby="nomor_telepon">
                    <small class="d-none text-danger" id="nomor_telepon"></small>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <div class="form-group">
                    <label for="alamat">Alamat Pengguna</label>
                    <input  type="text" class="form-control" id="alamat" name="alamat" value="{{ $pengguna->alamat_pengguna }}" aria-describedby="alamat">
                    <small class="d-none text-danger" id="alamat"></small>
                </div>
            </div>
        </div>
        <br>
        <div class="form-actions">
            <div class="text-right">
                <button type="submit" class="btn btn-sm btn-info" id="btnEdit">Edit</button>
            </div>
        </div>
    </form>
</div>