<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <title>Print Report {{$processedreport->driver->first_name}} {{$processedreport->driver->last_name}}</title>
</head>
<body>
    <div class="row text-center justify-content-center align-items-center pt-4">
        <h4> <span class="badge bg-primary">Stops Information</span></h4>
    </div>

    <div class="row text-center justify-content-center align-items-center">
        <div class="col-sm-2">
            <div class="form-group">
                <label for="total_entries" class="mb-1"><span class="badge bg-secondary">Driver Name</span></label>
                <input type="text" value="{{$processedreport->driver->first_name}} {{$processedreport->driver->last_name}}" class="form-control text-center" disabled>
            </div>
        </div>
        <div class="col-sm-2">
            <div class="form-group">
                <label for="total_sales" class="mb-1"><span class="badge bg-success">Total Stops</span></label>
                <input type="text" value="{{$stops}}" class="form-control text-center small" disabled>
            </div>
        </div>
        <div class="col-sm-2">
            <div class="form-group">
                <label for="total_purchases" class="mb-1"><span class="badge bg-primary">Total Sales</span></label>
                <input type="text" value="{{$totales->sale}}" class="form-control text-center" disabled>
            </div>
        </div>
    </div>
    <hr>
    <div class="row text-center justify-content-center align-items-center pt-4">
        <h4> <span class="badge bg-primary">Date Range</span></h4>
    </div>
    <div class="row text-center justify-content-center align-items-center">
        <div class="col-sm-2">
            <div class="form-group">
                <label for="total_entries" class="mb-1"><span class="badge bg-secondary">Start Date</span></label>
                <input type="text" value="{{ \Carbon\Carbon::parse($totales->start_date)->format('d/m/Y')}}" class="form-control text-center" disabled>
            </div>
        </div>
        <div class="col-sm-2">
            <div class="form-group">
                <label for="total_sales" class="mb-1"><span class="badge bg-success">End Date</span></label>
                <input type="text" value="{{ \Carbon\Carbon::parse($totales->end_date)->format('d/m/Y')}}" class="form-control text-center small" disabled>
            </div>
        </div>
    </div>
    <hr>
    <br>
    <br>
    <div class="text-center" >
        <p style="text-decoration-line: overline;">
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <strong>Autorized By</strong>
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        </p>
    </div>
</body>
</html>
