<!DOCTYPE html>
<html>
<head>
<style>
table {
  font-family: arial, sans-serif;
  border-collapse: collapse;
  width: 80%;
}

td, th {
  border: 1px solid #dddddd;
  text-align: left;
  padding: 8px;
}

tr:nth-child(even) {
  background-color: #dddddd;
}
</style>
</head>
<body>

 
<h1>INVOICE DETAILS</h1>
                            <table>
                                <thead>
                                    <tr>
                                    <th scope="col">Company name</th>
                                    <th scope="col">Address</th>
                                        <th scope="col">Email</th>
                                        <th scope="col">Product</th>
                                        <th scope="col">Quotation Amount</th>
                                        <th scope="col">Quotation Number</th>
                                        <th scope="col">Invoice amount</th>
                                        
                                        <th scope="col">Date</th>
                                    </tr>
                                </thead>
                                <tbody>
                               
                                    @foreach($invoice as $value)                          
                    <tr>
                    
                        <td>{{$value->clients->company_name}}</td>
                        <td>{{$value->clients->address}}</td>
                        <td>{{$value->clients->email}}</td>
                        <td>{{$value->products->product}}</td>
                        
                        <td>{{$value->quotation_amount}}  </td>
                        <td>{{$value->quotation_no}}  </td>
                        <td>{{$value->payment}}  </td>
                        <td>{{$value->created}}  </td>
                                    @endforeach
                                </tbody>
                     




</table>

</body>
</html>

                            
                        