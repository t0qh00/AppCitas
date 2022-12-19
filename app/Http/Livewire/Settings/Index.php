<?php

namespace App\Http\Livewire\Settings;

use App\Models\Settings;
use Livewire\Component;

class Index extends Component
{
    public $lunesD,$lunesN,
    $martesD,$martesN,
    $miercolesD,$miercolesN,
    $juevesD,$juevesN,
    $viernesD,$viernesN,
    $sabadoD,$sabadoN,
    $domingoD,$domingoN;

    public $horas = ['1 AM','2 AM','3 AM','4 AM','5 AM','6 AM','7 AM','8 AM','9 AM','10 AM','11 AM','12 AM','1 PM','2 PM','3 PM','4 PM','5 PM','6 PM','7 PM','8 PM','9 PM','10 PM','11 PM','12 PM'];

    public function mount(){
        $settingExist = Settings::first();
        if($settingExist){
            $hora = explode("-",$settingExist->Lunes);
            $this->lunesD = $hora[0];
            $this->lunesN = $hora[1];
            $hora = explode("-",$settingExist->Martes);
            $this->martesD = $hora[0];
            $this->martesN = $hora[1];
            $hora = explode("-",$settingExist->Miercoles);
            $this->miercolesD = $hora[0];
            $this->miercolesN = $hora[1];
            $hora = explode("-",$settingExist->Jueves);
            $this->juevesD = $hora[0];
            $this->juevesN = $hora[1];
            $hora = explode("-",$settingExist->Viernes);
            $this->viernesD = $hora[0];
            $this->viernesN = $hora[1];
            $hora = explode("-",$settingExist->Sabado);
            $this->sabadoD = $hora[0];
            $this->sabadoN = $hora[1];
            $hora = explode("-",$settingExist->Domingo);
            $this->domingoD = $hora[0];
            $this->domingoN = $hora[1];
        }
    }
    public function render()
    {
        return view('livewire.settings.index');
    }

    public function submit(){
        $settingExist = Settings::first();
        if(!$settingExist){
            $settings = new Settings();
            $settings->lunes = $this->lunesD . '-'. $this->lunesN;
            $settings->martes = $this->martesD . '-'. $this->martesN;
            $settings->miercoles = $this->miercolesD . '-'. $this->miercolesN;
            $settings->jueves = $this->juevesD . '-'. $this->juevesN;
            $settings->viernes = $this->viernesD . '-'. $this->viernesN;
            $settings->sabado = $this->sabadoD . '-'. $this->sabadoN;
            $settings->domingo = $this->domingoD . '-'. $this->domingoN;
            $settings->save();
        }else{
            $settingExist->lunes = $this->lunesD . '-'. $this->lunesN;
            $settingExist->martes = $this->martesD . '-'. $this->martesN;
            $settingExist->miercoles = $this->miercolesD . '-'. $this->miercolesN;
            $settingExist->jueves = $this->juevesD . '-'. $this->juevesN;
            $settingExist->viernes = $this->viernesD . '-'. $this->viernesN;
            $settingExist->sabado = $this->sabadoD . '-'. $this->sabadoN;
            $settingExist->domingo = $this->domingoD . '-'. $this->domingoN;
            $settingExist->save();
        }
        return redirect('/settings');
    }
}
