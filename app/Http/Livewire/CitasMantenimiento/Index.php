<?php

namespace App\Http\Livewire\CitasMantenimiento;

use App\Models\Citas;
use Carbon\Carbon;
use Livewire\Component;

class Index extends Component
{
    public $actualDate;
    public $hidden = 'hidden';
    public $citaAEliminar;
    public $prueba = false;
    protected $listeners = ['eliminarCita','openModal','closeModal'];

    public function mount()
    {
        $this->actualDate = Carbon::now()->format('Y-m-d');
    }

    public function render()
    {
        $citas = null;

        $query = Citas::Where('fecha_de_cita','<=',$this->actualDate);

        $citas = $query->paginate(10);

        return view('livewire.citas-mantenimiento.index', compact('citas'));
    }

    public function eliminarCita($id){
        $cita = Citas::where('id',$id)->first();
        $cita->delete();
        $this->hidden = 'hidden';
        $this->prueba = true;

    }

    public function openModal($id){
        $this->hidden = '';
        $this->citaAEliminar = Citas::where('id',$id)->first();
    }

    public function closeModal(){
        $this->hidden = 'hidden';
    }

}
