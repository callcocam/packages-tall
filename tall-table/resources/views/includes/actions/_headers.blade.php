<x-dropdown align="left">
    <x-slot name="trigger">
        <x-button label="{{ __('Actions') }} -  {{ str_pad($this->checkboxValuesCount(), '3', '0', STR_PAD_LEFT) }}"
            primary outline rightIcon="chevron-double-down" />
    </x-slot>
    @if ($expots = $this->getExportsHeaders())
        <x-dropdown.header label="{{ $expots->label }}">
            @foreach ($expots->groups as $group)
                @if ($icon = $group->icon)
                    @if ($dialog = $group->dialog)
                        @include(include_table('actions._dialog-icon'), ['label'=>$group->label])
                    @else
                        <x-dropdown.item icon="{{ $icon }}" label="{{ __($group->label) }}" />
                    @endif
                @else
                    <x-dropdown.item label="{{ __($group->label) }}" />
                @endif
            @endforeach
        </x-dropdown.header>
        <x-dropdown.item separator />
    @endif
    @if ($headers)
        @foreach ($headers as $header)
            @if ($header->can)
                @if ($groups = $header->groups)
                    <x-dropdown.header label="{{ $header->label }}">
                        @foreach ($groups as $group)
                            @if ($icon = $group->icon)
                                @if ($dialog = $group->dialog)
                                    @include(include_table('actions._dialog-icon'), ['label'=>$group->label])
                                @else
                                    <x-dropdown.item icon="{{ $icon }}" label="{{ __($group->label) }}" />
                                @endif
                            @else
                                <x-dropdown.item label="{{ __($group->label) }}" />
                            @endif
                        @endforeach
                    </x-dropdown.header>
                @elseif($separator = $header->separator)
                    <x-dropdown.item separator />
                @else
                    @if ($icon = $header->icon)
                        @if ($dialog = $header->dialog)
                            @include(include_table('actions._dialog-icon'),['label'=>$header->label])
                        @else
                            <x-dropdown.item icon="{{ $icon }}" label="{{ __($header->label) }}" />
                        @endif
                    @else
                        <x-dropdown.item label="{{ __($header->label) }}" />
                    @endif
                @endif
            @endif
        @endforeach
    @endif
    @if ($delete = $this->getDelateAllHeader())
        @if ($delete->can)
            @if ($dialog = $delete->dialog)
                @include(include_table('actions._dialog-icon'),['icon'=>$delete->icon,'label'=>$delete->label])
            @endif
        @endif
    @endif
</x-dropdown>
