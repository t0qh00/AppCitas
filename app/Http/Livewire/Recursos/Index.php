<?php

namespace App\Http\Livewire\Recursos;
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
        $pruebasExist = Carpeta::where('nombre','PrincipalCarpetaRecursos')->pluck('id')->first();
        if(!$pruebasExist){
            $newPruebas = New Carpeta();
            $newPruebas->nombre = 'PrincipalCarpetaRecursos';
            $newPruebas->save();
            $this->idCarpeta = $newPruebas->id;

        }else{
            $this->idCarpeta = $pruebasExist;
        }
    }

    public function render()
    {
        $carpeta = Carpeta::where('id',$this->idCarpeta)->first();

        return view('livewire.recursos.index',compact('carpeta'));
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
}
