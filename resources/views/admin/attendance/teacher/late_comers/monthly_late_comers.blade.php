<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Result</title>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

    </head>
    <body style="margin: 10px">

        <div class="content-wrapper">
   
            <section class="content">
               <div class="container-fluid">
                  <div class="row">
                     <div class="col-md-12">
                         <div class="card">
                             <div class="card-header">
                                <div class="row text-center">
                                    <h3 class="">Late Comers Attendance Report For The Month Of {{ $monthName }}</h3>
                                </div>
                             </div>

                             <div class="card-body p-0" style="overflow: auto;">
                                 <table class="table table-striped">
                                     <thead>
                                         <tr>
                                             <th>Teacher Name</th>
                                             <th>Attendance Date</th>
                                             <th>Arrival Time</th>
                                             <th>Closing Time</th>
                                             <th>Attendance Status</th>
                                             <th>Created By</th>
                                         </tr>
                                     </thead>
                                     <tbody>
                                         @forelse ($getAttendance as $value)
                                             <tr>
                                                 <td>{{ $value->teacher_name }}</td>
                                                 <td>{{ $value->attendance_date }}</td>
                                                 <td>{{ $value->arrival_time }}</td>
                                                 <td>{{ $value->closing_time }}</td>
                                                 <td>
                                                    <p style="color: red">Late</p>
                                                 </td>
                                                 <td>{{ $value->created_by }}</td>
                                             </tr>
                                         @empty
                                             <td colspan="100%">
                                                 No Attendance Data Found For Today!
                                             </td>
                                         @endforelse
                                         
                                     </tbody>                                
                                 </table>
                             </div>
                         </div>
                     </div>
                  </div>
               </div>
            </section>
         </div>
        

        <script type="text/javascript">
            window.print();
        </script>


        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.3/dist/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    </body>

</html>