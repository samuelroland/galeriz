<div>
    <h2 class="text-2xl">
        <x-field class="inline" cssOnField="text-2xl" name="gallery.title" wire:model.lazy="gallery.title"></x-field>
    </h2>
    <p class="italic text-sm mt-2">
        <x-field class="inline" name="gallery.description" wire:model.lazy="gallery.description" type="textarea"></x-field>
    </p>
    @if(session()->has('updateMessage'))
    <div class="text-message mt-2">{{ session('updateMessage') }}</div>
    @endif
    <button class="btn mt-2" wire:click="save">Save</button>
</div>
