<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Receipt</title>
<style>
  body {
    font-family: Arial, sans-serif;
    padding: 10px;
    max-width: 300px; /* Adjust width as needed */
    margin: auto;
  }
  table {
    width: 100%;
    border-collapse: collapse;
    font-size: 0.9em; /* Slightly larger text for readability */
  }
  th, td {
    padding: 5px; /* Small padding */
    border: none; /* No borders for clean look */
  }
  th {
    font-weight: normal; /* Non-bold header text */
  }
  .header, .footer {
    padding-bottom: 5px;
    margin-bottom: 5px;
  }
  .centered {
    text-align: center; 
    font-weight: bold; /* Make text bold */
  }
  .footer {
    border-top: 1px solid #000; /* Line separator at the top of footer */
    padding-top: 5px;
    margin-top: 10px;
    font-weight: bold;
  }
  .total {
    font-weight: bold;
  }
</style>
</head>
<body>

<table>
  <thead>
    <tr class="header">
      <th colspan="4" style="font-weight: bold; border-bottom: 1px solid #000;" >Bryan Mini Grocery</th>
    </tr>
    <tr class="centered">
      <td colspan="4">Rizal St Brg 8 Poblacion</td>
    </tr>
    <tr class="centered">
      <td colspan="4">Gen. Tinio, N.E.</td>
    </tr>
  </thead>
  <tbody>
    <tr class="centered">
      <td colspan="4">ORDER SLIP</td>
    </tr>
    <tr>
      <td colspan="4">Cashier: Joanne</td>
    </tr>
    <tr>
      <td colspan="4">S0#: 0000000</td>
    </tr>
    <tr>
      <td colspan="4">Date: 08/18/2024 03:58 PM</td>
    </tr>
    <tr>
      <td>Description</td>
      <td>Price</td>
      <td>Qty</td>
      <td>Amount</td>
    </tr>
    <tr>
      <td>sabon</td>
      <td>12</td>
      <td>3</td>
      <td>36</td>
    </tr>
    <tr style="border-top: 1px solid #000;" >
      <td  colspan="3" class="total" style="padding-top: 10px">Subtotal</td>
      <td class="total" style="padding-top: 10px">36</td>
    </tr>
    <tr>
      <td colspan="3" class="total">Amount Due</td>
      <td class="total">36</td>
    </tr>
    <tr>
      <td colspan="3" class="total">Cash</td>
      <td class="total">1,000</td>
    </tr>
    <tr class="footer" style="font-size: 20px">
      <td colspan="3" class="total">Change</td>
      <td class="total">553</td>
    </tr>
  </tbody>
  <tfoot>
    <tr >
      <td colspan="4" style="padding-bottom: 45px" >   </td>
    </tr>
    <tr class="centered footer" >
      <td colspan="4">Received By</td>
    </tr>
  </tfoot>
</table>

</body>
</html>
