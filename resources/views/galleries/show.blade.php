<x-app-layout>
    <div class="my-3 flex">
        <h1 class="text-3xl flex-1">Gallery details</h1>
        @if($gallery->author()->is(Auth::user()))
        <a href=" {{ route("galleries.update", ["gallery"=> $gallery->id])}}"><button class="btn">Edit gallery</button></a>
        @endif
    </div>
    <hr>

    <div>
        <h2 class="text-2xl">{{ $gallery->title }}
            - by <span class="italic text-violet-800">
                <a href="{{ '' }}">{{ $gallery->author->name }}</a>
            </span>
        </h2>
        <p class="italic text-sm">{{ $gallery->description }}</p>

        @livewire('image-grid', ['gallery' => $gallery, 'edit' => false])

    </div>

</x-app-layout>
