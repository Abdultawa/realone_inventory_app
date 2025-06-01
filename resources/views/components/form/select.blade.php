@props([
    'label' => '',
    'name',
    'options' => [],
    'selected' => old($name),
    'required' => false,
])

<div class="mb-3">
    @if($label)
        <label for="{{ $name }}" class="form-label">{{ $label }} @if($required) <span class="text-danger">*</span> @endif</label>
    @endif
    <select
        name="{{ $name }}"
        id="{{ $name }}"
        {{ $required ? 'required' : '' }}
        {{ $attributes->merge(['class' => 'form-select']) }}
    >
        <option value="">-- Select --</option>
        @foreach ($options as $value => $text)
            <option value="{{ $value }}" {{ (string) $value === (string) $selected ? 'selected' : '' }}>
                {{ $text }}
            </option>
        @endforeach
    </select>
    @error($name)
        <div class="text-danger mt-1">{{ $message }}</div>
    @enderror
</div>
