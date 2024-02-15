     @include('partials._head')
     @include('partials._menu')
     <style>
    img{
        min-width: 3em;
        max-width: 100%;
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
           <div class="right">
               <div><span><?php echo $user->name; ?>&nbsp;@<?php echo str_replace(' ', '', $user->name); ?></span></div>
           <div>
            <?php if(!is_null($user->role)){ ?>
              <?php foreach($user->role as $role ) { ?>
                 <span class="badge badge-danger"><?php echo $role->user_role; ?></span>  
              <?php } ?> 
            <?php } ?>
            <?php if(!is_null($user->status)){ ?>  
              <?php foreach($user->status as $status) { ?>
               <span class="badge badge-secondary"><?php echo $status->user_status; ?></span>
              <?php } ?> 
            <?php } ?> 
            <span class="badge badge-danger"><?php //echo $user->status[1]->user_status; ?></span>
           </div> 
           </div> 
       </article>
      </div>
     </div>
    </div>
    <div class="container text-left">
      <div class="row align-items-start">
       <div class="col-md-4"> 
        <?php if(!is_null($user->address)){ ?>
         <article> 
             <p><?php echo $user->address->address; ?></p>
         </article>
        <?php } ?>
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
          <p>
              <iframe width="560" height="315" src="https://www.youtube.com/embed/SvAavYuCpE0?si=JlCCz3aRht4yJqDQ" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>
          </p>
         </article>
        <?php } ?>
       </div> 
      </div>
    </div>  
   </div>
 </div>
</div>
</div><!--end of container-->
 
<img src="<?php //echo storage_path().'/app/index.jpeg'; ?>" alt="">
@yield('content')
   <!-- Optional JavaScript -->
   <!-- jQuery first, then Popper.js, then Bootstrap JS -->
   <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
   <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>
   <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js" integrity="sha384-h0AbiXch4ZDo7tp9hKZ4TsHbi047NrKGLO3SEJAg45jXxnGIfYzk4Si90RDIqNm1" crossorigin="anonymous"></script>
 </body>
</html>
