@extends('admin.index')

@section('pageTitle', 'Administrar páginas')
@section('title', 'Administrar páginas de su sitio web')



@section('main')


	<div class=".col-md-4 center adminBlock">

		
		<table class="table">
			<thead>
				<th>Título</th>
				<th>Visible</th>
				
			</thead>
			
			<tbody id="datos-menu">
				
			</tbody>
		</table>
		
	</div>
	<input type="hidden" name="_token" value="{{csrf_token()}}" id="token">

	<tbody id="datos"></tbody>

	</div>

	@section('aditional-scripts')
	{!!Html::script('js/baseurl.js')!!}
	{!! Html::script('js/pages/menu.js') !!}
	<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
	@endsection

@endsection

