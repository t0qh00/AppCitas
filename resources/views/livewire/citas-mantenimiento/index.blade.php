<div>
    <div class="all-margin all-padding mediaTable">
        <table class="styled-table">
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Teléfono</th>
                    <th>Correo</th>
                    <th>Fecha de cita</th>
                    <th>Hora de cita</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($citas as $cita)
                    <tr>
                        <td>
                            {{$cita->nombre}}
                        </td>
                        <td>
                            {{$cita->telefono}}
                        </td>
                        <td>
                            {{$cita->correo}}
                        </td>
                        <td>
                            {{$cita->fecha_de_cita}}
                        </td>
                        <td>
                            @if ($cita->tiempo_del_dia == "tarde")
                                {{$cita->hora_entrada}} PM - {{$cita->hora_salida}} PM
                            @else
                                {{$cita->hora_entrada}} AM - @if( $cita->hora_salida >= 12) {{ $cita->hora_salida }} PM @else {{ $cita->hora_salida }} AM @endif
                            @endif
                        </td>
                        <td>
                            <button class="button-style" onclick="openModal({{$cita->id}})">Eliminar</button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        {{$citas->links()}}

        <div {{$hidden}} class="modal" id="deleteModal">
            <div class="modal-content" style="text-align: center;">
                    <h3>Desea eliminar la cita?</h3>
                    <br>
                    <button class="button-citas-delete" onclick="deleteCita({{$citaAEliminar}})">
                        Eliminar
                    </button>
                    <button class="button-citas-custom" onclick="closeModal()">
                        Cancelar
                    </button>
            </div>
        </div>
    </div>
</div>

@section('scripts')
<script>
    function deleteCita($id){
        window.livewire.emit('eliminarCita');
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
