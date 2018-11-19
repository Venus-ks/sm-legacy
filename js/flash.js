function flash(c,d,e) {
 var flash_tag = "";
 flash_tag = '<OBJECT classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" ';
 flash_tag +='codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=6,0,29,0" ';
 flash_tag +='WIDTH="'+c+'" HEIGHT="'+d+'" >';
 flash_tag +='<param name="wmode" value="transparent">'; 
 flash_tag +='<param name="movie" value="'+e+'">';
 flash_tag +='<param name="quality" value="high">';
 flash_tag +='<embed src="'+e+'" quality="high" pluginspage="http://www.macromedia.com/go/getflashplayer" ';
 flash_tag +='type="application/x-shockwave-flash"  WIDTH="'+c+'" HEIGHT="'+d+'"></embed></object>'
 document.write(flash_tag);
}




/*----------------------------------------------------------------------------------------------------------
swf object
swfprint('Object ID','경로','width','height','투명여부 (o-불투명 / t-투명)','변수명=xml경로&변수명=경로');
----------------------------------------------------------------------------------------------------------*/
//브라우져 체크
appname = navigator.appName;
useragent = navigator.userAgent;
if(appname == "Microsoft Internet Explorer") appname = "IE";
IE55 = (useragent.indexOf('MSIE 5.5')>0);  //5.5 버전
IE6 = (useragent.indexOf('MSIE 6')>0);     //6.0 버전
IE7 = (useragent.indexOf('MSIE 7')>0);     //7.0 버전
IE8 = (useragent.indexOf('MSIE 8')>0);     //8.0 버전
//오브젝트 호출
function swfprint(objid,furl,fwidth,fheight,transoption,flashvars,pscale) {
if(pscale == null) {
pscale = "noscale";
}
if (typeof(scheme) == 'undefined' || scheme == null) {
scheme = 'http';
}

var ieTxt = '<object id="'+ objid +'" classid="clsid:d27cdb6e-ae6d-11cf-96b8-444553540000" codebase="'+scheme+'"://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=10,0,0,0" width="'+ fwidth +'" height="' + fheight +'" align="middle">';
ieTxt += '<param name="allowScriptAccess" value="always"/>';
ieTxt += '<param name="movie" value="'+ furl +'"/>';
ieTxt += '<param name="quality" value="high"/>';
ieTxt += '<param name="bgcolor" value="#ffffff"/> ';
ieTxt += '<param name="salign" value="T"/> ';
ieTxt += '<param name="menu" value="false"/> ';
if (flashvars) ieTxt += '<param name="flashVars" value="'+ flashvars +'">';
if (transoption == "t") {
ieTxt += '<param name="wmode" value="transparent"/>';
} else if	(transoption == "o") {
ieTxt += '<param name="wmode" value="opaque"/>';
}
ieTxt += '</object>';

var ffTxt = '<object id="'+ objid +'" type="application/x-shockwave-flash" data="'+ furl +'" width="'+ fwidth +'" height="' + fheight +'"';
if (flashvars) ffTxt += ' flashVars="'+ flashvars +'" ';
if (transoption == "t")	{
ffTxt += ' wmode="transparent"';
} else if (transoption == "o") {
ffTxt += ' wmode="opaque"';
}
ffTxt +='allowScriptAccess="always"';
ffTxt += '></object>';

if(appname=="IE") document.write(ieTxt);
else  document.write(ffTxt);
}