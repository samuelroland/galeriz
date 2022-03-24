<div class=" mt-4">

    @if($gallery->images->count() == 0)
    <div class="text-message">There is no image in this gallery...</div>
    @endif

    <div class="flex flex-wrap">

        @foreach ($gallery->images as $image)
        <div class="overflow-hidden border border-gray-700 rounded-md m-1 pb-0">
            <img class="w-full h-72 object-cover block " src="/{{ $image->safePath ?? 'default-cover.png' }}" alt="">
            <div class="whitespace-nowrap overflow-hidden text-ellipsis max-w-xs mx-2">
                {{ $image->title }}
            </div>
        </div>
        @endforeach
        @if($edit)
        @livewire('upload-image', ['gallery' => $gallery])
        @endif
    </div>

</div>
