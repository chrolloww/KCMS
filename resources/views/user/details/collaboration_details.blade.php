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

  .duration {
    margin-left: auto;
    text-align: right;
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
    		<h1 style="text-align: center; font-size: 30px; padding-bottom: 40px;"><strong>Collaboration details</strong></h1>

			<div class="container2">
				<div class="image">
          @foreach($details -> slice(0,1) as $data) 
					@if($data->c_image == !null)
        			<div class="image-display">
          				<img src="/collabimages/{{$data->c_image}}" alt="Collaboration Image">
        			</div>
        			@else
        			<div class="image-display">
          				<img src="/collabimages/not_found.jpg" alt="Default Image">
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
        
        <div class="duration" style="text-align: right;">
          @if($data->duration_left > 360)
            @php
              $duration = intval($data->duration_left / 360);
            @endphp
            <h1><strong>Duration Left:</strong></h1>
            <p>
                <span style="font-size: 3em; color: green;">{{$duration}}</span>
                <span style="font-size: 0.8em; color: green;"> year</span>
            </p>

          @elseif($data->duration_left > 30)
            @php
              $duration = intval($data->duration_left / 30);
            @endphp
            @if($duration > 6)
            <h1><strong>Duration Left:</strong></h1>
            <p>
                <span style="font-size: 3em; color: green;">{{$duration}}</span>
                <span style="font-size: 1.2em; color: green;"> month</span>
            </p>

            @else
            <h1><strong>Duration Left:</strong></h1>
            <p>
                <span style="font-size: 3em; color: red;">{{$duration}}</span>
                <span style="font-size: 1.2em; color: red;"> month</span>
            </p>
            @endif

          @else($data->duration_left > 0)
          <h1><strong>Duration Left:</strong></h1>
            <p>
                <span style="font-size: 3em; color: red;">{{$data -> duration_left}}</span>
                <span style="font-size: 1.2em; color: red;"> day</span>
            </p>
          @endif
          <h2><strong>Start Date:</strong></h2>
          <p>
            <span>{{ \Carbon\Carbon::parse($data->c_start_date)->format('F d, Y') }}</span>
          </p>

          <h2><strong>End Date:</strong></h2>
          <p>
            <span>{{ \Carbon\Carbon::parse($data->c_end_date)->format('F d, Y') }}</span>
          </p>
        </div>
        @endforeach

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
                @foreach($details as $data)
            		<tr>
                		<td>{{ \Carbon\Carbon::parse($data->created_at)->format('F d, Y') }}</td>
                		<td>{{$data -> a_activity_name}}</td>
                		<td>{{$data -> a_activity_description}}</td>
                		<td>{{$data -> a_activity_PIC}}</td>
            		</tr>
                @endforeach
        		</tbody>
    		</table>

        <div class="row">
            <div class="col-6 text-left">
                <button class="btn btn-primary" type="button" onclick="cancelUpdate()">Back</button>
            </div>

            <div style="display: flex; justify-content: flex-end;">
                <button type="button" class="btn btn-success" data-toggle="modal" data-target="#addActivityModal">
                    Add Activity
                </button>
            </div>
        </div>
    
  		</div>

      <div class="modal fade" id="addActivityModal" tabindex="-1" role="dialog" aria-labelledby="addActivityModalLabel" aria-hidden="true">
          <div class="modal-dialog" role="document">
              <div class="modal-content">
                  <div class="modal-header">
                      <h5 class="modal-title" id="addActivityModalLabel">Add Activity</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                      </button>
                  </div>
                  <div class="modal-body">
                      <form action="{{ route('activities.add', $data->c_name) }}" method="POST" enctype="multipart/form-data">
                          @csrf
                          <div class="form-group">
                              <label for="a_activity_name">Activity Name</label>
                              <input type="text" class="form-control" id="a_activity_name" name="a_activity_name" placeholder="Enter activity name" required>
                          </div>
                          <div class="form-group">
                              <label for="a_activity_description">Description</label>
                              <textarea class="form-control" id="a_activity_description" name="a_activity_description" placeholder="Enter activity description" required></textarea>
                          </div>
                          <div class="form-group">
                              <label for="a_activity_PIC">Person In Charge</label>
                              <input type="text" class="form-control" id="a_activity_PIC" name="a_activity_PIC" placeholder="Enter name of person in charge" required>
                          </div>
                          <div class="form-group">
                              <label for="a_activity_date">Date</label>
                              <input type="text" class="form-control" id="a_activity_date" name="activity_date" value="{{ date('Y-m-d') }}" readonly>
                          </div>
                          <div class="modal-footer">
                              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                              <button type="submit" class="btn btn-primary">Save changes</button>
                          </div>
                      </form>
                  </div>
              </div>
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