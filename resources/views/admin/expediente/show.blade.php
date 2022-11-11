@extends('layouts.app')
@section('content')
<div>
    <div style="text-align: center; padding:2rem; height: 600px !important;">
        <div>
            <label for="notas"><b>Notas</b></label>
        </div>
        <br>
        <div class="card" style="height: 100%; overflow: auto; text-align: initial !important; padding: 2rem;">
            {!!$nota->notas!!}
        </div>
        <br>
        <div>
            <a class="button-citas-custom" href="{{ url()->previous() }}">Volver</a>
        </div>
    </div>
</div>
@endsection
