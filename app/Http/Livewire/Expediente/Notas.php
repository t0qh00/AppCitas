<?php

namespace App\Http\Livewire\Expediente;

use App\Models\Carpeta;
use App\Models\Notas as ModelsNotas;
use App\Models\Persona;
use Livewire\Component;

class Notas extends Component
{
    protected $listeners = ['eliminarPaciente','openModal','closeModal','crearCarpeta'];

    public $hidden = 'hidden';
    public $hiddenFolder = 'hidden';
    public $pacienteAEliminar;

    public function mount(){
        $notasExist = Carpeta::where('nombre','PrincipalCarpetaNotas')->pluck('id')->first();
        if(!$notasExist){
            $newNotas = New Carpeta();
            $newNotas->nombre = 'PrincipalCarpetaNotas';
            $newNotas->save();
        }
    }

    public function render()
    {
        $personas = Persona::whereNotNull('cedula');
        $personas = $personas->paginate(10);

        return view('livewire.expediente.notas',compact('personas'));
    }

    public function openModal($id,$modal){
        if($modal == 'persona'){
            $this->hidden = '';
        }else if($modal == 'carpeta'){
            $this->hiddenFolder = '';
        }
        $this->pacienteAEliminar = $id;
    }

    public function closeModal(){
        $this->hidden = 'hidden';
        $this->hiddenFolder = 'hidden';
    }

    public function eliminarPaciente(){
        $notas = ModelsNotas::where('persona',$this->pacienteAEliminar)->get();
        foreach ($notas as $key => $value) {
            $value->delete();
        }
        $paciente = Persona::where('id',$this->pacienteAEliminar)->first();
        $paciente->delete();
        $this->hidden = 'hidden';
        $this->prueba = true;

    }

    public function crearCarpeta(){
        $carpeta = new Carpeta();
        $carpeta->nombre = 'CarpetaPadre';
        $carpeta->save();
    }
}
