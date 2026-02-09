@extends('layouts.agent')

@section('title', 'Create Listing')
@section('breadcrumb_title', 'Add New Listing')

@section('content')
<section>
    <div class="container">
        <div class="row">
            <div class="col">
                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif

                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('agent.listings.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="title">Property Title</label>
                        <input type="text" name="title" id="title" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label for="description">Description</label>
                        <textarea name="description" id="description" class="form-control" rows="4" required></textarea>
                    </div>

                    <div class="form-row">
                        <div class="col form-group">
                            <label for="purpose">Purpose</label>
                            <select name="purpose" id="purpose" class="form-control" required>
                                <option value="" disabled selected>Select an option</option>
                                <option value="sale">Sale</option>
                                <option value="rent">Rent</option>
                            </select>
                        </div>
                        <div class="col form-group">
                            <label for="property_type">Property Type</label>
                            <select name="property_type" id="property_type" class="form-control" required>
                                <option value="house">House</option>
                                <option value="apartment">Apartment</option>
                                <option value="commercial">Commercial</option>
                                <option value="villa">Villa</option>
                                <option value="land">Land</option>
                                <option value="others">Others</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group" id="salePrice" style="display: none;">
                        <label for="price">Price</label>
                        <input type="number" name="price" id="price" class="form-control" step="0.01">
                    </div>

                    <div class="form-group" id="rentPrice" style="display: none;">
                        <label for="price_per_month">Rent per Month</label>
                        <input type="number" name="price_per_month" id="price_per_month" class="form-control" step="0.01">
                    </div>

                    <div class="form-group">
                        <label for="area">Area (in sq ft)</label>
                        <input type="number" name="area" id="area" class="form-control" required>
                    </div>

                    <div class="form-row">
                        <div class="col form-group">
                            <label for="bedrooms">Bedrooms</label>
                            <input type="number" name="bedrooms" id="bedrooms" class="form-control" required>
                        </div> 
                        <div class="col form-group">
                            <label for="bathrooms">Bathrooms</label>
                            <input type="number" name="bathrooms" id="bathrooms" class="form-control" required>
                        </div> 
                    </div>

                    <div class="form-group">
                        <label for="garage">Garage</label>
                        <select name="garage" id="garage" class="form-control" required>
                            <option value="" disabled selected>Select an option</option>
                            <option value="yes">Yes</option>
                            <option value="no">No</option>
                        </select>
                    </div>

                    <div class="col form-group" id="garageDetails" style="display: none;">
                        <label for="garage_count">Number of Garages</label>
                        <input type="number" name="garage_count" id="garage_count" class="form-control">
                    </div> 

                    <div class="form-row">
                        <div class="col form-group">
                            <label for="address">Address</label>
                            <input type="text" name="address" id="address" class="form-control" required>
                        </div>
                        <div class="col form-group">
                            <label for="city">City</label>
                            <input type="text" name="city" id="city" class="form-control" required>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="col form-group">
                            <label for="state">State</label>
                            <select name="state" id="state" class="form-control" required>
                                <option value="" disabled selected>Select State/Province</option>
                                <option value="Punjab">Punjab</option>
                                <option value="Sindh">Sindh</option>
                                <option value="Khyber Pakhtunkhwa">Khyber Pakhtunkhwa</option>
                                <option value="Balochistan">Balochistan</option>
                                <option value="Gilgit-Baltistan">Gilgit-Baltistan</option>
                                <option value="Azad Kashmir">Azad Kashmir</option>
                                <option value="Islamabad Capital">Islamabad Capital</option>
                            </select>
                        </div>
                        <div class="col form-group">
                            <label for="zip_code">Zip Code</label>
                            <input type="text" name="zip_code" id="zip_code" class="form-control" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="year_built">Year Built</label>
                        <input type="number" name="year_built" id="year_built" class="form-control" min="1900" max="{{ date('Y') }}" required>
                    </div>

                    <div class="form-row">
                        <div class="col form-group">
                            <label for="video_link">Video Link</label>
                            <input type="url" name="video_link" id="video_link" class="form-control">
                        </div>

                        <div class="col form-group">
                            <label for="location_link">Location Link</label>
                            <input type="url" name="location_link" id="location_link" class="form-control">
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-4">
                                <h6>Main Features</h6>
                                <label class=" custom-control custom-checkbox">
                                    <input type="checkbox" name="features[]" value="Parking Spaces" id="parking_spaces" class="custom-control-input" onclick="toggleNumberField('parking_spaces_count')">
                                    <span class="custom-control-label">Parking Spaces</span>
                                    <input type="number" name="parking_spaces_count" id="parking_spaces_count" class="form-control" style="display:none;" placeholder="Number of Parking Spaces">
                                </label>
                                <label class=" custom-control custom-checkbox">
                                    <input type="checkbox" name="features[]" value="Double Glazed Windows" id="double_glazed_windows" class="custom-control-input">
                                    <span class="custom-control-label">Double Glazed Windows</span>
                                </label>
                                <label class=" custom-control custom-checkbox">
                                    <input type="checkbox" name="features[]" value="Central Air Conditioning" id="central_air_conditioning" class="custom-control-input">
                                    <span class="custom-control-label">Central Air Conditioning</span>
                                </label>
                                <label class=" custom-control custom-checkbox">
                                    <input type="checkbox" name="features[]" value="Central Heating" id="central_heating" class="custom-control-input">
                                    <span class="custom-control-label">Central Heating</span>
                                </label>
                                <label class=" custom-control custom-checkbox">
                                    <input type="checkbox" name="features[]" value="Flooring" id="flooring" class="custom-control-input">
                                    <span class="custom-control-label">Flooring</span>
                                </label>
                                <label class=" custom-control custom-checkbox">
                                    <input type="checkbox" name="features[]" value="Electricity Backup" id="electricity_backup" class="custom-control-input">
                                    <span class="custom-control-label">Electricity Backup</span>
                                </label>
                                <label class=" custom-control custom-checkbox">
                                    <input type="checkbox" name="features[]" value="Waste Disposal" id="waste_disposal" class="custom-control-input">
                                    <span class="custom-control-label">Waste Disposal</span>
                                </label>
                                <label class=" custom-control custom-checkbox">
                                    <input type="checkbox" name="features[]" value="Floors" id="floors" class="custom-control-input" onclick="toggleNumberField('floors_count')">
                                    <span class="custom-control-label">Floors</span>
                                    <input type="number" name="floors_count" id="floors_count" class="form-control" style="display:none;" placeholder="Number of Floors">
                                </label>
                                <label class=" custom-control custom-checkbox">
                                    <input type="checkbox" name="features[]" value="Other Main Features" id="other_main_features" class="custom-control-input">
                                    <span class="custom-control-label">Other Main Features</span>
                                </label>
                                <label class=" custom-control custom-checkbox">
                                    <input type="checkbox" name="features[]" value="Furnished" id="furnished" class="custom-control-input">
                                    <span class="custom-control-label">Furnished</span>
                                </label>
                            </div>

                            <!-- Rooms -->
                            <div class="col-md-4">
                                <h6>Rooms</h6>
                                <label class=" custom-control custom-checkbox">
                                    <input type="checkbox" name="features[]" value="Bedrooms" id="bedrooms" class="custom-control-input" onclick="toggleNumberField('bedrooms_count')">
                                    <span class="custom-control-label">Bedrooms</span>
                                    <input type="number" name="bedrooms_count" id="bedrooms_count" class="form-control" style="display:none;" placeholder="Number of Bedrooms">
                                </label>
                                <label class=" custom-control custom-checkbox">
                                    <input type="checkbox" name="features[]" value="Bathrooms" id="bathrooms" class="custom-control-input" onclick="toggleNumberField('bathrooms_count')">
                                    <span class="custom-control-label">Bathrooms</span>
                                    <input type="number" name="bathrooms_count" id="bathrooms_count" class="form-control" style="display:none;" placeholder="Number of Bathrooms">
                                </label>
                                <label class=" custom-control custom-checkbox">
                                    <input type="checkbox" name="features[]" value="Servant Quarters" id="servant_quarters" class="custom-control-input" onclick="toggleNumberField('servant_quarters_count')">
                                    <span class="custom-control-label">Servant Quarters</span>
                                    <input type="number" name="servant_quarters_count" id="servant_quarters_count" class="form-control" style="display:none;" placeholder="Number of Servant Quarters">
                                </label>
                                <label class=" custom-control custom-checkbox">
                                    <input type="checkbox" name="features[]" value="Drawing Room" id="drawing_room" class="custom-control-input">
                                    <span class="custom-control-label">Drawing Room</span>
                                </label>
                                <label class=" custom-control custom-checkbox">
                                    <input type="checkbox" name="features[]" value="Dining Room" id="dining_room" class="custom-control-input" onclick="toggleNumberField('dining_room_count')">
                                    <span class="custom-control-label">Dining Room</span>
                                    <input type="number" name="dining_room_count" id="dining_room_count" class="form-control" style="display:none;" placeholder="Number of Dining Rooms">
                                </label>
                                <label class=" custom-control custom-checkbox">
                                    <input type="checkbox" name="features[]" value="Kitchens" id="kitchens" class="custom-control-input" onclick="toggleNumberField('kitchens_count')">
                                    <span class="custom-control-label">Kitchens</span>
                                    <input type="number" name="kitchens_count" id="kitchens_count" class="form-control" style="display:none;" placeholder="Number of Kitchens">
                                </label>
                                <label class=" custom-control custom-checkbox">
                                    <input type="checkbox" name="features[]" value="Study Room" id="study_room" class="custom-control-input">
                                    <span class="custom-control-label">Study Room</span>
                                </label>
                                <label class=" custom-control custom-checkbox">
                                    <input type="checkbox" name="features[]" value="Prayer Room" id="prayer_room" class="custom-control-input">
                                    <span class="custom-control-label">Prayer Room</span>
                                </label>
                                <label class=" custom-control custom-checkbox">
                                    <input type="checkbox" name="features[]" value="Powder Room" id="powder_room" class="custom-control-input">
                                    <span class="custom-control-label">Powder Room</span>
                                </label>
                                <label class=" custom-control custom-checkbox">
                                    <input type="checkbox" name="features[]" value="Gym" id="gym" class="custom-control-input">
                                    <span class="custom-control-label">Gym</span>
                                </label>
                                <label class=" custom-control custom-checkbox">
                                    <input type="checkbox" name="features[]" value="Store Rooms" id="store_rooms" class="custom-control-input" onclick="toggleNumberField('store_rooms_count')">
                                    <span class="custom-control-label">Store Rooms</span>
                                    <input type="number" name="store_rooms_count" id="store_rooms_count" class="form-control" style="display:none;" placeholder="Number of Store Rooms">
                                </label>
                                <label class=" custom-control custom-checkbox">
                                    <input type="checkbox" name="features[]" value="Steam Room" id="steam_room" class="custom-control-input">
                                    <span class="custom-control-label">Steam Room</span>
                                </label>
                                <label class=" custom-control custom-checkbox">
                                    <input type="checkbox" name="features[]" value="Lounge or Sitting Room" id="lounge_or_sitting_room" class="custom-control-input">
                                    <span class="custom-control-label">Lounge or Sitting Room</span>
                                </label>
                                <label class=" custom-control custom-checkbox">
                                    <input type="checkbox" name="features[]" value="Laundry Room" id="laundry_room" class="custom-control-input">
                                    <span class="custom-control-label">Laundry Room</span>
                                </label>
                                <label class=" custom-control custom-checkbox">
                                    <input type="checkbox" name="features[]" value="Other Rooms" id="other_rooms" class="custom-control-input">
                                    <span class="custom-control-label">Other Rooms</span>
                                </label>
                            </div>

                            <!-- Community Features -->
                            <div class="col-md-4">
                                <h6>Community Features</h6>
                                <label class=" custom-control custom-checkbox">
                                    <input type="checkbox" name="features[]" value="Broadband Internet Access" id="broadband_internet" class="custom-control-input">
                                    <span class="custom-control-label">Broadband Internet Access</span>
                                </label>
                                <label class=" custom-control custom-checkbox">
                                    <input type="checkbox" name="features[]" value="Satellite or Cable TV Ready" id="satellite_tv" class="custom-control-input">
                                    <span class="custom-control-label">Satellite or Cable TV Ready</span>
                                </label>
                                <label class=" custom-control custom-checkbox">
                                    <input type="checkbox" name="features[]" value="Intercom" id="intercom" class="custom-control-input">
                                    <span class="custom-control-label">Intercom</span>
                                </label>
                                <label class=" custom-control custom-checkbox">
                                    <input type="checkbox" name="features[]" value="Community Lawn or Garden" id="community_lawn" class="custom-control-input">
                                    <span class="custom-control-label">Community Lawn or Garden</span>
                                </label>
                                <label class=" custom-control custom-checkbox">
                                    <input type="checkbox" name="features[]" value="Community Swimming Pool" id="community_swimming_pool" class="custom-control-input">
                                    <span class="custom-control-label">Community Swimming Pool</span>
                                </label>
                                <label class=" custom-control custom-checkbox">
                                    <input type="checkbox" name="features[]" value="Community Gym" id="community_gym" class="custom-control-input">
                                    <span class="custom-control-label">Community Gym</span>
                                </label>
                                <label class=" custom-control custom-checkbox">
                                    <input type="checkbox" name="features[]" value="First Aid or Medical Centre" id="first_aid_medical_centre" class="custom-control-input">
                                    <span class="custom-control-label">First Aid or Medical Centre</span>
                                </label>
                                <label class=" custom-control custom-checkbox">
                                    <input type="checkbox" name="features[]" value="Day Care Centre" id="day_care_centre" class="custom-control-input">
                                    <span class="custom-control-label">Day Care Centre</span>
                                </label>
                                <label class=" custom-control custom-checkbox">
                                    <input type="checkbox" name="features[]" value="Kids Play Area" id="kids_play_area" class="custom-control-input">
                                    <span class="custom-control-label">Kids Play Area</span>
                                </label>
                                <label class=" custom-control custom-checkbox">
                                    <input type="checkbox" name="features[]" value="Barbeque Area" id="barbeque_area" class="custom-control-input">
                                    <span class="custom-control-label">Barbeque Area</span>
                                </label>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="images">Upload Images</label>
                        <input type="file" name="images[]" id="images" class="form-control" multiple>
                    </div>

                    <button type="submit" class="btn btn-primary">Add Listing</button>
                </form>
            </div>
        </div>
    </div>
</section>

<script>
    document.getElementById('garage').addEventListener('change', function() {
        if (this.value === 'yes') {
            document.getElementById('garageDetails').style.display = 'block';
            document.getElementById('garageSize').style.display = 'block';
        } else {
            document.getElementById('garageDetails').style.display = 'none';
            document.getElementById('garageSize').style.display = 'none';
        }
    });

    document.getElementById('purpose').addEventListener('change', function() {
        if (this.value === 'rent') {
            document.getElementById('rentPrice').style.display = 'block';
            document.getElementById('salePrice').style.display = 'none';
        } else if (this.value === 'sale') {
            document.getElementById('salePrice').style.display = 'block';
            document.getElementById('rentPrice').style.display = 'none';
        }
    });

    function toggleNumberField(inputId) {
        var inputField = document.getElementById(inputId);
        if (inputField.style.display === "none") {
            inputField.style.display = "block";
        } else {
            inputField.style.display = "none";
        }
    }
</script>
@endsection
