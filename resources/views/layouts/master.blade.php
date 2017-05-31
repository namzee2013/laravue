<!doctype html>
<html>

<head>
  <link rel="stylesheet" href="{{asset('public/css/app.css')}}">

  @include('elements.head')
  <link rel="stylesheet" href="{{asset('public/css/style.css')}}">
<script>
    window.Laravel = {!! json_encode([
        'csrfToken' => csrf_token(),
    ]) !!};
</script>
</head>
<body class="login">
  <div id="app">
    <div id="auth">
      <div v-if="!this.$root.authenticated">
        <login></login>
      </div>
    </div>
    <div class="bg-dark dk" id="wrap" v-if="this.$root.authenticated">
      @include('elements.top')
      <!-- /#top -->
      @include('elements.left')
      <!-- /#left -->
      <div id="content">
        <div class="outer">
          <div class="inner bg-light lter">
        @yield('content')
          </div>
        </div>
      </div>
      <!-- /#content -->

    </div>
    <!-- /#wrap -->
    <footer class="Footer bg-dark dker" v-if="this.$root.authenticated">
        <p>2017 &copy; Metis Bootstrap Admin Template v2.4.2</p>
    </footer>
    <!-- /#footer -->
  </div>
<!--jQuery -->
<script src="{{asset('public/js/app.js')}}"></script>
@include('elements.scripts')



</body>
</html>
