<x-dynamic-component
    :component="$getFieldWrapperView()"
    :label="$getLabel()"
    :state-path="$getStatePath()">
    <!-- photoPath    -->
    <div wire:ignore
    x-data="{
            fotoAwal: @entangle('data.foto_kehadiran_awal'),
        }"
        
        x-on:photo-captured.window="
            console.log('Photo captured event received', $event.detail.path);
            console.log('Photo ', fotoAwal);
            $wire.set('data.foto_kehadiran_awal', $event.detail.path);"
        >
    @livewire('camera-capture')
    </div>
</x-dynamic-component>
