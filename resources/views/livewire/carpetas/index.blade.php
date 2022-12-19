<div>

    <div class="folders-grid">
        @foreach ($carpetas as $carpeta)
            <div class="card" style="text-align: center; padding: 1rem;">
                <div class="card-header">
                    <a class="button-citas-delete" style="padding: 5px 10px" wire:click="delete({{ $carpeta->id }})"><i
                            class="far fa-trash-alt"></i></a>
                </div>
                <div>
                    {{ $carpeta->nombre }}
                </div>
                <div style="padding: 1rem;">
                    <a class="button-citas-custom" href="{{ route('carpetaIndex', $carpeta->id) }}">Abrir</a>
                </div>
            </div>
        @endforeach
    </div>



    @if ($collectionName != '')
        <div class="folders-grid">
            @foreach ($this->parent->icon as $key => $entry)
                <div class="card" style="text-align: center; padding: 1rem;">
                    <div class="card-header">
                        <a class="button-citas-delete" style="padding: 5px 10px"
                            wire:click="deleteMedia('{{ $entry['uuid'] }}')"><i class="far fa-trash-alt"></i></a>
                    </div>
                    <u> <a class="link-photo" href="{{ $entry['url'] }}" target="_blank">
                            {{ $entry['file_name'] }}
                        </a> </u>
                    <br>
                    <div style="text-align:right">
                        <a class="button-citas-custom" style="padding: 5px 10px;" href="{{ $entry['url'] }}" download>
                            <i class="fas fa-download"></i>
                        </a>
                    </div>
                </div>
            @endforeach
        </div>
        <div style="padding: 1rem;">
            <x-dropzone id="icon" name="icon" action="{{ route('carpetaStoreMedia') }}"
                collection-name="{{ $this->collectionName }}" max-file-size="50" max-files="1" />
        </div>
        <div style="text-align: center;">
            <button class="button-citas-custom" wire:click="sync">
                Guardar archivos
            </button>
        </div>

    @endif
    <a class="btn-flotante" onclick="openModal()">
        +
    </a>
    <div class="modal" id="FolderModal" {{ $hidden }}>
        <div div class="modal-content" style="text-align: center;">
            <h3><b>Nueva carpeta</b></h3>
            <div>
                <label for="createFolder">Nombre de la carpeta:</label>
                <input type="text" wire:model="nombreDeCarpeta">
            </div>
            <div style="margin: 1rem"><a class="button-citas-custom" wire:click="crearNuevaCarpeta">
                    Crear
                </a>
                <a href="" class="button-citas-custom" onclick="closeModal()">
                    Cancelar
                </a>
            </div>

        </div>
    </div>
</div>
</div>

@section('scripts')
    <script>
        function syncMedia() {
            window.livewire.emit('sync');
        }

        function openModal() {
            var modal = document.getElementById("FolderModal");
            window.livewire.emit('openModal');
        }

        function closeModal() {
            window.livewire.emit('closeModal');
        }

        window.addEventListener('refresh-page', event => {
            window.location.reload(false);
        })
    </script>
@endsection
