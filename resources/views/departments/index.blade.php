@extends('layouts/master')

@section('head')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.2/css/bootstrap-select.min.css">

    <style>
        span.badge.pull-left {
            margin-right: 10px;
        }
        .dep > .list-group > .list-group-item > ul {
            margin-left: -1px;
            margin-right: -1px;
            margin-top: -11px;
            margin-bottom: -11px;
        }
        .dep > .list-group > .list-group-item > ul > li {
            padding-left: 60px;
            border-radius: 0px;
        }
        .panel-heading-inverse {
            color: #9d9d9d;
            background-color: #222;
            padding: 10px 15px;
            border-bottom: 1px solid transparent;
            border-top-left-radius: 3px;
            border-top-right-radius: 3px;
        }

    </style>
@endsection

@section('body')

@include('admin/sidebar')


    <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
        <h1 class="page-header">Departamente</h1>

        @include('layouts.errors')

        <div class="row">

            <div class="col-sm-10 col-md-8 dep">
                <ul class="list-group">

                    @foreach($departments as $department)

                    <li class="list-group-item row">
                        <div class="col-sm-1 col-md-1"><span class="badge">{{ $department->employees()->Active()->count() }}</span></div>

                        <div class="col-sm-7 col-md-7" data-id="{{ $department->id }}">{{ $department->Name }} </div>

                        <div class="col-sm-4 col-md-4">

                            <div class="btn-group pull-right" role="group" aria-label="...">

                                <button type="button" class="btn btn-default btn-xs" data-toggle="modal" data-target="#myModal"
                                data-name="{{ $department->Name }}" data-parent="-1" data-action="edit" data-id="{{ $department->id }}">
                                    <span class="glyphicon glyphicon-edit" aria-hidden="true" ></span> Edit
                                </button>

                                <a class="btn btn-danger btn-xs" href="{!! action('DepartmentController@delete', $department->id) !!}" title="Delete">
                                    <span class="glyphicon glyphicon-trash" aria-hidden="true"></span> Delete
                                </a>

                            </div>

                        </div>

                    </li>

                        @foreach($department->children as $child)

                        <li class="list-group-item row">
                            <ul ul class="list-group">
                                <li class="list-group-item row">
                                    <div class="col-sm-1 col-md-1"><span class="badge">{{ $child->employees()->Active()->count() }}</span></div>

                                    <div class="col-sm-7 col-md-7" data-id="{{ $child->id }}">{{ $child->Name }} </div>

                                    <div class="col-sm-4 col-md-4">
                                    
                                        <div class="btn-group pull-right" role="group" aria-label="...">

                                            <button type="button" class="btn btn-default btn-xs" data-toggle="modal" data-target="#myModal"
                                            data-name="{{ $child->Name }}" data-parent="{{ $department->id }}" data-action="edit" data-id="{{ $child->id }}">
                                                <span class="glyphicon glyphicon-edit" aria-hidden="true"></span> Edit
                                            </button>
                                            
                                            <a class="btn btn-danger btn-xs" href="{!! action('DepartmentController@delete', $child->id) !!}" title="Delete">
                                                <span class="glyphicon glyphicon-trash" aria-hidden="true"></span> Delete
                                            </a>

                                        </div>

                                    </div>
                                </li>
                            </ul>
                        </li>
                        @endforeach
                    @endforeach

                </ul>
            </div>

            <div class="col-md-1">
                <button type="button" class="btn btn-primary" data-action="new">Departament nou</button>
            </div>


            <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title" id="myModalLabel">Modal title</h4>
                        </div>
                        <form id="depForm" method="POST" action="">
                            {{ csrf_field() }}
                            <div class="modal-body">
                                    <div class="form-group">
                                        <label for="name">Nume</label>
                                        <input type="text" class="form-control" name="Name">
                                    </div>

                                    
                                    <div class="form-group">
                                        <label for="department">Departament</label>
                                    
                                        <select id="department" name="ParentID" class="form-control selectpicker" data-live-search="true" value="" title="">
                                                <option value="-1">-</option>
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
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                <button id="submit" type="submit" class="btn btn-primary">Save changes</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>


        </div>

    </div>
  
       
        
@endsection

@section('script')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.2/js/bootstrap-select.min.js"></script>

    <script>
    

        $('[data-action="new"]').click(function() {
            $('#myModal').modal('show')
        });

        $('#myModal').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget) // Button that triggered the modal
                
                var modal = $(this)
                var title = ''

            if(button.data('action') == 'edit') { // Edit item
                
                var name = button.data('name') // Extract info from data-* attributes
                var dep = button.data('parent')
                var id = button.data('id')

                // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
                // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.

                title = 'Edit ' + name

                modal.find('.modal-body input').val(name)
                $('.selectpicker').selectpicker('val', dep)

                $('#depForm').attr('action', '/department/' + id + '/update')
            
            } else { // New item

                title = 'Departament nou'

                modal.find('.modal-body input').val('')
                $('.selectpicker').selectpicker('val', '')

                $('#depForm').attr('action', '/department/store')
            }
                modal.find('.modal-title').text(title)
        });

    </script>
@endsection