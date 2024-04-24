@extends('layouts.main')
@section('content')
    <div class="content-wrapper">
        <div class="page-header">
            <h3 class="page-title"> Privacy </h3>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">App Setting</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Privacy</li>
                </ol>
            </nav>
        </div>
        <!--Row-->
        <div class="row ">
            <div class="col-12 grid-margin">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Edit Privacy Policy</h4>
                        <form action="{{ url('/app/policy_edit/' . $policy->id) }}" method="POST" class="forms-sample"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="form-group" style="display: none;">
                                <input type="text" value="{{ $policy->create_by }}" name="user"
                                    value="{{ Auth::user()->first_name }}" class="form-control" id="exampleInputName1"
                                    placeholder="Name">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputName1">Title</label>
                                <input type="text" value="{{ $policy->title }}" style="color: white;" name="name"
                                    class="form-control" id="exampleInputName1" placeholder="Name">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputName1">Text Area</label>
                                <textarea value="{{ $policy->content }}" style="color: white;" name="disclosuretext" class="form-control" id=""
                                    rows="35" required></textarea>
                            </div>
                            <button type="submit" class="btn btn-primary me-2">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
