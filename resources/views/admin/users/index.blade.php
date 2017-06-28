@extends('admin.index')

@section('pageTitle', 'Administrar usuarios')
@section('title', 'Administrar usuarios registrados en su sitio web')


@section('popups')

	@include('admin.pages.messages.confirmation')
	@include('admin.pages.messages.create')
	@include('admin.pages.messages.quick-edit')
	@endsection


@section('main')

	<div class=".col-md-4 center adminBlock">

		<table class="table">
			<thead>
				<th>Nombre</th>
				<th>Mail</th>
				<th>Tipo</th>
				<th>Fecha de alta</th>
				<th>Newsletter</th>
				<th>Status</th>
			</thead>
			
			<tbody id="datos">
				@foreach($users as $user)
				<tr>
					<td><?php echo  $user->name ?></td>
					<td><?php echo  $user->email ?></td>
					<td>
					<?php 
					
					if($user->type == 1)
					{
						echo "SuperAdmin";
					}
					else{
						echo "Suscriptor";
					}
				    ?>	
					</td>
					
					<td><?php echo  $user->created_at ?></td>


					<td>
					<?php 
					
					if($user->newsletter == 1)
					{
						echo "Si";
					}
					else{
						echo "No";
					}
				    ?>	
					</td>

					<td>
					<?php 
					
					if($user->status == 1)
					{
						echo "Activo";
					}
					else{
						echo "Dado de baja";
					}
				    ?>	
					</td>
				</tr>
				@endforeach
				
			</tbody>
		</table>
		
	</div>


	<tbody id="datos"></tbody>

	</div>

	@section('aditional-scripts')
	{!!Html::script('js/baseurl.js')!!}
	{!! Html::script('js/users/ajax-admin.js') !!}
	@endsection

@endsection

