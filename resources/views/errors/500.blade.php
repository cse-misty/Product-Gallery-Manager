@extends('errors.master')
@section('title')Whoops, something went wrong. @endsection
@section('content')

<div id="app">
    <section class="section">
        <div class="container">
            <div class="page-error">
                <div class="page-inner">
                    <h1>500</h1>
                    <div class="page-description">
                        Whoops, something went wrong.
                    </div>
                    <div class="page-search">
                        <img src="{{ asset('backend') }}/img/error.gif" class="img-fluid" style="max-width: 80%; height: auto; margin-top: -50px;" alt="Error Image">
                        <div class="mt-3">
                            <a class="btn btn-primary" href="{{ url('/') }}" >Back to Home</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection
