@extends('layouts.main')
@section('content')
    <div class="content-wrapper">
        <div class="page-header">
            <h3 class="page-title"> Role </h3>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">Role</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Add Role</li>
                </ol>
                <div class="col-sm-6">
                    @if ($errors->any())
                        <div id="error-message" class="alert alert-fill-danger alert-dismissible" role="alert">
                            <ul id="error-message" class="alert alert-fill-danger alert-dismissible" role="alert">
                                @foreach ($errors->all() as $error)
                                    <li><strong>Oohps! </strong>{{ $error }}</li>
                                @endforeach
                            </ul>
                            <script>
                                $(document).ready(function() {
                                    setTimeout(function() {
                                        //$('#flash-message').fadeOut('slow');
                                        $('#error-message').fadeOut('slow');
                                    }, 5000); // Adjust the timeout value (in milliseconds) as needed
                                });
                            </script>
                        </div>
                    @endif
                    @if (session('success'))
                        <div id="flash-message" class="alert alert-fill-success alert-dismissible" role="alert">
                            {{ session('success') }}
                        </div>
                        <script>
                            $(document).ready(function() {
                                setTimeout(function() {
                                    $('#flash-message').fadeOut('slow');
                                    $('#error-message').fadeOut('slow');
                                }, 5000); // Adjust the timeout value (in milliseconds) as needed
                            });
                        </script>
                    @endif
                </div>
            </nav>
        </div>
        <!--Row-->
        <div class="row ">
            <div class="col-12 grid-margin">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Add New Role</h4>
                        <form action="{{ url('/setting/role_create') }}" method="POST" class="forms-sample"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label for="exampleInputName1">Role Name</label>
                                <input type="text" style="color: white;" name="role_name" class="form-control"
                                    id="exampleInputName1" placeholder="Name">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputName1">Guard Name</label>
                                <input type="text" style="color: white;" name="guardname" class="form-control"
                                    id="exampleInputName1" placeholder="Name">
                            </div>
                            <button type="submit" class="btn btn-primary me-2">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
