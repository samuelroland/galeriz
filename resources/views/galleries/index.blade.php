<x-app-layout>
    <div class="my-3">
        <h1 class="text-3xl">Panorama</h1>
        <p>Panorama of all galleries published on Galeriz.</p>
    </div>
    <hr>
    <div class="flex flex-wrap mt-4 ">
        @foreach ($galleries as $gallery)
        <a href="{{ route('gallery', ['gallery' => $gallery->id]) }}">
            <div class="w-44 hover:bg-blue-100 overflow-hidden border border-gray-400 rounded-md m-1 p-1 pb-0">
                <img class="w-44 h-44 block rounded-sm" src="{{ $gallery->cover != null ? $gallery->cover->safePath : 'default-cover.png' }}" alt="">
                <div class="whitespace-nowrap overflow-hidden text-ellipsis">
                    {{ $gallery->title }}
                </div>
            </div>
        </a>
        @endforeach
    </div>

</x-app-layout>
