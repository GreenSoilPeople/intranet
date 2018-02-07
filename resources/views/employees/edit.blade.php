@extends('layouts/master') @section('head')
<!-- Custom styles for img upload -->
<link href="/css/upload.css" rel="stylesheet">
<link rel="stylesheet" href="/css/bootstrap-select.min.css">
<style>
    .close {
        margin: 15px;
    }

    .thumbnail {
        margin-top: 10px;
    }
</style>
@endsection

@section('body')

@include('admin/sidebar')


<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
    <h1 class="page-header">Angajat Nou</h1>
    <div class="row">
        <form class="form-horizontal" action="update" method="POST" role="form" enctype="multipart/form-data">
            {{ method_field('PUT') }} {{ csrf_field() }}


            <div class="col-sm-6 col-md-5 col-lg-4">
                <!-- left column -->

                <div class="form-group">
                    <label for="KST" class="col-sm-2 control-label">KST</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="KST" name="KST" value="{{ $employee->KST }}" placeholder="">
                    </div>
                </div>


                <div class="form-group">
                    <label for="firstname" class="col-sm-2 control-label">Prenume</label>
                    <div class="col-sm-10">
                        <input type="text" id="firstname" name="FirstName" class="form-control" value="{{ $employee->FirstName }}" required="required"
                            title="Prenume">
                    </div>
                </div>

                <div class="form-group">
                    <label for="lastname" class="col-sm-2 control-label">Nume</label>
                    <div class="col-sm-10">
                        <input type="text" id="lastname" name="LastName" class="form-control" value="{{ $employee->LastName }}" required="required">
                    </div>
                </div>

                <div class="form-group">
                    <label for="email" class="col-sm-2 control-label">Email</label>
                    <div class="col-sm-10">
                        <input type="email" name="Email" id="input1/(\w+)/\u\1/g" class="form-control" value="{{ $employee->Email }}" required="required"
                            title="">
                    </div>
                </div>

                <div class="form-group">
                    <label for="extension" class="col-sm-2 control-label">Extensie</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="extension" name="Extension" value="{{ $employee->Extension }}" placeholder="">
                    </div>
                </div>

                <div class="form-group">
                    <label for="mobile" class="col-sm-2 control-label">Mobil</label>
                    <div class="col-sm-10">
                        <input type="tel" class="form-control" id="mobile" name="Mobile" value="{{ $employee->Mobile }}" placeholder="">
                    </div>
                </div>

                <div class="form-group">
                    <label for="phone" class="col-sm-2 control-label">Fix</label>
                    <div class="col-sm-10">
                        <input type="tel" class="form-control" id="phone" name="Phone" value="{{ $employee->Phone }}" placeholder="">
                    </div>
                </div>

                <div class="form-group">
                    <label for="title" class="col-sm-2 control-label">Functie</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="title" name="Title" value="{{ $employee->Title }}" placeholder="">
                    </div>
                </div>

                <div class="form-group">
                    <label for="location" class="col-sm-2 control-label">Location</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="location" name="Location" value="{{ $employee->Location }}" placeholder="">
                    </div>
                </div>

            </div>
            <!-- left column -->

            <div class="col-sm-1 col-md-1 col-lg-1"></div>

            <div class="col-sm-4">
                <!-- right column -->
                <div class="row">
                    <div class="col-sm-12">
                        <div class="form-group">
                            <label for="department" class="col-sm-3 control-label">Departament</label>
                            <div class="col-sm-9">
                                <select id="department" name="DepartmentID" class="form-control selectpicker" data-live-search="true" value="" title="">
                                @foreach($departments as $department)
                                    <option {{ ($employee->DepartmentID == $department->id) ? 'selected' : '' }} value="{{$department->id}}" data-content="<span class='label label-info'>{{$department->Name}}</span>">{{$department->Name}}</option>
                                    @foreach ($department->children as $child)
                                        <option {{ ($employee->DepartmentID == $child->id) ? 'selected' : '' }} value="{{$child->id}}">{{$child->Name}}</option>
                                    @endforeach
                                    <option data-divider="true"></option>
                                @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                </div>




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
                    </div>
                    @if(!empty($employee->Photo))

                    <div class="row">
                        <div class="col-sm-9 col-sm-offset-3">
                            <button type="button" class="close" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <a class="thumbnail">
                                <img id='img-upload' src="{{asset('storage/'.$employee->Photo)}}"/>
                            </a>
                        </div>
                    </div>
                    @else
                    <div class="thumbnail" style="display: none">
                        <button type="button" class="close" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <img id='img-upload' />
                    </div>
                    @endif

                </div>

                <div class="form-group pull-right">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>

                @include('layouts.errors')

            </div>
            <!-- right column -->


        </form>
    </div>
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

        $('.close').click(function () {
            $('#img-upload').attr('src', null);
            $('#Photo').val('');
            $('#fileName').val('');
            $(this).closest('div').hide();
        });
    });

</script>
@endsection