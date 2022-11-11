<?php

namespace App\Http\Livewire\Expediente;

use App\Models\Notas;
use Livewire\Component;

class VerNotas extends Component
{
    public $personaid;
    public $notaAEliminar;
    public $hidden = 'hidden';
    protected $listeners = ['eliminarNota','openModal','closeModal'];

    public function mount($id){
        $this->personaid = $id;
    }
    public function render()
    {
        $notas = Notas::where('persona',$this->personaid);
        $notas = $notas->paginate(10);

        return view('livewire.expediente.ver-notas',compact('notas'));
    }

    public function eliminarNota(){
        $nota = Notas::where('id',$this->notaAEliminar)->first();
        $nota->delete();
        $this->hidden = 'hidden';
        $this->prueba = true;

    }

    public function openModal($id){
        $this->hidden = '';
        $this->notaAEliminar = $id;
    }

    public function closeModal(){
        $this->hidden = 'hidden';
    }
}
