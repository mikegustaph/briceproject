@extends('layouts.main')
@section('content')
    <div class="content-wrapper">
        <div class="page-header">
            <h3 class="page-title"> Customers </h3>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">Loan Management</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Customers</li>
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
                                        <th> Client Name </th>
                                        <th> Order No </th>
                                        <th> Product Cost </th>
                                        <th> Project </th>
                                        <th> Payment Mode </th>
                                        <th> Start Date </th>
                                        <th> Status </th>
                                        <th> Action </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>
                                            <div class="form-check form-check-muted m-0">
                                                <label class="form-check-label">
                                                    <input type="checkbox" class="form-check-input">
                                                </label>
                                            </div>
                                        </td>
                                        <td>
                                            <img src="assets/images/faces/face1.jpg" alt="image" />
                                            <span class="ps-2">Henry Klein</span>
                                        </td>
                                        <td> 02312 </td>
                                        <td> $14,500 </td>
                                        <td> Dashboard </td>
                                        <td> Credit card </td>
                                        <td> 04 Dec 2019 </td>
                                        <td>
                                            <div class="badge badge-outline-success">Approved</div>
                                        </td>
                                        <td> </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
