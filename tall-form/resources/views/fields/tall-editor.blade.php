<div wire:ignore class="form-group" x-data="{
    setUp() {
        let el = document.getElementById('{{ $field->id }}')
        el.addEventListener('change', (e) => {
            @this.set('{{ $field->key }}', e.target.value)
        })
    }
}" x-init="setUp">
    <label for="content">{{ $field->label }}</label>
    @error('{{ $field->name }}')
        <div class="validation--error">{{ $message }}</div>
    @enderror
    <input value="{{ data_get($data, $field->name) }}" name="{{ $field->name }}" id="{{ $field->id }}"
        type="text" />
    @push('scripts')
        <script>
            LarabergInit('{{ $field->id }}', '{{ $field->route }}', @json($field->options))
        </script>
    @endpush

</div>
