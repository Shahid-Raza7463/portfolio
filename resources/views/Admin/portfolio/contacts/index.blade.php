@extends('Admin.template')

@section('content')
    <div class="container mt-3">
        <div class="card card-default">
            <div class="card-header">
                <h3 class="card-title mt-3">Contact Messages</h3>
            </div>
            <div class="card-body">
                @if (session('message'))
                    <div class="alert alert-success">{{ session('message') }}</div>
                @endif
                <div class="table-responsive">
                    <table class="table table-bordered table-hover">
                        <tr>
                            <th>Id</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Subject</th>
                            <th>Action</th>
                        </tr>
                        @foreach ($messages as $message)
                            <tr>
                                <td>{{ $message->id }}</td>
                                <td>{{ $message->name }}</td>
                                <td>{{ $message->email }}</td>
                                <td>{{ $message->subject }}</td>
                                <td>
                                    <div class="d-flex"
                                        style="
                                    display: flex;
                                    justify-content: center;
                                    align-items: center;">
                                    <div class="card-tools  mx-2">
                                        <a href="{{ route('admin.contact-messages.show', $message->id) }}"
                                            class="btn btn-sm"
                                            style="height: 21px;
                                                    width: 3rem; font-size: 8px;    background-color: #5d9531cc; color:white">
                                            <i class="fa fa-eye"></i> View
                                        </a>
                                    </div>
                                    <form action="{{ route('admin.contact-messages.destroy', $message->id) }}"
                                        method="post" onsubmit="return confirm('Delete this message?')"
                                        style="margin:0px;">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-sm btn-danger mx-2"
                                            style="height: 21px;
                                                    width: 3rem; font-size: 8px;">
                                            <i class="fa fa-trash"></i> Delete
                                        </button>
                                    </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </table>
                </div>
                {{ $messages->links() }}
            </div>
        </div>
    </div>
@endsection
