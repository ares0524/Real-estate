/*! For license information please see admin.0bc1672c.js.LICENSE.txt */
(self.webpackChunk=self.webpackChunk||[]).push([[205],{478:(e,t,n)=>{"use strict";var o=n(808),i=n.n(o);n(509);$(document).ready((()=>{let e=window.location.href;$(".sidebar .nav-item").each((function(){let t=$("a",this).attr("href");(e.includes(t)||t.includes("locations")&&e.includes("locations"))&&$(this).addClass("active")})),$("#sidebarToggle").on("click",(e=>{let t=$("body");e.preventDefault(),$(t).is(".sidebar-toggled")?i().set("sidebar-toggled",!1):i().set("sidebar-toggled",!0),t.toggleClass("sidebar-toggled"),$(".sidebar").toggleClass("toggled")})),$("#sort_by, #state").on("change",(()=>{let e=$("#sort_by").val(),t=$("#state").val();window.location.href=window.location.pathname+"?sort_by="+e+"&state="+t}))}))},509:()=>{!function(e,t){"use strict";e('[data-type="delete"]').click((function(n){n.preventDefault();const o=e(this).closest("form"),i=e(this).data("message"),r=e(this).data("confirmation-text"),a=e(this).data("cancellation-text");t.confirm({message:i,buttons:{cancel:{label:a,className:"btn-light"},confirm:{label:r,className:"btn-danger"}},callback:function(e){e&&o.submit()}})}))}($,bootbox)},808:(e,t,n)=>{var o,i;!function(r){if(void 0===(i="function"==typeof(o=r)?o.call(t,n,t,e):o)||(e.exports=i),!0,e.exports=r(),!!0){var a=window.Cookies,c=window.Cookies=r();c.noConflict=function(){return window.Cookies=a,c}}}((function(){function e(){for(var e=0,t={};e<arguments.length;e++){var n=arguments[e];for(var o in n)t[o]=n[o]}return t}function t(e){return e.replace(/(%[0-9A-Z]{2})+/g,decodeURIComponent)}return function n(o){function i(){}function r(t,n,r){if("undefined"!=typeof document){"number"==typeof(r=e({path:"/"},i.defaults,r)).expires&&(r.expires=new Date(1*new Date+864e5*r.expires)),r.expires=r.expires?r.expires.toUTCString():"";try{var a=JSON.stringify(n);/^[\{\[]/.test(a)&&(n=a)}catch(e){}n=o.write?o.write(n,t):encodeURIComponent(String(n)).replace(/%(23|24|26|2B|3A|3C|3E|3D|2F|3F|40|5B|5D|5E|60|7B|7D|7C)/g,decodeURIComponent),t=encodeURIComponent(String(t)).replace(/%(23|24|26|2B|5E|60|7C)/g,decodeURIComponent).replace(/[\(\)]/g,escape);var c="";for(var s in r)r[s]&&(c+="; "+s,!0!==r[s]&&(c+="="+r[s].split(";")[0]));return document.cookie=t+"="+n+c}}function a(e,n){if("undefined"!=typeof document){for(var i={},r=document.cookie?document.cookie.split("; "):[],a=0;a<r.length;a++){var c=r[a].split("="),s=c.slice(1).join("=");n||'"'!==s.charAt(0)||(s=s.slice(1,-1));try{var l=t(c[0]);if(s=(o.read||o)(s,l)||t(s),n)try{s=JSON.parse(s)}catch(e){}if(i[l]=s,e===l)break}catch(e){}}return e?i[e]:i}}return i.set=r,i.get=function(e){return a(e,!1)},i.getJSON=function(e){return a(e,!0)},i.remove=function(t,n){r(t,"",e(n,{expires:-1}))},i.defaults={},i.withConverter=n,i}((function(){}))}))}},e=>{var t;t=478,e(e.s=t)}]);