@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    <form action="{{ url('file/save') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                      <div class="form-group">
                        <label for="exampleFormControlFile1">Example file input</label>
                        <input type="file" name='path' class="form-control-file" id="exampleFormControlFile1">
                      </div>
                      <div class="form-group">
                        <input type="submit" value="Upload" class="btn btn-primary">
                      </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection