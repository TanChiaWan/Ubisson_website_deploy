@extends('layouts.app') 
@section('content')
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Import User</title>
    <meta charset="utf-8">
    <meta name="description" content="create">
    <meta name="author" content="Kong">
    <meta name="keywords" content="Organization">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
</head>
<body>
    <div class="container-fluid">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title fw-semibold mb-4">Import User</h5>
                @if (session('error'))
    <div class="alert alert-danger">
        <strong>Whoops!</strong> There were some problems with your input.<br><br>
        @foreach (explode('<br>', session('error')) as $error)
            {{ $error }}<br>
        @endforeach
    </div>
@endif
              
                <form action="{{ route('import') }}" method="POST" enctype="multipart/form-data">
        @csrf
                <div style="display: flex; flex-direction: column; align-items: center;">
                    <label for="file" style="display: block; background-color: #f5f5f5; padding: 8px 12px; border: 1px solid #ddd; cursor: pointer; text-align: center;">Choose File</label>
                    <input type="file" name="file" id="file" style="display: none;">
                    <span id="file-name" style="display: block; margin-top: 8px; text-align: center;">No file selected</span>
               <br>
               <br>
               <br>
                <button type="submit" class="btn btn-primary" style="margin-top: 16px;">Import Data</button>
                </div>
</form>
            </div>
        </div>
    </div>

    <script defer>
        document.addEventListener('DOMContentLoaded', function() {
            const fileInput = document.getElementById('file');
            const fileNameDisplay = document.getElementById('file-name');
            fileInput.addEventListener('change', (e) => {
                const selectedFile = e.target.files[0];
                if (selectedFile) {
                    fileNameDisplay.textContent = selectedFile.name;
                } else {
                    fileNameDisplay.textContent = 'No file selected';
                }
            });
        });
    </script>
</body>
</html>

@endsection 