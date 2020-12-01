@extends('layout')

@section('content')
    <form action="{{ $action }}" method="post">
        @if($option)
            @method('PUT')
        @endif
        @csrf

        <div class="form-group required">
            <label for="name">{{ __('Name') }}</label>
            <input type="text" id="name" name="name" value="{{ $option ? $option->name : old('name') }}"
                   class="form-control @error('name') is-invalid @enderror">
            @error('name')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        @include('shared.button', ['item' => $option])
    </form>
@endsection
