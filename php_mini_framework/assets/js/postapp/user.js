
function createUser(e){

	var data = $('#frm-adduser').serialize()+'&path=postapp/user&key=new';
	ajaxForm('#frm-adduser',{ type:'post', data:data, root:"postapp"},e);
}