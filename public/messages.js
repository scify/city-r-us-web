/*!
 *  Lang.js for Laravel localization in JavaScript.
 *
 *  @version 1.1.0
 *  @license MIT
 *  @site    https://github.com/rmariuzzo/Laravel-JS-Localization
 *  @author  rmariuzzo
 */'use strict';(function(root,factory){if(typeof define==='function'&&define.amd){define([],factory);}else if(typeof exports==='object'){module.exports=new(factory())();}else{root.Lang=new(factory())();}}(this,function(){var defaults={defaultLocale:'en'};var Lang=function(options){options=options||{};this.defaultLocale=options.defaultLocale||defaults.defaultLocale;};Lang.prototype.setMessages=function(messages){this.messages=messages;};Lang.prototype.get=function(key,replacements){if(!this.has(key)){return key;}
var message=this._getMessage(key,replacements);if(message===null){return key;}
if(replacements){message=this._applyReplacements(message,replacements);}
return message;};Lang.prototype.has=function(key){if(typeof key!=='string'||!this.messages){return false;}
return this._getMessage(key)!==null;};Lang.prototype.choice=function(key,count,replacements){replacements=typeof replacements!=='undefined'?replacements:{};replacements['count']=count;var message=this.get(key,replacements);if(message===null||message===undefined){return message;}
var messageParts=message.split('|');var explicitRules=[];var regex=/{\d+}\s(.+)|\[\d+,\d+\]\s(.+)|\[\d+,Inf\]\s(.+)/;for(var i=0;i<messageParts.length;i++){messageParts[i]=messageParts[i].trim();if(regex.test(messageParts[i])){var messageSpaceSplit=messageParts[i].split(/\s/);explicitRules.push(messageSpaceSplit.shift());messageParts[i]=messageSpaceSplit.join(' ');}}
if(messageParts.length===1){return message;}
for(var i=0;i<explicitRules.length;i++){if(this._testInterval(count,explicitRules[i])){return messageParts[i];}}
if(count>1){return messageParts[1];}else{return messageParts[0];}};Lang.prototype.setLocale=function(locale){this.locale=locale;};Lang.prototype.getLocale=function(){return this.locale||this.defaultLocale;};Lang.prototype._parseKey=function(key){if(typeof key!=='string'){return null;}
var segments=key.split('.');return{source:this.getLocale()+'.'+segments[0],entries:segments.slice(1)};};Lang.prototype._getMessage=function(key){key=this._parseKey(key);if(this.messages[key.source]===undefined){return null;}
var message=this.messages[key.source];while(key.entries.length&&(message=message[key.entries.shift()]));if(typeof message!=='string'){return null;}
return message;};Lang.prototype._applyReplacements=function(message,replacements){for(var replace in replacements){message=message.split(':'+replace).join(replacements[replace]);}
return message;};Lang.prototype._testInterval=function(count,interval){return false;};return Lang;}));(function(root){Lang.setMessages({"el.admin_login":{"title":"City-R-US","logIn":"\u03a3\u03cd\u03bd\u03b4\u03b5\u03c3\u03b7","remember":"\u039d\u03b1 \u03bc\u03b5 \u03b8\u03c5\u03bc\u03ac\u03c3\u03b1\u03b9 \u03c4\u03b7\u03bd \u03b5\u03c0\u03cc\u03bc\u03b5\u03bd\u03b7 \u03c6\u03bf\u03c1\u03ac","entrance":"\u0395\u03af\u03c3\u03bf\u03b4\u03bf\u03c2","forgotPass":"\u039e\u03b5\u03c7\u03ac\u03c3\u03b1\u03c4\u03b5 \u03c4\u03bf\u03bd \u03ba\u03c9\u03b4\u03b9\u03ba\u03cc \u03c3\u03b1\u03c2;","register":"\u0394\u03b7\u03bc\u03b9\u03bf\u03c5\u03c1\u03b3\u03af\u03b1 \u039b\u03bf\u03b3\u03b1\u03c1\u03b9\u03b1\u03c3\u03bc\u03bf\u03cd"},"el.home_default":{"pageTitle":"City-R-US","home":"\u0391\u03c1\u03c7\u03b9\u03ba\u03ae","viewMap":"\u0394\u03b5\u03c2 \u03c4\u03bf\u03bd \u03c7\u03ac\u03c1\u03c4\u03b7","adminInterface":"\u03a0\u03b5\u03c1\u03b9\u03b2\u03ac\u03bb\u03bb\u03bf\u03bd \u0394\u03b9\u03b1\u03c7\u03b5\u03b9\u03c1\u03b9\u03c3\u03c4\u03ae","title":"\u0397 \u03c0\u03cc\u03bb\u03b7 \u03b5\u03af\u03bc\u03b1\u03c3\u03c4\u03b5 \u03b5\u03bc\u03b5\u03af\u03c2!","subtitle":"\u03a0\u03ac\u03c1\u03b5 \u03bc\u03ad\u03c1\u03bf\u03c2 \u03c3\u03b5 \u03b1\u03c0\u03bf\u03c3\u03c4\u03bf\u03bb\u03ad\u03c2 \u03c3\u03c4\u03b7\u03bd \u0391\u03b8\u03ae\u03bd\u03b1 <br>\u0392\u03b5\u03bb\u03c4\u03af\u03c9\u03c3\u03b5 \u03c4\u03b7\u03bd \u03c0\u03cc\u03bb\u03b7 \u03c3\u03bf\u03c5","download":"\u039a\u03b1\u03c4\u03ad\u03b2\u03b1\u03c3\u03b5 \u03c4\u03b7\u03bd \u03b5\u03c6\u03b1\u03c1\u03bc\u03bf\u03b3\u03ae","map":"\u03a7\u03ac\u03c1\u03c4\u03b7\u03c2 \u03bc\u03b5 \u03b1\u03c0\u03bf\u03c4\u03b5\u03bb\u03ad\u03c3\u03bc\u03b1\u03c4\u03b1","feature1":"<h2>\u0392\u03c1\u03b5\u03c2 \u03b1\u03c0\u03bf\u03c3\u03c4\u03bf\u03bb\u03ad\u03c2<\/h2><p>\u039f \u0394\u03ae\u03bc\u03bf\u03c2 \u03c4\u03b9\u03c2 \u0391\u03b8\u03ae\u03bd\u03b1\u03c2 \u03c0\u03c1\u03bf\u03c4\u03b5\u03af\u03bd\u03b5\u03b9 \u03b1\u03c0\u03bf\u03c3\u03c4\u03bf\u03bb\u03ad\u03c2 \u03b3\u03b9\u03b1 \u03bd\u03b1 \u03b2\u03b5\u03bb\u03c4\u03b9\u03ce\u03c3\u03bf\u03c5\u03bc\u03b5 \u03c4\u03b7\u03bd \u03c0\u03cc\u03bb\u03b7.<\/p>","feature2":"<h2>\u0391\u03bd\u03ad\u03b2\u03b1\u03c3\u03b5 \u03b4\u03b9\u03b1\u03b4\u03c1\u03bf\u03bc\u03ae<\/h2><p>\u039c\u03c0\u03bf\u03c1\u03b5\u03af\u03c2 \u03bd\u03b1 \u03c3\u03c5\u03bd\u03b5\u03b9\u03c3\u03c6\u03ad\u03c1\u03b5\u03b9\u03c2 \u03c3'\u03b5\u03bd\u03b1 \u03b4\u03b7\u03bc\u03cc\u03c3\u03b9\u03bf \u03c7\u03ac\u03c1\u03c4\u03b7, \u03c3\u03c4\u03ad\u03bb\u03bd\u03bf\u03bd\u03c4\u03b1\u03c2 \u03b5\u03af\u03c4\u03b5 \u03b5\u03bd\u03b1 \u03c3\u03b7\u03bc\u03b5\u03af\u03bf \u03ae \u03bc\u03b9\u03b1 \u03b4\u03b9\u03b1\u03b4\u03c1\u03bf\u03bc\u03ae (\u03b1\u03bd\u03ac\u03bb\u03bf\u03b3\u03b1 \u03bc\u03b5 \u03c4\u03b7\u03bd \u03b1\u03c0\u03bf\u03c3\u03c4\u03bf\u03bb\u03ae)<\/p>","feature3":"<h2>\u0394\u03b5\u03c2 \u03c4\u03bf\u03bd \u03c7\u03ac\u03c1\u03c4\u03b7 \u03c4\u03b7\u03c2 \u03c0\u03cc\u03bb\u03b7\u03c2<\/h2><p>\u0397 \u03c3\u03c5\u03bd\u03b5\u03b9\u03c3\u03c6\u03bf\u03c1\u03ac \u03cc\u03bb\u03c9\u03bd \u03c4\u03c9\u03bd \u03c0\u03bf\u03bb\u03b9\u03c4\u03ce\u03bd \u03c6\u03b1\u03af\u03bd\u03b5\u03c4\u03b1\u03b9 \u03c3\u03ad\u03bd\u03b1 \u03b4\u03b7\u03bc\u03cc\u03c3\u03b9\u03bf \u03c7\u03ac\u03c1\u03c4\u03b7. \u039a\u03bb\u03b9\u03ba :link<\/p>","fewWords":"\u039b\u03af\u03b3\u03b1 \u03bb\u03cc\u03b3\u03b9\u03b1 \u03b3\u03b9\u03b1 \u03c4\u03b7\u03bd \u03b5\u03c6\u03b1\u03c1\u03bc\u03bf\u03b3\u03ae","subFewWords":" <p>\u03a4\u03bf City-R-US \u03b5\u03b9\u03bd\u03b1\u03b9 \u03bc\u03b9\u03b1 \u03b5\u03c6\u03b1\u03c1\u03bc\u03bf\u03b3\u03ae \u03c0\u03bf\u03c5 \u03b5\u03c0\u03b9\u03c4\u03c1\u03ad\u03c0\u03b5\u03b9 \u03c3\u03c4\u03bf\u03c5\u03c2 \u03ba\u03b1\u03c4\u03bf\u03af\u03ba\u03bf\u03c5\u03c2 \u03c4\u03b7\u03c2 \u0391\u03b8\u03ae\u03bd\u03b1\u03c2 \u03bd\u03b1 \u03c3\u03c5\u03bc\u03bc\u03b5\u03c4\u03ad\u03c7\u03bf\u03c5\u03bd \u03c3\u03b5 \u03b1\u03c0\u03bf\u03c3\u03c4\u03bf\u03bb\u03ad\u03c2.\n                       \u0395\u03c0\u03af\u03bb\u03b5\u03be\u03b5 \u03c4\u03b7\u03bd \u03b1\u03c0\u03bf\u03c3\u03c4\u03bf\u03bb\u03ae \u03c0\u03bf\u03c5 \u03c3\u03b5 \u03b5\u03bd\u03b4\u03b9\u03b1\u03c6\u03ad\u03c1\u03b5\u03b9 \u03ba\u03b1\u03b9 \u03b2\u03bf\u03ae\u03b8\u03b7\u03c3\u03b5 \u03c4\u03b7 \u03c0\u03cc\u03bb\u03b7 \u03c3\u03bf\u03c5!\n                       \u03a4\u03b1 \u03b4\u03b5\u03b4\u03bf\u03bc\u03ad\u03bd\u03b1 \u03c4\u03c9\u03bd \u03b1\u03c0\u03bf\u03c3\u03c4\u03bf\u03bb\u03ce\u03bd \u03c3\u03c5\u03bb\u03bb\u03ad\u03b3\u03bf\u03bd\u03c4\u03b1\u03b9 \u03c3'\u03ad\u03bd\u03b1\u03bd \u03b4\u03b7\u03bc\u03cc\u03c3\u03b9\u03bf \u03c7\u03ac\u03c1\u03c4\u03b7 \u03b4\u03b9\u03b1\u03b8\u03ad\u03c3\u03b9\u03bc\u03bf :link<\/p>","list1":"\u039c\u03bf\u03bd\u03c4\u03ad\u03c1\u03bd\u03b1 \u03b1\u03b9\u03c3\u03b8\u03b7\u03c4\u03b9\u03ba\u03ae","list2":"\u039c\u03c0\u03bf\u03c1\u03b5\u03af\u03c2 \u03bd\u03b1 \u03c0\u03c1\u03bf\u03c4\u03b5\u03af\u03bd\u03b5\u03b9\u03c2 \u03ba \u03b5\u03c3\u03cd \u03b1\u03c0\u03bf\u03c3\u03c4\u03bf\u03bb\u03ad\u03c2!","list3":"\u0395\u03c0\u03b9\u03b2\u03c1\u03ac\u03b2\u03b5\u03c5\u03c3\u03b7 \u03c4\u03c9\u03bd \u03c0\u03bf\u03bb\u03b9\u03c4\u03ce\u03bd \u03c0\u03bf\u03c5 \u03c3\u03c5\u03bd\u03b5\u03b9\u03c3\u03c6\u03ad\u03c1\u03bf\u03c5\u03bd \u03c0\u03b5\u03c1\u03b9\u03c3\u03c3\u03cc\u03c4\u03b5\u03c1\u03bf","list4":"\u0395\u03cd\u03ba\u03bf\u03bb\u03bf \u03c3\u03c4\u03b7 \u03c7\u03c1\u03ae\u03c3\u03b7 \u03c4\u03bf\u03c5","testimonial1":" <p class='text-white'>\u03a0\u03bf\u03bb\u03cd \u03ba\u03b1\u03bb\u03ae \u03b9\u03b4\u03ad\u03b1!<br> \u0398\u03b1 \u03b5\u03af\u03bd\u03b1\u03b9 \u03b5\u03be\u03b1\u03b9\u03c1\u03b5\u03c4\u03b9\u03ba\u03cc \u03bd\u03b1 \u03ad\u03c7\u03bf\u03c5\u03bc\u03b5 \u03c7\u03b1\u03c1\u03c4\u03bf\u03b3\u03c1\u03b1\u03c6\u03b7\u03bc\u03ad\u03bd\u03b1 \u03c3\u03b7\u03bc\u03b5\u03af\u03b1 \u03ba\u03b1\u03b9 \u03b4\u03b9\u03b1\u03b4\u03c1\u03bf\u03bc\u03ad\u03c2 \u03c0\u03bf\u03c5 \u03b5\u03af\u03bd\u03b1\u03b9 \u03c0\u03c1\u03bf\u03c3\u03b2\u03ac\u03c3\u03b9\u03bc\u03b5\u03c2 \u03b1\u03c0\u03cc \u0391\u03bc\u03b5\u0391 \u03c3\u03c4\u03b7\u03bd \u03c0\u03cc\u03bb\u03b7.<br> \u03a0\u03b5\u03af\u03c4\u03b5 \u03bc\u03bf\u03c5 \u03c0\u03c9\u03c2 \u03bd\u03b1 \u03b2\u03bf\u03b7\u03b8\u03ae\u03c3\u03c9.<\/p><span>Dr. \u0393\u03b9\u03ce\u03c1\u03b3\u03bf\u03c2 \u03a7\u03c1\u03b7\u03c3\u03c4\u03ac\u03ba\u03b7\u03c2<br>\u03a7\u03bf\u03c1\u03bf\u03b3\u03c1\u03ac\u03c6\u03bf\u03c2, <br>\u03c7\u03bf\u03c1\u03b5\u03c5\u03c4\u03ae\u03c2 \u03c3\u03b5 \u03b1\u03bd\u03b1\u03c0.\u03b1\u03bc\u03b1\u03be\u03af\u03b4\u03b9\u03bf, <br>\u03b9\u03b4\u03c1\u03c5\u03c4\u03ae\u03c2 \u03c4\u03bf\u03c5 \u03a7\u03bf\u03c1\u03bf\u03b8\u03b5\u03ac\u03c4\u03c1\u03bf\u03c5 \u0394\u0391\u0393\u0399\u03a0\u039f\u039b\u0397<\/span>","suggest":"\u03a0\u03c1\u03cc\u03c4\u03b5\u03b9\u03bd\u03b5 \u03bc\u03b9\u03b1 \u03b1\u03c0\u03bf\u03c3\u03c4\u03bf\u03bb\u03ae","name":"\u038c\u03bd\u03bf\u03bc\u03b1","email":"Email","iWouldSuggest":"\u0398\u03b1 \u03c3\u03b1\u03c2 \u03c0\u03c1\u03cc\u03c4\u03b5\u03b9\u03bd\u03b1 \u03bd\u03b1...","submit":"A\u03c0\u03bf\u03c3\u03c4\u03bf\u03bb\u03ae","termsAndConditions":"\u03a0\u03bf\u03bb\u03b9\u03c4\u03b9\u03ba\u03ae \u0391\u03c0\u03bf\u03c1\u03c1\u03ae\u03c4\u03bf\u03c5","imageSrc":"\u03a0\u03b7\u03b3\u03ae \u03b5\u03b9\u03ba\u03cc\u03bd\u03b1\u03c2 background","funding":"\u03a4\u03bf \u03ad\u03c1\u03b3\u03bf \u03ad\u03c7\u03b5\u03b9 \u03bb\u03ac\u03b2\u03b5\u03b9 \u03c7\u03c1\u03b7\u03bc\u03b1\u03c4\u03bf\u03b4\u03cc\u03c4\u03b7\u03c3\u03b7 \u03b1\u03c0\u03cc \u03c4\u03bf \u03c0\u03c1\u03cc\u03b3\u03c1\u03b1\u03bc\u03bc\u03b1 \u0391\u03bd\u03c4\u03b1\u03b3\u03c9\u03bd\u03b9\u03c3\u03c4\u03b9\u03ba\u03cc\u03c4\u03b7\u03c4\u03b1\u03c2 \u03ba\u03b1\u03b9 \u039a\u03b1\u03b9\u03bd\u03bf\u03c4\u03bf\u03bc\u03af\u03b1\u03c2 \u03c4\u03b7\u03c2 \u0395\u03c5\u03c1\u03c9\u03c0\u03b1\u03ca\u03ba\u03ae\u03c2 \u0388\u03bd\u03c9\u03c3\u03b7\u03c2 \u03c3\u03c4\u03bf \u03c0\u03bb\u03b1\u03af\u03c3\u03b9\u03bf \u03c3\u03c5\u03bc\u03c6\u03c9\u03bd\u03af\u03b1\u03c2 \u03b5\u03c0\u03b9\u03c7\u03bf\u03c1\u03ae\u03b3\u03b7\u03c3\u03b7\u03c2 \u03c5\u03c0' \u03b1\u03c1\u03b9\u03b8\u03bc. 325138.","city-map":"\u039f \u03c7\u03ac\u03c1\u03c4\u03b7\u03c2 \u03c4\u03b7\u03c2 \u03c0\u03cc\u03bb\u03b7\u03c2","actionsInCity":"\u0394\u03c1\u03ac\u03c3\u03b5\u03b9\u03c2 \u03c3\u03c4\u03b7\u03bd \u03c0\u03b5\u03c1\u03b9\u03bf\u03c7\u03ae","pois":"\u03a3\u03b7\u03bc\u03b5\u03af\u03b1 \u03b5\u03bd\u03b4\u03b9\u03b1\u03c6\u03ad\u03c1\u03bf\u03bd\u03c4\u03bf\u03c2 \u03c3\u03c4\u03b7\u03bd \u03c0\u03b5\u03c1\u03b9\u03bf\u03c7\u03ae","selectMission":"E\u03c0\u03b9\u03bb\u03bf\u03b3\u03ae \u03b1\u03c0\u03bf\u03c3\u03c4\u03bf\u03bb\u03ae\u03c2","selectDate":"E\u03c0\u03b9\u03bb\u03bf\u03b3\u03ae \u03a0\u03b5\u03c1\u03b9\u03cc\u03b4\u03bf\u03c5","from":"\u0391\u03c0\u03cc","to":"\u0388\u03c9\u03c2","error":"\u03a3\u03c5\u03bd\u03ad\u03b2\u03b5\u03b9 \u03ad\u03bd\u03b1 \u03bb\u03ac\u03b8\u03bf\u03c2 \u03ba\u03b1\u03c4\u03ac \u03c4\u03b7\u03bd \u03c6\u03cc\u03c1\u03c4\u03c9\u03c3\u03b7 \u03b1\u03c0\u03bf\u03c3\u03c4\u03bf\u03bb\u03ce\u03bd...","refresh":"\u0391\u03bd\u03b1\u03bd\u03ad\u03c9\u03c3\u03b7","terms":"\u03a0\u03bf\u03bb\u03b9\u03c4\u03b9\u03ba\u03ae \u0391\u03c0\u03bf\u03c1\u03c1\u03ae\u03c4\u03bf\u03c5"},"el.passwords":{"password":"\u039f \u03ba\u03c9\u03b4\u03b9\u03ba\u03cc\u03c2 \u03b8\u03b1 \u03c0\u03c1\u03ad\u03c0\u03b5\u03b9 \u03bd\u03b1 \u03ad\u03c7\u03b5\u03b9 \u03bc\u03ae\u03ba\u03bf\u03c2 \u03c4\u03bf\u03c5\u03bb\u03ac\u03c7\u03b9\u03c3\u03c4\u03bf\u03bd 6 \u03c7\u03b1\u03c1\u03b1\u03ba\u03c4\u03ae\u03c1\u03b5\u03c2.","user":"\u0394\u03b5\u03bd \u03c5\u03c0\u03ac\u03c1\u03c7\u03b5\u03b9 \u03c7\u03c1\u03ae\u03c3\u03c4\u03b7\u03c2 \u03bc\u03b5 \u03b1\u03c5\u03c4\u03cc \u03c4\u03bf email.","token":"\u03a4\u03bf password reset token \u03b4\u03b5\u03bd \u03b5\u03af\u03bd\u03b1\u03b9 \u03ad\u03b3\u03ba\u03c5\u03c1\u03bf.","sent":"\u03a3\u03b1\u03c2 \u03b1\u03c0\u03b5\u03c3\u03c4\u03ac\u03bb\u03b7 \u03bc\u03ad\u03c3\u03c9 email \u03bf \u03c3\u03cd\u03bd\u03b4\u03b5\u03c3\u03bc\u03bf\u03c2 \u03b5\u03c0\u03b1\u03bd\u03b1\u03c6\u03bf\u03c1\u03ac\u03c2 \u03ba\u03c9\u03b4\u03b9\u03ba\u03bf\u03cd \u03c0\u03c1\u03cc\u03c3\u03b2\u03b1\u03c3\u03b7\u03c2!","resetPassword":"\u0395\u03c0\u03b1\u03bd\u03b1\u03c6\u03bf\u03c1\u03ac \u03ba\u03c9\u03b4\u03b9\u03ba\u03bf\u03cd","sendReset":"\u0391\u03c0\u03bf\u03c3\u03c4\u03bf\u03bb\u03ae \u03c3\u03c5\u03bd\u03b4\u03ad\u03c3\u03bc\u03bf\u03c5 \u03b3\u03b9\u03b1 \u03b5\u03c0\u03b1\u03bd\u03b1\u03c6\u03bf\u03c1\u03ac \u03ba\u03c9\u03b4\u03b9\u03ba\u03bf\u03cd","resetOK":"\u0395\u03b3\u03af\u03bd\u03b5 \u03b5\u03c0\u03b1\u03bd\u03b1\u03c6\u03bf\u03c1\u03ac \u03ba\u03c9\u03b4\u03b9\u03ba\u03bf\u03cd!"},"el.admin_menu":{"dashboard":"\u0391\u03c1\u03c7\u03b9\u03ba\u03ae","missions":"\u0391\u03c0\u03bf\u03c3\u03c4\u03bf\u03bb\u03ad\u03c2","showMissions":"\u03a0\u03c1\u03bf\u03b2\u03bf\u03bb\u03ae \u0391\u03c0\u03bf\u03c3\u03c4\u03bf\u03bb\u03ce\u03bd","createMission":"\u0394\u03b7\u03bc\u03b9\u03bf\u03c5\u03c1\u03b3\u03af\u03b1 \u0391\u03c0\u03bf\u03c3\u03c4\u03bf\u03bb\u03ae\u03c2","users":"\u03a7\u03c1\u03ae\u03c3\u03c4\u03b5\u03c2","showUsers":"\u03a0\u03c1\u03bf\u03b2\u03bf\u03bb\u03ae \u03a7\u03c1\u03b7\u03c3\u03c4\u03ce\u03bd","createUser":"\u0394\u03b7\u03bc\u03b9\u03bf\u03c5\u03c1\u03b3\u03af\u03b1 \u03a7\u03c1\u03ae\u03c3\u03c4\u03b7","home":"\u0391\u03c1\u03c7\u03b9\u03ba\u03ae","title":"\u03a4\u03af\u03c4\u03bb\u03bf\u03c2","youHave":"\u0388\u03c7\u03b5\u03c4\u03b5","notifications":"\u03b5\u03b9\u03b4\u03bf\u03c0\u03bf\u03b9\u03ae\u03c3\u03b5\u03b9\u03c2","allNotifications":"\u038c\u03bb\u03b5\u03c2 \u03bf\u03b9 \u03b5\u03b9\u03b4\u03bf\u03c0\u03bf\u03b9\u03ae\u03c3\u03b5\u03b9\u03c2","logOut":"\u0391\u03c0\u03bf\u03c3\u03cd\u03bd\u03b4\u03b5\u03c3\u03b7","lockScreen":"\u039a\u03bb\u03b5\u03af\u03b4\u03c9\u03bc\u03b1 \u039f\u03b8\u03cc\u03bd\u03b7\u03c2","profile":"\u03a0\u03c1\u03bf\u03c6\u03af\u03bb","tasks":"\u039f\u03b9 \u03b5\u03ba\u03ba\u03c1\u03b5\u03bc\u03cc\u03c4\u03b7\u03c4\u03ad\u03c2 \u03bc\u03bf\u03c5"},"el.admin_pages":{"home":"\u0391\u03c1\u03c7\u03b9\u03ba\u03ae","missions":"\u0391\u03c0\u03bf\u03c3\u03c4\u03bf\u03bb\u03ae|\u0391\u03c0\u03bf\u03c3\u03c4\u03bf\u03bb\u03ad\u03c2","users":"\u03a7\u03c1\u03ae\u03c3\u03c4\u03b7\u03c2|\u03a7\u03c1\u03ae\u03c3\u03c4\u03b5\u03c2","observations":"\u03a0\u03b1\u03c1\u03b1\u03c4\u03ae\u03c1\u03b7\u03c3\u03b7|\u03a0\u03b1\u03c1\u03b1\u03c4\u03b7\u03c1\u03ae\u03c3\u03b5\u03b9\u03c2","type":"\u03a4\u03cd\u03c0\u03bf\u03c2","route":"\u0394\u03b9\u03b1\u03b4\u03c1\u03bf\u03bc\u03ae","location":"\u039a\u03b1\u03c4\u03b1\u03b3\u03c1\u03b1\u03c6\u03ae \u03c3\u03b7\u03bc\u03b5\u03af\u03bf\u03c5 \u03c3\u03c4\u03bf \u03c7\u03ac\u03c1\u03c4\u03b7","contributors":"\u03c3\u03c5\u03bc\u03bc\u03b5\u03c4\u03ad\u03c7\u03bf\u03bd\u03c4\u03b5\u03c2","viewMission":"\u03a0\u03c1\u03bf\u03b2\u03bf\u03bb\u03ae \u03b1\u03c0\u03bf\u03c3\u03c4\u03bf\u03bb\u03ae\u03c2","creationDate":"\u0397\u03bc\u03b5\u03c1\u03bf\u03bc\u03b7\u03bd\u03af\u03b1 \u03b4\u03b7\u03bc\u03b9\u03bf\u03c5\u03c1\u03b3\u03af\u03b1\u03c2","description":"\u03a0\u03b5\u03c1\u03b9\u03b3\u03c1\u03b1\u03c6\u03ae","edit":"\u0395\u03c0\u03b5\u03be\u03b5\u03c1\u03b3\u03b1\u03c3\u03af\u03b1","delete":"\u0394\u03b9\u03b1\u03b3\u03c1\u03b1\u03c6\u03ae","missionNotFound":"\u0397 \u03b1\u03c0\u03bf\u03c3\u03c4\u03bf\u03bb\u03ae \u03b4\u03b5\u03bd \u03b2\u03c1\u03ad\u03b8\u03b7\u03ba\u03b5","addName":"\u03a0\u03b1\u03c1\u03b1\u03ba\u03b1\u03bb\u03ce \u03c3\u03c5\u03bc\u03c0\u03bb\u03b7\u03c1\u03ce\u03c3\u03c4\u03b5 \u03c4\u03bf \u03c0\u03b5\u03b4\u03af\u03bf \"\u038c\u03bd\u03bf\u03bc\u03b1\".","addDescription":"\u03a0\u03b1\u03c1\u03b1\u03ba\u03b1\u03bb\u03ce \u03c3\u03c5\u03bc\u03c0\u03bb\u03b7\u03c1\u03ce\u03c3\u03c4\u03b5 \u03c4\u03bf \u03c0\u03b5\u03b4\u03af\u03bf \"\u03a0\u03b5\u03c1\u03b9\u03b3\u03c1\u03b1\u03c6\u03ae\".","addType":"\u03a0\u03b1\u03c1\u03b1\u03ba\u03b1\u03bb\u03ce \u03b5\u03c0\u03b9\u03bb\u03ad\u03be\u03c4\u03b5 \u03c4\u03cd\u03c0\u03bf \u03b1\u03c0\u03bf\u03c3\u03c4\u03bf\u03bb\u03ae\u03c2.","name":"\u038c\u03bd\u03bf\u03bc\u03b1","missionType":"\u03a4\u03cd\u03c0\u03bf\u03c2 \u03b1\u03c0\u03bf\u03c3\u03c4\u03bf\u03bb\u03ae\u03c2","createMission":"\u0394\u03b7\u03bc\u03b9\u03bf\u03c5\u03c1\u03b3\u03af\u03b1 \u0391\u03c0\u03bf\u03c3\u03c4\u03bf\u03bb\u03ae\u03c2","editMission":"\u0395\u03c0\u03b5\u03be\u03b5\u03c1\u03b3\u03b1\u03c3\u03af\u03b1 \u0391\u03c0\u03bf\u03c3\u03c4\u03bf\u03bb\u03ae\u03c2","missionDetails":"\u03a3\u03c4\u03bf\u03b9\u03c7\u03b5\u03af\u03b1 \u03b1\u03c0\u03bf\u03c3\u03c4\u03bf\u03bb\u03ae\u03c2","save":"\u0391\u03c0\u03bf\u03b8\u03ae\u03ba\u03b5\u03c5\u03c3\u03b7","selectMission":"\u0395\u03c0\u03b9\u03bb\u03bf\u03b3\u03ae \u03b1\u03c0\u03bf\u03c3\u03c4\u03bf\u03bb\u03ae\u03c2","score":"\u0392\u03b1\u03b8\u03bc\u03bf\u03bb\u03bf\u03b3\u03af\u03b1","email":"Email","total":"\u03a3\u03cd\u03bd\u03bf\u03bb\u03bf","sendEmail":"\u0391\u03c0\u03bf\u03c3\u03c4\u03bf\u03bb\u03ae email","subject":"\u0398\u03ad\u03bc\u03b1","body":"\u03a0\u03b5\u03c1\u03b9\u03b5\u03c7\u03cc\u03bc\u03b5\u03bd\u03bf","send":"\u0391\u03c0\u03bf\u03c3\u03c4\u03bf\u03bb\u03ae","back":"\u0386\u03ba\u03c5\u03c1\u03bf"},"el.validation":{"accepted":"\u039f\u03b9 :attribute \u03c0\u03c1\u03ad\u03c0\u03b5\u03b9 \u03bd\u03b1 \u03b5\u03b9\u03bd\u03b1\u03b9 \u03b1\u03c0\u03bf\u03b4\u03b5\u03ba\u03c4\u03bf\u03af.","active_url":"\u03a4\u03bf :attribute \u03b4\u03b5\u03bd \u03b5\u03af\u03bd\u03b1\u03b9 \u03ad\u03b3\u03ba\u03c5\u03c1\u03bf URL.","after":"\u0397 :attribute \u03c0\u03c1\u03ad\u03c0\u03b5\u03b9 \u03bd\u03b1 \u03b5\u03af\u03bd\u03b1\u03b9 \u03b7\u03bc\u03b5\u03c1\u03bf\u03bc\u03b7\u03bd\u03af\u03b1 \u03bc\u03b5\u03c4\u03ac \u03b1\u03c0\u03cc \u03c4\u03b7\u03bd :date.","alpha":"\u03a4\u03bf :attribute \u03bc\u03c0\u03bf\u03c1\u03b5\u03af \u03bd\u03b1 \u03c0\u03b5\u03c1\u03b9\u03ad\u03c7\u03b5\u03b9 \u03bc\u03cc\u03bd\u03bf \u03b3\u03c1\u03ac\u03bc\u03bc\u03b1\u03c4\u03b1.","alpha_dash":"\u03a4\u03bf :attribute \u03bc\u03c0\u03bf\u03c1\u03b5\u03af \u03bd\u03b1 \u03c0\u03b5\u03c1\u03b9\u03ad\u03c7\u03b5\u03b9 \u03bc\u03cc\u03bd\u03bf \u03b1\u03bb\u03c6\u03b1\u03c1\u03b9\u03b8\u03bc\u03b7\u03c4\u03b9\u03ba\u03ac \u03ba\u03b1\u03b9 \u03c0\u03b1\u03cd\u03bb\u03b5\u03c2.","alpha_num":"\u03a4\u03bf :attribute \u03bc\u03c0\u03bf\u03c1\u03b5\u03af \u03bd\u03b1 \u03c0\u03b5\u03c1\u03b9\u03ad\u03c7\u03b5\u03b9 \u03bc\u03cc\u03bd\u03bf \u03b1\u03bb\u03c6\u03b1\u03c1\u03b9\u03b8\u03bc\u03b7\u03c4\u03b9\u03ba\u03ac.","array":"\u03a4\u03bf :attribute \u03c0\u03c1\u03ad\u03c0\u03b5\u03b9 \u03bd\u03b1 \u03b5\u03af\u03bd\u03b1\u03b9 \u03c0\u03af\u03bd\u03b1\u03ba\u03b1\u03c2.","before":"\u03a4\u03bf :attribute \u03c0\u03c1\u03ad\u03c0\u03b5\u03b9 \u03bd\u03b1 \u03b5\u03af\u03bd\u03b1\u03b9 \u03b7\u03bc\u03b5\u03c1\u03bf\u03bc\u03b7\u03bd\u03af\u03b1 \u03c0\u03c1\u03af\u03bd \u03c4\u03b7\u03bd :date.","between":{"numeric":"\u03a4\u03bf :attribute \u03c0\u03c1\u03ad\u03c0\u03b5\u03b9 \u03bd\u03b1 \u03b5\u03af\u03bd\u03b1\u03b9 \u03bc\u03b5\u03c4\u03b1\u03be\u03cd :min \u03ba\u03b1\u03b9 :max.","file":"\u03a4\u03bf :attribute \u03c0\u03c1\u03ad\u03c0\u03b5\u03b9 \u03bd\u03b1 \u03b5\u03af\u03bd\u03b1\u03b9 \u03bc\u03b5\u03c4\u03b1\u03be\u03cd :min \u03ba\u03b1\u03b9 :max kilobytes.","string":"\u03a4\u03bf :attribute \u03c0\u03c1\u03ad\u03c0\u03b5\u03b9 \u03bd\u03b1 \u03b5\u03af\u03bd\u03b1\u03b9 \u03bc\u03b5\u03c4\u03b1\u03be\u03cd :min \u03ba\u03b1\u03b9 :max \u03c7\u03b1\u03c1\u03b1\u03ba\u03c4\u03ae\u03c1\u03b5\u03c2.","array":"\u03a4\u03bf :attribute \u03c0\u03c1\u03ad\u03c0\u03b5\u03b9 \u03bd\u03b1 \u03ad\u03c7\u03b5\u03b9 :min \u03ad\u03c9\u03c2 :max \u03b1\u03bd\u03c4\u03b9\u03ba\u03b5\u03af\u03bc\u03b5\u03bd\u03b1."},"boolean":"\u03a4\u03bf \u03c0\u03b5\u03b4\u03af\u03bf :attribute \u03bc\u03c0\u03bf\u03c1\u03b5\u03af \u03bd\u03b1 \u03b5\u03af\u03bd\u03b1\u03b9 true \u03ae false.","confirmed":"\u0397 \u03b5\u03c0\u03b9\u03b2\u03b5\u03b2\u03b1\u03af\u03c9\u03c3\u03b7 \u03c4\u03bf\u03c5 :attribute \u03b4\u03b5\u03bd \u03b5\u03af\u03bd\u03b1\u03b9 \u03c3\u03c9\u03c3\u03c4\u03ae.","date":"\u0397 :attribute \u03b4\u03b5\u03bd \u03b5\u03af\u03bd\u03b1\u03b9 \u03ad\u03b3\u03ba\u03c5\u03c1\u03b7 \u03b7\u03bc\u03b5\u03c1\u03bf\u03bc\u03b7\u03bd\u03af\u03b1.","date_format":"\u03a4\u03bf :attribute \u03b4\u03b5\u03bd \u03b1\u03ba\u03bf\u03bb\u03bf\u03c5\u03b8\u03b5\u03af \u03c4\u03bf format :format.","different":"\u03a4\u03bf :attribute \u03ba\u03b1\u03b9 :other \u03c0\u03c1\u03ad\u03c0\u03b5\u03b9 \u03bd\u03b1 \u03b5\u03af\u03bd\u03b1\u03b9 \u03b4\u03b9\u03b1\u03c6\u03bf\u03c1\u03b5\u03c4\u03b9\u03ba\u03ac.","digits":"\u03a4\u03bf :attribute \u03c0\u03c1\u03ad\u03c0\u03b5\u03b9 \u03bd\u03b1 \u03b5\u03af\u03bd\u03b1\u03b9 :digits \u03c8\u03b7\u03c6\u03af\u03b1.","digits_between":"\u03a4\u03bf :attribute \u03c0\u03c1\u03ad\u03c0\u03b5\u03b9 \u03bd\u03b1 \u03b5\u03af\u03bd\u03b1\u03b9 \u03bc\u03b5\u03c4\u03b1\u03be\u03cd :min \u03ba\u03b1\u03b9 :max \u03c8\u03b7\u03c6\u03af\u03c9\u03bd.","email":"\u03a4\u03bf :attribute \u03c0\u03c1\u03ad\u03c0\u03b5\u03b9 \u03bd\u03b1 \u03b5\u03af\u03bd\u03b1\u03b9 \u03ad\u03b3\u03ba\u03c5\u03c1\u03b7 \u03b4\u03b9\u03b5\u03cd\u03b8\u03c5\u03bd\u03c3\u03b7 email.","filled":"\u03a0\u03b1\u03c1\u03b1\u03ba\u03b1\u03bb\u03ce \u03c3\u03c5\u03bc\u03c0\u03bb\u03b7\u03c1\u03ce\u03c3\u03c4\u03b5 \u03c4\u03bf \u03c0\u03b5\u03b4\u03af\u03bf :attribute.","exists":"\u03a4\u03bf \u03b5\u03c0\u03b9\u03bb\u03b5\u03b3\u03bc\u03ad\u03bd\u03bf :attribute \u03b4\u03b5\u03bd \u03b5\u03af\u03bd\u03b1\u03b9 \u03ad\u03b3\u03ba\u03c5\u03c1\u03bf.","image":"\u03a4\u03bf :attribute \u03c0\u03c1\u03ad\u03c0\u03b5\u03b9 \u03bd\u03b1 \u03b5\u03af\u03bd\u03b1\u03b9 \u03b5\u03b9\u03ba\u03cc\u03bd\u03b1.","in":"\u03a4\u03bf \u03b5\u03c0\u03b9\u03bb\u03b5\u03b3\u03bc\u03ad\u03bd\u03bf :attribute \u03b4\u03b5\u03bd \u03b5\u03af\u03bd\u03b1\u03b9 \u03ad\u03b3\u03ba\u03c5\u03c1\u03bf.","integer":"\u03a4\u03bf :attribute \u03c0\u03c1\u03ad\u03c0\u03b5\u03b9 \u03bd\u03b1 \u03b5\u03af\u03bd\u03b1\u03b9 \u03b1\u03ba\u03ad\u03c1\u03b1\u03b9\u03bf\u03c2.","ip":"\u0397 :attribute \u03c0\u03c1\u03ad\u03c0\u03b5\u03b9 \u03bd\u03b1 \u03b5\u03af\u03bd\u03b1\u03b9 \u03ad\u03b3\u03ba\u03c5\u03c1\u03b7 \u03b4\u03b9\u03b5\u03cd\u03b8\u03c5\u03bd\u03c3\u03b7 IP.","max":{"numeric":"\u03a4\u03bf :attribute \u03b4\u03b5\u03bd \u03bc\u03c0\u03bf\u03c1\u03b5\u03af \u03bd\u03b1 \u03b5\u03af\u03bd\u03b1\u03b9 \u03bc\u03b5\u03b3\u03b1\u03bb\u03cd\u03c4\u03b5\u03c1\u03bf \u03c4\u03bf\u03c5 :max.","file":"\u03a4\u03bf :attribute \u03b4\u03b5\u03bd \u03bc\u03c0\u03bf\u03c1\u03b5\u03af \u03bd\u03b1 \u03b5\u03af\u03bd\u03b1\u03b9 \u03bc\u03b5\u03b3\u03b1\u03bb\u03cd\u03c4\u03b5\u03c1\u03bf \u03b1\u03c0\u03cc :max kilobytes.","string":"\u03a4\u03bf :attribute \u03b4\u03b5\u03bd \u03bc\u03c0\u03bf\u03c1\u03b5\u03af \u03bd\u03b1 \u03b5\u03af\u03bd\u03b1\u03b9 \u03bc\u03b5\u03b3\u03b1\u03bb\u03cd\u03c4\u03b5\u03c1\u03bf :max \u03c7\u03b1\u03c1\u03b1\u03ba\u03c4\u03ae\u03c1\u03b5\u03c2.","array":"\u03a4\u03bf :attribute \u03b4\u03b5\u03bd \u03bc\u03c0\u03bf\u03c1\u03b5\u03af \u03bd\u03b1 \u03b5\u03af\u03bd\u03b1\u03b9 \u03c0\u03b5\u03c1\u03b9\u03c3\u03c3\u03cc\u03c4\u03b5\u03c1\u03b1 \u03b1\u03c0\u03cc :max \u03b1\u03bd\u03c4\u03b9\u03ba\u03b5\u03af\u03bc\u03b5\u03bd\u03b1."},"mimes":"\u03a4\u03bf :attribute \u03c0\u03c1\u03ad\u03c0\u03b5\u03b9 \u03bd\u03b1 \u03b5\u03af\u03bd\u03b1\u03b9 \u03b1\u03c1\u03c7\u03b5\u03af\u03bf \u03c4\u03cd\u03c0\u03bf\u03c5: :values.","min":{"numeric":"\u03a4\u03bf :attribute \u03c0\u03c1\u03ad\u03c0\u03b5\u03b9 \u03bd\u03b1 \u03b5\u03af\u03bd\u03b1\u03b9 \u03c4\u03bf\u03c5\u03bb\u03ac\u03c7\u03b9\u03c3\u03c4\u03bf\u03bd :min.","file":"\u03a4\u03bf :attribute \u03c0\u03c1\u03ad\u03c0\u03b5\u03b9 \u03bd\u03b1 \u03b5\u03af\u03bd\u03b1\u03b9 \u03c4\u03bf\u03c5\u03bb\u03ac\u03c7\u03b9\u03c3\u03c4\u03bf\u03bd :min kilobytes.","string":"\u03a4\u03bf :attribute \u03c0\u03c1\u03ad\u03c0\u03b5\u03b9 \u03bd\u03b1 \u03b5\u03af\u03bd\u03b1\u03b9 \u03c4\u03bf\u03c5\u03bb\u03ac\u03c7\u03b9\u03c3\u03c4\u03bf\u03bd :min \u03c7\u03b1\u03c1\u03b1\u03ba\u03c4\u03ae\u03c1\u03b5\u03c2.","array":"\u03a4\u03bf :attribute \u03c0\u03c1\u03ad\u03c0\u03b5\u03b9 \u03bd\u03b1 \u03ad\u03c7\u03b5\u03b9 \u03c4\u03bf\u03c5\u03bb\u03ac\u03c7\u03b9\u03c3\u03c4\u03bf\u03bd :min \u03b1\u03bd\u03c4\u03b9\u03ba\u03b5\u03af\u03bc\u03b5\u03bd\u03b1."},"not_in":"\u03a4\u03bf \u03b5\u03c0\u03b9\u03bb\u03b5\u03b3\u03bc\u03ad\u03bd\u03bf :attribute \u03b4\u03b5\u03bd \u03b5\u03af\u03bd\u03b1\u03b9 \u03ad\u03b3\u03ba\u03c5\u03c1\u03bf.","numeric":"\u03a4\u03bf :attribute \u03c0\u03c1\u03ad\u03c0\u03b5\u03b9 \u03bd\u03b1 \u03b5\u03af\u03bd\u03b1\u03b9 \u03b1\u03c1\u03b9\u03b8\u03bc\u03cc\u03c2.","regex":"\u03a4\u03bf format \u03c4\u03bf\u03c5 :attribute \u03b4\u03b5\u03bd \u03b5\u03af\u03bd\u03b1\u03b9 \u03ad\u03b3\u03ba\u03c5\u03c1\u03bf.","required":"\u03a0\u03b1\u03c1\u03b1\u03ba\u03b1\u03bb\u03ce \u03c3\u03c5\u03bc\u03c0\u03bb\u03b7\u03c1\u03ce\u03c3\u03c4\u03b5 \u03c4\u03bf \u03c0\u03b5\u03b4\u03af\u03bf.","required_if":"\u03a4\u03bf \u03c0\u03b5\u03b4\u03af\u03bf :attribute \u03b5\u03af\u03bd\u03b1\u03b9 \u03b1\u03c0\u03b1\u03b9\u03c4\u03bf\u03cd\u03bc\u03b5\u03bd\u03bf \u03cc\u03c4\u03b1\u03bd :other is :value.","required_with":"\u03a4\u03bf \u03c0\u03b5\u03b4\u03af\u03bf :attribute \u03b5\u03af\u03bd\u03b1\u03b9 \u03b1\u03c0\u03b1\u03b9\u03c4\u03bf\u03cd\u03bc\u03b5\u03bd\u03bf \u03cc\u03c4\u03b1\u03bd :values is present.","required_with_all":"\u03a4\u03bf \u03c0\u03b5\u03b4\u03af\u03bf :attribute \u03b5\u03af\u03bd\u03b1\u03b9 \u03b1\u03c0\u03b1\u03b9\u03c4\u03bf\u03cd\u03bc\u03b5\u03bd\u03bf \u03cc\u03c4\u03b1\u03bd :values is present.","required_without":"\u03a4\u03bf \u03c0\u03b5\u03b4\u03af\u03bf :attribute \u03b5\u03af\u03bd\u03b1\u03b9 \u03b1\u03c0\u03b1\u03b9\u03c4\u03bf\u03cd\u03bc\u03b5\u03bd\u03bf \u03cc\u03c4\u03b1\u03bd :values is not present.","required_without_all":"\u03a4\u03bf \u03c0\u03b5\u03b4\u03af\u03bf :attribute \u03b5\u03af\u03bd\u03b1\u03b9 \u03b1\u03c0\u03b1\u03b9\u03c4\u03bf\u03cd\u03bc\u03b5\u03bd\u03bf \u03cc\u03c4\u03b1\u03bd none of :values are present.","same":"\u03a4\u03bf \u03c0\u03b5\u03b4\u03af\u03bf :attribute \u03ba\u03b1\u03b9 :other \u03c0\u03c1\u03ad\u03c0\u03b5\u03b9 \u03bd\u03b1 \u03b5\u03af\u03bd\u03b1\u03b9 \u03cc\u03bc\u03bf\u03b9\u03b1.","size":{"numeric":"\u03a4\u03bf :attribute \u03c0\u03c1\u03ad\u03c0\u03b5\u03b9 \u03bd\u03b1 \u03b5\u03af\u03bd\u03b1\u03b9 :size.","file":"\u03a4\u03bf :attribute \u03c0\u03c1\u03ad\u03c0\u03b5\u03b9 \u03bd\u03b1 \u03b5\u03af\u03bd\u03b1\u03b9 :size kilobytes.","string":"\u03a4\u03bf :attribute \u03c0\u03c1\u03ad\u03c0\u03b5\u03b9 \u03bd\u03b1 \u03b5\u03af\u03bd\u03b1\u03b9 :size \u03c7\u03b1\u03c1\u03b1\u03ba\u03c4\u03ae\u03c1\u03b5\u03c2.","array":"\u03a4\u03bf :attribute \u03c0\u03c1\u03ad\u03c0\u03b5\u03b9 \u03bd\u03b1 \u03c0\u03b5\u03c1\u03b9\u03ad\u03c7\u03b5\u03b9 \u03c4\u03bf\u03c5\u03bb\u03ac\u03c7\u03b9\u03c3\u03c4\u03bf\u03bd :size items."},"unique":"\u03a4\u03bf :attribute \u03c7\u03c1\u03b7\u03c3\u03b9\u03bc\u03bf\u03c0\u03bf\u03b5\u03af\u03c4\u03b1\u03b9 \u03ae\u03b4\u03b7.","url":"\u03a4\u03bf format \u03c4\u03bf\u03c5 :attribute \u03b4\u03b5\u03bd \u03b5\u03af\u03bd\u03b1\u03b9 \u03ad\u03b3\u03ba\u03c5\u03c1\u03bf.","timezone":"\u0397 :attribute \u03c0\u03c1\u03ad\u03c0\u03b5\u03b9 \u03bd\u03b1 \u03b5\u03af\u03bd\u03b1\u03b9 \u03ad\u03b3\u03ba\u03c5\u03c1\u03b7 \u03b6\u03ce\u03bd\u03b7.","custom":{"attribute-name":{"rule-name":"custom-message"}},"attributes":[]},"en.admin_login":{"title":"City-R-US","logIn":"Login","remember":"Remember me","entrance":"Entrance","forgotPass":"Forgot your password?","register":"Create account"},"en.home_default":{"home":"Home","adminInterface":"Admin Dashboard","title":"City-R-US","subtitle":"Participate in mission in Athens <br>Improve your city","download":"Download the application","map":"Map with results"},"en.passwords":{"password":"Passwords must be at least six characters and match the confirmation.","user":"We can't find a user with that e-mail address.","token":"This password reset token is invalid.","sent":"We have e-mailed your password reset link!","resetPassword":"Reset password","sendReset":"Send Password Reset Link","resetOK":"Your password has been reset!"},"en.admin_menu":{"dashboard":"Home","missions":"Missions","showMissions":"View Missions","createMission":"Create Mission","users":"Users","showUsers":"View Users","createUser":"Create User","home":"Home","logOut":"Log out"},"en.admin_pages":{"home":"Home","missions":"Mission|Missions","users":"User|Users","observations":"Observation|Observations","type":"Type","route":"Route","location":"Location","contributors":"contributors","viewMission":"View mission","creationDate":"Creation date","description":"Description","edit":"Edit","delete":"Delete","missionNotFound":"Mission not found","name":"Name","missionType":"Mission Type","createMission":"Create mission","editMission":"Edit mission","missionDetails":"Mission details","save":"Save","selectMission":"Select mission","score":"Score","email":"Email","total":"Total","sendEmail":"Send email","subject":"Subject","body":"Message","send":"Send","back":"Back"},"en.validation":{"accepted":"The :attribute must be accepted.","active_url":"The :attribute is not a valid URL.","after":"The :attribute must be a date after :date.","alpha":"The :attribute may only contain letters.","alpha_dash":"The :attribute may only contain letters, numbers, and dashes.","alpha_num":"The :attribute may only contain letters and numbers.","array":"The :attribute must be an array.","before":"The :attribute must be a date before :date.","between":{"numeric":"The :attribute must be between :min and :max.","file":"The :attribute must be between :min and :max kilobytes.","string":"The :attribute must be between :min and :max characters.","array":"The :attribute must have between :min and :max items."},"boolean":"The :attribute field must be true or false.","confirmed":"The :attribute confirmation does not match.","date":"The :attribute is not a valid date.","date_format":"The :attribute does not match the format :format.","different":"The :attribute and :other must be different.","digits":"The :attribute must be :digits digits.","digits_between":"The :attribute must be between :min and :max digits.","email":"The :attribute must be a valid email address.","filled":"The :attribute field is required.","exists":"The selected :attribute is invalid.","image":"The :attribute must be an image.","in":"The selected :attribute is invalid.","integer":"The :attribute must be an integer.","ip":"The :attribute must be a valid IP address.","max":{"numeric":"The :attribute may not be greater than :max.","file":"The :attribute may not be greater than :max kilobytes.","string":"The :attribute may not be greater than :max characters.","array":"The :attribute may not have more than :max items."},"mimes":"The :attribute must be a file of type: :values.","min":{"numeric":"The :attribute must be at least :min.","file":"The :attribute must be at least :min kilobytes.","string":"The :attribute must be at least :min characters.","array":"The :attribute must have at least :min items."},"not_in":"The selected :attribute is invalid.","numeric":"The :attribute must be a number.","regex":"The :attribute format is invalid.","required":"The :attribute field is required.","required_if":"The :attribute field is required when :other is :value.","required_with":"The :attribute field is required when :values is present.","required_with_all":"The :attribute field is required when :values is present.","required_without":"The :attribute field is required when :values is not present.","required_without_all":"The :attribute field is required when none of :values are present.","same":"The :attribute and :other must match.","size":{"numeric":"The :attribute must be :size.","file":"The :attribute must be :size kilobytes.","string":"The :attribute must be :size characters.","array":"The :attribute must contain :size items."},"unique":"The :attribute has already been taken.","url":"The :attribute format is invalid.","timezone":"The :attribute must be a valid zone.","custom":{"attribute-name":{"rule-name":"custom-message"}},"attributes":[]}});})(window);