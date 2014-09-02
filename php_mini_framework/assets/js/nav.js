//aqui modificar la clave root para ajax o carga de archivos, imagenes,..etc

var _urls = {root:"/demos/nav/nav_3.0.0/"};
_urls.postapp = _urls.root +"postapp/";  // alojamiento de la raiz de otra aplicacion
var base_img = _urls.root+"assets/images/";
//var base_img_css = _urls.root+"assets/vendor/charisma/img/";

// ---- FUNCIONES QUE INVOLOCRAN PETICIONES VIA AJAX ----
//enviar un formulario por ajax
function ajaxForm(form,options,e){

	e.preventDefault();	 	
	options.data = attrAjax(options.data);
	var $btn = $(form+" input[type=submit]");
	$btn.attr('disabled',true);
	innerLoading(form);
	$(".error").removeClass("error");
	$(".er-msg").remove();
	removeToasMsg(); 
	$.ajax({
		url: getRoot(options.root),
		type: options.type,
		data: options.data,
		dataType: 'json',
		success: function(res){
			setTimeout(function(){
                     removeLoading();
                     $btn.attr('disabled',false);
                     if(res == null) return;
                     if(res.message != undefined && res.message != ""){
                     	if(res.status == 0) errorsValidate(res.field);
                     	else{
                     		var types = {"1":"success","2":"warning","-1":"error"};
                     		var opt = {text:res.message,stayTime:1000};
                     		opt.type = types[res.status];
                     		if(res.target != undefined){                     			
                     			opt.close = function(){	window.location = res.target; }
                     		}else if(res.data != undefined && options.callback != undefined){
                     			opt.close = function(){	options.callback(res.data); }
                     		}else{
                     			opt.sticky = true;
                     			opt.position = 'middle-right';
                     		}
                     		showToasMsg(form,opt);
                     	}                     	
                     }else{
                     	if(res.status == 11 && options.callback != undefined)
                     	    options.callback(res.data);
                     }
		    }, 700);
		}
	});
}
//funcion para eliminar(cambiar estado) un registro 
function deleteRecord(options){
	
	options.btn.disabled = true;
	options.data = attrAjax(options.data);	 
	$.ajax({
		url: getRoot(options.root),
		type: options.type,
		data: options.data,
		dataType: 'json',
		success: function(res){ 
			options.btn.disabled = false;
			var opt = {text:res.message}; 
			if(res.status == 1){
				if(res.target == undefined)	{
					removeRow(options.row);
					if(options.callback != undefined){
						opt.close = function(){
	                     	if(res.data != undefined)
	                     	  	options.callback(res.data);
	                        else options.callback();
						}
                    }          
				}else{
					 opt.close = function(){
                     	 window.location = res.target;
                     }
				}
				opt.type = 'success';
				opt.stayTime = 1000;
			}else {
				opt.type = 'error';
				opt.sticky = true;
			}	
			showToasMsg('.table',opt); 
		}
	});
}
//funcion para mostrar una vista via ajax en un Modal
function showAjaxModal(element,path,extra,root){
	
	if(extra == undefined) var extra = null;
	var data = { ajax:true, path:path };
	for(var attr in extra){
		data[attr] = extra[attr];
	}	
	$.ajax({
		url:getRoot(root),
		type:"post",
		data:data,
		success:function(html){ 
			$(element).html(html);
			$(element).modal('show');
		}
	})
}
function getRoot(root){
	return (root == undefined) ? _urls.root : _urls[root];//path_root : root; 
}
function attrAjax(param){
	if(typeof(param) == 'string') param += '&ajax=true';
	else param.ajax = true;
	return param;
}
// ---- FUNCIONES PARA LA CARGA DE MEJORAS VISUALES, ESTILOS PARA CONTROLES
//funcion para agregar la clase error a los campos 
function errorsValidate(fields){	

	for(var i=0; i<fields.length; i++){    	
        var htm = '<span class="help-block er-msg">'+fields[i].message+'</span>';
        $("#"+ fields[i].fname).parent().parent().addClass("error");
        $("#"+ fields[i].fname).after(htm);      
    }
    $("#"+ fields[0].fname).focus();
}
 
// funcion para cargar estilos en campos file, checkbox y radio
function initUniform(){
	$("input:checkbox, input:radio").not('[data-no-uniform="true"]').uniform();
}
//mostrar el loading
function innerLoading(element){
	
	removeLoading();
	$(element).after('<div id="loading" class="center">Loading...<div class="center"></div></div>');
}
//remover loading
function removeLoading(){
	$('#loading').remove();	
}
//funciones para el plugin datatable
var oTable = null;
function showTable(element,sort){
	
	$(element).fadeOut();
	innerLoading(element);//".box-content");
	if(sort != undefined)
		sort = [[sort.index, sort.order]];
 	else sort = [];
	setTimeout(function(){
		$('#loading').remove();
		$(element).fadeIn();
		oTable = $(element).dataTable({
			"sDom": "<'row-fluid'<'span6'l><'span6'f>r>t<'row-fluid'<'span12'i><'span12 center'p>>",
			"sPaginationType": "bootstrap",
			"oLanguage": {
				"sLengthMenu": "_MENU_ records per page"
			},
			"aaSorting" : sort
		}); 	
	},1000)
	
}
//remover una fila del datatable
function removeRow(row){
	
	oTable.fnDeleteRow(row);
}
//funciones para el plugin toasMessage
var myToast = null;
function showToasMsg(elmparent,options){
	
	$(elmparent).after('<div id="msg"></div>');
	myToast = $("#msg").toastmessage('showToast', options);
}

function removeToasMsg(){
	if(myToast != null) $("#msg").toastmessage('removeToast', myToast);
	if($("#msg").length > 0) $("#msg").remove();
}
//iniciar campos datepicker
function setDatepicker(){

	var months = ['Enero','Febrero','Marzo','Abril','Mayo','Junio','Julio','Agosto',
				  'Septiembre','Octubre','Noviembre','Diciembre'];
	var daysMin = ['D','L','M','M','J','V','S'];
	$('.datepicker').datepicker({
		dateFormat: "yy-mm-dd",
		monthNames: months,
		dayNamesMin: daysMin,
		firstDay: 1 
	});
}
function viewerPhoto(element){

	$(element+" a[rel^='prettyPhoto']").prettyPhoto({
		animation_speed:'fast',
		allow_resize: true,				
		slideshow:10000, 
		theme: 'facebook',
		hideflash: true,
		social_tools: false
	});	
}

//establecer un item seleccionado al combo
function itemSelected(combo,itemSelected){
	$(combo + ' option[value='+ itemSelected +']').attr("selected",true);
}
//iniciar campos timepicker
function setTimepicker(element,options){
	if(options == undefined) var options = null;
	$(element).timepicker(options);
}
//iniciar tabs bootstrap
function setTabs(element){

	$(element +' a:first').tab('show');
	$(element + ' a').click(function (e) {
	  e.preventDefault();
	  $(this).tab('show');
	});
}
//inicar campos select chosen
function setChosen(){
	$('[data-rel="chosen"],[rel="chosen"]').chosen();
}
// colapsar contenido de una caja usando un boton con la clase btn-minimize
function minimize(){
	$('.btn-minimize').click(function(e){
		e.preventDefault();
		var $target = $(this).parent().parent().next('.box-content');
		if($target.is(':visible')) $('i',$(this)).removeClass('icon-chevron-up').addClass('icon-chevron-down');
		else $('i',$(this)).removeClass('icon-chevron-down').addClass('icon-chevron-up');
		$target.slideToggle();
	});
}
/*	FUNCIONES GENERALES SOBRE DATOS TIPO STRING, ..etc */
//trim 
function trim(value){
	value=value.replace(/^\s*|\s*$/g,"");
	return value;
}
function removeNewline(string){
  
  string =  string.replace(/\r\n|\n|\r/g, '');
  return string.replace(/\t/g, '');
}
function replaceAll(str,search,newVal){

  if(str.indexOf(search) > -1) str = str.replace(search,newVal);
  while (str.indexOf(search) > -1)
      	str = str.replace(search,newVal);
  return str; 
}

function getLocalDate(){

	var mydate=new Date()
	var year=mydate.getYear()
	if (year < 1000)
	year+=1900
	var day=mydate.getDay()
	var month=mydate.getMonth()
	var daym=mydate.getDate()
	if (daym<10)
	daym="0"+daym
	var days =["Domingo","Lunes","Martes","Miercoles","Jueves","Viernes","Sabado"];
	var months= ["Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre",
				"Octubre","Noviembre","Diciembre"];
	return days[day]+", "+daym+" de "+months[month]+" de "+ year;	
}