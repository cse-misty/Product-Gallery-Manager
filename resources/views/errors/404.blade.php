@extends('errors.master')
@section('title')Page Not Found @endsection
@section('content')

<div id="app">
    <section class="section">
        <div class="container">
            <div class="page-error">
                <div class="page-inner">
                    <h1>404</h1>
                    <div class="page-description">
                        The page you were looking for could not be found.
                    </div>
                    <div class="page-search">
                        <img src="{{ asset('backend') }}/img/error.gif" class="img-fluid" style="max-width: 80%; height: auto; margin-top: -50px;" alt="Error Image">
                        <div class="mt-5">
                            <a class="btn btn-primary" href="{{ url('/') }}">Back To Home</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection
