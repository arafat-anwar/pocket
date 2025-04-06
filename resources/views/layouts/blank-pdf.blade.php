<!DOCTYPE html>
<html lang="en">
 <head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>{{ $title }}</title>
  <link rel="icon" href="system-images/icons/{{  session()->get('system-information')->icon }}" type="image/png">
  <style>
   @page {
    margin-top: 1.5in !important;
    margin-bottom: 1.5in !important;
    header: page-header;
    footer: page-footer;
   }

   html, body, p  {
    font-size:  12px !important;
    color: #000000;
   }

   table {
    width: 100% !important;
    border-spacing: 0px !important;
    margin-top: 10px !important;
    margin-bottom: 15px !important;
   }

   table caption {
    color: #000000 !important;
   }

   table td {
    padding-top: 1px !important;
    padding-bottom: 1px !important;
    padding-left: 7px !important;
    padding-right: 7px !important;
   }
   
   .table-non-bordered {
    margin-top: 0px !important;
    margin-bottom: 0px !important;
    padding-left: 0px !important;
   }

   .table-non-bordered {
    border-collapse: collapse;
   }

   .table-non-bordered td {
    border: 0px;
    padding: 0px;
   }

   .table-non-bordered tr:first-child td {
    border-top: 0;
   }

   .table-non-bordered tr td:first-child {
    border-left: 0;
   }

   .table-non-bordered tr:last-child td {
    border-bottom: 0;
   }

   .table-non-bordered tr td:last-child {
    border-right: 0;
   }

   .table-bordered {
    border-collapse: collapse;
   }

   .table-bordered td {
    border: 1px solid #000000;
    padding: 5px;
   }

   .table-bordered tr:first-child td {
    border-top: 0;
   }

   .table-bordered tr td:first-child {
    border-left: 0;
   }

   .table-bordered tr:last-child td {
    border-bottom: 0;
   }

   .table-bordered tr td:last-child {
    border-right: 0;
   }

   .mt-0 {
    margin-top: 0; 
   }

   .mb-0 {
    margin-bottom: 0; 
   }

   .image-space {
    white-space: wrap !important;
    padding-top: 45px !important;
   }

   .break-before {
    page-break-before: always;
    break-before: always;
   }

   .break-after {
    break-after: always;
   }

   .break-inside {
    page-break-inside: avoid;
    break-inside: avoid;
   }

   .break-inside-auto { 
    page-break-inside: auto;
    break-inside: auto;
   }

   .space-top {
    margin-top: 10px;
   }

   .space-bottom {
    margin-bottom: 10px;
   }

   .text-right{
    text-align:  right !important;
   }

   .text-center{
    text-align: center !important;
   }

   .text-left{
    text-align: left !important;
   } 

   .bg-header {
      background-color: #bbb !important;
   }

   .even {
      background-color: white !important;
   }  

   .odd {
      background-color: #eee !important;
   }

   .text-success{
      color: green !important;
   }

   .text-info {
      color: blue !important;
   }

   .text-danger{
      color: red !important;
   }  
  </style> 
 </head>
 
 <body>
  <htmlpageheader name="page-header">
   
  </htmlpageheader>

   <htmlpagefooter name="page-footer">
      
   </htmlpagefooter>

   <div class="container">
      @yield('content')
   </div>
 </body>
</html>