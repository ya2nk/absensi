<div class="modal fade" id="modal-form" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" x-data="form" @open-form.window="openForm" data-bs-backdrop="false">
  <div class="modal-dialog" role="document">
	<div class="modal-content">
	  <div class="modal-header">
		<h5 class="modal-title">FORM JAM KERJA</h5>
		<button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
		  <span aria-hidden="true">&times;</span>
		</button>
	  </div>
	  <div class="modal-body modal-body-1">
		<form id="fm">
			<div class="form-group row align-items-center">
                <div class="col-lg-3 col-3">
                    <label class="col-form-label">Nama</label>
                </div>
                <div class="col-lg-9 col-9">
                    <input type="text" id="nama" class="form-control" name="nama"
                        placeholder="Nama Area" required x-model="form.nama">
                </div>
            </div>
			<div class="form-group row align-items-center">
                <div class="col-lg-3 col-3">
                    <label class="col-form-label">Jam Masuk</label>
                </div>
                <div class="col-lg-6 col-6">
                    <input type="text" id="jam_masuk" class="form-control timepicker" name="jam_masuk"
                        placeholder="Jam Masuk" required x-model="form.jam_masuk">
                </div>
            </div>
			<div class="form-group row align-items-center">
                <div class="col-lg-3 col-3">
                    <label class="col-form-label">Jam Pulang</label>
                </div>
                <div class="col-lg-6 col-6">
                    <input type="text" id="jam_pulang" class="form-control timepicker" name="jam_pulang"
                        placeholder="Jam Pulang" required x-model="form.jam_pulang">
                </div>
            </div>
			<div class="form-group row align-items-center">
                <div class="col-lg-3 col-3">
                    <label class="col-form-label">Crossday</label>
                </div>
                <div class="col-lg-3 col-9">
                   <div class="form-check">
                        <div class="checkbox">
                            <input type="checkbox" id="checkbox1" class="form-check-input" x-model="form.crossday" value="1">
                            <label for="checkbox1">Ya</label>
                        </div>
                    </div>
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
                nama:"",
				jam_masuk:"",
				jam_pulang:"",
				crossday:0,
                id:0
            },
			
            init() {
               $('.timepicker').flatpickr({
					static:true,
					enableTime: true,
					noCalendar: true,
					dateFormat: "H:i:S",
					time_24hr: true
			   })
            },
            openForm() {
               var id = this.$event.detail.id;
                this.form.id = id;
               
                 if (id != 0) {
                    $.get("{{ url('master/jam-masuk/row') }}",{id:id}).done(resp => {
						this.form = resp;
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
                    $.post("{{ url('master/jam-kerja/save') }}",this.form).done(resp => {
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
				    nama:"",
					jam_masuk:"",
					jam_pulang:"",
					crossday:0,
                    id:0
				};
            },

            
			
        }));
    })
</script>