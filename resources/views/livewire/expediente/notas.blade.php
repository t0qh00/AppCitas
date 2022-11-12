<div>
    <div class="all-margin all-padding mediaTable">
        <table class="styled-table">
            <thead>
                <tr>
                    <th>Cédula</th>
                    <th>Nombre</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($personas as $persona)
                    <tr>
                        <td>
                            {{$persona->cedula}}
                        </td>
                        <td>
                            {{$persona->nombre_completo}}
                        </td>
                        <td>
                            <a class="button-citas-custom" href="{{ route("crearNota", $persona->id) }}">Crear Nota</a>
                            <a class="button-citas-custom" href="{{ route("verNotas", $persona->id) }}">Ver Notas</a>
                            <a class="button-style" onclick="openModal({{$persona->id}},'persona')">Eliminar</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        {{$personas->links()}}
    </div>
    <div {{$hidden}} class="modal" id="deleteModal">
        <div class="modal-content" style="text-align: center;">
                <h3>Desea eliminar el paciente?</h3>
                <br>
                <button class="button-citas-delete" onclick="deletePaciente({{$pacienteAEliminar}})">
                    Eliminar
                </button>
                <button class="button-citas-custom" onclick="closeModal()">
                    Cancelar
                </button>
        </div>
    </div>

    <!--<div>
        <div>
            <button class="button-citas-custom" onclick="openModal({ {$persona->id}},'carpeta')">
                Crear carpeta
            </button>
        </div>

        <div { {$hiddenFolder}} class="modal" id="deleteModal">
            <div class="modal-content" style="text-align: center;">
                    <h3>Desea crear una carpeta?</h3>
                    <br>
                    <label for="carpeta">Nombre de la carpeta</label>
                    <input name='carpeta' id='carpeta' type="text">
                    <button class="button-citas-custom" onclick="crearCarpeta()">
                        Crear
                    </button>
                    <button class="button-citas-custom" onclick="closeModal()">
                        Cancelar
                    </button>
            </div>
        </div>
    </div>-->
</div>

@section('scripts')
<script>
    function deletePaciente($id){
        window.livewire.emit('eliminarPaciente');
    }
    function openModal($id,$modal){
        var modal = document.getElementById("deleteModal");
        window.livewire.emit('openModal',$id,$modal);
    }
    function closeModal(){
        window.livewire.emit('closeModal');
    }
    /*function crearCarpeta(){
        window.livewire.emit('crearCarpeta');
    }*/
</script>
@endsection

