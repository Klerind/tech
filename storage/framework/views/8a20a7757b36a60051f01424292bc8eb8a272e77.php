<div class="container" style="margin-top: 12em;">
<div class="row">
  <div class="col-md-12">
    <?php if(auth()->guard()->check()): ?>
        <h2>We need to read more from your posts <?php echo e(auth()->user()->name); ?> </h2>
    <?php endif; ?>
   </div>
</div>
</div>
<?php /**PATH /var/www/html/laravel_blog000/resources/views/partials/_hero.blade.php ENDPATH**/ ?>