<div style="text-align: center;">
    <h3>Fechas disponibles</h3>
    <input class="date-picket-custom" type="date" min="{{ $actualDate }}" max="{{ $maxDate }}"
        wire:model="selectedDate">

    <h3>Citas disponibles en la mañana</h3>
    <div class="customGird">
        @foreach ($citasMañana as $disponiblesMa)
            <div class="card" style="margin: 2rem; padding:2rem;">
                <div>
                    <b>Hora:</b> {{ $disponiblesMa }} AM - @if( $disponiblesMa + 1 >= 12) {{ $disponiblesMa + 1 }} PM @else {{ $disponiblesMa + 1 }} AM @endif
                </div>
                <br>
                <div>
                    <button class="button-citas-custom" onclick="openModal({{ $disponiblesMa }},'mañana')">
                        Reservar
                    </button>
                </div>

            </div>
        @endforeach
    </div>

    <h3>Citas disponibles en la tarde</h3>
    <div class="customGird">
        @foreach ($citasTarde as $disponibles)
            <div class="card" style="margin: 2rem; text-align: center; padding:2rem;">
                <div>
                    <b>Hora:</b> {{ $disponibles }} PM - {{ $disponibles + 1 }} PM
                </div>
                <br>
                <div>
                    <button class="button-citas-custom" onclick="openModal({{ $disponibles }},'tarde')">
                        Reservar
                    </button>
                </div>

            </div>
        @endforeach
    </div>

    <div class="modal" id="selectModal" {{ $hidden }}>
        <div div class="modal-content">
            <div>
                <form action="">
                    <h3>Desea reservar la cita: {{$selectedDate}}</h3>
                    <table class="table-custom">
                        <tbody>
                            <tr>
                                <td><b>Hora:</b></td>
                                <td>{{ $citaSeleccionada }}</td>
                            </tr>
                            <tr>
                                <td><b><label for="cedula">Cédula:</label></b></td>
                                <td><input wire:model="dni" id="cedula" type="number" required></td>
                            </tr>
                            <tr>
                                <td><b><label for="name">Nombre:</label></b></td>
                                <td><input type="text" id="name" wire:model="nombre" required></td>
                            </tr>
                            <tr>
                                <td><b><label for="email">Email:</label></b></td>
                                <td><input type="email" id="email" wire:model="correo" required></td>
                            </tr>
                            <tr>
                                <td><b><label for="phone">Teléfono:</label></b></td>
                                <td><input type="number" id="phone" wire:model="telefono" required></td>
                            </tr>
                            <tr>
                                <td><b><label for="virtual">Es virtual?</label></b></td>
                                <td><input wire:model="isOnline" id="virtual" type="checkbox"></td>
                            </tr>
                            <tr>
                                <td><b><label for="reason">Motivo de la consulta?</label></b></td>
                                <td><textarea wire:model="reason" name="reason" id="reason" cols="30" rows="10" required></textarea></td>
                            </tr>
                        </tbody>
                    </table>
                    <br>
                    <div style="color: red">{{$error}}</div>
                    <br>
                    <a class="button-citas-custom" onclick="selectDate()">
                        Finalizar
                    </a>
                    <a href="" class="button-citas-custom" onclick="closeModal()">
                        Cancelar
                    </a>
                </form>
            </div>
        </div>
    </div>
</div>
@section('scripts')
    <script>
        function selectDate() {
            window.livewire.emit('citaSeleccionada');
        }

        function openModal($cita, $hora) {
            var modal = document.getElementById("selectModal");
            window.livewire.emit('openModal', $cita, $hora);
        }

        function closeModal() {
            window.livewire.emit('closeModal');
        }
    </script>
@endsection
