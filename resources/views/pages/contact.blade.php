  @include('partials._head')
  @include('partials._menu')
 <div class="container" style="margin-top: 12em;">
 <div class="row">
   <div class="col-md-12">
     <h2>Contact Us</h2><hr>
     <form action="" method="post">@csrf
       <div class="form-group">
         <label name="email">Email:</label>
         <input id="email" name="email" class="form-control">
       </div>

       <div class="form-group">
         <label name="subject">Subject:</label>
         <input id="subject" name="subject" class="form-control">
       </div>
       <div class="form-group">
         <label name="message">Message:</label>
         <textarea id="message" name="message" class="form-control">Type your text here...</textarea>
       </div>
       <input type="submit" value="Send Message" class="btn btn-success">
     </form>
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
