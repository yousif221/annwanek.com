@extends('layouts.admin.app')
@section('title', 'Website Configuration')
@section('css')
    <link href="{{asset('a-asset/css/plugins/dropzone.css')}}">
    <style>
        .dz-success-mark {
            display: none;
        }
        .dz-error-mark {
            display: none;
        }
        .dz-error-message{
            display: none;
        }
        .dz-details{
            display: none;
        }
        .dz-default.dz-message img {
    width: 80px;
}
    </style>
@endsection
@section('content')
    <div class="content">
        <div class="block block-rounded">
            <div class="block-content block-content-full bg-pattern">
                <div class="py-20">
                    <div class="py-20">
                        <div class="block">
                            <ul class="nav nav-tabs nav-tabs-alt" data-toggle="tabs" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link @if(!$errors->has('commission')) active @endif" href="#website-config"><i class="si si-settings mr-5"></i>Website Configuration</a>
                                </li>
                            </ul>
                            <div class="block-content tab-content">
                                <div class="tab-pane fade fade-up @if(!$errors->has('commission')) show active @endif" id="website-config" role="tabpanel">
                                    <div class="row">
                                        <div class="col-md-8">
                                            <h2 class="font-w700 text-black m-20">
                                                Website Configuration
                                            </h2>
                                            <form method="POST" action="{{route('admin.updateConfig')}}">
                                                <div class="form-material form-material-primary floating m-20">
                                                    <input type="text" class="form-control" name="website_name" value="{{getConfig('website_name')}}" required>
                                                    <label for="material-color-primary2">Website Title</label>
                                                </div>
                                                @csrf
                                                <div class="form-material form-material-primary floating m-20">
                                                    <input type="text" class="form-control" name="address" value="{{getConfig('address')}}" required>
                                                    <label for="material-color-primary2">Address</label>
                                                </div>
                                                <div class="form-material form-material-primary floating m-20">
                                                    <input type="email" class="form-control" name="primary_email" value="{{getConfig('primary_email')}}" required>
                                                    <label for="material-color-primary2">Primary Email (Contact Email)</label>
                                                </div>
                                                <!-- <div class="form-material form-material-primary floating m-20">
                                                    <input type="email" class="form-control" name="primary_email" value="{{getConfig('primary_email')}}" required>
                                                    <label for="material-color-primary2">Primary Email (Contact Email)</label>
                                                </div>
                                                <div class="form-material form-material-primary floating m-20">
                                                    <input type="email" class="form-control" name="secondary_email" value="{{getConfig('secondary_email')}}" required>
                                                    <label for="material-color-primary2">Secondary Email (Contact Email)</label>
                                                </div> -->
                                                <!-- <div class="form-material form-material-primary floating m-20">
                                                    <input type="text" class="form-control" name="open_hours" value="{{getConfig('open_hours')}}" required>
                                                    <label for="material-color-primary2">open_hours </label>
                                                </div>

                                                <div class="form-material form-material-primary floating m-20">
                                                    <input type="text" class="form-control" name="days" value="{{getConfig('days')}}" required>
                                                    <label for="material-color-primary2">Sunday </label>
                                                </div>
                                                <div class="form-material form-material-primary floating m-20">
                                                    <input type="text" class="form-control" name="live_location" value="{{getConfig('live_location')}}" required>
                                                    <label for="material-color-primary2">Map</label>
                                                </div> -->
                                             
                                                <!-- <div class="form-material form-material-primary floating m-20">
                                                    <input type="tel" class="form-control Phone" name="contact" value="{{getConfig('contact')}}" required>
                                                    <label for="material-color-primary2">Tel</label>
                                                </div>
                                                <div class="form-material form-material-primary floating m-20">
                                                    <input type="tel" class="form-control tel" name="fax" value="{{getConfig('fax')}}" required>
                                                    <label for="material-color-primary2">Fax</label>
                                                </div> -->
                                              
                                                   <div class="form-material form-material-primary floating m-20">
                                                    <input type="text" class="form-control" name="copy_right" value="{{getConfig('copy_right')}}" required>
                                                    <label for="material-color-primary2">@Copy Right</label>
                                                </div>
                                                <div class="form-material form-material-primary floating m-20">
                                                    <input type="text" class="form-control" name="tag_line" value="{{getConfig('tag_line')}}" required>
                                                    <label for="material-color-primary2">Footer text</label>
                                                </div>
                                                
                                       
                                       
                                                <!-- <div class="form-group row">   
                                                    <div class="col-md-12">
                                                        <div class="form-material floating m-20">
                                                            <textarea class="form-control" name="short_description" rows="8" value="">{{getConfig('short_description')}}</textarea>
                                                            <label>Footer Newleeter Text</label>
                                                        </div>
                                                    </div>
                                                </div> -->
                                                <h4>Socials</h4>

                                                <div class="form-material form-material-primary floating m-20">
                                                    <input type="text" class="form-control" name="facebook" value="{{getConfig('facebook')}}" required>
                                                    <label for="material-color-primary2">Facebook</label>
                                                </div>


                                                <!-- <div class="form-material form-material-primary floating m-20">
                                                    <input type="text" class="form-control" name="twitter" value="{{getConfig('twitter')}}" required>
                                                    <label for="material-color-primary2">Twitter</label>
                                                </div> -->

                                        
                                                <!-- <div class="form-material form-material-primary floating m-20">
                                                    <input type="text" class="form-control" name="insta" value="{{getConfig('insta')}}" required>
                                                    <label for="material-color-primary2">Instagram </label>
                                                </div> -->
                                                <!-- <div class="form-material form-material-primary floating m-20">
                                                    <input type="text" class="form-control" name="link" value="{{getConfig('link')}}" required>
                                                    <label for="material-color-primary2">LinkedIn </label>
                                                </div> -->
                                        
                                                <input type="submit" value="Update Configuration" class="btn btn-primary pull-right mt-20">
                                            </form>
                                        </div>
                                        <div class="col-md-4 text-center">
                                            <div class="block">
                                                <div class="block-content block-content-full">
                                                    <form class="dropzone" id="logo"style="background-color:#000;" action="{{route('admin.updateLogo')}}">@csrf</form>
                                                    <small>Click on the image to upload a new Logo.</small>
                                                </div>
                                            </div>
                                            <div class="block">
                                                <div class="block-content block-content-full">
                                                    <form class="dropzone" id="favicon" action="{{route('admin.updateLogo')}}">@csrf</form>
                                                    <small>Click on the image to upload a new Favicon.</small>
                                                </div>
                                            </div>
                                            <!-- <div class="block">
                                                <div class="block-content block-content-full">
                                                    <form class="dropzone" style="background-color:#0d1a43;" id="FooterLogo" action="{{route('admin.updateLogo')}}">@csrf</form>
                                                    <small>Click on the image to upload a new Footer Logo.</small>
                                                </div>
                                            </div> -->
                                         
                                        </div>
                                    </div>
                                </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')
    <script src="{{asset('a-asset/js/plugins/dropzone.min.js')}}"></script>
    <script>
        Dropzone.options.logo = {
            paramName: "logo",
            dictDefaultMessage: "<img src='{{asset(getConfig('logo'))}}' />",
            maxFiles: 1,
            acceptedFiles: 'image/png',
            thumbnailWidth: null,
            thumbnailHeight: null,
            init: function() {
                this.on("thumbnail", function(file, dataUrl) {
                    $('.dz-image').last().find('img').attr({width: '205px', height: '90px'});
                });
                this.on("maxfilesexceeded", function(file){
                    this.removeFile(file);
                    alert("No more files please!");
                });
            }
        };
        Dropzone.options.FooterLogo = {
            paramName: "footer_logo",
            dictDefaultMessage: "<img src='{{asset(getConfig('footer_logo'))}}'  />",
            maxFiles: 1,
            acceptedFiles: 'image/png',
            thumbnailWidth: null,
            thumbnailHeight: null,
            init: function() {
                this.on("thumbnail", function(file, dataUrl) {
                    $('.dz-image').last().find('img').attr({width: '205px', height: '90px'});
                });
                this.on("maxfilesexceeded", function(file){
                    this.removeFile(file);
                    alert("No more files please!");
                });
            }
        };
        Dropzone.options.favicon = {
            paramName: "favicon",
            dictDefaultMessage: "<img src='{{asset(getConfig('favicon'))}}' />",
            maxFiles: 1,
            acceptedFiles: 'image/png',
            init: function() {
                this.on("thumbnail", function(file, dataUrl) {
                    $('.dz-image').last().find('img').attr({width: '32px', height: '32px'});
                });
                this.on("maxfilesexceeded", function(file){
                    this.removeFile(file);
                    alert("No more files please!");
                });
            }
        };
    </script>



<script src="https://cdnjs.cloudflare.com/ajax/libs/cleave.js/1.6.0/cleave.min.js"></script>
<script type="text/javascript">
      var cleave = new Cleave('.tel', {

numericOnly: true,

delimiters: ['-', '-', ' '],

blocks: [4, 3, 4]

});
</script>
<script type="text/javascript">
      var cleave = new Cleave('.Phone', {

numericOnly: true,

delimiters: ['-', '-', ' '],

blocks: [4, 3, 4]

});
</script>
@endsection

