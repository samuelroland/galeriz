<div>
    <h2 class="text-2xl">
        <input wire:keyup.enter="save" wire:focusout="save" class="px-1" wire:model.defer="gallery.title" value="{{ $gallery->title }}" />
        - by <span class="italic text-violet-800">
            <a href="{{ '' }}">
                {{ $gallery->author->name }}
            </a>
        </span>
        <br>
        @error('gallery.title')
        <span class="text-red-500 italic">{{ $message }}</span>
        @enderror
    </h2>
    <p class="italic text-sm mt-2">
        <textarea wire:keyup.enter="save" wire:focusout="save" class="p-1 w-full" wire:model.defer="gallery.description">{{ $gallery->description }}</textarea>
        @error('gallery.description')
        <span class="text-red-500 italic">{{ $message }}</span>
        @enderror
    </p>
</div>
