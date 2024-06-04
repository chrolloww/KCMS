<!DOCTYPE html>
<html lang="en">

<head>
  <style>
    .table-container {
      width: 100%;
      height: 400px;
      overflow-y: auto;
      overflow-x: auto;
    }

    .section {
      padding: 20px;
      margin-bottom: 20px;
      background-color: #F6F8FB;
    }

    .table-container table {
      width: 100%;
      border-collapse: collapse;
    }

    .table-container thead {
      position: sticky;
      top: 0;
      background-color: #f8f9fa;
      padding: 17px;
    }

    .table-container th, .table-container td {
      padding: 15px;
      text-align: left;
      border-bottom: 1px solid #ddd;
    }
  </style>
    @include('admin.css')

</head>

<body>

  <!-- ======= Header ======= -->
  @include('admin.navbar')
  <!-- End Header -->

  <!-- ======= Sidebar ======= -->
  @include('admin.sidebar')
  <!-- End Sidebar-->

  <!-- ======= Main ======= -->
  <main id="main" class="main">
  <div class="content-wrapper">
    <div class="pagetitle">
      <h1 class="page-title">Collaboration Details</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="{{'home'}}"><i class="bi bi-house-door"></i></a></li>
          <li class="breadcrumb-item"><a href="#">Collaboration</a></li>
          <li class="breadcrumb-item active">Details</li>
        </ol>
      </nav>

      <div class="section" style = "width: auto;">
        <table>
          @foreach($details -> slice(0,1) as $data)          
          <tr style = "height: 100px;">
            <td style = "width: 350px;">
              <div class="image">
              <img width= "300 px"src="collabimages/{{$data->c_image}}" alt="">

              <form action="{{ route('file.terminate', [$data->c_name]) }}" method="POST" onsubmit="return confirm('Are you sure you want to terminate this collaboration?');">
              @csrf
              <button type="submit" class="btn btn-danger">TERMINATE</button>
            </form>
              </div>
            </td>

            <td style = "width: 750px;">
              <table>
                <tr style = "height: 15px; bold">
                  <div class="name">
                    <h2><strong>{{$data-> c_name}}</strong></h2>
                  </div>
                </tr>
                
                <tr>
                  <td>
                    <span class="text-sm text-grey" style = "font-size: 15px;">{{$data-> s_name}}</span>
                  </td>
          
                  <td>
                    <span class="text-sm text-grey" style = "font-size: 15px;">({{$data -> s_email}})</span>
                  </td>
                </tr>

                <tr>
                  <td style = "width: auto;">
                  @if($data->c_type == 'LoI')
                  <span class="text-sm text-grey" style = "font-size: 15px;">Letter of Intent (LoI)</span>

                  @elseif($data->c_type == 'MoA')
                  <span class="text-sm text-grey" style = "font-size: 15px;">Memorandum of Agreement (MoA)</span>

                  @else
                  <span class="text-sm text-grey" style = "font-size: 15px;">Memorandum of Understanding (MoU)</span>
                  @endif
                  </td>
                </tr>

                <tr>
                  <td> 
                  <span class="text-sm text-grey" style = "font-size: 15px;">{{$data -> c_benefit}}</span>
                  </td>
                </tr>
              </table>
            </td>

            <td style = "width: 150px;">
              <table>
                <tr style = "height: 15px; bold">
                  <div class="name">
                    <table>
                      <tr>
                      @if($data->duration_left > 360)
                        @php
                          $duration = intval($data->duration_left / 360);
                        @endphp
                        <td>
                        <p style="color: green; font-size: 60px;"><strong>{{$duration}}</strong></p>
                        </td>
                        <td>
                          <p style="color: green;"><strong>yr</strong></p>
                        </td>
                      </tr>
                    </table>

                    
                    <table>
                      <tr>
                      @elseif($data->duration_left > 30)
                        @php
                          $duration = intval($data->duration_left / 30);
                        @endphp
                        <td>
                          @if($duration > 6)
                          <p style="color: green; font-size: 60px;"><strong>{{$duration}}</strong></p>
                        </td>
                        <td>
                            <p style="color: green;"><strong>mth</strong></p>
                        </td>
                            @else
                            <p style="color: red; font-size: 60px;"><strong>{{$duration}}</strong></p>
                        </td>
                        <td>
                            <p style="color: red;"><strong>mth</strong></p>
                            @endif
                        </td>
                      </tr>
                    </table>

                    <table>
                      <tr>
                      @else
                        <td>
                        <p style="color: yello; font-size: 60px;"><strong>{{$data->duration_left}}</strong></p>
                        </td>
                        <td>
                          <p style="color: red;"><strong>day</strong></p>
                        </td>
                      </tr>
                    </table>

                    @endif
                  </div>
                </tr>
                
                <tr>
                  <td style = "width: auto;">
                  <p style = "font-size: 15px;"><strong>Start Date: {{ \Carbon\Carbon::parse($data->c_start_date)->format('F j, Y') }}</strong></p>
                </tr>

                <tr>
                <td style = "width: 150px;">
                  <p style = "font-size: 15px;"><strong>End Date: {{ \Carbon\Carbon::parse($data->c_end_date)->format('F j, Y') }}</strong></p>
                  </td>
                </tr>

                <tr>
                  <td>
                    <p><a href="{{ route('file.details', ['name' => $data->c_name]) }}">view document</a></p>
                  </td>
                </tr>
              </table>
            </td> 
          </tr>

          <tr>
            
          </tr>
          @endforeach
        </table>
      </div>

      <div class="table-container">
        <table id = "table_list_activity">
        <thead>
          <tr>
            <th>Date</th>
              <th>Activity Name</th>
              <th>Description</th>
              <th>Person-in-charge (PIC)</th>
              </tr>
          </thead>

        @foreach($details as $data)
        <tbody>
          <tr>
            <td>
            {{ \Carbon\Carbon::parse($data->created_at)->format('j F Y') }}

            </td>

            <td>
            {{$data -> a_activity_name}}
            </td>

            <td>
            {{$data -> a_activity_description}}
            </td>

            <td>
            {{$data -> a_activity_description}}
            </td>
          </tr>
        </tbody>

        @endforeach
        </table>

      </div>

      
    </div>
  </div>
  </main>
  <!-- End #main -->

  <!-- ======= Footer ======= -->
  <footer id="footer" class="footer">
    <div class="copyright">
      &copy; Copyright <strong><span>NiceAdmin</span></strong>. All Rights Reserved
    </div>
    <div class="credits">
      <!-- All the links in the footer should remain intact. -->
      <!-- You can delete the links only if you purchased the pro version. -->
      <!-- Licensing information: https://bootstrapmade.com/license/ -->
      <!-- Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/ -->
      Designed by <a href="https://bootstrapmade.com/">BootstrapMade</a>
    </div>
  </footer><!-- End Footer -->

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->

  @include('admin.script')

</body>

</html>