@extends('layouts.front.app')
@section('title','Add Business')
@section('css')
<link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet" />
<link href="https://cdn.jsdelivr.net/npm/@yaireo/tagify/dist/tagify.css" rel="stylesheet">

<style>
  .Add-business-txt .rad {
    display: flex !important
;
    align-items: baseline;
    gap: 10px !important;
}
.Add-business-txt .rad input {
    width: auto !important;
}
.Add-business-txt .rad label {
    display: flex
!important;
    align-items: baseline;
    gap: 20px !important; 
}
tags.tagify.tagify--noTags.tagify--empty {
    width: 864px;
}
/* Add custom styling for Select2 */
.select2-container {
    width: 100% !important;  /* Force full width */
}

.select2-selection {
    height: auto !important;  /* Adjust height for content */
}
button#addMenuItemButton {
    background: black;
    color:white;
}
button.btn.btn-danger.removeMenuItemButton {
  background: red;
    color:white;
}
.error{
  color:red  !important;
}
.hide{
  color: white;
  width: 0; height: 0; opacity: 0;
  
}
.Add-business-txt select {
    width: 80% !important;
    padding: 12px;
    margin-bottom: 30px;
    border: 1px solid #000;
}

#sub {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 5px; /* Adds a small gap between text and spinner */
}

#spinner {
    display: inline-block; /* Ensure spinner is inline with the button text */
}

.spinner-border-sm {
    width: 1.2rem;
    height: 1.2rem;
}
</style>
@endsection
@section('content')

   <!-- banner start -->
   <section class="main_slider inn">
      <div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-inner">
          <div class="carousel-item">
            <img src="{{asset($banner->image)}}" class="img-fluid" alt="...">
             <div class="carousel-caption">
              <div class="container">
                <div class="row">
                  <div class="col-xs-12 col-sm-6 col-md-12 align-self-center">
                    <div class="banner_text wow fadeInLeft" data-wow-duration="2s">
                      <h1>{{$banner->title}}</h1>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>                 
        </div>
      </div>
    </section>
    <!-- banner end -->




    <!-- Add-business end -->
    <section class="Add-business">
  <div class="container">
    <div class="row">
      <div class="col-12 col-lg-10 col-md-10">
        <div class="Add-business-txt">
          <h5>Add Business</h5>
          <p>Location details</p>
          <form id="addBusinessForm" action="{{ route('addbussiness') }}"  method="POST" enctype="multipart/form-data">
            @csrf
            <div class="Business-form">
              <label>Business Name</label>
              <input type="text" name="business_name" >
              <br>
              @error('business_name')
        <span class="text-danger">{{ $message }}</span>
        @enderror
     <!-- Form HTML for Tags -->

              <label>Business Tags</label>
              <input type="text" id="business-tags" name="business_tags" value="{{ old('business_tags') }}">
              <br>
              @error('business_tags')
              <span class="text-danger">{{ $message }}</span>
              @enderror
              <br>
   
        
              <label>Upload Logo</label>
              <button class="selectImage" id="logoFileName" type="button" data-target="logoInput">
                <div class="imgArea" data-title="">
                  <img src="{{ asset('web-assets/images/upload.png') }}" alt="" class="uplod-img">
                </div>
              </button>
              
              <input type="file" name="logo" id="logoInput" class="hide" accept="image/*">
              <br>
              @error('logo')
        <span class="text-danger">{{ $message }}</span>
        @enderror
              <span id="logoFileName" class="file-name"></span>

              <label>Upload Image of your Business</label>
              <button class="selectImage" id="businessImageFileName" type="button" data-target="businessImageInput">
                <div class="imgArea" data-title="">
                  <img src="{{ asset('web-assets/images/upload.png') }}" alt="" class="uplod-img">
                </div>
              </button>
              <input type="file" name="business_image" id="businessImageInput" class="hide" accept="image/*">
            
            <br>  @error('business_image')
        <span class="text-danger">{{ $message }}</span>
        @enderror
              <span id="businessImageFileName" class="file-name"></span>

              <label>Upload Image of your Menu</label>
              <button class="selectImage" id="menuFileName" type="button" data-target="menuImageInput">
                <div class="imgArea" data-title="">
                  <img src="{{ asset('web-assets/images/upload.png') }}" alt="" class="uplod-img">
                </div>
              </button>
              <input type="file" name="menu_image" id="menuImageInput" class="hide" accept="image/*">
           <br>   @error('menu_image')
        <span class="text-danger">{{ $message }}</span>
        @enderror
              <span id="menuFileName" class="file-name"></span>

              <label>Upload Image of your Interior</label>
              <button class="selectImage" id="interiorImageFileName" type="button" data-target="interiorImageInput">
                <div class="imgArea" data-title="">
                  <img src="{{ asset('web-assets/images/upload.png') }}" alt="" class="uplod-img">
                </div>
              </button>
              <input type="file" name="interior_image" id="interiorImageInput" class="hide" accept="image/*">
              <br>   @error('interior_image')
        <span class="text-danger">{{ $message }}</span>
        @enderror
              <span id="interiorImageFileName" class="file-name"></span>

              <h6>Which category describes this place?</h6>
              <div class="row rad">
                
                @forelse($categories as $category)
                <div class="col-3 rad">
                <input type="radio" id="{{$category->name}}" name="category_id" value="{{$category->id}}" >
                <label for="restaurant"><img style="width:40px;height:40px;" src="{{ asset($category->small_image) }}" alt="">{{$category->name}}</label><br>
                </div>
                @empty
                <p>Not Category Available</p>
                @endforelse  

       
              </div>
              <label id="category_id-error" class="error" for="category_id"style="display:none">Please select a category.</label>
              <br>   @error('category_id')
        <span class="text-danger">{{ $message }}</span>
        @enderror
              <label>Start Time</label>
              <input type="time" name="start_time" >
              <br>   @error('start_time')
        <span class="text-danger">{{ $message }}</span>
        @enderror

              <label>End Time</label>
              <input type="time" name="end_time" >
              <br>   @error('end_time')
        <span class="text-danger">{{ $message }}</span>
        @enderror

              <label>Address</label>
              <input type="text" name="address" >
              <br>   @error('address')
        <span class="text-danger">{{ $message }}</span>
        @enderror

        <label>City</label>
              <input type="text" name="town" >
              <br>   @error('town')
        <span class="text-danger">{{ $message }}</span>
        @enderror

        <label>Map Location Url</label>
              <input type="text" name="map" >
              <br>   @error('map')
        <span class="text-danger">{{ $message }}</span>
        @enderror
        <label>Business State</label>
              <select  name="state" >
                <option value="" disabled selected></option>
                @foreach ($states as $state)
                <option value="{{$state->id}}">{{$state->name}}</option>

                @endforeach
              </select>
              <br>
              @error('business_name')
        <span class="text-danger">{{ $message }}</span>
        @enderror
              <h4>Are you an owner, employee, or official representative of this place?</h4>
              <div class="check">
               
                <p> <input type="checkbox" class="check" style="width:40px !important;" name="checkbox">Yes! I am representative of this place</p>
              </div>
              <br>   @error('checkbox')
        <span class="text-danger">{{ $message }}</span>
        @enderror



        <div class="menu-section">
    <h4>Menu Items</h4>
    <div id="menuItemsContainer">
        <!-- Preload the first menu item -->
        <div class="menu-item" data-index="0">
            <div class="form-group">
                <label for="menuItemName0">Item Name</label>
                <input type="text" name="menu_items[0][name]" id="menuItemName0" class="form-control" placeholder="Enter item name" value="{{ old('menu_items.0.name') }}">
                @error("menu_items.0.name")
                <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="form-group">
                <label for="menuItemDescription0">Item Description</label>
                <textarea name="menu_items[0][description]" id="menuItemDescription0" class="form-control" placeholder="Enter item description">{{ old('menu_items.0.description') }}</textarea>
                @error("menu_items.0.description")
                <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="form-group">
                <label for="menuItemPrice0">Price</label>
                <input type="number" name="menu_items[0][price]" id="menuItemPrice0" class="form-control" placeholder="Enter price" value="{{ old('menu_items.0.price') }}">
                @error("menu_items.0.price")
                <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <!-- <button type="button" class="btn btn-danger removeMenuItemButton">Remove</button> -->
        </div>
    </div>
    <button type="button" id="addMenuItemButton" class="add">Add Menu Item</button>
</div>
      
              <label>Website</label>
              <input type="text" name="website_url" placeholder="Optional">

              <label>Official Phone</label>
              <input type="text" class="Phone" name="number" placeholder="Optional">

              <label>Official Email</label>
              <input type="email" name="email" placeholder="Optional">
          
              <label>Description</label>
              <textarea type="text" name="short_description" placeholder="Type..."></textarea>
              <button class="sub" id="sub" type="submit">Submit
              <div id="spinner" style="display: none;"> <!-- Placeholder for spinner (could be a CSS spinner) -->
    <div class="spinner-border" role="status">
        <span class="visually-hidden">Loading...</span>
    </div>
</div></button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</section>

@endsection
@section('js')

<script src="https://cdn.jsdelivr.net/npm/@yaireo/tagify"></script>

<script>
// Handle button clicks to trigger file input dialogs
const setupFileInput = (inputId, fileNameId) => {
  const fileInput = document.getElementById(inputId);
  const fileNameSpan = document.getElementById(fileNameId);

  document.querySelector(`button[data-target="${inputId}"]`).addEventListener('click', () => {
    fileInput.click(); // Trigger the file input dialog
  });

  fileInput.addEventListener('change', () => {
    const fileName = fileInput.files[0]?.name || "No file selected";
    fileNameSpan.textContent = fileName; // Update the corresponding file name display
  });
};

// Initialize all file inputs
setupFileInput('logoInput', 'logoFileName');
setupFileInput('businessImageInput', 'businessImageFileName');
setupFileInput('menuImageInput', 'menuFileName');
setupFileInput('interiorImageInput', 'interiorImageFileName');
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/cleave.js/1.6.0/cleave.min.js"></script>
<script type="text/javascript">
      var cleave = new Cleave('.Phone', {

numericOnly: true,

delimiters: ['-', '-', ' '],

blocks: [3, 3, 4]

});
</script>

<script>
  $(document).ready(function () {
    let menuItemCounter = 0; // Menu item counter

    // Add new menu item dynamically
    $('#addMenuItemButton').on('click', function () {
        menuItemCounter++;
        const newMenuItem = `
            <div class="menu-item">
                <div class="form-group">
                    <label>Item Name</label>
                    <input type="text" name="menu_items[${menuItemCounter}][name]" class="form-control" required>
                </div>
                <div class="form-group">
                    <label>Item Description</label>
                    <textarea name="menu_items[${menuItemCounter}][description]" class="form-control" required></textarea>
                </div>
                <div class="form-group">
                    <label>Price</label>
                    <input type="number" name="menu_items[${menuItemCounter}][price]" class="form-control" required>
                </div>
                <button type="button" class="btn btn-danger removeMenuItemButton">Remove</button>
            </div>`;
        $('#menuItemsContainer').append(newMenuItem);
    });

    // Remove menu item
    $(document).on('click', '.removeMenuItemButton', function () {
        $(this).closest('.menu-item').remove();
    });

    // AJAX form submission
    $('#addBusinessForm').on('submit', function (e) {
        e.preventDefault();
        const formData = new FormData(this);
        $('#sub').prop('disabled', true);
        $('#spinner').show();
        $.ajax({
            url: this.action,
            type: this.method,
            data: formData,
            processData: false,
            contentType: false,
            success: function (response) {
                if (response.success) {
                    toastr.success(response.message);
                    $('#addBusinessForm')[0].reset();
                        // Reset the file name display elements
                $('#logoFileName').text('No file selected');
                $('#businessImageFileName').text('No file selected');
                $('#menuFileName').text('No file selected');
                $('#interiorImageFileName').text('No file selected');
                } else {
                    $.each(response.errors, function (field, errors) {
                        errors.forEach(error => toastr.error(error));
                    });
                }
            },
            error: function (xhr) {
                toastr.error('Something went wrong. Please try again.');
            },  
            complete: function() {
                // Re-enable submit button and hide spinner on error or success
                $('#sub').prop('disabled', false);
                $('#spinner').hide();
            }
        });
    });
});

</script>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const input = document.getElementById('business-tags');
        const tagify = new Tagify(input, {
            whitelist: [], // Initial empty whitelist
            placeholder: "Write or add tags",
            dropdown: {
                enabled: 0 // Disable dropdown suggestions by default
            }
        });

        // Listen for tag addition
        tagify.on('add', function(e) {
            const addedTag = e.detail.data.value;

            // Add '#' symbol if not already present
            if (!addedTag.startsWith('#')) {
                const tagWithHash = `#${addedTag}`;
                // Update the added tag with the '#' symbol
                tagify.addTags(tagWithHash);
                // Optionally, remove the original tag if you want to avoid duplicates
                tagify.removeTags(addedTag);
            }
            
            // Optionally, add the tag with '#' to the whitelist
            if (!tagify.whitelist.includes(tagWithHash)) {
                tagify.whitelist.push(tagWithHash);
            }
        });
    });
</script>

@endsection