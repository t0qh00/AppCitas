<form wire:submit.prevent="submit">

    <button class="btn-flotante" type="submit"><i class="fas fa-save"></i></button>

    <div wire:ignore>
        <textarea wire:model="notas" id="notas" cols="60" rows="40"></textarea>
    </div>
</form>
@section('scripts')
    <script>
        ClassicEditor
            .create(document.querySelector('#notas'))
            .then(function(nota) {
                nota.model.document.on('change:data', () => {
                    @this.set('notas', nota.getData());
                })
            })
            .catch(error => {
                console.error(error);
            });
    </script>
@endsection
