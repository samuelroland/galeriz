<x-app-layout>
    <div class="my-3">
        <h1 class="text-3xl">Create a gallery</h1>
    </div>
    <hr>
    <div>
        <form method="post" action="{{ route('galleries.new') }}">
            @csrf
            <x-field type="text" label="Title" name="title" />
            <x-field type="textarea" label="Description" name="description" />
            <button class="mt-2 btn" type="submit">Create</button>
        </form>
    </div>

</x-app-layout>
