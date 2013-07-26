// Load the Visualization API and the piechart package.
google.load('visualization', '1.0', {'packages':['corechart']});

// Set a callback to run when the Google Visualization API is loaded.
var chart_div_width = Math.round($(window).width() * 0.32);
var chart_div_height = chart_div_width * 0.7;

$(window).resize(function() {
    var chart_div_width = Math.round($(window).width() * 0.32);
    var chart_div_height = chart_div_width * 0.7;
    drawPie(chart_div_width, chart_div_height);
});

google.setOnLoadCallback(function() {
    drawPie(chart_div_width, chart_div_height);
});
// Callback that creates and populates a data table, 
// instantiates the pie chart, passes in the data and
// draws it.
function drawPie(width, height) {
    // Create the data table.
    var data = new google.visualization.DataTable();
    data.addColumn('string', 'Name');
    data.addColumn('number', 'Usage');
    data.addRows(disk_data);

    // Set chart options
    var options = {'title':'Disk Usage',
                    'width': width,
                    'height': height
                    };

    // Instantiate and draw our chart, passing in some options.
    var chart = new google.visualization.PieChart(document.getElementById('chart_div'));
    chart.draw(data, options);
}
