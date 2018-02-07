@extends('layouts\master')

@section('head')
    <!-- Custom styles for img upload -->
    <link href="/css/upload.css" rel="stylesheet">
    <link rel="stylesheet" href="/css/bootstrap-select.min.css">
@endsection

@section('body')
    @include('admin\sidebar')

    <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
        <h1 class="page-header">Angajat Nou</h1>

        
        <form class="form-horizontal" action="employee/store" method="POST" role="form">
            {{ csrf_field() }}
            <div class="col-lg-5">

                <div class="form-group">
                    <label for="KST">KST</label>
                    <input type="text" class="form-control" id="KST" name="kst" placeholder="">
                </div>
                
                
                <div class="form-group">
                    <label for="firstname">Prenume</label>
                    <input type="text" name="firstname" id="firstname" name="firstname" class="form-control" value="" required="required" title="Prenume">
                </div>
                
                 <div class="form-group">
                    <label for="lastname">Nume</label>
                    <input type="text" name="lastname" id="lastname" name="lastname" class="form-control" value="" required="required">
                </div>

                <div class="form-group">
                    <label for="extension">Extensie</label>
                    <input type="text" class="form-control" id="extension" name="extension" placeholder="">
                </div>

                <div class="form-group">
                    <label for="mobile">Mobil</label>
                    <input type="text" class="form-control" id="mobile" name="mobile" placeholder="">
                </div>

                <div class="form-group">
                    <label for="phone">Fix</label>
                    <input type="text" class="form-control" id="phone" name="phone" placeholder="">
                </div>

                

               

            </div>

            <div class="col-lg-1"></div>

            <div class="col-lg-5">
                <div class="row">
                        <div class="form-group">
                            <label for="department">Departament</label>
                            <select id="department" name="department" class="form-control selectpicker" data-live-search="true" title="Departament...">
                                @foreach($departments as $department)
                                    <option value="{{$department->id}}" data-content="<span class='label label-info'>{{$department->Name}}</span>">{{$department->Name}}</option>
                                    @foreach ($department->children as $child)
                                            <option value="{{$child->id}}">{{$child->Name}}</option>
                                    @endforeach
                                    <option data-divider="true"></option>
                                @endforeach
                            </select>
                        </div>
                </div>
                
                <div class="form-group">
                    <label for="title">Functie</label>
                    <input type="text" class="form-control" id="title" name="title" placeholder="">
                </div>
                
                <div class="form-group">
                    <label for="location">Locatie</label>
                    <input type="text" class="form-control" id="location" name="location" placeholder="">
                </div>

                <div class="form-group">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </div>
               

        </form>

    </div>


    
    

@endsection



@section('script')
    <script src="/js/bootstrap-select.min.js"></script>
    <script>
    
        $(document).ready( function() {
                        
            $(document).on('change', '.btn-file :file', function() {
            var input = $(this),
                label = input.val().replace(/\\/g, '/').replace(/.*\//, '');
            input.trigger('fileselect', [label]);
            });

            $('.btn-file :file').on('fileselect', function(event, label) {
                
                var input = $(this).parents('.input-group').find(':text'),
                    log = label;
                
                if( input.length ) {
                    input.val(log);
                } else {
                    if( log ) alert(log);
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

            $("#Photo").change(function(){
                readURL(this);
                $('.thumbnail').show();
            });

            $('.close').click(function() {
                $('#img-upload').attr('src', null);
                $('#Photo').val('');
                $('#fileName').val('');
                $('.thumbnail').hide();
            });
        });
    </script>
@endsection