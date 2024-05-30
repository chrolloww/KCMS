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

    .button-container {
      display: flex;
      justify-content: center;
      margin-top: 20px;
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
      <div id = "content">
      <div class="section" style = "width: auto;">
        <table>
          @foreach($details -> slice(0,1) as $data)       
          <tr style = "height: 100px;">
            <td style = "width: 200px;">
              <div class="image">
              @if($data->c_image == null)
              <img width= "180 px"src="collabimages/not_found.jpg" alt="">

              @else
              <img width= "180 px"src="collabimages/{{$data->c_image}}" alt="">
              @endif
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
                  @if($data->c_status == 'TERMINATE')
                  <span class="text-sm text-grey" style = "font-size: 15px;">Terminated</span>

                  @else
                  <span class="text-sm text-grey" style = "font-size: 15px;">{{$data -> c_benefit}}</span>
                  @endif
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
        @if($data->a_activity_name!= null)
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
        @endif
        @endforeach
        </table>

      </div>
      </div>
      <button type="button" class="btn btn-success btn-lg rounded-circle position-fixed" style="bottom: 70px; right: 50px;" data-toggle="modal" data-target="#activityModal">
        <i class="fas fa-plus"></i>
      </button>

      @foreach($details as $data)
      <div class="modal fade" id="activityModal" tabindex="-1" role="dialog" aria-labelledby="activityModal" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="uploadModalLabel">Add Activity</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('file.store', $data -> d_collaboration_name) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="">Choose File</label>
                            <input type="name" name="file" class="form-control-file" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Upload</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @endforeach

      <<div class="button-container">
        <button id="downloadPdf" class="btn btn-secondary">Download</button>
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

  <script>
    document.getElementById('downloadPdf').addEventListener('click', function () {
      const { jsPDF } = window.jspdf;
      const content = document.getElementById('content');

      if (content) {
        html2canvas(content, { scale: 2 }).then(canvas => {
            const imgData = canvas.toDataURL('image/png');
            const pdf = new jsPDF('p', 'mm', 'a4');
            const imgProps = pdf.getImageProperties(imgData);
            const pdfWidth = pdf.internal.pageSize.getWidth();
            const pdfHeight = (imgProps.height * pdfWidth) / imgProps.width;

            pdf.addImage(imgData, 'PNG', 0, 0, pdfWidth, pdfHeight);
            pdf.save('collaboration_details.pdf');
        }).catch(err => {
            console.error('Error capturing content:', err);
          });
      } 
      else {
        console.error('Content element not found');
      }
    });
  </script>

  @include('admin.script')

</body>

</html>