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

	.form-box {
        background: #fff;
        border: 1px solid #ccc;
        border-radius: 8px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        padding: 40px;
        width: 80%;
        /* max-width: 1000px; */
    }

	.image {
    	width: 200px;
    	height: 200px;
    	border-radius: 8px;
    	overflow: hidden;
    	border: 1px solid #ccc;
    	display: inline-block;
    	box-sizing: border-box;
		flex-shrink: 0; /* Prevent the image from shrinking */
	}

	.image img {
    	width: 100%;
   		height: 100%;
    	border-radius: 8px;
    	object-fit: cover; /* Ensures the image covers the container while maintaining aspect ratio */
    	display: block;
	}
	
	.container2 {
        display: flex;
        align-items: flex-start; /* Align items to the top */
        gap: 20px; /* Space between image and text */
    }

	.text {
        max-width: 600px; /* Adjust based on your layout */
    }

    .text h1 {
        /* margin: 0 0 10px 0;  */
		/* Add some spacing between the headings */
    }

	/* Table Styles */
	.styled-table {
        width: 100%;
        border-collapse: collapse;
        margin: 20px 0;
    }

    .styled-table th,
    .styled-table td {
        border: 1px solid #dddddd;
        padding: 8px;
        text-align: left;
    }

    .styled-table th {
        background-color: #f2f2f2;
    }

    /* Table Hover Effect */
    .styled-table tbody tr:hover {
        background-color: #f5f5f5;
    }

	.center-btn {
   		display: flex;
    	justify-content: center;
	}

    
</style>
</head>
<body>

<!-- Back to top button -->
  <!-- <div class="back-to-top"></div> -->

  <header>
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
    		<h1 style="text-align: center; font-size: 30px; padding-bottom: 40px;"><strong>Add Activities</strong></h1>

			<div class="container2">
				<div class="image">
					@if(isset($data) && $data->c_image)
        			<div class="image-display">
          				<img src="/collabimages/{{$data->c_image}}" alt="Collaboration Image">
        			</div>
        			@else
        			<div class="image-display">
          				<img src="/collabimages/default-image.jpg" alt="Default Image">
        			</div>
       				@endif
				</div>

				<div class="text">
					<h1 style="font-size: 25px"><strong>{{$data->c_name}}</strong></h1>
            		<h1>{{$data->c_focal_person}}</h1>
            		<h1>{{$data->s_email}}</h1>
            		<h1>{{$data->c_type}}</h1><br>
            		<h1 style="font-size: 25px"><strong>Benefit:</strong></h1>
            		<h1>{{$data->c_benefit}}</h1>
				</div>

			</div>

			<table class="styled-table">
        		<thead>
            		<tr>
                		<th>Date</th>
                		<th>Activity Name</th>
                		<th>Description</th>
                		<th>Person-in-charge (PIC)</th>
            		</tr>
        		</thead>

        		<tbody>
            		<!-- Table rows go here -->
            		<tr>
                		<td>2024-06-01</td>
                		<td>Meeting</td>
                		<td>Discuss project progress</td>
                		<td>John Doe</td>
            		</tr>
            		<tr>
                		<td>2024-06-02</td>
                		<td>Training</td>
                		<td>Team training session</td>
                		<td>Jane Smith</td>
            		</tr>
            		<!-- Add more rows as needed -->
        		</tbody>
    		</table>

			<div class="center-btn">
				<button class="btn btn-secondary" type="button" onclick="cancelUpdate()">Cancel</button>
			</div>
    
  		</div>
	</div>

  @include('user.script')

  <script>
    function cancelUpdate() 
    {
        window.history.back();
    }
   </script>
</body>
</html>