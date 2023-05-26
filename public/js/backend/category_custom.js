// add categories details

$('#add_categories').submit(function(e){
e.preventDefault();
var form = $('#add_categories')[0];
var path = $('meta[name="base_url"]').attr('content')+'/category';
var formData = new FormData(form);

$.ajax({
    url:path,
    method:"POST",
    data:formData,
    processData:false,
    contentType:false,
    success:function(data){
        console.log(data);
      toastr.success("Category Added Successfully!","Success");
      $('#add_categories')[0].reset();
    },
    error:function(xhr){
        $('.err').html('');
        $.each(xhr.responseJSON.errors, function (key, value) {
            $('.' + key).append('<div class="text-danger err">' + value + '</div>')
        });
    }
});
});



//category update details

$('#edit_categories').submit(function(e){
    e.preventDefault();
    var id = $('#category_id').data('category_id');
    var form = $('#edit_categories')[0];
    var path = $('meta[name="base_url"]').attr('content')+'/category'+'/'+id;
    var formData = new FormData(form);
    $.ajax({
        url:path,
        method:"POST",
        data:formData,
        processData:false,
        contentType:false,
        success:function(data){
            console.log(data);
          toastr.success("Category Updated Successfully!","Success");

        },
        error:function(xhr){
            $('.err').html('');
            $.each(xhr.responseJSON.errors, function (key, value) {
                $('.' + key).append('<div class="text-danger err">' + value + '</div>')
            });
        }
    });
    });