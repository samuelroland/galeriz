<x-layout>
    <h1>Panorama</h1>

    <div>
        @foreach ($galleries as $gallery)
            <div>
                <img src="{{ $gallery->cover != null ? $gallery->cover->path : 'default-gallery.png' }}" alt="">
            </div>
            {{ $gallery->title }}
        @endforeach
    </div>

</x-layout>
