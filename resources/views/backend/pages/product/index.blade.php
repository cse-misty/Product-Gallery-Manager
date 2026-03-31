@extends('backend.master')

@section('title')
    Products List - Admin Panel
@endsection

@section('content')
    <div class="main-content">
        <section class="section">

            <div class="section-body">
                <div class="row">
                    <div class="col-12">

                        <div class="card shadow-sm">

                            <div class="card-header d-flex justify-content-between align-items-center">

                                <h5 class="mb-0">Products List</h5>

                                <div class="">
                                    <a href="{{ route('products.create') }}" class="btn btn-primary btn-sm mb-2">
                                        <i class="fas fa-plus"></i> Add Products
                                    </a>


                                </div>



                            </div>

                            <form action="{{ route('products.index') }}" method="GET" class="d-flex mr-2 m-4">
                                <input type="text" name="search" value="{{ request('search') }}"
                                    class="form-control form-control-sm" placeholder="Search products...">
                                <button type="submit" class="btn btn-sm btn-primary ml-2">
                                    <i class="fas fa-search"></i> 
                                </button>
                            </form>
                            <div class="card-body">

                                <div class="table-responsive">
                                    <table class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Name</th>
                                                <th>Total Images</th>
                                                <th>Action</th>

                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($products as $key => $product)
                                                <tr>
                                                    <td>{{ $key + 1 }}</td>
                                                    <td>{{ $product->name }}</td>
                                                    <td>{{ $product->images->count() }}</td>

                                                    <td>
                                                        <div class="d-flex">

                                                            <a href="{{ route('products.show', $product->id) }}"
                                                                class="btn btn-primary mr-1">
                                                                <i class="far fa-eye"> View</i>
                                                            </a>



                                                            <a href="{{ route('products.edit', $product->id) }}"
                                                                class="btn btn-warning mr-1">
                                                                <i class="fas fa-edit"> Edit</i>
                                                            </a>



                                                            <a class="btn btn-danger"
                                                                onclick="confirm_delete_backend({{ $product->id }})">
                                                                <i class="fa fa-trash text-white"> Delete</i>
                                                            </a>

                                                            <form action="{{ route('products.destroy', $product->id) }}"
                                                                id="delete_form_{{ $product->id }}" method="POST">
                                                                @csrf
                                                                @method('DELETE')
                                                            </form>


                                                        </div>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div> <!-- table-responsive -->

                                <div class="d-flex justify-content-end mt-3">

                                    {{ $products->links() }}

                                </div>

                            </div>

                        </div>

                    </div>
                </div>
            </div>

        </section>
    </div>
@endsection
