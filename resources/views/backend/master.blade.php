<!DOCTYPE html>
<html lang="en">
<head>
    @include('backend.layouts.header')
    <title>@yield('title')</title>
    @yield('style')
    @yield('headerlink')
</head>
<body>
  <!-- <div class="loader"></div> -->

  @include('sweetalert::alert')

  <!-- Top bar -->
  @include('backend.layouts.topbar')

  <!-- Sidebar -->
  @include('backend.layouts.sidebar')

  <!-- Main Body -->
  @yield('content')

  <!-- Setting Sidebar -->
  @include('backend.layouts.settingSidebar')

  <!-- Footer -->
  @include('backend.layouts.footer')

  @yield('script')
  @include('backend.layouts.js')

</body>
</html>
