<x-app-layout>
    <div class="my-3">
        <h1 class="text-3xl">Gallery details</h1>
    </div>
    <hr>

    <div>
        <h2 class="text-2xl">{{ $gallery->title }}
            - by <span class="italic text-violet-800">
                <a href="{{ '' }}">{{ $gallery->author->name }}</a>
            </span>
        </h2>
        <p class="italic text-sm">{{ $gallery->description }}</p>


        <div class="flex flex-wrap mt-4 ">
            @foreach ($gallery->images as $image)
            <div class="w-44 overflow-hidden border border-gray-400 rounded-md m-1 p-1 pb-0">
                <img class="w-44 h-44 block rounded-sm" src="/{{ $image->safePath ?? 'default-cover.png' }}" alt="">
                <div class="whitespace-nowrap overflow-hidden text-ellipsis">
                    {{ $image->title }}
                </div>
            </div>
            @endforeach
        </div>
    </div>

</x-app-layout>
