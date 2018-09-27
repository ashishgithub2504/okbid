$(document).ready(function () {
    $("table td img").on("click", function () {
        $('#imagepreview').attr('src', $(this).attr('src')); // here asign the image to the modal when the user click the enlarge link
        $('#imagemodal').modal('show'); // imagemodal is the id attribute assigned to the bootstrap modal, then i use the show function
    });

    function myPrint() {
        window.print();
    }

    // add owner section
    var j = 0;
    $("#add-owner").click(function () {
        var input = '<div class="col-md-4"><div class="form-group"><div class="input text"><label class="req" for="property-owners-' + j + '-name">Full Name</label><input name="property_owners[' + j + '][name]" class="form-control" placeholder="Full Name" id="property-owners-' + j + '-name" type="text"></div></div></div>\n\
                     <div class="col-md-4"><div class="form-group"><div class="input text"><label class="req" for="property-owners-' + j + '-idno">ID No.</label><input name="property_owners[' + j + '][idno]" class="form-control" placeholder="ID No." id="property-owners-' + j + '-idno" type="text"></div></div></div>\n\
                     <div class="col-md-4"><div class="form-group"><div class="input text"><label class="req" for="property-owners-' + j + '-cell">Cell No.</label><input name="property_owners[' + j + '][cell]" class="form-control" placeholder="Cell No." id="property-owners-' + j + '-cell" type="text"></div></div></div>';

        $("#propowner").append(input);
        j++;
    });

    // tab history mentain
    $(".nav-tabs li").click(function () {
        localStorage.setItem('tab', $(this).attr('prop'));
    });
    var retrieveTab = localStorage.getItem('tab');

    if (retrieveTab != null && retrieveTab != 'undefined') {

        $(".nav-tabs li").removeClass('active');
        $(".nav-tabs li[prop='" + retrieveTab + "']").addClass("active");
        $(".nav-tabs li[prop='" + retrieveTab + "'] a").attr("aria-expanded", true);
        $(".tab-content div").removeClass("in active");
        $(".tab-content div[id='" + retrieveTab + "']").addClass("in active");
    }

    //Add/edit user js
    $('#managershow , #companyshow, .legal').hide();

    $("#legal").click(function () {
        $(".legal").toggle();
    });

    $("#role-id").change(function () {
        //alert($(this).val());
        if ($(this).val() == '3') {
            $('#managershow').show();
        } else {
            $('#managershow').hide();
        }

        if ($(this).val() == '6') {
            $('.companyshow').show();
        } else {
            $('.companyshow').hide();
        }

    });
    //Add user js

    // category / sub category 
    $("#category").change(function () {
        var category = $("#category").val();
        $.ajax({
            dataType: 'json',
            type: "POST",
            url: baseurl+'admin/propertycommisions/getsubcategory/?category_id=' + category,
            success: function (response) {
                 var html = '';
                 $.each(response,function(index, value){
                      console.log( index + ": " + response[index]['id'] );
                      html += '<option value="'+response[index]['id']+'">'+response[index]['name']+'</option>';
                 })
                $("#subcategory-id").html(html);
            }
        });
        
//        var html = '';
//        if ($(this).val() == 1) {
//            html = '<option value="">Please select</option><option value="residence">residence</option><option value="commercial">commercial</option>';
//        } else if ($(this).val() == 2) {
//            html = '<option value="">Please select</option><option value="sell">sell</option><option value="Rent">Rent</option>';
//        } else if ($(this).val() == 3) {
//            html = '<option value="">Please select</option><option value="residence">residence</option><option value="commercial">commercial</option><option value="other">other</option>';
//        } else if ($(this).val() == 5) {
//            html = '<option value="">Please select</option><option value="residence">residence</option><option value="commercial">commercial</option><option value="Grounds">Grounds</option>';
//        } else if ($(this).val() == 6) {
//            html = '<option value="">Please select</option><option value="Grounds for saturated construction">Grounds for saturated construction</option><option value="Grounds for privet construction">Grounds for privet construction</option><option value="National Outline Plan 38">National Outline Plan 38</option>';
//        }
//        
//        $("#sub-category").html(html);
    });
    
    
});