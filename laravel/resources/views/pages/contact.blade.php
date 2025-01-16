  @include('partials._head')
  @include('partials._menu')
 <div class="container" style="margin-top: 12em;">
 <div class="row">
   <div class="col-md-12"> 
     <h2>Contact Us</h2><hr>
     <?php if (session()->get('status') != null): ?>
     <div class="alert alert-success" role="alert">
       <?php echo session()->get('status'); ?>
     </div>
    <?php endif; ?>
     <p class="alert alert-danger" >All messages send from this page are received but for security reasons do not put your valid email here, please.</p>
     <form action="/contact/sendMail" method="post">@csrf
       <div class="form-group">
         <label name="email">Email:</label>
            @error('email')
                <div class="alert alert-danger" role="alert">
                   {{ $message }}
                </div>
            @enderror
         <input id="email" name="email" class="form-control">
       </div>

       <div class="form-group">
         <label name="subject">Subject:</label>
            @error('subject')
                <div class="alert alert-danger" role="alert">
                   {{ $message }}
                </div>
            @enderror
         <input id="subject" name="subject" class="form-control">
       </div>
       <div class="form-group">
         <label name="message">Message:</label>
            @error('message')
                <div class="alert alert-danger" role="alert">
                  {{ $message }}
                 </div>
            @enderror
         <textarea id="message" name="message" class="form-control">Type your text here...</textarea>
       </div>
       <input type="submit" value="Send Message" class="btn btn-success">
     </form>
   </div>
 </div>
</div>

</div><!--end of container-->

@include('partials._footer')
