@extends('layout')

@section('content')
    <table class="table table-hover">
        <tr>
            <th>
                <a class="btn btn-sm btn-primary" href="{{ route('options.create') }}"><i class="fa fa-plus"></i></a>
            </th>
            <th>{{ __('Name') }}</th>
        </tr>
        @forelse($options as $option)
            <tr>
                <td>
                    <form action="{{ route('options.destroy', $option) }}" method="post">
                        @method('DELETE')
                        @csrf

                        <div class="btn-group btn-group-sm">
                            <a class="btn btn-success" href="{{ route('options.edit', $option) }}"><i
                                        class="fa fa-edit"></i></a>
                            <button type="submit" class="btn btn-danger"
                                    onclick="return confirm('{{ __('Are you sure?') }}')"><i
                                        class="fa fa-trash"></i></button>
                        </div>
                    </form>
                </td>
                <td>{{ $option->name }}</td>
            </tr>
        @empty
            <tr>
                <td colspan="2"><span class="text-danger">{{ __('Empty!') }}</span></td>
            </tr>
        @endforelse
    </table>

    {{ $options->links() }}
@endsection
