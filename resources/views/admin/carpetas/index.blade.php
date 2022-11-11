@extends('layouts.app')
@section('content')

<div class="row">
    <div>
        @livewire('carpetas.index',[$padre])
    </div>
</div>
@endsection
