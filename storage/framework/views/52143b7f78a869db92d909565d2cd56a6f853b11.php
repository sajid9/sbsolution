<html>
   <head>
      <title><?php echo $__env->yieldContent('title'); ?></title>
      
      <?php echo $__env->yieldContent('header'); ?>
    </head>
    <body>
		<div id="wrapper">
			
			<?php echo $__env->yieldContent('sidebar'); ?>
		    <!-- Page Content -->
		    <div id="page-wrapper">
		        <div class="container-fluid">
		            <div class="row">
		                <div class="col-lg-12">
		                    <h1 class="page-header"><?php echo $__env->yieldContent('pagetitle'); ?></h1>
		                </div>
		            </div>
		            <!-- ... Your content goes here ... -->
		            <?php echo $__env->yieldContent('content'); ?>
		        </div>
		    </div>

		</div>
		
		<?php echo $__env->yieldContent('footer'); ?>
	</body>
</html>
<?php /**PATH E:\xamp\htdocs\sb_solution\resources\views/layout/app.blade.php ENDPATH**/ ?>