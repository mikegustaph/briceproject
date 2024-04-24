@extends('layouts.main')
@section('content')
    <div class="content-wrapper">
        <div class="page-header">
            <h3 class="page-title"> FAQ </h3>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">App Setting</a></li>
                    <li class="breadcrumb-item active" aria-current="page">FAQ</li>
                    <div class="btn-control" style="padding-left: 10px;">
                        <a type="button" href="{{ route('app.faqcreate') }}" class="btn btn-primary btn-fw">Add New
                            <i class="mdi mdi-plus"></i></a>
                    </div>
                </ol>
            </nav>
        </div>
        <!--Row-->
        <div class="row ">
            <div class="col-12 grid-margin">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Order Status</h4>
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>
                                            <div class="form-check form-check-muted m-0">
                                                <label class="form-check-label">
                                                    <input type="checkbox" class="form-check-input">
                                                </label>
                                            </div>
                                        </th>
                                        <th> Created_By </th>
                                        <th> Title </th>
                                        <th> Action </th>

                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($faqres as $item)
                                        <tr>
                                            <td>
                                                <div class="form-check form-check-muted m-0">
                                                    <label class="form-check-label">
                                                        <input type="checkbox" class="form-check-input">
                                                    </label>
                                                </div>
                                            </td>
                                            <td> {{ $item->created_by }} </td>
                                            <td> {{ $item->title }} </td>
                                            <td>
                                                <div class="template-demo">
                                                    <a href="{{ url('/app/faq_edit/' . $item->id) }}" type="button"
                                                        class="btn btn-primary"><i class="mdi mdi-border-color "></i></a>
                                                    <a href="{{ url('/app/faq_delete/' . $item->id) }}" type="button"
                                                        class="btn btn-danger" data-toggle="modal"
                                                        data-target="#exampleModal"><i class="mdi mdi-delete "></i></a>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
