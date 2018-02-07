@extends('layouts/master')

@section('head')

@endsection

@section('body')

@include('layouts/sidebar')

    <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
        <h1 class="page-header">Avizier</h1>
        <span class="flaticon-ppt">moloz</span>
        <i class="flaticon-after-effects"></i>
        <div id="jstree"></div>

        {{-- @if(!empty($dirs))

        <div class="tree">
            @foreach($dirs->getTree() as $item)
                <a href="{{asset($item)}}">{{$item}}<a/><br>
            @endforeach
        </div>


        @endif --}}

  
       
        


@endsection

@section('script')

<script type="text/javascript" src="/js/jstree.min.js"></script>
<link rel="stylesheet" href="/js/themes/default/style.css" />



<script type="text/javascript" src="http://www.shieldui.com/shared/components/latest/js/shieldui-all.min.js"></script>
<script type="text/javascript">
    

        $('#jstree').jstree({
            'core': {
                "themes" : {
                    "variant" : "large",
                    'dots': false
                    },
                'data': {
                    type: "GET",
                    cache: true,
                    url: '/docs/data',
                    contentType: 'application/json; charset=utf-8',
                    dataType: 'json',
                    success: function (node) {
                        return { "id": node.id };
                    },
                    error: function (msg) {
                        alert("Error: " + msg.responseText);
                    },
                    data : function (node) {
                        return { 'id' : node.id };
                    }
                }
            }
        });

    

    $('#jstree').on("changed.jstree", function (e, data) {
        
        if (!data.instance.is_parent(data.node)) {
            //console.log(data.selected);
            var href = data.node.a_attr.href
            window.open(href)
        }
        data.instance.toggle_node(data.node);
    });

    $('#tree').on('select_node.jstree', function (e, data) {
        data.instance.toggle_node(data.node);
    });




</script>
<link rel="stylesheet" type="text/css"  href="/css/tree.css" />
<link rel="stylesheet" type="text/css" href="/css/flaticon.css" /> 
@endsection