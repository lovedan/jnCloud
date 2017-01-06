
jQuery(document).ready(function() {
	
    /*
        Fullscreen background
    */
    $.backstretch("asset/images/backgrounds/1.jpg");
    
    $('#top-navbar-1').on('shown.bs.collapse', function(){
    	$.backstretch("resize");
    });
    $('#top-navbar-1').on('hidden.bs.collapse', function(){
    	$.backstretch("resize");
    });
    
    /*
        Form validation
    */
    $('.registration-form input[type="text"], .registration-form textarea').on('focus', function() {
    	$(this).removeClass('input-error');
    });
    
    $('.registration-form').on('submit', function(e) {
    	
    	$(this).find('input[type="text"], textarea').each(function(){
    		if( $(this).val() == "" ) {
    			e.preventDefault();
    			$(this).addClass('input-error');
    		}
    		else {
    			$(this).removeClass('input-error');
    		}
    	});
    	
    });

    $.getUrlParam = function(name)
    {
        var reg = new RegExp("(^|&)"+ name +"=([^&]*)(&|$)");
        var r = encodeURI(window.location.search).substr(1).match(reg);
        if (r!=null) return unescape(r[2]); return null;
    }

    $("#baidu").click(function(){
        $('#myModal').modal('show');
    });

    $('#shouquan').bootstrapValidator({
        message: 'This value is not valid',
        feedbackIcons: {
            // valid: 'glyphicon glyphicon-ok',
            // invalid: 'glyphicon glyphicon-remove',
            // validating: 'glyphicon glyphicon-refresh'
        },
        container: '.with-errors',
        fields: {
            code: {
                message: 'The username is not valid',
                validators: {
                    notEmpty: {
                        message: '授权码不能为空！'
                    },
                    stringLength: {
                        min: 6,
                        max: 35,
                        message: '授权码为6到35个字母或者数字！'
                    },
                    regexp: {
                        regexp: /^[a-zA-Z0-9_]+$/,
                        message: '只可以输入数字字母或者下划线！'
                    }
                }
            },
            email: {
                validators: {
                    notEmpty: {
                        message: 'The email is required and cannot be empty'
                    },
                    emailAddress: {
                        message: 'The input is not a valid email address'
                    }
                }
            }
        }
    });
    if($.getUrlParam('messages') != '' && $.getUrlParam('messages') != null){
        $("#messages .modal-title").html("❌错误信息");
        $("#messages .modal-body .te").html("<B>"+ decodeURIComponent($.getUrlParam('messages'))+ "</B>");//修改body

        $('#messages').modal('show');
        // alert(decodeURIComponent($.getUrlParam('messages')))
    }
});
