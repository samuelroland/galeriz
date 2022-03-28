<div class="overflow-hidden border border-gray-700 rounded-md p-2 max-w-sm" x-data="{uploaded: false}" x-on:livewire-upload-finish="uploaded = true">
    <h3 class="text-lg">Upload a new image</h3>
    <x-field name='title' label="Title" wire:model.lazy="title"></x-field>

    <x-field name="image" label="Image" wire:model.lazy="image" type="file"></x-field>

    <div class="mt-3 flex flex-wrap">
        <div class="flex-1">
            <div class="text-message flex-1" wire:loading wire:target='image'>Uploading...</div>
            <div x-show="uploaded" class="text-message flex-1">The upload is done.</div>
        </div>
        <button wire:click='save' @click="uploaded = false" class="btn">Save</button>
    </div>
    @if(session()->has('uploadImageMessage'))
    <div class="text-message mt-2">{{ session('uploadImageMessage') }}</div>
    @endif
</div>
