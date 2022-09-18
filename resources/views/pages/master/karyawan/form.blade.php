<div class="modal fade" id="modal-form" tab-index="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" x-data="form" @open-form.window="openForm" data-bs-backdrop="false">
  <div class="modal-dialog modal-lg" role="document">
	<div class="modal-content">
	  <div class="modal-header">
		<h5 class="modal-title">FORM KARYAWAN</h5>
		<button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
		  <span aria-hidden="true">&times;</span>
		</button>
	  </div>
	  <div class="modal-body modal-body-1">
		<form id="fm">
            <div class="form-group row align-items-center">
                <div class="col-lg-2 col-3">
                    <label class="col-form-label">Tanggal Masuk</label>
                </div>
                <div class="col-lg-3 col-3">
                    <input type="text" id="tanggal_masuk" class="form-control" name="tanggal_masuk"
                        placeholder="Tanggal masuk" required x-model="form.tanggal_masuk">
                </div>
                <div class="col-lg-1 col-2">
                    <label class="col-form-label">NIK</label>
                </div>
                <div class="col-lg-5 col-4">
                    <input type="text" id="nama" class="form-control" name="nik"
                        placeholder="Nik Karyawan" required x-model="form.nik" readonly>
                </div>
            </div>
		    <div class="form-group row align-items-center">
                <div class="col-lg-2 col-3">
                    <label class="col-form-label">Nama</label>
                </div>
                <div class="col-lg-10 col-9">
                    <input type="text" id="nama" class="form-control" name="nama"
                        placeholder="Nama Lokasi" required x-model="form.nama">
                </div>
            </div>
			<div class="form-group row align-items-center">
                <div class="col-lg-2 col-3">
                    <label class="col-form-label">Jabatan</label>
                </div>
                <div class="col-lg-10 col-9">
                    <select class="form-select select2" name="jabatan_id" x-model="form.jabatan_id" x-onselect2 id="jabatan_id" required>
						<option value="">Pilih Jabatan</option>
						@foreach($jabatan as $ar)
						<option value="{{ $ar->id }}">{{ $ar->nama }}</option>
						@endforeach
					</select>
                </div>
            </div>
			<div class="form-group row align-items-center">
                <div class="col-lg-2 col-3">
                    <label class="col-form-label">Atasan</label>
                </div>
                <div class="col-lg-10 col-9">
                   <div class="form-check">
                        <div class="checkbox">
                            <input type="checkbox" id="checkbox1" class="form-check-input" x-model="attr.atasan">
                            <label for="checkbox1">Ya</label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="form-group row align-items-center" x-show="!attr.atasan">
                <div class="col-lg-2 col-3">
                    <label class="col-form-label">Nama Atasan</label>
                </div>
                <div class="col-lg-10 col-9">
                    <select class="form-select select2" name="parent_id" x-model="form.parent_id" x-onselect2 id="parent_id" required>
						<option value="0">Pilih Atasan</option>
						@foreach($atasan as $ar)
						<option value="{{ $ar->id }}">{{ $ar->nama }}</option>
						@endforeach
					</select>
                </div>
            </div>
            <div class="form-group row align-items-center">
                <div class="col-lg-2 col-3">
                    <label class="col-form-label">Jenis Kelamin</label>
                </div>
                <div class="col-lg-2 col-3">
                   <div class="form-check">
                        <input class="form-check-input" type="radio" name="jenis_kelamin" id="flexRadioDefault11" x-model="form.jenis_kelamin" value="L" required>
                        <label class="form-check-label" for="flexRadioDefault11">
                            L
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="jenis_kelamin" id="flexRadioDefault12" x-model="form.jenis_kelamin" value="P" required>
                        <label class="form-check-label" for="flexRadioDefault12">
                            P
                        </label>
                    </div>
                </div>
                 <div class="col-lg-2 col-3">
                    <label class="col-form-label">Tanggal Lahir</label>
                </div>
                <div class="col-lg-3 col-3">
                    <input type="text" id="tanggal_lahir" class="form-control flatpickr" name="tanggal_lahir"
                        placeholder="Tanggal lahir" required x-model="form.tanggal_lahir">
                </div>
            </div>
            <div class="form-group row align-items-center">
                <div class="col-lg-2 col-3">
                    <label class="col-form-label">Status Perkawinan</label>
                </div>
                <div class="col-lg-6 col-6">
                   <div class="form-check">
                        <input class="form-check-input" type="radio" name="status_perkawinan" id="flexRadioDefault111" x-model="form.status_perkawinan" value="BELUM MENIKAH" required>
                        <label class="form-check-label" for="flexRadioDefault111">
                            Belum Menikah
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="status_perkawinan" id="flexRadioDefault121" x-model="form.status_perkawinan" value="MENIKAH" required>
                        <label class="form-check-label" for="flexRadioDefault121">
                            Sudah Menikah
                        </label>
                    </div>
                </div>
               
            </div>
			<div class="form-group row align-items-center">
                <div class="col-lg-2 col-3">
                    <label class="col-form-label">Alamat</label>
                </div>
                <div class="col-lg-10 col-9">
                    <textarea id="alamat" class="form-control" name="alamat"
                        placeholder="Alamat" required x-model="form.alamat"></textarea>
                </div>
            </div>
			<div class="form-group row align-items-center">
                <div class="col-lg-2 col-3">
                    <label class="col-form-label">Nomor Telp</label>
                </div>
                <div class="col-lg-10 col-9">
                    <input type="text" id="nomor_telp" class="form-control" name="nomor_telp"
                        placeholder="Nomor Telp" required x-model="form.nomor_telp">
                </div>
            </div>
            <div class="divider">
                <div class="divider-text">Info Akun</div>
            </div>
            <div class="form-group row align-items-center">
                <div class="col-lg-2 col-3">
                    <label class="col-form-label">Alamat Email</label>
                </div>
                <div class="col-lg-10 col-9">
                    <input type="email" id="nomor_telp" class="form-control" name="email"
                        placeholder="Alamat Email" required x-model="form.email">
                </div>
            </div>
            <div class="form-group row align-items-center">
                <div class="col-lg-2 col-3">
                    <label class="col-form-label">Role</label>
                </div>
                <div class="col-lg-10 col-9">
                    <select class="form-select" name="role_id" x-model="form.role_id" x-onselect2 id="role_id" required>
						<option value="0">Pilih Role</option>
						@foreach($roles as $ar)
						<option value="{{ $ar->id }}">{{ $ar->nama }}</option>
						@endforeach
					</select>
                </div>
            </div>
            <div class="form-group row align-items-center">
                <div class="col-lg-2 col-3">
                    <label class="col-form-label">Password</label>
                </div>
                <div class="col-lg-10 col-9">
                    <input type="password" id="password" class="form-control" name="password"
                        placeholder="Nomor Telp" required x-model="form.password">
                </div>
            </div>
		</form>
	  </div>
	  <div class="modal-footer">
		<button type="button" class="btn btn-primary" @click="saveData" ><i class="fa fa-save"></i> SIMPAN</button>
		<button type="button" class="btn btn-secondary" data-bs-dismiss="modal" ><i class="fa fa-times"></i> TUTUP</button>
	  </div>
	</div>
  </div>
</div>

<script>
    document.addEventListener("alpine:init",() => {
        Alpine.data("form",() => ({
            form: {
                tanggal_masuk:"",
                tanggal_lahir:"",
                nik:"",
				perent_id:0,
                jabatan_id:"",
                nama:"",
                jenis_kelamin:"",
                status_perkawinan:"",
				alamat:"",
				nomor_telp:"",
                email:"",
                password:"",
                role_id:"",
                id:0
            },
            attr:{
                atasan:true,
            },
			
            init() {
                var self = this;
                $('#tanggal_masuk').flatpickr({
                    static:true,
                    onChange: (date,dateStr) => {
                        self.getNik(dateStr)
                    }
                })
            },
            openForm() {
               var id = this.$event.detail.id;
                this.form.id = id;
               
                 if (id != 0) {
                    $.get("{{ url('master/lokasi/row') }}",{id:id}).done(resp => {
						this.form = resp;
						setSelect2Value('jabatan_id',resp.area_id,true);
                    });
                } else {
                    this.clearForm();
                }
                $('#modal-form').modal('show');
            },
            
            
            saveData() {
               
                var form = $('#fm');
                    form.validate();
                
                if (form.valid()) {
                    Notiflix.Block.hourglass('body')
                    $.post("{{ url('master/lokasi/save') }}",this.form).done(resp => {
                        Notiflix.Block.remove('body')
                        if (resp.error == false) {
							Notiflix.Notify.success("Data Berhasil Disimpan");
							this.$dispatch("reload-table");
							 $('#modal-form').modal('hide');
							
						} else {
							Notiflix.Notify.failure(resp.message);
						}
                    }).fail(err => {
                        Notiflix.Block.remove('body')
                        Notiflix.Notify.failure(err.responseText.message);
                    })
                }
            },
            clearForm() {
                this.form =  {
					    tanggal_masuk:"",
                        tanggal_lahir:"",
                        nik:"",
                        perent_id:0,
                        jabatan_id:"",
                        nama:"",
                        jenis_kelamin:"",
                        status_perkawinan:"",
                        alamat:"",
                        nomor_telp:"",
                        email:"",
                        password:"",
                        role_id:"",
                        id:0
				};
				setSelect2Value('area_id','',false);
            },

            getNik(tglMasuk) {
                $.get("{{ url('master/karyawan/get-nik') }}",{tanggal_masuk:tglMasuk}).done(resp => {
                    this.form.nik = resp
                });
            }
			
        }));
    })
</script>