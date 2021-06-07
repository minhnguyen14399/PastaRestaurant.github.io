<!DOCTYPE html>
<html lang="en">
<head>
    @include('pages.elements.head')
</head>
<body>

<div class="container">
	@include('pages.elements.header')
	@include('pages.elements.category_list')
	
	<div class="col-sm-9 padding-right">
	@include('pages.elements.product_list')
	<center>
		{!! $all_product->render() !!}
	</center>
	</div>
</div>
@include('pages.elements.footer')
@include('pages.elements.script')
</body>
</html>