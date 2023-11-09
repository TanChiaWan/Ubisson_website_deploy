@extends('layouts.orgapp') 
@section('content')
<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Edit Patient Glucose Target</title>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        
       

    </head>
   
    <body>
    <div class="container-fluid">
        <div class="card">
            <div class="card-body">
              <h5 class="card-title fw-semibold mb-4">Update Glucose Target</h5>

              <form action="{{ route('healthdata.updateorg') }}" method="POST">
              @csrf      
              <div class="row">
                        <div class="col-md-6 mb-3">
                          <label for="patient-update-glucosetarget-beforecomsumptionlb" class="form-label">Before Comsumption LB</label>
                          <div class="input-group mb-3">
                            <input type="number" class="form-control" name="patient-update-glucosetarget-beforecomsumptionlb" aria-describedby="patient-beforecomsumptionlb-addon" step="0.01" value="{{ $patient->targetBG_low_BC }}" required>
                            <span class="input-group-text" name="patient-beforecomsumptionlb-addon">mmol/L</span>
                          </div>
                        </div>
                        <div class="col-md-6 mb-3">
                          <label for="patient-update-glucosetarget-beforecomsumptionub" class="form-label">Before Comsumption UB</label>
                          <div class="input-group mb-3">
                            <input type="number" class="form-control" name="patient-update-glucosetarget-beforecomsumptionub" aria-describedby="patient-beforecomsumptionub-addon" step="0.01" value="{{ $patient->targetBG_high_BC }}" required>
                            <span class="input-group-text" name="patient-beforecomsumptionub-addon">mmol/L</span>
                          </div>
                        </div>
                        <div class="col-md-6 mb-3">
                          <label for="patient-update-glucosetarget-aftercomsumptionlb" class="form-label">After Comsumption LB</label>
                          <div class="input-group mb-3">
                            <input type="number" class="form-control" name="patient-update-glucosetarget-aftercomsumptionlb" aria-describedby="patient-aftercomsumptionlb-addon" step="0.01" value="{{ $patient->targetBG_low_AC }}" required>
                            <span class="input-group-text" name="patient-aftercomsumptionlb-addon">mmol/L</span>
                          </div>
                        </div>
                        <div class="col-md-6 mb-3">
                          <label for="patient-update-glucosetarget-aftercomsumptionub" class="form-label">After Comsumption UB</label>
                          <div class="input-group mb-3">
                            <input type="number" class="form-control" name="patient-update-glucosetarget-aftercomsumptionub" aria-describedby="patient-aftercomsumptionub-addon" step="0.01" value="{{ $patient->targetBG_high_AC }}" required>
                            <span class="input-group-text" name="patient-aftercomsumptionub-addon">mmol/L</span>
                          </div>
                        </div>
                        <div class="col-md-6 mb-3">
                          <label for="patient-update-glucosetarget-bedtimelb" class="form-label">Bedtime LB</label>
                          <div class="input-group mb-3">
                            <input type="number" class="form-control" name="patient-update-glucosetarget-bedtimelb" aria-describedby="patient-bedtimelb-addon" step="0.01" value="{{ $patient->targetBG_low_BT }}" required>
                            <span class="input-group-text" name="patient-bedtimelb-addon">mmol/L</span>
                          </div>
                        </div>
                        <div class="col-md-6 mb-3">
                          <label for="patient-update-glucosetarget-bedtimeub" class="form-label">Bedtime UB</label>
                          <div class="input-group mb-3">
                            <input type="number" class="form-control" name="patient-update-glucosetarget-bedtimeub" aria-describedby="patient-bedtimeub-addon" step="0.01" value="{{ $patient->targetBG_high_BT }}" required>
                            <span class="input-group-text" name="patient-bedtimeub-addon">mmol/L</span>
                          </div>
                        </div>
                        <div class="col-md-6 mb-3">
                          <label for="patient-update-glucosetarget-hba1c" class="form-label">HbA1c</label>
                          <div class="input-group mb-3">
                            <input type="number" class="form-control" name="patient-update-glucosetarget-hba1c" aria-describedby="patient-hba1c-addon" step="0.1" value="{{ $patient->targethba1c }}" required>
                            <span class="input-group-text" name="patient-hba1c-addon">%</span>
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