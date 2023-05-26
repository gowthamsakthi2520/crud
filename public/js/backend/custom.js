//  Add products details 

$('#add_products').submit(function (e) {

    e.preventDefault();
    var form = $('#add_products')[0];
    var formData = new FormData(form);
    var path = $('meta[name="base_url"]').attr('content') + '/products';
    

    $.ajax({
        url: path,
        method: 'POST',
        data: formData,
        processData: false,
        contentType: false,
        success: function (data) {
            // swal("Added!","Product Has Been Added Successfully");
            toastr.success("Product Has Been Added Successfully", "Added!");
            $('#add_products')[0].reset();
            $('.err').html('');
        },
        error: function (xhr) {
            $('.err').html('');
            $.each(xhr.responseJSON.errors, function (key, value) {
                $('.' + key).append('<div class="text-danger err">' + value + '</div>')
            });
        }
    });
});

// Product Update details

$('#edit_products').submit(function (e) {
    e.preventDefault();
    var id = $('#product_id').data('product_id');
    var form = $('#edit_products')[0];
    var path = $('meta[name="base_url"]').attr('content') + '/products'+'/'+id;
    var formData = new FormData(form);

    $.ajax({
        url:path,
        method:"POST",
        data:formData,
        processData: false,
        contentType: false,
        success: function (data) {
         toastr.success("Product Updated Successfully","Success");
        },
        error: function (data) {

        }

    });
});
