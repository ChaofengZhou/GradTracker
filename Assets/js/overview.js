/**
 *
 *  Author: Chaofeng Zhou
 *  Date:   Spring 2016
 *
 *  Make an AJAX request for data using the new jquery
 *  
 */
$(document).ready(function() {
  $("select[name='chartOption']").on('change', function() {

    if ($(this).val() === '5') {
      $("#yearForm").show();
      $('#yearForm').on('change', function() {
        find_data();
      });
    } else {
      $("#yearForm").hide();
    }
  });
});

function find_data() {
  var chartOption = 1;
  $.ajax({
      type: 'POST',
      url: "fetch_data.php",
      data: $('#chartForm').serialize(),
      dataType: "json",
      beforeSend: function() {
        chartOption = $('#chartList').val();
        yearOption = $('#yearList').val();
      }

    })
    .done(function(data) {
      if (chartOption == 1) {
        var gpaChart = new Highcharts.Chart({
          chart: {
            type: 'bar',
            renderTo: 'chart'
          },
          title: {
            text: 'Current GPAs of All Students',
          },
          xAxis: {
            title: {
              text: 'Student Name'
            },
            categories: data.name,
          },
          yAxis: {
            min: 0,
            title: {
              text: 'GPA'
            },

            plotLines: [{
              value: 0,
              width: 1,
              color: '#808080'
            }]
          },
          legend: {
            layout: 'vertical',
            align: 'right',
            verticalAlign: 'middle',
            borderWidth: 0
          }
        });
        gpaChart.addSeries({
          name: "GPA",
          data: data.data
        });
      } else if (chartOption == 2) {
        data1 = [
          ['Signed', 6],
          ['Unsigned', 34]
        ];
        $.each(data, function(i, point) {
          point.y = point.data;
        });
        var formSignedChart = new Highcharts.Chart({
          chart: {
            type: 'pie',
            renderTo: 'chart'
          },
          title: {
            text: 'Progress Form Completion and Signed Info'
          },
          plotOptions: {
            pie: {
              allowPointSelect: true,
              cursor: 'pointer'
            }
          },
          series: [{
            type: 'pie',
            name: 'Number',
            center: [150, null],
            size: 200,
            dataLabels: {
              enabled: false
            },
            data: data
          }, {
            type: 'pie',
            name: 'Number',
            center: [400, null],
            size: 200,
            dataLabels: {
              enabled: false
            },
            data: data1
          }]
        });

      } else if (chartOption == 3) {
        var advisorChart = new Highcharts.Chart({
          chart: {
            type: 'column',
            renderTo: 'chart'
          },
          title: {
            text: 'Number of Ph.D. Students per Faculty',
          },
          xAxis: {
            title: {
              text: 'Faculty'
            },
            categories: data.name,
          },
          yAxis: {
            min: 0,
            title: {
              text: 'Number of Students'
            },
            plotLines: [{
              value: 0,
              width: 1,
              color: '#808080'
            }]
          },
          legend: {
            layout: 'vertical',
            align: 'right',
            verticalAlign: 'middle',
            borderWidth: 0
          }
        });

        advisorChart.addSeries({
          name: "Number",
          data: data.data
        });
      } else if (chartOption == 4) {
        var advisorChart = new Highcharts.Chart({
          chart: {
            type: 'line',
            renderTo: 'chart'
          },
          title: {
            text: 'Number of Committees Each Faculty Sits on',
          },
          xAxis: {
            title: {
              text: 'Faculty'
            },
            categories: data.name,
          },
          yAxis: {
            min: 0,
            title: {
              text: 'Number of Committees'
            },
            plotLines: [{
              value: 0,
              width: 1,
              color: '#808080'
            }]
          },
          legend: {
            layout: 'vertical',
            align: 'right',
            verticalAlign: 'middle',
            borderWidth: 0
          }
        });

        advisorChart.addSeries({
          name: "Number",
          data: data.data
        });
      } else if (chartOption == 5) {
        var advisorChart = new Highcharts.Chart({
          chart: {
            type: 'column',
            renderTo: 'chart'
          },
          title: {
            text: 'Number of graduating Ph.D. students for the given year',
          },
          xAxis: {
            title: {
              text: 'Year'
            },
            categories: data.name,
          },
          yAxis: {
            min: 0,
            title: {
              text: 'Number of Students Graduating'
            },
            plotLines: [{
              value: 0,
              width: 1,
              color: '#808080'
            }]
          },
          legend: {
            layout: 'vertical',
            align: 'right',
            verticalAlign: 'middle',
            borderWidth: 0
          }
        });

        advisorChart.addSeries({
          name: "Number",
          data: data.data
        });
      } else if (chartOption == 6) {
        $.each(data, function(i, point) {
          point.y = point.data;
        });
        var formSignedChart = new Highcharts.Chart({
          chart: {
            type: 'pie',
            renderTo: 'chart'
          },
          title: {
            text: 'Number of students ahead of, on and behind schedule'
          },
          plotOptions: {
            pie: {
              allowPointSelect: true,
              cursor: 'pointer'
            }
          },
          series: [{
            name: 'Number',
            data: data
          }, {
            name: 'Number',
            data: data
          }]
        });
      }

    })
    .fail(function(text, options, err) {
      console.log('Error message: ' + text);
      console.log('Error message: ' + options);
      console.log('Error message: ' + err);
    });
  // return false;
}
