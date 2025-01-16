@include('partials._head')
@include('partials._menu')
 <div class="container" style="margin-top: 6em;">
 <div class="row">
   <div class="col-md-12"> 
     <section class="vh-100 bg-image">
  <div class="mask d-flex align-items-center h-100 gradient-custom-3">
    <div class="container h-100">
      <div class="row d-flex justify-content-center align-items-center h-100">
        <div class="col-12 col-md-9 col-lg-7 col-xl-6">
          <div class="card bg-dark text-white" style="border-radius: 15px;">
            <div class="card-body p-5"> 
              <h2 class="text-uppercase text-center mb-5">Create an account</h2> 
              <form action="/" method="post">@csrf
                <div class="form-outline mb-4"> 
                    @error('name')
                     <div class="alert alert-danger" role="alert">
                       {{ $message }}
                     </div>
                    @enderror
                  <input type="text" id="form3Example1cg" class="form-control form-control-lg" name="name" value="{{ old('name') }}"/>
                  <label class="form-label" for="form3Example1cg">Your Name</label>
                </div>

                <div class="form-outline mb-4">  
                    @error('email')
                     <div class="alert alert-danger" role="alert">
                       {{ $message }}
                     </div>
                    @enderror
                  <input type="email" id="form3Example3cg" class="form-control form-control-lg" name="email" value="{{ old('email') }}"/>
                  <label class="form-label" for="form3Example3cg">Your Email</label>
                </div> 
                <div class="form-outline mb-4">  
                    @error('password')
                     <div class="alert alert-danger" role="alert">
                       {{ $message }}
                     </div>
                    @enderror
                  <input type="password" id="form3Example4cg" class="form-control form-control-lg" name="password" value="{{ old('password') }}"/>
                  <label class="form-label" for="form3Example4cg">Password</label>
                </div>

                <div class="form-outline mb-4">
                  <input type="password" id="form3Example4cdg" class="form-control form-control-lg" name="password_confirmation" value="{{ old('password') }}"/>
                  <label class="form-label" for="form3Example4cdg">Repeat your password</label>
                </div>

                <div class="form-check d-flex justify-content-center mb-5">
                  <input class="form-check-input me-2" type="checkbox" value="" id="form2Example3cg" />
                  <label class="form-check-label" for="form2Example3g">
                    I agree all statements in <a href="#!" class="text-body"><u>Terms of service</u></a>
                  </label>
                </div>

                <div class="d-flex justify-content-center">
                  <button type="submit"
                    class="btn btn-success btn-block btn-lg gradient-custom-4 text-body">Register</button>
                </div>

                <p class="text-center text-muted mt-5 mb-0">Have already an account? <a href="/login"
                    class="fw-bold text-body"><u>Login here</u></a></p>

              </form>

            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
   </div>
 </div>

</div>
</div><!--end of container-->

@include('partials._footer')