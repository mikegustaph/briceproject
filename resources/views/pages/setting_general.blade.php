@extends('layouts.main')
@section('content')
    <div class="content-wrapper">
        <div class="page-header">
            <h3 class="page-title"> User Profile </h3>
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
                    <li class="breadcrumb-item"><a href="#">System</a></li>
                    <li class="breadcrumb-item active" aria-current="page">General</li>
                </ol>
            </nav>
        </div>
        <!--Row-->
        <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <nav>
                            <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                <button class="nav-link active" id="nav-home-tab" data-bs-toggle="tab"
                                    data-bs-target="#nav-home" type="button" role="tab" aria-controls="nav-home"
                                    aria-selected="true">User
                                    Profile</button>
                                <button class="nav-link" id="nav-contact-tab" data-bs-toggle="tab"
                                    data-bs-target="#nav-contact" type="button" role="tab" aria-controls="nav-contact"
                                    aria-selected="false">Attachment</button>
                            </div>
                        </nav>
                        <div class="tab-content" id="nav-tabContent">
                            <div class="tab-pane fade show active" id="nav-home" role="tabpanel"
                                aria-labelledby="nav-home-tab" tabindex="0">
                                <div class="row">
                                    <div class="col-md-6">
                                        <form class="forms-sample" method="POST" action=""
                                            enctype="multipart/form-data">
                                            @csrf
                                            <div class="form-group row">
                                                <label for="exampleInputUsername2" class="col-sm-3 col-form-label">System
                                                    Name</label>
                                                <div class="col-sm-9">
                                                    <input type="text" value="" style="color: white;"
                                                        name="first_name" class="form-control" id="exampleInputUsername2"
                                                        placeholder="First name" required>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="exampleInputUsername2" class="col-sm-3 col-form-label">Last
                                                    Name</label>
                                                <div class="col-sm-9">
                                                    <input type="text" value="" style="color: white;"
                                                        name="last_name" class="form-control" id="exampleInputUsername2"
                                                        placeholder="Last name" required>
                                                </div>
                                            </div>

                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <label for="exampleInputEmail2"
                                                class="col-sm-3 col-form-label">Email<span>*</span></label>
                                            <div class="col-sm-9">
                                                <input value="" type="email" style="color: white;" name="email"
                                                    class="form-control" id="exampleInputEmail2" placeholder="Email"
                                                    required>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="exampleInputMobile"
                                                class="col-sm-3 col-form-label">Mobile<span>*</span></label>
                                            <div class="col-sm-9">
                                                <input value="" type="tel" style="color: white;" name="mobile"
                                                    class="form-control" id="exampleInputMobile" placeholder="Mobile number"
                                                    required>
                                            </div>
                                        </div>
                                        <button type="submit" style="float: right;"
                                            class="btn btn-primary col-sm-3">Submit</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="nav-profile" role="tabpanel"
                                aria-labelledby="nav-profile-tab" tabindex="0">
                                <div class="row">
                                    <div class="col-md-6">
                                        <form class="forms-sample" method="POST" action=""
                                            enctype="multipart/form-data">
                                            @csrf
                                            <div class="form-group row">
                                                <label for="exampleInputPassword2"
                                                    class="col-sm-3 col-form-label">Password<span>*</span></label>
                                                <div class="col-sm-9">
                                                    <input type="password" style="color: white;" name="password"
                                                        class="form-control" id="exampleInputPassword2"
                                                        placeholder="Password" required>
                                                </div>
                                            </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <label for="exampleInputConfirmPassword2" class="col-sm-3 col-form-label">Re
                                                Password<span>*</span></label>
                                            <div class="col-sm-9">
                                                <input type="password" name="password_confirmation" style="color: white;"
                                                    class="form-control" id="exampleInputConfirmPassword2"
                                                    placeholder="Password" required>
                                            </div>
                                        </div>
                                        <button type="submit" style="float: right;"
                                            class="btn btn-primary col-sm-3">Submit</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="nav-contact" role="tabpanel"
                                aria-labelledby="nav-contact-tab" tabindex="0">
                                <div class="row">
                                    <div class="col-md-6">
                                        <form class="forms-sample" method="POST" action=""
                                            enctype="multipart/form-data">
                                            @csrf
                                            <div class="form-group row">
                                                <div class="col-sm-5">
                                                    <img src="" alt="image" width="149px" height="auto" />
                                                </div>
                                                <div class="col-sm-4" style="float: left;">
                                                    <input type="file" style="color: white;" name="profile_img"
                                                        class="form-control" id="exampleInputUsername2"
                                                        placeholder="First name" required>
                                                </div>
                                            </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <label for="exampleInputUsername2" class="col-sm-3 col-form-label">
                                                CV</label>
                                            <div class="col-sm-6">
                                                <input type="file" style="color: white;" name="cv"
                                                    class="form-control" id="exampleInputUsername2"
                                                    placeholder="First name" required>
                                            </div>
                                            <div class="col-sm-3">
                                                <a target="_blank" href="" class="btn btn-md btn-primary">View</a>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <button type="submit" style="float: right;"
                                            class="btn btn-primary col-sm-3">Submit</button>
                                        </form>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
