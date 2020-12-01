@extends('layout')

@section('content')
    <form action="{{ $action }}" method="post">
        @if($product)
            @method('PUT')
        @endif
        @csrf

        <div class="form-group required">
            <label for="name">{{ __('Name') }}</label>
            <input type="text" id="name" name="name" value="{{ $product ? $product->name : old('name') }}"
                   class="form-control @error('name') is-invalid @enderror">
            @error('name')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group required">
            <label for="price">{{ __('Price') }}</label>
            <input type="text" id="price" name="price" value="{{ $product ? $product->price : old('price') }}"
                   class="form-control @error('price') is-invalid @enderror">
            @error('price')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        @if($options->count())
            <h4>Product options:</h4>
            @foreach($options as $option)
                <div class="form-group">
                    <label for="price">{{ $option->name }}</label>
                    <input type="text" id="price" name="options[{{ $option->id }}][value]"
                           value="{{ isset($option->value) ? $option->value : old('options.' . $option->id . '.value') }}"
                           class="form-control @error('options.' . $option->id . '.value') is-invalid @enderror">
                    @error('options.' . $option->id . '.value')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
            @endforeach
        @endif

        @include('shared.button', ['item' => $product])
    </form>
@endsection
