<form action="">
    <div>
        @foreach ($carpetas as $carpeta)
            <div>
                {{ $carpeta->nombre }}
                <a class="button-citas-custom" href="{{ route('carpetaIndex', $carpeta->id) }}">Ir a
                    {{ $carpeta->nombre }}</a>
            </div>
        @endforeach
        @if ($collectionName != '')
            @foreach ($this->parent->icon as $key => $entry)
                <u> <a class="link-photo" href="{{ $entry['url'] }}">
                        {{ $entry['file_name'] }}
                    </a> </u>
                <br>
            @endforeach

            <x-dropzone id="icon" name="icon" action="{{ route('carpetaStoreMedia') }}"
                collection-name="{{$this->collectionName}}" max-file-size="50" max-files="1" />
                <button class="button-citas-custom" onclick="syncMedia()">
                    Sync media
                </button>
        @endif
        <button class="button-citas-custom" onclick="crearNuevaCarpeta()">
            Crear
        </button>
    </div>
</form>

@section('scripts')
    <script>
        function crearNuevaCarpeta() {
            window.livewire.emit('crearNuevaCarpeta');
        }
        function syncMedia() {
            window.livewire.emit('sync');
        }
    </script>
@endsection
