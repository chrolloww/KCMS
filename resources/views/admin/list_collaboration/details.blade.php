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
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="{{'home'}}"><i class="bi bi-house-door"></i></a></li>
          <li class="breadcrumb-item"><a href="#">Collaboration</a></li>
          <li class="breadcrumb-item active">Details</li>
        </ol>
      </nav>
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
                </tr>

                <tr>
                  <td>
                    <span class="text-sm text-grey" style = "font-size: 15px;">({{$data -> s_email}})</span>
                  </td>
                </tr>

                <tr>
                  <td style = "width: auto;">
                  @if($data->c_status == 'TERMINATE')
                  <span class="text-sm text-grey" style = "font-size: 15px; color: red;"><strong>TERMINATED</strong></span>

                  @elseif($data->c_type == 'LoI')
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
                  <span class="text-sm text-grey" style = "font-size: 15px;">{{$data -> c_description}}</span>

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
                      <span class="text-sm text-grey" style = "font-size: 15px;">Remaining Time:</span>
                      </tr>
                      <tr>
                      @if($data->duration_left > 360)
                        @php
                          $duration = intval($data->duration_left / 360);
                        @endphp
                        <td>
                        <p style="color: green; font-size: 60px;"><strong>{{$duration}}</strong></p>
                        </td>
                        <td>
                          <p style="color: green; margin-left: 10px;"><strong>year</strong></p>
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
                            <p style="color: green; margin-left: 10px;"><strong>mth</strong></p>
                        </td>
                            @else
                            <p style="color: red; font-size: 60px;"><strong>{{$duration}}</strong></p>
                        </td>
                        <td>
                            <p style="color: red; margin-left: 10px;"><strong>month</strong></p>
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
                          <p style="color: red; margin-left: 10px;"><strong>day</strong></p>
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
            {{$data -> a_activity_PIC}}
            </td>
          </tr>
        </tbody>
        @endif
        @endforeach
        </table>

      </div>   
      
    @if($data->c_status != 'TERMINATE')
    <div class="d-flex justify-content-between align-items-center">
        <form action="{{ route('file.terminate', [$data->c_name]) }}" method="POST" onsubmit="return confirm('Are you sure you want to terminate this collaboration?');">
          @csrf
          <button type="submit" class="btn btn-danger" data-toggle='modal' data-target="#deleteModal" style="width: 110px; height: 40px; font-size: 15px; align-self: flex-start;" >TERMINATE</button>
        </form>
    @endif

        <button id="downloadPdf" class="btn btn-secondary" style="width: 110px; height: 40px; font-size: 15px; align-self: flex-end;">Print</button>
      </div>
  </div>
  </main>
  <!-- End #main -->

  <!-- ======= Footer ======= -->
  <footer id="footer" class="footer">
    <div class="copyright">
      &copy; Copyright <strong><span>KICT_IIUM</span></strong>. All Rights Reserved
    </div>
  </footer><!-- End Footer -->

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->

  <script>
    var details = <?php echo json_encode($details); ?>;

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

                // Prepare table data
                const tableColumn = ["Date", "Activity Name", "Description", "Person-in-charge (PIC)"];
                const tableRows = details.map(item => [
                  moment(item.created_at).format('DD/MM/YYYY'),
                    item.a_activity_name,
                    item.a_activity_description,
                    item.a_activity_PIC
                ]);

                // Calculate the starting point for the table
                let startY = pdfHeight + 20; // Adding space after the image

                // Check if the table will fit on the current page, otherwise add a new page
                if (startY + (tableRows.length * 10) > pdf.internal.pageSize.getHeight() - 10) {
                    pdf.addPage();
                    startY = 20; // Reset startY to the top of the new page
                }

                // Adding table to the PDF
                pdf.autoTable({
                    startY: startY,
                    head: [tableColumn],
                    body: tableRows
                });

                pdf.save('collaboration_details.pdf');
            }).catch(err => {
                console.error('Error capturing content:', err);
            });
        } else {
            console.error('Content element not found');
        }
    });
  </script>

  @include('admin.script')

</body>

</html>