@extends('layouts.main')
@section('content')
    <div class="content-wrapper">
        <div class="page-header">
            <h3 class="page-title"> App Report </h3>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">Report</a></li>
                    <li class="breadcrumb-item active" aria-current="page">App Report</li>
                </ol>
            </nav>
        </div>
        <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <nav>
                            <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                <button class="nav-link active" id="nav-home-tab" data-bs-toggle="tab"
                                    data-bs-target="#nav-home" type="button" role="tab" aria-controls="nav-home"
                                    aria-selected="true">Generate Report
                                </button>
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
                                                <label for="exampleInputUsername2" class="col-sm-3 col-form-label">From
                                                    Date</label>
                                                <div class="col-sm-9">
                                                    <input type="date" value="" style="color: white;"
                                                        name="fromdate" class="form-control" id="exampleInputUsername2"
                                                        placeholder="From date" required>
                                                </div>
                                            </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <label for="exampleInputUsername2" class="col-sm-3 col-form-label">To
                                                Date</label>
                                            <div class="col-sm-9">
                                                <input type="date" value="" style="color: white;" name="todate"
                                                    class="form-control" id="exampleInputUsername2" placeholder="To date"
                                                    required>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <button type="submit" style="float: right;padding:10px;"
                                            class="btn btn-primary col-sm-3">Generate</button>
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
