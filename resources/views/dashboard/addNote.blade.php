@extends('../layouts.Dashboard')
@section('title', 'Add Note')
@section('addnote', 'active')
@section('content')


    <div class="container-fluid">
        <div class="row ml-3 mr-3 mt-3">
            <!-- left column -->
            <div class="w-100">
                <!-- general form elements -->
                @if (session('success'))
                    <div class="alert alert-success alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <h5><i class="icon fas fa-check"></i> Message!</h5>
                        {{ session('success') }}
                    </div>
                @endif

                <div class="card card-info">
                    <div class="card-header">
                        <h3 class="card-title">Add Your Note</h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <form action="addnote/save" method="POST">
                        @csrf
                        <div class="card-body">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Title</label>
                                <input type="text" class="form-control" name="title" placeholder="Enter Title">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Note</label>
                                <textarea class="form-control" rows="5" name="note" placeholder="Enter Note"></textarea>
                            </div>
                        </div>
                        <!-- /.card-body -->

                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary w-100">Add</button>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>





@endsection
