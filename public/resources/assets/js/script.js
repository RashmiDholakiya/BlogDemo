
$(document).ready(function () {
    //$("#results").load("views/fetch_pages.php"); //load initial records

    //executes code below when user click on pagination links
    $("#results").on("click", ".pagination a", function (e) {
        e.preventDefault();
        $(".loading-div").show(); //show loading element
        var page = $(this).attr("data-page"); //get page number from link
        $("#results").load("views/fetch_pages.php", {"page": page}, function () { //get content from PHP page
            $(".loading-div").hide(); //once done, hide loading element
        });

    });

    $(".country").change(function()
    {

        $("#loding1").show();
        var id=$(this).val();
        var dataString = 'id='+ id;
        $(".state").find('option').remove();
        $(".city").find('option').remove();
        $.ajax
        ({
            type: "POST",
            url: "get_state",
            data: dataString,
            dataType:'JSON',
            success: function(data)
            {

                $.each(data, function (k, v) {
                   $('.state').append(" <option  value="+ v.id+">"+v.state_name+"</option>");
                });



            }
        });
    });
    function search(action,datastring) {

            $.ajax({
                type: "post",
                url: datastring,
                data:action,
                dataType:'JSON',
                success: function (data) {
                    if(data!="") {
                        $("#results").html("<table class='table table-responsive table-bordered' border=1 id='datatbl'><tr><th width='2%'>Id</th><th width='8%'>Title</th> <th width='45%'>Description</th><th width='15%'>Active From Date</th> <th width='15%'>Active To Date</th> <th width='7%'>Status</th> <th width='8%'>Action</th> </tr>");
                        $.each(data, function (k, v) {
                            id = v.id;
                            base = "delete/" + id;
                            image = "resources/assets/images/delete.png"
                            $("#datatbl").append("<tr> <td align='center'>" + id + "</td> <td align='center'>" + v.title + "</td> <td align='justify'>" + v.description + "</td> <td align='center'>" + v.active_from_date + "</td> <td align='center'>" + v.active_to_date + "</td> <td align='center'>" + v.status + "</td> <td align='center'><a id='del' href=" + base + " > <img src='" + image + "' height='30%' width='30%'></a> </td> </tr>");

                        });

                        $("#results").append("</table>");
                        //$("#results").html("<table border=1><tr><th width='2%'>Id</th><th width='8%'>Title</th> <th width='45%'>Description</th><th width='15%'>Active From Date</th> <th width='15%'>Active To Date</th> <th width='7%'>Status</th> <th width='8%'>Action</th> </tr><tr> <td align='center'>data.id</td> <td align='center'>data['title']</td> <td align='justify'>data['sescription']</td> <td align='center'>data['active_from_date']</td> <td align='center'>data['active_to_date']</td> <td align='center'>data['status']</td> <td align='center'> <a href='admin/delete/'+id  title='Click To Delete' onclick='return confirm('Are you sure want to delete this record? ');><img src='images/delete.png' height='30%' width='30%'></a> </td> </tr></table>")

                        // $("#results").html(data);
                         $("#search").val("");
                        $("#status").val('0');
                        $("#links").html("");
                    }
                    else
                    {
                        alert("No data Found");
                    }
                  //  $("#results").load("views/", {"page": page}, function () { //get content from PHP page
                      //  $(".loading-div").hide(); //once done, hide loading element
                    //});
                }
            });



    }

    $("#button").click(function () {

        var title = "title="+$("#search").val();
        if (title != "") {
        var action="search";

        search(title,action);
        }
        else
        {
            alert("Enter Title");
        }
    });
    $("#Btnstatus").click(function () {

            var title = "status="+$("#status").val();

        if (title != '0') {
            var action="searchBystatus";
            search(title,action);
        }
        else
        {
            alert("Select Status");
        }
    });

    $('#search').keyup(function (e) {
        if (e.keyCode == 13) {
            search();
        }
    });
    $('.item').each(function(event){ /* select all divs with the item class */

        var max_length = 10;
        /* set the max content length before a read more link will be added */
        if($(this).html().length > max_length){ /* check for content length */

            var short_content 	= $(this).html().substr(0,150); /* split the content in two parts */
            var long_content	= $(this).html().substr(150);

            $(this).html(short_content+
                '<a href="#" class="read_more" style="color: #880000"><br/>Read More...</a>'+
                '<span class="more_text" style="display:none;">'+long_content+'</span>'); /* Alter the html to allow the read more functionality */

            $(this).find('a.read_more').click(function(event){ /* find the a.read_more element within the new html and bind the following code to it */

                event.preventDefault(); /* prevent the a from changing the url */
                $(this).hide(); /* hide the read more button */
                $(this).parents('.item').find('.more_text').show(); /* show the .more_text span */

            });

        }
        else
        {
            var short_content 	= $(this).html().substr(0,$(this).html().length);
            $(this).html(short_content);
        }

    });
    // validate signup form on keyup and submit
    jQuery("#blog_form").validate({
        rules: {
            title: "required",
            description: "required",
            image:"required"
        },
        messages: {
            title: "Please Enter your Blog Title",
            description: "Please Enter your Blog Content",
            image:"Please Choose Blog Image"
        },
        submitHandler: function (form) {
            form.submit();
        }
    });
    jQuery("#blog_edit").validate({
        rules: {
            title: "required",
            username: {
                required: true,
                email: true,
            },
            password: "required",
            confirmpassword:{
                required: true,
                equalTo: '#password'
            },
            comment:"required",
            description: "required",
            country:"required",
            state:"required"
        },
        messages: {
            title: "Please Enter your Blog Title",
            description: "Please Enter your Blog Content",
            username: "Please Enter Email-Id",
            password:"Please Enter Password",
            confirmpassword:{
                required: 'Please enter your password one more time',
                equalTo: 'Please enter the same password as above'
            },
            comment:"Please Enter Comment",
            country:"Please Select Country",
            state:"Please Select State"
        },
        submitHandler: function (form) {
            form.submit();
        }


    });


    jQuery("#del").on('click', (function(){
        alert("Y or n");
    }));

    jQuery('.delete_all').on('click', function (e) {
        var allVals = [];
        $(".sub_chk:checked").each(function () {
            allVals.push($(this).attr('data-id'));
        });
        //alert(allVals.length); return false;
        if (allVals.length <= 0) {
            alert("Please select row.");
        }
        else {

            WRN_PROFILE_DELETE = "Are you sure you want to delete this row?";
            var check = confirm(WRN_PROFILE_DELETE);
            if (check == true) {
                //for server side

                var join_selected_values = allVals.join(",");

                $.ajax({

                    type: "POST",
                    url: "deleteRows",
                    cache: false,
                    data: 'ids=' + join_selected_values,
                    success: function (response) {
                        $("#loading").hide();
                        $("#msgdiv").html(response);
                        alert("successfullly deleted records");
                        location.reload();

                        //referesh table

                    }
                });


            }
        }
    });




});