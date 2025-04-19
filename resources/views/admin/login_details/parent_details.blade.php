<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <title>Parent Login Details</title>

    <style>
        th{
            border: 2px solid;
        }
        table{
            border: 2px solid;
        }
        /* td{
            border: 2px solid;
        } */
    </style>
</head>


<body>

    <table class="table table-striped">
        <tr style="width: 100%; text-align: center;">
            <td width="5%"></td>
            <td width="15%"><img style="width: 150px;" src="{{ $getSetting->getLogo() }}" alt=""></td>
            <td align="center" width="85%">
                <h1>{!! $getSetting->school_name !!} </h1><br>
                <h2>Parent Login Details</h2>
            </td>
        </tr>
    </table>

    <br><br>


    <table class="table table-striped">
        <thead>
            <tr style="border: 2px solid">
                <th>S/N</th>
                <th>Photo</th>
                <th>Title</th>
                <th>Parent Name</th>
                <th>Login Email</th>
                <th>Login Password</th>
            </tr>
        </thead>


        <tbody>
            @php
                $id =1;
            @endphp
            @forelse ($getRecord as $value)
                <tr style="border: 2px solid">
                    <td style="border: 2px solid">{{ $id++ }}</td>
                    <td style="border: 2px solid"><img src="{{ $value->getProfileDirect() }}" class="rounded-circle" style="height: 50px; width: auto;" alt=""></td>
                    <td style="border: 2px solid">{{ $value->title }}</td>
                    <td style="border: 2px solid">{{ $value->name }} {{ $value->last_name }} {{ $value->other_name }}</td>
                    <td style="border: 2px solid">{{ $value->email }}</td>
                    <td style="border: 2px solid">{{ $value->keep_track }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="100%">No Parent Found!</td>
                </tr>
            @endforelse
        </tbody>
      </table>

    

   



    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

</body>
</html>