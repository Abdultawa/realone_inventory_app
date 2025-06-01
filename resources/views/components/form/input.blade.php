@props([
    'label' => '',
    'name',
    'type' => 'text',
    'value' => old($name),
    'required' => false,
    'step' => null,
])

<div class="mb-3">
    @if($label)
        <label for="{{ $name }}" class="form-label">{{ $label }} @if($required) <span class="text-danger">*</span> @endif</label>
    @endif
    <input
        type="{{ $type }}"
        name="{{ $name }}"
        id="{{ $name }}"
        value="{{ $value }}"
        {{ $required ? 'required' : '' }}
        @if($step) step="{{ $step }}" @endif
        {{ $attributes->merge(['class' => 'form-control']) }}
    >
    @error($name)
        <div class="text-danger mt-1">{{ $message }}</div>
    @enderror
</div>
