<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

<script type="text/javascript">
  google.charts.load('current', {'packages':['corechart']});
  google.charts.setOnLoadCallback(drawChart);

  function drawChart() {
    var data = google.visualization.arrayToDataTable([
      ['Year', 'Total Signed'],
      <?php echo $data;?>
    ]);

    var options = {
      title: 'Signed Collaborations For The past 5 years',
      curveType: 'none',
      legend: { position: 'bottom' },
      hAxis: { format: '0' } // Add this line
    };

    var chart = new google.visualization.LineChart(document.getElementById('curve_chart'));

    chart.draw(data, options);
  }
</script>
<div id="curve_chart" style="width: 800px; height: 500px"></div>

