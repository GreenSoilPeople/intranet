<div class="form-group">
    {{ Form::label($name, $label, ['class' => 'control-label col-sm-2']) }}
	<div class="col-sm-10">
    {{ Form::text($name, $value, array_merge(['class' => 'form-control'], $attributes)) }}
	</div>
</div>