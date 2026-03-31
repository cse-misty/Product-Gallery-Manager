@extends('errors.master')
@section('title') You do not have access to this page. @endsection
@section('content')

<div id="app">
    <section class="section">
      <div class="container">
        <div class="page-error">
          <div class="page-inner">
            <h1>403</h1>
            <div class="page-description">
              You do not have access to this page.
            </div>
            <div class="page-search">
                <img src="{{ asset('backend') }}/img/error.gif" class="img-fluid" style="max-width: 80%; height: auto; margin-top: -50px;" alt="Error Image">
              <div class="mt-3">
                <a class="btn btn-primary" href="{{ url('/') }}" >Back To Home</a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>
@endsection
