<!DOCTYPE html>
<html lang="en">

<head>
  @include('user.css')
  <style>

        .div_deg
        {
            display: flex;
            justify-content: center;
            align-items: center;
            /* margin-top: 10px; */
        }

        label
        {
            display: inline-block;
            width: 200px;
            padding: 20px;
        }

        input[type='text']
        {
            width: 300px;
            height: 60px;
        }

        textarea
        {
            width: 450px;
            height: 80px;
        }

        .collab_image 
        {
          width: 100px;
          height: 100px;
          /* object-fit: cover; Ensures the image remains square and covers the area */
        }

        .image_cell, .button_cell 
        {
          text-align: center;
          vertical-align: middle;
        }

		.container1 
		{
    		display: flex;
    		justify-content: center;
    		align-items: center;
    		width: 100%;
    		padding: 20px;
		}

		.form-box 
		{
    		background: white;
    		border: 1px solid #ccc;
    		border-radius: 8px;
    		box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    		padding: 20px;
    		width: 60%;
		}

		.form-group input[readonly] 
		{
    		background-color: #e9ecef;
    		color: #6c757d;
    		cursor: not-allowed;
		}

		.image-display
		{
			width: 200px;
        	height: 200px;
			justify-content: center; /* Centers the image horizontally */
    		align-items: center; /* Centers the image vertically */
    		border: 1px solid black; /* Optional: for visual confirmation of the container */
		}

</style>
</head>
<body>

  <!-- Back to top button -->
  <div class="back-to-top"></div>

  <header>
    <div class="topbar">
      <div class="container">
        <div class="row">
          <div class="col-sm-8 text-sm">
            <div class="site-info">
              <a href="#"><span class="mai-call text-primary"></span> +00 123 4455 6666</a>
              <span class="divider">|</span>
              <a href="#"><span class="mai-mail text-primary"></span> mail@example.com</a>
            </div>
          </div>
          <div class="col-sm-4 text-right text-sm">
            <div class="social-mini-button">
              <a href="#"><span class="mai-logo-facebook-f"></span></a>
              <a href="#"><span class="mai-logo-twitter"></span></a>
              <a href="#"><span class="mai-logo-dribbble"></span></a>
              <a href="#"><span class="mai-logo-instagram"></span></a>
            </div>
          </div>
        </div> <!-- .row -->
      </div> <!-- .container -->
    </div> <!-- .topbar -->

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
            <li class="nav-item">
              <a class="nav-link" href="about.html">Collaboration</a>
            </li>
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
  	<h1 style="text-align: center"><strong>Update Collaboration</strong></h1>

            <div class="div_deg">
                <form action="{{url('edit_collaboration',$data->id)}}" method="post" enctype="multipart/form-data">
                    @csrf
					<div class="image-display">
						<image src="/collabimages/{{$data->c_image}}">
					</div>
					<br><br><br>
					<h1>{{$data->c_name}}</h1>
					<h1>{{$data->c_focal_person}}</h1>
					<h1>{{$data->s_phone_number}}</h1>
					<br><br><br>

                    <div>
                        <label>Category</label>
                        <select name="c_type">
                            <option value="{{$data->c_type}}">{{$data->c_type}}</option>                           
                            <option value="MoA">MoA</option>
							<option value="MoU">MoU</option>      
                        </select> 
                    </div>

                    <div>
                        <label>Current Image</label>
                        <image width="150" src="">
                    </div>

                    <div>
                        <label>New Image</label>
                        <input type="file" name="image">
                    </div>

                    <div>
                        <input class="btn btn-success" type="submit" value="Update Collaboration">
						<!-- <a class="btn btn-secondary" href="{{url('cancel_update_collaboration')}}">Cancel</a> -->
						<button class="btn btn-secondary" type="button" onclick="cancelUpdate()">Cancel</button>
                    </div>
                </form>
            </div>

	</div>
	</div>

@include('user.script')
<script>
    function cancelUpdate() {
        window.history.back();
    }
</script>
</body>
</html>