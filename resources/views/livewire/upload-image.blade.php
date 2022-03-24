<div class="overflow-hidden border border-gray-700 rounded-md p-2 max-w-sm">
    <h3>Upload a new image</h3>
    <x-field label="Title" wire:model.defer="title"></x-field>
    @error('title')
    <span class="text-red-500 italic">{{ $message }}</span>
    @enderror
    <x-field label="Image" wire:model.defer="image" type="file"></x-field>
    @error('image')
    <span class="text-red-500 italic">{{ $message }}</span>
    @enderror

    @if(session()->has('uploadImageMessage'))
    <span class="text-info">{{ session('uploadImageMessage') }}</span>
    @endif

    <div class=" flex justify-end"><button wire:click='save' class="btn">Save</button></div>
</div>
