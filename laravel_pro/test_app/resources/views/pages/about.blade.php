     @include('partials._head')
     @include('partials._menu')
 <div class="container" style="margin-top: 12em;">
 <div class="row">
   <div class="col-md-12">
     <h2>About Us test</h2>
     <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim. Donec pede justo, fringilla vel, aliquet nec, vulputate eget, arcu. In enim justo, rhoncus ut, imperdiet a, venenatis vitae, justo. Nullam dictum felis eu pede mollis pretium. </p>
   </div>
 </div>
</div>
</div><!--end of container-->
<?php //echo $data; ?>
<img src="<?php //echo storage_path().'/app/index.jpeg'; ?>" alt="">
@yield('content')
@include('partials._footer')
 </body>
</html>
