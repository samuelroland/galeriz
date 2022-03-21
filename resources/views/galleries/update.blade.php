<x-app-layout>
    <div class="my-3 flex">
        <h1 class="text-3xl flex-1">Gallery edition</h1>
        <a href=" {{ route("galleries.show", ["gallery"=> $gallery->id])}}"><button class="btn">View gallery</button></a>
    </div>
    <hr>

    <div>
        @livewire('gallery-details', ['gallery' => $gallery])


        <div class="flex flex-wrap mt-4 ">
            @foreach ($gallery->images as $image)
            <div class="overflow-hidden border border-gray-700 rounded-md m-1 pb-0">
                <img class="w-full h-72 object-cover block " src="/{{ $image->safePath ?? 'default-cover.png' }}" alt="">
                <div class="whitespace-nowrap overflow-hidden text-ellipsis max-w-xs mx-2">
                    {{ $image->title }}
                </div>
            </div>
            @endforeach
        </div>

        @livewire('upload-image', ['gallery' => $gallery])
    </div>

</x-app-layout>
