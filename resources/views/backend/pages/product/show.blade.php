@extends('backend.master')

@section('title') Show Product @endsection

@section('headerlink')
<style>
    .product-images img {
        max-width: 150px;
        max-height: 150px;
        object-fit: cover;
        border-radius: 8px;
        margin-right: 10px;
        margin-bottom: 10px;
        border: 1px solid #dee2e6;
    }
    .product-details h6 {
        font-weight: 600;
    }
    .card-author {
        padding: 20px;
        border-radius: 0.5rem;
        background-color: #f8f9fa;
    }
</style>
@endsection

@section('content')
<div class="main-content" style="padding-top:50px;">
    <section class="section">
        <div class="section-body">
            <div class="row mt-4">
                <div class="col-12">
                    <div class="card shadow-sm rounded-3">
                        <div class="card-body">

                            <div class="d-flex justify-content-between align-items-center mb-4 border-bottom pb-2">
                                <h5 class="mb-0">View Product</h5>
                                <a href="{{ route('products.index') }}" class="btn btn-primary">
                                    <i class="fas fa-arrow-left me-1"></i> Back To Product List
                                </a>
                            </div>

                            <div class="product-details mb-4">
                                <h6>Name:</h6>
                                <p>{{ $product->name }}</p>

                                <h6>Description:</h6>
                                <p>{{ $product->description ?? 'No Description' }}</p>
                            </div>

                            <div class="product-images">
                                <h6>Images:</h6>
                                <div class="d-flex flex-wrap">
                                    @forelse($product->images as $img)
                                        <img src="{{ asset('storage/'.$img->image_path) }}" alt="Product Image">
                                    @empty
                                        <p class="text-muted">No images found for this product.</p>
                                    @endforelse
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection
