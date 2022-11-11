@extends('layouts.app')
@section('content')
<div class="row">
    <div style="padding: 2rem; text-align: end;">
        <a class="button-citas-custom" href="{{ route("crearPersona") }}">Agregar paciente</a>
    </div>
    <div>
        @livewire('expediente.notas')
    </div>
</div>
@endsection
