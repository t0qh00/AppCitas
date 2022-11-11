<?php

namespace App\Http\Livewire\Citas;

use App\Models\Citas;
use App\Models\Persona;
use Carbon\Carbon;
use Livewire\Component;
use Ramsey\Uuid\Type\Integer;

class CitasDisponibles extends Component
{
    protected $listeners = ['citaSeleccionada','openModal','closeModal'];

    public Citas $citas;

    public $actualDate, $maxDate, $selectedDate;

    public array $citasMañana = [];
    public array $citasTarde = [];

    public $citaSeleccionada;
    public $horaSeleccionada;
    public $tiempoDelDia;
    public $nombre;
    public $correo;
    public $telefono;
    public $isOnline;
    public $reason;
    public $dni;
    public $error;
    public $hidden = 'hidden';

    public function mount(Citas $citas)
    {
        $this->actualDate = Carbon::now()->format('Y-m-d');
        $this->maxDate = Carbon::now()->addDay(30)->format('Y-m-d');
        $this->selectedDate = Carbon::now()->format('Y-m-d');
        $this->citas = $citas;
        $this->citaSeleccionada = "";
        $this->horaSeleccionada = "";
        $this->tiempoDelDia = "";
        $this->correo = "";
        $this->telefono = "";
        $this->nombre = "";
        $this->isOnline = 0;
    }

    public function render()
    {
        $this->cargarCitasMañana();
        $this->cargarCitasTarde();
        return view('livewire.citas.citas-disponibles');
    }

    public function cargarCitasMañana(){
        $this->citasMañana = [];
        $citasDelDia = Citas::where('fecha_de_cita',$this->selectedDate)->get();
        $exist = 0;
        for ($i=7; $i < 12; $i++) {
            for ($x=0; $x < Count($citasDelDia); $x++) {
                if($i == $citasDelDia[$x]->hora_entrada){
                    $exist = 1;
                }
            }
            if($exist == 0){
                array_push($this->citasMañana,$i);
            }
            $exist = 0;
        }
    }

    public function cargarCitasTarde(){
        $this->citasTarde = [];
        $citasDelDia = Citas::where('fecha_de_cita',$this->selectedDate)->get();
        $exist = 0;
        for ($y=1; $y < 4; $y++) {
            for ($z=0; $z < Count($citasDelDia); $z++) {
                if($y == $citasDelDia[$z]->hora_entrada){
                    $exist = 1;
                }
            }
            if($exist == 0){
                array_push($this->citasTarde,$y);
            }
            $exist = 0;
        }
    }

    public function citaSeleccionada(){
        if($this->nombre != '' && $this->telefono != '' && $this->correo != '' && $this->dni != '' && $this->reason){
            $cita = new Citas();
            $cita->nombre = $this->nombre;
            $cita->telefono = $this->telefono;
            $cita->correo = $this->correo;
            $cita->fecha_de_cita = $this->selectedDate;
            $cita->hora_entrada = (Integer) $this->citaSeleccionada;
            $cita->hora_salida = (Integer) $this->citaSeleccionada + 1;
            $cita->tiempo_del_dia = $this->tiempoDelDia;
            $cita->virtual = $this->isOnline;
            $cita->motivo = $this->reason;
            $cita->save();

            $personaExist = Persona::where('cedula',$this->dni)->first();
            if(!$personaExist){
                $persona = new Persona();
                $persona->cedula = $this->dni;
                $persona->correo = $this->correo;
                $persona->telefono = $this->telefono;
                $persona->nombre_completo = $this->nombre;
                $persona->save();
            }
            return redirect('/reserva-completada');
        }else{
            $this->error = "*Todos los campos son requeridos";
        }
    }

    public function openModal($cita, $hora){
        $this->hidden = '';
        $horaSalida = $cita + 1;
        if($hora == "tarde"){
            $this->citaSeleccionada = $cita ." PM" . "-" . $horaSalida ." PM";
        }else{
            if($horaSalida >= 12){
                $this->citaSeleccionada = $cita ." AM" . "-" . $horaSalida ." PM";
            }else{
                $this->citaSeleccionada = $cita ." AM" . "-" . $horaSalida ." AM";
            }
        }
        $this->horaSeleccionada = $cita;
        $this->tiempoDelDia = $hora;
    }

    public function closeModal(){
        $this->hidden = 'hidden';
    }

    protected function rules(): array{
        return [
            'citas.nombre' => [
                'string',
                'required'
            ],
            'citas.telefono' => [
                'string',
                'required'
            ],
            'citas.correo' => [
                'email',
                'required'
            ],
            'citas.fecha_de_cita' => [
                'date',
                'required'
            ],
            'citas.hora_entrada' => [
                'date',
                'required'
            ],
            'citas.hora_salida' => [
                'date',
                'required'
            ],
        ];
    }
}
