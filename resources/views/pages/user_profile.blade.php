     @include('partials._head')
     @include('partials._menu')
     <style>
    img{
        min-width: 3em;
        max-width: 200px;
    }
        article{
            padding: 1.3em;
            margin: 1em;
            margin-left: 1em;
            margin-left: 0;
            border-radius: .3em;
            box-shadow: 3px 3px 3px 3px lightblue
            }
        .user_header{
            display: flex;  
            }    
        
        .left{
            margin-left: 1em;
            }
        .user_image img{
            border: none;
            border-radius: 3em;
            }
        .right{
            margin-left: 1em;     
            }    
     </style>
 <div class="container" style="margin-top: 12em;">
 <div class="row">
   <div class="col-md-12"> 
    <div class="container text-left">
     <div class="row align-items-start">
      <div class="col-md-12"> 
          <article class="user_header">
           <div class="left">
               <span class="user_image"><img width="38" src=" <?php echo asset('albill.png'); ?>" alt="image" /></span>
           </div>
           <div class="right">na
               <div><span><?php echo $user->name; ?>&nbsp;@<?php echo str_replace(' ', '', $user->name); ?></span></div>
           <div>
            <?php if(!is_null($user->role)){ ?>
              <?php foreach($user->role as $role ) { ?>
                 <span class="badge badge-danger"><?php echo $role->roleName->role; ?></span>  
              <?php } ?> 
            <?php } ?>
            <?php if(!is_null($user->status)){ ?>  
              <?php foreach($user->status as $status) { ?>
               <span class="badge badge-secondary"><?php echo $status->statusName->status; ?></span>
              <?php } ?> 
            <?php } ?> 
        <span class="btn btn-warning" data-toggle="modal"
            data-target="#editUser"><?php echo 'Edit User'; ?></span>
        <button
            type="button"
            class="btn btn-primary"
            data-toggle="modal"
            data-target="#createWidget">
            Create widget
        </button>
           </div> 
           </div> 
       </article>
      </div>
     </div>
    </div>
    <div class="container text-left">
      <div class="row align-items-start">
       <div class="col-md-4"> <?php //dd($user->role); ?>
         <article> 
            <?php if(!is_null($user->address)){ ?>
              <p><?php echo $user->address->address; ?></p>
            <?php } ?>
            <p><?php echo 'Member since '.$user->created_at->isoFormat('MMM Do YYYY'); ?></p>
         </article>
        <?php if(!is_null($user->language)){ ?> 
         <article>
          <b>Languages</b>
          <ul>
          <?php foreach($user->language as $language ) { ?>
            <?php echo '<li>'.$language->language.'</li>'; ?>
          <?php } ?>
           </ul>
         </article>
        <?php } ?>
        <?php if(!empty($user->linkedAccount)){ ?> 
         <article>
           <b>Linked accounts</b>
           <ul>
           <?php foreach($user->linkedAccount as $linkedAccount) { ?>
             <?php echo '<li>'.$linkedAccount->liked_account.'</li>'; ?>
           <?php } ?>
           </ul> 
         </article>
        <?php } ?>
       </div>
       <div class="col-md-8">
        <?php if(!is_null($user->description)){ ?> 
         <article>
          <p><b>About me</b></p>
          <p><?php echo $user->description->user_description; ?></p>  
         </article>  
        <?php } ?>
            <p><?php foreach ($user->contents as $key => $item)
                    {
                     $contents[$item['content_link']][$key] = $item; //dump($item['content_link']);
                    }  
                    //dd($contents);
              ?>
            </p>   
                <?php if (session()->get('status') != null): ?>
               <div class="alert alert-danger" role="alert">
                 <?php echo session()->get('status'); ?>
               </div>
            <?php endif; ?>  
            <?php if(isset($contents)){ ?>
            <?php foreach ($contents as $key => $content): ?>
            <article class="article">
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
           
           <input type="hidden" name="content_link" value="<?php echo $key; ?>" />
           <div class="form-outline mb-4">
           <input type="text" id="form3Example1cg" class="form-control form-control-lg" name="comment" placeholder="Be the first to add a comment" />
          </div>
         <div class="d-flex justify-content-center">
        <button type="submit"
         class="btn btn-success btn-block btn-lg gradient-custom-4 text-body">Add Comment</button>
        </div>
        </form>
        </article>
        <?php endforeach; ?> 
        <?php } ?>    
       </div> 
      </div>
    </div>  
   </div>
 </div>
</div>
</div><!--end of container-->
   
<div class="modal fade" id="editUser" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Edit User</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="/profile/createArticleForm" method="post">  @csrf
         <div class="modal-body">  
             User name: 
             <input type="text" name="user_name" value="<?php echo $user->name; ?>" />  
             <br/>User image: 
             <input type="file" name="user_image" value="<?php echo $user->name; ?>" /> 
             <br/>User roles:  
             <?php foreach($user->role as $role){ ?>
                <input type="checkbox" id="scales" name="<?php echo $role->roleName->role; ?>" checked />
                <label for="scales"> <?php echo $role->roleName->role.','; ?></label>
             <?php } ?>  
              <br/>User status: 
             <?php foreach($user->status as $status){ ?>
             <?php echo $status->statusName->status.','; ?>
             <?php } ?>
             <br/>About me:
             <textarea id="w3review" name="user_description"> 
               <?php echo $user->description->user_description ?? null ; ?>
             </textarea> 
             <br/>User address:
             <input type="text" name="user_address" value="<?php echo $user->address->address ?? null ; ?>" />  
         </div>
         <div class="modal-footer">
           <a
              href="/profile/deleteWidget?widget_id=<?php //echo $widget->widget_id; ?>"
              class="btn btn-danger">Delete <?php //echo $widget->name. ' Widget'; ?>
           </a>
           <button type="button" onclick="editUser(event)" class="btn btn-primary">Save changes</button>
           <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
         </div>
        </form>
      </div>
    </div>
  </div>

<img src="<?php //echo storage_path().'/app/index.jpeg'; ?>" alt="">
@yield('content')
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
    row[editThis.attributes.commentid.value] = editThis.textContent.trim()
    row = JSON.stringify(row)

    function getData(data)
    {
      console.log(data.response);
    }

    getSendAjaxRequest('/edit/comment', row, getData)
  }
  
  
    let user_id = '<?php echo $user->name; ?>'
    
  function editUser(event)
  {  
      console.log(event.target.form)
       
    let form = event.target.form
    let formdata = {
       "user_id": '<?php echo $user->id; ?>',
	   "user_name": form.user_name.value, 
	   "user_statuses": [1,2,3],
       "user_roles": [1,2,3],
       "user_description": form.user_description.value,  
	   "user_address": form.user_address.value,
       "languages": [2],
       "liked_accounts": [2]
	}
    console.log(formdata)
    //editThis.setAttribute('contenteditable', false)
    //editThis.style.border = "none"
   // thisComment.setAttribute('onclick', 'editComment(event)')

   // let content_id = editThis.attributes.commentid.value
   // let row = []
   // row[editThis.attributes.commentid.value] = editThis.textContent.trim()
   
    formdata = JSON.stringify(formdata)

    function getData(data)
    {
      console.log(data.response);
    }

    getSendAjaxRequest('/edit/user', formdata, getData)
  }

</script>
   <!-- Optional JavaScript -->
   <!-- jQuery first, then Popper.js, then Bootstrap JS -->
   <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
   <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>
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
   <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js" integrity="sha384-h0AbiXch4ZDo7tp9hKZ4TsHbi047NrKGLO3SEJAg45jXxnGIfYzk4Si90RDIqNm1" crossorigin="anonymous"></script>
 </body>
</html>
