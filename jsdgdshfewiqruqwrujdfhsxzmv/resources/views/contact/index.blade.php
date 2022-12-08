<!doctype html>

<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>

    <meta charset="utf-8">

    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Corespl') }}</title>

    <!-- Bootstrap css-->

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" crossorigin="anonymous">
</head>

<body>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div style="margin:2%">
                    <form action="{{ route('contactus.save')}}" method="POST">
                        @csrf
                        <div class="form-group form-row">
                            <label for="name" class="col-sm-4 col-form-label">Your Name:</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="name" value="" name="name" require>
                            </div>
                        </div>

                        <div class="form-group form-row">
                            <label for="email" class="col-sm-4 col-form-label">Your email address:</label>
                            <div class="col-sm-8">
                                <input type="email" class="form-control" id="email" value="" name="email" require>
                            </div>
                        </div>
                        
                        <div class="form-group form-row">
                            <label for="phone" class="col-sm-4 col-form-label">Your phone number:</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="phone" value="" name="phone" require>
                            </div>
                        </div>
                        
                        <div class="form-group form-row">
                            <label for="role" class="col-sm-4 col-form-label">Your position/role:</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="role" value="" name="role" require>
                            </div>
                        </div>
                        
                        <div class="form-group form-row">
                            <label for="business_name" class="col-sm-4 col-form-label">Name of business:</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="business_name" value="" name="business_name" require>
                            </div>
                        </div>
                        
                        <div class="form-group form-row">
                            <label for="address" class="col-sm-4 col-form-label">Address:</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="address" value="" name="address" require>
                            </div>
                        </div>
                        
                        <div class="form-group form-row">
                            <label for="city" class="col-sm-4 col-form-label">City:</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="city" value="" name="city" require>
                            </div>
                        </div>
                        
                        <div class="form-group form-row">
                            <label for="state" class="col-sm-4 col-form-label">State/province:</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="state" value="" name="state" require>
                            </div>
                        </div>
                        <div class="form-group form-row">
                            <label for="country" class="col-sm-4 col-form-label">Country:</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="country" value="" name="country" require>
                            </div>
                        </div>

                        <div class="form-group form-row">
                            <label for="no_of_employee" class="col-sm-4 col-form-label">No of Employees:</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="no_of_employee" value="" name="no_of_employee" require>
                            </div>
                        </div>
                        
                        <div class="form-group form-row">
                            <label for="purpose" class="col-sm-4 col-form-label">Purpose of calling:</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="purpose" value="" name="purpose" require>
                            </div>
                        </div>
                    
                        <div class="form-group form-row">
                            <label for="company_name" class="col-sm-4 col-form-label">Exsisting Phone Company's Name:</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="company_name" value="" name="company_name" require>
                            </div>
                        </div>
                            
                        <div class="form-group form-row">
                            <label for="company_website" class="col-sm-4 col-form-label">Exsisting Phone Company's Website:</label>
                            <div class="col-sm-8">
                                <input type="url" class="form-control" id="company_website" value="" name="company_website" require>
                            </div>
                        </div>
                            
                        <div class="form-group form-row">
                            <label for="office_phone" class="col-sm-4 col-form-label">Exsisting number of phone in your office:</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="office_phone" value="" name="office_phone" require>
                            </div>
                        </div>
                            
                        <div class="form-group form-row">
                           <label for="own_phone" class="col-sm-4 col-form-label">Do you own the Phones or provided to you by the existing phone company:</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="own_phone" value="" name="own_phone" require>
                            </div>
                        </div>
                            
                        <div class="form-group form-row">
                            <label for="no_of_phone" class="col-sm-4 col-form-label">How many employees would need a phone:</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="no_of_phone" value="" name="no_of_phone" require>
                            </div>
                        </div>

                            
                        <div class="form-group form-row">
                            <label for="no_phone_at_same_time" class="col-sm-4 col-form-label">How many employees are on the phone at the same time:</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="no_phone_at_same_time" value="" name="no_phone_at_same_time" require>
                            </div>
                        </div>
                            
                        <div class="form-group form-row">
                            <label for="new_phone" class="col-sm-4 col-form-label">Do you want a new phone number or would you keep exsisting number:</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="new_phone" value="" name="new_phone" require>
                            </div>
                        </div>

                        <div class="form-group form-row">
                            <label for="exsisting_phone" class="col-sm-4 col-form-label">What is the exsisting phone number:</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="exsisting_phone" value="" name="exsisting_phone" require>
                            </div>
                        </div>

                        <div class="form-group form-row">
                            <div class="col-sm-12">
                                <div class="pull-right" style="text-align: end;">
                                    <button type="submit" class="btn btn-success">Submit</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" crossorigin="anonymous"></script>
    +<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" crossorigin="anonymous"></script>
</body>

</html> 