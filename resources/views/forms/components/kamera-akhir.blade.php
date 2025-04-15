<x-dynamic-component
    :component="$getFieldWrapperView()"
    :label="$getLabel()"
    :state-path="$getStatePath()">
    <!-- photoPath    -->
    <div wire:ignore
    x-data="{
            fotoAkhir: @entangle('data.foto_kehadiran_akhir'),
        }"
        
        x-on:photo-captured.window="
            console.log('Photo captured event received', $event.detail.path);
            console.log('Photo ', fotoAkhir);
            $wire.set('data.foto_kehadiran_akhir', $event.detail.path);"
        >
    @livewire('kamera-akhir')
    </div>
</x-dynamic-component>
