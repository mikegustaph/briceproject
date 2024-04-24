@extends('layouts.main')
@section('content')
    <div class="content-wrapper">
        <div class="page-header">
            <h3 class="page-title"> Role </h3>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">Role</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Role List</li>
                    <div class="btn-control" style="padding-left: 10px;">
                        <a type="button" href="{{ route('setting.rolecreate') }}" class="btn btn-primary btn-fw">Add New
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
                        <h4 class="card-title">Role Status</h4>
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
                                        <th> Role </th>
                                        <th> Description </th>
                                        <th> Action </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if (!empty($roledata))
                                        @foreach ($roledata as $item)
                                            <tr>
                                                <td>
                                                    <div class="form-check form-check-muted m-0">
                                                        <label class="form-check-label">
                                                            <input type="checkbox" class="form-check-input">
                                                        </label>
                                                    </div>
                                                </td>
                                                <td>{{ $item->name }}</td>
                                                <td>{{ $item->guard_name }}</td>
                                                <td>
                                                    <div class="template-demo">
                                                        <a href="{{ url('/setting/change_permission/' . $item->id) }}"
                                                            type="button" class="btn btn-primary"><i
                                                                class="mdi mdi-border-color "></i></a>
                                                        @if ($item->id == 1)
                                                            <button href="{{ url('/setting/role_delete/' . $item->id) }}"
                                                                type="button" class="btn btn-danger" data-toggle="modal"
                                                                data-target="#exampleModal" disabled><i
                                                                    class="mdi mdi-delete "></i></button>
                                                        @else
                                                            <a href="{{ url('/setting/role_delete/' . $item->id) }}"
                                                                type="button" class="btn btn-danger" data-toggle="modal"
                                                                data-target="#exampleModal"><i
                                                                    class="mdi mdi-delete "></i></a>
                                                        @endif
                                                    </div>
                                                </td>

                                            </tr>
                                        @endforeach
                                    @endif

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
