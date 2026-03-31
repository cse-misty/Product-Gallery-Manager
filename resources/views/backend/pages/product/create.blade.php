@extends('backend.master')

@section('title')
    Add Product - Admin Panel
@endsection

@section('content')
    <div class="main-content">
        <section class="section">

            <div class="section-body">
                <div class="row">
                    <div class="col-12">

                        <div class="card shadow-sm p-4">

                            <div class="card-header d-flex justify-content-between">
                                <h5 class="mb-0">Add Product </h5>

                                <a href="{{ route('products.index') }}" class="btn btn-primary btn-sm">
                                    <i class="fas fa-list"></i> Product List
                                </a>
                            </div>

                            <form action="{{ route('products.store') }}" class="dropzone" id="productDropzone"
                                method="POST" enctype="multipart/form-data">

                                @csrf


                                <div class="m-4">
                                    <div class="row mb-3">
                                        <label for="name" class="form-label"> Name</label>
                                        <input type="text" name="name" id="name"
                                            class="form-control @error('name') is-invalid @enderror"
                                            value="{{ old('name') }}" placeholder="Enter  Name">
                                        <span class="text-danger" id="nameError"></span>
                                    </div>


                                    <div class="row mb-3">
                                        <label for="description" class="form-label">Description</label>
                                        <textarea name="description" id="description" rows="3"
                                            class="form-control @error('description') is-invalid @enderror" placeholder="Enter  Description">{{ old('description') }}</textarea>
                                        <span class="text-danger" id="descriptionError"></span>
                                    </div>
                                </div>

                                <span class="text-danger" id="imagesError"></span>
                            </form>

                            <div class="card-footer text-end">
                                <button type="button" id="uploadBtn" class="btn btn-primary">
                                    <i class="fas fa-upload"></i> Upload Images
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
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.3/dropzone.min.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.3/dropzone.min.js"></script>

    <script>
        Dropzone.autoDiscover = false;

        let myDropzone = new Dropzone("#productDropzone", {
            url: "{{ route('products.store') }}",
            paramName: "images",
            uploadMultiple: true,
            parallelUploads: 100,
            maxFiles: 100,
            autoProcessQueue: false,
            acceptedFiles: ".jpg,.jpeg,.png,.webp",
            maxFilesize: 2,
            addRemoveLinks: true,
            headers: {
                'X-CSRF-TOKEN': "{{ csrf_token() }}"
            },
            dictDefaultMessage: "Drag & Drop at least 3 images here or click to upload",

            init: function() {
                let dz = this;

                document.getElementById("uploadBtn").addEventListener("click", function() {
                    document.getElementById('nameError').innerText = '';
                    document.getElementById('descriptionError').innerText = '';
                    dz.processQueue();
                });

                dz.on("sending", function(file, xhr, formData) {
                    formData.append("name", document.getElementById("name").value);
                    formData.append("description", document.getElementById("description").value);
                });

                dz.on("error", function(file, response) {
                    file.previewElement.querySelectorAll('.dz-error-message').forEach(el => el
                        .remove());

                    if (typeof response === "object" && response.errors) {
                        if (response.errors.name) {
                            document.getElementById('nameError').innerText = response.errors.name[0];
                        }
                        if (response.errors.description) {
                            document.getElementById('descriptionError').innerText = response.errors
                                .description[0];
                        }


                         if (response.errors.images) {
                            document.getElementById('imagesError').innerText = response.errors
                                .images[0];
                        }

                        if (file.previewElement) {
                            let node = document.createElement("div");
                            node.className = "dz-error-message";
                            node.innerHTML = "<span>Validation failed! Please fix inputs.</span>";
                            file.previewElement.appendChild(node);
                        }
                        dz.removeAllFiles(true);
                    } else {
                        let msg = typeof response === "string" ? response : response.message;
                        if (file.previewElement) {
                            let node = document.createElement("div");
                            node.className = "dz-error-message";
                            node.innerHTML = "<span>" + msg + "</span>";
                            file.previewElement.appendChild(node);
                        }
                    }
                });

                dz.on("success", function(file, response) {
                    if (dz.getQueuedFiles().length === 0 && dz.getUploadingFiles().length === 0) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Success!',
                            text: 'Product images uploaded successfully.',
                            confirmButtonText: 'OK'
                        }).then(() => {
                            window.location.href = "{{ route('products.index') }}";
                        });
                    }
                });
            }
        });
    </script>
@endsection
