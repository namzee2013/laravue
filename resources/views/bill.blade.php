<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title></title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  </head>
  <body>
    <div class="">
      <table class="table">
        <thead>
          <tr>
            <th>#</th>
            <th>Name</th>
            <th>Qty</th>
            <th>Price</th>
            <th>Subtotal</th>

          </tr>
        </thead>
        <tbody>
          @foreach($data as $key => $value)
          <tr>
            <td>{{$key}}</td>
            <td>{{$value->name}}</td>
            <td>{{$value->qty}}</td>
            <td>{{$value->price}}</td>
            <td>{{$value->subtotal}}</td>
          </tr>
          @endforeach
          <tr>
            <td class="text-right" colspan="3"><h4>SUM:  </h4></td>
            <td colspan="2"><h4>{{$total}} VND</h4></td>
          </tr>
        </tbody>
      </table>
    </div>
  </body>
</html>
