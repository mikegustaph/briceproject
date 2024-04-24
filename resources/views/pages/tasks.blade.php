@extends('layouts.main')
@section('content')
    <div class="content-wrapper">
        <div class="page-header">
            <h3 class="page-title"> Tasks </h3>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">Tasks</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Tasks</li>
                    <div class="btn-control" style="padding-left: 10px;">
                        <a type="button" href="{{ route('task.create') }}" class="btn btn-primary btn-fw">Add New
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
                                        <th> Task Name </th>
                                        <th> Task Note</th>
                                        <th> Assign To </th>
                                        <th> Status </th>
                                        <th> Action </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($tasks as $item)
                                        <tr>
                                            <td>
                                                <div class="form-check form-check-muted m-0">
                                                    <label class="form-check-label">
                                                        <input type="checkbox" class="form-check-input">
                                                    </label>
                                                </div>
                                            </td>
                                            <td>
                                                {{ $item->task_name }}
                                            </td>
                                            <td>
                                                {{ $item->task_note }}
                                            </td>
                                            <td><span class="ps-2">{{ $item->usertask->first_name }} </span></td>
                                            <td>
                                                <div class="badge badge-outline-success">Completed</div>
                                            </td>
                                            <td>
                                                <div class="template-demo">
                                                    <a href="{{ url('task/task_edit/' . $item->id) }}" type="button"
                                                        class="btn btn-primary"><i class="mdi mdi-border-color "></i></a>
                                                    <a href="{{ url('/task/task_delete/' . $item->id) }}" type="button"
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
