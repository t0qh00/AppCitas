@extends('layouts.app')
@section('content')
<div>
    <div style="text-align: center; padding:2rem; height: 600px !important;">
        <div class="card" style="height: 100%; overflow: auto; text-align: initial !important; padding: 2rem;">
            {!!$nota->notas!!}
        </div>
        <br>
        <div>
            <a class="btn-flotante" href="{{ url()->previous() }}"><i class="fas fa-arrow-left"></i></a>
        </div>
    </div>
</div>
@endsection
