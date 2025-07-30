@extends('dashboard')
@section('content')
    <!--begin::App-->
    <div class="d-flex flex-column flex-root app-root" id="kt_app_root">
        <!--begin::Page-->
        <div class="app-page flex-column flex-column-fluid" id="kt_app_page">
            <!--begin::Header-->
            @include('layouts._header')
            <!--end::Header-->
            <!--begin::Wrapper-->
            <div class="app-wrapper flex-column flex-row-fluid" id="kt_app_wrapper">
                <!--begin::Sidebar-->
                @include('layouts._sidebar')
                <!--end::Sidebar-->
                <!--begin::Main-->
                <div class="app-main flex-column flex-row-fluid" id="kt_app_main">
                    <!--begin::Content wrapper-->
                    <div class="d-flex flex-column flex-column-fluid">
                        <!--begin::Toolbar-->
                        <div id="kt_app_toolbar" class="app-toolbar py-3 py-lg-6">
                            <!--begin::Toolbar container-->
                            <div id="kt_app_toolbar_container" class="app-container container-xxl d-flex flex-stack">
                                <!--begin::Page title-->
                                <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
                                    <!--begin::Title-->
                                    <h1
                                        class="page-heading d-flex text-gray-900 fw-bold fs-3 flex-column justify-content-center my-0">
                                        User Logs</h1>
                                    <!--end::Title-->
                                    <!--begin::Breadcrumb-->
                                    <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
                                        <!--begin::Item-->
                                        <li class="breadcrumb-item text-muted">
                                            <a href="index.html" class="text-muted text-hover-primary">Home</a>
                                        </li>
                                        <!--end::Item-->
                                        <!--begin::Item-->
                                        <li class="breadcrumb-item">
                                            <span class="bullet bg-gray-500 w-5px h-2px"></span>
                                        </li>
                                        <!--end::Item-->
                                        <!--begin::Item-->
                                        <li class="breadcrumb-item text-muted">User Management</li>
                                        <li class="breadcrumb-item">
                                            <span class="bullet bg-gray-500 w-5px h-2px"></span>
                                        </li>
                                        <li class="breadcrumb-item text-muted">User Logs</li>
                                        <!--end::Item-->
                                    </ul>
                                    <!--end::Breadcrumb-->
                                </div>
                                <!--end::Page title-->
                                <!--begin::Alert-->
                                @if (session('status') === 'success')
                                    <div class="alert alert-success d-flex align-items-center p-5">
                                        <!--begin::Icon-->
                                        <i class="ki-duotone ki-shield-tick fs-2hx text-success me-4"><span
                                                class="path1"></span><span class="path2"></span></i>
                                        <div class="d-flex flex-column">
                                            <h4 class="mb-1 light">Success</h4>
                                            <span>{{ session('message') }}</span>
                                            <!--end::Content-->
                                        </div>
                                    </div>
                                @elseif (session('status') === 'error')
                                    <div class="alert alert-danger d-flex align-items-center p-5">
                                        <i class="ki-duotone ki-shield-tick fs-2hx text-danger me-4"><span
                                                class="path1"></span><span class="path2"></span></i>
                                        <div class="d-flex flex-column">
                                            <h4 class="mb-1 text-rose-600">Error</h4>
                                            <span>{{ session('message') }}</span>
                                        </div>
                                    </div>
                                @endif

                                @if ($errors->any())
                                    <div class="alert alert-danger">
                                        <ul>
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif

                                <script type="text/javascript">
                                    $(document).ready(function() {
                                        setTimeout(function() {
                                            $('.alert').fadeOut('slow');
                                        }, 5000);
                                    });
                                </script>

                            </div>
                            <!--end::Toolbar container-->
                        </div>
                        <!--end::Toolbar-->
                        <!--begin::Content-->
                        <div id="kt_app_content" class="app-content flex-column-fluid">
                            <!--begin::Content container-->
                            <div id="kt_app_content_container" class="app-container container-xxl">
                                <!--begin::Card-->
                                <!--start::Content-->
                                <!--begin::Login sessions-->
                                <div class="card mb-5 mb-lg-10">
                                    <!--begin::Card header-->
                                    <div class="card-header">
                                        <!--begin::Heading-->
                                        <div class="card-title">
                                            <h3>Login Sessions</h3>
                                        </div>
                                        <!--end::Heading-->
                                        <!--begin::Toolbar-->
                                        <div class="card-toolbar">
                                            <div class="my-1 me-4">
                                                <!--begin::Select-->
                                                <select class="form-select form-select-sm form-select-solid w-125px"
                                                    data-control="select2" data-placeholder="Select Hours"
                                                    data-hide-search="true">
                                                    <option value="1" selected="selected">1 Hours</option>
                                                    <option value="2">6 Hours</option>
                                                    <option value="3">12 Hours</option>
                                                    <option value="4">24 Hours</option>
                                                </select>
                                                <!--end::Select-->
                                            </div>
                                            <!--<a href="#" class="btn btn-sm btn-primary my-1">View All</a>-->
                                        </div>
                                        <!--end::Toolbar-->
                                    </div>
                                    <!--end::Card header-->
                                    <!--begin::Card body-->
                                    <div class="card-body p-0">
                                        <!--begin::Table wrapper-->
                                        <div class="table-responsive">
                                            <!--begin::Table-->
                                            <table class="table align-middle table-row-bordered table-row-solid gy-4 gs-9">
                                                <!--begin::Thead-->
                                                <thead class="border-gray-200 fs-5 fw-semibold bg-lighten">
                                                    <tr>
                                                        <th class="min-w-250px">User Agent</th>
                                                        <th class="min-w-100px">Suspicious Status</th>
                                                        <th class="min-w-150px">User Name</th>
                                                        <th class="min-w-150px">IP Address</th>
                                                        <th class="min-w-150px">Time</th>
                                                    </tr>
                                                </thead>
                                                <!--end::Thead-->
                                                <!--begin::Tbody-->
                                                <tbody class="fw-6 fw-semibold text-gray-600">
                                                    @foreach ($userlogs as $item)
                                                        <tr>
                                                            <td>
                                                                {{ $item->user_agent }}
                                                            </td>
                                                            <td>
                                                                @if ($item->is_suspicious == 0)
                                                                    <span
                                                                        class="badge badge-light-success fs-7 fw-bold">No</span>
                                                                @else
                                                                    <span
                                                                        class="badge badge-light-danger fs-7 fw-bold">Yes</span>
                                                                @endif

                                                            </td>
                                                            <td>{{ $item->user->first_name }} {{ $item->user->last_name }}
                                                            </td>
                                                            <td>{{ $item->ip_address }}</td>
                                                            <td>{{ $item->logged_in_at }}</td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                                <!--end::Tbody-->
                                            </table>
                                            <!--end::Table-->
                                        </div>
                                        <!--end::Table wrapper-->
                                    </div>
                                    <!--end::Card body-->
                                </div>
                                <!--end::Login sessions-->

                                <!--end::Content Container-->
                            </div>
                            <!--end::Content container-->
                        </div>
                        <!--end::Content-->
                    </div>
                    <!--end::Content wrapper-->
                    <!--begin::Footer-->
                    @include('layouts._footer')
                    <!--end::Footer-->
                </div>
                <!--end:::Main-->
            </div>
            <!--end::Wrapper-->
        </div>
        <!--end::Page-->
    </div>
    <script type="text/javascript">
        const password = document.getElementById('password');
        const confirmPassword = document.getElementById('confirmPassword');
        const message = document.getElementById('message');

        function checkPasswordMatch() {
            if (password.value !== confirmPassword.value) {
                message.textContent = 'Passwords do not match!';
            } else {
                message.textContent = '';
            }
        }

        password.addEventListener('input', checkPasswordMatch);
        confirmPassword.addEventListener('input', checkPasswordMatch);

        document.getElementById('passwordForm').addEventListener('submit', function(e) {
            if (password.value !== confirmPassword.value) {
                e.preventDefault();
                alert('Passwords must match before submitting!');
            }
        });
    </script>
    <!--end::App-->
    <!--begin::Drawers-->
    @include('widget.drawer')
    <!--end::Drawers-->
    <!--begin::Scrolltop-->
    <div id="kt_scrolltop" class="scrolltop" data-kt-scrolltop="true">
        <i class="ki-duotone ki-arrow-up">
            <span class="path1"></span>
            <span class="path2"></span>
        </i>
    </div>
    <!--end::Scrolltop-->
    <!--begin::Modals-->
    @include('widget.modal')
    <!--end::Modal - Invite Friend-->
    @include('scripts._createuser_script')
@endsection
