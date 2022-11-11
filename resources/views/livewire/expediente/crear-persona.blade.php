<form wire:submit.prevent="submit">
    <div style="text-align: center; padding:2rem;">
        <h3><b>Registro de paciente</b></h3>
        <table style="width: 100%">
            <tbody>
                <tr>
                    <td style="width: 30%">&nbsp;</td>
                    <td style="width: 20%"><b><label for="cedula">Cédula:</label></b></td>
                    <td style="width: 20%"><input wire:model="dni" id="cedula" type="number" required></td>
                    <td style="width: 30%">&nbsp;</td>
                </tr>
                <tr>
                    <td style="width: 30%">&nbsp;</td>
                    <td style="width: 20%"><b><label for="name">Nombre:</label></b></td>
                    <td style="width: 20%"><input type="text" id="name" wire:model="nombre" required></td>
                    <td style="width: 30%">&nbsp;</td>
                </tr>
                <tr>
                    <td style="width: 30%">&nbsp;</td>
                    <td style="width: 20%"><b><label for="email">Email:</label></b></td>
                    <td style="width: 20%"><input type="email" id="email" wire:model="correo" required></td>
                    <td style="width: 30%">&nbsp;</td>
                </tr>
                <tr>
                    <td style="width: 30%">&nbsp;</td>
                    <td style="width: 20%"><b><label for="phone">Teléfono:</label></b></td>
                    <td style="width: 20%"><input type="number" id="phone" wire:model="telefono" required></td>
                    <td style="width: 30%">&nbsp;</td>
                </tr>
            </tbody>
        </table>
        <br>
        <a class="button-citas-custom" href="{{ url()->previous() }}">Volver</a>
        <button class="button-citas-custom" type="submit">Guardar</button>
    </div>
</form>
