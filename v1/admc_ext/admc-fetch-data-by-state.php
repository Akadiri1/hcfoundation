<?php
// ob_start();
// session_start();
// $map = true;
include 'include/ext_auth.php';
include 'include/ext_header.php';


// define("DBNAME", "mckodevc_demo");
//  define("DBUSER", "root");
//  define("DBPASS", getenv('DB_PASSWORD'));

        try{

          $conn = new PDO('mysql:host=localhost;dbname='.DBNAME, DBUSER, DBPASS);

          $conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
        }
        catch(PDOException $e) {
                // die("Something Went Wrong: Configure a database with mckodevc_demo ");
                echo $e->getMessage();
        }

        try{
          $pledge_conn = new PDO('mysql:host=3.14.222.149:3306;dbname='.DBNAME2, DBUSER2, DBPASS2);
          $pledge_conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
            
        }
        catch(PDOException $e) {
                // die("Something Went Wrong: Configure a database with mckodevc_demo ");
                echo $e->getMessage();
        }


	if (isset($_GET['state'])) {
    $state = $_GET['state'];
  }


?>
<script src="/assets/js/controller2.js"></script>


<style media="screen">

/* @media only screen and (max-width: 600px) { */
  .dataTables_paginate .paging_simple_numbers{
    margin-top:50px;
  }
/* } */
</style>

<link rel="stylesheet" href="//cdn.datatables.net/1.12.1/css/common.css">
<link rel="stylesheet" href="//cdn.datatables.net/1.12.1/css/common.min.css">
<link rel="stylesheet" href="//cdn.datatables.net/1.12.1/css/dataTables.bootstrap.css">
<link rel="stylesheet" href="//cdn.datatables.net/1.12.1/css/dataTables.bootstrap.min.css"/>
<link rel="stylesheet" href="//cdn.datatables.net/1.12.1/css/dataTables.bootstrap4.css">
<link rel="stylesheet" href="//cdn.datatables.net/1.12.1/css/dataTables.bootstrap4.min.css"/>
<link rel="stylesheet" href="//cdn.datatables.net/1.12.1/css/dataTables.bootstrap5.css">
<link rel="stylesheet" href="//cdn.datatables.net/1.12.1/css/dataTables.bootstrap5.min.css"/>
<link rel="stylesheet" href="//cdn.datatables.net/1.12.1/css/dataTables.bulma.css">
<link rel="stylesheet" href="//cdn.datatables.net/1.12.1/css/dataTables.bulma.min.css">
<link rel="stylesheet" href="//cdn.datatables.net/1.12.1/css/dataTables.foundation.css">
<link rel="stylesheet" href="//cdn.datatables.net/1.12.1/css/dataTables.foundation.min.css"/>
<link rel="stylesheet" href="//cdn.datatables.net/1.12.1/css/dataTables.jqueryui.css">
<link rel="stylesheet" href="//cdn.datatables.net/1.12.1/css/dataTables.jqueryui.min.css">
<link rel="stylesheet" href="//cdn.datatables.net/1.12.1/css/dataTables.material.css">
<link rel="stylesheet" href="//cdn.datatables.net/1.12.1/css/dataTables.material.min.css">
<link rel="stylesheet" href="//cdn.datatables.net/1.12.1/css/dataTables.semanticui.css"/>
<link rel="stylesheet" href="//cdn.datatables.net/1.12.1/css/dataTables.semanticui.min.css"/>
<link rel="stylesheet" href="//cdn.datatables.net/1.12.1/css/dataTables.uikit.css"/>
<link rel="stylesheet" href="//cdn.datatables.net/1.12.1/css/dataTables.uikit.min.css"/>
<link rel="stylesheet" href="//cdn.datatables.net/1.12.1/css/jquery.dataTables.css"/>
<link rel="stylesheet" href="//cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css"/>

<link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.3.0/css/responsive.dataTables.min.css"/>
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.2.3/css/buttons.dataTables.min.css"/>




<link rel="stylesheet" href="//cdn.datatables.net/1.12.1/css/jquery.dataTables_themeroller.css"/>
<link rel="stylesheet" href="//cdn.datatables.net/1.12.1/css/ordering.css"/>
<link rel="stylesheet" href="//cdn.datatables.net/1.12.1/css/processing.css"/>
<link rel="stylesheet" href="//cdn.datatables.net/1.12.1/css/typography.css"/>
<link rel="stylesheet" href="style.css" />
<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.css" />
  <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/datatables/1.10.12/css/dataTables.bootstrap.min.css" />
  <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.1.0/css/responsive.bootstrap.min.css" type="text/css" />
  <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.2.1/css/buttons.bootstrap.min.css" type="text/css" />

<!-- <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.css" />
  <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/datatables/1.10.12/css/dataTables.bootstrap.min.css" />
  <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.1.0/css/responsive.bootstrap.min.css" type="text/css" />
  <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.2.1/css/buttons.bootstrap.min.css" type="text/css" />
  <link rel="stylesheet" href="style.css" />

   <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script type="text/javascript" charset="utf8" src="//cdn.datatables.net/1.10.15/js/jquery.dataTables.js"></script>
    <script src="https://cdn.datatables.net/plug-ins/1.10.15/api/row().show().js"></script> -->

<div class="cleafix">
<br>

</div>
<div class="container">

  <div class="row">

    <div class="col-md-12 mx-auto">
          <div class="row">
            <div class="col-md-12">
              <div class="card bg-c-blue order-card">
                <div class="card-body">
                  <h6 class="m-b-20 text-white">Total Pledge From <span id="state-name"><?=ucwords($state ?? "All States")?></span></h6>
                  <h2 class="text-left text-white"><span id="total-user">Compiling Data... <i class="fa fa-spinner fa-pulse"></i></span><i class="fas fa-link float-right text-white"></i></h2>
                  <!-- <p class="m-b-0 text-right">Facilities</p> -->
                </div>
              </div>
            </div>


            <div class="col-md-12">

              <div class="row">
                <div class="container">
                  <div class="col-sm-12 col-md-6 col-lg-4">
                    <select class="form-control" id="locationSelect">
                      <option disabled selected>Select State</option>
                    </select>
                  </div>

                  <div class="col-sm-12 col-md-6 col-lg-4">
                    <input class="form-control" type="date" name="" id="start-date">
                  </div>
                  <div class="col-sm-12 col-md-6 col-lg-4">
                    <input class="form-control" type="date" name="" id="stop-date">
                  </div>
                  <div class="col-sm-12 col-md-6 col-lg-4">
                    <button class="btn btn-success" onclick="searchFunc()">Search</button>
                  </div>
                </div>
              </div>


            	<table id="myDataTable" class="datatable table table-hover table-bordered">
				      <thead>
				        <tr>
				          <th>ID</th>
                  <th>Email</th>
				          <th>Name</th>
				          <th>Gender</th>
                  <th>Age Range</th>
                  <th>State</th>
                  <th>LGA</th>
                  <th>Phone Number</th>
                  <th>Ref ID</th>
                  <th>Pledge Date </th>
                  <th>Pledge Time </th>
				        </tr>
				      </thead>
				      <tfoot>
				        <tr>
                  <th>ID</th>
                  <th>Email</th>
				          <th>Name</th>
				          <th>Gender</th>
                  <th>Age Range</th>
                  <th>State</th>
                  <th>LGA</th>
                  <th>Phone Number</th>
                  <th>Ref ID</th>
                  <th>Pledge Date </th>
                  <th>Pledge Time </th>
				        </tr>
				      </tfoot>
				      <tbody id="queryTableBody">
				        <tr>
				          <td style="text-align:center" colspan="10">Loading <i class="fa fa-spinner fa-pulse"></i></td>
				        </tr>
				      </tbody>
				    </table>
				  </div>
            <!-- <div class="col-md-12">
              <div class="card bg-c-white order-card">
                <div class="card-body">
                  <h6>Check Pledges</h6>
                        <h6 class="m-b-20  text-center"> <a href="/analysis"> All States (With Pledges)</a> </h6>

                      <h6 class="m-b-20 text-dark  text-center"> or </h6>

  <h6 class="m-b-20  text-center"> <a href="/analysis?focal=true">Campaign States</a> </h6>
                  <h6 class="m-b-20 text-dark  text-center"> or </h6>

                  <form class="" action="" method="get">
                  <input class="form-control" type="text" name="state" placeholder="Find by State" value="">
                  <br>
                    <input class="btn btn-primary btn-sm" type="submit" name="submit" value="Find">

                  </form>

                  <p class="m-b-0 text-right">Facilities</p>
                </div>
              </div>
            </div> -->






    </div>
    </div>




</div>







</div>





<script src="/da/assets/js/vendor-all.min.js"></script>
<script src="/da/assets/plugins/bootstrap/js/bootstrap.min.js"></script>
<script src="/da/assets/js/pcoded.min.js"></script>

<!-- prism Js -->
<script src="/da/assets/plugins/prism/js/prism.min.js"></script>
<script src="/da/assets/js/horizontal-menu.js"></script>
<script type="text/javascript">



// Collapse menu

</script>
<script type="text/javascript">


window.addEventListener("load", function(){
  viewer.load('viewerDiv', '/map/untitled.xml', '/map/untitled.offline.xml.js', '', {x:0, y:0, zoom:40, controls:'none'});
  // console.log("Done");
});



// layout types
$('.layout-type > a').on('click', function() {
  var temp = $(this).attr('data-value');
  $('.layout-type > a').removeClass('active');
  $('.pcoded-navbar').removeClassPrefix('navbar-image-');
  $(this).addClass('active');
  $('head').append('<link rel="stylesheet" class="layout-css" href="">');
  if (temp == "menu-dark") {
    $('.pcoded-navbar').removeClassPrefix('menu-');
    $('.pcoded-navbar').removeClass('navbar-dark');
  }
  if (temp == "menu-light") {
    $('.pcoded-navbar').removeClassPrefix('menu-');
    $('.pcoded-navbar').removeClass('navbar-dark');
    $('.pcoded-navbar').addClass(temp);
  }
  if (temp == "reset") {
    location.reload();
  }
  if (temp == "dark") {
    $('.pcoded-navbar').removeClassPrefix('menu-');
    $('.pcoded-navbar').addClass('navbar-dark');
    $('.layout-css').attr("href", "/da/assets/css/layouts/dark.css");
  } else {
    $('.layout-css').attr("href", "");
  }
});
// Header Color
$('.header-color > a').on('click', function() {
  var temp = $(this).attr('data-value');
  $('.header-color > a').removeClass('active');
  $(this).addClass('active');
  if (temp == "header-default") {
    $('.pcoded-header').removeClassPrefix('header-');
  } else {
    $('.pcoded-header').removeClassPrefix('header-');
    $('.pcoded-header').addClass(temp);
  }
});
// rtl layouts
$('#theme-rtl').change(function() {
  $('head').append('<link rel="stylesheet" class="rtl-css" href="">');
  if ($(this).is(":checked")) {
    $('.rtl-css').attr("href", "/da/assets/css/layouts/rtl.css");
    $('html').attr("dir", "rtl");
  } else {
    $('.rtl-css').attr("href", "");
    $('html').removeAttr("dir");
  }
});
// Menu Color
$('.navbar-color > a').on('click', function() {
  var temp = $(this).attr('data-value');
  $('.navbar-color > a').removeClass('active');
  $('.pcoded-navbar').addClass('brand-dark');
  $('.pcoded-navbar').removeClassPrefix('menu-');
  $(this).addClass('active');
  if (temp == "navbar-default") {
    $('.pcoded-navbar').removeClassPrefix('navbar-');
    $('.pcoded-navbar').removeClassPrefix('brand-dark');
  } else {
    $('.pcoded-navbar').removeClassPrefix('navbar-');
    $('.pcoded-navbar').addClass(temp);
  }
});
// Active Color
$('.active-color > a').on('click', function() {
  var temp = $(this).attr('data-value');
  $('.active-color > a').removeClass('active');
  $(this).addClass('active');
  if (temp == "active-default") {
    $('.pcoded-navbar').removeClassPrefix('active-');
  } else {
    $('.pcoded-navbar').removeClassPrefix('active-');
    $('.pcoded-navbar').addClass(temp);
  }
});

// Menu Icon Color
$('#icon-colored').change(function() {
  if ($(this).is(":checked")) {
    $('.pcoded-navbar').addClass('icon-colored');
  } else {
    $('.pcoded-navbar').removeClass('icon-colored');
  }
});

// title Color
$('.title-color > a').on('click', function() {
  var temp = $(this).attr('data-value');
  $('.title-color > a').removeClass('active');
  $(this).addClass('active');
  if (temp == "title-default") {
    $('.pcoded-navbar').removeClassPrefix('title-');
  } else {
    $('.pcoded-navbar').removeClassPrefix('title-');
    $('.pcoded-navbar').addClass(temp);
  }
});
// Menu Dropdown icon
function drpicon(temp) {
  if (temp == "style1") {
    $('.pcoded-navbar').removeClassPrefix('drp-icon-');
  } else {
    $('.pcoded-navbar').removeClassPrefix('drp-icon-');
    $('.pcoded-navbar').addClass('drp-icon-' + temp);
  }
}
// Menu subitem icon
function menuitemicon(temp) {
  if (temp == "style1") {
    $('.pcoded-navbar').removeClassPrefix('menu-item-icon-');
  } else {
    $('.pcoded-navbar').removeClassPrefix('menu-item-icon-');
    $('.pcoded-navbar').addClass('menu-item-icon-' + temp);
  }
}

$.fn.removeClassPrefix = function(prefix) {
  this.each(function(i, it) {
    var classes = it.className.split(" ").map(function(item) {
      return item.indexOf(prefix) === 0 ? "" : item;
    });
    it.className = classes.join(" ");
  });
  return this;
};
</script>
<script src="/da/assets/plugins/notification/js/bootstrap-growl.min.js"></script>

<!-- <div class="footer-fab">
  <div class="b-bg">
    <i class="fas fa-question"></i>
  </div>
  <div class="fab-hover">
    <ul class="list-unstyled">
      <li><a href="#"  data-text="Send Report" class="btn btn-icon btn-rounded btn-info m-0"><i class="fas fa-info-circle fa-ban"></i></a></li>
    </ul>
  </div>
</div> -->
<!-- modal-window-effects Js -->
<script src="/da/assets/plugins/modal-window-effects/js/classie.js"></script>
<script src="/da/assets/plugins/modal-window-effects/js/modalEffects.js"></script>
<script src="/da/assets/plugins/ekko-lightbox/js/ekko-lightbox.min.js"></script>
<script src="/da/assets/plugins/lightbox2-master/js/lightbox.min.js"></script>
<script src="/da/assets/js/pages/ac-lightbox.js"></script>




<script src="//code.jquery.com/jquery-1.11.3.min.js"></script>
<script src="//cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>
<script src="//cdn.datatables.net/1.10.12/js/dataTables.bootstrap.min.js"></script>
<!-- Responsive extension -->
<!-- <script src="https://cdn.datatables.net/responsive/2.1.0/js/responsive.bootstrap.min.js"></script> -->
<script src="https://cdn.datatables.net/responsive/2.3.0/js/dataTables.responsive.min.js"></script>


<!-- Buttons extension -->
<!-- <script src="//cdn.datatables.net/buttons/1.2.1/js/dataTables.buttons.min.js"></script> -->
<script src="https://cdn.datatables.net/buttons/2.2.3/js/dataTables.buttons.min.js"></script>

<script src="//cdn.datatables.net/buttons/1.2.1/js/buttons.bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jszip/2.5.0/jszip.min.js"></script>
<script src="//cdn.datatables.net/buttons/1.2.1/js/buttons.html5.min.js"></script>

<script src="script.js"></script>

<!--  -->


<script type="text/javascript">

var queriedData = [];

	let offset = 0;
	var limit = 300;

  <?php if (isset($state)): ?>

	var state = "<?=$state?>";
  <?php endif ?>

	var runFunction = true;




	function fetchDataFromState(){


    if(showTableIndicator === true){
      clearInterval(showTableIntervalId);
      clearInterval(runDataQueryIntervalId);

    }else{

      var url = "/fetch-data-by-state-backend";




      ajaxPost(url,data, (err,res) => {
        console.log(res)
        var returnedData = JSON.parse(res);

        if(returnedData.success){
          console.log(returnedData)
          queriedData = [...queriedData, ...returnedData.success]
          console.log(data['offset']);
          data['offset'] = data['offset'] + limit;

          console.log(data['offset'])

        }else if (returnedData.no_data) {
          // console.log(returnedData)

          // When There's no more data do the below codes

          serial_no = 0;


          document.querySelector("#queryTableBody").innerHTML = queriedData.map((user) => {
            console.log(user)
            serial_no++;
            return `
                <tr>
                  <td>${serial_no}</td>
                  <td>${user.email}</td>
                  <td>${user.full_name}</td>
                  <td>${user.gender}</td>
                  <td>${user.age_range}</td>
                  <td>${user.state}</td>
                  <td>${user.lga}</td>
                  <td>${user.phone_number}</td>
                  <td>${user.referred_by}</td>
                  <td>${decodeDate(true,user.date_created)}</td>
                  <td>${decodeDate("time",user.date_created+' '+user.time_created)}</td>
                </tr>
            `
          }).join("");


          showTableIndicator = true;

          showTable();
          usercount = queriedData.length;
          document.querySelector("#total-user").innerHTML = `${usercount}`;

          if(data.state){
          document.querySelector("#state-name").innerHTML = `${data.state} State`;

          }


          //set runFunction to false to stop to run fetchDataFromState() function
          runFunction = false;

          console.log("I am done")

          return

        }
      })

    }

	}
var showTableIntervalId;
var runDataQueryIntervalId;
var showTableIndicator = false;
var dataTable;

var data = {
  offset,
  limit,
  <?php if (isset($state)): ?>
    state,
  <?php endif ?>
}

function startApp() {
  console.log(showTableIntervalId)
  var showTableIntervalId

  showTableIntervalId = setInterval(function(){

    console.log(queriedData);

        if(runFunction === true){
          console.log("running")
        var runDataQueryIntervalId;
        fetchDataFromState()
        // runDataQueryIntervalId = setInterval(function(){fetchDataFromState()}, 500)
      }else{
          clearInterval(showTableIntervalId);
          clearInterval(runDataQueryIntervalId);
          console.log(queriedData)

      }

    // console.log(showTableIntervalId)
    // console.log(runDataQueryIntervalId)


  }, 3000)

}

function searchFunc(){



  // alert("clicked");

  var error = [];

  var startDateInput = document.querySelector("#start-date")
  var stopDateInput = document.querySelector("#stop-date")

  var startDate = startDateInput.value;
  var stopDate = stopDateInput.value;

  if(startDate.length < 1 || startDate == ""){
    error.push(true);
  }

  if (locationSelect.value.length > 0 || locationSelect.value != "") {
      data['state'] = locationSelect.value;

  }


  if(stopDate.length < 1 || stopDate == ""){
    error.push(true);
  }

  if(error.length > 0){
    alert("Please Select Date");
  }else{
    console.log("Got here")


    queriedData = [];
    runFunction = true
    showTableIndicator = false;

    //Destroy Data Table When Serach Button is clicked
    dataTable.destroy();

    //Set the data you're sending
    data['offset'] = 0;
    data['startDate'] = startDate
    data['stopDate'] = stopDate

    //Set Loading inside table
    document.querySelector("#queryTableBody").innerHTML = `<tr>
                  <td style="text-align:center" colspan="10">Loading <i class="fa fa-spinner fa-pulse"></i></td>
                </tr>`;

    document.querySelector("#total-user").innerHTML = `<h2 class="text-left text-white"><span id="total-user">Compiling Data... <i class="fa fa-spinner fa-pulse"></i></span></h2>`;

    startApp();


  }

}


startApp();

// function stopTimer(){
//   clearInterval(intervalID);
//   clearInterval(runDataQueryIntervalId);
// }


var states = [];


        stateLGA.map((state) => {
            // console.log(state.state)
            if (state.state == "Osun") {
                var stateAvailable = false;
            }else if (state.state  == "Imo") {
                var stateAvailable = false;
            }else if (state.state  == "Ekiti") {
                var stateAvailable = false;
            }else if (state.state  == "Oyo") {
                var stateAvailable = false;
            }else if (state.state  == "Ebonyi") {
                var stateAvailable = false;
            }else{
                var stateAvailable = true;
            }

            if(stateAvailable){
                states.push(state.state)
            }
        })

        locationSelect.innerHTML =  `<option value="" disabled="disabled" selected="selected" value="">Select State</option>
        <optgroup label="Campaign State(s)">
            <option>Osun</option>
            <option>Ebonyi</option>
            <option>Ekiti</option>
            <option>Imo</option>
            <option>Oyo</option>
        </optgroup>

        <optgroup label="Others">
        `+states.map((state) => { return `<option>${state}</option>`})+`</optgroup>`



</script>


<script type="text/javascript">

	// Code goes here
var showTable = function(){

dataTable = $('#myDataTable').DataTable({
  destroy: true,
  responsive: true,
  buttons: [
    {"type":"html"},
                { extend: 'copy' },
                { extend: 'csv', type: 'html', filename: 'Help Report', messageTop: 'REPORT OF RESPONSE TO CLIENTS FROM ALL RESPONDANT', footer: true},
                { extend: 'excel', type: 'html', title: 'Help Report',messageTop: 'REPORT OF RESPONSE TO CLIENTS FROM ALL RESPONDANT', footer: true},
                { extend: 'pdfHtml5', type: 'html', title: 'Help Report', messageTop: 'REPORT OF RESPONSE TO CLIENTS FROM ALL RESPONDANT', footer: true},

  ],
  // dom: "<'row'<'col-md-3'l><'col-md-6 text-center'B><'col-md-3'f>>" +
  //        "<'row'<'col-md-12'tr>>" +
  //        "<'row'<'col-md-5'i><'col-md-7'p>>",
  drawCallback: function(settings) {
    if (!$('.datatable').parent().hasClass('table-responsive')) {
      $('.datatable').wrap("<div class='table-responsive'></div>");
    }
  }
});

dataTable.columns().every(function() {
  var column = this;

  $('.filter-column', this.footer()).on('keyup change', function() {
    if (column.search() !== this.value) {
      column
        .search(this.value)
        .draw();
      this.focus();
    }
  });
});
}


</script>
<script type="text/javascript">
function decodeDate(format = false, date = null, time = null){
    // timeRegex = /(\d+)\:(\d+) (\w+)/;
    var weekDays = ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'];
    var funcData = [];

    if (date == null) {
        date = new Date();
    }else{
        date = new Date(date);
    }

    if (time != null){
      // timeParts = time.match(timeRegex);
      timeParts = time.split(":");
      // console.log(timeParts)
      hour = timeParts[0];
      mins = timeParts[1] ?? 00;
      sec = timeParts[2] ?? 00;
      date.setHours(hour)
      date.setMinutes(mins)
      date.setSeconds(sec)
    }
    // date = new Date(date).toLocaleString();
    month = date.toLocaleString('default', { month: 'long' });
    day = date.getDate();
    dayInWeek = date.getDay();
    year = date.getFullYear();

    hours = date.getHours()
    minutes = date.getMinutes()
    seconds = date.getSeconds()

    meridian = (hours > 12) ? "PM" : "AM"

    // console.log(day, month, year)

    funcData['year'] = year
    funcData['month'] = month
    funcData['dayInt'] = day
    funcData['month'] = month
    funcData['day'] = weekDays[dayInWeek]

    funcData['hour'] = (hours > 12) ? hours -12 : hours
    funcData['hour'] = (funcData['hour'] > 10) ? funcData['hour'] : '0'+funcData['hour']
    funcData['minutes'] = (minutes > 0) ? ((minutes > 10) ? minutes : '0'+minutes) : "00"
    funcData['seconds'] =     funcData['minutes'] = (minutes > 0) ? ((minutes > 10) ? minutes : '0'+minutes) : "00"

    funcData['meridian'] = meridian

    if (format === true) {
      funcReturn =  `${funcData['month']} ${funcData['dayInt']}, ${funcData['year']}`
    }else if (format == "time") {
      funcReturn =  `${funcData['hour']} : ${funcData['minutes']} ${funcData['meridian']}`
    }else{
      funcReturn = funcData;
    }
    return funcReturn;
    // return `${month} ${day}, ${year}`;
}


function urlToString(string){
    return encodeURI(string.replace(/(\s|\+)/g, "-").toLowerCase());
}
</script>
