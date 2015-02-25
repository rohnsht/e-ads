<?php
    $appId = substr(number_format(time()*rand(),0,'',''),0,10);
    $appKey = md5($appId * rand(100,999));
?>

<div id="myModal" class="modal fade" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title">Create Advertisement</h4>
            </div>
            <div class="modal-body">
            {{ Form::open(['class'=>'form-horizontal','route'=>'publisher-postApps']) }}
                <div class="form-group">
                    <div class="col-md-3">
                        <i class="fa fa-archive" style="font-size:100px"></i>
                    </div>
                    <div class="col-md-4">
                        <h3>App ID</h3>
                        <input type="text" name="appid" value="{{ $appId }}" class="form-control" readonly/>
                    </div>
                    <div class="col-md-5">
                        <h3>App key</h3>
                        <input type="text" name="appkey" value="{{ $appKey }}" class="form-control" readonly/>
                    </div>
                </div>
                <div class="form-group">
                    <label for="title" class="col-sm-12">App Name:</label>
                    <div class="col-md-12" id="title-group">
                        <input type="text" id="title" name="title" class="form-control"/>
                        <span class="error" id="title-error">
                            @if($errors->has('title'))
                                {{ $errors->first('title') }}
                            @endif
                        </span>
                    </div>
                </div>
                <div class="alert alert-warning">
                    <p><i class="fa fa-exclamation-circle"></i> Please choose your category wisely or unwanted advertisements may be displayed in 
                    your website. You alone will responsible for that.</p>
                </div>
                <div class="form-group">
                    <label for="category" class="col-sm-12">Category:</label>
                    <div class="col-md-12">
                        <select id="category" name="category" class="form-control">
                            <option value="Art & Entertainment">Art & Entertainment</option>
                            <option value="Beauty & Personal Care">Beauty & Personal Care</option>
                            <option value="Clothing">Clothing</option>
                            <option value="Computers & Electronics">Computers & Electronics</option>
                            <option value="Finance">Finance</option>
                            <option value="Food & Groceries">Food & Groceries</option>
                            <option value="Health">Health</option>
                            <option value="Internet & Telecom">Internet & Telecom</option>
                            <option value="Jobs & Education">Jobs & Education</option>
                            <option value="News & Media">News & Media</option>
                            <option value="Real Estate">Real Estate</option>
                            <option value="Sports & Fitness">Sports & Fitness</option>
                            <option value="Travel & Tourism">Travel & Tourism</option>
                            <option value="Vehicles">Vehicles</option>
                        </select>
                    </div>
                </div>    
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Create</button>
            {{ Form::close() }}
            </div>
            </div>
        </div>
    </div>