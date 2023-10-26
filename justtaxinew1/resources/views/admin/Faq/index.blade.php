@extends('admin.layout.base')

@section('title', 'Faq ')

@section('content')
<div class="content-area py-1">
    <div class="container-fluid">
        <div class="box box-block bg-white">
           @if(Setting::get('demo_mode') == 1)
        <div class="col-md-12" style="height:50px;color:red;">
                    ** Demo Mode : No Permission to Edit and Delete.
                </div>
                @endif 
            <h5 class="mb-1">Faq List</h5>
            <a href="{{ route('admin.faq.create') }}" style="margin-left: 1em;" class="btn btn-primary pull-right"><i class="fa fa-plus"></i> Add New Faq</a>
            <table class="table table-striped table-bordered dataTable" id="table-2">
                <thead>
                    <tr>
                        <th>ID</th>
                        <!-- <th>Category</th> -->
                        <th>Question</th>
                        <th>Answer</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                @foreach($faqs as $index => $faq)
                    <tr class="row">
                        <td >{{$index + 1}}</td>
                        <!-- <td >
                            <?php  $explode = (!empty($faq->category_id) ) ? $faq->category_id : array() ;  ?>
                            {{$explode}}
                        </td> -->
                        <td >{{$faq->question}}</td>
                        <td >{{$faq->answer}}</td>
                        <td>
                            <form action="{{ route('admin.faq.destroy', $faq->id) }}" method="POST">
                                {{ csrf_field() }}
                                {{ method_field('DELETE') }}
                                @if( Setting::get('demo_mode') == 0)
                                <a href="{{ route('admin.faq.edit', $faq->id) }}" class="btn btn-info btn-block">
                                    <i class="fa fa-pencil"></i> Edit
                                </a>
                                <button class="btn btn-danger btn-block" onclick="return confirm('Are you sure?')">
                                    <i class="fa fa-trash"></i> Delete
                                </button>
                                @endif
                            </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
                <tfoot>
                     <tr>
                        <th>ID</th>
                        <!-- <th>Category</th> -->
                        <th>Question</th>
                        <th>Answer</th>
                        <th>Actions</th>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
</div>
@endsection