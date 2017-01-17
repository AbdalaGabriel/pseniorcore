
<div class="modal fade" id="add-files" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h3 class="modal-title" id="myModalLabel">Edición rápida</h3>
			</div>
			<div class="modal-body">
				{!! Form::open(['url' => '/admin/media', 'method'=>'POST','files' => true]) !!}
					{!!Form::label('title', 'Titulo', ['class' => 'form-control']);!!}

					<input type="hidden" name="_token" value="{{csrf_token()}}" id="token">

					<div class="form-group">
						{!!Form::label('Archivos','Seleccionar archivos')!!}
						{!!Form::file('files[]', ['multiple' => true, 'id' => 'files'])!!}
					</div>


				{!! Form::close() !!}
				</div>
			<div class="modal-footer">
			{!!link_to('#', $title='Confirmar', $attributes = ['id'=>'confirmation-upload-files', 'class'=>'btn btn-primary', 'data-dismiss'=>'modal'], $secure = null)!!}

			</div>
		</div>
	</div>
</div>


