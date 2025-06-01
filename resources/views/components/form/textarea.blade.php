@props([
    'label' => '',
    'name',
    'value' => old($name),
    'required' => false,
])

<div class="mb-3">
    @if($label)
        <label for="{{ $name }}" class="form-label">{{ $label }} @if($required) <span class="text-danger">*</span> @endif</label>
    @endif
    <textarea
        name="{{ $name }}"
        id="{{ $name }}"
        rows="3"
        {{ $required ? 'required' : '' }}
        {{ $attributes->merge(['class' => 'form-control']) }}
    >{{ $value }}</textarea>
    @error($name)
        <div class="text-danger mt-1">{{ $message }}</div>
    @enderror
</div>
