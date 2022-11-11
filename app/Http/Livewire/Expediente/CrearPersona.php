<?php

namespace App\Http\Livewire\Expediente;

use App\Models\Persona;
use Livewire\Component;

class CrearPersona extends Component
{
    public $nombre;
    public $correo;
    public $telefono;
    public $dni;

    public function render()
    {
        return view('livewire.expediente.crear-persona');
    }

    public function submit(){
        $personaExist = Persona::where('cedula',$this->dni)->first();
        if(!$personaExist){
            if($this->nombre != '' && $this->telefono != '' && $this->correo != '' && $this->dni != ''){
                $persona = new Persona();
                $persona->cedula = $this->dni;
                $persona->correo = $this->correo;
                $persona->telefono = $this->telefono;
                $persona->nombre_completo = $this->nombre;
                $persona->save();
                return redirect('/notas');
            }
        }
    }
}
