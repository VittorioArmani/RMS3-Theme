/*
Simple Image Trail script- By JavaScriptKit.com
Visit http://www.javascriptkit.com for this script and more
This notice must stay intact
*/

var offsetfrommouse=[15,25]; //image x,y offsets from cursor position in pixels. Enter 0,0 for no offset
var displayduration=0; //duration in seconds image should remain visible. 0 for always.

var defaultimageheight = 40;	// maximum image size.
var defaultimagewidth = 40;	// maximum image size.

var timer;

function gettrailobj(){
	if (document.getElementById)
		return document.getElementById("preview_div").style
}

function gettrailobjnostyle(){
	if (document.getElementById)
		return document.getElementById("preview_div")
}


function truebody(){
	//return (!window.opera && document.compatMode && document.compatMode!="BackCompat")? document.documentElement : document.body
	return (document.compatMode && document.compatMode!="BackCompat")? document.documentElement : document.body
}


function hidetrail(){
	gettrailobj().display= "none";
	document.onmousemove=""
	gettrailobj().left="-500px"
	clearTimeout(timer);
}

function showtrail(imagename,title,width,height){
	i = imagename
	t = title
	w = width
	h = height
	timer = setTimeout("show('"+i+"',t,w,h);",20);
}
function show(imagename,title,width,height){

	var docwidth=document.all? truebody().scrollLeft+truebody().clientWidth : pageXOffset+window.innerWidth - offsetfrommouse[0]
	var docheight=document.all? Math.min(truebody().scrollHeight, truebody().clientHeight) : Math.min(window.innerHeight)

	if( (navigator.userAgent.indexOf("Konqueror")==-1  || navigator.userAgent.indexOf("Firefox")!=-1 || (navigator.userAgent.indexOf("Opera")==-1 && navigator.appVersion.indexOf("MSIE")!=-1)) && (docwidth>650 && docheight>500)) {
		( width == 0 ) ? width = defaultimagewidth: '';
		( height == 0 ) ? height = defaultimageheight: '';

		width+=30
		height+=55
		defaultimageheight = height
		defaultimagewidth = width

		document.onmousemove=followmouse;

		if (imagename.substr(imagename.length-4, 4) == '.flv') {

			newHTML = '<div class="border_preview" ><div id="loader_container"></div>';
			newHTML = newHTML + '<h2 class="title_h2" style="width:200px;">' + ' '+title + '</h2>'
			newHTML = newHTML + '<div class="preview_temp_load"><object id="previewImage" classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=7,0,19,0" width="' + (width-30) +'" height="' + (height-55) + '">\n\
<param name="allowScriptAccess" value="sameDomain" /> \n\
<param name="allowFullScreen" value="true" /> \n\
<param name="quality" value="high"> \n\
<param name="menu" value="false"> \n\
<param id="nameValueFLV" name="movie" value="/themes/default/images/popup-player.swf?titleVideo=' + imagename + '" />\n\
<param name="quality" value="high" /> \n\
<param name="bgcolor" value="#010101" /> \n\
<embed src="/themes/default/images/popup-player.swf?titleVideo=' + imagename + '" quality="high" menu="false" bgcolor="#010101"  width="' + (width-30) +'" height="' + (height-55) + '" name="video" align="middle" allowScriptAccess="sameDomain" allowFullScreen="true" type="application/x-shockwave-flash" pluginspage="http://www.macromedia.com/go/getflashplayer" /></embed> \n\
</object></div>';

		} else {
			newHTML = '<div class="border_preview" style="width:'+  width +'px;height:'+ height +'px"><div id="loader_container"><div id="loader"><div align="center">Loading template preview...</div><div id="loader_bg"><div id="progress"> </div></div></div></div>';
			newHTML = newHTML + '<h2 class="title_h2">' + ' '+title + '</h2>'
			newHTML = newHTML + '<div class="preview_temp_load"><img id="previewImage" onload="javascript:remove_loading();" src="' + imagename + '" border="0"></div>';
		}
		newHTML = newHTML + '</div>';

		if(navigator.userAgent.indexOf("MSIE")!=-1 && navigator.userAgent.indexOf("Opera")==-1 ){
			var ie_iframe_width = width - 10;
			var ie_iframe_height = height - 5;
			newHTML = newHTML+'<iframe src="about:blank" scrolling="no" frameborder="0" width="'+ie_iframe_width+'" height="'+ie_iframe_height+'"></iframe>';
		}

		gettrailobjnostyle().innerHTML = newHTML;
		gettrailobj().display="block";
	}
	if(document.getElementById('previewImage').complete)
		remove_loading();//chrome does not throw onload event if object was cashed
}

function followmouse(e){

	var xcoord=offsetfrommouse[0]
	var ycoord=offsetfrommouse[1]

	var docwidth=document.all? truebody().scrollLeft+truebody().clientWidth : pageXOffset+window.innerWidth-15
	var docheight=document.all? Math.min(truebody().scrollHeight, truebody().clientHeight) : Math.min(window.innerHeight)

	if (typeof e != "undefined"){
		if (docwidth - e.pageX < defaultimagewidth + 2*offsetfrommouse[0]){
			xcoord = e.pageX - xcoord - defaultimagewidth; // Move to the left side of the cursor
		} else {
			xcoord += e.pageX;
		}                
		if (navigator.userAgent.indexOf("Safari")!=-1 || navigator.userAgent.indexOf("Chrome")!=-1){
			sTop = window.pageYOffset;
		} else {
			sTop = truebody().scrollTop;
		}
		if (docheight - e.pageY < defaultimageheight + 2*offsetfrommouse[1]){
			ycoord += e.pageY - Math.max(0,(2*offsetfrommouse[1] + defaultimageheight + e.pageY - docheight - sTop));
		} else {
			ycoord += e.pageY;
		}

	} else if (typeof window.event != "undefined"){
		if (docwidth - event.clientX < defaultimagewidth + 2*offsetfrommouse[0]){
			xcoord = event.clientX + truebody().scrollLeft - xcoord - defaultimagewidth; // Move to the left side of the cursor
		} else {
			xcoord += truebody().scrollLeft+event.clientX
		}
		if (docheight - event.clientY < (defaultimageheight + 2*offsetfrommouse[1])){
			ycoord += event.clientY + truebody().scrollTop - Math.max(0,(2*offsetfrommouse[1] + defaultimageheight + event.clientY - docheight));
		} else {
			ycoord += truebody().scrollTop + event.clientY;
		}
	}
	gettrailobj().left=xcoord+"px"
	gettrailobj().top=ycoord+"px"

}

var t_id = setInterval(animate,20);
var pos=0;
var dir=2;
var len=0;

function animate()
{
	var elem = document.getElementById('progress');
	if(elem != null) {
		if (pos==0) len += dir;
		if (len>32 || pos>79) pos += dir;
		if (pos>79) len -= dir;
		if (pos>79 && len==0) pos=0;
		elem.style.left = pos+"px";
		elem.style.width = len+"px";
	}
}

function remove_loading() {
	this.clearInterval(t_id);
	var targelem = document.getElementById('loader_container');
	targelem.style.display='none';
	targelem.style.visibility='hidden';
	var t_id = setInterval(animate,60);
}