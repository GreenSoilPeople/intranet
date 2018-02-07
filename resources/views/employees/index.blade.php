@extends('layouts/master')

@section('head')
    <style>
      .popover {
        display: inline-block;
        height: 290px;
      }
     
    </style>
@endsection

@section('body')

@include('layouts/sidebar')

        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
          {{-- <h1 class="page-header">Angajati</h1> --}}

          <div class="row placeholders">
              @include('layouts.search')
          </div>
          
          @if(!empty($results) && $results->total() > 0)

          {{-- <div>Rezultate: <span>{{\App\Employee::Search(Session('search'))->Active()->count()}}</span></div> --}}

          <hr>
          {{-- <h2 class="sub-header">Section title</h2> --}}
          <div class="table-responsive">
            <table class="table emp_list">
              <thead>
                <tr>
                    <th>Nume</th>
                    <th>KST</th>
                    <th>Extensie</th>
                    <th>Mobil</th>
                    <th>Fix</th>
                    <th>Fax</th>
                    <th>Departament</th>
                    <th>Functie</th>
                    <th>Locatie</th>
                </tr>
              </thead>
              <tbody>
                
                  @foreach($results as $result)
                    <tr>
                        <td>
                          <a href="mailto:{{$result->Email}}" tabindex="0" class="btn btn-sm btn-default" rel="popover" data-toggle="popover"
                          data-trigger="focus" data-img="/photo/{{$result->UID}}" data-email="{{$result->Email}}">
                          <span class="glyphicon glyphicon-envelope"></span> {{$result->FullName}}</a>
                        </td>
                        <td>{{$result->KST}}</td>
                        <td>{{$result->Extension}}</td>
                        <td>{{$result->Mobile}}</td>
                        <td>{{$result->Phone}}</td>
                        <td>{{$result->Fax}}</td>
                        <td>{{$result->Name}}</td>
                        <td>{{$result->Title}}</td>    
                        <td>{{$result->Location}}</td>
                    </tr>
                  @endforeach
                
              </tbody>
            </table>
          </div>
          <div class="text-center">
            <nav aria-label="Page navigation">
              {{$results->links()}}
            </nav>
          </div>
                @endif
        </div>
        

@endsection

@section('script')

    <script>

     

      $('a[rel=popover]').popover({
        html: true,
        trigger: 'hover',
        placement: 'right',
        content: function(){
                    var content = '<img src="'+ $(this).data('img') +'" />';
                    return content;
          }
      });

        $('#pag').change(function() {
            document.forms['searchForm'].submit();
        });

    </script>
 
@endsection