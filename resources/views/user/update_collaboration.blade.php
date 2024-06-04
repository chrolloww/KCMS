<!DOCTYPE html>
<html lang="en">

<head>
  @include('user.css')
  
  <style>

    .container1 {
        display: flex;
        justify-content: center;
        align-items: center;
        width: 100%;
        padding: 20px;
    }

    .container2 {
        display: flex;
        justify-content: center;
        align-items: center;
        width: 100%;
        padding: 10px;
    }

    .form-box {
        background: #fff;
        border: 1px solid #ccc;
        border-radius: 8px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        padding: 40px;
        width: 60%;
        max-width: 800px;
    }

    .form-box h1 {
        text-align: center;
        margin-bottom: 20px;
    }

    .image-display {
        display: flex;
        justify-content: center;
        align-items: center;
        
        border-radius: 8px;
        overflow: hidden;
        margin-bottom: 20px;
    }

    .image-display img {
        width: 200px;
        height: auto;
    }

    .form-content {
        text-align: center;
        margin-bottom: 20px;
    }

    .form-content h1 {
        margin: 5px 0;
        font-size: 15
    }

    .form-group {
        margin-bottom: 20px;
        text-align: center;
    }

    .form-group label {
        display: block;
        margin-bottom: 10px;
        font-weight: bold;
    }

    .form-group select {
        width: 10%;
        padding: 10px;
        border: 1px solid #ccc;
        border-radius: 4px;
    }

    .form-actions {
        text-align: center;
    }

    textarea
        {
            width: 450px;
            height: 80px;
        }

    
</style>
</head>
<body>

<!-- Back to top button -->
    <!-- Nav -->
    <nav class="navbar navbar-expand-lg navbar-light shadow-sm">
      <div class="container">
        <a class="navbar-brand" href="#"><span class="text-primary">KICT</span> - Collaboration Management System</a>

        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupport" aria-controls="navbarSupport" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>

        <div class="" id="navbarSupport">
          <ul class="navbar-nav ml-auto">
            <li class="nav-item">
              <a class="nav-link" href="{{'/'}}">Home</a>
            </li>
            <!-- <li class="nav-item">
              <a class="nav-link" href="about.html">Collaboration</a>
            </li> -->
            <li class="nav-item">
              <a class="nav-link" href="blog.html">Announcement</a>
            </li>

            @if(Route::has('login'))

            @auth

            <li class="nav-item">
              <a class="nav-link active" href="{{'userdashboard'}}">Dashboard</a>
            </li>

            <x-app-layout>
            </x-app-layout>
            

            @else

            <li class="nav-item">
              <a class="btn btn-primary ml-lg-3" href="{{route('login')}}">Login</a>
            </li>
            <li class="nav-item">
              <a class="btn btn-primary ml-lg-3" href="{{route('register')}}">Register</a>
            </li>

            @endauth

            @endif

          </ul>
        </div> <!-- .navbar-collapse -->
      </div> <!-- .container -->
    </nav>

  </header>

  <div class="container1">
    <div class="form-box">
        <h1><strong>Update Collaboration</strong></h1>

        @foreach($datas as $data)

        @if($data->c_image == null)
        <div class="image-display">
          <img src="/collabimages/not_found.jpg" alt="Default Image">
        </div>
        
        @else
        <div class="image-display">
          <img src="/collabimages/{{$data->c_image}}" alt="Collaboration Image">
        </div>

        @endif

        <div class="form-content">
            <h1>{{$data->c_name}}</h1>
            <h1>{{$data->c_focal_person}}</h1>
            <h1>{{$data->s_email}}</h1>
            <h1>{{$data->c_type}}</h1><br>
            <h1><strong>Benefit:</strong></h1>
            <h1>{{$data->c_benefit}}</h1>
        </div>
        @endforeach

        <form action="{{url('edit_collaboration', $data->id)}}" method="post" enctype="multipart/form-data">
            @csrf
           
            <div class="form-actions">
                <h1><strong>Update Image:</strong></h1>  
                <input style="margin-right:-100px" type="file" name="c_image">
            </div>
            <br>
            <div class="form-actions">
                <input class="btn btn-success" type="submit" value="Update Collaboration">
                <button class="btn btn-secondary" type="button" onclick="cancelUpdate()">Cancel</button>
            </div>
        </form>
    </div>
</div>

  <script>
    function cancelUpdate() 
    {
        window.location.href = "{{url('cancel_update_collaboration')}}";
    }
  </script>
@include('user.script')
  <script>
    function cancelUpdate() 
    {
        window.history.back();
    }
</script>
</body>
</html>