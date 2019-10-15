<!DOCTYPE html>
<html>
<head>
	<title>CSV File</title>
	<link rel="stylesheet" type="text/css" href="{{ asset('dist/themes/default/style.css') }}">
	<link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
	<script src="{{ asset('js/jquery.min.js') }}"></script>
	<script src="{{ asset('dist/jstree.min.js') }}"></script>

</head>
<body>
<form method="post" action="{{url('importCsv')}}" enctype="multipart/form-data">
	@csrf
	<input type="file" name="file" accept=".csv">
	<button type="submit">import</button><a href="{{url('exportCsv')}}">Export</a>
</form>
<div id="html"></div>
<script>
	/*$('#html').jstree();*/
	$('#html').jstree({
		'core' : {
			'data' : [
				{ "text" : "item info", "children" : [
						{ "text" : "add item" },
						{ "text" : "item ledger" }
				]},
				{ "text" : "voucher info", "children" : [
						{ "text" : "voucher" },
						{ "text" : "voucher ledger" }
				]}
			]
		},
		"types" : {
		    "default" : {
		      "icon" : "glyphicon glyphicon-user"
		    },
		    "demo" : {
		      "icon" : "glyphicon glyphicon-user"
		    }
		  },
		  
		'plugins':["checkbox","types"]
	});
	$('#html').on("changed.jstree", function (e, data) {
      	var selectedData = [];
      	var selectedIndexes;
      	 selectedIndexes = $("#html").jstree("get_selected", true);
      	 jQuery.each(selectedIndexes, function (index, value) {
      	         selectedData.push(selectedIndexes[index].id);
      	 });
      	 console.log(selectedData);
    });
</script>
</body>
</html>