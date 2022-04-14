<div class=" mt-4">

    @if($gallery->images->count() == 0)
    <div class="text-message">There is no image in this gallery...</div>
    @endif

    <div class="flex flex-wrap">

        @foreach ($gallery->images as $image)
        <div class="overflow-hidden border border-gray-700 rounded-md m-1 pb-0">

            @if($edit)
            <div class="relative" x-data="{confirmed: false}">
                <img class="w-full h-72 object-cover block " src="{{ route('images.show', $image) }}" alt="">
                <div class="absolute bottom-0 right-0 cursor-pointer m-2 p-1" :class="{'bg-red-200 hover:bg-red-300': !confirmed, 'bg-red-500 hover:bg-red-600': confirmed}" @click="confirmed ? $wire.delete({{ $image->id }}) : confirmed = true" @click.away="confirmed = false">
                    <div x-cloak>
                        {{-- Trash icon --}}
                        <svg :class="{'h-5 w-5': !confirmed, 'h-6 w-6': confirmed}" xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                        </svg>
                    </div>
                </div>
            </div>
            <div class="whitespace-nowrap overflow-hidden text-ellipsis max-w-xs mx-2">
                {{ $image->title }}
            </div>

            @else
            <img class="w-full h-72 object-cover block " src="{{ route('images.show', $image) }}" alt="">
            <div class="whitespace-nowrap overflow-hidden text-ellipsis max-w-xs mx-2">
                {{ $image->title }}
            </div>
            @endif

        </div>
        @endforeach

        @if($edit)
        @livewire('upload-image', ['gallery' => $gallery])
        @endif
    </div>

</div>
