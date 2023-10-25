@extends('layouts.app') 
@section('content')
<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Practice Group</title>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        
  
    

    </head>

    
    <body>
 
                      
    <div class="container-fluid">
    @if (count($errors) > 0)
                        <div class="alert alert-danger">
                            <strong>Whoops!</strong> There were some problems with your input.<br><br>
                            <ul>
                                @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                        @endif
        <div class="card">
          <div class="card-body">
            <h5 class="card-title fw-semibold mb-4">Add New Practice Group</h5>
              
            {!! Form::open(array('route' => 'insert4.createpracticegroup','method'=>'POST')) !!}
                <legend class="form-fieldset-title">General</legend>
                <div class="row">
                    <label class="form-label">Group Title</label>
                    <div class="col-md-6 mb-3">
                    {!! Form::text('name', null, array('class' => 'form-control', 'placeholder' => 'Enter Title')) !!}
                    </div>
                    <div class="col-md-6 mb-3">
                    {!! Form::text('subTitle', null, array('class' => 'form-control', 'placeholder' => 'Enter Subtitle (Optional)')) !!}
                    </div>
                </div>
               
                <button type="submit" class="btn btn-primary mx-2">Submit</button>
                <a href="{{ route('practicegroup') }}" class="btn btn-secondary mx-2">Cancel</a>
                {!! Form::close() !!}
          </div>
        </div>
      </div>
                
                                 
    </body>
 
</html>
@endsection 