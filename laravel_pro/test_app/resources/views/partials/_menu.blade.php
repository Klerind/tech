<style> 
  .social-icons svg{
    margin: 1em;
    margin-left: 0;
    cursor: pointer;
  }
</style>

<!--navbar start-->
   <nav class="navbar fixed-top navbar-expand-lg navbar-light"> 
   <a class="navbar-brand" href="/">Tech</a>
   <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
     <span class="navbar-toggler-icon"></span>
   </button>
   <div class="collapse navbar-collapse" id="navbarSupportedContent">
     <ul class="navbar-nav mr-auto"> 
     @auth
      <li class="nav-item active">
         <a class="nav-link" href="/">Home<span class="sr-only">(current)</span></a>
       </li>
          <li class="nav-item">
           <li class="nav-item">
         <a class="nav-link" href="/about">About Us</a>
       </li>
       <li class="nav-item">
         <a class="nav-link" href="/contact">Contact Us</a>
       </li>
       <li class="nav-item">
         <a class="nav-link" href="/profile">Profile</a>
       </li>
       <li class="nav-item">
         <a class="nav-link" href="/logout">Log Out</a>
       </li>
     @else
      <li class="nav-item active">
         <a class="nav-link" href="/">Home<span class="sr-only">(current)</span></a>
       </li>
       <li class="nav-item">
           <li class="nav-item">
         <a class="nav-link" href="/about">About Us</a>
       </li>
       <li class="nav-item">
         <a class="nav-link" href="/contact">Contact Us</a>
       </li>
         <a class="nav-link" href="/login">Login/SignUp</a>
      </li>
     @endauth 
      
      <form action="/product/buy" method="post">@csrf
        <input type="hidden" name="content_link" value="[]" />
        <button type="submit" class="btn btn-light">
          Cart 
          <?php
          if(isset($cart_items))
          { 
            if(count($cart_items) > 0)
            {
              echo '<span class="badge badge-danger">'. count($cart_items) .'</span>';
            }else{ 
              echo '<span class="badge badge-danger">0</span>';
            } 
          }
          ?>
         <span class="sr-only">unread messages</span>
        </button>
    </form>
     
     </ul>
        <div class="social-icons"> 
            <a href="https://www.facebook.com/sharer.php?u=https://lara000.in" target="_black">      
        <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="#0060df" class="bi bi-facebook" viewBox="0 0 16 16">
         <path d="M16 8.049c0-4.446-3.582-8.05-8-8.05C3.58 0-.002 3.603-.002 8.05c0 4.017 2.926 7.347 6.75 7.951v-5.625h-2.03V8.05H6.75V6.275c0-2.017 1.195-3.131 3.022-3.131.876 0 1.791.157 1.791.157v1.98h-1.009c-.993 0-1.303.621-1.303 1.258v1.51h2.218l-.354 2.326H9.25V16c3.824-.604 6.75-3.934 6.75-7.951z"/>
        </svg>
       </a>     
       <a href="https://twitter.com/share?url=https://lara000.in&text=laravel000" target="_black">     
        <svg width="30" height="30" viewBox="0 -4 48 48" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" fill="#000000"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <title>Twitter-color</title> <desc>Created with Sketch.</desc> <defs> </defs> <g id="Icons" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"> <g id="Color-" transform="translate(-300.000000, -164.000000)" fill="#00AAEC"> <path d="M348,168.735283 C346.236309,169.538462 344.337383,170.081618 342.345483,170.324305 C344.379644,169.076201 345.940482,167.097147 346.675823,164.739617 C344.771263,165.895269 342.666667,166.736006 340.418384,167.18671 C338.626519,165.224991 336.065504,164 333.231203,164 C327.796443,164 323.387216,168.521488 323.387216,174.097508 C323.387216,174.88913 323.471738,175.657638 323.640782,176.397255 C315.456242,175.975442 308.201444,171.959552 303.341433,165.843265 C302.493397,167.339834 302.008804,169.076201 302.008804,170.925244 C302.008804,174.426869 303.747139,177.518238 306.389857,179.329722 C304.778306,179.280607 303.256911,178.821235 301.9271,178.070061 L301.9271,178.194294 C301.9271,183.08848 305.322064,187.17082 309.8299,188.095341 C309.004402,188.33225 308.133826,188.450704 307.235077,188.450704 C306.601162,188.450704 305.981335,188.390033 305.381229,188.271578 C306.634971,192.28169 310.269414,195.2026 314.580032,195.280607 C311.210424,197.99061 306.961789,199.605634 302.349709,199.605634 C301.555203,199.605634 300.769149,199.559408 300,199.466956 C304.358514,202.327194 309.53689,204 315.095615,204 C333.211481,204 343.114633,188.615385 343.114633,175.270495 C343.114633,174.831347 343.106181,174.392199 343.089276,173.961719 C345.013559,172.537378 346.684275,170.760563 348,168.735283" id="Twitter"> </path> </g> </g> </g></svg>
       </a>     
       <a href="https://wa.me/?text=https://lara000.in/" target="_black">
        <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="#33cc33" class="bi bi-whatsapp" viewBox="0 0 16 16">
         <path d="M13.601 2.326A7.854 7.854 0 0 0 7.994 0C3.627 0 .068 3.558.064 7.926c0 1.399.366 2.76 1.057 3.965L0 16l4.204-1.102a7.933 7.933 0 0 0 3.79.965h.004c4.368 0 7.926-3.558 7.93-7.93A7.898 7.898 0 0 0 13.6 2.326zM7.994 14.521a6.573 6.573 0 0 1-3.356-.92l-.24-.144-2.494.654.666-2.433-.156-.251a6.56 6.56 0 0 1-1.007-3.505c0-3.626 2.957-6.584 6.591-6.584a6.56 6.56 0 0 1 4.66 1.931 6.557 6.557 0 0 1 1.928 4.66c-.004 3.639-2.961 6.592-6.592 6.592zm3.615-4.934c-.197-.099-1.17-.578-1.353-.646-.182-.065-.315-.099-.445.099-.133.197-.513.646-.627.775-.114.133-.232.148-.43.05-.197-.1-.836-.308-1.592-.985-.59-.525-.985-1.175-1.103-1.372-.114-.198-.011-.304.088-.403.087-.088.197-.232.296-.346.1-.114.133-.198.198-.33.065-.134.034-.248-.015-.347-.05-.099-.445-1.076-.612-1.47-.16-.389-.323-.335-.445-.34-.114-.007-.247-.007-.38-.007a.729.729 0 0 0-.529.247c-.182.198-.691.677-.691 1.654 0 .977.71 1.916.81 2.049.098.133 1.394 2.132 3.383 2.992.47.205.84.326 1.129.418.475.152.904.129 1.246.08.38-.058 1.171-.48 1.338-.943.164-.464.164-.86.114-.943-.049-.084-.182-.133-.38-.232z"/>
       </svg>
       </a> 
     </div>       
      @auth 
        {{auth()->id()}} Welcome <a class="nav-link" href="/show_user?user_id={{ auth()->user()->id }}">{{ auth()->user()->name }}</a>
      @endauth

     <form action="/search" method="post" class="form-inline my-2 my-lg-0">@csrf
        
        <?php if($errors->isNotEmpty()) { ?>
             <div class="tooltip bs-tooltip-top" role="tooltip" style="opacity:1;"> 
               @error('search')
                <div class="alert alert-danger" role="alert" style="position: relative; top: 50px">
                  {{ $message }}
                </div>
                @enderror
             </div>
         <?php } ?> 
         
       <input style="min-width:21em;" name="search" value="" class="form-control mr-sm-2" type="text" placeholder="Search article or search by user name" aria-label="Search">
       <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
     </form>
      <span id="dark-mode" onclick="darkModeTrigger()">dark</span>
   </div>
 </nav><!--and of navbar-->
