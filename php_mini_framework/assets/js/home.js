
function sendContact(e){

	var data = $("#frm-addcontact").serialize()+'&path=app/home&key=new';   	
	ajaxForm("#frm-addcontact",{ type:'post',data:data },e);
}