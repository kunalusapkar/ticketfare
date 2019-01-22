<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Ticketing System
    </title>
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet" type="text/css">
    <link href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    
    <script src="//code.jquery.com/jquery-1.11.1.min.js">
    </script>
    <script src="//netdna.bootstrapcdn.com/bootstrap/3.0.0/js/bootstrap.min.js">
    </script>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css"/>
    <!-- Mini-extra style to be apply to tables with the dataTable plugin  -->
    <style>
      .dataTable table tr {
        border: solid 1px black;
      }
    </style>    
  </head>
  <body>
    <div class="container">
      <div class="col-lg-10">
        <div class="row" style="margin: 50px">
            <table id="myTable" style="border:solid 1px black">
            <thead>
                <tr>
                    <th>from_airport</th>
                    <th>to_airport</th>
                    <th>lowest_fare</th>
                </tr>
            </thead>
            <tbody>
              @foreach($flights as $flight)
                <tr>
                    <td>{{$flight->from_airport}}</td>
                    <td>{{$flight->to_airport}}</td>
                    <td>{{$flight->lowest_fare}}</td>
                </tr>
              @endforeach
            </tbody>
            </table>
        </div>
      </div>
    </div>
  </body>
  <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js">
  </script>
  <script>
    $(document).ready(function(){
      //Apply the datatables plugin to your table
      $('#myTable').DataTable();
    }
    );
  </script>
</html>
