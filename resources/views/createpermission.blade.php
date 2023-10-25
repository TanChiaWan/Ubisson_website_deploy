@extends('layouts.app') 
@section('content')
<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Add Permission</title>
        <meta charset="utf-8">
        <meta name="description" content="create">
        <meta name="author" content="Kong">
        <meta name="keywords" content="Organization">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <!--CSS -->
        <link rel="stylesheet" href="../css/stylekong2.css">

        <!--Bootstrap-->
        <link href="../bootstrap/bootstrap.min.css" rel="stylesheet" />
        
        
        <!--Vue.js-->
        <script src="https://unpkg.com/vue@2"></script>
        

    </head>

    <body>
        <div class="container"> </div>
            <div class="row">
                <!--side bar-->
                <div class="col-sm-3">
                  
                </div>

                <!--content-->
                <div class="col-sm-9">
                    <div class="content2">
                        <h1>Add Permission</h1>
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="border12">
                                        <h2 class="sub">Add Permission</h2>          
                                </div>
                                        <div class="container12">
                                            <form action="{{ route('insert3.create3') }}" method="post">
                                        @csrf        
                                                <div class="form-group">
                                                    <label for="name">Name</label>

                                                    <div class="col-xm-10">
                                                        <input type="text" id="name" placeholder="Enter name" name="name" required>
                                                    </div>
                                                </div> 
                                                
                                                <div class="form-group">
                                                    <label for="category">Category</label>

                                                    <div class="col-xm-10">
                                                        <input type="text" id="permission_category" placeholder="Enter category" name="permission_category" required>
                                                    </div>
                                                </div> 
                                                <div class="row">
                                           
                                                    <div class="button2">
                                                        <button type="submit" class="add_btn2">Add</button>
                                                    </div>
                                           
                                                </div>
                                            </form>
                                        </div>
                                
                            </div>
                        </div>

                        <!--Add Button-->
                        
    
                    </div>
                </div>
            </div>
       

        <!--jQuery CDN - Slim version (=without AJAX)-->
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        
        <!--Popper.js-->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js" integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ" crossorigin="anonymous"></script>
        
        <!--Bootstrap.js-->
        <script src="../bootstrap/bootstrap.min.js"></script>
    </body>
</html>
@endsection 