@extends('layouts.main')
@section('content')
    <div class="content-wrapper">
        <div class="page-header">
            <h3 class="page-title"> Create Task </h3>
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
                    <li class="breadcrumb-item"><a href="#">Task</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Create Task</li>
                </ol>
            </nav>
        </div>
        <!--Row-->
        <div class="row ">
            <div class="col-12 grid-margin">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Add new task</h4>
                        <form action="{{ url('/task/task_create') }}" method="POST" class="forms-sample"
                            enctype="multipart/form-data">
                            @csrf

                            <div class="form-group">
                                <label for="exampleInputName1"> Task Name</label>
                                <input type="text" style="color: white;" name="taskname" class="form-control"
                                    id="exampleInputName1" placeholder="Task name" required>
                            </div>
                            <div class="form-group">
                                <label for="exampleSelectGender" class="col-form-label"> Assign To</label>
                                <div class="">
                                    <select style="color: #6C7293;" name="assignto" class="form-control"
                                        id="exampleSelectGender">
                                        @foreach ($users as $user)
                                            @if ($user->role_id === 0)
                                                <option value="{{ $user->id }}">{{ $user->first_name }}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputName1"> Date</label>
                                <input type="date" style="color: white;" name="taskdate" class="form-control"
                                    id="exampleInputName1" required>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputName1"> Note</label>
                                <textarea type="text" style="color: white;" name="tasknote" rows="23" class="form-control"
                                    id="exampleInputName1"></textarea>
                            </div>
                            <button type="submit" class="btn btn-primary me-2">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
