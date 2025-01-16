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
@include('partials._footer')