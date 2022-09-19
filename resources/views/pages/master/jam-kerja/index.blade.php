@extends('layouts.app')

@section('content')
	<div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Master Jam Kerja</h3>
                
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Jam Kerja</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <section class="section" x-data="main" @reload-table.window="table.draw()">
		<div class="card">
            <div class="card-header">
                Data Jam Kerja
                 <div class="float-end">
                    <button class="btn btn-primary" @click="addData" data-id="0"><span class="bi bi-plus">TAMBAH</span></button>
                </div>
                <div class="clearfix"></div>
            </div>
            <div class="card-body">
               
               
                <div class="col-12 col-lg-12">
                    <table class="table table-striped table-bordered" id="datatables">
                        <thead>
                            <tr>
                                <th>Aksi</th>
                                <th>Nama</th>
                                <th>Jam Masuk</th>
                                <th>Jam Pulang</th>
                                <th>Crossday</th>
                            </tr>
                        </thead>
                    </table>
                </div>
			</div>
		</div>
	</section>
@endsection

@push("modals")
    @include("pages.master.jam-kerja.form")
@endpush
   
@push('scripts')
	<script>
		document.addEventListener("alpine:init",() => {
			Alpine.data("main",() => ({
				table:null,
				init() {
					this.table = $('#datatables').DataTable({
                        serverSide:true,
                        processing:true,
                        ajax:{
                            method:"POST",
                            url:"{{ url('master/jam-kerja/data') }}"
                        },
                        columns:[
                            {data:"aksi",render:(data,type,row) => {
                                var button = "";
                                    button += `<li><a class="dropdown-item" href="#" @click="addData" data-id="${row.id}">EDIT</a></li>`;
                                    button += `<li><a class="dropdown-item" href="#" @click="delData" data-id="${row.id}">DELETE</a></li>`;
                                return `<div class="dropdown">
                                      <button class="btn btn-primary btn-sm dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                                        AKSI
                                      </button>
                                      <ul class="dropdown-menu dropdown-menu-dark" aria-labelledby="dropdownMenuButton1">
                                        ${button}
                                      </ul>
                                    </div>`
                            }},
                            {data:"nama"},
                            {data:"jam_masuk"},
                            {data:"jam_pulang"},
                            {data:"crossday"},
                        ]
                    });
				},
                addData() {
                    var id = this.$_data("id");
                    this.$dispatch("open-form",{id:id});
                },
                delData() {
                    var id = this.$_data("id");
                    Notiflix.Confirm.show("KONFIRMASI","Apakah yakin akan menghapus data ini?","YA","TIDAK",() => {
                        $.post("{{ url('master/jam-kerja/delete') }}",{id,id}).done(resp => {
                            if (resp.error == false) {
                                Notiflix.Notify.success("Data Berhasil dihapus");
                                this.table.draw();
                            } else {
                                Notiflix.Notify.failure(resp.message);
                            }
                        }).fail(err => {
                            Notiflix.Notify.failure(err.responseText);
                        })
                    })
                }
			}));
		});
	</script>
@endpush