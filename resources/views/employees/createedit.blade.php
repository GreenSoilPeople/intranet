@extends('layouts\master')

@section('head')
    <!-- Custom styles for img upload -->
    <link href="/css/upload.css" rel="stylesheet">
    <link rel="stylesheet" href="/css/bootstrap-select.min.css">
@endsection

@section('body')
    @include('admin\sidebar')

    <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
		
		@if(isset($employee))
        <h1 class="page-header">Modificare Angajat</h1>
			{{ Form::model($employee, ['url' => 'employee/' . $employee->UID . '/update', 'class' => 'form-horizontal', 'method' => 'patch', 'enctype' =>'multipart/form-data']) }}
		@else
        <h1 class="page-header">Angajat Nou</h1>
			{{ Form::open(['url' => 'employee/store', 'class' => 'form-horizontal', 'method' => 'put', 'enctype' =>'multipart/form-data']) }}
		@endif
        @include('layouts.errors')
        
            {{-- {{ Form::token()}} --}}

		<div class="row">

			<div class="col-sm-6 col-md-4 col-lg-4">
				{{ Form::bsText('KST', 'KST') }}
				{{ Form::bsText('FirstName','Prenume') }}
				{{ Form::bsText('LastName', 'Nume') }}
				{{ Form::bsText('Email', 'Email') }}
				{{ Form::bsText('Extension', 'Extensie') }}
				{{ Form::bsText('Mobile', 'Mobil') }}
				{{ Form::bsText('Phone', 'Fix') }}
				{{ Form::bsText('Title', 'Functie') }}
				{{ Form::bsText('Location', 'Locatie') }}
				{{-- More fields... --}}
			</div>

            <div class="col-sm-1 col-md-1 col-lg-1"></div>


			<div class="col-sm-6 col-md-4 col-lg-4">

                <div class="row">
                        <div class="form-group">
                            <label for="department" class="col-sm-3 control-label">Departament</label>
                            <div class="col-sm-9">
                                <select id="department" name="DepartmentID" class="form-control selectpicker" data-live-search="true" title="Departament...">
                                    @foreach($departments as $department)
                                        <option {{ (!empty($employee) && $employee->DepartmentID == $department->id) ? 'selected' : '' }} value="{{$department->id}}" data-content="<span class='label label-info'>{{$department->Name}}</span>">{{$department->Name}}</option>
                                        @foreach ($department->children as $child)
                                                <option {{ (!empty($employee) &&  $employee->DepartmentID == $child->id) ? 'selected' : '' }} value="{{$child->id}}">{{$child->Name}}</option>
                                        @endforeach
                                        <option data-divider="true"></option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                </div>
                



                <div class="row">
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Poza</label>
                        <div class="col-sm-9">
                            <div class="input-group">
                                <span class="input-group-btn">
                                    <span class="btn btn-default btn-file">
                                        Browse… <input type="file" id="Photo" name="Photo" accept=".jpg,.jpeg,.png,.gif, image/*">
                                    </span>
                                </span>
                                <input type="text" id="fileName" class="form-control" readonly>
                            </div>

                            @if(!empty($employee->Photo))

                            <div id="tn" class="thumbnail">
                                {{-- <button type="button" data-target="#tn" class="close" ><span aria-hidden="true">&times;</span></button> --}}
                                {{-- <img id='img-upload' src="{{asset('storage/'.$employee->Photo)}}"/> --}}
                                <img id='img-upload' src="/photo/{{$employee->UID}}"/>
                            </div>

                            @else

                            <div id="tn" class="thumbnail" style="display: none">
                                {{-- <button type="button" data-target="#tn" class="close"><span aria-hidden="true">&times;</span></button> --}}
                                <img id='img-upload' />
                            </div>

                            @endif
                        </div>


                    </div>
                </div>

                <div class="form-group pull-right">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>

			</div>

		</div>
		{{-- <div class="row">
			{{ Form::submit('Save', ['name' => 'submit']) }}
		</div> --}}
        
		{{ Form::close() }}
       

    </div>


    
    

@endsection



@section('script')
<script src="/js/bootstrap-select.min.js"></script>
<script>
    $(document).ready(function () {

        $(document).on('change', '.btn-file :file', function () {
            var input = $(this),
                label = input.val().replace(/\\/g, '/').replace(/.*\//, '');
            input.trigger('fileselect', [label]);
        });

        $('.btn-file :file').on('fileselect', function (event, label) {

            var input = $(this).parents('.input-group').find(':text'),
                log = label;

            if (input.length) {
                input.val(log);
            } else {
                if (log) alert(log);
            }

        });
        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('#img-upload').attr('src', e.target.result);
                }

                reader.readAsDataURL(input.files[0]);
            }
        }

        $("#Photo").change(function () {
            readURL(this);
            $('.thumbnail').show();
        });

        $('[data-target="#tn"]').click(function() {
            $('#tn').hide();
        });

        //$('#tn').on('closed.bs.alert', function () {
        //    $(this).closest('input').val('');
        //})
    });

</script>
@endsection