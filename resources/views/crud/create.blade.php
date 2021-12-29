<div class="container-fluid">
    <form method="POST" id="formCreate">
        @csrf
        @method("POST")
        <div class="row">
            <div class="col-sm-12">
                <div class="form-group">
                    <label for="daftar_nomor_id">ID Pengguna Baru</label>
                    <input type="text" readonly class="form-control" id="daftar_nomor_id" name="daftar_nomor_id" value="{{ $uid }}" aria-describedby="daftar_nomor_id">
                    <small class="d-none text-danger" id="daftar_nomor_id"></small>
                </div>
            </div>
        </div>
        <br>
        <div class="row">
            <div class="col-sm-12">
                <div class="form-group">
                    <label for="upline">Pilih Upline</label>
                    <select class="form-control" id="upline" name="upline">
                        <option value="">--Plih Salah Satu--</option>
                        @foreach ($upline as $u)
                            <option value="{{ $u->id }}">{{ $u->daftar_nomor_id .' - '. $u->nama }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-6">
                <div class="form-group">
                    <label for="notelp">Nomor Telephone</label>
                    <input type="text" readonly class="form-control" id="notelp" name="notelp" value="-" aria-describedby="notelp">
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-group">
                    <label for="almt">Alamat</label>
                    <input type="text" readonly class="form-control" id="almt" name="almt" value="-" aria-describedby="almt">
                </div>
            </div>
        </div>

        <hr>
        <br>
        <div class="row">
            <div class="col-sm-6">
                <div class="form-group">
                    <label for="nama">Nama</label>
                    <input type="text" class="form-control" id="nama" name="nama" value="" aria-describedby="nama">
                    <small class="d-none text-danger" id="nama"></small>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-group">
                    <label for="nomor_telepon">Nomor Telephone</label>
                    <input type="number" class="form-control" id="nomor_telepon" name="nomor_telepon" value="" aria-describedby="nomor_telepon">
                    <small class="d-none text-danger" id="nomor_telepon"></small>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <div class="form-group">
                    <label for="alamat">Alamat</label>
                    <input type="text" class="form-control" id="alamat" name="alamat" value="" aria-describedby="alamat">
                    <small class="d-none text-danger" id="alamat"></small>
                </div>
            </div>
        </div>
        <br>
        <div class="form-actions">
                <div class="text-right">
                    <button type="submit" class="btn btn-sm btn-success" id="btnCreate">Create</button>
                </div>
            </div>
    </form>
</div>