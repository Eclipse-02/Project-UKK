@extends('layouts.dashboard.master')

@section('content')
    <!--start::Col-->
    <div class="col-xxl-12">
        <!--begin::Card-->
        <div class="card">
            <!--begin::Card header-->
            <div class="card-header">
                <!--begin::Card title-->
                <div class="card-title m-0 flex-column">
                    <h3 class="fw-bolder m-0">Create Registration Data</h3>
                    <div class="text-muted fs-7 fw-bold">Create Data Registration</div>
                </div>
                <!--end::Card title-->
                <!--start::Button-->
                <!--start::Action-->
                <a href="{{ route('registrations.index') }}" class="btn btn-flex btn-light btn-light btn-active-primary fw-bolder align-self-center">
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
            <form class="form" action="{{ route('registrations.store') }}" method="POST">
                @csrf

                <!--begin::Card body-->
                <div class="card-body p-9">
                    <!--begin::Input group-->
                    <div class="fv-row mb-5">
                        <!--begin::Label-->
                        <label class="d-flex align-items-center fs-5 fw-bold mb-2">
                            <span class="required">Room</span>
                        </label>
                        <!--end::Label-->
                        <!--begin::Input-->
                        <select class="form-select form-select-solid @error('room_id')is-invalid @enderror" name="room_id" id="room_id" data-control="select2" data-placeholder="Select Room">
                           <option></option>
                           @foreach ($rooms as $room)
                                <option value="{{ $room->id }}">{{ $room->room_number }}</option>
                           @endforeach 
                        </select>
                        <!--end::Input-->
                        <!--begin::Error-->
                        @error('room_id')
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
                            <span class="required">Type</span>
                        </label>
                        <!--end::Label-->
                        <!--begin::Textarea-->
                        <select class="form-select form-select-solid @error('type_id')is-invalid @enderror" name="type_id" id="type_id" data-control="select2" data-placeholder="Select Type">
                            <option></option>
                            @foreach ($roomTypes as $type)
                                 <option value="{{ $type->id }}">{{ $type->name }}</option>
                            @endforeach 
                         </select>
                        <!--end::Textarea-->
                        <!--begin::Error-->
                        @error('type_id')
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
                            <span class="required">Add On</span>
                        </label>
                        <!--end::Label-->
                        <!--begin::Textarea-->
                        <select class="form-select form-select-solid @error('add_on_id')is-invalid @enderror" name="add_on_id" id="add_on_id" data-control="select2" data-placeholder="Select Add On">
                            <option></option>
                            @foreach ($roomAddOns as $addOn)
                                 <option value="{{ $addOn->id }}">{{ $addOn->name }}</option>
                            @endforeach 
                         </select>
                        <!--end::Textarea-->
                        <!--begin::Error-->
                        @error('add_on_id')
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
    
@endpush