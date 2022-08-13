<?php 

use yii\bootstrap4\ActiveForm;
use frontend\models\ClassRoomSecurity;
?>
<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css">
    <title>Hello, world!</title>
    <style>
        .form-group.required .control-label:after {
            content: "*";
            color: red;
        }

        .form-group.required .control-label {
            color: #1e78ee;
            font-size: 18px;
        }

        .heading {
            color: #1e78ee;
            font-size: 18px;
        }
    </style>
</head>

<body>
    <div class="container mt-5">
        
            <?php $form = ActiveForm::begin() ?>
            <div class="card">
                <div class="card-header ml-3">
                    <div class="row">
                        <div class="col-6">
                            <h6 class="h4 text-primary font-weight-bold">
                         
                            </h6>
                        </div>
                        <div class="col-6">
                            <button class="float-right btn btn-outline-primary"><i class='fa fa-save'> Save</i></button>
                        </div>
                    </div>
                </div>
                <!-- Headings -->
                <div class="card-body ml-3">
                    <div class="form-row">
                        <label for="" class="heading font-weight-bold">Fields with <span class="text-red">*</span> are
                            Required</label>
                    </div>
                    <!-- Basic Information begins -->
                    <div class="form-row">
                        <h2 class="font-weight-bold">Basic Information</h2>
                    </div>
                    <div class="form-row p-4">
                        <div class="col-4">
                            <div class="form-row">
                                <div class="form-group col-md-12 required">
                                    <img src="/img/nouser.png" class="rounded-circle" alt="" width="200" height="200">
                                </div>

                                <div class="form-group col-md-10 required">
                                    <label class="control-label" for="image">Photo: </label>
                                    <?=$form->field($basic,'file')->input('file') ?>
                                    <!-- <input type="file" class="form-control" name="" id="" required> -->
                                </div>

                            </div>


                        </div>

                        <div class="col-8 mt-3">
                            <div class="form-row mt-3">
                                <div class="form-group col-md-5 required">
                                    <label class="control-label" for="dob">Birth Date: </label>
                                    <?=$form->field($basic,'birthdate')->input('date',['class'=>'form-control'])->label(false)?>
                                   
                                </div>
                                <div class="form-group col-md-7 required">
                                    <label class="control-label" for="nida">National ID (NIDA): </label>
                                    <?=$form->field($basic,'nida')->textInput(['class'=>'form-control'])->label(false)?>
                                   
                                </div>
                            </div>


                            <div class="form-row mt-3">
                                <div class="form-group col-md-4 required">
                                    <label class="control-label" for="region">Region: </label>
                                    <?=$form->field($basic,'region')->textInput(['class'=>'form-control'])->label(false)?>
                                   
                                </div>
                                <div class="form-group col-md-4 required">
                                    <label class="control-label" for="district">District: </label>
                                    <?=$form->field($basic,'district')->textInput(['class'=>'form-control'])->label(false)?>
                                   
                                </div>
                                <div class="form-group col-md-4 required">
                                    <label class="control-label" for="ward">Ward: </label>
                                    <?=$form->field($basic,'ward')->textInput(['class'=>'form-control'])->label(false)?>
                                   
                                </div>
                            </div>


                            <div class="form-row mt-3">
                                <div class="form-group col-md-12 required">
                                    <label class="control-label" for="marital_status">Marital Status: </label>
                                    <?=$form->field($basic,'maritalstatus')->dropDownList(['single'=>'Single','married'=>'Married','divorced'=>'Divorced'],['class'=>'form-control','prompt'=>'--Marital Status--'])->label(false)?>
                                 
                                </div>
                                </div>
                                </div>
                               </div>
                                <div class="form-row row mt-3">
                                <div class="form-group col-md-12 required">
                                    <label class="control-label ml-3" for="disabilities">Disabilities: </label><br />
                                    <div class="form-check form-check-inline">
                                    <?=$form->field($disab,'DEAFBLIND')->checkbox(['class'=>'form-check-input','id'=>'deaf_blind'])->label(false)?>
                                        <label class="form-check-label" for="deaf_blind">DEAF - BLIND</label>
                                    </div>
                                    <div class="form-check form-check-inline form-group">
                                    <?=$form->field($disab,'MULTIIMPARED')->checkbox(['class'=>'form-check-input form-control'])->label(false)?>
                                        <!--<input class="form-check-input" type="checkbox" value="" id="multi_impared">-->
                                        <label class="form-check-label" for="multi_impared">MULTI IMPARED</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                    <?=$form->field($disab,'ALBINO')->checkbox(['class'=>'form-check-input'])->label(false)?>
                                        <!--<input class="form-check-input" type="checkbox" value="" id="albino">-->
                                        <label class="form-check-label" for="albino">ALBINO</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                    <?=$form->field($disab,'VISUALLYIMPARED')->checkbox(['class'=>'form-check-input'])->label(false)?>
                                        <!--<input class="form-check-input" type="checkbox" value="" id="visually_impared">>-->
                                        <label class="form-check-label" for="visually_impared">VISUALLY IMPARED</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                    <?=$form->field($disab,'PHYSICALLYIMPARED')->checkbox(['class'=>'form-check-input'])->label(false)?>
                                        <!--<input class="form-check-input" type="checkbox" value=""
                                            id="physically_impared">-->
                                        <label class="form-check-label" for="physically_impared">PHYSICALLY
                                            IMPARED</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                    <?=$form->field($disab,'HEARINGIMPARED')->checkbox(['class'=>'form-check-input'])->label(false)?>
                                        <!--<input class="form-check-input" type="checkbox" value="" id="hearing_impared">-->
                                        <label class="form-check-label" for="hearing_impared">HEARING IMPARED</label>
                                    </div>
                                </div>
                                </div>
                            

                     

                    <div class="form-row">
                        <h2 class="font-weight-bold">Education Information</h2>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-4 required required">
                            <label for="education_level" class="control-label">Education Level: </label>
                            <?=$form->field($educ,'level')->textInput(['class'=>'form-control'])->label(false)?>
                          
                        </div>
                        <div class="form-group col-md-4 required">
                            <label class="control-label" for="education_type">Education Type: </label>
                            <?=$form->field($educ,'type')->textInput(['class'=>'form-control'])->label(false)?>
                            
                        </div>

                        <div class="form-group col-md-4 required">
                            <label class="control-label" for="intake">Intake: </label>
                            <?=$form->field($educ,'intake')->textInput(['class'=>'form-control'])->label(false)?>
                           
                        </div>
                    </div>

                    <div class="form-row mt-5">
                        <h2 class="font-weight-bold">Contact Information</h2>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6 required">
                            <label class="control-label" for="spose_address">Spouse Address: </label>
                            <?=$form->field($basic,'spouseaddress')->textInput(['class'=>'form-control'])->label(false)?>
                            
                        </div>
                        <div class="form-group col-md-6 required">
                            <label class="control-label" for="spouse_phone_number">Spouse Phone Number: </label>
                            <?=$form->field($basic,'spousephone')->textInput(['class'=>'form-control'])->label(false)?>
                        </div>
                    </div>

                    <div class="form-row mt-5">
                        <h2 class="font-weight-bold">Parent / Guardian Information</h2>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-3 required">
                            <label class="control-label" for="phone">First Name: </label>
                            <?=$form->field($guard,'fname')->textInput(['class'=>'form-control'])->label(false)?>
                            
                        </div>
                        <div class="form-group col-md-3 required">
                            <label class="control-label" for="phone">Middle Name: </label>
                            <?=$form->field($guard,'mname')->textInput(['class'=>'form-control'])->label(false)?>
                            
                        </div>
                        <div class="form-group col-md-3 required">
                            <label class="control-label" for="phone">Last Name: </label>
                            <?=$form->field($guard,'lname')->textInput(['class'=>'form-control'])->label(false)?>
                            
                        </div>
                        <div class="form-group col-md-3 required">
                            <label class="control-label" for="phone">Physical Address: </label>
                            <?=$form->field($guard,'address')->textInput(['class'=>'form-control'])->label(false)?>
                           
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-3 required">
                            <label class="control-label" for="parent_email">Parent Email: </label>
                            <?=$form->field($guard,'email')->textInput(['class'=>'form-control'])->label(false)?>
                        </div>
                        <div class="form-group col-md-3 required">
                            <label class="control-label" for="parent_mobile_number">Parent Mobile Number: </label>
                            <?=$form->field($guard,'phone')->textInput(['class'=>'form-control'])->label(false)?>
                        </div>
                        <div class="form-group col-md-3 required">
                            <label class="control-label" for="parent_occupation">Parent Occupation: </label>
                            <?=$form->field($guard,'occupation')->textInput(['class'=>'form-control'])->label(false)?>
                        </div>
                        <div class="form-check form-check-inline">

                            <?=$form->field($guard,'disabled')->checkbox(['class'=>'form-check-input','value'=>'yes'])->label(false)?>
                            <label class="form-check-label" for="has_disability">Parent has disability?</label>
                        </div>
                    </div>

                    <div class="form-row mt-5">
                        <h2 class="font-weight-bold">Background Information</h2>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-12 required">
                            <label class="control-label" for="employment_status">Employment Status: </label>
                            <?=$form->field($back,'employstatus')->dropDownList(['employed'=>'Employed','unemployed'=>'Unemployed','student'=>'Student'],['class'=>'form-control','prompt'=>'--Employment Status--'])->label(false)?>
                
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-12">
                        <div class="form-check form-check-inline">
                                <?=$form->field($back,'theory')->checkbox(['class'=>'form-check-input'])->label(false)?>
                                <label class="form-check-label" for="theoretical_knowledge">Does the student has a theoretical knowledge of this course?</label>
                          </div>
                          <div class="form-check form-check-inline">
                                <?=$form->field($back,'prac')->checkbox(['class'=>'form-check-input'])->label(false)?>
                                <label class="form-check-label" for="practical_knowledge">Does the student has a practical knowledge of this course?</label>
                         </div>
                        </div>
                        </div>

                    <div class="form-row mt-5">
                        <h2 class="font-weight-bold">Status</h2>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-4 required">
                            <label class="control-label" for="employment_status">Status: </label>
                            <?=$form->field($status,'status')->dropDownList(['Continuing'=>'Continuing','Completed'=>'Completed'],['class'=>'form-control','prompt'=>'--Status--'])->label(false)?>
                              
                        </div>
                        <div class="form-group col-md-8 required">
                            <label class="control-label" for="employment_status">Employment status after training: </label>
                            <?=$form->field($status,'employmentstatsafter')->dropDownList(['Unemployed'=>'Unemployed','Employed'=>'Employed'],['class'=>'form-control','prompt'=>'--Employment Status After Training--'])->label(false)?>
                            
                        </div>
                    </div>


                </div>
            </div>
    </div>
    <?php ActiveForm::end() ?>
    </div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
        integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"
        integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"
        integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl"
        crossorigin="anonymous"></script>
</body>

</html>