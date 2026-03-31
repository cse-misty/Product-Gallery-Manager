@extends('backend.master')

@section('title')
    Edit Product - Admin Panel
@endsection

@section('content')
    <div class="main-content">
        <section class="section">
            <div class="section-body">
                <div class="row">
                    <div class="col-12">

                        <div class="card shadow-sm p-4">
                            <div class="card-header d-flex justify-content-between align-items-center">
                                <h5 class="mb-0">Edit Product</h5>
                                <a href="{{ route('products.index') }}" class="btn btn-primary btn-sm">
                                    <i class="fas fa-list"></i> Product List
                                </a>
                            </div>

                            <div class="card-body">
                                <form id="productForm" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')

                                    <div class="mb-3">
                                        <label for="name" class="form-label">Product Name</label>
                                        <input type="text" name="name" id="name"
                                            class="form-control @error('name') is-invalid @enderror"
                                            value="{{ old('name', $product->name) }}" placeholder="Enter Product Name">
                                        <span class="text-danger" id="nameError">
                                            @error('name')
                                                {{ $message }}
                                            @enderror
                                        </span>
                                    </div>

                                    <div class="mb-3">
                                        <label for="description" class="form-label">Description</label>
                                        <textarea name="description" id="description" rows="4"
                                            class="form-control @error('description') is-invalid @enderror" placeholder="Enter Description">{{ old('description', $product->description) }}</textarea>
                                        <span class="text-danger" id="descriptionError">
                                            @error('description')
                                                {{ $message }}
                                            @enderror
                                        </span>
                                    </div>

                                    {{-- Dropzone Upload Area --}}
                                    <div class="mb-4">
                                        <label class="form-label">Upload New Images</label>
                                        <div id="productDropzone" class="dropzone border rounded p-4 bg-light text-center">
                                            <div class="dz-message">
                                                <i class="fas fa-cloud-upload-alt fa-2x text-primary mb-2"></i>
                                                <p class="mb-0">Drag & Drop Images Here or Click</p>
                                                <small class="text-muted">Allowed: JPG, JPEG, PNG, WEBP | Max: 2MB
                                                    each</small>
                                            </div>
                                        </div>
                                        <span class="text-danger" id="imagesError"></span>
                                    </div>

                                    {{-- Existing Images --}}
                                    <div class="mb-3">
                                        <label class="form-label">Existing Images</label>
                                        <div class="d-flex flex-wrap gap-3" id="existingImages">
                                            @forelse($product->images as $img)
                                                <div class="position-relative border rounded overflow-hidden shadow-sm existing-image-box"
                                                    style="width: 130px;" id="image-box-{{ $img->id }}">
                                                    <img src="{{ asset('storage/' . $img->image_path) }}" class="img-fluid"
                                                        style="width: 100%; height: 110px; object-fit: cover;"
                                                        alt="Product Image">
                                                    <button type="button" class="remove-img-btn"
                                                        data-id="{{ $img->id }}">
                                                        &times;
                                                    </button>
                                                </div>
                                            @empty
                                                <p class="text-muted">No existing images found.</p>
                                            @endforelse
                                        </div>
                                    </div>
                                </form>
                            </div>

                            <div class="card-footer text-end">
                                <button type="button" id="uploadBtn" class="btn btn-success">
                                    <i class="fas fa-save me-1"></i> Update Product
                                </button>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection

@section('script')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.3/dropzone.min.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.3/dropzone.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <style>
        .dropzone {
            border: 2px dashed #0d6efd !important;
            border-radius: 10px;
            min-height: 180px;
            background: #f8f9fa;
        }

        .dropzone .dz-preview .dz-image {
            border-radius: 10px;
        }

        .dropzone .dz-preview {
            margin: 10px;
        }

        .existing-image-box:hover .remove-img-btn {
            opacity: 1;
            transform: scale(1);
        }

        .remove-img-btn {
            opacity: 0.9;
            transform: scale(0.95);
            transition: all 0.2s ease-in-out;
        }
    </style>

    <script>
        Dropzone.autoDiscover = false;

        const updateUrl = "{{ route('products.update', $product->id) }}";
        const csrfToken = "{{ csrf_token() }}";
        const redirectUrl = "{{ route('products.index') }}";

        let myDropzone = new Dropzone("#productDropzone", {
            url: updateUrl,
            paramName: "images",
            uploadMultiple: true,
            parallelUploads: 100,
            maxFiles: 100,
            autoProcessQueue: false,
            acceptedFiles: ".jpg,.jpeg,.png,.webp",
            maxFilesize: 2,
            addRemoveLinks: true,
            headers: {
                'X-CSRF-TOKEN': csrfToken,
                'Accept': 'application/json'
            },
            dictDefaultMessage: "",
            init: function() {
                let dz = this;

                document.getElementById("uploadBtn").addEventListener("click", function() {
                    clearErrors();

                    const acceptedFiles = dz.getAcceptedFiles().length;

                    if (acceptedFiles > 0) {
                        dz.processQueue();
                    } else {
                        updateProductWithoutImages();
                    }
                });

                dz.on("sendingmultiple", function(files, xhr, formData) {
                    formData.append("name", document.getElementById("name").value);
                    formData.append("description", document.getElementById("description").value);
                    formData.append("_method", "PUT");
                });

                dz.on("successmultiple", function(files, response) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Success!',
                        text: response.message ?? 'Product updated successfully.',
                        confirmButtonText: 'OK'
                    }).then(() => {
                        window.location.href = redirectUrl;
                    });
                });

                dz.on("errormultiple", function(files, response) {
                    handleValidationErrors(response);
                });

                dz.on("error", function(file, response) {
                    handleValidationErrors(response);
                });
            }
        });

        // =========================
        // Update Without Images
        // =========================
        function updateProductWithoutImages() {
            const formData = new FormData();
            formData.append("name", document.getElementById("name").value);
            formData.append("description", document.getElementById("description").value);
            formData.append("_method", "PUT");

            fetch(updateUrl, {
                    method: "POST",
                    headers: {
                        'X-CSRF-TOKEN': csrfToken,
                        'Accept': 'application/json'
                    },
                    body: formData
                })
                .then(async response => {
                    const data = await response.json();

                    if (!response.ok) {
                        throw data;
                    }

                    return data;
                })
                .then(data => {
                    Swal.fire({
                        icon: 'success',
                        title: 'Success!',
                        text: data.message ?? 'Product updated successfully.',
                        confirmButtonText: 'OK'
                    }).then(() => {
                        window.location.href = redirectUrl;
                    });
                })
                .catch(error => {
                    handleValidationErrors(error);
                });
        }

        // =========================
        // Clear Errors
        // =========================
        function clearErrors() {
            document.getElementById('nameError').innerText = '';
            document.getElementById('descriptionError').innerText = '';
            document.getElementById('imagesError').innerText = '';

            document.getElementById('name').classList.remove('is-invalid');
            document.getElementById('description').classList.remove('is-invalid');
        }

        // =========================
        // Handle Validation Errors
        // =========================
        function handleValidationErrors(response) {
            console.log("Validation/Error Response:", response);
            clearErrors();

            if (typeof response === "object" && response.errors) {
                if (response.errors.name) {
                    document.getElementById('nameError').innerText = response.errors.name[0];
                    document.getElementById('name').classList.add('is-invalid');
                }

                if (response.errors.description) {
                    document.getElementById('descriptionError').innerText = response.errors.description[0];
                    document.getElementById('description').classList.add('is-invalid');
                }

                if (response.errors.images) {
                    document.getElementById('imagesError').innerText = response.errors.images[0];
                }

                if (response.errors['images.0']) {
                    document.getElementById('imagesError').innerText = response.errors['images.0'][0];
                }

                if (response.errors['images.*']) {
                    document.getElementById('imagesError').innerText = response.errors['images.*'][0];
                }
            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: response.message ?? 'Something went wrong!'
                });
            }
        }

        // =========================
        // Existing Image Delete
        // =========================
        document.addEventListener('click', function(e) {
            if (e.target.classList.contains('remove-img-btn')) {
                let btn = e.target;
                let imgId = btn.dataset.id;
                let parentDiv = document.getElementById('image-box-' + imgId);

                Swal.fire({
                    title: 'Are you sure?',
                    text: "Image will be deleted permanently!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        fetch("{{ url('admin/products/image') }}/" + imgId, {
                                method: 'DELETE',
                                headers: {
                                    'X-CSRF-TOKEN': csrfToken,
                                    'Accept': 'application/json'
                                }
                            })
                            .then(async res => {
                                const data = await res.json();
                                if (!res.ok) throw data;
                                return data;
                            })
                            .then(data => {
                                if (data.success) {
                                    parentDiv.remove();

                                    Swal.fire({
                                        icon: 'success',
                                        title: 'Deleted!',
                                        text: data.message ?? 'Image deleted successfully.',
                                        timer: 1500,
                                        showConfirmButton: false
                                    });
                                } else {
                                    Swal.fire({
                                        icon: 'error',
                                        title: 'Failed!',
                                        text: data.message ?? 'Could not delete image.'
                                    });
                                }
                            })
                            .catch((error) => {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Error!',
                                    text: error.message ??
                                        'Something went wrong while deleting image.'
                                });
                            });
                    }
                });
            }
        });
    </script>
@endsection
