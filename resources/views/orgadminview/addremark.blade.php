@extends('layouts.orgpatapp') 
@section('content')
<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>BioTectiveDRC</title>
  <link rel="shortcut icon" type="image/png" href="../assets/images/logos/SmallBioTectiveLogo.png" />
  <link rel="stylesheet" href="../assets/css/styles.mintry.css" />
</head>

<body>

      <!--  Header End -->
      <div class="container-fluid">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title fw-semibold mb-4">Add New Remark</h5>
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
                    <form method="POST" action="{{ route('patients.remark.submits') }}" enctype="multipart/form-data">
 
    @csrf

    <div class="row">
        <div class="col-md-6 mb-3">
            <div class="input-group mb-3">
                <input type="file" class="form-control" id="remark-upload-photo" name="image">
                <span class="input-group-text" id="remark-upload-photo">Image</span>
            </div>
        </div>
        <div class="col-md-6 mb-3">
            <div class="input-group mb-3">
                <input class="form-control" type="file" id="remark-upload-file" name="file">
                <span class="input-group-text" id="remark-upload-photo">File</span>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6 mb-3">
            <input type="datetime-local" class="form-control" id="remark-add-datetime" name="datetime" required>
        </div>
        <div class="col-md-6 mb-3">
            <select class="form-select" id="remark-choose-status" name="status" required>
                <option value="">Choose Status</option>
                <option value="Critical Situation">Critical Situation</option>
                <option value="Recovery">Recovery</option>
                <option value="Discharge">Discharge</option>
            </select>
        </div>
    </div>

    <div class="row">
        <div class="input-group mb-2">
            <textarea class="form-control" aria-label="With textarea" name="notes"></textarea>
        </div>
        <p><span class="text-danger text-decoration-none">*</span> Notes: Remark will not be able to view by the patient !</p>
    </div>

    <button type="submit" class="btn btn-primary me-2">Submit</button>

    <a href="{{ route('remark') }}" class="btn btn-secondary me-2">Cancel</a>
</form>

                
          </div>
        </div>
      </div>
   
 
</body>

</html>
@endsection 