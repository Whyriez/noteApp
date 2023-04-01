@extends('../layouts.Dashboard')
@section('title', 'Dashboard')
@section('dashboard', 'active')

@section('content')

    <div class="content-header">
        <div class="container-fluid">
            <h1>Welcome {{ Auth::user()->username }}</h1>

        </div>
    </div>



@endsection
