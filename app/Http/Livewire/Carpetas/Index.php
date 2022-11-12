<?php

namespace App\Http\Livewire\Carpetas;

use App\Models\Carpeta;
use Livewire\Component;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Index extends Component
{
    public array $mediaToRemove = [];

    public array $mediaCollections = [];

    protected $listeners = ['sync','openModal','closeModal'];

    public $idPadre;

    public $parent;

    public $collectionName;

    public $nombreDeCarpeta;

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

    public function mount($padreId){
        if($padreId != null){
            $this->idPadre = $padreId;
            $this->parent = Carpeta::where('id',$padreId)->first();
            $this->collectionName = "archivos";
        }
    }
    public function render()
    {
        $carpetas = Carpeta::where('id_padre',$this->idPadre)->get();
        return view('livewire.carpetas.index',compact('carpetas'));
    }

    protected function syncMedia(): void
    {
        collect($this->mediaCollections)->flatten(1)
            ->each(fn ($item) => Media::where('uuid', $item['uuid'])
                ->update(['model_id' => $this->idPadre]));

        Media::whereIn('uuid', $this->mediaToRemove)->delete();
    }

    public function crearNuevaCarpeta(){
        $this->closeModal();
        $carpeta = new Carpeta();
        $carpeta->nombre = $this->nombreDeCarpeta;
        $carpeta->id_padre = $this->idPadre;
        $carpeta->save();
    }

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
