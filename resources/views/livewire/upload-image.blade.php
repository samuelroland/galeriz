<div class="overflow-hidden border border-gray-700 rounded-md p-2 max-w-sm" x-data="{uploaded: false}" x-on:livewire-upload-finish="uploaded = true">
    <h3 class="text-lg">Upload a new image</h3>
    <x-field label="Title" wire:model.defer="title"></x-field>
    @error('title')
    <span class="text-red-500 italic">{{ $message }}</span>
    @enderror
    <x-field label="Image" wire:model.defer="image" type="file"></x-field>
    @error('image')
    <span class="text-red-500 italic">{{ $message }}</span>
    @enderror

    <div class="mt-3 flex flex-wrap">
        <div class="flex-1">
            @if(session()->has('uploadImageMessage'))
            <span class="text-message">{{ session('uploadImageMessage') }}</span>
            @endif
            <div class="text-message flex-1" wire:loading wire:target='image'>Uploading...</div>
            <div x-show="uploaded" class="text-message flex-1">The upload is done.</div>
        </div>
        <button wire:click='save' @click="uploaded = false" class="btn">Save</button>
    </div>
</div>
