@props(['label', 'type' => 'text', 'name'])
<div {{ $attributes->merge(['class' => 'mt-3']) }}>
    <label class="mb-1 block">{{ $label }}</label>
    @if ($type != 'textarea')
    <input type="{{ $type }}" value="" class="rounded-md px-1 border border-gray-400 p-0 h-8 " name="{{ $name }}" />
    @else
    <textarea type="{{ $type }}" class="rounded-md border border-gray-400 p-1 w-full md:w-2/3 lg:w-1/2" name="{{ $name }}" rows="3"></textarea>
    @endif

    @error($name)
    <div class="text-red-500 italic">
        {{ $message }}
    </div>
    @enderror

</div>
