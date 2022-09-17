<div class="modal fade" id="modal-form" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" x-data="form" @open-form.window="openForm" data-bs-backdrop="false">
  <div class="modal-dialog" role="document">
	<div class="modal-content">
	  <div class="modal-header">
		<h5 class="modal-title">FORM AREA</h5>
		<button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
		  <span aria-hidden="true">&times;</span>
		</button>
	  </div>
	  <div class="modal-body modal-body-1">
		<form id="fm">
			<div class="form-group row align-items-center">
                <div class="col-lg-2 col-3">
                    <label class="col-form-label">Area</label>
                </div>
                <div class="col-lg-10 col-9">
                    <select class="form-select select2" name="area_id" x-model="form.area_id" x-onselect2 id="area_id" required>
						<option value="">Pilih Area</option>
						@foreach($area as $ar)
						<option value="{{ $ar->id }}">{{ $ar->nama }}</option>
						@endforeach
					</select>
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
				area_id:"",
                nama:"",
				alamat:"",
				nomor_telp:"",
                id:0
            },
			
            init() {
               
            },
            openForm() {
               var id = this.$event.detail.id;
                this.form.id = id;
               
                 if (id != 0) {
                    $.get("{{ url('master/lokasi/row') }}",{id:id}).done(resp => {
						this.form = resp;
						setSelect2Value('area_id',resp.area_id,true);
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
					area_id:"",
					nama:"",
					alamat:"",
					nomor_telp:"",
					id:0
				};
				setSelect2Value('area_id','',false);
            },

            
			
        }));
    })
</script>