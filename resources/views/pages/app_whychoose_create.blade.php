@extends('layouts.main')
@section('content')
    <div class="content-wrapper">
        <div class="page-header">
            <h3 class="page-title"> Why Choose Us </h3>
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
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">App Setting</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Why Choose us</li>
                </ol>
            </nav>
        </div>
        <!--Row-->
        <div class="row ">
            <div class="col-12 grid-margin">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Add New why choose us</h4>
                        <form action="{{ url('/app/whychoose_us_create') }}" method="POST" class="forms-sample"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="form-group" style="display: none;">
                                <input type="text" name="user" value="{{ Auth::user()->first_name }}"
                                    class="form-control" id="exampleInputName1" placeholder="Name">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputName1">Title</label>
                                <input type="text" style="color: white;" name="title" class="form-control"
                                    id="exampleInputName1" placeholder="Title">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputName1">Interest Rate</label>
                                <input type="text" style="color: white;" name="intratext" class="form-control"
                                    id="exampleInputName1" placeholder="Interest Rate">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputName1">Service Charge</label>
                                <input type="text" style="color: white;" name="servCharge" class="form-control"
                                    id="exampleInputName1" placeholder="Service Charge">
                            </div>

                            <button type="submit" class="btn btn-primary me-2">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
