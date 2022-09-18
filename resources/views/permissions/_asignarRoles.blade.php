<table class="table table-bordered table-striped">
@foreach($roles as $rol)

	<tr>
		<td>
			<h5>{{$rol->name}}</h5>
			{{$rol->description}} / <small class="pull-right text-navy">creado el: {{$rol->created_at}}</small>
		</td>
		<td>
			@if(!$rol->hasPermissionTo($permission->name))
				<form method="post" action="{{route('permissions.assignToRoles',$permission->id)}}">
					@method('POST')
					@csrf
					<input type="hidden" value="{{$rol->name}}" name="roles" >
					<button type="submit" class="btn waves-effect waves-light btn-primary" ><i class="fa fa-thumbs-up"></i> Asignar </button>
				</form>
				@else
				<form method="post" action="{{route('permissions.revokePermissionFromRole',$permission->id)}}">
					@method('POST')
					@csrf
					<input type="hidden" value="{{$rol->name}}" name="roles" >
					<button type="submit" class="btn waves-effect waves-light btn-danger"><i class="fa fa-minus"></i> remover</button>
				</form>
				@endif
		</td>
	</tr>
@endforeach
</table>
