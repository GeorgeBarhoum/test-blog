@extends('layouts.app')

@section('main-content')

@section('headSection')

<link rel="stylesheet" type="text/css" href="{{ asset('plugins/datatables/dataTables.bootstrap.css') }}">

@endsection()

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      @include('admin.layouts.pageHead')
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Examples</a></li>
        <li class="active">Blank page</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="box">
        <div class="box-header with-border">
          <h3 class="box-title">Title</h3>

          <!--$user->role->permission()instead of this for restrict in users you have to use Gates in laravel documentation provided-->

          @can('articles.create',Auth::user())


          <a class="col-lg-offset-5 btn btn-success" href="{{ route('article.create') }}">Add New</a>

          @endcan

          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
              <i class="fa fa-minus"></i></button>
            <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
              <i class="fa fa-times"></i></button>
          </div>
        </div>
        <div class="box-body">
           <div class="box">
            <div class="box-header">
              <h3 class="box-title">Data Table With Full Features</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>S.No</th>
                  <th>Title</th>
                  <th>Sub Title</th>
                  <th>Slug</th>
                  <th>Created At</th>
                  @can('articles.update',Auth::user())
                  <th>Edit</th>
                  @endcan
                  
                  @can('articles.delete',Auth::user())
                  <th>Delete</th>
                  @endcan
                </tr>
                </thead>
                <tbody>

                    @foreach($articles as $article)
                    <tr>
                    <td>{{ $loop->index + 1}}</td>
                    <td>{{ $article->title }}</td>
                    <td>{{ $article->subtitle }}</td>
                    <td>{{ $article->slug }}</td>
                    <td>{{ $article->created_at }}</td>
                    @can('articles.update',Auth::user())
                      <td><!-- edit button code -->
                      <a href="{{ route('article.edit',$article->id) }}"><span class="glyphicon glyphicon-edit"></span></a></td>
                    @endcan             
                    
                    @can('articles.delete',Auth::user())            
                    <td><!-- delete button code --> 
                      <form id="delete-form-{{ $article->id }}" method="article" action="{{ route('article.destroy',$article->id) }}" style="display: none">
                      {{ csrf_field() }}
                      {{ method_field('DELETE') }}
                    </form>
                    <a href="" onclick="
                    if(confirm('Are you sure, Delete this'))
                    {
                      event.preventDefault();
                      document.getElementById('delete-form-{{ $article->id }}').submit();
                    }
                      else{
                        event.preventDefault();
                      }"><span class="glyphicon glyphicon-trash"></span></a></td>

                      @endcan
                    </tr>
                    @endforeach
             
        
                </tbody>
                <tfoot>
                <tr>
                  <th>S.No</th>
                  <th>Title</th>
                  <th>Slug</th>
                  <th>Created At</th>
                  @can('articles.update',Auth::user())
                  <th>Edit</th>
                  @endcan
                  
                  @can('articles.delete',Auth::user())
                  <th>Delete</th>
                  @endcan
                </tr>
                </tr>
                </tfoot>
              </table>
            </div>
            <!-- /.box-body -->
          </div>
        </div>
        <!-- /.box-body -->
        <div class="box-footer">
          Footer
        </div>
        <!-- /.box-footer-->
      </div>
      <!-- /.box -->

    </section>
    <!-- /.content -->
  </div>
@endsection()

@section('footerSection')
<script src="{{ asset('plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('plugins/datatables/dataTables.bootstrap.min.js') }}"></script>
<script>
  $(function () {
    $("#example1").DataTable();
  });
</script>
@endsection()