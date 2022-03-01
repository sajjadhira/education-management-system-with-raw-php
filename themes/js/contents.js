/** Preloader **/
$(document).ready(function () {

  // preloader
  $(window).load(function(){
    $('.preload').delay(300).fadeOut(300);
    $('.preloader').delay(300).fadeOut(300);
  })


})
/** Preloader **/

$(document).ready(function(){


$(document).on('click', '[data-toggle="lightbox"]', function(event) {
    event.preventDefault();
    $(this).ekkoLightbox();
});


$(document).on('click', '#reloadcaptcha', function() {
	
            var classid = this.value;
            $('#captcha').focus().val(null);
            $('#captcha_error').html(null);
            function makeid()
{
    var text = "";
    var possible = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";

    for( var i=0; i < 5; i++ )
        text += possible.charAt(Math.floor(Math.random() * possible.length));

    return text;
}

            var base_url = $('#base_url').html();
	        var t = "action=reloadcaptcha&id="+ makeid();
				$.ajax({
                type: "POST",
                url: base_url + "functions/get.php",
                data: t,
                cache: !1,
                success: function(e) {
				$("#viewcaptcha").html(e);
				}
			});



});

$(document).on('change', '#studentclass', function() {
	
            var base_url = $('#base_url').html();
            var classid = this.value;	
	        var t = "action=getsection&class="+ classid;
				$.ajax({
                type: "POST",
                url: base_url + "functions/get.php",
                data: t,
                cache: !1,
                success: function(e) {
				$("#getsectionfromclass").html(e);
				}
			});
});

$(document).on('change', '#studentclass', function() {
	
            var classid = this.value;	
            var base_url = $('#base_url').html();
	        var t = "action=getsubject&class="+ classid;
				$.ajax({
                type: "POST",
                url:  base_url + "functions/get.php",
                data: t,
                cache: !1,
                success: function(e) {
				$("#getsubjectfromclas").html(e);
				}
			});
});

$(function(){
    var dtToday = new Date();
    
    var month = dtToday.getMonth() + 1;
    var day = dtToday.getDate();
    var year = dtToday.getFullYear();
    if(month < 10)
        month = '0' + month.toString();
    if(day < 10)
        day = '0' + day.toString();
    
    var maxDate = year + '-' + month + '-' + day;
    $('#date').attr('max', maxDate);
});


});

$(document).ready(function(e) {
    var a = 300,
        t = 1200,
        l = 700,
        s = e(".cd-top");
    e(window).scroll(function() {
        e(this).scrollTop() > a ? s.addClass("cd-is-visible") : s.removeClass("cd-is-visible cd-fade-out"), e(this).scrollTop() > t && s.addClass("cd-fade-out")
    }), s.on("click", function(a) {
        a.preventDefault(), e("body,html").animate({
            scrollTop: 0
        }, l)
    })
});
$(document).ready(function()
{    

/** Username Check **/
 $("#username").keyup(function()
 {  
  var username = $(this).val(); 
  
  if(username.length > 3)
  {  
   $("#username_error").html('checking...');
   var data = 'action=checkuser&username='+$(this).val();
   var base_url = $('#base_url').html();
   $.ajax({
    
    type : 'POST',
    url  : base_url + 'functions/get.php',
    data : data,
    success : function(data)
        {
           if(data==1){$("#username_error").removeClass('text-success').addClass('text-danger').html(' <i class="fa fa-times" aria-hidden="true"></i> Username already exists');}else{$("#username_error").removeClass('text-danger').addClass('text-success').html(' <i class="fa fa-check-circle-o" aria-hidden="true"></i> Available');}
        }
    });
    return false;
   
  }
  else
  {
   $("#username_error").html(null);
  }
 });
 
/** Captcha Check **/
// $('#AdmissionFrom').attr("disabled",!0);

 $("#captcha").keyup(function()
 {  
  var captcha = $(this).val(); 
  
  if(captcha.length > 3)
  {  
   $("#captcha_error").html('checking...');
   var data = 'action=checkcaptcha&captcha='+$(this).val();
   var base_url = $('#base_url').html();
   $.ajax({
    
    type : 'POST',
    url  : base_url + 'functions/get.php',
    data : data,
    success : function(data)
        {
           if(data==0){$("#captcha_error").removeClass('text-success').addClass('text-danger').html(' <i class="fa fa-times" aria-hidden="true"></i> Invalid Captcha');$('#AdmissionFrom').attr("disabled",!0);}else{$("#captcha_error").removeClass('text-danger').addClass('text-success').html(' <i class="fa fa-check-circle-o" aria-hidden="true"></i> Valid Captcha');$('#AdmissionFrom').attr("disabled",!1);}
        }
    });
    return false;
   
  }
  else
  {
   $("#captcha_error").html(null);
  }
 });
 
});

/** Auto Hidden ** $('#AdmissionFrom').attr("disabled",!0); /** Auto Hidden **/

$('#viweadmissionresult').click(function() {
var serial = $('#serial').val();
if(serial=="" || serial.length<0|| serial<0)
{
$('#serial_error').html('<i class="fa fa-exclamation-triangle" aria-hidden="true"></i> Please type a valid admission serial number.');
return false;
}
else
{
$('#serial_error').html(null);
}
// $('#viweadmissionresult').submit();
$('#admission-result').html('<div class="loader"></div>');

   var data = 'action=getadmissionresult&serial='+serial;
   var base_url = $('#base_url').html();
   $.ajax({
    
    type : 'POST',
    url  : base_url + 'functions/get.php',
    beforSend: $('#viweadmissionresult').html('Searching...').attr("disabled",!0),
    data : data,
    success : function(data)
        {
           if(data){$("#admission-result").html(data);$('#viweadmissionresult').html('Search').attr("disabled",!1);}

        }
    });
return true;
});

$(document).on('click', '#admit-download', function() {
var serial = $('#serial').val();
var phone = $('#fullphone').val();
var admissionid = $('#admissionid').val();
if(phone=="" || phone.length<0|| phone<0)
{
$('#fullphone_error').html('<i class="fa fa-exclamation-triangle" aria-hidden="true"></i> Please type a valid phone number.');
return false;
}
else
{
$('#fullphone_error').html(null);
}
$('#admit-content').html('<div class="loader"></div>');
   var data = 'action=downloadadmissionadmit&phonenumber='+phone+'&serial='+serial;
   var base_url = $('#base_url').html();
   $.ajax({
    
    type : 'POST',
    url  : base_url + 'functions/get.php',
    beforSend: $('#admit-download').html('Please wait...').attr("disabled",!0),
    data : data,
    success : function(data)
        {
           if(data){$("#admit-content").html(data);$('#admit-download').html('Please wait...').attr("disabled",!1).html('Download');}

        }
    });
return true;
});

$(document).on('click', '#AdmissionFrom', function() {
var testEmail = /^[A-Z0-9._%+-]+@([A-Z0-9-]+\.)+[A-Z]{2,4}$/i;
var username = $('#username').val();
var name = $('#name').val();
var email = $('#email').val();
var password = $('#password').val();
var date = $('#date').val();
var studentclass = $('#studentclass').val();
var section = $('#sectionselect').val();
var gender = $('#gender').val();
var address = $('#address').val();
var phonenumber = $('#phonenumber').val();
var procced = 1;
/** Name valid**/
if(name.length<3)
{
$('#name_error').html('<i class="fa fa-exclamation-triangle" aria-hidden="true"></i> Please type a valid student name!');
var procced = procced*0;
}
else
{
var procced = procced*1;
$('#name_error').html(null);
}
/** Username valid**/
if(username.length<3||username>20)
{
$('#username_error').html('<i class="fa fa-exclamation-triangle" aria-hidden="true"></i> Please type a valid student username!');
var procced = procced*0;
}
else
{
var procced = procced*1;
$('#username_error').html(null);
}
/** Email valid**/
if(!testEmail.test(email))
{
$('#email_error').html('<i class="fa fa-exclamation-triangle" aria-hidden="true"></i> Please type a valid student email!');
var procced = procced*0;
}
else
{
var procced = procced*1;
$('#email_error').html(null);
}
/** Password valid**/
if(password.length<6||password.length>20)
{
$('#password_error').html('<i class="fa fa-exclamation-triangle" aria-hidden="true"></i> Please type a valid password. Password should 6-10 characters!');
var procced = procced*0;
}
else
{
var procced = procced*1;
$('#password_error').html(null);
}
/** Birthday valid**/
if(date.length<10||date.length>10)
{
$('#date_error').html('<i class="fa fa-exclamation-triangle" aria-hidden="true"></i> Please select student date of birth!');
var procced = procced*0;
}
else
{
var procced = procced*1;
$('#date_error').html(null);
}
/** Class valid**/
if(studentclass.length<0)
{
$('#studentclass_error').html('<i class="fa fa-exclamation-triangle" aria-hidden="true"></i> Please select student class!');
var procced = procced*0;
}
else
{
var procced = procced*1;
$('#studentclass_error').html(null);
}
/** Section valid**/
if(section.length<0)
{
$('#section_error').html('<i class="fa fa-exclamation-triangle" aria-hidden="true"></i> Please select student section!');
var procced = procced*0;
}
else
{
var procced = procced*1;
$('#section_error').html(null);
}
/** gender valid**/
if(gender.length<4||gender.length>6)
{
$('#gender_error').html('<i class="fa fa-exclamation-triangle" aria-hidden="true"></i> Please select student gender!');
var procced = procced*0;
}
else
{
var procced = procced*1;
$('#gender_error').html(null);
}
/** Address valid**/
if(address.length<5)
{
$('#address_error').html('<i class="fa fa-exclamation-triangle" aria-hidden="true"></i> Please type valid address!');
var procced = procced*0;
}
else
{
var procced = procced*1;
$('#address_error').html(null);
}
/** Phonenumber valid**/
if(phonenumber.length<8||phonenumber.length>20)
{
$('#phonenumber_error').html('<i class="fa fa-exclamation-triangle" aria-hidden="true"></i> Please type valid phone number!');
var procced = procced*0;
}
else
{
var procced = procced*1;
$('#phonenumber_error').html(null);
}

/**Process if valid**/

if(procced==0)
{
return false;
}
else
{
return true;
$('#AdmissionFrom').val('Processing...').attr("disabled",!0);
$('#AdmissionFrom').submit();
}

});
/** New Section**/
/** Dasboard Login Section**/
$(document).on('click', '#dashboardLogin', function() {
var username = $('#loginusername').val();
var password = $('#loginpassword').val();
var procced = 1;
if(username=="" || username.length<0)
{
$('#username_error').html('<span class="text-danger"><i class="fa fa-exclamation-triangle"></i> Please type a valid username</span>');
var procced = procced*0;
}
else
{
$('#username_error').html(null);
var procced = procced*1;
}

if(password=="" || password.length<0)
{
$('#password_error').html('<span class="text-danger"><i class="fa fa-exclamation-triangle"></i> Please type a valid password</span>');
var procced = procced*0;
}
else
{
$('#password_error').html(null);
var procced = procced*1;
}
if(procced==0)
{
return false;
}
else
{

$('#dashboardLogin').val('Logging in...').attr("disabled",!0);
$('#LoginForm').submit();
return true;
}
});
 $(document).ready(function() {
      $('.progress .progress-bar').css("width",
                function() {
                    return $(this).attr("aria-valuenow") + "%";
                }
        )
    });
$(document).on('click', '#copydemoadminlogin', function() {
$('#loginusername').val('admin');
$('#loginpassword').val('admin');
});
$(document).on('click', '#copydemoadminteacher', function() {
$('#loginusername').val('teacher');
$('#loginpassword').val('teacher');
});
$(document).on('click', '#copydemoadminparent', function() {
$('#loginusername').val('parent');
$('#loginpassword').val('parent');
});
$(document).on('click', '#copydemoadminstudent', function() {
$('#loginusername').val('student');
$('#loginpassword').val('student');
});

$(function() {

  // We can attach the `fileselect` event to all file inputs on the page
  $(document).on('change', ':file', function() {
    var input = $(this),
        numFiles = input.get(0).files ? input.get(0).files.length : 1,
        label = input.val().replace(/\\/g, '/').replace(/.*\//, '');
    input.trigger('fileselect', [numFiles, label]);
  });

  // We can watch for our custom `fileselect` event like this
  $(document).ready( function() {
      $(':file').on('fileselect', function(event, numFiles, label) {

          var input = $(this).parents('.input-group').find(':text'),
              log = numFiles > 1 ? numFiles + ' files selected' : label;

          if( input.length ) {
              input.val(log);
			  $('#attached').html(log);
          } else {
              if( log ) {$('#attached').html(log);}
          }

      });
  });
  
});