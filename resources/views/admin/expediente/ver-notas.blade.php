@extends('layouts.app')
@section('content')
<div class="row">
    <div>
        @livewire('expediente.ver-notas',[$id])
    </div>
</div>
@endsection
