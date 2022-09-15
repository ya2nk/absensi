@extends('layouts.app')

@section('content')
	<div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Data Jabatan</h3>
                
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">DataTable</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <section class="section" x-data="main">
		<div class="card">
            <div class="card-header">
                Data Jabatan
            </div>
            <div class="card-body">
                <table class="table table-striped" id="datatables">
                    <thead>
                        <tr>
							<th>Aksi</th>
                            <th>Nama</th>
                        </tr>
                    </thead>
				</table>
			</div>
		</div>
	</section>
@endsection

@push('scripts')
	<script>
		document.addEventListener("alpine:init",() => {
			Alpine.data("main",() => ({
				table:null,
				init() {
					this.table = $('#datatables').DataTable();
				}
			}));
		})
	</script>
@endpush