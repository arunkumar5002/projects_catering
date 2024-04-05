$(document).ready( function () {

    $('#menuListTable').DataTable();
    $('#vesselsListTable').DataTable();
    $('#categoryListTable').DataTable();
    $('#packageListTable').DataTable();
    $('#quoteListTable').DataTable();
    $('#invoiceListTable').DataTable();
    $('#kitchenOrderListTable').DataTable();
    $('#kitchenItemListTable').DataTable();
    
    $('.delete-btn').on('click', function(e) {
        e.preventDefault();
        var confirmed = confirm('Are you sure you want to delete this item?');
        if (confirmed) {
            window.location.href = $(this).attr('href');
        }
    });

    if(modules == 'package' && pages == 'package_add_edit') {
        
        // for package edit
        $('#pacakge_item_list').multiselect({
            nonSelectedText: 'None Selected',
            enableFiltering: true,
            enableCaseInsensitiveFiltering: true,
            includeSelectAllOption: true,
            includeResetOption: true,
        });

        var package_id = $('#edit_package_id').val();
        if(package_id != '') {
            $.ajax({
                url: base_url + "ajax/get_package_items",
                data: {package_id: package_id},
                type: "POST",
                dataType: "JSON",
                success: function (res) {
                    var obj = (res);
                    $('#package_add_eidt_form #edit_package_id').val(package_id);
                    $(obj.item_ids).each(function () {
                        $("#pacakge_item_list option[value='" + this + "']").attr("selected", true);
                        $("#pacakge_item_list").multiselect("refresh");
                    });
                },
                error: function () {            
                }
            });
        }
        /// end ///

    }
	
	if(modules == 'delivery' && pages == 'delivery_add') {
        
        // for package edit
        $('#pacakge_vessels_list').multiselect({
            nonSelectedText: 'None Selected',
            enableFiltering: true,
            enableCaseInsensitiveFiltering: true,
            includeSelectAllOption: true,
            includeResetOption: true,
        });

        var challan_id = $('#challan_id').val();
        if(challan_id != '') {
            $.ajax({
                url: base_url + "ajax/get_vessels_items",
                data: {challan_id: challan_id},
                type: "POST",
                dataType: "JSON",
                success: function (res) {
                    var obj = (res);
                    $('#DataForm #challan_id').val(challan_id);
                    $(obj.item_ids).each(function () {
                        $("#pacakge_vessels_list option[value='" + this + "']").attr("selected", true);
                        $("#pacakge_vessels_list").multiselect("refresh");
                    });
                },
                error: function () {            
                }
            });
        }
        /// end ///

    }

    if(modules == 'sales' && (pages == 'quote_list' )) {
        $('.row_quoteno' ).click(function() {
            $('#result_id').empty();
            var quote_no = $(this).data("quoteno_index");
            $.ajax({
                //url: base_url + "admin/salesquote",
                url: base_url + "admin/salesquote/get_quote_package_details",
                type: "POST",
                dataType : 'json',
                data: {quote_no: quote_no},
                success: function (data)
                {
                    $('#quote_no').val(quote_no);
                    $('#quotePackageDetailsModal').modal('show'); 
                    //$('#result_id').append(data);
                    var i=1
                    $.each(data, function() {
                        var tr = '<tr><td>' + i + '</td><td>'+ this.package_name + '</td><td>' + this.category_name + '</td><td>' + this.item_name + '</td></tr>';
                        i++;
                        $('#result_id').append(tr);
                    });
                    
                },
                error: function () {            
                }
            });


        });
    }

    if(modules == 'sales' && (pages == 'invoice_add_edit' || pages == 'quote_list' || pages == 'quote_add_edit' || pages == 'invoice_list')) {
       
        var package_count = $('#package_list_count').val();

        // package select
        $('#add_quotaion_form').on('change', '[id^=quote_package_name_]', function () {
            
            var quote_no = $('#quote_no').val();
            var packageIndex = $(this).data('package-index');
            var package_id = $(this).val();
            //console.log("Selected options for package " + packageIndex + ":", package_id);
            
            // $('#quote_package_category_' +packageIndex).prop('disabled', false);
            $('#package_items_txt_'+packageIndex).removeAttr('readonly');

            $('#package_items_assigned_form_'+packageIndex)[0].reset();
            $('#package_items_assigned_form_'+packageIndex).trigger('reset');
            $('#package_items_title_'+packageIndex).html('Package Menu Items');
            $('#package_items_'+packageIndex).multiselect('destroy');
            $('#package_items_'+packageIndex+' option:selected').removeAttr('selected');
            $('#pacakge_items_'+packageIndex).multiselect({
                nonSelectedText: 'None Selected',
                enableFiltering: true,
                enableCaseInsensitiveFiltering: true,
                includeSelectAllOption: true,
                includeResetOption: true,
            });

            $('#quantity_'+packageIndex).keyup(function(){
                $('#final_price_'+packageIndex).val((parseInt($('#quantity_'+packageIndex).val()) * parseInt($('#price_'+packageIndex).val())));
            });
                        
            $.ajax({
                type: "POST",
                url: base_url + "admin/salesquote/get_package_categories",
                data: {package_id: package_id,quote_no: quote_no},
                success: function (res) { 
                    //console.log(res); 
                    $('#package_items_assigned_form_'+packageIndex+' #quote_no').val(quote_no);
                    $('#package_items_assigned_form_'+packageIndex+' #package_id_'+packageIndex).val(package_id);

                    var obj = jQuery.parseJSON(res); 
                    $('#quote_package_category_'+packageIndex).val(obj.package_details['category_name']);        
                    $('#price_'+packageIndex).val(obj.package_details['package_price']);  
                    
                    $(obj.package_items).each(function () {
                        $("#package_items_"+packageIndex+" option[value='" + this + "']").attr("selected", true);
                        $("#package_items_"+packageIndex).multiselect("refresh");
                    });      
                }
            }); // ajax end

            $("#package_items_assigned_form_"+packageIndex).on('submit', (function (e) {
                e.preventDefault();
            
                $.ajax({
                    url: base_url + 'ajax/update_custom_package_items',
                    type: "POST",
                    data: new FormData(this),
                    contentType: false,
                    cache: false,
                    processData: false,
                    success: function (data) { 
                        $("#package_items_txt_"+packageIndex).removeAttr("required");
                        toastr.success("Menu items updated successfully!");
                        $('#backDropModal_'+packageIndex).modal('hide');
                        $('.quote_package_name').removeAttr("required");
                        $('.order_date').removeAttr("required");
                        $('.quantity').removeAttr("required");
                        $('.final_price').removeAttr("required");
                    }
                });
            
            }));

            
        }); // on change end


        var edit_quote_id = $('#edit_quote_id').val();
        var edit_quote_no = $('#edit_quote_no').val();
        if(edit_quote_no != '' ) {            
            $.ajax({
                url: base_url + "admin/salesquote/get_quote_package_details",
                type: "POST",
                dataType: "JSON",
                data: {quote_no: edit_quote_no},
                success: function (res)
                {   
                    $.each(res, function(index, obj) {
                        //console.log(obj);          
                        var adjustedIndex = index + 1;
                        $('#package_items_txt_'+adjustedIndex).removeAttr('readonly');
                        $("#quote_package_name_"+adjustedIndex).val( obj.quote_package_id);
                        $("#order_date_"+adjustedIndex).val(obj.order_date);
                        $("#quantity_"+adjustedIndex).val(obj.quantity);
                        $("#final_price_"+adjustedIndex).val(obj.final_price);
                        $("#quote_package_name_" + adjustedIndex).trigger('change');
                        $("#package_items_txt_"+adjustedIndex).removeAttr("required");
                        $('.quote_package_name').removeAttr("required");
                        $('.order_date').removeAttr("required");
                        $('.quantity').removeAttr("required");
                        $('.final_price').removeAttr("required");
                    });

                    
                },
                error: function () {            
                }
            });
        }

    } //sales modules end
  


    if(modules == 'sales' && (pages == 'invoice_list' || pages == 'invoice_add_edit')) {

        //$("#go_search").on('click', (function (e) {  alert("sdsfsdf");
        $("#go_search").click(function() {  
            var input_search = $('#input_search').val();
            if(input_search == '') {
                toastr.error("Enter quotation number to add invoice!");
                return false;
            }
            window.location.href = "salesinvoice/searchQuoteItem/" + input_search;
        });

        $("#go_view").click(function() {  
            var input_search = $('#input_search').val();
            if(input_search == '') {
                toastr.error("Enter invoice number to view!");
                return false;
            }
            window.location.href = "salesinvoice/searchInvoiceView/" + input_search;
        });

        $("#go_history").click(function() {  
            var input_search = $('#input_search').val();
            if(input_search == '') {
                toastr.error("Enter invoice number to view payment history");
                return false;
            }
            window.location.href = "salesinvoice/searchInvoiceHistory/" + input_search;
        });

        //invoice amount
        $('#advance_amount').keyup(function(){
            var discountAmt = $('#discount_amount').val();
            if( discountAmt == '') {
                discountAmt = 0;
            }            
            var topayAmt = $('#topay_amount').val();
            var advanceAmt = $('#advance_amount').val();
            $('#balance_amount').val( ((parseInt(topayAmt)) - parseInt(discountAmt)) - parseInt(advanceAmt) );
        });




    }


    if(modules == 'kitchen' && (pages == 'order_list')) {

        $("#date_search").click(function() {  
            var from_date = $('#from_date').val();
            var to_date = $('#to_date').val();
            if(from_date == '') {
                toastr.error("Please select from date to search!");
                return false;
            }
        });

        $("#date_reset").click(function() {  
            $('#from_date').val('');
            $('#to_date').val('');
            //window.location.href = "admin/kitchen";
            $('#kitchenOrderListTable').DataTable().destroy();
            $('#kitchenOrderListTable').empty();
        });

        // let minDate, maxDate;
        
        // // Custom filtering function which will search data in column four between two values
        // DataTable.ext.search.push(function (settings, data, dataIndex) {
        //     let min = minDate.val();
        //     let max = maxDate.val();
        //     let date = new Date(data[4]);
        
        //     if (
        //         (min === null && max === null) ||
        //         (min === null && date <= max) ||
        //         (min <= date && max === null) ||
        //         (min <= date && date <= max)
        //     ) {
        //         return true;
        //     }
        //     return false;
        // });
        
        // // Create date inputs
        // minDate = new DateTime('#min', {
        //     // format: 'MMMM Do YYYY'
        //     format: 'YYYY-MM-DD'
        // });
        // maxDate = new DateTime('#max', {
        //     format: 'MMMM Do YYYY'
        // });
        
        // // DataTables initialisation
        // let table = new DataTable('#kitchenOrderListTable');
        
        // // Refilter the table
        // document.querySelectorAll('#min, #max').forEach((el) => {
        //     el.addEventListener('change', () => table.draw());
        // });

//         var membersDT;
// $(document).ready(function(){
//         /** 
//             * Initializing DataTable
//             * Load Data using Ajax
//         */
//         membersDT = $('#membersTbl').DataTable({
//                         processing: true,
//                         serverSide: true,
//                         columns:[
//                             {
//                                 width:"20%",
//                                 data:'date'
//                             },
//                             {
//                                 width:"40%",
//                                 data:'name'
//                             },
//                             {
//                                 width:"20%",
//                                 data:'email'
//                             },
//                             {
//                                 width:"20%",
//                                 data:'phone'
//                             }
//                         ],
//                         ajax: {
//                             method:'POST',
//                             url:'dt-query.php',
//                             data: {'registered_from' : $('input[name="registered_from"]').val(), 'registered_to' : $('input[name="registered_to"]').val() }
//                         },
//                         lengthMenu: [ [20, 50,  -1], [20, 50, "All"] ]
//                     });
 
//     membersDT.on('draw.dt', function(){
//         /**
//             * Add Event Listener to the custom inputs
//             */
//         $('input[name="registered_from"], input[name="registered_to"]').change(function(){
//                 //Update Ajax data
//                 membersDT.context[0].ajax.data = {'registered_from' : $('input[name="registered_from"]').val(), 'registered_to' : $('input[name="registered_to"]').val() }
//                 //Update DataTable data
//                 membersDT.draw();
//         })
//     })
// })




    }
    

}); // document ready end 

