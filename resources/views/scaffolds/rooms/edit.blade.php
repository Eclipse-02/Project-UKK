@extends('layouts.dashboard.master')

@section('content')
    <!--begin::Col-->
    <div class="col-xxl-12">
        <!--begin::Card-->
        <div class="card">
            <!--begin::Card header-->
            <div class="card-header">
                <!--begin::Card title-->
                <div class="card-title m-0 flex-column">
                    <h3 class="fw-bolder m-0">Edit Room Data</h3>
                    <div class="text-muted fs-7 fw-bold">Edit Data Ruangan</div>
                </div>
                <!--end::Card title-->
                <!--start::Button-->
                <!--start::Action-->
                <a href="{{ route('rooms.index') }}" class="btn btn-flex btn-light btn-light btn-active-primary fw-bolder align-self-center">
                    <!--begin::Svg Icon | path: assets/media/icons/duotune/arrows/arr002.svg-->
                    <span class="svg-icon svg-icon-muted svg-icon-2">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                            <path d="M9.60001 11H21C21.6 11 22 11.4 22 12C22 12.6 21.6 13 21 13H9.60001V11Z" fill="black"/>
                            <path opacity="0.3" d="M9.6 20V4L2.3 11.3C1.9 11.7 1.9 12.3 2.3 12.7L9.6 20Z" fill="black"/>
                        </svg>
                    </span>
                    <!--end::Svg Icon-->Return</a>
                <!--end::Button-->
                <!--end::Action-->
            </div>
            <!--end::Card header-->
            <!--begin::Form-->
            <form class="form" action="{{ route('rooms.update', $data->id) }}" method="POST">
                @csrf
                @method('PUT')

                <!--begin::Card body-->
                <div class="card-body p-9">
                    <!--begin::Input group-->
                    <div class="fv-row mb-5">
                        <!--begin::Label-->
                        <label class="d-flex align-items-center fs-5 fw-bold mb-2">
                            <span class="required">Room Type</span>
                        </label>
                        <!--end::Label-->
                        <!--begin::Select-->
                        <select class="form-select form-select-solid @error('room_type')is-invalid @enderror" name="room_type" id="room_type" data-control="select2" data-placeholder="Select Bed Type">
                            <option></option>
                            @foreach ($types as $i)
                                <option value="{{ $i->id }}" {{ old('room_type') ? (old('room_type') == $i->id ? 'selected' : '') : ($data->type_id == $i->id ? 'selected' : '') }}>{{ $i->name }}</option>
                            @endforeach
                        </select>
                        <!--end::Select-->
                        <!--begin::Error-->
                        @error('room_type')
                            <span class="invalid-feedback d-block" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                        <!--end::Error-->
                    </div>
                    <!--end::Input group-->
                    <!--begin::Input group-->
                    <div class="fv-row mb-5">
                        <!--begin::Label-->
                        <label class="d-flex align-items-center fs-5 fw-bold mb-2">
                            <span class="required">Room Number</span>
                        </label>
                        <!--end::Label-->
                        <!--begin::Input-->
                        <input class="form-control form-control form-control-solid @error('room_number')is-invalid @enderror" type="text" id="room_number" name="room_number" value="{{ old('room_number') ? old('room_number') : $data->room_number }}" />
                        <!--end::Input-->
                        <!--begin::Error-->
                        @error('room_number')
                            <span class="invalid-feedback d-block" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                        <!--end::Error-->
                    </div>
                    <!--end::Input group-->
                    @if ($facilities->count() != 0)
                        <!--begin::Input group-->
                        <div class="fv-row mb-5">
                            <!--begin::Label-->
                            <label class="d-flex align-items-center fs-5 fw-bold mb-2">
                                <span>Facilities</span>
                            </label>
                            <!--end::Label-->
                            @foreach ($facilities as $i)
                                <!--begin::Checkbox-->
                                <div class="form-check form-check-custom form-check-solid">
                                    <input class="form-check-input" type="checkbox" name="facility[]" value="{{ $i->name }}" id="{{ $i->name }}" {{ old('facility[]') == $i->name ? 'checked' : '' }} />
                                    <label class="form-check-label" for="{{ $i->name }}">
                                        {{ $i->name }}
                                    </label>
                                </div>
                                <!--end::Checkbox-->
                            @endforeach
                            <!--begin::Error-->
                            @error('facility[]')
                                <span class="invalid-feedback d-block" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                            <!--end::Error-->
                        </div>
                        <!--end::Input group-->
                    @endif
                    <!--begin::Input group-->
                    <div class="fv-row mb-5">
                        <!--begin::Label-->
                        <label class="d-flex align-items-center fs-5 fw-bold mb-2">
                            <span class="required">Status</span>
                        </label>
                        <!--end::Label-->
                        <!--begin::Select-->
                        <select class="form-select form-select-solid @error('status')is-invalid @enderror" name="status" id="status" data-control="select2" data-placeholder="Select Bed Type">
                            <option></option>
                            <option value="AV" {{ old('status') ? (old('status') == 'AV' ? 'selected' : '') : ($data->status == 'AV' ? 'selected' : '') }}>Available</option>
                            <option value="BK" {{ old('status') ? (old('status') == 'BK' ? 'selected' : '') : ($data->status == 'BK' ? 'selected' : '') }}>Booked</option>
                            <option value="IC" {{ old('status') ? (old('status') == 'IC' ? 'selected' : '') : ($data->status == 'IC' ? 'selected' : '') }}>In Cleaning</option>
                        </select>
                        <!--end::Select-->
                        <!--begin::Error-->
                        @error('status')
                            <span class="invalid-feedback d-block" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                        <!--end::Error-->
                    </div>
                    <!--end::Input group-->
                </div>
                <!--end::Card body-->
                <!--begin::Card footer-->
                <div class="card-footer d-flex justify-content-end py-6 px-9">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
                <!--end::Card footer-->
            </form>
            <!--end:Form-->
        </div>
        <!--end::Card-->
    </div>
    <!--end::Col-->
@endsection

@push('scripts')
    <script type="text/javascript">
        Inputmask("999", {
            "numericInput": true
        }).mask("#room_number");
    </script>
@endpush