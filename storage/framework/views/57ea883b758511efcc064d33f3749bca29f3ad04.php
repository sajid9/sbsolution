<!DOCTYPE html>
<html>
<head>
	<title>CSV File</title>
	<link rel="stylesheet" type="text/css" href="<?php echo e(asset('dist/themes/default/style.css')); ?>">
	<script src="<?php echo e(asset('js/jquery.min.js')); ?>"></script>
	<script src="<?php echo e(asset('dist/jstree.min.js')); ?>"></script>

</head>
<body>
<form method="post" action="<?php echo e(url('importCsv')); ?>" enctype="multipart/form-data">
	<?php echo csrf_field(); ?>
	<input type="file" name="file" accept=".csv">
	<button type="submit">import</button><a href="<?php echo e(url('exportCsv')); ?>">Export</a>
</form>
<div id="html"></div>
<script>
	/*$('#html').jstree();*/
	$('#html').jstree({
		'core' : {
			'data' : [
				{ "text" : "Root node", "children" : [
						{ "text" : "Child node 1" },
						{ "text" : "Child node 2" }
				]}
			]
		},
		'plugins':["checkbox"]
	});
	$('#html').on("changed.jstree", function (e, data) {
      console.log(data.selected);
    });
</script>
</body>
</html>