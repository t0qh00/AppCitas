<?php

namespace App\Http\Livewire\Expediente;

use App\Models\Notas;
use App\Models\Persona;
use Livewire\Component;

class CrearNota extends Component
{
    public $personaid;
    public $notas;
    public function mount($id){
        $this->personaid = $id;
        $this->notas = '';
    }
    public function render()
    {
        return view('livewire.expediente.crear-nota');
    }
    public function submit(){
        $nota = new Notas();
        $nota->persona = $this->personaid;
        $nota->notas = $this->notas;
        $nota->save();
        return redirect('/notas');
    }
}
