@extends('layouts.main')
@section('content')
    <div class="content-wrapper">
        <div class="page-header">
            <h3 class="page-title"> New User </h3>
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
                    <li class="breadcrumb-item"><a href="#">User</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Add New</li>
                </ol>
            </nav>
        </div>
        <!--Row-->
        <div class="row">
            <div class="col-md-6 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Create User Form</h4>
                        <p class="card-description"> Fields with star are mandatory for create new user </p>
                        <form class="forms-sample" method="POST" action="{{ route('user.newuser') }}"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="form-group row">
                                <label for="exampleInputUsername2" class="col-sm-3 col-form-label">First
                                    Name<span>*</span></label>
                                <div class="col-sm-9">
                                    <input type="text" style="color: white;" name="first_name" class="form-control"
                                        id="exampleInputUsername2" placeholder="First name" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="exampleInputUsername2" class="col-sm-3 col-form-label">Last
                                    Name<span>*</span></label>
                                <div class="col-sm-9">
                                    <input type="text" style="color: white;" name="last_name" class="form-control"
                                        id="exampleInputUsername2" placeholder="Last name" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="exampleSelectGender"
                                    class="col-sm-3 col-form-label">Gender<span>*</span></label>
                                <div class="col-sm-9">
                                    <select style="color: #6C7293;" name="sex" class="form-control"
                                        id="exampleSelectGender" required>
                                        <option value="Male">Male</option>
                                        <option value="Female">Female</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="exampleInputEmail2" class="col-sm-3 col-form-label">Email<span>*</span></label>
                                <div class="col-sm-9">
                                    <input type="email" style="color: white;" name="email" class="form-control"
                                        id="exampleInputEmail2" placeholder="Email" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="exampleInputMobile" class="col-sm-3 col-form-label">Mobile<span>*</span></label>
                                <div class="col-sm-9">
                                    <input type="tel" style="color: white;" name="mobile" class="form-control"
                                        id="exampleInputMobile" placeholder="Mobile number" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="exampleInputUsername2" class="col-sm-3 col-form-label">Birth Date</label>
                                <div class="col-sm-9">
                                    <input type="date" style="color: #6C7293;" name="birthdate" class="form-control"
                                        id="exampleInputUsername2">
                                </div>
                            </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title"></h4>
                        <p class="card-description"> </p>
                        <div class="form-group row">
                            <label for="exampleSelectGender" class="col-sm-3 col-form-label">Role</label>
                            <div class="col-sm-9">
                                <select style="color: #6C7293;" name="role_id" class="form-control"
                                    id="exampleSelectGender">
                                    <option value="1">Admin</option>
                                    <option value="0">Staff</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="exampleSelectGender" class="col-sm-3 col-form-label">Position</label>
                            <div class="col-sm-9">
                                <select style="color: #6C7293;" name="position" class="form-control"
                                    id="exampleSelectGender">
                                    <option value="Loan Officer">Loan Officer</option>
                                    <option value="Customer Support">Customer Support</option>
                                    <option value="Salesperson">Salesperson</option>
                                    <option value="Secretary">Secretary</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="exampleInputUsername2" class="col-sm-3 col-form-label">Address</label>
                            <div class="col-sm-9">
                                <input type="text" style="color: white;" name="address" class="form-control"
                                    id="exampleInputUsername2" placeholder="Address">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="exampleInputUsername2" class="col-sm-3 col-form-label">Profile Image</label>

                            <div class="col-sm-9">
                                <input type="file" style="color: white;" name="profile_img" accept=".png,.jpg"
                                    style="color: #6C7293;" class="form-control file-upload-info"
                                    placeholder="Upload Image">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="exampleInputUsername2" class="col-sm-3 col-form-label">CV</label>

                            <div class="col-sm-9">
                                <input type="file" style="color: white;" name="cv" accept=".pdf"
                                    style="color: #6C7293;" class="form-control file-upload-info"
                                    placeholder="Upload Image">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="exampleInputPassword2"
                                class="col-sm-3 col-form-label">Password<span>*</span></label>
                            <div class="col-sm-9">
                                <input type="password" style="color: white;" name="password" class="form-control"
                                    id="exampleInputPassword2" placeholder="Password" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="exampleInputConfirmPassword2" class="col-sm-3 col-form-label">Re
                                Password<span>*</span></label>
                            <div class="col-sm-9">
                                <input type="password" name="password_confirmation" style="color: white;"
                                    class="form-control" id="exampleInputConfirmPassword2" placeholder="Password"
                                    required>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary col-sm-3 me-2">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
