
var PLUGIN = require('plugin/plugin');
var CONSOLE = require('plugin/console');
var JQUERY = require('jquery/jquery').jQuery;
var JIT = require('js-infovis-toolkit/jit');

exports.main = function() {

    PLUGIN.addCss("style.css");

    CONSOLE.log("Hello World from PageControls2: " + new Date());

    // "content" is the root HTML element (body) to put markup into
    PLUGIN.getRootElement().innerHTML = [
        '<div class="links"><a href="#" id="more-data-link">Load Data</a></div>',
        '<div id="infovis"></div>'
    ].join("\n")

    var barChart;

    // wait for the DOM to draw
    PLUGIN.ready(function() {
    
        //init BarChart
        barChart = new JIT.BarChart({
          //id of the visualization container
          injectInto: 'infovis',
          //whether to add animations
          animate: true,
          //horizontal or vertical barcharts
          orientation: 'horizontal',
          //bars separation
          barsOffset: 0.5,
          //visualization offset
          Margin: {
            top: 5,
            left: 5,
            right: 5,
            bottom: 5
          },
          //labels offset position
          labelOffset:5,
          //bars style
          type:'stacked',
          //whether to show the aggregation of the values
          showAggregates:true,
          //whether to show the labels for the bars
          showLabels:true,
          //label styles
          Label: {
            type: 'Native', //Native or HTML
            size: 11,
            family: 'Arial',
            color: 'red'
          },
          //tooltip options
          Tips: {
            enable: true,
            onShow: function(tip, elem) {
              tip.innerHTML = "<b>" + elem.name + "</b>: " + elem.value;
            }
          }
        });
    
        //load JSON data.
        barChart.loadJSON(getInitialData());
    });    

    JQUERY("#more-data-link").click(function() {
    
      var json2 = {
          'values': [
          {
            'label': 'date A',
            'values': [10, 40, 15, 7]
          }, 
          {
            'label': 'date B',
            'values': [30, 40, 45, 9]
          }, 
          {
            'label': 'date D',
            'values': [55, 30, 34, 26]
          }, 
          {
            'label': 'date C',
            'values': [26, 40, 85, 28]
          }]
          
      };

      barChart.updateJSON(json2);
        
    });
}

function getInitialData() {

  return {
      'label': ['label A', 'label B', 'label C', 'label D'],
      'values': [
          {
            'label': 'date A',
            'values': [20, 40, 15, 5]
          }, 
          {
            'label': 'date B',
            'values': [30, 10, 45, 10]
          }, 
          {
            'label': 'date E',
            'values': [38, 20, 35, 17]
          }
      ]
  };

}
