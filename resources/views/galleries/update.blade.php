<x-app-layout>
    <div class="my-3 flex">
        <h1 class="text-3xl flex-1">Gallery edition</h1>
        <a href=" {{ route("galleries.show", ["gallery"=> $gallery->id])}}"><button class="btn">View gallery</button></a>
    </div>
    <hr>

    <div>
        @livewire('gallery-details-update', ['gallery' => $gallery])

        @livewire('image-grid', ['gallery' => $gallery, 'edit' => true])

    </div>

</x-app-layout>
