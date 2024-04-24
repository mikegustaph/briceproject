@extends('layouts.main')
@section('content')
    <div class="content-wrapper">
        <div class="page-header">
            <h3 class="page-title"> Users </h3>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#"> System Users</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Staffs</li>
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
                                        <th>Image</th>
                                        <th> First Name </th>
                                        <th> Last Name </th>
                                        <th> Phone </th>
                                        <th> Email </th>
                                        <th> Status </th>
                                        <th> Action </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($users as $item)
                                        <tr>
                                            <td>
                                                <div class="form-check form-check-muted m-0">
                                                    <label class="form-check-label">
                                                        <input type="checkbox" class="form-check-input">
                                                    </label>
                                                </div>
                                            </td>
                                            <td>
                                                <img src="{{ Storage::url('public/SystemUser/' . $item->profile_image) }}"
                                                    alt="image" />
                                            </td>
                                            <td>{{ $item->first_name }} </td>
                                            <td>{{ $item->last_name }} </td>
                                            <td>{{ $item->phone }} </td>
                                            <td>{{ $item->position }}</td>
                                            <td>
                                                <div class="badge badge-outline-success">Active</div>
                                            </td>
                                            <td>
                                                <a href="{{ url('/system_user_profile/' . $item->id) }}"
                                                    class="btn btn-md btn-primary">View</a>

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
