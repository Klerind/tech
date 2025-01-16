  @include('partials._head')
  @include('partials._menu')

<div class="container" style="margin-top: 12em;">
 <div class="row">
   <div class="col-md-12">
       <a href="/profile">Back</a>
       <p>Edit post</p>
       <form action="/post/create" method="post">@csrf
       <input type="hidden" name="field_group" value=
         <?php
           echo $post_contents[0]['field_group'];
          ?>
          >
       <input type="hidden" name="content_link" value=
         <?php
           echo $post_contents[0]['content_link'];
          ?>
          >
          <?php foreach ($post_contents as $post_content): ?>
            <?php if (!is_null($post_content)): ?>
            <div class="form-outline mb-4">
              <label class="form-label" for="form3Example1cg"><?php echo $post_content->field->name; ?></label>
              <input type="<?php ?>"
                     class="form-control form-control-lg"
                     name="<?php echo $post_content->field->field_id; ?>"
                     value="<?php echo $post_content->content; ?>" />
              </div>
            <?php endif; ?>
          <?php endforeach; ?>
         <div class="d-flex justify-content-center">
          <button type="submit"
            class="btn btn-primary btn-block btn-lg gradient-custom-4 text-body">Edit Post</button>
         </div>
        </form>
   </div>
 </div>

</div><!--end of container-->

@include('partials._footer')