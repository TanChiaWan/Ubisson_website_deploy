@extends('layouts.orgapp') 
@section('content')
<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Edit Patient Comsumptions Target Range</title>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        
    
    

    </head>

    <body>
    <div class="container-fluid">
        <div class="card">
            <div class="card-body">
              <h5 class="card-title fw-semibold mb-4">Update Target Range</h5>

              <form action="{{ route('healthdata.update2org') }}" method="POST">
              @csrf      
              <div class="row">
                        <div class="col-md-6 mb-3">
                          <label for="patient-update-targetrange-mincarbs" class="form-label">Min Carbs</label>
                          <div class="input-group mb-3">
                            <input type="number" class="form-control" name="patient-update-targetrange-mincarbs" aria-describedby="patient-mincarbs-addon" step="0.1" value="{{ $patient->mincarb }}" required>
                            <span class="input-group-text" name="patient-mincarbs-addon">g</span>
                          </div>
                        </div>
                        <div class="col-md-6 mb-3">
                          <label for="patient-update-targetrange-maxcarbs" class="form-label">Max Carbs</label>
                          <div class="input-group mb-3">
                            <input type="number" class="form-control" name="patient-update-targetrange-maxcarbs" aria-describedby="patient-maxcarbs-addon" step="0.1" value="{{ $patient->maxcarb }}" required>
                            <span class="input-group-text" name="patient-maxcarbs-addon">g</span>
                          </div>
                        </div>
                        <div class="col-md-6 mb-3">
                          <label for="patient-update-targetrange-minweight" class="form-label">Min Weight</label>
                          <div class="input-group mb-3">
                            <input type="number" class="form-control" name="patient-update-targetrange-minweight" aria-describedby="patient-minweight-addon" step="0.1" value="{{ $patient->minweight }}" required>
                            <span class="input-group-text" name="patient-minweight-addon">kg</span>
                          </div>
                        </div>
                        <div class="col-md-6 mb-3">
                          <label for="patient-update-targetrange-maxweight" class="form-label">Max Weight</label>
                          <div class="input-group mb-3">
                            <input type="number" class="form-control" name="patient-update-targetrange-maxweight" aria-describedby="patient-maxweight-addon" step="0.1" value="{{ $patient->maxweight }}" required>
                            <span class="input-group-text" name="patient-maxweight-addon">kg</span>
                          </div>
                        </div>
                        <div class="col-md-6 mb-3">
                          <label for="patient-update-targetrange-minbmi" class="form-label">Min BMI</label>
                          <div class="input-group mb-3">
                            <input type="number" class="form-control" name="patient-update-targetrange-minbmi" aria-describedby="patient-minbmi-addon" step="0.01" value="{{ $patient->minbmi }}" required>
                            <span class="input-group-text" name="patient-minbmi-addon">kg/m2</span>
                          </div>
                        </div>
                        <div class="col-md-6 mb-3">
                          <label for="patient-update-targetrange-maxbmi" class="form-label">Max BMI</label>
                          <div class="input-group mb-3">
                            <input type="number" class="form-control" name="patient-update-targetrange-maxbmi" aria-describedby="patient-maxbmi-addon" step="0.01" value="{{ $patient->maxbmi }}" required>
                            <span class="input-group-text" name="patient-maxbmi-addon">kg/m2</span>
                          </div>
                        </div>
                        <div class="col-md-6 mb-3">
                          <label for="patient-update-targetrange-totalactivity" class="form-label">Total Activity</label>
                          <div class="input-group mb-3">
                            <input type="number" class="form-control" name="patient-update-targetrange-totalactivity" aria-describedby="patient-totalactivity-addon" step="0.1" value="{{ $patient->totalactivity }}" required>
                            <span class="input-group-text" name="patient-totalactivity-addon">min</span>
                          </div>
                        </div>
                    </div>
                    <button type="update" class="btn btn-primary my-2">Update</button>
                    <a href="{{ route('aboutpatient', ['patientId' => $patient->patient_id]) }}" class="btn btn-secondary mx-2">Cancel</a>
                </form>
            </div>
        </div>
      </div>

    </body>
</html>
@endsection 