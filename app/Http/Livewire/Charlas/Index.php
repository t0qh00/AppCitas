<?php

namespace App\Http\Livewire\Charlas;
use App\Models\Carpeta;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

use Livewire\Component;

class Index extends Component
{
    public $idCarpeta;

    public array $mediaToRemove = [];

    public array $mediaCollections = [];

    public $collectionName = 'archivos';

    public $hidden = "hidden";

    public function addMedia($media): void{
        $this->mediaCollections[$media['collection_name']][] = $media;
    }

    public function removeMedia($media) : void
    {
        $collection = collect($this->mediaCollections[$media['collection_name']]);

        $this->mediaCollections[$media['collection_name']] = $collection->reject(fn ($item) => $item['uuid'] === $media['uuid'])->toArray();

        $this->mediaToRemove[] = $media['uuid'];
    }

    public function mount(){
        $pruebasExist = Carpeta::where('nombre','PrincipalCarpetaCharlas')->pluck('id')->first();
        if(!$pruebasExist){
            $newPruebas = New Carpeta();
            $newPruebas->nombre = 'PrincipalCarpetaCharlas';
            $newPruebas->save();
            $this->idCarpeta = $newPruebas->id;

        }else{
            $this->idCarpeta = $pruebasExist;
        }
    }

    public function render()
    {
        $carpeta = Carpeta::where('id',$this->idCarpeta)->first();

        return view('livewire.charlas.index',compact('carpeta'));
    }

    protected function syncMedia(): void
    {
        collect($this->mediaCollections)->flatten(1)
            ->each(fn ($item) => Media::where('uuid', $item['uuid'])
                ->update(['model_id' => $this->idCarpeta]));

        Media::whereIn('uuid', $this->mediaToRemove)->delete();
    }

    /*public function crearNuevaCarpeta(){
        $this->closeModal();
        $carpeta = new Carpeta();
        $carpeta->nombre = $this->nombreDeCarpeta;
        $carpeta->id_padre = $this->idPadre;
        $carpeta->save();
    }*/

    public function sync(){
        $this->syncMedia();
        $this->dispatchBrowserEvent('refresh-page');
    }

    public function deleteMedia($uuidMedia){
        Media::where('uuid', $uuidMedia)->delete();
        $this->dispatchBrowserEvent('refresh-page');
    }

    public function openModal(){
        $this->hidden = '';
    }

    public function closeModal(){
        $this->hidden = 'hidden';
    }

    public function delete($idCarpeta){
        Carpeta::where('id',$idCarpeta)->delete();
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
}
