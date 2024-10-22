(function($){var globalTags=[];window.setGlobalTags=function(tags){globalTags=getTags(tags);};function getTags(tags){var tag,i,goodTags=[];for(i=0;i<tags.length;i++){tag=tags[i];if(typeof tags[i]=='object'){tag=tags[i].tag;}
goodTags.push(tag.toLowerCase());}
return goodTags;}
$.fn.tagSuggest=function(options){var defaults={'matchClass':'tagMatches','tagContainer':'span','tagWrap':'span','sort':true,'tags':null,'url':null,'delay':0,'separator':' '};var i,tag,userTags=[],settings=$.extend({},defaults,options);if(settings.tags){userTags=getTags(settings.tags);}else{userTags=globalTags;}
return this.each(function(){var tagsElm=$(this);var elm=this;var matches,fromTab=false;var suggestionsShow=false;var workingTags=[];var currentTag={"position":0,tag:""};var tagMatches=document.createElement(settings.tagContainer);function showSuggestionsDelayed(el,key){if(settings.delay){if(elm.timer)clearTimeout(elm.timer);elm.timer=setTimeout(function(){showSuggestions(el,key);},settings.delay);}else{showSuggestions(el,key);}}
function showSuggestions(el,key){workingTags=el.value.split(settings.separator);matches=[];var i,html='',chosenTags={},tagSelected=false;currentTag={position:currentTags.length-1,tag:''};for(i=0;i<currentTags.length&&i<workingTags.length;i++){if(!tagSelected&&currentTags[i].toLowerCase()!=workingTags[i].toLowerCase()){currentTag={position:i,tag:workingTags[i].toLowerCase()};tagSelected=true;}
chosenTags[currentTags[i].toLowerCase()]=true;}
if(currentTag.tag){if(settings.url){$.ajax({'url':settings.url,'dataType':'json','data':{'tag':currentTag.tag},'async':false,'success':function(m){matches=m;}});}else{for(i=0;i<userTags.length;i++){if(userTags[i].indexOf(currentTag.tag)===0){matches.push(userTags[i]);}}}
matches=$.grep(matches,function(v,i){return!chosenTags[v.toLowerCase()];});if(settings.sort){matches=matches.sort();}
for(i=0;i<matches.length;i++){html+='<'+settings.tagWrap+' class="_tag_suggestion">'+matches[i]+'</'+settings.tagWrap+'>';}
tagMatches.html(html);suggestionsShow=!!(matches.length);}else{hideSuggestions();}}
function hideSuggestions(){tagMatches.empty();matches=[];suggestionsShow=false;}
function setSelection(){var v=tagsElm.val();if(v==tagsElm.attr('title')&&tagsElm.is('.hint'))v='';currentTags=v.split(settings.separator);hideSuggestions();}
function chooseTag(tag){var i,index;for(i=0;i<currentTags.length;i++){if(currentTags[i].toLowerCase()!=workingTags[i].toLowerCase()){index=i;break;}}
if(index==workingTags.length-1)tag=tag+settings.separator;workingTags[i]=tag;tagsElm.val(workingTags.join(settings.separator));tagsElm.blur().focus();setSelection();}
function handleKeys(ev){fromTab=false;var type=ev.type;var resetSelection=false;switch(ev.keyCode){case 37:case 38:case 39:case 40:{hideSuggestions();return true;}
case 224:case 17:case 16:case 18:{return true;}
case 8:{if(this.value==''){hideSuggestions();setSelection();return true;}else{type='keyup';resetSelection=true;showSuggestionsDelayed(this);}
break;}
case 9:case 13:{if(suggestionsShow){chooseTag(matches[0]);fromTab=true;return false;}else{return true;}}
case 27:{hideSuggestions();setSelection();return true;}
case 32:{setSelection();return true;}}
if(type=='keyup'){switch(ev.charCode){case 9:case 13:{return true;}}
if(resetSelection){setSelection();}
showSuggestionsDelayed(this,ev.charCode);}}
tagsElm.after(tagMatches).keypress(handleKeys).keyup(handleKeys).blur(function(){if(fromTab==true||suggestionsShow){fromTab=false;tagsElm.focus();}});tagMatches=$(tagMatches).click(function(ev){if(ev.target.nodeName==settings.tagWrap.toUpperCase()&&$(ev.target).is('._tag_suggestion')){chooseTag(ev.target.innerHTML);}}).addClass(settings.matchClass);setSelection();});};})(jQuery);