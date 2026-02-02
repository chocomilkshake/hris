$(document).ready(function(){

    // Load Regions on page load
    $.ajax({
        url: "include/fetch_regions.php",
        method: "GET",
        success: function(data){
            $("#region").html(data);
        }
    });

    // Region → Province
    $("#region").change(function(){
        var region_id = $(this).val();
        $.ajax({
            url: "include/fetch_provinces.php",
            method: "POST",
            data: {region_id: region_id},
            success: function(data){
                $("#province").html(data);
                $("#city").html('<option value="">Select City</option>');
                $("#barangay").html('<option value="">Select Barangay</option>');
            }
        });
    });

    // Province → City
    $("#province").change(function(){
        var province_id = $(this).val();
        $.ajax({
            url: "include/fetch_cities.php",
            method: "POST",
            data: {province_id: province_id},
            success: function(data){
                $("#city").html(data);
                $("#barangay").html('<option value="">Select Barangay</option>');
            }
        });
    });

    // City → Barangay
    $("#city").change(function(){
        var city_id = $(this).val();
        $.ajax({
            url: "include/fetch_barangays.php",
            method: "POST",
            data: {city_id: city_id},
            success: function(data){
                $("#barangay").html(data);
            }
        });
    });

});