


function Floating(FloatingObj,MarginX,MarginY,Percentage,setTime,Mstart) {
 this.FloatingObj = FloatingObj;
 this.MarginX = (MarginX) ? MarginX : 0;
 this.MarginY = (MarginY) ? MarginY : 0;
 this.Percentage = (Percentage) ? Percentage : 20;
 this.setTime = (setTime) ? setTime : 10;
 this.FloatingObj.style.position = "absolute";
 this.Body = null;
 this.setTimeOut = null;
 this.Mstart = (Mstart) ? Mstart : 0;
 this.Run();
}

Floating.prototype.Run = function () {
 if ((document.documentElement.scrollLeft + document.documentElement.scrollTop) > (document.body.scrollLeft + document.body.scrollTop)) {
 this.Body = document.documentElement;
 } else {
 this.Body = document.body;
 }

 var This = this;
 var FloatingObjLeft = (this.FloatingObj.style.left) ? parseInt(this.FloatingObj.style.left,10) : this.MarginX;//this.FloatingObj.offsetLeft;
 var FloatingObjTop = (this.FloatingObj.style.top) ? parseInt(this.FloatingObj.style.top,10) : this.Mstart;//this.FloatingObj.offsetTop;
 var DocLeft = this.Body.scrollLeft + this.MarginX;
 var DocTop = this.Body.scrollTop + this.MarginY;

 var MoveX = Math.abs(FloatingObjLeft - DocLeft);
 MoveX = Math.ceil(MoveX / this.Percentage);
 var MoveY = Math.abs(FloatingObjTop - DocTop);
 MoveY = Math.ceil(MoveY / this.Percentage);

 if (FloatingObjLeft < DocLeft) {
 this.FloatingObj.style.left = FloatingObjLeft + MoveX + "px";
 } else {
 this.FloatingObj.style.left = FloatingObjLeft - MoveX + "px";
 }

 if (FloatingObjTop < DocTop) {
 this.FloatingObj.style.top = FloatingObjTop + MoveY + "px";
 } else {
 this.FloatingObj.style.top = FloatingObjTop - MoveY + "px";
 }

 window.clearTimeout(this.setTimeOut);
 this.setTimeOut = window.setTimeout(function () { This.Run(); },this.setTime);
}




