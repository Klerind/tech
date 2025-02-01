<?php echo $__env->make('partials._head', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->make('partials._menu', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
 <div class="container" style="margin-top: 12em;">
 <div class="row">
   <div class="col-md-12">
     <h2>Login In</h2>
     <section class="vh-100 gradient-custom">
     <div class="container py-5 h-100">
       <div class="row d-flex justify-content-center align-items-center h-100">
         <div class="col-12 col-md-8 col-lg-6 col-xl-5">
           <div class="card bg-dark text-white" style="border-radius: 1rem;">
             <div class="card-body p-5 text-center">
               <div class="mb-md-5 mt-md-4 pb-5">
                 <h2 class="fw-bold mb-2 text-uppercase">Login</h2>
                 <p class="text-white-50 mb-5">Please enter your login and password!</p>
                <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <?php echo e($message); ?>

                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <?php echo e($message); ?>

                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
              <form action="/login" method="post">
                <?php echo csrf_field(); ?>
                 <div class="form-outline form-white mb-4">
                   <input type="email" id="typeEmailX" class="form-control form-control-lg" name="email"/>
                   <label class="form-label" for="typeEmailX">Email</label>
                 </div>

                 <div class="form-outline form-white mb-4">
                   <input type="password" id="typePasswordX" class="form-control form-control-lg" name="password" />
                   <label class="form-label" for="typePasswordX">Password</label>
                 </div>

                 <p class="small mb-5 pb-lg-2"><a class="text-white-50" href="/forgotPassword">Forgot password?</a></p>

                 <input class="btn btn-outline-light btn-lg px-5" type="submit"/>
              </form>
                 <div class="d-flex justify-content-center text-center mt-4 pt-1">
                   <a href="#!" class="text-white"><i class="fab fa-facebook-f fa-lg"></i></a>
                   <a href="#!" class="text-white"><i class="fab fa-twitter fa-lg mx-4 px-2"></i></a>
                   <a href="#!" class="text-white"><i class="fab fa-google fa-lg"></i></a>
                 </div>

               </div>

               <div>
                 <p class="mb-0">Don't have an account? <a href="/register" class="text-white-50 fw-bold">Sign Up</a>
                 </p>
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


   <!-- Optional JavaScript -->
   <!-- jQuery first, then Popper.js, then Bootstrap JS -->
   <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
   <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>
   <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js" integrity="sha384-h0AbiXch4ZDo7tp9hKZ4TsHbi047NrKGLO3SEJAg45jXxnGIfYzk4Si90RDIqNm1" crossorigin="anonymous"></script>
 </body>
</html>
<?php /**PATH /var/www/html/laravel_blog000/resources/views/pages/login.blade.php ENDPATH**/ ?>