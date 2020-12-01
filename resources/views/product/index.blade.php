@extends('layout')

@section('content')
    <form class="form-inline" action="{{ route('products.index') }}" method="get">
        <div class="form-group mx-sm-2 mb-2">
            <input type="search" name="search" class="form-control" id="inputPassword2"
                   placeholder="{{ __('Enter name') }}" value="{{ request()->get('search') }}">
        </div>
        <button type="submit" class="btn btn-primary mb-2 mr-2">{{ __('Search') }}</button>
    </form>

    <table class="table table-hover mt-3">
        <tr>
            <th>
                <a class="btn btn-sm btn-primary" href="{{ route('products.create') }}"><i class="fa fa-plus"></i></a>
            </th>
            <th>{{ __('Name') }}</th>
            <th>{{ __('Price') }}</th>
            <th>{{ __('Created At') }}</th>
        </tr>
        @forelse($products as $product)
            <tr>
                <td>
                    <form action="{{ route('products.destroy', $product) }}" method="post">
                        @method('DELETE')
                        @csrf

                        <div class="btn-group btn-group-sm">
                            <a class="btn btn-success" href="{{ route('products.edit', $product) }}"><i
                                        class="fa fa-edit"></i></a>
                            <button type="submit" class="btn btn-danger"
                                    onclick="return confirm('{{ __('Are you sure?') }}')"><i
                                        class="fa fa-trash"></i></button>
                        </div>
                    </form>
                </td>
                <td>{{ $product->name }}</td>
                <td>{{ $product->price }}</td>
                <td>{{ $product->created_at }}</td>
            </tr>
        @empty
            <tr>
                <td colspan="4"><span class="text-danger">{{ __('Empty!') }}</span></td>
            </tr>
        @endforelse
    </table>

    {{ $products->withQueryString()->links('vendor.pagination.bootstrap-4') }}
@endsection
