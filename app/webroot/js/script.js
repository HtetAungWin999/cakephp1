/**
 * Common Javascript
 * 
 * @author		Su Myat Mon
 */
const SYSTEM_URL= "/CakeTest/";
/**
 * Validate Email
 *
 * @param email
 * @reutrn True (valid) | False (not valid)
 */
function validateEmail(email) {
    var re = /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    return re.test(email);
}

/**
 * Validate Phone Number
 *
 * @param phone
 * @reutrn True (valid) | False (not valid)
 */
function validatePhone(phone) {
	var re = /^(?:(?:\(?(?:00|\+)([1-4]\d\d|[1-9]\d?)\)?)?[\-\.\ \\\/]?)?((?:\(?\d{1,}\)?[\-\.\ \\\/]?){0,})(?:[\-\.\ \\\/]?(?:#|ext\.?|extension|x)[\-\.\ \\\/]?(\d+))?$/g;
    return re.test(phone);
}

function validateNRC(nrc) {
	var re = /^[0-9]{0,2}\/[a-zA-Z]{0,9}\([a-zA-Z]\)[0-9]{0,6}/g;
	//var re = /[0-9] | [0-9][0-9]\[A-Z]([A-Z])[0-9][0-9][0-9][0-9][0-9][0-9]/g;
    return re.test(nrc);
}

/**
 * Validate Number Only
 *
 * @param num
 * @reutrn True (valid) | False (not valid)
 */
function validateNumberOnly(num) {
	var re = /^\d+$/;
    return re.test(num);
}

/**
 * Check Number Between Two Value
 *
 * @param number, check value1, check value2
 * @reutrn True (valid) | False (not valid)
 */
function isBetween(n, a, b) {
	return (n - a) * (n - b) <= 0
}

/**
 * Check null or blank
 *
 * @param num
 * @reutrn True (has value) | False (null or blank)
 */
function checkNullOrBlank(value) {
	if (value == '' || value == null) {
		return false;
	} 
    return true;
}

/**
 * Left Padding
 *
 * @param original string
 * @param count of padding
 * @param padding character (default '0')
 * @reutrn padding string 
 */
function paddy(n, p, c) {
    var pad_char = typeof c !== 'undefined' ? c : '0';
    var pad = new Array(1 + p).join(pad_char);
    return (pad + n).slice(-pad.length);
}

/**
 * Validate Singal Byte Character
 *
 * @param string
 * @reutrn True (valid) | False (not valid)
 */
function isHan(str){
    for (var i=0; i<str.length; i++) {
        var len=escape(str.charAt(i)).length;
        if (len<4){
        }else{
            return false;
        }
    }
    return true;
}

/**
 * Validate Singal Byte Alpha Character
 *
 * @param Html Object
 * @reutrn True (valid) | False (not valid)
 */
function isHanAlpha(obj){
    var str=obj.value;
    for(var i=0 ; i<str.length; i++){
        var code=str.charCodeAt(i);
        if ((65<=code && code<=90) || (97<=code && code<=122) || 
             str.substr(i,1)==' ') {

        }else{
            return false;
        }
    }
    return true;
}

/**
 * Validate Formart (15 Digit and 2 Decimal Point)
 *
 * @param value
 * @reutrn True (valid) | False (not valid)
 */
function isDecimal(value){
	var decimalOnly = /^\s*-?(\d{1,15})(\.\d{0,})?\s*$/;
	if(decimalOnly.test(value)) {
		return true;
	}
	return false;
}

/**
 * Validate Formart (8 Digit and 2 Decimal Point)
 *
 * @param value
 * @reutrn True (valid) | False (not valid)
 */
function is2Decimal(value){
	var decimalOnly =/^\s*-?(\d{1,8})(\.\d{0,2})?\s*$/;
	if(decimalOnly.test(value)) {
		return true;
	}
	return false;
}

/**
 * Validate Formart (English Character & Number Only)
 * 
 * @param value
 * @reutrn True (valid) | False (not valid)
 */
function englishCharacterNumberOnly(value) {
	var engstr = /^[a-zA-Z0-9_ -().'"/:;]*$/;
	if(engstr.test(value)) {
		return true;
	}
	return false;
}

function engcharNumberOnly(value) {
	var engstr = /^[A-Za-z0-9]*$/;
	if(engstr.test(value)) {
		return true;
	}
	return false;
}


/**
 * Change Number format with commas
 *
 * @param value
 * @reutrn string with commas
 */
function numberWithCommas(x) {
    return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
}

/**
 * Change Number format without commas
 *
 * @param value
 * @reutrn string without commas
 */
function removeCommas(str) {
    return(str.replace(/,/g,''));
}

/**
 * Round Method
 *
 * @param value
 * @param decimal ponit (default '0')
 * @reutrn rounded value
 */
function round(value, decimals) {
    return parseFloat(Math.round(value+'e'+decimals)+'e-'+decimals);
}

/**
 * Prevent callback perivous page using backspace key
 *
 * @param -
 */
$(function(){
    var rx = /INPUT|SELECT|TEXTAREA/i;

    $(document).bind("keydown keypress", function(e){
        if( e.which == 8 ){
            if(!rx.test(e.target.tagName) || e.target.disabled || e.target.readOnly ){
                e.preventDefault();
            }
        }
    });
    
});

/**
 * Change Language Setting
 *
 * @param language
 * 
 * @return 
 */
function changeLanguage(language) {
	$.ajax({
	    type: 'post',
	    url: SYSTEM_URL + 'app/changeLanguage',
	    data: { 
	        'language': language
	    },
	    dataType: 'json',
	    success: function(response) {			
	        if (response.content) {
	        	location.reload();
	        }					
		},
	    error: function(e) {
	        //custom_alert('There has some wrong. Please check your connection.', 'Error', '');
	        //alert('There has some wrong. Please check your connection.');
	    }
	}); 
}
/**
 * ErrorMessage Method
 *
 * @param formartErrMsg
 * @param dynamicValues
 * @param msgShowDivName
 * 
 * @reutrn Error Message
 */
function errMsg(formartErrMsg, dynamicValues, showDivName) {
	var msg = "";
	var divName = "#error";
	
	if (showDivName !== undefined) {
		divName = "#" + showDivName ;
	}

	/*if (checkNullOrBlank($(divName).html())) {
		msg += "</br>";
	}*/
	
	msg += vsprintf(formartErrMsg, dynamicValues);
	return msg;
}

/**
 * Check max length
 *
 * @param num
 * @reutrn True (has value) | False (length exceed)
 */
function checkMaxLength(value,num) {	
	if (value.length > num) {
		return false;
	} 
    return true;
}


$(function () {
        //Datemask dd/mm/yyyy
        $("#datemask").inputmask("dd/mm/yyyy", {"placeholder": "dd/mm/yyyy"});
        //Datemask2 mm/dd/yyyy
        $("#datemask2").inputmask("mm/dd/yyyy", {"placeholder": "mm/dd/yyyy"});
        //Money Euro
        $("[data-mask]").inputmask();

        //Date range picker
        $('#reservation').daterangepicker();
        //Date range picker with time picker
        $('#reservationtime').daterangepicker({timePicker: true, timePickerIncrement: 30, format: 'MM/DD/YYYY h:mm A'});
        //Date range as a button
        $('#daterange-btn').daterangepicker(
                {
                  ranges: {
                    'Today': [moment(), moment()],
                    'Yesterday': [moment().subtract('days', 1), moment().subtract('days', 1)],
                    'Last 7 Days': [moment().subtract('days', 6), moment()],
                    'Last 30 Days': [moment().subtract('days', 29), moment()],
                    'This Month': [moment().startOf('month'), moment().endOf('month')],
                    'Last Month': [moment().subtract('month', 1).startOf('month'), moment().subtract('month', 1).endOf('month')]
                  },
                  startDate: moment().subtract('days', 29),
                  endDate: moment()
                },
        function (start, end) {
          $('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
        }
        );

        //iCheck for checkbox and radio inputs
        $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
          checkboxClass: 'icheckbox_minimal-blue',
          radioClass: 'iradio_minimal-blue'
        });
        //Red color scheme for iCheck
        $('input[type="checkbox"].minimal-red, input[type="radio"].minimal-red').iCheck({
          checkboxClass: 'icheckbox_minimal-red',
          radioClass: 'iradio_minimal-red'
        });
        //Flat red color scheme for iCheck
        $('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
          checkboxClass: 'icheckbox_flat-green',
          radioClass: 'iradio_flat-green'
        });
		
		$(".datetimepicker").datepicker({
			format: "yyyy-mm-dd",
			autoclose: true,
			todayBtn: true,
			pickerPosition: "bottom-left"
		});
		
		 //Timepicker
        $(".timepicker").timepicker({
          showInputs: false
        });
       
	});
	
	/**
	 * Validate Formart (English Character)
	 * 
	 * @param value
	 * @reutrn True (valid) | False (not valid)
	 */
	function englishCharacterOnly(value) {
		var engstr = /^[a-zA-Z-_ ]+$/;
		if(engstr.test(value)) {
			return true;
		}
		return false;
	}
	
	
	

	
	