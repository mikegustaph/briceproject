@extends('layouts.main')
@section('content')
    <div class="content-wrapper">
        <div class="page-header">
            <h3 class="page-title"> Change Permission </h3>
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
                    <li class="breadcrumb-item"><a href="#">Role</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Permission</li>
                </ol>
            </nav>
        </div>
        <!--Row-->
        <div class="row">
            <div class="col-12 grid-margin">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Order Status</h4>
                        <div class="table-responsive">
                            <form action="{{ route('setting.changepermission') }}" method="POST" id="update_permission"
                                enctype="multipart/form-data">
                                @csrf
                                <table class="table">
                                    <div class="form-group">
                                        <input type="text" name="role_id" id="" style="display: none;"
                                            value="{{ $role->id }}">
                                    </div>
                                    <thead>
                                        <tr>
                                            <th><strong>Module Name</strong></th>
                                            </th>
                                            <th> View </th>
                                            <th> Add </th>
                                            <th> Edit </th>
                                            <th> Delete </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>
                                                View Dashboard
                                            </td>
                                            <td>
                                                @if (in_array('dashboard-view', $all_permission))
                                                    <div class="form-check form-check-muted m-0">
                                                        <label class="form-check-label">
                                                            <input name="dashboard-view" type="checkbox"
                                                                class="form-check-input" checked>
                                                        </label>
                                                    </div>
                                                @else
                                                    <div class="form-check form-check-muted m-0">
                                                        <label class="form-check-label">
                                                            <input name="dashboard-view" type="checkbox"
                                                                class="form-check-input">
                                                        </label>
                                                    </div>
                                                @endif
                                            </td>
                                            <td>
                                                @if (in_array('dashboard-add', $all_permission))
                                                    <div class="form-check form-check-muted m-0">
                                                        <label class="form-check-label">
                                                            <input name="dashboad-add" type="checkbox"
                                                                class="form-check-input" checked>
                                                        </label>
                                                    </div>
                                                @else
                                                    <div class="form-check form-check-muted m-0">
                                                        <label class="form-check-label">
                                                            <input name="dashboad-add" type="checkbox"
                                                                class="form-check-input">
                                                        </label>
                                                    </div>
                                                @endif
                                            </td>
                                            <td>
                                                @if (in_array('dashboard-edit', $all_permission))
                                                    <div class="form-check form-check-muted m-0">
                                                        <label class="form-check-label">
                                                            <input name="dashboard-edit" type="checkbox"
                                                                class="form-check-input" checked>
                                                        </label>
                                                    </div>
                                                @else
                                                    <div class="form-check form-check-muted m-0">
                                                        <label class="form-check-label">
                                                            <input name="dashboard-edit" type="checkbox"
                                                                class="form-check-input">
                                                        </label>
                                                    </div>
                                                @endif
                                            </td>
                                            <td>
                                                @if (in_array('dashboard-delete', $all_permission))
                                                    <div class="form-check form-check-muted m-0">
                                                        <label class="form-check-label">
                                                            <input name="dashboard-delete" type="checkbox"
                                                                class="form-check-input" checked>
                                                        </label>
                                                    </div>
                                                @else
                                                    <div class="form-check form-check-muted m-0">
                                                        <label class="form-check-label">
                                                            <input name="dashboard-delete" type="checkbox"
                                                                class="form-check-input">
                                                        </label>
                                                    </div>
                                                @endif
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                Customers
                                            </td>
                                            <td>
                                                @if (in_array('customer-view', $all_permission))
                                                    <div class="form-check form-check-muted m-0">
                                                        <label class="form-check-label">
                                                            <input name="customer-view" type="checkbox"
                                                                class="form-check-input" checked>
                                                        </label>
                                                    </div>
                                                @else
                                                    <div class="form-check form-check-muted m-0">
                                                        <label class="form-check-label">
                                                            <input name="customer-view" type="checkbox"
                                                                class="form-check-input">
                                                        </label>
                                                    </div>
                                                @endif
                                            </td>
                                            <td>
                                                @if (in_array('customer-add', $all_permission))
                                                    <div class="form-check form-check-muted m-0">
                                                        <label class="form-check-label">
                                                            <input name="customer-add" type="checkbox"
                                                                class="form-check-input" checked>
                                                        </label>
                                                    </div>
                                                @else
                                                    <div class="form-check form-check-muted m-0">
                                                        <label class="form-check-label">
                                                            <input name="customer-add" type="checkbox"
                                                                class="form-check-input">
                                                        </label>
                                                    </div>
                                                @endif
                                            </td>
                                            <td>
                                                @if (in_array('customer-edit', $all_permission))
                                                    <div class="form-check form-check-muted m-0">
                                                        <label class="form-check-label">
                                                            <input name="customer-edit" type="checkbox"
                                                                class="form-check-input" checked>
                                                        </label>
                                                    </div>
                                                @else
                                                    <div class="form-check form-check-muted m-0">
                                                        <label class="form-check-label">
                                                            <input name="customer-edit" type="checkbox"
                                                                class="form-check-input">
                                                        </label>
                                                    </div>
                                                @endif
                                            </td>
                                            <td>
                                                @if (in_array('customer-delete', $all_permission))
                                                    <div class="form-check form-check-muted m-0">
                                                        <label class="form-check-label">
                                                            <input name="customer-delete" type="checkbox"
                                                                class="form-check-input" checked>
                                                        </label>
                                                    </div>
                                                @else
                                                    <div class="form-check form-check-muted m-0">
                                                        <label class="form-check-label">
                                                            <input name="customer-delete" type="checkbox"
                                                                class="form-check-input">
                                                        </label>
                                                    </div>
                                                @endif
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                New Loan
                                            </td>
                                            <td>
                                                @if (in_array('NewLoan-view', $all_permission))
                                                    <div class="form-check form-check-muted m-0">
                                                        <label class="form-check-label">
                                                            <input name="NewLoan-view" type="checkbox"
                                                                class="form-check-input" checked>
                                                        </label>
                                                    </div>
                                                @else
                                                    <div class="form-check form-check-muted m-0">
                                                        <label class="form-check-label">
                                                            <input name="NewLoan-view" type="checkbox"
                                                                class="form-check-input">
                                                        </label>
                                                    </div>
                                                @endif
                                            </td>
                                            <td>
                                                @if (in_array('NewLoan-add', $all_permission))
                                                    <div class="form-check form-check-muted m-0">
                                                        <label class="form-check-label">
                                                            <input name="NewLoan-add" type="checkbox"
                                                                class="form-check-input" checked>
                                                        </label>
                                                    </div>
                                                @else
                                                    <div class="form-check form-check-muted m-0">
                                                        <label class="form-check-label">
                                                            <input name="NewLoan-add" type="checkbox"
                                                                class="form-check-input">
                                                        </label>
                                                    </div>
                                                @endif
                                            </td>
                                            <td>
                                                @if (in_array('NewLoan-edit', $all_permission))
                                                    <div class="form-check form-check-muted m-0">
                                                        <label class="form-check-label">
                                                            <input name="NewLoan-edit" type="checkbox"
                                                                class="form-check-input" checked>
                                                        </label>
                                                    </div>
                                                @else
                                                    <div class="form-check form-check-muted m-0">
                                                        <label class="form-check-label">
                                                            <input name="NewLoan-edit" type="checkbox"
                                                                class="form-check-input">
                                                        </label>
                                                    </div>
                                                @endif
                                            </td>
                                            <td>
                                                @if (in_array('NewLoan-delete', $all_permission))
                                                    <div class="form-check form-check-muted m-0">
                                                        <label class="form-check-label">
                                                            <input name="NewLoan-delete" type="checkbox"
                                                                class="form-check-input" checked>
                                                        </label>
                                                    </div>
                                                @else
                                                    <div class="form-check form-check-muted m-0">
                                                        <label class="form-check-label">
                                                            <input name="NewLoan-delete" type="checkbox"
                                                                class="form-check-input">
                                                        </label>
                                                    </div>
                                                @endif
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                Customer Details
                                            </td>
                                            <td>
                                                @if (in_array('CustomerDetail-view', $all_permission))
                                                    <div class="form-check form-check-muted m-0">
                                                        <label class="form-check-label">
                                                            <input name="CustomerDetail-view" type="checkbox"
                                                                class="form-check-input" checked>
                                                        </label>
                                                    </div>
                                                @else
                                                    <div class="form-check form-check-muted m-0">
                                                        <label class="form-check-label">
                                                            <input name="CustomerDetail-view" type="checkbox"
                                                                class="form-check-input">
                                                        </label>
                                                    </div>
                                                @endif
                                            </td>
                                            <td>
                                                @if (in_array('CustomerDetail-add', $all_permission))
                                                    <div class="form-check form-check-muted m-0">
                                                        <label class="form-check-label">
                                                            <input name="CustomerDetail-add" type="checkbox"
                                                                class="form-check-input" checked>
                                                        </label>
                                                    </div>
                                                @else
                                                    <div class="form-check form-check-muted m-0">
                                                        <label class="form-check-label">
                                                            <input name="CustomerDetail-add" type="checkbox"
                                                                class="form-check-input">
                                                        </label>
                                                    </div>
                                                @endif
                                            </td>
                                            <td>
                                                @if (in_array('CustomerDetail-edit', $all_permission))
                                                    <div class="form-check form-check-muted m-0">
                                                        <label class="form-check-label">
                                                            <input name="CustomerDetail-edit" type="checkbox"
                                                                class="form-check-input" checked>
                                                        </label>
                                                    </div>
                                                @else
                                                    <div class="form-check form-check-muted m-0">
                                                        <label class="form-check-label">
                                                            <input name="CustomerDetail-edit" type="checkbox"
                                                                class="form-check-input">
                                                        </label>
                                                    </div>
                                                @endif
                                            </td>
                                            <td>
                                                @if (in_array('CustomerDetail-delete', $all_permission))
                                                    <div class="form-check form-check-muted m-0">
                                                        <label class="form-check-label">
                                                            <input name="CustomerDetail-delete" type="checkbox"
                                                                class="form-check-input" checked>
                                                        </label>
                                                    </div>
                                                @else
                                                    <div class="form-check form-check-muted m-0">
                                                        <label class="form-check-label">
                                                            <input name="CustomerDetail-delete" type="checkbox"
                                                                class="form-check-input">
                                                        </label>
                                                    </div>
                                                @endif
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                Borrowing
                                            </td>
                                            <td>
                                                @if (in_array('Borrowing-view', $all_permission))
                                                    <div class="form-check form-check-muted m-0">
                                                        <label class="form-check-label">
                                                            <input name="Borrowing-view" type="checkbox"
                                                                class="form-check-input" checked>
                                                        </label>
                                                    </div>
                                                @else
                                                    <div class="form-check form-check-muted m-0">
                                                        <label class="form-check-label">
                                                            <input name="Borrowing-view" type="checkbox"
                                                                class="form-check-input">
                                                        </label>
                                                    </div>
                                                @endif
                                            </td>
                                            <td>
                                                @if (in_array('Borrowing-add', $all_permission))
                                                    <div class="form-check form-check-muted m-0">
                                                        <label class="form-check-label">
                                                            <input name="Borrowing-add" type="checkbox"
                                                                class="form-check-input" checked>
                                                        </label>
                                                    </div>
                                                @else
                                                    <div class="form-check form-check-muted m-0">
                                                        <label class="form-check-label">
                                                            <input name="Borrowing-add" type="checkbox"
                                                                class="form-check-input">
                                                        </label>
                                                    </div>
                                                @endif
                                            </td>
                                            <td>
                                                @if (in_array('Borrowing-edit', $all_permission))
                                                    <div class="form-check form-check-muted m-0">
                                                        <label class="form-check-label">
                                                            <input name="Borrowing-edit" type="checkbox"
                                                                class="form-check-input" checked>
                                                        </label>
                                                    </div>
                                                @else
                                                    <div class="form-check form-check-muted m-0">
                                                        <label class="form-check-label">
                                                            <input name="Borrowing-edit" type="checkbox"
                                                                class="form-check-input">
                                                        </label>
                                                    </div>
                                                @endif
                                            </td>
                                            <td>
                                                @if (in_array('Borrowing-delete', $all_permission))
                                                    <div class="form-check form-check-muted m-0">
                                                        <label class="form-check-label">
                                                            <input name="Borrowing-delete" type="checkbox"
                                                                class="form-check-input" checked>
                                                        </label>
                                                    </div>
                                                @else
                                                    <div class="form-check form-check-muted m-0">
                                                        <label class="form-check-label">
                                                            <input name="Borrowing-delete" type="checkbox"
                                                                class="form-check-input">
                                                        </label>
                                                    </div>
                                                @endif
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                Transaction History
                                            </td>
                                            <td>
                                                @if (in_array('Transaction-view', $all_permission))
                                                    <div class="form-check form-check-muted m-0">
                                                        <label class="form-check-label">
                                                            <input name="Transaction-view" type="checkbox"
                                                                class="form-check-input" checked>
                                                        </label>
                                                    </div>
                                                @else
                                                    <div class="form-check form-check-muted m-0">
                                                        <label class="form-check-label">
                                                            <input name="Transaction-view" type="checkbox"
                                                                class="form-check-input">
                                                        </label>
                                                    </div>
                                                @endif
                                            </td>
                                            <td>
                                                @if (in_array('Transaction-add', $all_permission))
                                                    <div class="form-check form-check-muted m-0">
                                                        <label class="form-check-label">
                                                            <input name="Transaction-view" type="checkbox"
                                                                class="form-check-input" checked>
                                                        </label>
                                                    </div>
                                                @else
                                                    <div class="form-check form-check-muted m-0">
                                                        <label class="form-check-label">
                                                            <input name="Transaction-view" type="checkbox"
                                                                class="form-check-input">
                                                        </label>
                                                    </div>
                                                @endif
                                            </td>
                                            <td>
                                                @if (in_array('Transaction-edit', $all_permission))
                                                    <div class="form-check form-check-muted m-0">
                                                        <label class="form-check-label">
                                                            <input name="Transaction-detail" type="checkbox"
                                                                class="form-check-input" checked>
                                                        </label>
                                                    </div>
                                                @else
                                                    <div class="form-check form-check-muted m-0">
                                                        <label class="form-check-label">
                                                            <input name="Transaction-datail" type="checkbox"
                                                                class="form-check-input">
                                                        </label>
                                                    </div>
                                                @endif
                                            </td>
                                            <td>
                                                @if (in_array('Transaction-delete', $all_permission))
                                                    <div class="form-check form-check-muted m-0">
                                                        <label class="form-check-label">
                                                            <input name="Transaction-delete" type="checkbox"
                                                                class="form-check-input" checked>
                                                        </label>
                                                    </div>
                                                @else
                                                    <div class="form-check form-check-muted m-0">
                                                        <label class="form-check-label">
                                                            <input name="Transaction-delete" type="checkbox"
                                                                class="form-check-input">
                                                        </label>
                                                    </div>
                                                @endif
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                App Setting
                                            </td>
                                            <td>
                                                @if (in_array('AppSetting-view', $all_permission))
                                                    <div class="form-check form-check-muted m-0">
                                                        <label class="form-check-label">
                                                            <input name="AppSetting-view" type="checkbox"
                                                                class="form-check-input" checked>
                                                        </label>
                                                    </div>
                                                @else
                                                    <div class="form-check form-check-muted m-0">
                                                        <label class="form-check-label">
                                                            <input name="AppSetting-view" type="checkbox"
                                                                class="form-check-input">
                                                        </label>
                                                    </div>
                                                @endif
                                            </td>
                                            <td>
                                                @if (in_array('AppSetting-add', $all_permission))
                                                    <div class="form-check form-check-muted m-0">
                                                        <label class="form-check-label">
                                                            <input name="AppSetting-add" type="checkbox"
                                                                class="form-check-input" checked>
                                                        </label>
                                                    </div>
                                                @else
                                                    <div class="form-check form-check-muted m-0">
                                                        <label class="form-check-label">
                                                            <input name="AppSetting-add" type="checkbox"
                                                                class="form-check-input">
                                                        </label>
                                                    </div>
                                                @endif
                                            </td>
                                            <td>
                                                @if (in_array('AppSetting-edit', $all_permission))
                                                    <div class="form-check form-check-muted m-0">
                                                        <label class="form-check-label">
                                                            <input name="AppSetting-edit" type="checkbox"
                                                                class="form-check-input" checked>
                                                        </label>
                                                    </div>
                                                @else
                                                    <div class="form-check form-check-muted m-0">
                                                        <label class="form-check-label">
                                                            <input name="AppSetting-edit" type="checkbox"
                                                                class="form-check-input">
                                                        </label>
                                                    </div>
                                                @endif
                                            </td>
                                            <td>
                                                @if (in_array('AppSetting-delete', $all_permission))
                                                    <div class="form-check form-check-muted m-0">
                                                        <label class="form-check-label">
                                                            <input name="AppSetting-delete" type="checkbox"
                                                                class="form-check-input" checked>
                                                        </label>
                                                    </div>
                                                @else
                                                    <div class="form-check form-check-muted m-0">
                                                        <label class="form-check-label">
                                                            <input name="AppSetting-delete" type="checkbox"
                                                                class="form-check-input">
                                                        </label>
                                                    </div>
                                                @endif
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                System Setting
                                            </td>
                                            <td>
                                                @if (in_array('SystemSetting-view', $all_permission))
                                                    <div class="form-check form-check-muted m-0">
                                                        <label class="form-check-label">
                                                            <input name="SystemSetting-view" type="checkbox"
                                                                class="form-check-input" checked>
                                                        </label>
                                                    </div>
                                                @else
                                                    <div class="form-check form-check-muted m-0">
                                                        <label class="form-check-label">
                                                            <input name="SystemSetting-view" type="checkbox"
                                                                class="form-check-input">
                                                        </label>
                                                    </div>
                                                @endif
                                            </td>
                                            <td>
                                                @if (in_array('SystemSetting-add', $all_permission))
                                                    <div class="form-check form-check-muted m-0">
                                                        <label class="form-check-label">
                                                            <input name="SystemSetting-add" type="checkbox"
                                                                class="form-check-input" checked>
                                                        </label>
                                                    </div>
                                                @else
                                                    <div class="form-check form-check-muted m-0">
                                                        <label class="form-check-label">
                                                            <input name="SystemSetting-add" type="checkbox"
                                                                class="form-check-input">
                                                        </label>
                                                    </div>
                                                @endif
                                            </td>
                                            <td>
                                                @if (in_array('SystemSetting-edit', $all_permission))
                                                    <div class="form-check form-check-muted m-0">
                                                        <label class="form-check-label">
                                                            <input name="SystemSetting-edit" type="checkbox"
                                                                class="form-check-input" checked>
                                                        </label>
                                                    </div>
                                                @else
                                                    <div class="form-check form-check-muted m-0">
                                                        <label class="form-check-label">
                                                            <input name="SystemSetting-edit" type="checkbox"
                                                                class="form-check-input">
                                                        </label>
                                                    </div>
                                                @endif
                                            </td>
                                            <td>
                                                @if (in_array('SystemSetting-delete', $all_permission))
                                                    <div class="form-check form-check-muted m-0">
                                                        <label class="form-check-label">
                                                            <input name="SystemSetting-delete" type="checkbox"
                                                                class="form-check-input" checked>
                                                        </label>
                                                    </div>
                                                @else
                                                    <div class="form-check form-check-muted m-0">
                                                        <label class="form-check-label">
                                                            <input name="SystemSetting-delete" type="checkbox"
                                                                class="form-check-input">
                                                        </label>
                                                    </div>
                                                @endif
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                Report
                                            </td>
                                            <td>
                                                @if (in_array('Report-view', $all_permission))
                                                    <div class="form-check form-check-muted m-0">
                                                        <label class="form-check-label">
                                                            <input name="Report-view" type="checkbox"
                                                                class="form-check-input" checked>
                                                        </label>
                                                    </div>
                                                @else
                                                    <div class="form-check form-check-muted m-0">
                                                        <label class="form-check-label">
                                                            <input name="Report-view" type="checkbox"
                                                                class="form-check-input">
                                                        </label>
                                                    </div>
                                                @endif
                                            </td>
                                            <td>
                                                @if (in_array('Report-add', $all_permission))
                                                    <div class="form-check form-check-muted m-0">
                                                        <label class="form-check-label">
                                                            <input name="Report-add" type="checkbox"
                                                                class="form-check-input" checked>
                                                        </label>
                                                    </div>
                                                @else
                                                    <div class="form-check form-check-muted m-0">
                                                        <label class="form-check-label">
                                                            <input name="Report-add" type="checkbox"
                                                                class="form-check-input">
                                                        </label>
                                                    </div>
                                                @endif
                                            </td>
                                            <td>
                                                @if (in_array('Report-edit', $all_permission))
                                                    <div class="form-check form-check-muted m-0">
                                                        <label class="form-check-label">
                                                            <input name="Report-edit" type="checkbox"
                                                                class="form-check-input" checked>
                                                        </label>
                                                    </div>
                                                @else
                                                    <div class="form-check form-check-muted m-0">
                                                        <label class="form-check-label">
                                                            <input name="Report-edit" type="checkbox"
                                                                class="form-check-input">
                                                        </label>
                                                    </div>
                                                @endif
                                            </td>
                                            <td>
                                                @if (in_array('Report-delete', $all_permission))
                                                    <div class="form-check form-check-muted m-0">
                                                        <label class="form-check-label">
                                                            <input name="Report-delete" type="checkbox"
                                                                class="form-check-input" checked>
                                                        </label>
                                                    </div>
                                                @else
                                                    <div class="form-check form-check-muted m-0">
                                                        <label class="form-check-label">
                                                            <input name="Report-delete" type="checkbox"
                                                                class="form-check-input">
                                                        </label>
                                                    </div>
                                                @endif
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                        </div>
                        <div class="row" style="margin: 15px 0 0;">
                            <div class="col-md-12">
                                <button style="float:right;" type="submit" class="btn btn-primary me-2">Save
                                    Changes</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
