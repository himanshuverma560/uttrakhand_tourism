<!DOCTYPE html>
<html lang="en">
<head>
  @include('admin.partials.header')
</head>

<body class="container">
<!-- content section -->
@include('admin.partials.menu')
 @yield('content')
 <!-- end of content section -->
@include('admin.partials.footer')
</body>
</html>