var types=[
{
id:0,
"name":"commercial-air-conditioning",
"tt":["Evaporative Cooling","Thermal Solar","Ice storage","Absorption"],
"application":["Building cooling","District cooling","Hotel"]
},
{
id:1,
"name":"industrial-air-conditioning",
"tt":["Ice storage","Absorption","Thermal Solar"],
"application":["Building cooling","District cooling","Hotel","Data centre","Production Facility"]
},
{
id:2,
"name":"domestic-air-conditioning",
"tt":["Ducted","Portable","Single Split"],
"application":["Space Cooling"]
},
{
  id:3,
  "name":"transport-air-conditioning",
  "tt":["Heat pump","MAC","Compressor"],
  "application":["Passenger vehicle","Bus","Train","Trailer","Ship"],
},
{
  id:4,
  "name":"domestic-heat-pumps",
  "tt":["Air-to-air","Air-to-water","Water Source","Ground Source","Exhaust","Portable"],
  "application":["Space Heating","Hot Water Production","Space Cooling","Vending Machine"],
},
{
  id:5,
  "name":"commercial-industrial-heat-pumps",
  "tt":["Air-to-air","Air-to-water","Water Source","Ground Source","Exhaust"],
  "application":["District Heating","District Cooling","Space Heating","Space Cooling","Production Facility","Heat Recovery"],
},
{
  id:6,
  "name":"commercial-refrigeration",
  "tt":["Chiller","Water Cooler","Display Cabinet","Cascade","Heat Pump","Condensing Unit","Bottle Cooler","Vaccine Cooler","Centralised System","Ice Maker"],
  "application":["Retail","Hospitality","Vending Machine","Cold Storage","Medical Storage","Distribution Centre"]
},
{
  id:7,
  "name":"industrial-refrigeration",
  "tt":["Chiller","Cascade","Air Cycle"],
  "application":["Retail","Cold Storage","Distribution Centre","Production Facility","Medical Storage","Cryotherapy","Ice Rink"]
},
{
  id:8,
  "name":"domestic-refrigeration",
  "tt":["Fridge","Freezer","Fridge-Freezer"],
  "application":["Cold Storage"]
},
{
  id:9,
  "name":"mobile-refrigeration",
  "tt":["Cascade","Cryotech","Plate Freezer"],
  "application":["Ship","Trailer","Reefer","Marine Container"]
}
];

  function concatArrays(a,b) {
    let c=a.concat(b);
    return c;
  }

  jQuery(document).ready(function($) {

    $.validator.setDefaults({  debug: true,
      success: "valid"
    });

    $("#form1").validate();

    $('#type').on('change', function() {
      let selez = $('#type').val();

      $('#tt').empty();
      $('#application').empty();

      var arrayTT=[];
      var arrayApp=[];


      selez.map((s)=> {
        arrayTT=concatArrays(arrayTT,types[s].tt);
        arrayApp=concatArrays(arrayApp,types[s].application);
      //  settori.push(types[s].name);
      });

      var uniqueTT = arrayTT.filter(function(item, pos) {
          return arrayTT.indexOf(item) == pos;
      })
      var uniqueApp = arrayApp.filter(function(item, pos) {
          return arrayApp.indexOf(item) == pos;
      })

      var tt_options="";
      var app_options="";



      uniqueTT.map((element, index) => {
        tt_options+="<div class=''><input class='ttCheck' id='tt"+index+"' type='checkbox' name='techs' value='"+element+"'><label class='' for='tt"+index+"'> &nbsp;"+element+"</label></div>";
        })
      uniqueApp.map((element, index) => {
        app_options+="<div class=''><input class='appCheck' id='app"+index+"' type='checkbox' name='applications' value='"+element+"'><label class='' for='app"+index+"'> &nbsp;"+element+"</label></div>";
      })


      $('#tt').append(tt_options);
      $('#ttHelp').empty().append("You can add other technology types separated by comma");
      $('#applicationHelp').empty().append("You can add other applications separated by comma");
      $('#ttAdd').removeClass("d-none");
      $('#appAdd').removeClass("d-none");
      $('#application').append(app_options);


    });

    $('#send_element').click(function() {      // When arrow is clicked

      let applicazioni = [];
      $("input:checkbox[name=applications]:checked").each(function(){
          applicazioni.push($(this).val());
        });
      let tt = [];
      $("input:checkbox[name=techs]:checked").each(function(){
          tt.push($(this).val());
        });

      let countries = [];
      $("input:checkbox[name=country]:checked").each(function(){
          countries.push($(this).val());
      });
      console.log("countries");
      console.log(countries);

      let selez = $('#type').val();

      var settori = [];

      selez.map((s)=> {
        console.log(types[s].name);
        settori.push(types[s].name);
      });

      console.log("settori");
      console.log(settori);

      if($("#form1").valid()){
        var searchApps = $('input.appCheck:checked').map(function(){
          return $(this).val();});
          console.log(searchApps.get());




          var searchTTs = $('input.ttCheck:checked').map(function(){
          return $(this).val();});
          console.log(searchTTs.get());



      //    console.log($("#manufacturer").val());
      //    console.log($("#refrigerant").val());
      //    console.log($("#country").val());


        $.ajax({
            type: 'POST',
            url: ajax_url,
            data: {
                equipment:$("#equipment").val(),
                email:$("#email").val(),
                description:$("#description").val(),
                manufacturer: $("#manufacturer").val(),
                refrigerant: $("#refrigerant").val(),
                country: countries,
                application: applicazioni,
                website: $("#website").val(),
                sector:settori,
                tt:tt,
                ee:$("#ee").val(),
                action: 'sendElements',
            },
            success: function(data, textStatus, XMLHttpRequest) {
                var len = data.length;
                data = data.substring(0, len - 1);
                // alert("aaaaaa");
                console.log(data);
              //  alert("aaa");
                // console.log("aggiungo da script.js");
            //    $(".infinite-loading").hide();
            //    var obj = jQuery.parseJSON(data);
            //    $("#results").empty();

          //      console.log(obj.post);
                if(!data) {
                  alert("not data");
                } else {
                  alert("data"+data);
                }

            },
            error: function(MLHttpRequest, textStatus, errorThrown) {
                //        alert(errorThrown);
            }
        });



      } else {
        alert("non valid");
      }


        });

  });
