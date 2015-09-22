@extends('layouts.template')

@section('content')

<section class="container">
    <div class="row">
        <!--Content-->
        <div class="col-md-9">
            <header>
                <h1 class="page-title">Contribute to Smart & Fit</h1>
            </header>
               {!! Form::open(['id' => 'form-submit', 'role' => 'form', 'enctype' => 'multipart/form-data','action' => 'CrowdSourcingController@store']) !!}
                <section>
                    <div class="form-group large">
                        {!!Form::label('name', 'Gym')!!}
                        {!!Form::text('name',null,['class'=>'form-control', 'id'=>'title']) !!}                         
                    </div>
                </section>
                <section>
                    <h3>Update Address & Gym Details</h3>
                    <div class="row">
                        <div class="col-md-4 col-sm-4">
                            <div class="form-group">
                                {!!Form::label('state', 'State')!!}
                                {!!Form::text('state',null,['class'=>'form-control', 'id'=>'state']) !!}      
                            </div>
                        </div>
                        <!--/.col-md -4-->
                        
                        <div class="col-md-4 col-sm-4">
                            <div class="form-group">
                                {!! Form::label('city','City')!!}
                                {!!Form::text('city',null, ['class' => 'form-control', 'id'=>'city'] )!!}
                            </div>                                
                        </div>
                        
                        <!--/.col-md-4-->
                        <div class="col-md-4 col-sm-4">
                            <div class="form-group">
                                {!! Form::label('street','Street')!!}
                                {!!Form::text('street',null, ['class' => 'form-control', 'id'=>'street'] )!!}
                            </div>
                        </div>
                        <!--/.col-md-4-->
                    </div>
                    <!--/.row-->
                    <div class="row">
                        <div class="col-md-4 col-sm-4">
                            <div class="form-group">
                                {!! Form::label('phone-number','Phone Number')!!}
                                {!! Form::text('phone',null, ['class' => 'form-control', 'id'=>'phone-number', 'patter'=>'\d*'] )!!}
                            </div>
                        </div>
                        <!--/.col-md-4-->
                        <div class="col-md-4 col-sm-4">
                            <div class="form-group">
                                {!! Form::label( 'email','E-mail' )!!}
                                {!! Form::email('email',null, ['class' => 'form-control', 'id'=>'email'] )!!}
                            </div>
                        </div>
                        <!--/.col-md-4-->
                        <div class="col-md-4 col-sm-4">
                            <div class="form-group">
                                {!! Form::label('website' , 'Website') !!}
                                {!! Form::text('website',null, ['class' => 'form-control', 'id'=>'website'] )!!}
                                
                            </div>
                        </div>
                        <!--/.col-md-4-->
                    </div>
                     <div class="row">
                        <div class="col-md-4 col-sm-4">
                            <div class="form-group">
                                {!!Form::label('interior', 'Interior')!!}
                                {!!Form::text('interior',null,['class'=>'form-control', 'id'=>'interior']) !!}      
                            </div>
                        </div>

                        <!--/.col-md -4-->
                        <div class="col-md-4 col-sm-4">
                            <div class="form-group">
                                {!! Form::label('exterior','Exterior')!!}
                                {!!Form::text('exterior',null, ['class' => 'form-control', 'id'=>'exterior'] )!!}
                            </div>
                        </div>
                        
                        <!--/.col-md-4-->
                        <div class="col-md-4 col-sm-4">
                            <div class="form-group">
                                {!! Form::label('neighbourhood','Neighbourhood')!!}
                                {!!Form::text('neighbourhood',null, ['class' => 'form-control', 'id'=>'neighbourhood'] )!!}
                            </div>   
                           
                        </div>
                    </div>
                        
                    <div class="row">
                        <div class="col-md-4 col-sm-4">
                            <div class="form-group">
                                {!!Form::label('country', 'Country')!!}
                                {!!Form::text('country',null,['class'=>'form-control', 'id'=>'country']) !!}
                                {!! Form::hidden('User_iduser', '125') !!}
                                {!! Form::hidden('CrowdSourceStatus_idCrowdSourceStatus', '0') !!}
                                {!! Form::hidden('Gym_idgym', '2') !!}
                            </div>
                         </div>   
                        <div class="col-md-4 col-sm-4">
                            <div class="form-group">
                                {!! Form::label('zip','Post Code')!!}
                                {!!Form::text('postalCode',null, ['class' => 'form-control', 'id'=>'postalCode', 'patter'=>'\d*'] )!!}
                            </div>
                        </div>                          
                    </div>
                    <div class="row">
                        <div class="col-md-4 col-sm-4">
                            <div class="form-group">
                                {!!Form::label('latitude', 'Latitude')!!}
                                {!!Form::text('latitude',null,['class'=>'form-control', 'id'=>'latitude']) !!}
                            </div>
                         </div>   
                        <div class="col-md-4 col-sm-4">
                            <div class="form-group">
                                {!! Form::label('longitude','Longitude')!!}
                                {!!Form::text('longitude',null, ['class' => 'form-control', 'id'=>'latitude'] )!!}
                            </div>
                        </div>                          
                    </div>

                    <!--/.row-->
                </section>
                <!--/#address-contact-->
                <section>
                    <h3>Services</h3>
                    <ul class="list-unstyled checkboxes">
                        @foreach ($gym_services as $services)
                            <div class="checkbox" >
                                <li>{!! Form::checkbox( 'services[]', $services->idservice  ) !!} {!! Form::label($services->name,$services->name)!!}</li>
                            </div>
                        @endforeach
                    </ul>
                </section>
                <!--Menu-->
                <section>
                    <h3>Activities</h3>
                    <ul class="list-unstyled checkboxes">
                        @foreach ($gym_activities as $activities)
                            <div class="checkbox" >
                                <li>{!! Form::checkbox( 'activities[]', $activities->idactivities  ) !!} {!! Form::label($activities->name,$activities->name)!!}</li>
                            </div>
                        @endforeach
                    </ul>
                </section>
                <!--end Menu-->
                <!--Gallery-->
                <section>
                    <h3>Gallery</h3>
                    <div id="file-submit" class="dropzone">
                        <input name="file" type="file" multiple>
                        <div class="dz-default dz-message"><span>Click or Drop Images Here</span></div>
                    </div>
                </section>
                <!--end Gallery-->
                <!--Opening Hours-->
                <section>
                    <h3>Opening Hours</h3>
                    <div class="opening-hours">
                        <div class="table-responsive">
                            <table class="table">
                                <tbody>
                                    <tr class="day">
                                        <td class="day-name">Monday</td>
                                        <td class="from"><input class="oh-timepicker" type="text" placeholder="From" name="open-hour-from[]"></td>
                                        <td class="to"><input class="oh-timepicker" type="text" placeholder="To" name="open-hour-to[]"></td>
                                        <td class="non-stop"><div class="checkbox">
                                            <label>
                                                <input type="checkbox">Non-stop
                                            </label>
                                        </div>
                                    </td>
                                </tr>
                                <!--/.day-->
                                <tr class="day">
                                    <td class="day-name">Tuesday</td>
                                    <td class="from"><input class="oh-timepicker" type="text" placeholder="From" name="open-hour-from[]"></td>
                                    <td class="to"><input class="oh-timepicker" type="text" placeholder="To" name="open-hour-to[]"></td>
                                    <td class="non-stop"><div class="checkbox">
                                        <label>
                                            <input type="checkbox">Non-stop
                                        </label>
                                    </div>
                                </td>
                            </tr>
                            <!--/.day-->
                            <tr class="day">
                                <td class="day-name">Wednesday</td>
                                <td class="from"><input class="oh-timepicker" type="text" placeholder="From" name="open-hour-from[]"></td>
                                <td class="to"><input class="oh-timepicker" type="text" placeholder="To" name="open-hour-to[]"></td>
                                <td class="non-stop"><div class="checkbox">
                                    <label>
                                        <input type="checkbox">Non-stop
                                    </label>
                                </div>
                            </td>
                        </tr>
                        <!--/.day-->
                        <tr class="day">
                            <td class="day-name">Thursday</td>
                            <td class="from"><input class="oh-timepicker" type="text" placeholder="From" name="open-hour-from[]"></td>
                            <td class="to"><input class="oh-timepicker" type="text" placeholder="To" name="open-hour-to[]"></td>
                            <td class="non-stop"><div class="checkbox">
                                <label>
                                    <input type="checkbox">Non-stop
                                </label>
                            </div>
                        </td>
                    </tr>
                    <!--/.day-->
                    <tr class="day">
                        <td class="day-name">Friday</td>
                        <td class="from"><input class="oh-timepicker" type="text" placeholder="From" name="open-hour-from[]"></td>
                        <td class="to"><input class="oh-timepicker" type="text" placeholder="To" name="open-hour-to[]"></td>
                        <td class="non-stop"><div class="checkbox">
                            <label>
                                <input type="checkbox">Non-stop
                            </label>
                        </div>
                    </td>
                </tr>
                <!--/.day-->
                <tr class="day weekend">
                    <td class="day-name">Saturday</td>
                    <td class="from"><input class="oh-timepicker" type="text" placeholder="From" name="open-hour-from[]"></td>
                    <td class="to"><input class="oh-timepicker" type="text" placeholder="To" name="open-hour-to[]"></td>
                    <td class="non-stop"><div class="checkbox">
                        <label>
                            <input type="checkbox">Non-stop
                        </label>
                    </div>
                </td>
            </tr>
            <!--/.day-->
            <tr class="day weekend">
                <td class="day-name">Sunday</td>
                <td class="from"><input class="oh-timepicker" type="text" placeholder="From" name="open-hour-from[]"></td>
                <td class="to"><input class="oh-timepicker" type="text" placeholder="To" name="open-hour-to[]"></td>
                <td class="non-stop"><div class="checkbox">
                    <label>
                        <input type="checkbox">Non-stop
                    </label>
                </div>
            </td>
        </tr>
        <!--/.day-->
    </tbody>
</table>
</div>
</div>
</section>
<!--end Opening Hours-->
<hr>
<section>
    
    <div class="form-group">
        <!--button type="submit" class="btn btn-default pull-right" id="submit">Submit & Pay</button-->
        {!! Form::submit('Submit',['class'=> 'btn btn-default pull-right','id'=>'submit']) !!}
    </div>
    <!-- /.form-group -->
</section>
{!! Form::close() !!}
<!--/#form-submit-->
</div>
<!--/.col-md-9-->

</div>
<!-- /.col-md-3-->
<!--end Sidebar-->
</div>
</section>
</div>
<!-- end Page Content-->
</div>
<!-- end Page Canvas-->
</div>
<!-- end Inner Wrapper -->
</div>
<!-- end Outer Wrapper-->

<!--[if lte IE 9]>
<script type="text/javascript" src="assets/js/ie-scripts.js"></script>
<![endif]-->

@stop