@extends('layouts/master')

@section('head')
  
@endsection

@section('body')

@include('admin/sidebar')

        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
          <h1 class="page-header">Lista Angajati</h1>

          <div class="row placeholders">
              @include('layouts.search')
          </div>
          {{-- <h2 class="sub-header">Section title</h2> --}}
          <div class="table-responsive">
            <table class="table emp_list">
              <thead>
                <tr>
                    <th>KST</th>
                    <th>Nume</th>
                    <th>Extensie</th>
                    <th>Mobil</th>
                    <th>Fix</th>
                    <th>Fax</th>
                    <th>Departament</th>
                    <th>Functie</th>
                    <th>Locatie</th>
                    <th>Plecat</th>
                    <th></th>
                </tr>
              </thead>
              <tbody>
              {{-- {{dd($results)}} --}}
                @if(!empty($results))
                     @foreach($results as $result)
                    <tr class="{{ !empty($result->Plecat) ? 'danger' : 'success' }}">
                        <td>{{$result->KST}}</td>
                        <td>{{$result->FirstName}} {{$result->LastName}}</td>
                        <td>{{$result->Extension}}</td>
                        <td>{{$result->Mobile}}</td>
                        <td>{{$result->Phone}}</td>
                        <td>{{$result->Fax}}</td>
                        <td>{{$result->Name}}</td>
                        <td>{{$result->Title}}</td>    
                        <td>{{$result->Location}}</td>
                        <td>{{$result->Plecat}}</td>     
                        <td style="min-width:95px">
                          <div class="btn-group" role="group" aria-label="...">
                            <a class="btn btn-default" href="{!! action('EmployeeController@edit', $result->UID) !!}" title="Edit">
                              <span class="glyphicon glyphicon-pencil"></span>
                            </a>

                            <a data-action="disable" class="btn btn-default" href="{!! action('EmployeeController@toggleStatus', $result->UID) !!}" title="Disable">
                              <span class="glyphicon glyphicon-off"></span>
                            </a>

                            {{-- <a data-action="delete" class="btn btn-danger" href="{!! action('EmployeeController@delete', $result->UID) !!}" title="Delete">
                              <span class="glyphicon glyphicon-trash"></span>
                            </a> --}}
                          </div>
                        </td>
                    </tr>
                    @endforeach
                @endif
               
              </tbody>
            </table>
          </div>
          <div class="text-center">
            <nav aria-label="Page navigation">
            
            @if(request()->active != null)
                {{$results->appends(['active' => request()->active])->links()}}
            @else
                {{$results->links()}}
            @endif

            </nav>
          </div>
        </div>

       
        
@endsection

@section('script')
        <script>
            $("[data-action]").click(function(){
              return confirm("Do you want to delete this item?");
            });

            $('#pag').change(function() {
              document.forms['searchForm'].submit();
            });
            
        </script>
@endsection