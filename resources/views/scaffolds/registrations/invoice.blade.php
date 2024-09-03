@extends('layouts.dashboard.master')

@section('content')
<!--begin::details View-->
<div class="card">
    <!-- begin::Body-->
    <div class="card-body py-20">
        <!-- begin::Wrapper-->
        <div class="mw-lg-950px mx-auto w-100">
            <!-- begin::Header-->
            <div class="d-flex justify-content-between flex-column flex-sm-row mb-19">
                <h4 class="fw-boldest text-gray-800 fs-2qx pe-5 pb-7">INVOICE</h4>
                <!--end::Logo-->
                <div class="text-sm-end">
                    <!--begin::Logo-->
                    <a href="#">
                        <img alt="Logo" src="assets/media/svg/brand-logos/duolingo.svg" />
                    </a>
                    <!--end::Logo-->
                    <!--begin::Text-->
                    <div class="text-sm-end fw-bold fs-4 text-muted mt-7">
                        <div>Jalan Otto Iskandardinata Kampung Tanjung, RT.003/RW.013,</div>
                        <div>Pasawahan, Kec. Tarogong Kaler, Kabupaten Garut, Jawa Barat 44151</div>
                    </div>
                    <!--end::Text-->
                </div>
            </div>
            <!--end::Header-->
            <!--begin::Body-->
            <div class="border-bottom pb-12">
                <!--begin::Wrapper-->
                <div class="d-flex justify-content-between flex-column flex-md-row">
                    <!--begin::Content-->
                    <div class="flex-grow-1 pt-8 mb-13">
                        <!--begin::Table-->
                        <div class="table-responsive border-bottom mb-14">
                            <table class="table">
                                <thead>
                                    <tr class="border-bottom fs-6 fw-bolder text-muted text-uppercase">
                                        <th class="min-w-175px pb-9">Description</th>
                                        <th class="min-w-70px pb-9 text-end">Quantity</th>
                                        <th class="min-w-80px pb-9 text-end">Per Unit</th>
                                        <th class="min-w-100px pe-lg-6 pb-9 text-end">Subtotal</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr class="fw-bolder text-gray-700 fs-5 text-end">
                                        <td class="d-flex align-items-center pt-11">
                                        <i class="fa fa-genderless text-danger fs-1 me-2"></i>{{ $data->type->name }} Room</td>
                                        <td class="pt-11">{{ count($data->room_id) }}</td>
                                        <td class="pt-11">Rp. {{ number_format($data->type->price, 0, ',', '.') }}</td>
                                        <td class="pt-11 fs-5 pe-lg-6 text-dark fw-boldest">Rp. <span>{{ number_format($data->type->price * count($data->room_id), 0, ',', '.') }}</span></td>
                                    </tr>
                                    @if ($addons)
                                        <tr class="fw-bolder text-gray-700 fs-5 text-end">
                                            <td class="d-flex align-items-center">
                                            <i class="fa fa-genderless text-success fs-1 me-2"></i>Add Ons</td>
                                            <td></td>
                                            <td></td>
                                            <td class="fs-5 text-dark fw-boldest pe-lg-6"></td>
                                        </tr>
                                        @foreach ($addons as $i)
                                        <tr class="fw-bolder text-gray-700 fs-5 text-end">
                                            <td class="d-flex align-items-center ms-5">{{ $i->name }}</td>
                                            <td></td>
                                            <td></td>
                                            <td class="fs-5 text-dark fw-boldest pe-lg-6">Rp. <span>{{ number_format($i->price, 0, ',', '.') }}</span></td>
                                        </tr>
                                        @endforeach
                                    @endif
                                    @if ($data->promotion_code)
                                        <tr class="fw-bolder text-gray-700 fs-5 text-end">
                                            <td class="d-flex align-items-center pb-10">
                                            <i class="fa fa-genderless text-primary fs-1 me-2"></i>Discount</td>
                                            <td>210</td>
                                            <td>$60.00</td>
                                            <td class="fs-5 text-dark fw-boldest pe-lg-6">$12600.00</td>
                                        </tr>
                                    @endif
                                </tbody>
                            </table>
                        </div>
                        <!--end::Table-->
                    </div>
                    <!--end::Content-->
                    <!--begin::Separator-->
                    <div class="border-end d-none d-md-block mh-450px mx-9"></div>
                    <!--end::Separator-->
                    <!--begin::Content-->
                    <div class="text-end pt-10">
                        <!--begin::Total Amount-->
                        <div class="fs-3 fw-bolder text-muted mb-3">TOTAL AMOUNT</div>
                        <div class="fs-xl-2x fs-2 fw-boldest">$20,600.00</div>
                        <div class="text-muted fw-bold">Taxes included</div>
                        <!--end::Total Amount-->
                        <div class="border-bottom w-100 my-7 my-lg-16"></div>
                        <!--begin::Invoice To-->
                        <div class="text-gray-600 fs-6 fw-bold mb-3">INVOICE TO.</div>
                        <div class="fs-6 text-gray-800 fw-bold mb-8">Iris Watson.
                        <br />Fredrick Nebraska 20620</div>
                        <!--end::Invoice To-->
                        <!--begin::Invoice No-->
                        <div class="text-gray-600 fs-6 fw-bold mb-3">INVOICE NO.</div>
                        <div class="fs-6 text-gray-800 fw-bold mb-8">56758</div>
                        <!--end::Invoice No-->
                        <!--begin::Invoice Date-->
                        <div class="text-gray-600 fs-6 fw-bold mb-3">DATE</div>
                        <div class="fs-6 text-gray-800 fw-bold">12 May, 2020</div>
                        <!--end::Invoice Date-->
                    </div>
                    <!--end::Content-->
                </div>
                <!--end::Wrapper-->
            </div>
            <!--end::Body-->
            <!-- begin::Footer-->
            <div class="d-flex flex-stack flex-wrap mt-lg-20 pt-13">
                <!-- begin::Actions-->
                <div class="my-1 me-5">
                    <!-- begin::Pint-->
                    <button type="button" class="btn btn-success my-1 me-12" onclick="window.print();">Print Invoice</button>
                    <!-- end::Pint-->
                    <!-- begin::Download-->
                    <button type="button" class="btn btn-light-success my-1">Download</button>
                    <!-- end::Download-->
                </div>
                <!-- end::Actions-->
                <!-- begin::Action-->
                <button type="button" class="btn btn-primary my-1">Create Invoice</button>
                <!-- end::Action-->
            </div>
            <!-- end::Footer-->
        </div>
        <!-- end::Wrapper-->
    </div>
    <!-- end::Body-->
</div>
<!--end::details View-->
@endsection