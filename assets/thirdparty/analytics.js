//analytics.js

/**
 * @author Duncan Pierce <duncan@duncanpierce.com>
 * @created_on 4/12/2019 
 * @param {Package of chart we need. Object} chart
 * @param {Function name you need to callback to for DOM content loaded} callback 
 * @returns null
 */
function load(callback, chart){
   google.charts.load('current', chart);
   google.charts.setOnLoadCallback(callback);
}

/**
 * @author Duncan Pierce <duncan@duncanpierce.com>
 * @created_on 4/17/2019
 * @param {object} chart 
 * @param {array} data 
 * @param {object} options 
 * @param {boolean} resize 
 * @returns null
 */
function createOrResize(chart, data, options, resize) {
   if(resize){
      window.addEventListener('resize', function(){
         chart.draw(data, options);
      });
   }
   chart.draw(data, options);
}

/**
 * @author Duncan Pierce <duncan@duncanpierce.com>
 * @created_on 4/12/2019 
 * @param {2d Array - First array type is legend and annotations. Remainder is data and values} _chartData 
 * @param {String Value of the html elements ID} _targetDiv 
 * @param {JSON} _chartOptions 
 * @param {Boolean} resize
 * @example https://developers.google.com/chart/interactive/docs/gallery/piechart
 * @returns {bool}
 */
function createHistogram(_chartData, _targetDiv, _chartOptions, resize){
   if(!_chartData || !_targetDiv || !_chartOptions){return false}
   let chartData = _chartData;
   let targetDiv = _targetDiv;
   let chartOptions = _chartOptions;

   load(drawHistogram, {packages:['corechart']});
   
   function drawHistogram() {
      let data = google.visualization.arrayToDataTable(chartData);

      let view = new google.visualization.DataView(data);

      let chart = new google.visualization.Histogram(document.getElementById(targetDiv));
      createOrResize(chart, view, chartOptions, resize);
   }
}

/**
 * @author Duncan Pierce <duncan@duncanpierce.com>
 * @created_on 4/12/2019 
 * @param {2d Array - First array type is legend and annotations. Remainder is data and values} _chartData 
 * @param {String Value of the html elements ID} _targetDiv 
 * @param {JSON} _chartOptions 
 * @param {Boolean} resize
 * @example https://developers.google.com/chart/interactive/docs/gallery/piechart
 * @returns null 
 */
function createPieChart(_chartData, _targetDiv, _chartOptions, resize){
   if(!_chartData || !_targetDiv || !_chartOptions){return false}
   let chartData = _chartData;
   let targetDiv = _targetDiv;
   let chartOptions = _chartOptions;

   load(drawPieChart, {packages:['corechart']});
   
   function drawPieChart() {
      let data = google.visualization.arrayToDataTable(chartData);

      let view = new google.visualization.DataView(data);

      let chart = new google.visualization.PieChart(document.getElementById(targetDiv));
      createOrResize(chart, view, chartOptions, resize);
   }
}


/**
 * @author Duncan Pierce <duncan@duncanpierce.com>
 * @created_on 4/12/2019
 * @param {2d Array - First array type is legend and annotations. Remainder is data and values} _chartData 
 * @param {String Value of the html elements ID} _targetDiv 
 * @param {JSON} _chartOptions 
 * @param {Boolean} resize
 * @example https://developers.google.com/chart/interactive/docs/gallery/barchart
 * @returns null
 */
function createBarChart(_chartData, _targetDiv, _chartOptions, resize){
   if(!_chartData || !_targetDiv || !_chartOptions){return false}
   let chartData = _chartData;
   let targetDiv = _targetDiv;
   let chartOptions = _chartOptions;

   load(drawBarChart, {packages:['corechart']});
   
   function drawBarChart() {
      let data = google.visualization.arrayToDataTable(chartData);

      let view = new google.visualization.DataView(data);
      let chart = new google.visualization.BarChart(document.getElementById(targetDiv));
      createOrResize(chart, view, chartOptions, resize);
   }
}

/**
 * @author Duncan Pierce <duncan@duncanpierce.com>
 * @created_on 4/12/2019 
 * @param {2d Array of data, this is just the data. Columns need to be added separately} _chartData 
 * @param {2d Array of columns. Key value with data type. ['type', 'name']} _chartColumns 
 * @param {String value of the html elements ID} _targetDiv 
 * @param {JSON} _chartOptions 
 * @param {Boolean} resize
 * @example https://developers.google.com/chart/interactive/docs/gallery/timeline
 */
function createTimeline(_chartData, _chartColumns, _targetDiv, _chartOptions, resize){
   if(!_chartData || !_chartColumns || !_targetDiv || !_chartOptions){return false}
   let chartData = _chartData;
   let targetDiv = _targetDiv;
   let chartOptions = _chartOptions;
   let chartColumns = _chartColumns;

   load(drawTimeline, {packages:['timeline']});
   
   function drawTimeline() {
      let container = document.getElementById(targetDiv);

      let chart = new google.visualization.Timeline(container);

      let dataTable = new google.visualization.DataTable();
      
      chartColumns.forEach(function(col){
         dataTable.addColumn(col[0], col[1]);
      })
      dataTable.addRows(chartData);

      createOrResize(chart, view, chartOptions, resize);
   }
}

/**
 * @author Duncan Pierce <duncan@duncanpierce.com>
 * @created_on 4/12/2019 
 * @param {2d Array of data, this is just the data. Columns need to be added separately} _chartData 
 * @param {2d Array of columns. Key value with data type. ['type', 'name']} _chartColumns 
 * @param {String value of the html elements ID} _targetDiv 
 * @param {JSON} _chartOptions 
 * @param {Boolean} resize
 * @example https://developers.google.com/chart/interactive/docs/gallery/linechart
 */
function createLineChart(_chartData, _chartColumns, _targetDiv, _chartOptions, resize){
   if(!_chartData || !_chartColumns || !_targetDiv || !_chartOptions){return false}
   let chartData = _chartData;
   let targetDiv = _targetDiv;
   let chartOptions = _chartOptions;
   let chartColumns = _chartColumns;

   load(drawLineChart, {packages:['line']});
   
   function drawLineChart() {

      let dataTable = new google.visualization.DataTable();
      
      chartColumns.forEach(function(col){
         dataTable.addColumn(col[0], col[1]);
      })
      dataTable.addRows(chartData);

      let chart = new google.charts.Line(document.getElementById(targetDiv));

      createOrResize(chart, dataTable, chartOptions, resize);
   }
}



/**
 * @author Duncan Pierce <duncan@duncanpierce.com>
 * @created_on 4/12/2019 
 * @param {2d Array of data, this is just the data. Columns need to be added separately} _chartData 
 * @param {2d Array of columns. Key value with data type. ['type', 'name']} _chartColumns 
 * @param {String value of the html elements ID} _targetDiv 
 * @param {JSON} _chartOptions 
 * @param {Boolean} resize
 * @example https://developers.google.com/chart/interactive/docs/gallery/calendar
 */
function createCalendarChart(_chartData, _chartColumns, _targetDiv, _chartOptions, resize){
   if(!_chartData || !_chartColumns || !_targetDiv || !_chartOptions){return false}
   let chartData = _chartData;
   let targetDiv = _targetDiv;
   let chartOptions = _chartOptions;
   let chartColumns = _chartColumns;

   load(drawCalendarChart, {packages:['calendar']});
   
   function drawCalendarChart() {

      let dataTable = new google.visualization.DataTable();
      
      chartColumns.forEach(function(col){
         dataTable.addColumn(col[0], col[1]);
      })
      dataTable.addRows(chartData);

      let chart = new google.visualization.Calendar(document.getElementById(targetDiv));

      createOrResize(chart, dataTable, chartOptions, resize);
   }
}

