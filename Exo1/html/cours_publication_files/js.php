var DOKU_BASE='/wiki/';var DOKU_TPL='/wiki/lib/tpl/default/';var alertText='Please enter the text you want to format.\nIt will be appended to the end of the document.';var notSavedYet='Unsaved changes will be lost.\nReally continue?';var reallyDel='Really delete selected item(s)?';LANG={"keepopen":"Keep window open on selection","hidedetails":"Hide Details","plugins":[]};function isUndefined(prop){return(typeof prop=='undefined');}function isFunction(prop){return(typeof prop=='function');}function isString(prop){return(typeof prop=='string');}function isNumber(prop){return(typeof prop=='number');}function isNumeric(prop){return isNumber(prop)&&!isNaN(prop)&&isFinite(prop);}function isArray(prop){return(prop instanceof Array);}function isRegExp(prop){return(prop instanceof RegExp);}function isBoolean(prop){return('boolean'==typeof prop);}function isScalar(prop){return isNumeric(prop)||isString(prop);}function isEmpty(prop){if(isBoolean(prop))return false;if(isRegExp(prop)&&new RegExp("").toString()==prop.toString())return true;if(isString(prop)||isNumber(prop))return!prop;if(Boolean(prop)&&false!=prop){for(var i in prop)if(prop.hasOwnProperty(i))return false}return true;}if('undefined'==typeof Object.hasOwnProperty){Object.prototype.hasOwnProperty=function(prop){return!('undefined'==typeof this[prop]||this.constructor&&this.constructor.prototype[prop]&&this[prop]===this.constructor.prototype[prop]);}}function addEvent(element,type,handler){if(!handler.$$guid)handler.$$guid=addEvent.guid++;if(!element.events)element.events={};var handlers=element.events[type];if(!handlers){handlers=element.events[type]={};if(element["on"+type]){handlers[0]=element["on"+type];}}handlers[handler.$$guid]=handler;element["on"+type]=handleEvent;};addEvent.guid=1;function removeEvent(element,type,handler){if(element.events&&element.events[type]){delete element.events[type][handler.$$guid];}};function handleEvent(event){var returnValue=true;event=event||fixEvent(window.event);var handlers=this.events[event.type];for(var i in handlers){if(!handlers.hasOwnProperty(i))continue;this.$$handleEvent=handlers[i];if(this.$$handleEvent(event)===false){returnValue=false;}}return returnValue;};function fixEvent(event){event.preventDefault=fixEvent.preventDefault;event.stopPropagation=fixEvent.stopPropagation;event.target=event.srcElement;return event;};fixEvent.preventDefault=function(){this.returnValue=false;};fixEvent.stopPropagation=function(){this.cancelBubble=true;};window.fireoninit=function(){if(arguments.callee.done)return;arguments.callee.done=true;if(_timer){clearInterval(_timer);_timer=null;}if(typeof window.oninit=='function'){window.oninit();}};if(document.addEventListener){document.addEventListener("DOMContentLoaded",window.fireoninit,null);}/*@cc_on @*//*@if(@_win32)document.write("<scr"+"ipt id=\"__ie_init\" defer=\"true\" src=\"//:\"><\/script>");var script=document.getElementById("__ie_init");script.onreadystatechange=function(){if(this.readyState=="complete"){window.fireoninit();}};/*@end @*/if(/WebKit/i.test(navigator.userAgent)){var _timer=setInterval(function(){if(/loaded|complete/.test(document.readyState)){window.fireoninit();}},10);}window.onload=window.fireoninit;window.oninit=function(){};function addInitEvent(func){var oldoninit=window.oninit;if(typeof window.oninit!='function'){window.oninit=func;}else{window.oninit=function(){oldoninit();func();};}}DokuCookie={data:Array(),name:'DOKU_PREFS',setValue:function(key,val){DokuCookie.init();DokuCookie.data[key]=val;var now=new Date();DokuCookie.fixDate(now);now.setTime(now.getTime()+365*24*60*60*1000);var text='';for(var key in DokuCookie.data){if(!DokuCookie.data.hasOwnProperty(key))continue;text+='#'+escape(key)+'#'+DokuCookie.data[key];}DokuCookie.setCookie(DokuCookie.name,text.substr(1),now,DOKU_BASE);},getValue:function(key){DokuCookie.init();return DokuCookie.data[key];},init:function(){if(DokuCookie.data.length)return;var text=DokuCookie.getCookie(DokuCookie.name);if(text){var parts=text.split('#');for(var i=0;i<parts.length;i+=2){DokuCookie.data[unescape(parts[i])]=unescape(parts[i+1]);}}},setCookie:function(name,value,expires,path,domain,secure){var curCookie=name+"="+escape(value)+((expires)?"; expires="+expires.toGMTString():"")+((path)?"; path="+path:"")+((domain)?"; domain="+domain:"")+((secure)?"; secure":"");document.cookie=curCookie;},getCookie:function(name){var dc=document.cookie;var prefix=name+"=";var begin=dc.indexOf("; "+prefix);if(begin==-1){begin=dc.indexOf(prefix);if(begin!==0){return null;}}else{begin+=2;}var end=document.cookie.indexOf(";",begin);if(end==-1){end=dc.length;}return unescape(dc.substring(begin+prefix.length,end));},fixDate:function(date){var base=new Date(0);var skew=base.getTime();if(skew>0){date.setTime(date.getTime()-skew);}}};var clientPC=navigator.userAgent.toLowerCase();var is_macos=navigator.appVersion.indexOf('Mac')!=-1;var is_gecko=((clientPC.indexOf('gecko')!=-1)&&(clientPC.indexOf('spoofer')==-1)&&(clientPC.indexOf('khtml')==-1)&&(clientPC.indexOf('netscape/7.0')==-1));var is_safari=((clientPC.indexOf('AppleWebKit')!=-1)&&(clientPC.indexOf('spoofer')==-1));var is_khtml=(navigator.vendor=='KDE'||(document.childNodes&&!document.all&&!navigator.taintEnabled));if(clientPC.indexOf('opera')!=-1){var is_opera=true;var is_opera_preseven=(window.opera&&!document.childNodes);var is_opera_seven=(window.opera&&document.childNodes);}var toolbar='';function updateAccessKeyTooltip(){var tip='ALT+';if(is_macos){tip='CTRL+';}if(is_opera){tip='SHIFT+ESC ';}if(tip=='ALT+'){return;}var exp=/\[ALT\+/i;var rep='['+tip;var elements=document.getElementsByTagName('a');for(var i=0;i<elements.length;i++){if(elements[i].accessKey.length==1&&elements[i].title.length>0){elements[i].title=elements[i].title.replace(exp,rep);}}elements=document.getElementsByTagName('input');for(var i=0;i<elements.length;i++){if(elements[i].accessKey.length==1&&elements[i].title.length>0){elements[i].title=elements[i].title.replace(exp,rep);}}elements=document.getElementsByTagName('button');for(var i=0;i<elements.length;i++){if(elements[i].accessKey.length==1&&elements[i].title.length>0){elements[i].title=elements[i].title.replace(exp,rep);}}}function $(){var elements=new Array();for(var i=0;i<arguments.length;i++){var element=arguments[i];if(typeof element=='string')element=document.getElementById(element);if(arguments.length==1)return element;elements.push(element);}return elements;}function isset(varname){return(typeof(window[varname])!='undefined');}function getElementsByClass(searchClass,node,tag){var classElements=new Array();if(node==null)node=document;if(tag==null)tag='*';var els=node.getElementsByTagName(tag);var elsLen=els.length;var pattern=new RegExp("(^|\\s)"+searchClass+"(\\s|$)");for(i=0,j=0;i<elsLen;i++){if(pattern.test(els[i].className)){classElements[j]=els[i];j++;}}return classElements;}function findPosX(object){var curleft=0;var obj=$(object);if(obj.offsetParent){while(obj.offsetParent){curleft+=obj.offsetLeft;obj=obj.offsetParent;}}else if(obj.x){curleft+=obj.x;}return curleft;}function findPosY(object){var curtop=0;var obj=$(object);if(obj.offsetParent){while(obj.offsetParent){curtop+=obj.offsetTop;obj=obj.offsetParent;}}else if(obj.y){curtop+=obj.y;}return curtop;}function jsEscape(text){var re=new RegExp("\\\\","g");text=text.replace(re,"\\\\");re=new RegExp("'","g");text=text.replace(re,"\\'");re=new RegExp('"',"g");text=text.replace(re,'&quot;');re=new RegExp("\\\\\\\\n","g");text=text.replace(re,"\\n");return text;}function escapeQuotes(text){var re=new RegExp("'","g");text=text.replace(re,"\\'");re=new RegExp('"',"g");text=text.replace(re,'&quot;');re=new RegExp("\\n","g");text=text.replace(re,"\\n");return text;}function prependChild(parent,element){if(!parent.firstChild){parent.appendChild(element);}else{parent.insertBefore(element,parent.firstChild);}}function showLoadBar(){document.write('<img src="'+DOKU_BASE+'lib/images/loading.gif" '+'width="150" height="12" alt="..." />');}function hideLoadBar(id){obj=$(id);if(obj)obj.style.display="none";}function addTocToggle(){if(!document.getElementById)return;var header=$('toc__header');if(!header)return;var obj=document.createElement('span');obj.id='toc__toggle';obj.innerHTML='<span>&minus;</span>';obj.className='toc_close';obj.style.cursor='pointer';prependChild(header,obj);obj.parentNode.onclick=toggleToc;try{obj.parentNode.style.cursor='pointer';obj.parentNode.style.cursor='hand';}catch(e){}}function toggleToc(){var toc=$('toc__inside');var obj=$('toc__toggle');if(toc.style.display=='none'){toc.style.display='';obj.innerHTML='<span>&minus;</span>';obj.className='toc_close';}else{toc.style.display='none';obj.innerHTML='<span>+</span>';obj.className='toc_open';}}function checkAclLevel(){if(document.getElementById){var scope=$('acl_scope').value;if((scope.indexOf(":*")>0)||(scope=="*")){document.getElementsByName('acl_checkbox[4]')[0].disabled=false;document.getElementsByName('acl_checkbox[8]')[0].disabled=false;}else{document.getElementsByName('acl_checkbox[4]')[0].checked=false;document.getElementsByName('acl_checkbox[8]')[0].checked=false;document.getElementsByName('acl_checkbox[4]')[0].disabled=true;document.getElementsByName('acl_checkbox[8]')[0].disabled=true;}}}function footnote(e){var obj=e.target;var id=obj.id.substr(5);var fndiv=$('insitu__fn');if(!fndiv){fndiv=document.createElement('div');fndiv.id='insitu__fn';fndiv.className='insitu-footnote JSpopup dokuwiki';addEvent(fndiv,'mouseout',function(e){if(e.target!=fndiv){e.stopPropagation();return;}if(e.pageX){var bx1=findPosX(fndiv);var bx2=bx1+fndiv.offsetWidth;var by1=findPosY(fndiv);var by2=by1+fndiv.offsetHeight;var x=e.pageX;var y=e.pageY;if(x>bx1&&x<bx2&&y>by1&&y<by2){e.stopPropagation();return;}}else{if(e.offsetX>0&&e.offsetX<fndiv.offsetWidth-1&&e.offsetY>0&&e.offsetY<fndiv.offsetHeight-1){e.stopPropagation();return;}}fndiv.style.display='none';});document.body.appendChild(fndiv);}var a=$("fn__"+id);if(!a){return;}var content=new String(a.parentNode.parentNode.innerHTML);content=content.replace(/<a\s.*?href=\".*\#fnt__\d+\".*?<\/a>/gi,'');content=content.replace(/^\s+(,\s+)+/,'');content=content.replace(/\bid=\"(.*?)\"/gi,'id="insitu__$1');fndiv.innerHTML=content;var x;var y;if(e.pageX){x=e.pageX;y=e.pageY;}else{x=e.offsetX;y=e.offsetY;}fndiv.style.position='absolute';fndiv.style.left=(x+2)+'px';fndiv.style.top=(y+2)+'px';fndiv.style.display='';}addInitEvent(function(){var elems=getElementsByClass('fn_top',null,'a');for(var i=0;i<elems.length;i++){addEvent(elems[i],'mouseover',function(e){footnote(e);});}});function initSizeCtl(ctlid,edid){if(!document.getElementById){return;}var ctl=$(ctlid);var textarea=$(edid);if(!ctl||!textarea)return;var hgt=DokuCookie.getValue('sizeCtl');if(hgt){textarea.style.height=hgt;}else{textarea.style.height='300px';}var l=document.createElement('img');var s=document.createElement('img');var w=document.createElement('img');l.src=DOKU_BASE+'lib/images/larger.gif';s.src=DOKU_BASE+'lib/images/smaller.gif';w.src=DOKU_BASE+'lib/images/wrap.gif';addEvent(l,'click',function(){sizeCtl(edid,100);});addEvent(s,'click',function(){sizeCtl(edid,-100);});addEvent(w,'click',function(){toggleWrap(edid);});ctl.appendChild(l);ctl.appendChild(s);ctl.appendChild(w);}function sizeCtl(edid,val){var textarea=$(edid);var height=parseInt(textarea.style.height.substr(0,textarea.style.height.length-2));height+=val;textarea.style.height=height+'px';DokuCookie.setValue('sizeCtl',textarea.style.height);}function toggleWrap(edid){var txtarea=$(edid);var wrap=txtarea.getAttribute('wrap');if(wrap&&wrap.toLowerCase()=='off'){txtarea.setAttribute('wrap','soft');}else{txtarea.setAttribute('wrap','off');}var parNod=txtarea.parentNode;var nxtSib=txtarea.nextSibling;parNod.removeChild(txtarea);parNod.insertBefore(txtarea,nxtSib);}function closePopups(){if(!document.getElementById){return;}var divs=document.getElementsByTagName('div');for(var i=0;i<divs.length;i++){if(divs[i].className.indexOf('JSpopup')!=-1){divs[i].style.display='none';}}}function scrollToMarker(){var obj=$('scroll__here');if(obj)obj.scrollIntoView();}function focusMarker(){var obj=$('focus__this');if(obj)obj.focus();}function cleanMsgArea(){var elems=getElementsByClass('(success|info|error)',document,'div');if(elems){for(var i=0;i<elems.length;i++){elems[i].style.display='none';}}}function sack(file){this.AjaxFailedAlert="Your browser does not support the enhanced functionality of this website, and therefore you will have an experience that differs from the intended one.\n";this.requestFile=file;this.method="POST";this.URLString="";this.encodeURIString=true;this.execute=false;this.onLoading=function(){};this.onLoaded=function(){};this.onInteractive=function(){};this.onCompletion=function(){};this.afterCompletion=function(){};this.createAJAX=function(){try{this.xmlhttp=new ActiveXObject("Msxml2.XMLHTTP");}catch(e){try{this.xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");}catch(err){this.xmlhttp=null;}}if(!this.xmlhttp&&typeof XMLHttpRequest!="undefined"){this.xmlhttp=new XMLHttpRequest();}if(!this.xmlhttp){this.failed=true;}};this.setVar=function(name,value){if(this.URLString.length<3){this.URLString=name+"="+value;}else{this.URLString+="&"+name+"="+value;}};this.encVar=function(name,value){var varString=encodeURIComponent(name)+"="+encodeURIComponent(value);return varString;};this.encodeURLString=function(string){varArray=string.split('&');for(i=0;i<varArray.length;i++){urlVars=varArray[i].split('=');if(urlVars[0].indexOf('amp;')!=-1){urlVars[0]=urlVars[0].substring(4);}varArray[i]=this.encVar(urlVars[0],urlVars[1]);}return varArray.join('&');};this.runResponse=function(){eval(this.response);};this.runAJAX=function(urlstring){this.responseStatus=new Array(2);if(this.failed&&this.AjaxFailedAlert){alert(this.AjaxFailedAlert);}else{if(urlstring){if(this.URLString.length){this.URLString=this.URLString+"&"+urlstring;}else{this.URLString=urlstring;}}if(this.encodeURIString){var timeval=new Date().getTime();this.URLString=this.encodeURLString(this.URLString);this.setVar("rndval",timeval);}if(this.element){this.elementObj=document.getElementById(this.element);}if(this.xmlhttp){var self=this;if(this.method=="GET"){var totalurlstring=this.requestFile+"?"+this.URLString;this.xmlhttp.open(this.method,totalurlstring,true);}else{this.xmlhttp.open(this.method,this.requestFile,true);}if(this.method=="POST"){try{this.xmlhttp.setRequestHeader('Content-Type','application/x-www-form-urlencoded; charset=UTF-8');}catch(e){}}this.xmlhttp.onreadystatechange=function(){switch(self.xmlhttp.readyState){case 1:self.onLoading();break;case 2:self.onLoaded();break;case 3:self.onInteractive();break;case 4:self.response=self.xmlhttp.responseText;self.responseXML=self.xmlhttp.responseXML;self.responseStatus[0]=self.xmlhttp.status;self.responseStatus[1]=self.xmlhttp.statusText;self.onCompletion();if(self.execute){self.runResponse();}if(self.elementObj){var elemNodeName=self.elementObj.nodeName;elemNodeName.toLowerCase();if(elemNodeName=="input"||elemNodeName=="select"||elemNodeName=="option"||elemNodeName=="textarea"){self.elementObj.value=self.response;}else{self.elementObj.innerHTML=self.response;}}self.afterCompletion();self.URLString="";break;}};this.xmlhttp.send(this.URLString);}}};this.createAJAX();}function ajax_qsearch_class(){this.sack=null;this.inObj=null;this.outObj=null;this.timer=null;}var ajax_qsearch=new ajax_qsearch_class();ajax_qsearch.sack=new sack(DOKU_BASE+'lib/exe/ajax.php');ajax_qsearch.sack.AjaxFailedAlert='';ajax_qsearch.sack.encodeURIString=false;ajax_qsearch.init=function(inID,outID){ajax_qsearch.inObj=document.getElementById(inID);ajax_qsearch.outObj=document.getElementById(outID);if(ajax_qsearch.inObj===null){return;}if(ajax_qsearch.outObj===null){return;}addEvent(ajax_qsearch.inObj,'keyup',ajax_qsearch.call);addEvent(ajax_qsearch.outObj,'click',function(){ajax_qsearch.outObj.style.display='none';});};ajax_qsearch.clear=function(){ajax_qsearch.outObj.style.display='none';ajax_qsearch.outObj.innerHTML='';if(ajax_qsearch.timer!==null){window.clearTimeout(ajax_qsearch.timer);ajax_qsearch.timer=null;}};ajax_qsearch.exec=function(){ajax_qsearch.clear();var value=ajax_qsearch.inObj.value;if(value===''){return;}ajax_qsearch.sack.runAJAX('call=qsearch&q='+encodeURI(value));};ajax_qsearch.sack.onCompletion=function(){var data=ajax_qsearch.sack.response;if(data===''){return;}ajax_qsearch.outObj.innerHTML=data;ajax_qsearch.outObj.style.display='block';};ajax_qsearch.call=function(){ajax_qsearch.clear();ajax_qsearch.timer=window.setTimeout("ajax_qsearch.exec()",500);};index={throbber_delay:500,treeattach:function(obj){if(!obj)return;var items=getElementsByClass('idx_dir',obj,'a');for(var i=0;i<items.length;i++){var elem=items[i];addEvent(elem,'click',function(e){return index.toggle(e,this);});}},toggle:function(e,clicky){var listitem=clicky.parentNode.parentNode;var sublists=listitem.getElementsByTagName('ul');if(sublists.length&&listitem.className=='open'){sublists[0].style.display='none';listitem.className='closed';e.preventDefault();return false;}if(sublists.length&&listitem.className=='closed'){sublists[0].style.display='';listitem.className='open';e.preventDefault();return false;}var ajax=new sack(DOKU_BASE+'lib/exe/ajax.php');ajax.AjaxFailedAlert='';ajax.encodeURIString=false;if(ajax.failed)return true;var ul=document.createElement('ul');ul.className='idx';timeout=window.setTimeout(function(){ul.innerHTML='<li><img src="'+DOKU_BASE+'lib/images/throbber.gif" alt="loading..." title="loading..." /></li>';listitem.appendChild(ul);listitem.className='open';},this.throbber_delay);ajax.elementObj=ul;ajax.afterCompletion=function(){window.clearTimeout(timeout);index.treeattach(ul);if(listitem.className!='open'){listitem.appendChild(ul);listitem.className='open';}};ajax.runAJAX(clicky.search.substr(1)+'&call=index');e.preventDefault();return false;}};addInitEvent(function(){index.treeattach($('index__tree'));});addInitEvent(function(){ajax_qsearch.init('qsearch__in','qsearch__out');});addInitEvent(function(){addEvent(document,'click',closePopups);});addInitEvent(function(){addTocToggle();});acl={init:function(){this.ctl=$('acl_manager');if(!this.ctl)return;var sel=$('acl__user').getElementsByTagName('select')[0];addEvent(sel,'change',acl.userselhandler);addEvent($('acl__tree'),'click',acl.treehandler);addEvent($('acl__user').getElementsByTagName('input')[1],'click',acl.loadinfo);addEvent($('acl__user').getElementsByTagName('input')[1],'keypress',acl.loadinfo);},userselhandler:function(e){if(this.value=='__g__'||this.value=='__u__'){$('acl__user').getElementsByTagName('input')[0].style.display='';$('acl__user').getElementsByTagName('input')[1].style.display='';}else{$('acl__user').getElementsByTagName('input')[0].style.display='none';$('acl__user').getElementsByTagName('input')[1].style.display='none';}acl.loadinfo();},loadinfo:function(){var frm=$('acl__detail').getElementsByTagName('form')[0];var ajax=new sack(DOKU_BASE+'lib/plugins/acl/ajax.php');ajax.AjaxFailedAlert='';ajax.encodeURIString=false;if(ajax.failed)return true;var data=Array();data[0]=ajax.encVar('ns',frm.elements['ns'].value);data[1]=ajax.encVar('id',frm.elements['id'].value);data[2]=ajax.encVar('acl_t',frm.elements['acl_t'].value);data[3]=ajax.encVar('acl_w',frm.elements['acl_w'].value);data[4]=ajax.encVar('ajax','info');ajax.elementObj=$('acl__info');ajax.runAJAX(data.join('&'));return false;},parseatt:function(str){if(str[0]=='?')str=str.substr(1);var attributes={};var all=str.split('&');for(var i=0;i<all.length;i++){var att=all[i].split('=');attributes[att[0]]=decodeURIComponent(att[1]);}return attributes;},hsc:function(str){str=str.replace(/&/g,"&amp;");str=str.replace(/\"/g,"&quot;");str=str.replace(/\'/g,"&#039;");str=str.replace(/</g,"&lt;");str=str.replace(/>/g,"&gt;");return str;},treetoggle:function(clicky){var listitem=clicky.parentNode.parentNode;var sublists=listitem.getElementsByTagName('ul');if(sublists.length){listitem.removeChild(sublists[0]);clicky.src=DOKU_BASE+'lib/images/plus.gif';clicky.alt='+';return false;}var link=listitem.getElementsByTagName('a')[0];var ajax=new sack(DOKU_BASE+'lib/plugins/acl/ajax.php');ajax.AjaxFailedAlert='';ajax.encodeURIString=false;if(ajax.failed)return true;var ul=document.createElement('ul');listitem.appendChild(ul);ajax.elementObj=ul;ajax.runAJAX(link.search.substr(1)+'&ajax=tree');clicky.src=DOKU_BASE+'lib/images/minus.gif';return false;},treehandler:function(e){if(e.target.src){acl.treetoggle(e.target);}else if(e.target.href){var obj=getElementsByClass('cur',$('acl__tree'),'a')[0];if(obj)obj.className=obj.className.replace(/ cur/,'');e.target.className+=' cur';var frm=$('acl__detail').getElementsByTagName('form')[0];if(e.target.className.search(/wikilink1/)>-1){frm.elements['ns'].value='';frm.elements['id'].value=acl.hsc(acl.parseatt(e.target.search)['id']);}else if(e.target.className.search(/idx_dir/)>-1){frm.elements['ns'].value=acl.hsc(acl.parseatt(e.target.search)['ns']);frm.elements['id'].value='';}acl.loadinfo();}e.stopPropagation();e.preventDefault();return false;}};addInitEvent(acl.init);addInitEvent(function(){updateAccessKeyTooltip();});addInitEvent(function(){scrollToMarker();});addInitEvent(function(){focusMarker();});
