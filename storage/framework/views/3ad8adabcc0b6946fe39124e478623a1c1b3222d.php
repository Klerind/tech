     <?php echo $__env->make('partials._head', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
     <?php echo $__env->make('partials._menu', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
     <style media="screen">
       #product_fields_container
       {
         display: flex;
         justify-content: start;
         flex-wrap: wrap;
       }
     </style>
 <div class="container-fluid" style="margin-top: 12em;">
 <div class="row">
   <div class="col-md-12">
        <h2>Profile</h2>
        <a
           href='/test'
           type="button"
           class="btn btn-primary">
           Create Test
        </a>
     <button
            type="button"
            class="btn btn-primary"
            data-toggle="modal"
            data-target="#createWidget">
            Create widget
     </button>

    <?php foreach ($widgets as $widget): ?>
    <button
           type="button"
           class="btn btn-primary"
           data-toggle="modal"
           data-target="#add<?php echo str_replace(' ', '', $widget->name); ?>Widget">
           Add <?php echo $widget->name; ?> widget
    </button>
    <?php endforeach; ?>

<style media="screen">
 .article{
       padding: 3em;
       margin: 1em;
       margin-left: 0;
       border-radius: 1em;
       box-shadow: 3px 3px 3px 3px lightblue;
       }
</style>
<div class="container">
 <div class="row">
   <div class="col-md-12">
<?php foreach ($widgets as $widget): ?>
 <div class="article">
  <p>Add <?php echo $widget->name; ?></p>
  <form action="/profile/create/content" method="post" enctype="multipart/form-data"><?php echo csrf_field(); ?>
    <input type="hidden" name="field_group" value="<?php echo $widget->field_group_id; ?>">
  <?php foreach ($fields['fields'] as $field): ?>
   <?php if ($widget->field_group_id === $field->field_group_id): ?>
     <div class="form-outline mb-4">
       <?php if ($field->fieldType->type == 'file'): ?>
        <input
              type="<?php echo $field->fieldType->type; ?>"
              class="form-control form-control-lg"
              name="image" />
        <input
              type="hidden"
              class="form-control form-control-lg"
              name="<?php echo $field->field->field_id; ?>" value=""/>
       <?php else: ?>
        <input
              type="<?php echo $field->fieldType->type; ?>"
              class="form-control form-control-lg"
              name="<?php echo $field->field->field_id; ?>" />
       <?php endif; ?>
       <label
            class="form-label"
            for="form3Example1cg">
            <?php echo $field->field->name; ?>
      </label>
     </div>
   <?php endif; ?>
  <?php endforeach; ?>
  <div class="d-flex justify-content-center">
   <button
     type="submit"
     class="btn btn-success btn-block btn-lg gradient-custom-4 text-body">
     Add <?php echo $widget->name; ?>
   </button>
  </div>
 </form>
 </div>
<?php endforeach; ?>
  </div>
 </div>
</div>

   </div>
 </div>

</div>

</div><!--end of container-->

<div class="container">
 <div class="row">
   <div class="col-md-12 justify-content-center">
<?php foreach ($widgets as $widget): ?>
    <h3 style="text-align:center;"><?php echo $widget->name; ?> Table</h3>
 <div class="article d-flex justify-content-center">
   <table>
     <tr>
       <?php $all = null;  $all_fields = []; ?>
       <?php foreach ($fields['fields'] as $field): ?>
         <?php if ($widget->field_group_id === $field->field_group_id): ?>
           <?php $all_fields[] = $field; ?>
           <th><?php echo $field->field->name; ?></th>
         <?php endif; ?>
       <?php endforeach; ?>
       <th>added on</th>
       <th>Edit or Delete</th>
     </tr>
     <?php $all_fields = count($all_fields); ?>
     <?php foreach ($contents as $key => $content): ?>
       <?php $first_key_from_content = array_key_first($content); ?>
     <?php if ($widget->field_group_id === $content[$first_key_from_content]->field_group): ?>
       <?php $all = count($content); ?>
      <tr>
       <?php $contents_id = null; ?>
       <?php foreach ($content as $item): ?>
         <?php //dd($item); ?>
        <?php $contents_id .= $item['content_id'].','; ?>
        <?php if ($item->field_id == 28): ?>
          <?php   $imageUrl = asset($item['content']); ?>
          <td><?php echo '<img width="90" src="'. $imageUrl .'" alt="image"> '; ?></td>
        <?php elseif ($item->field_id == 53): ?>
          <td><?php echo "<span style='background-color:".$item->content.";padding:.3em 1em;'></span>"; ?></td>
        <?php else: ?>
         <td><?php echo $item->content; ?></td>
        <?php endif; ?>
       <?php endforeach; ?>
       <?php if ($all_fields > $all): ?>
         <?php for ($i=0; $i < $all_fields - $all; $i++) { ?>
           <td>no content</td>
         <?php } ?>
       <?php endif; ?>
       <td><?php echo $content[$first_key_from_content]->created_at; ?></td>
       <td>
        <a href="/post/edit?contents_id=<?php echo $contents_id; ?>"
           class="btn btn-warning">Edit</a>
        <a href="/post/delete?contents_id=<?php echo $contents_id; ?>"
           class="btn btn-danger">Delete</a>
       </td>
      </tr>
    <?php endif; ?>
<?php endforeach; ?>
  </table>
 </div>
<?php endforeach; ?>
  </div>
 </div>
</div>

<div class="container-fluid">
  <div class="row">
<?php if(!empty($posts)) { ?>
  <div class="col-md-6">
    <h3 style="text-align:center;">Posts Table</h3>
    <table>
      <tr>
        <?php $__currentLoopData = $fields['field_group_post']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $field): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
         <th><?php echo e($field->field->name); ?></th>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <th>added on</th>
        <th>Edit or Delete</th>
      </tr>
      <?php
          $all = null;
          $all_fields = count($fields['field_group_post']);
      ?>
      <?php foreach ($posts as $post): ?>
      <?php  $all = count($post); ?>
    <tr>
      <?php $contents_id = null; ?>
      <?php foreach ($post as $item): ?>
         <td tabindex="<?php echo $item['content_id']; ?>"><?php echo e($item['content']); ?></td>
         <?php $contents_id .= $item['content_id'].','; ?>
      <?php endforeach; ?>
      <?php if ($all_fields > $all): ?>
        <?php for ($i=0; $i < $all_fields - $all; $i++) { ?>
             <td>no content</td>
        <?php } ?>
      <?php endif; ?>

      <td><?php echo e($item['created_at']); ?></td>
      <td><a href="/post/edit?contents_id=<?php echo $contents_id; ?>"
             class="btn btn-warning">Edit</a>
          <a href="/post/delete?contents_id=<?php echo $contents_id; ?>"
             class="btn btn-danger">Delete</a>
    </tr>
    <?php endforeach; ?>
   </table>
  </div>
<?php } ?>

<?php if(!empty($products) && 0 != 0) { ?>
<div class="col-md-6">
  <h3 style="text-align:center;">Products Table</h3>
  <table>
   <tr>
     <?php $__currentLoopData = $fields['field_group_product']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $field): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
      <th><?php echo e($field->field->name); ?></th>
     <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
     <th>added on</th>
     <th>Edit or Delete</th>
   </tr>
<?php
    $all = null;
    $all_fields = count($fields['field_group_product']);

    foreach ($products as $product):
      $first_key_from_products_item = array_key_first($product);
      $all = count($product); ?>
    <tr>
    <?php foreach ($product as $item): ?>
      <td tabindex="3" contentid=<?php echo e($item['content_id']); ?>><?php echo e($item['content']); ?></td>
    <?php endforeach; ?>
    <?php if ($all_fields > $all): ?>
      <?php for ($i=0; $i < $all_fields - $all; $i++) { ?>
           <td>no content</td>
      <?php } ?>
    <?php endif; ?>
   <td><?php echo $product[$first_key_from_products_item]->created_at; ?></td>
   <td><span onclick="edit(event)"class="btn btn-info">Edit</span></td>
   </tr>
<?php endforeach; ?>
 </table>
</div>
<?php } ?>
</div>
</div>

<div class="modal fade" id="createWidget" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">New widget</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
     <form action="/profile/createWidget" method="get">  <?php echo csrf_field(); ?>
       <div class="modal-body">
        <div id="product_fields_form" onsubmit="return handleFildForm(event)">
          <input type="text" name="widget_name" value="" placeholder="Widget name">
          <input type="hidden" name="field_group_id" value="0">
        </div>
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-primary">Add Widget</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
     </form>
    </div>
  </div>
</div>

<?php foreach ($widgets as $widget): ?>
  <div class="modal fade" id="add<?php echo str_replace(' ', '', $widget->name); ?>Widget" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title"><?php echo $widget->name; ?> widget</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="/profile/createArticleForm" method="post">  <?php echo csrf_field(); ?>
          <div class="modal-body">
           <div id="product_fields_form" onsubmit="return handleFildForm(event)">
             <input type="text" name="field" value="" placeholder="Field name">
             <select class="form-select" aria-label="Default select example">
                   <option selected>Select type</option>
                 <?php foreach ($fields['fields_type'] as $key => $value): ?>
                   <option value=<?php echo $value['field_type_id']; ?>><?php echo $value['type']; ?></option>
                 <?php endforeach; ?>
             </select>
             <button onclick="addProductField(event)" type="button" name="button">Add field</button>
             <div id="product_fields_container" class="product_fields_container"></div>
             <input class="add_fields" type="hidden" name="add_fields" value="0">
             <input class="add_types" type="hidden" name="add_types" value="0">
           </div>
           <input type="hidden" name="field_group" value = "<?php echo $widget->field_group_id; ?>">
           <input class="remove_ids" type="hidden" name="remove_fields" value="0">
           <?php foreach ($fields['fields'] as $field): ?>
            <?php if ($widget->field_group_id === $field->field_group_id): ?>
             <div class="form-outline mb-4">
               <input type="<?php echo $field->fieldType->type; ?>"
                     name="<?php echo $field->field->name; ?>"
                     checked="true"
                     value="<?php echo $field->user_form_field_id; ?>"/>
               <label class="form-check-label" for="form3Example1cg"><?php echo $field->field->name; ?></label>
               <a onclick="deleteField(event)" href="#">Delete</a>
             </div>
            <?php endif; ?>
           <?php endforeach; ?>
         </div>
         <div class="modal-footer">
           <a
              href="/profile/deleteWidget?widget_id=<?php echo $widget->widget_id; ?>"
              class="btn btn-danger">Delete <?php echo $widget->name. ' Widget'; ?>
           </a>
           <button type="submit" class="btn btn-primary">Save changes</button>
           <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
         </div>
        </form>
      </div>
    </div>
  </div>
<?php endforeach; ?>

<p style="padding: 3em; color: white;"> </p>
<script type="text/javascript">

  let ids = []

  function deleteField(event)
  {
    console.log(event.target.parentElement.firstElementChild.value);
    ids.push(event.target.parentElement.firstElementChild.value)
    let hiddens = document.getElementsByClassName('remove_ids')

    for (variable of hiddens)
    {
      variable.value = ids
    }

    event.target.parentElement.remove()
   }

  let field_names = []
  let field_types = []

  function addProductField(event)
  {
   let field_name = event.target.parentElement.firstElementChild.value,
   field_type = event.target.previousElementSibling.value
   field_name = field_name.toLowerCase()

   const div = createField(field_name, field_type)

   if (field_name.length === 0 || field_type === 'Select type')
   {
     console.log('check for empty');
     return
   }

   field_names.push(field_name)
   field_types.push(field_type)

   event.target.nextElementSibling.nextElementSibling.value = field_names
   event.target.nextElementSibling.nextElementSibling.nextElementSibling.value = field_types
   event.target.nextElementSibling.append(div)
  }

  function createField(field_name, field_type)
  {
    const input = document.createElement('input')
    input.setAttribute('class', 'form-check-input')
    input.setAttribute('name', field_name)
    input.setAttribute('value', field_type)
    input.setAttribute('type', 'checkbox')
    input.setAttribute('checked', true)

    const label = document.createElement('label')
    label.setAttribute('class', 'form-check-label')
    label.innerText = field_name

    const a = document.createElement('a')
    a.setAttribute('onclick', 'deleteField(event)')
    a.setAttribute('href', '#')
    a.innerText = 'Delete'

    const div = document.createElement('div')
    div.setAttribute('class', 'form-check')
    div.append(input)
    div.append(label)
    div.append(a)
    return div
  }

  let rows = null

  function edit(event)
  {
   rows = event.target.parentElement.parentElement.cells

   for (var i = 0; i < rows.length; i++)
   {
     rows[i].setAttribute('contenteditable', true)
     rows[i].setAttribute('style', 'border: 1px solid lightblue; padding: 0 9px;')
   }
   event.target.parentElement.setAttribute('contenteditable', false)
   event.target.parentElement.setAttribute('style', 'border: none; padding: 0 9px;')
   event.target.parentElement.previousElementSibling.setAttribute('contenteditable', false)
   event.target.parentElement.previousElementSibling.setAttribute('style', 'border: none; padding: 0 9px;')
   event.target.setAttribute('onclick', 'save(event)')
   event.target.textContent = 'Save'
  }

  function save(event)
  {
   rows = event.target.parentElement.parentElement.cells
   let row = []

   for (var i = 0; i < rows.length; i++)
   {
     rows[i].setAttribute('contenteditable', false)
     rows[i].setAttribute('style', 'border: none; padding: 0 9px;')

     for (var ii = 0; ii < rows[i].attributes.length; ii++)
     {
      if (rows[i].attributes[ii].name == 'contentid')
      {
       row[rows[i].attributes.contentid.value] = rows[i].textContent.trim()
      }
     }

   }

   row = JSON.stringify(row)

   event.target.setAttribute('onclick', 'edit(event)')
   event.target.textContent = 'Edit'

   function getData(data)
   {
    // console.log(data.response);
   }

   getSendAjaxRequest('/requestApi', row, getData)
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
<?php /**PATH /var/www/html/laravel_blog000/resources/views/pages/profile.blade.php ENDPATH**/ ?>