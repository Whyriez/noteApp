@extends('../layouts.Dashboard')
@section('title', 'My Note')
@section('listnote', 'active')
@section('content')

    <div class="content-header">
        <div class="container-fluid">
            @php
                $no = 1;
            @endphp

            @if ($data->isEmpty())
                <div class="text-center">
                    Empty Notes
                </div>
            @endif

            @foreach ($data as $key => $value)
                <div class="card rounded-3 shadow">
                    <div class="card-header">
                        <div class="text-bold">{{ $value->title }}
                            <a href="listnote/delete/{{ $value->id }}" class="btn btn-danger btn-sm float-right "
                                onclick="return confirm('Are you sure to delete this?');"><i class='far fa-trash-alt'></i></a>
                            <button type="button" class="btn btn-primary btn-sm float-right mr-3 " data-toggle="modal"
                                data-target="#exampleModal{{ $value->id }}"><i class='far fa-edit'></i></button>
                        </div>

                    </div>
                    <div class="card-body">
                        <p class="card-text">{{ $value->note }}</p>
                    </div>
                </div>
                @php
                    $no++;
                @endphp
                <!-- Modal -->
                <div class="modal fade" id="exampleModal{{ $value->id }}" tabindex="-1" role="dialog"
                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">{{ $value->title }}</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <form action="listnote/update" method="POST">
                                @csrf
                                @method('put')
                                <input type="hidden" name="id" value="{{ $value->id }}">
                                <div class="modal-body">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Title</label>
                                        <input type="text" class="form-control" name="title"
                                            value="{{ $value->title }}" placeholder="Enter Title">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Note</label>
                                        <textarea class="form-control" rows="5" name="note" placeholder="Enter Note">{{ $value->note }}</textarea>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary">Save changes</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

    </div>






@endsection
