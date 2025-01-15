<x-filament-panels::page>
    <div>
        {{ $this->editAction }}
        <x-filament-actions::modals />
    </div>
    <x-filament::section>
        <x-slot name="heading">
            Company Details
        </x-slot>
        {{ $this->companyInfolist }}
    </x-filament::section>
</x-filament-panels::page>
