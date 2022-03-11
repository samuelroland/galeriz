<x-app-layout>
    <div class="my-3">
        <h1 class="text-3xl">Gallery details</h1>
    </div>
    <hr>

    <div>
        <h2>{{ $gallery->title }}</h2>
        <p>{{ $gallery->description }}</p>
        <p>{{ $gallery->author->name }}</p>

        <div class="flex flex-wrap mt-4 ">
            @foreach ($gallery->images as $image)
                <a href="{{ route('panorama', ['id']) }}">
                    <div class="w-44 hover:bg-blue-100 overflow-hidden border border-gray-400 rounded-md m-1 p-1 pb-0">
                        <img class="w-44 h-44 block rounded-sm" src="/{{ $image->path ?? 'default-cover.png' }}"
                            alt="">
                        <div class="whitespace-nowrap overflow-hidden text-ellipsis">
                            {{ $image->title }}
                        </div>
                    </div>
                </a>
            @endforeach
        </div>
    </div>

</x-app-layout>
