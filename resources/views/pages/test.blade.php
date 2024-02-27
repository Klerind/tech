     @include('partials._head')
     @include('partials._menu')
<div class="container" style="margin-top: 12em;">
 <div class="row">
   <div class="col-md-12">
     <form action="/test/result" method="get" id="testResult">
       <input type="submit" name="" value="Finish test">
     </form>
     <?php if (!is_null($questions)): ?>
     <?php foreach ($questions as $question): ?>
        <p><?php echo $question->question; ?></p>
        <?php $answers_id = null; ?>
        <?php foreach ($question->new_answers as $key => $value): ?>
        <?php $answers_id .= $key.','; ?>
          <input type="radio" name="question<?php echo $question->question_id; ?>" value=<?php echo $key; ?> form="testResult">
          <input type="hidden" name="answersquestion<?php echo $question->question_id; ?>" value=<?php echo $answers_id; ?> form="testResult">
          <?php if (is_array($value)): ?>
            <label style="color:red;" for=""><?php echo $value[0]; ?></label><br>
          <?php else: ?>
            <label for=""><?php echo $value; ?></label><br>
          <?php endif; ?>
        <?php endforeach; ?>
     <?php endforeach; ?>
     <?php endif; ?>
   </div>
  </div>
 </div>
</div><!--end of container-->
@yield('content')
   <!-- Optional JavaScript -->
   <!-- jQuery first, then Popper.js, then Bootstrap JS -->
   <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
   <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>
   <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js" integrity="sha384-h0AbiXch4ZDo7tp9hKZ4TsHbi047NrKGLO3SEJAg45jXxnGIfYzk4Si90RDIqNm1" crossorigin="anonymous"></script>
 </body>
</html>
