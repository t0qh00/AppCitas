<?php

namespace App\Http\Livewire\Citas;

use App\Models\Citas;
use App\Models\Settings;
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
    public $actualDay;

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
        $this->actualDay = $this->get_nombre_dia($this->selectedDate);
    }

    public function render()
    {
        $this->cargarCitasMañana();
        $this->cargarCitasTarde();
        $this->actualDay = $this->get_nombre_dia($this->selectedDate);
        return view('livewire.citas.citas-disponibles');
    }

    public function cargarCitasMañana(){
        $this->citasMañana = [];
        $citasDelDia = Citas::where('fecha_de_cita',$this->selectedDate)->get();
        $horas = Settings::first();
        $horas = $horas[$this->actualDay];
        $horas = str_replace('AM',"",$horas);
        $horas = trim(str_replace('PM',"",$horas));
        $horas = explode("-",$horas);
        $exist = 0;
        for ($i=$horas[0]; $i < 12; $i++) {
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
        $horas = Settings::first();
        $horas = $horas[$this->actualDay];
        $horas = str_replace('AM',"",$horas);
        $horas = trim(str_replace('PM',"",$horas));
        $horas = explode("-",$horas);
        $exist = 0;
        for ($y=1; $y < $horas[1]; $y++) {
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

    public function get_nombre_dia($fecha){ // YYYY-mm-dd
        $fechats = strtotime($fecha); //pasamos a timestamp

     //el parametro w en la funcion date indica que queremos el dia de la semana
     //lo devuelve en numero 0 domingo, 1 lunes,....
     switch (date('w', $fechats)){
         case 0: return "Domingo"; break;
         case 1: return "Lunes"; break;
         case 2: return "Martes"; break;
         case 3: return "Miercoles"; break;
         case 4: return "Jueves"; break;
         case 5: return "Viernes"; break;
         case 6: return "Sabado"; break;
     }
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
