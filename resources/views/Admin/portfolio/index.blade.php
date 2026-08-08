@extends('Admin.template')

@section('content')
    <div class="container mt-3">
        <div class="card card-default">
            <div class="card-header">
                <h3 class="card-title mt-3">{{ $config['title'] }}</h3>
                <div class="card-tools">
                    <a href="{{ route('admin.portfolio.create', $resource) }}" class="btn btn-sm btn-success">
                        <i class="fa fa-plus"></i> Add
                    </a>
                </div>
            </div>
            <div class="card-body">
                @if (session('message'))
                    <div class="alert alert-success">{{ session('message') }}</div>
                @endif

                <div class="table-responsive">
                    <table class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>Id</th>
                                @foreach (array_slice($config['fields'], 0, 4) as $field)
                                    <th>{{ ucwords(str_replace('_', ' ', $field)) }}</th>
                                @endforeach
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($items as $item)
                                <tr>
                                    <td>{{ $item->id }}</td>
                                    @foreach (array_slice($config['fields'], 0, 4) as $field)
                                        @if (in_array($resource, ['settings', 'portfolio-items', 'portfolio-detail-images'], true) &&
                                                in_array($field, ['profile_image', 'image'], true) &&
                                                $item->{$field})
                                            <td class="text-center">
                                                <img src="{{ asset($item->{$field}) }}" alt="Preview Image"
                                                    style="max-width: 50px; max-height: 25px;">
                                            </td>
                                        @else
                                            <td>{{ is_array($item->{$field}) ? implode(', ', $item->{$field}) : Str::limit((string) $item->{$field}, 80) }}
                                            </td>
                                        @endif
                                    @endforeach
                                    <td>
                                        <div class="d-flex"
                                            style="
                                    display: flex;
                                    justify-content: center;
                                    align-items: center;">
                                            <div class="card-tools  mx-2">
                                                <a href="{{ route('admin.portfolio.show', [$resource, $item->id]) }}"
                                                    class="btn btn-sm"
                                                    style="height: 21px;
                                                    width: 3rem; font-size: 8px;    background-color: #5d9531cc; color:white">
                                                    <i class="fa fa-eye"></i> View
                                                </a>
                                            </div>
                                            <div class="card-tools">
                                                <a href="{{ route('admin.portfolio.edit', [$resource, $item->id]) }}"
                                                    class="btn btn-sm btn-primary"
                                                    style="height: 21px;
                                                    width: 3rem; font-size: 8px;">
                                                    <i class="fa fa-pen"></i> Edit
                                                </a>
                                            </div>
                                            <form action="{{ route('admin.portfolio.destroy', [$resource, $item->id]) }}"
                                                method="post" onsubmit="return confirm('Delete this record?')"
                                                style="margin:0px;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger mx-2"
                                                    style="height: 21px;
                                                    width: 3rem; font-size: 8px;">
                                                    <i class="fa fa-trash"></i> Delete
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                {{ $items->links() }}
            </div>
        </div>
    </div>
@endsection
