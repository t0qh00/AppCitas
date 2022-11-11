<form wire:submit.prevent="submit">
    <div style="text-align: center; padding:2rem;">
        <div>
            <label for="notas"><b>Notas</b></label>
        </div>
        <br>
        <div id="container">
            <div wire:ignore>
                <textarea wire:model="notas" id="notas" cols="60" rows="40"></textarea>
            </div>
        </div>
        <button class="button-citas-custom" type="submit">Guardar</button>
    </div>
</form>
@section('scripts')
    <script>
        ClassicEditor
            .create(document.querySelector('#notas'))
            .then(function(nota){
                nota.model.document.on('change:data', () => {
                    @this.set('notas', nota.getData());
                })
            })
            .catch(error => {
                console.error(error);
            });
    </script>
@endsection
