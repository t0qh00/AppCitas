@extends('layouts.app')
@section('content')
<div class="row">
    <div>
        @livewire('expediente.crear-nota',[$id])
    </div>
</div>
@endsection
