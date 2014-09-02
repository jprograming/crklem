
function authenticate(e){

	var data = $('#frm-login').serialize()+'&path=postapp/login&key=enter';
	ajaxForm('#frm-login',{ type:'post', data:data, root:"postapp"},e);
}