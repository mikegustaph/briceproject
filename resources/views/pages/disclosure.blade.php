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
                                        Disclosure</h1>
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
                                        <li class="breadcrumb-item text-muted">App Management</li>
                                        <li class="breadcrumb-item">
                                            <span class="bullet bg-gray-500 w-5px h-2px"></span>
                                        </li>
                                        <li class="breadcrumb-item text-muted">Disclosure</li>
                                        <!--end::Item-->
                                    </ul>
                                    <!--end::Breadcrumb-->
                                </div>
                                <!--end::Page title-->
                                <!--begin::Actions-->
                                <div class="d-flex align-items-center gap-2 gap-lg-3">

                                </div>
                                <!--end::Actions-->
                            </div>
                            <!--end::Toolbar container-->
                        </div>
                        <!--end::Toolbar-->
                        <!--begin::Content-->
                        <div id="kt_app_content" class="app-content flex-column-fluid">
                            <!--begin::Content container-->
                            <div id="kt_app_content_container" class="app-container container-xxl">
                                <!--begin::Card-->
                                <div class="card">
                                    <!--begin::Card header-->
                                    <div class="card-header border-0 pt-6">
                                        <!--begin::Card title-->
                                        <div class="card-title">
                                            <!--begin::Search-->
                                            <div class="d-flex align-items-center position-relative my-1">
                                                <i class="ki-duotone ki-magnifier fs-3 position-absolute ms-5">
                                                    <span class="path1"></span>
                                                    <span class="path2"></span>
                                                </i>
                                                <input type="text" data-kt-customer-table-filter="search"
                                                    class="form-control form-control-solid w-250px ps-12"
                                                    placeholder="Search Disclosure" />
                                            </div>
                                            <!--end::Search-->
                                        </div>
                                        <!--begin::Card title-->
                                        <!--begin::Card toolbar-->
                                        <div class="card-toolbar">
                                            <!--begin::Toolbar-->
                                            <div class="d-flex justify-content-end" data-kt-customer-table-toolbar="base">
                                                <!--begin::Add customer-->
                                                <a type="button" class="btn btn-primary"
                                                    href="{{ URL::to('disclosure-create') }}">Add
                                                    Disclosure</a>
                                                <!--end::Add customer-->
                                            </div>
                                            <!--end::Toolbar-->
                                            <!--begin::Group actions-->
                                            <div class="d-flex justify-content-end align-items-center d-none"
                                                data-kt-customer-table-toolbar="selected">
                                                <div class="fw-bold me-5">
                                                    <span class="me-2"
                                                        data-kt-customer-table-select="selected_count"></span>Selected
                                                </div>
                                                <button type="button" class="btn btn-danger"
                                                    data-kt-customer-table-select="delete_selected">Delete
                                                    Selected</button>
                                            </div>
                                            <!--end::Group actions-->
                                        </div>
                                        <!--end::Card toolbar-->
                                    </div>
                                    <!--end::Card header-->
                                    <!--begin::Card body-->
                                    <div class="card-body pt-0">
                                        <!--begin::Table-->
                                        <table class="table align-middle table-row-dashed fs-6 gy-5"
                                            id="kt_customers_table">
                                            <thead>
                                                <tr class="text-start text-gray-500 fw-bold fs-7 text-uppercase gs-0">
                                                    <th class="w-10px pe-2">
                                                        <div
                                                            class="form-check form-check-sm form-check-custom form-check-solid me-3">
                                                            <input class="form-check-input" type="checkbox"
                                                                data-kt-check="true"
                                                                data-kt-check-target="#kt_customers_table .form-check-input"
                                                                value="1" />
                                                        </div>
                                                    </th>
                                                    <th class="min-w-125px">Disclosure</th>
                                                    <th class="min-w-125px">Description</th>
                                                    <th class="min-w-125px">Created Date</th>
                                                    <th class="text-end min-w-70px">Actions</th>
                                                </tr>
                                            </thead>
                                            <tbody class="fw-semibold text-gray-600">
                                                @foreach ($disclo as $item)
                                                    <tr>
                                                        <td>
                                                            <div
                                                                class="form-check form-check-sm form-check-custom form-check-solid">
                                                                <input class="form-check-input" type="checkbox"
                                                                    value="1" />
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <a href="apps/customers/view.html"
                                                                class="text-gray-800 text-hover-primary mb-1">{{ $item->title }}</a>
                                                        </td>
                                                        <td>
                                                            <a href="#"
                                                                class="text-gray-600 text-hover-primary mb-1">{{ $item->description }}</a>
                                                        </td>
                                                        <td>{{ (new DateTime($item->created_at))->format('d M Y, g:i a') }}
                                                        </td>
                                                        <td class="text-end">
                                                            <a href="#"
                                                                class="btn btn-sm btn-light btn-flex btn-center btn-active-light-primary"
                                                                data-kt-menu-trigger="click"
                                                                data-kt-menu-placement="bottom-end">Actions
                                                                <i class="ki-duotone ki-down fs-5 ms-1"></i></a>
                                                            <!--begin::Menu-->
                                                            <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-semibold fs-7 w-125px py-4"
                                                                data-kt-menu="true">
                                                                <!--begin::Menu item-->
                                                                <div class="menu-item px-3">
                                                                    <a href="{{ url('/disclosure-edit/' . $item->id) }}"
                                                                        class="menu-link px-3">Edit</a>
                                                                </div>
                                                                <!--end::Menu item-->
                                                                <!--begin::Menu item-->
                                                                <div class="menu-item px-3">
                                                                    <a href="{{ url('/disclosure-delete/' . $item->id) }}"
                                                                        class="menu-link px-3"
                                                                        data-kt-customer-table-filter="delete_row">Delete</a>
                                                                </div>
                                                                <!--end::Menu item-->
                                                            </div>
                                                            <!--end::Menu-->
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                        <!--end::Table-->
                                    </div>
                                    <!--end::Card body-->
                                </div>
                                <!--end::Card-->
                                <!--begin::Modals-->
                                <!--begin::Modal - Customers - Add-->
                                <div class="modal fade" id="kt_modal_add_customer" tabindex="-1" aria-hidden="true">
                                    <!--begin::Modal dialog-->
                                    <div class="modal-dialog modal-dialog-centered mw-650px">
                                        <!--begin::Modal content-->
                                        <div class="modal-content">
                                            <!--begin::Form-->
                                            <form class="form" action="#" id="kt_modal_add_customer_form"
                                                data-kt-redirect="apps/customers/list.html">
                                                <!--begin::Modal header-->
                                                <div class="modal-header" id="kt_modal_add_customer_header">
                                                    <!--begin::Modal title-->
                                                    <h2 class="fw-bold">Add a Customer</h2>
                                                    <!--end::Modal title-->
                                                    <!--begin::Close-->
                                                    <div id="kt_modal_add_customer_close"
                                                        class="btn btn-icon btn-sm btn-active-icon-primary">
                                                        <i class="ki-duotone ki-cross fs-1">
                                                            <span class="path1"></span>
                                                            <span class="path2"></span>
                                                        </i>
                                                    </div>
                                                    <!--end::Close-->
                                                </div>
                                                <!--end::Modal header-->
                                                <!--begin::Modal body-->
                                                <div class="modal-body py-10 px-lg-17">
                                                    <!--begin::Scroll-->
                                                    <div class="scroll-y me-n7 pe-7" id="kt_modal_add_customer_scroll"
                                                        data-kt-scroll="true"
                                                        data-kt-scroll-activate="{default: false, lg: true}"
                                                        data-kt-scroll-max-height="auto"
                                                        data-kt-scroll-dependencies="#kt_modal_add_customer_header"
                                                        data-kt-scroll-wrappers="#kt_modal_add_customer_scroll"
                                                        data-kt-scroll-offset="300px">
                                                        <!--begin::Input group-->
                                                        <div class="fv-row mb-7">
                                                            <!--begin::Label-->
                                                            <label class="required fs-6 fw-semibold mb-2">Name</label>
                                                            <!--end::Label-->
                                                            <!--begin::Input-->
                                                            <input type="text" class="form-control form-control-solid"
                                                                placeholder="" name="name" value="Sean Bean" />
                                                            <!--end::Input-->
                                                        </div>
                                                        <!--end::Input group-->
                                                        <!--begin::Input group-->
                                                        <div class="fv-row mb-7">
                                                            <!--begin::Label-->
                                                            <label class="fs-6 fw-semibold mb-2">
                                                                <span class="required">Email</span>
                                                                <span class="ms-1" data-bs-toggle="tooltip"
                                                                    title="Email address must be active">
                                                                    <i class="ki-duotone ki-information fs-7">
                                                                        <span class="path1"></span>
                                                                        <span class="path2"></span>
                                                                        <span class="path3"></span>
                                                                    </i>
                                                                </span>
                                                            </label>
                                                            <!--end::Label-->
                                                            <!--begin::Input-->
                                                            <input type="email" class="form-control form-control-solid"
                                                                placeholder="" name="email" value="sean@dellito.com" />
                                                            <!--end::Input-->
                                                        </div>
                                                        <!--end::Input group-->
                                                        <!--begin::Input group-->
                                                        <div class="fv-row mb-15">
                                                            <!--begin::Label-->
                                                            <label class="fs-6 fw-semibold mb-2">Description</label>
                                                            <!--end::Label-->
                                                            <!--begin::Input-->
                                                            <input type="text" class="form-control form-control-solid"
                                                                placeholder="" name="description" />
                                                            <!--end::Input-->
                                                        </div>
                                                        <!--end::Input group-->
                                                        <!--begin::Billing toggle-->
                                                        <div class="fw-bold fs-3 rotate collapsible mb-7"
                                                            data-bs-toggle="collapse"
                                                            href="#kt_modal_add_customer_billing_info" role="button"
                                                            aria-expanded="false"
                                                            aria-controls="kt_customer_view_details">Shipping Information
                                                            <span class="ms-2 rotate-180">
                                                                <i class="ki-duotone ki-down fs-3"></i>
                                                            </span>
                                                        </div>
                                                        <!--end::Billing toggle-->
                                                        <!--begin::Billing form-->
                                                        <div id="kt_modal_add_customer_billing_info"
                                                            class="collapse show">
                                                            <!--begin::Input group-->
                                                            <div class="d-flex flex-column mb-7 fv-row">
                                                                <!--begin::Label-->
                                                                <label class="required fs-6 fw-semibold mb-2">Address Line
                                                                    1</label>
                                                                <!--end::Label-->
                                                                <!--begin::Input-->
                                                                <input class="form-control form-control-solid"
                                                                    placeholder="" name="address1"
                                                                    value="101, Collins Street" />
                                                                <!--end::Input-->
                                                            </div>
                                                            <!--end::Input group-->
                                                            <!--begin::Input group-->
                                                            <div class="d-flex flex-column mb-7 fv-row">
                                                                <!--begin::Label-->
                                                                <label class="fs-6 fw-semibold mb-2">Address Line
                                                                    2</label>
                                                                <!--end::Label-->
                                                                <!--begin::Input-->
                                                                <input class="form-control form-control-solid"
                                                                    placeholder="" name="address2" value="" />
                                                                <!--end::Input-->
                                                            </div>
                                                            <!--end::Input group-->
                                                            <!--begin::Input group-->
                                                            <div class="d-flex flex-column mb-7 fv-row">
                                                                <!--begin::Label-->
                                                                <label class="required fs-6 fw-semibold mb-2">Town</label>
                                                                <!--end::Label-->
                                                                <!--begin::Input-->
                                                                <input class="form-control form-control-solid"
                                                                    placeholder="" name="city" value="Melbourne" />
                                                                <!--end::Input-->
                                                            </div>
                                                            <!--end::Input group-->
                                                            <!--begin::Input group-->
                                                            <div class="row g-9 mb-7">
                                                                <!--begin::Col-->
                                                                <div class="col-md-6 fv-row">
                                                                    <!--begin::Label-->
                                                                    <label class="required fs-6 fw-semibold mb-2">State /
                                                                        Province</label>
                                                                    <!--end::Label-->
                                                                    <!--begin::Input-->
                                                                    <input class="form-control form-control-solid"
                                                                        placeholder="" name="state" value="Victoria" />
                                                                    <!--end::Input-->
                                                                </div>
                                                                <!--end::Col-->
                                                                <!--begin::Col-->
                                                                <div class="col-md-6 fv-row">
                                                                    <!--begin::Label-->
                                                                    <label class="required fs-6 fw-semibold mb-2">Post
                                                                        Code</label>
                                                                    <!--end::Label-->
                                                                    <!--begin::Input-->
                                                                    <input class="form-control form-control-solid"
                                                                        placeholder="" name="postcode" value="3000" />
                                                                    <!--end::Input-->
                                                                </div>
                                                                <!--end::Col-->
                                                            </div>
                                                            <!--end::Input group-->
                                                            <!--begin::Input group-->
                                                            <div class="d-flex flex-column mb-7 fv-row">
                                                                <!--begin::Label-->
                                                                <label class="fs-6 fw-semibold mb-2">
                                                                    <span class="required">Country</span>
                                                                    <span class="ms-1" data-bs-toggle="tooltip"
                                                                        title="Country of origination">
                                                                        <i class="ki-duotone ki-information fs-7">
                                                                            <span class="path1"></span>
                                                                            <span class="path2"></span>
                                                                            <span class="path3"></span>
                                                                        </i>
                                                                    </span>
                                                                </label>
                                                                <!--end::Label-->
                                                                <!--begin::Input-->
                                                                @include('widget.country')
                                                                <!--end::Input-->
                                                            </div>
                                                            <!--end::Input group-->
                                                            <!--begin::Input group-->
                                                            <div class="fv-row mb-7">
                                                                <!--begin::Wrapper-->
                                                                <div class="d-flex flex-stack">
                                                                    <!--begin::Label-->
                                                                    <div class="me-5">
                                                                        <!--begin::Label-->
                                                                        <label class="fs-6 fw-semibold">Use as a billing
                                                                            adderess?</label>
                                                                        <!--end::Label-->
                                                                        <!--begin::Input-->
                                                                        <div class="fs-7 fw-semibold text-muted">If you
                                                                            need more info, please check budget planning
                                                                        </div>
                                                                        <!--end::Input-->
                                                                    </div>
                                                                    <!--end::Label-->
                                                                    <!--begin::Switch-->
                                                                    <label
                                                                        class="form-check form-switch form-check-custom form-check-solid">
                                                                        <!--begin::Input-->
                                                                        <input class="form-check-input" name="billing"
                                                                            type="checkbox" value="1"
                                                                            id="kt_modal_add_customer_billing"
                                                                            checked="checked" />
                                                                        <!--end::Input-->
                                                                        <!--begin::Label-->
                                                                        <span
                                                                            class="form-check-label fw-semibold text-muted"
                                                                            for="kt_modal_add_customer_billing">Yes</span>
                                                                        <!--end::Label-->
                                                                    </label>
                                                                    <!--end::Switch-->
                                                                </div>
                                                                <!--begin::Wrapper-->
                                                            </div>
                                                            <!--end::Input group-->
                                                        </div>
                                                        <!--end::Billing form-->
                                                    </div>
                                                    <!--end::Scroll-->
                                                </div>
                                                <!--end::Modal body-->
                                                <!--begin::Modal footer-->
                                                <div class="modal-footer flex-center">
                                                    <!--begin::Button-->
                                                    <button type="reset" id="kt_modal_add_customer_cancel"
                                                        class="btn btn-light me-3">Discard</button>
                                                    <!--end::Button-->
                                                    <!--begin::Button-->
                                                    <button type="submit" id="kt_modal_add_customer_submit"
                                                        class="btn btn-primary">
                                                        <span class="indicator-label">Submit</span>
                                                        <span class="indicator-progress">Please wait...
                                                            <span
                                                                class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                                                    </button>
                                                    <!--end::Button-->
                                                </div>
                                                <!--end::Modal footer-->
                                            </form>
                                            <!--end::Form-->
                                        </div>
                                    </div>
                                </div>
                                <!--end::Modal - Customers - Add-->
                                <!--begin::Modal - Adjust Balance-->
                                <div class="modal fade" id="kt_customers_export_modal" tabindex="-1"
                                    aria-hidden="true">
                                    <!--begin::Modal dialog-->
                                    <div class="modal-dialog modal-dialog-centered mw-650px">
                                        <!--begin::Modal content-->
                                        <div class="modal-content">
                                            <!--begin::Modal header-->
                                            <div class="modal-header">
                                                <!--begin::Modal title-->
                                                <h2 class="fw-bold">Export Customers</h2>
                                                <!--end::Modal title-->
                                                <!--begin::Close-->
                                                <div id="kt_customers_export_close"
                                                    class="btn btn-icon btn-sm btn-active-icon-primary">
                                                    <i class="ki-duotone ki-cross fs-1">
                                                        <span class="path1"></span>
                                                        <span class="path2"></span>
                                                    </i>
                                                </div>
                                                <!--end::Close-->
                                            </div>
                                            <!--end::Modal header-->
                                            <!--begin::Modal body-->
                                            <div class="modal-body scroll-y mx-5 mx-xl-15 my-7">
                                                <!--begin::Form-->
                                                <form id="kt_customers_export_form" class="form" action="#">
                                                    <!--begin::Input group-->
                                                    <div class="fv-row mb-10">
                                                        <!--begin::Label-->
                                                        <label class="fs-5 fw-semibold form-label mb-5">Select Export
                                                            Format:</label>
                                                        <!--end::Label-->
                                                        <!--begin::Input-->
                                                        <select data-control="select2" data-placeholder="Select a format"
                                                            data-hide-search="true" name="format"
                                                            class="form-select form-select-solid">
                                                            <option value="excell">Excel</option>
                                                            <option value="pdf">PDF</option>
                                                            <option value="cvs">CVS</option>
                                                            <option value="zip">ZIP</option>
                                                        </select>
                                                        <!--end::Input-->
                                                    </div>
                                                    <!--end::Input group-->
                                                    <!--begin::Input group-->
                                                    <div class="fv-row mb-10">
                                                        <!--begin::Label-->
                                                        <label class="fs-5 fw-semibold form-label mb-5">Select Date
                                                            Range:</label>
                                                        <!--end::Label-->
                                                        <!--begin::Input-->
                                                        <input class="form-control form-control-solid"
                                                            placeholder="Pick a date" name="date" />
                                                        <!--end::Input-->
                                                    </div>
                                                    <!--end::Input group-->
                                                    <!--begin::Row-->
                                                    <div class="row fv-row mb-15">
                                                        <!--begin::Label-->
                                                        <label class="fs-5 fw-semibold form-label mb-5">Payment
                                                            Type:</label>
                                                        <!--end::Label-->
                                                        <!--begin::Radio group-->
                                                        <div class="d-flex flex-column">
                                                            <!--begin::Radio button-->
                                                            <label
                                                                class="form-check form-check-custom form-check-sm form-check-solid mb-3">
                                                                <input class="form-check-input" type="checkbox"
                                                                    value="1" checked="checked"
                                                                    name="payment_type" />
                                                                <span
                                                                    class="form-check-label text-gray-600 fw-semibold">All</span>
                                                            </label>
                                                            <!--end::Radio button-->
                                                            <!--begin::Radio button-->
                                                            <label
                                                                class="form-check form-check-custom form-check-sm form-check-solid mb-3">
                                                                <input class="form-check-input" type="checkbox"
                                                                    value="2" checked="checked"
                                                                    name="payment_type" />
                                                                <span
                                                                    class="form-check-label text-gray-600 fw-semibold">Visa</span>
                                                            </label>
                                                            <!--end::Radio button-->
                                                            <!--begin::Radio button-->
                                                            <label
                                                                class="form-check form-check-custom form-check-sm form-check-solid mb-3">
                                                                <input class="form-check-input" type="checkbox"
                                                                    value="3" name="payment_type" />
                                                                <span
                                                                    class="form-check-label text-gray-600 fw-semibold">Mastercard</span>
                                                            </label>
                                                            <!--end::Radio button-->
                                                            <!--begin::Radio button-->
                                                            <label
                                                                class="form-check form-check-custom form-check-sm form-check-solid">
                                                                <input class="form-check-input" type="checkbox"
                                                                    value="4" name="payment_type" />
                                                                <span
                                                                    class="form-check-label text-gray-600 fw-semibold">American
                                                                    Express</span>
                                                            </label>
                                                            <!--end::Radio button-->
                                                        </div>
                                                        <!--end::Input group-->
                                                    </div>
                                                    <!--end::Row-->
                                                    <!--begin::Actions-->
                                                    <div class="text-center">
                                                        <button type="reset" id="kt_customers_export_cancel"
                                                            class="btn btn-light me-3">Discard</button>
                                                        <button type="submit" id="kt_customers_export_submit"
                                                            class="btn btn-primary">
                                                            <span class="indicator-label">Submit</span>
                                                            <span class="indicator-progress">Please wait...
                                                                <span
                                                                    class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                                                        </button>
                                                    </div>
                                                    <!--end::Actions-->
                                                </form>
                                                <!--end::Form-->
                                            </div>
                                            <!--end::Modal body-->
                                        </div>
                                        <!--end::Modal content-->
                                    </div>
                                    <!--end::Modal dialog-->
                                </div>
                                <!--end::Modal - New Card-->
                                <!--end::Modals-->
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
    <!--end::App-->
    <!--begin::Drawers-->
    <!--begin::Activities drawer-->
    @include('widget.drawer')
    <!--end::Chat drawer-->
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
    <!--begin::Modal - Upgrade plan-->
    @include('widget.modal')
    <!--end::Modal - Invite Friend-->
    @include('scripts._task_script')
@endsection
