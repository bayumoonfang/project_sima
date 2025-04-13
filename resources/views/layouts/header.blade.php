<!DOCTYPE html>
<html style="overflow-x: hidden !important;overflow-y: auto !important;background-color: #f8f9fd !important;">
<style>
  body {
    zoom: 90%;
  }
</style>

<head>
  <meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>{{ config('variables.appName') }}</title>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Fredoka:wght@300..700&family=Nunito:ital,wght@0,200..1000;1,200..1000&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<link rel="stylesheet" href="{{ asset('plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
<link rel="stylesheet" href="{{ asset('css/adminlte.min.css') }}">
<link rel="stylesheet" href="{{ asset('plugins/datatables/dataTables.dataTables.min.css') }}">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<link rel="stylesheet" href="{{ asset('css/global_style.css') }}">
<link rel="stylesheet" href="https://code.jquery.com/ui/1.14.1/themes/base/jquery-ui.css">
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/3.2.2/css/buttons.dataTables.css">
  <!--PUBLIC CONTENT=========================================-->


  <div class="alert alert-danger erroralert" role="alert" onclick="closealert()">
    <a onclick="closealert()" style="cursor: pointer"><i class="fas fa-times alert_close"></i></a>
    <div class="messq qs alert_message"></div>
  </div>

  <div class="alert alert-success successalert" role="alert" onclick="closealert()">
    <a onclick="closealert()" style="cursor: pointer"><i class="fas fa-times alert_close"></i></a>
    <div class="messq qs alert_message_success"></div>
  </div>

</head>
