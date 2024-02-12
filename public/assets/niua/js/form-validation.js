$(document).on("blur",".validemail_niua",function () {
    var email=$.trim($(this).val());

    if(email!=''){
        // var id=$(this).attr('id');
        var pattern = /^([\w-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([\w-]+\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)$/;
        var result = $.trim(email).match(pattern) ? 1 : 0;
        if(result==0){
            $(this).val('');
            $(this).addClass("Not_ValidaFormData");

            showToast('error',' insert valid email')
        }else{
            $(this).removeClass("Not_ValidaFormData");
        }
    }
})

$(document).on("blur",".validtext_niua", function (e) {
     var text=$(this).val();
    
    if(text!=''){
        // var id=$(this).attr('id');
        var pattern = /^[a-zA-Z , 0-9]*$/;
        var resultdata = $.trim(text).match(pattern) ? 1 : 0;
        if(text.length >=255){
            $(this).addClass("Not_ValidaFormData");
            showToast('error',' Maximum 255 characters are allowed')
     }else if(resultdata==0){
            $(this).val('');
            $(this).addClass("Not_ValidaFormData");

            showToast('error',' Only alphanumeric values are allowed')
        }else{
            $(this).removeClass("Not_ValidaFormData");
        }
    }
})

$(document).on("blur",".validlongtext_niua", function (e) {
     var longtext=$(this).val();
    
    if(longtext!=''){
        if(longtext.length >65000){
            $(this).addClass("Not_ValidaFormData");
            showToast('error',' Maximum 65000 characters are allowed')
        }else{
            $(this).removeClass("Not_ValidaFormData");
        }
    }
})


$(document).on("blur",".valid_KM_niua", function (e) {
     var km=$(this).val();
      var filter =/^\d*(\.\d{0,3})?$/;
      var result1 = $.trim(km).match(filter) ? 1 : 0;
      var charCode = (e.which) ? e.which : e.keyCode;
    
    if(km!=''){
        // var id=$(this).attr('id');
     
        if(result1==0){
            $(this).val('');
            $(this).addClass("Not_ValidaFormData");

            showToast('error',' After decimal three digits are allowed')
        }else{
            $(this).removeClass("Not_ValidaFormData");
        }
    }
})

$(document).on("blur",".valid_score_rating_niua", function (e) {
   // alert('hhh')
     var score_rating=$(this).val();
      var filterdata =/^\d*(\.\d{0,1})?$/;
      var result2 = $.trim(score_rating).match(filterdata) ? 1 : 0;
      var charCode = (e.which) ? e.which : e.keyCode;
    
    if(score_rating!=''){
        // var id=$(this).attr('id');
        if(result2==0){
            $(this).val('');
            $(this).addClass("Not_ValidaFormData");

            showToast('error',' After decimal one digit allowed')
        }else{
            $(this).removeClass("Not_ValidaFormData");
        }
    }
})

$(document).on("blur",".percentage_niua", function (e) {
   // alert('hhh')
     var percentage=$(this).val();
    var filtervalue =/^\d*(\.\d{0,3})?$/;
     var pattern1 = /[0_9]+/;
      var resultpercent = $.trim(percentage).match(pattern1) ? 1 : 0;
       var resultpercentdatadecimal = $.trim(percentage).match(filtervalue) ? 1 : 0;
    
    if(percentage!=''){
        // var id=$(this).attr('id');
        if(percentage>100){
            $(this).val('');
            $(this).addClass("Not_ValidaFormData");
            showToast('error',' Please enter a number between 1 to 100')
        }else if(resultpercentdatadecimal==0){
            $(this).val('');
            $(this).addClass("Not_ValidaFormData");
            showToast('error',' After decimal three digit allowed')
        }else{
            $(this).removeClass("Not_ValidaFormData");
        }
    }
})



$(document).on("blur",".valid_ratio_niua", function (e) {
       var ratio=$(this).val();
       var ratiovalid =/^\d*(\:\d{0,})?$/;
       var pattern2 = /[0_9]+/;
       var num  = ratio.split(":")[0];
       var den  = ratio.split(":")[1]; 
      // alert(den);
       var result2 = $.trim(ratio).match(ratiovalid) ? 1 : 0;
       var result3 = $.trim(ratio).match(pattern2) ? 1 : 0;
      // alert(result3);
      //var charCode = (e.which) ? e.which : e.keyCode;
    
    if(ratio!=''){
        // var id=$(this).attr('id');
        if(num=='' || den==='undefined'){
            $(this).val('');
            $(this).addClass("Not_ValidaFormData");  
            showToast('error',' Please enter valid ratio')
        }else  if(result2==0 && result3==0 ){
            $(this).val('');
            $(this).addClass("Not_ValidaFormData");

            showToast('error',' Please enter valid ratio ')
        }else{
            $(this).removeClass("Not_ValidaFormData");
        }
    }
})

$(document).on("blur",".valid_decimal_niua", function (e) {
    var ratio=$(this).val();
    var ratiovalid =/^\d*(\.\d{0,})?$/;
    var pattern2 = /[0_9]+/;
    var num  = ratio.split(".")[0];
    var den  = ratio.split(".")[1]; 
    // console.log(den);
    //console.log(num ,' num');
    //console.log(den , ' den');
    var result2 = $.trim(ratio).match(ratiovalid) ? 1 : 0;
    var result3 = $.trim(den).match(pattern2) ? 1 : 0;
    //console.log(den ,' checl last value');
    //var charCode = (e.which) ? e.which : e.keyCode;

    //console.log(result2,' result2')
    //console.log(result3,' result3')
    //console.log(den,' den');
    // return false;
    
    if(ratio!=''){
        // var id=$(this).attr('id');
        if(num=='' || den===undefined){
            $(this).val('');
            $(this).addClass("Not_ValidaFormData");  
            showToast('error',' Please enter valid value')
        }else  if(result2==0 || result3==0 ||den ==''){
            $(this).val('');
            $(this).addClass("Not_ValidaFormData");
            showToast('error',' Please enter valid value')
        }else{
            $(this).removeClass("Not_ValidaFormData");
        }
    }
})

$(document).on("blur",".PTO_niua_validate", function (e) {
       
       var PTO=$(this).val();
       var PTOvalid =/^\d*(\.\d{0,4})?$/;
       var pattern3 = /[0_9]+/;
      // alert('helo');
       var num1  = PTO.split(".")[0];
       var den1  = PTO.split(".")[1]; 
      // alert(den1);
       var result4 = $.trim(PTO).match(PTOvalid) ? 1 : 0;
       var result5 = $.trim(PTO).match(pattern3) ? 1 : 0;
     
    if(PTO!=''){
        if(num1!=0 || den1==='undefined' || den1==''){
            $(this).val('');
            $(this).addClass("Not_ValidaFormData");  
            showToast('error',' Please enter valid ratio')
        }else  if(result4==0 && result5==0 ){
            $(this).val('');
            $(this).addClass("Not_ValidaFormData");

            showToast('error',' Please enter valid ratio ')
        }else{
            $(this).removeClass("Not_ValidaFormData");
        }
    }
})



// $(document).on("blur",".valid_KM_niua", function(e){
//     var km = $(this).val();
//     var id=$(this).attr('id');
//     var filter =/^\d*(\.\d{0,3})?$/;
//     var result = $.trim(km).match(filter) ? 1 : 0;

//     var charCode = (e.which) ? e.which : e.keyCode;
//     if(charCode ==32){
//       $('#'+id).val($('#'+id).val().slice(0,-1));
//       return false;
//     }
//     if((charCode >= 48 && charCode <= 59) || charCode==46){
      
//     }else{
//       var resultn = $.trim($('#'+id).val()).match(filter) ? 1 : 0;
//       if(resultn==''){
//         $(this).val('');
//         $(this).addClass("Not_ValidaFormData");   
//         showToast('error',' only alphabates are allowed')
//       }
      
//     }

    
//     if (result==0) {
//       $('#'+id).addClass("is-invalid");      
//       var feildlen = $('#'+id).val().length;
//         if(feildlen > 0){
//         $('#'+id).val($('#'+id).val().slice(0,-1));
//         }
//         var result = $.trim($('#'+id).val()).match(filter) ? 1 : 0;
//         if(result){}else{
//           $('#'+id).val('');
//           $('#'+id).removeClass('is-invalid');      
//         }
//         return;
//     }
// });


// $(document).on("keypress focusout",".numeric", function(e){
//       // alert("S")
//       var mobNum = $(this).val();
//       var id=$(this).attr('id');
//       var charCode = (e.which) ? e.which : event.keyCode;
//       console.log(charCode)
//       if(charCode >= 48 && charCode <= 59){
        
//       }else{
//         return false;
//       }
//       var filter = /^\d*(?:\.\d{1,2})?$/;
//       var result = $.trim(mobNum).match(filter) ? 1 : 0;
//       if (result==1) {
          
//           $('#'+id).removeClass('is-invalid');
//           $(this).removeClass('is-invalid');
//         }
//         else {
//           $('#'+id).addClass("is-invalid");
          
//             var feildlen = $('#'+id).val().length;
//             if(feildlen > 0){
//               $('#'+id).val($('#'+id).val().slice(0,-1));
//             }
//           return false;
//         }
//         if(mobNum==''){
          
//           $('#'+id).removeClass('is-invalid');
//         }
// });

// $(document).on("keyup keydown",".validname", function (e) {
//     var name=$(this).val();
//     var id=$(this).attr('id');
//     var pattern = /^[a-zA-Z 0-9]*$/;
//     var pattern1 = /[a-zA-Z]+/;
//     var result = $.trim(name).match(pattern) ? 1 : 0;
//     if(result==0){
//       if(e.which == 32){
//           return false;
//         }
//          $('#'+id).addClass('is-invalid');
         
//     }else{
//         result = $.trim(name).match(pattern1) ? 1 : 0;
//         if(result==0) {
//           $('#'+id).addClass('is-invalid');
          
//         } else {
         
//          $('#'+id).removeClass('is-invalid');
//        }
//     }
//     if(name==''){
      
//       $('#'+id).removeClass('is-invalid');
//     }
// })

// $(document).on("blur keyup",".validcontact", function(){
//     var mobNum1 = $(this).val();
//     var id=$(this).attr('id');
//     var filter = /^((\+[1-9]{1,4}[\-]{0,1})|(\([0-9]{2,3}\)[\-]{0,1})|([0-9]{2,4})[\-]{0,1})*?[0-9]{3,4}?[\-]{0,1}[0-9]{3,4}?$/;
//       if (filter.test(mobNum1)) {
//         if(mobNum1.length<=15 && mobNum1.length >=8){
          
//            $('#'+id).removeClass('is-invalid');
//          } else {
//            $('#'+id).addClass("is-invalid");
//            $('#'+id).next('.invalid-feedback').html('please enter valid contact number');
            
//           }
//         }
//         else if(mobNum1==''){
//           $('#'+id).removeClass("is-invalid");
          
//           return false;
//         }
//         else {
//           $('#'+id).addClass("is-invalid");
          
//           //$('#'+id).val('');
//           return false;
//        }
// });

// $(document).on("blur keyup",".validmobile", function(){
//     var mobNum1 = $(this).val();
//     var id=$(this).attr('id');
//     var filter = /^((\+[1-9]{1,4}[ \-]*)|(\([0-9]{2,3}\)[ \-]*)|([0-9]{2,4})[ \-]*)*?[0-9]{3,4}?[ \-]*[0-9]{3,4}?$/;
//       if (filter.test(mobNum1)) {
//         if(mobNum1.length<=10 && mobNum1.length >=10){
           
//            $('#'+id).removeClass('is-invalid');
//          } else {
//            $('#'+id).addClass("is-invalid");
//            $('#'+id).next('.invalid-feedback').html('please enter valid mobile number');
           
//           }
//         }
//         else if(mobNum1==''){
//           $('#'+id).removeClass("is-invalid");
          
//           return false;
//         }
//         else {
//           $('#'+id).addClass("is-invalid");
          
//           return false;
//        }
// });




// /*
// $(document).on("blur keypress focusout",".decimal", function(e){
//     var mobNum = $(this).val();
//     var id=$(this).attr('id');
//     var filter =/^\d*(\.\d{0,3})?$/;
//     var result = $.trim(mobNum).match(filter) ? 1 : 0;

//     var charCode = (e.which) ? e.which : event.keyCode;
//     if(charCode ==32){
//       $('#'+id).val($('#'+id).val().slice(0,-1));
//       return false;
//     }
//     if((charCode >= 48 && charCode <= 59) || charCode==46){
      
//     }else{
//       var resultn = $.trim($('#'+id).val()).match(filter) ? 1 : 0;
//       if(resultn){}else{
//         $('#'+id).val('');
//         $('#'+id).removeClass('is-invalid');      
//       }
//       return false;
//     }

    
//     if (result==0) {
//       $('#'+id).addClass("is-invalid");      
//       var feildlen = $('#'+id).val().length;
//         if(feildlen > 0){
//         $('#'+id).val($('#'+id).val().slice(0,-1));
//         }
//         var result = $.trim($('#'+id).val()).match(filter) ? 1 : 0;
//         if(result){}else{
//           $('#'+id).val('');
//           $('#'+id).removeClass('is-invalid');      
//         }
//         return;
//     }
// });

// */



// $(document).on("keypress",".decimal", function(event){
// 	var $this = $(this);
// 	if ((event.which != 46 || $this.val().indexOf('.') != -1) &&
// 	((event.which < 48 || event.which > 57) &&
// 	(event.which != 0 && event.which != 8))) {
// 	event.preventDefault();
// 	}

// 	var text = $(this).val();
// 	if ((event.which == 46) && (text.indexOf('.') == -1)) {
// 	setTimeout(function() {
// 	if ($this.val().substring($this.val().indexOf('.')).length > 6) {
// 	$this.val($this.val().substring(0, $this.val().indexOf('.') + 6));
// 	}
// 	}, 1);
// 	}

// 	if ((text.indexOf('.') != -1) &&
// 	(text.substring(text.indexOf('.')).length > 5) &&
// 	(event.which != 0 && event.which != 8) &&
// 	($(this)[0].selectionStart >= text.length - 5)) {
// 	event.preventDefault();
// 	}
  
// });

// $(document).on("change",".selectvalue", function(){
//     var selectedvalue = $(this).val();
//     var id=$(this).attr('id');
//      if (selectedvalue!='') {
          
//           $('#'+id).removeClass('is-invalid');
//         }else{
//           $('#'+id).addClass("is-invalid");
          
//           return false;
//        }
//      if(selectedvalue==''){
      
//       $('#'+id).removeClass('is-invalid');
//     }  
// });

// $(document).on("keyup focusout",".validurl",function () {
//     var email=$(this).val();
//     var id=$(this).attr('id');
//     var pattern = /^(http|https)?:\/\/[a-zA-Z0-9-\.]+\.[a-z]{2,4}/;
//     var pattern1 = /^(www\.)?[a-zA-Z0-9-\.]+\.[a-z]{2,4}/;
//     var result = $.trim(email).match(pattern) ? 1 : 0;
//     if(result==0){
//         result = $.trim(email).match(pattern1) ? 1 : 0;
//         if(result==0){
//           $('#'+id).addClass('is-invalid');
          
//         }else{
         
//          $('#'+id).removeClass('is-invalid');
//        }            
//     }else{
         
//          $('#'+id).removeClass('is-invalid');
//     }
//     if(email==''){
      
//       $('#'+id).removeClass('is-invalid');
//     }
// }); 

// $(document).on("keyup focusout", ".latitude", function() {
//     var mobNum = $(this).val();
//     var id = $(this).attr('id');
//     var filter = /^\d*(\.\d{0,8})?$/;
//     var result = $.trim(mobNum).match(filter) ? 1 : 0;
//      if(mobNum ==''){
//       $('#' + id).removeClass("is-invalid");
      
//       return false;
//     }
//     if (result == 1) {
        
//         $('#' + id).removeClass('is-invalid');
//     } else {
//         $('#' + id).addClass("is-invalid");
        
//         var feildlen = $('#' + id).val().length;
//         if (feildlen > 0) {
//             $('#' + id).val($('#' + id).val().slice(0, -1));
//         }
//         return false;
//     }
// });

// $(document).on("keyup focusout", ".longitude", function() {
//     var mobNum = $(this).val();
//     var id = $(this).attr('id');
//     var filter = /^\d*(\.\d{0,8})?$/;
//     var result = $.trim(mobNum).match(filter) ? 1 : 0;
//     if (result == 1) {
        
//         $('#' + id).removeClass('is-invalid');
//     } else {
//         $('#' + id).addClass("is-invalid");
        
//         var feildlen = $('#' + id).val().length;
//         if (feildlen > 0) {
//             $('#' + id).val($('#' + id).val().slice(0, -1));
//         }
//         return false;
//     }
//     if(mobNum==''){
      
//       $('#'+id).removeClass('is-invalid');
//     }
// });

// function onlynumericdot(evt)
// {
// 	var charCode = (evt.which) ? evt.which : event.keyCode
// 	if((charCode >= 48 && charCode <= 57) || charCode == 8  || charCode == 46){
// 		return true;
// 	}else{
// 		return false;      
// 	}
// }

// $(document).on("keypress",".decimallatitude,.decimallongitude", function(event){
//     console.log('decimallatitude')
//     var $this = $(this);
//     if ((event.which != 46 || $this.val().indexOf('.') != -1) &&
//     ((event.which < 48 || event.which > 57) &&
//     (event.which != 0 && event.which != 8))) {
//     event.preventDefault();
//     }

//     var text = $(this).val();
//     if ((event.which == 46) && (text.indexOf('.') == -1)) {
//     setTimeout(function() {
//     if ($this.val().substring($this.val().indexOf('.')).length > 6) {
//     $this.val($this.val().substring(0, $this.val().indexOf('.') + 20));
//     }
//     }, 1);
//     }

//     if ((text.indexOf('.') != -1) &&
//     (text.substring(text.indexOf('.')).length > 20) &&
//     (event.which != 0 && event.which != 8) &&
//     ($(this)[0].selectionStart >= text.length - 20)) {
//     event.preventDefault();
//     }
// });

// $(document).on("keypress",".decimaltwo", function(event){
//     var $this = $(this);
//     if ((event.which != 46 || $this.val().indexOf('.') != -1) &&
//     ((event.which < 48 || event.which > 57) &&
//     (event.which != 0 && event.which != 8))) {
//     event.preventDefault();
//     }

//     var text = $(this).val();
//     if ((event.which == 46) && (text.indexOf('.') == -1)) {
//     setTimeout(function() {
//     if ($this.val().substring($this.val().indexOf('.')).length > 3) {
//     $this.val($this.val().substring(0, $this.val().indexOf('.') + 3));
//     }
//     }, 1);
//     }

//     if ((text.indexOf('.') != -1) &&
//     (text.substring(text.indexOf('.')).length > 3) &&
//     (event.which != 0 && event.which != 8) &&
//     ($(this)[0].selectionStart >= text.length - 3)) {
//     event.preventDefault();
//     }
// });

// $(document).on('change', '.increaseOnly', function() {
//     var currentVal = $(this).attr('data-current');
//     console.log(currentVal,'currentVal for element')
//     if (parseFloat($(this).val()) < parseFloat(currentVal)) {
//             $(this).val(currentVal);
//     }
// });