@include ('partials._head')
@include ('partials._menu')
@include ('partials._hero')
<style media="screen">
    img{
        min-width: 3em;
        max-width: 100%;
    }
 .article{
  padding: 3em;
  margin: 1em;
  margin-left: 0;
  border-radius: 1em;
  box-shadow: 3px 3px 3px 3px lightblue;
  }
  .comment{
    padding: .3em 3em .3em 1em;
    margin: 1em;
    margin-left: 0;
  }
</style>
<div class="container">
 <div class="row">
  <div class="col-md-12">
    <?php if (session()->get('status') != null): ?>
     <div class="alert alert-danger" role="alert">
       <?php echo session()->get('status'); ?>
     </div>
    <?php endif; ?>
    @if(count($fields['field_group_post']) != 0)
      <p>Add a new post</p>
      <form action="/post/create" method="post">@csrf
      <input type="hidden" name="field_group" value=
        <?php
          echo $fields['field_group_post'][0]->field_group_id;
         ?>
         >
       @foreach($fields['field_group_post'] as $field)
        <div class="form-outline mb-4">
          <input type="{{$field->fieldType->type}}" class="form-control form-control-lg" name="{{$field->field_id}}" />
          <label class="form-label" for="form3Example1cg">{{$field->field->name}}</label>
        </div>
        @endforeach
        <div class="d-flex justify-content-center">
         <button type="submit"
           class="btn btn-success btn-block btn-lg gradient-custom-4 text-body">Add Post</button>
        </div>
       </form><br><br><br>
      @endif
 
<?php foreach ($contents as $key => $content): ?>
  <div class="article">
  <?php $first_key_from_posts_item = array_key_first($content); ?>
  <?php if ($content[$first_key_from_posts_item]->field_group === 2): ?>
    <button type="button" class="btn btn-primary">Buy This Product</button>
  <?php endif; ?>
  <?php foreach ($content as $item): ?>
    <div> 
        <a href="article?content_link=<?php echo $item['content_link']; ?>" target="_blank">
      <?php if ($item->field->name == 'picture'): ?>
        <?php   $imageUrl = asset('laravel/public/'.$item['content']); ?>
        <?php echo '<img src="'. $imageUrl .'" alt="Could not load the image"> '; ?>
       <?php elseif ($item->field_id == 53): ?>
        <td><?php echo $item->field->name." : <span style='background-color:".$item->content.";padding:.3em 1em;'></span>"; ?></td>
       <?php else: ?>
        <?php echo  $item->field->name.': '. $item['content'];?>
      <?php endif; ?>
    </a>
   </div> 
 <?php endforeach; ?>
    <span> 
      <b>added by: </b><?php echo '<a href="/show_user?user_id='.$content[$first_key_from_posts_item]->user->id.'" target="_blank">'.$content[$first_key_from_posts_item]->user->name.'</a>'; ?>
      <b>added: </b><?php echo $content[$first_key_from_posts_item]['created_at']->diffForHumans(); ?>
    <?php if(!$content[$first_key_from_posts_item]->comment->isEmpty()){ ?>
        <br><span>Comments:</br></span>
    <?php } ?>
    <?php foreach ($content[$first_key_from_posts_item]->comment as $comment): ?>
      <?php if ($comment->user_id === auth()->id()): ?>
         <span class="comment" canbeedit=true commentid="<?php echo $comment->comment_id; ?>">
          <?php echo $comment->comment.'</span>
          <button onclick="editComment(event)" type="button" class="btn btn-warning">Edit comment</button></br>'; ?>
      <?php else: ?>
       <span class="comment" canbeedit = false>
          <?php echo $comment->comment.'</span>'; ?>    
      <?php endif; ?> 
      <b>Added by: </b><?php echo '<a href="/show_user?user_id='.$comment->user_id.'" target="_blank">'.$comment->user->name.'</a>'; ?>
      <b>Added: </b><?php echo $comment->created_at->diffForHumans().'<br>'; ?>
    <?php endforeach; ?>
   </span>
   <form action="/comments/store" method="post">@csrf
     @error('title')
             {{ $title }}
     @enderror
     @error('description')
             {{ $description }}
     @enderror
     <input type="hidden" name="content_link" value="<?php echo $key; ?>" />
     <div class="form-outline mb-4">
       <input type="text" id="form3Example1cg" class="form-control form-control-lg" name="comment" placeholder="Be the first to add a comment" />
     </div>
     <div class="d-flex justify-content-center">
       <button type="submit"
         class="btn btn-success btn-block btn-lg gradient-custom-4 text-body">Add Comment</button>
     </div>
   </form>
 </div>
<?php endforeach; ?>

  </div>
 </div>
</div>
<script type="text/javascript">
  let thisComment = canBeEdit = editThis = null
  function editComment(event)
  {
    thisComment = event.target
    canBeEdit = thisComment.previousElementSibling.attributes.canbeedit.value
    editThis = thisComment.previousElementSibling
    if (canBeEdit == "true")
    {
      editThis.setAttribute('contenteditable', true)
      editThis.style.border = "3px solid lightblue"
      thisComment.setAttribute('onclick', 'saveComment(event)')
    }else
    {
      alert('You can not edit this comment.')
    }
  }

  function saveComment(event)
  {
    editThis.setAttribute('contenteditable', false)
    editThis.style.border = "none"
    thisComment.setAttribute('onclick', 'editComment(event)')

    let content_id = editThis.attributes.commentid.value
    let row = []
    row[editThis.attributes.commentid.value] =   editThis.textContent.trim()
    row = JSON.stringify(row)

    function getData(data)
    {
      console.log(data.response);
    }

    getSendAjaxRequest('/edit/comment', row, getData)
  }

</script>
<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js" integrity="sha384-h0AbiXch4ZDo7tp9hKZ4TsHbi047NrKGLO3SEJAg45jXxnGIfYzk4Si90RDIqNm1" crossorigin="anonymous"></script>
<script type="text/javascript">
//Ajax send request, only sends data to a file with GET
function sendAjaxRequest(url,data) {
  const request = new XMLHttpRequest();
  request.open("GET",url+"?data="+data,true);
  request.send();
}
//Ajax get request, only get data from a file with GET
function getAjaxRequest(url,getData) {
  const request = new XMLHttpRequest();
  request.onload = function () {
    if (this.readyState === 4 && this.status === 200) {
        getData(this);
    }
  }
  request.open("GET",url,true);
  request.send();
}
//Ajax send and get request, sends and gets data from a file with GET
function getSendAjaxRequest(url,data,getData) {
   const request = new XMLHttpRequest();
   request.onload = function () {
     if (this.readyState === 4 && this.status === 200) {
        getData(this);
     }
   }
   request.open("GET",url+"?data="+data,true);
   request.send();
}
</script>
</body>
</html>
