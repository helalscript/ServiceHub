@extends('backend.app')
@section('title', 'Service Create')

@push('styles')
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/css/dropify.css">

    <style>
        .dropify-wrapper {
            height: 200px;
        }

        .dropify-wrapper .dropify-preview .dropify-render img {
            display: block;
            margin-left: auto;
            margin-right: auto;
        }
    </style>
@endpush

@section('content')

    <div class="main-content-container overflow-hidden">
        <div class="d-flex justify-content-between align-items-center flex-wrap gap-2 mb-4">
            <h3 class="mb-0">Service Create</h3>
        </div>

        <div class="card bg-white border-0 rounded-3 mb-4">
            <div class="card-body p-4">

                <div class="mb-4">
                    <h4 class="fs-20 mb-1">Create a New Service</h4>
                    <p class="fs-15">Fill the form below to add a new service.</p>
                </div>

                <form action="{{ route('services.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="row">

                        {{-- Title --}}
                        <div class="col-lg-6">
                            <div class="form-group mb-4">
                                <label class="text-secondary">Title <span class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('title') is-invalid @enderror"
                                    name="title" value="{{ old('title') }}" placeholder="Enter Service Title">
                                @error('title')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        {{-- Sub Title --}}
                        <div class="col-lg-6">
                            <div class="form-group mb-4">
                                <label class="text-secondary">Sub Title <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="sub_title" value="{{ old('sub_title') }}"
                                    placeholder="Enter Sub Title">
                            </div>
                        </div>

                        {{-- Price --}}
                        <div class="col-lg-4">
                            <div class="form-group mb-4">
                                <label class="text-secondary">Price <span class="text-danger">*</span></label>
                                <input type="number" step="0.01" class="form-control" name="price"
                                    value="{{ old('price') }}" placeholder="Enter Price">
                            </div>
                        </div>

                        {{-- Tax --}}
                        <div class="col-lg-4">
                            <div class="form-group mb-4">
                                <label class="text-secondary">Tax % <span class="text-danger">*</span></label>
                                <input type="number" step="0.01" class="form-control" name="tax_percentage"
                                    value="{{ old('tax_percentage') }}" placeholder="Enter Tax Percentage">
                            </div>
                        </div>

                        {{-- Shipping --}}
                        <div class="col-lg-4">
                            <div class="form-group mb-4">
                                <label class="text-secondary">Shipping / Installation Cost <span class="text-danger">*</span></label>
                                <input type="number" step="0.01" class="form-control" name="shipping_installation_cost"
                                    value="{{ old('shipping_installation_cost') }}" placeholder="Enter Cost">
                            </div>
                        </div>
                        <!-- Description Field -->
                        <div class="col-lg-12">
                            <div class="form-group mb-4">
                                <label class="label text-secondary">Description <span class="text-danger">*</span></label>
                                <div class="form-group position-relative">
                                    <textarea class="form-control text-dark @error('description') is-invalid @enderror" name="description" rows="2"
                                        placeholder="Enter Description here">{{ old('description', $data->description ?? '') }}</textarea>
                                </div>
                                @error('description')
                                    <div id="description-error" class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        {{-- Thumbnail --}}
                        <div class="col-lg-12">
                            <div class="form-group mb-4">
                                <label class="text-secondary mb-1">Thumbnail <span class="text-danger">*</span></label>
                                <input class="dropify form-control" type="file" name="thumbnail" accept="image/*">
                            </div>
                        </div>

                    </div>

                    <div class="mt-3">
                        <button type="submit" class="btn btn-primary px-4 py-2">Submit</button>
                        <a href="{{ route('services.index') }}" class="btn btn-danger px-4 py-2">Cancel</a>
                    </div>

                </form>

            </div>
        </div>
    </div>

@endsection

@push('scripts')
<script type="text/javascript" src="https://jeremyfagis.github.io/dropify/dist/js/dropify.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.dropify').dropify();
        })
    </script>
@endpush
