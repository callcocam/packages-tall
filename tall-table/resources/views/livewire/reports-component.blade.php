<div class="flex">
    <x-button wire:click="openModal" squared sm class="flex h-10" icon="chart-square-bar" primary
        label="{{ __('Relatorios') }}" />
    <x-modal wire:model.defer="cardModal">
        <x-card title="{{ __('RELATÓRIOS')}}">

            @if ($models)
                @foreach ($models as $model)
                    @livewire('tall-table::report-component', ['model' => $model], key($model->id))
                @endforeach
            @endif

            <x-slot name="footer">
                <div class="flex justify-end gap-x-4">
                    <x-button flat label="Cancel" x-on:click="close" />
                </div>
            </x-slot>
        </x-card>
    </x-modal>
</div>
