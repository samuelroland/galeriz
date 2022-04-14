@php
switch(Route::currentRouteName()) {
case "galleries.index":
$title = "Panorama";
$description = "Panorama of all galleries published on Galeriz.";
break;
case "my":
$title = "My galleries";
$description = "Here are all the galleries you published on Galeriz.";
break;
case "followedGalleries":
$title = "Followed galleries";
$description = "Here are all the galleries you follow on Galeriz.";
break;
default:
$title = "No title";
$description = "no description";
}
@endphp

<x-app-layout>
    <div class="my-3">
        <h1 class="text-3xl">
            {{ $title }}
        </h1>
        <p>{{ $description }}</p>
    </div>
    <hr>
    <div class="flex flex-wrap mt-4 ">
        @foreach ($galleries as $gallery)
        <a class="single-gallery" href="{{ route('galleries.show', $gallery) }}">
            <div class="w-44 hover:bg-blue-100 overflow-hidden border border-gray-400 rounded-md m-1 p-1 pb-0">
                <img class="w-44 h-44 block rounded-sm" src="{{ $gallery->cover != null ? route('images.show', $gallery->cover) : 'default-cover.png' }}" alt="">
                <div class="whitespace-nowrap overflow-hidden text-ellipsis">
                    {{ $gallery->title }}
                </div>
            </div>
        </a>
        @endforeach
        @if ($galleries->count() == 0)
        <div class="text-message">No gallery for the moment...</div>
        @endif
    </div>

</x-app-layout>
