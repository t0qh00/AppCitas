<div>
    <div class="all-margin all-padding mediaTable">
        <table class="styled-table">
            <thead>
                <tr>
                    <th>Fecha</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($notas as $nota)
                    <tr>
                        <td>
                            {{ $nota->created_at }}
                        </td>
                        <td>
                            <a class="button-citas-custom" href="{{ route('showNotas', $nota->id) }}">Ver Nota</a>
                            <button class="button-style" onclick="openModal({{$nota->id}})">Eliminar</button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        {{ $notas->links() }}
        <br>
        <div style="text-align: end;">
            <a class="button-citas-custom" href="/notas">Volver</a>
        </div>
    </div>
    <div {{$hidden}} class="modal" id="deleteModal">
        <div class="modal-content" style="text-align: center;">
                <h3>Desea eliminar la nota?</h3>
                <br>
                <button class="button-citas-delete" onclick="deleteNota({{$notaAEliminar}})">
                    Eliminar
                </button>
                <button class="button-citas-custom" onclick="closeModal()">
                    Cancelar
                </button>
        </div>
    </div>
</div>

@section('scripts')
<script>
    function deleteNota($id){
        window.livewire.emit('eliminarNota');
    }
    function openModal($id){
        var modal = document.getElementById("deleteModal");
        window.livewire.emit('openModal',$id);
    }
    function closeModal(){
        window.livewire.emit('closeModal');
    }
</script>
@endsection


