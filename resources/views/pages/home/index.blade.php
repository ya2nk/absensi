@extends('layouts.app')

@section('content')
    <div class="content" x-data="data">
       <input type="text" class="form-control flatpickr" x-model="tanggal">
    </div>
@endsection

@push('scripts')
<script>
    document.addEventListener("alpine:init",() => {
        Alpine.data("data",() => ({
           tanggal:"",
           init() {
               
           }
        }))
    })
</script>
@endpush