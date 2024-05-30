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
      text-align: center;
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
      <h1 class="page-title">Staff List</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="{{'home'}}"><i class="bi bi-house-door"></i></a></li>
          <li class="breadcrumb-item">Staff</li>
          <li class="breadcrumb-item active">List</li>
        </ol>
      </nav>
      <div id = "content">
      
      <div class="table-container">
        <table id = "staff_list_activity">
        <thead>
          <tr>
            <th>No.</th>
            <th>Staff Name</th>
            <th>Staff Email</th>
            <th>Number of Collaboration</th>
            <th> </th>
           </tr>
        </thead>

        <tbody>
            @foreach($datas as $data)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $data->s_name }}</td>
                <td>{{ $data->s_email }}</td>
                <td>{{ $data->total_collaboration }}</td>
                <td>
                    <a href="{{ route('list.view', ['id' => $data->s_staff_id]) }}">
                        <button type="button" class="btn btn-primary">view</button>
                    </a>
                </td>
            </tr>
            @endforeach
        </tbody>
        </table>
      </div>
      </div>
      <<div class="button-container">
        <button id="downloadPdf" class="btn btn-secondary">Print</button>
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