<div class="modal fade" id="modal-form-jam-kerja" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" x-data="formJamKerja" @open-form-jam-kerja.window="openForm" data-bs-backdrop="false">
  <div class="modal-dialog" role="document">
	<div class="modal-content">
	  <div class="modal-header">
		<h5 class="modal-title">FORM JAM KERJA KARYAWAN</h5>
		<button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
		  <span aria-hidden="true">&times;</span>
		</button>
	  </div>
	  <div class="modal-body modal-body-1">
		<form id="fm-jam-kerja">
			<div class="form-group row align-items-center">
                <div class="col-lg-3 col-3">
                    <label class="col-form-label">Jam Kerja</label>
                </div>
                <div class="col-lg-9 col-9">
                    <select class="form-select select2" name="jam_keja_id" x-model="form.jam_kerja_id" x-onselect2 id="jam_kerja_id" required>
						<option value="">Pilih Kerja</option>
						@foreach($jam_kerja as $ar)
						<option value="{{ $ar->id }}">{{ $ar->nama }}</option>
						@endforeach
					</select>
                </div>
            </div>
             <div class="form-group row align-items-center">
                 
                 <div class="col-lg-3 col-3">
                    <label class="col-form-label">Status</label>
                </div>
                <div class="col-lg-9 col-9">
                    <input type="text" id="tanggal_berlaku" class="form-control flatpickr" name="tanggal_berlaku"
                        placeholder="Tanggal Berlaku" required x-model="form.tanggal_berlaku">
                </div>
            </div>
		</form>
	  </div>
	  <div class="modal-footer">
		<button type="button" class="btn btn-primary" @click="saveDataJamKerja" ><i class="fa fa-save"></i> SIMPAN</button>
		<button type="button" class="btn btn-secondary" data-bs-dismiss="modal" ><i class="fa fa-times"></i> TUTUP</button>
	  </div>
	</div>
  </div>
</div>

<script>
    document.addEventListener("alpine:init",() => {
        Alpine.data("formJamKerja",() => ({
            form: {
                jam_kerja_id:"",
                tanggal_berlaku:"",
                karyawan_id:0,
                divisi_id:0,
                id:0
            },
			
            init() {
               
            },
            openForm() {
               var id = this.$event.detail.id;
               
               
                if (id != 0) {
                    $.get("{{ url('master-karyawan/jam-kerja/row') }}",{id:id}).done(resp => {
						this.form = resp;
                        setSelect2Value('jam_kerja_id',resp.jam_kerja_id,false)
                    });
                } else {
                    this.clearForm();
                    this.form.divisi_id = this.$event.detail.divisi_id;
                    this.form.karyawan_id = this.$event.detail.karyawan_id;
                }
                
               
                
                $('#modal-form-jam-kerja').modal('show');
            },
            
            
            saveDataJamKerja() {
               
                var form = $('#fm-jam-kerja');
                    form.validate();
                
                if (form.valid()) {
                    Notiflix.Block.hourglass('body')
                    $.post("{{ url('master-karyawan/jam-kerja/save') }}",this.form).done(resp => {
                        Notiflix.Block.remove('body')
                        if (resp.error == false) {
							Notiflix.Notify.success("Data Berhasil Disimpan");
							this.$dispatch("reload-table");
							 $('#modal-form-jam-kerja').modal('hide');
							
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
                    jam_kerja_id:"",
                    tanggal_berlaku:"",
                    karyawan_id:0,
                    divisi_id:0,
                    id:0
				};
            },

            
			
        }));
    })
</script>