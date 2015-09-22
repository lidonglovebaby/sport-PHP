<!DOCTYPE html>

<html lang="en-US">
<head>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{!! csrf_token() !!}" />

  <!--   <link href="assets/fonts/font-awesome.css" rel="stylesheet" type="text/css">
    <link href='http://fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="bootstrap/css/bootstrap.css" type="text/css">
    <link rel="stylesheet" href="css/bootstrap-select.min.css" type="text/css">
    <link rel="stylesheet" href="css/owl.carousel.css" type="text/css">
    <link rel="stylesheet" href="css/jquery.mCustomScrollbar.css" type="text/css">
    <link rel="stylesheet" href="css/jquery.nouislider.min.css" type="text/css">
    <link rel="stylesheet" href="css/colors/green.css" type="text/css">
    <link rel="stylesheet" href="css/user.style.css" type="text/css"> -->

    {!! HTML::style('fonts/font-awesome.css') !!}
    {!! HTML::style('bootstrap/css/bootstrap.css') !!}
    {!! HTML::style('css/bootstrap-select.min.css') !!}
    {!! HTML::style('css/owl.carousel.css') !!}
    {!! HTML::style('css/jquery.mCustomScrollbar.css') !!}
    {!! HTML::style('css/jquery.nouislider.min.css') !!}
    {!! HTML::style('css/colors/green.css') !!}
    {!! HTML::style('css/user.style.css') !!}
    {!! HTML::style('css/leaflet.css') !!}
    {!! HTML::style('css/custom_open.css') !!}
     <link href='http://fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'>
     <link href='http://fonts.googleapis.com/css?family=Exo:400,600' rel='stylesheet' type='text/css'>

  
    <title>{{ $title or 'Home Page'}} </title>

</head>


<body onunload="" class="{{ $page->class or 'page-subpage page-item-detail' }} navigation-off-canvas" id="page-top">

<!-- Outer Wrapper-->
<div id="outer-wrapper">
    <!-- Inner Wrapper -->
    <div id="inner-wrapper">