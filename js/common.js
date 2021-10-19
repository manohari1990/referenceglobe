$( function() {

    $('#myModal').on('shown.bs.modal', function () {
        $('#userForm')[0].reset();
        $('#profile_pic').show();
        $('.removeImage').hide();
        $('#regApprove').hide();
        $('.updatePassword').hide();
        $('.updateProfilePic').hide();
        $('label.error').hide();
        $('input:radio[name="gender"]').removeAttr('checked');
    });
    
    $( "#dob" ).datepicker({
        changeMonth: true,
        changeYear: true,
        format: "yyyy-mm-dd",
        minDate: new Date ('1990-01-01'),
        maxDate: new Date('2015-12-31'),
        //setDate: new Date(2014, 10, 30),
        autoclose: true
    });

    $("#userForm").validate({
        rules: {
            first_name: {
                required: true
            },
            last_name: {
                required: true
            },
            dob: {
                required: true
            },
            user_roll: {
                required: true
            },
            gender: {
                required: true
            },
            user_signature: {
                required: true
            },
            address: {
                required: true
            },
            phone_number: {
                required: false,
                phoneValidation: true
            },        
            username: {
                required: true
            },
            user_password: {
                required: true,
                pwcheck: true,
                minlength: 8
            },
            email_id: {
                required: true,
                emailcheck: true
            },
        },
        messages: {
            first_name: {
                required: "First Name is required."
            },
            last_name: {
                required: "Last Name is required."
            },
            dob: {
                required: "DOB is required."
            },
            gender: {
                required: "Gender is required."
            },
            user_roll: {
                required: "User Role is required."
            },
            user_signature: {
                required: "Signature is required."
            },
            username: {
                required: "Username is required."
            },
            user_password: {
                required: "Password is required",
                pwcheck: "Password must contain atleast one uppercase, one lowercase, one digit and special characters from @#$%&",
                minlength: "Password must be between 8 and 20 characters long"
            },
            email_id: {
                required: "Email Adresse is required.",
                emailcheck: "Invalid email address."
            },
            phone_number: {
                required: "",
                phoneValidation: "Invalid Phone number."
            }
        }
    });

    $.validator.addMethod("pwcheck", function(value, element) {
        return /^[A-Za-z0-9\d=!\-@._*]*$/.test(value) // consists of only these
                && /[a-z]/.test(value) // has a lowercase letter
                && /\d/.test(value) // has a digit
    });

    $.validator.addMethod("emailcheck", function(value, element) {
        return /^\b[A-Z0-9._%-]+@[A-Z0-9.-]+\.[A-Z]{2,4}\b$/i.test(value)
    });

    $.validator.addMethod('phoneValidation', function(value, element){
        if(value.match(/^\d{10}$/)) {
            return true;
        }
        return false;
                
    });

    let CurrentPage = window.location.href;
    if(CurrentPage.indexOf("listusers") > 0){
        loadUsers();
    }
    if(CurrentPage.indexOf("employeelist") > 0){
        loadEmployees(1);

        $( "#doj" ).datepicker({
            changeMonth: true,
            changeYear: true,
            format: "yyyy-mm-dd",
            autoclose: true
        });
    }
});

function editRecord(id){
    $('#userForm')[0].reset();
    $.get({
        url:'users.php',
        data: {id:id, action:'edit'},
        success: function(res){
            res = JSON.parse(res);
            $("#myModal").modal("show");
            $('#id').val(id);
            $('#first_name').val(res.first_name);
            $('#last_name').val(res.last_name);
            $('#email_id').val(res.email_id);
            $('#phone_number').val(res.phone_number);
            $('#dob').val(res.dob);
            $('input:radio[name="gender"]').filter('[value="'+ res.gender +'"]').attr('checked', true);
            $('#username').val(res.username).prop('disabled', true);
            $('#user_signature').val(res.user_signature);
            $('#user_roll').val(res.user_roll);
            $('#address').val(res.address);
            if(res.profile_pic != ''){
                $('#profile_pic_path').val(res.profile_pic);
                $('#profile_pic').hide();
                $('.removeImage').show();
                $('.updateProfilePic').attr('src', res.profile_pic).show();
                $('small').hide();
            }
            if(res.status == 0){
                $('#regApprove').show();
            }
            $('#user_password').val('').hide();
            $('.updatePassword').show();
            $('.modal-title').text("Edit User");
        }
    });    
}

function regApproval(){
    let UserId = $('#id').val();
    $.get({
        url: 'users.php',
        data: {id:UserId, action:'approved'},
        success: function(res){
            if(res == 'success'){
                location.reload();
            }
        }
    });
}
function changePassword(){
    $('#user_password').show().attr('disabled',false);
    $('.updatePassword').hide();
}

function deleteRecord(id){
    $.get({
        url: 'users.php',
        data: {id:id, action:'delete'},
        success: function(res){
            if(res == 'success'){
                location.reload();
            }
        }
    })
}

function removeImage(ele){
    $(".updateProfilePic").hide();
    $('#profile_pic_path').val('');
    $(ele).hide();
    $("#profile_pic").show();
}

function loadUsers(){
    $.ajax({
        url: 'users.php',
        type: 'GET',
        data: {search: document.getElementById('searchKey').value },
        success:function(res){
            res = JSON.parse(res);
            let recordHTML='';
            $.each(res, function(index, value){
                if(value.profile_pic == null || value.profile_pic == ''){
                    value.profile_pic = '/referenceglobe/assets/img/'+value.gender+'_avatar.jpg';
                }
                recordHTML += '<tr>';
                recordHTML += '<td><img class="hyperlinkImage" src="'+ value.profile_pic +'" width="100" onclick="expendImage('+value.id+')"></td>';
                recordHTML += '<td>'+ value.first_name +'</td>';
                recordHTML += '<td>'+ value.last_name +'</td>';
                recordHTML += '<td>'+ value.email_id +'</td>';
                recordHTML += '<td>'+ value.dob +'</td>';
                recordHTML += '<td>'+ value.phone_number +'</td>';
                recordHTML += '<td>'+ value.gender +'</td>';
                recordHTML += '<td>'+ value.address +'</td>';
                if(userRole == 'sadmin'){
                    recordHTML += '<td><a href="javascript:void(0)" onclick="editRecord('+ value.id +')"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a> <a href="javascript:void(0)" onclick="deleteRecord('+ value.id +')"><i class="fa fa-trash" aria-hidden="true"></i></a></td>'; 
                }else{
                    recordHTML += '<td><a href="javascript:void(0)" onclick="deleteRecord('+ value.id +')"><i class="fa fa-trash" aria-hidden="true"></i></a></td>'; 
                }
                
                recordHTML += '</tr>';
            });
            document.getElementById('dataRows').innerHTML = recordHTML;
        }
    });
}

function loadEmployees(page = 1){
    $.ajax({
        url: 'employees.php',
        type: 'GET',
        data: {search: document.getElementById('searchKey').value, page: page},
        success:function(res){
            res = JSON.parse(res);
            let i = 1;
            let recordHTML='';
            let paginationHTML = '';
            $.each(res.Result, function(index, value){
                recordHTML += '<tr>';
                recordHTML += '<td>'+ value.emp_name +'</td>';
                recordHTML += '<td>'+ value.emp_designation +'</td>';
                recordHTML += '<td>'+ value.emp_dob +'</td>';
                recordHTML += '<td>'+ value.emp_doj +'</td>';
                recordHTML += '<td>'+ value.blood_group +'</td>';
                recordHTML += '<td>'+ value.mobile +'</td>';
                recordHTML += '<td>'+ value.emp_address +'</td>';
                recordHTML += '<td><a href="javascript:void(0)" onclick="showFile('+"'"+value.identity_file+"'"+')"><i class="fa fa-eye" aria-hidden="true"></i></a></td>';
                if(userRole == 'sadmin'){
                    recordHTML += '<td><a href="javascript:void(0)" onclick="editEmployee('+ value.id +')"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a> <a href="javascript:void(0)" onclick="deleteEmployee('+ value.id +')"><i class="fa fa-trash" aria-hidden="true"></i></a></td>'; 
                }else{
                    recordHTML += '<td><a href="javascript:void(0)" onclick="deleteEmployee('+ value.id +')"><i class="fa fa-trash" aria-hidden="true"></i></a></td>'; 
                }
                
                recordHTML += '</tr>';
            });
            for(i=1;i<=res.pagination;i++){
                if(page == i){
                    paginationHTML += '<span class="pagination">' + i + ' </span>';
                }else{
                    paginationHTML += '<a class="pagination" href="javascript:void(0)" onclick="loadEmployees('+i+')">'+i+'</a>';
                }
            }
            document.getElementById('dataRows').innerHTML = recordHTML;
            document.getElementById('pagination').innerHTML = paginationHTML;
        }
    });
}


function isNumberKey(evt){
    var charCode = (evt.which) ? evt.which : evt.keyCode
    if (charCode > 31 && (charCode < 48 || charCode > 57))
        return false;
    return true;
}
function onlyAlphabets(event, t) {
    return (event.charCode > 64 && event.charCode < 91) || (event.charCode > 96 && event.charCode < 123) || (event.charCode==32) || (event.charCode == 43) || (event.charCode == 45);
}

function checkUpload(ele){
    var fileHandler = new FormData();
    fileHandler.append('identity_file_path', identity_file_path.files[0]);
    $.ajax({
        url: 'employees.php',
        type: 'POST',
        processData: false,
        contentType: false,
        dataType: 'json',
        data: fileHandler,
        success: function(res){
            if(res.result == 1){
                $("#identity_file").val(res.file_path);
                $("#iframe_file").attr('src',res.file_path).css('display','block');
                $('#file_type').val(res.imageFileType);
            }
        }
    });
}

function showFile(url){
    var modal = document.getElementById("fileViewer");
    var img = document.getElementById("fileView");
    modal.style.display = "block";
    img.src = url;
}
function closeFileViewer(modal){
    $('#'+modal).hide();
}
function editEmployee(id){
    $('#userForm')[0].reset();
    $.get({
        url:'employees.php',
        data: {id:id, action:'edit'},
        success: function(res){
            res = JSON.parse(res);
            $("#myModal").modal("show");
            $('#id').val(id);
            $('#emp_name').val(res.emp_name);
            $('#emp_designation').val(res.emp_designation);
            $('#dob').val(res.emp_dob);
            $('#doj').val(res.emp_doj);
            $('#blood_group').val(res.blood_group);
            $('#mobile').val(res.mobile);
            $('#emp_address').val(res.emp_address);
            if(res.identity_file != ''){
                $('#identity_file').val(res.identity_file);
                //$('#identity_file_path').hide();
                $('#iframe_file').attr('src', res.identity_file).show();
            }
            $('.modal-title').text("Edit Employee");
        }
    });    
}

function deleteEmployee(id){
    $.get({
        url: 'employees.php',
        data: {id:id, action:'delete'},
        success: function(res){
            if(res == 'success'){
                location.reload();
            }
        }
    })
}