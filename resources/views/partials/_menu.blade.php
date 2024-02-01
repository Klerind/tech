<!--navbar start-->
   <nav class="navbar fixed-top navbar-expand-lg navbar-light bg-light">
   <a class="navbar-brand" href="/">Laravel</a>
   <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
     <span class="navbar-toggler-icon"></span>
   </button>
   <div class="collapse navbar-collapse" id="navbarSupportedContent">
     <ul class="navbar-nav mr-auto">
       <li class="nav-item active">
         <a class="nav-link" href="/">Home<span class="sr-only">(current)</span></a>
       </li>
       <li class="nav-item">
         <a class="nav-link" href="/about">About Us</a>
       </li>
       <li class="nav-item">
         <a class="nav-link" href="/contact">Contact Us</a>
       </li>
     @auth
       <li class="nav-item">
         <a class="nav-link" href="/profile">Profile</a>
       </li>
       <li class="nav-item">
         <a class="nav-link" href="/logout">Log Out</a>
       </li>
     @else
       <li class="nav-item">
         <a class="nav-link" href="/login">Login/SignUp</a>
      </li>
     @endauth
     </ul>
      @auth
        {{auth()->id()}} Welcome  {{ auth()->user()->name }}
      @endauth

     <form action="/search" method="post" class="form-inline my-2 my-lg-0">@csrf
       <input style="min-width:21em;" name="search" value="" class="form-control mr-sm-2" type="text" placeholder="Search article or search by user name" aria-label="Search">
       <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
     </form>
   </div>
 </nav><!--and of navbar-->
