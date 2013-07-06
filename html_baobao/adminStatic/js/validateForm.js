/*
 * @desc : the class for validate the form(表单验证类)
 * @auth : yesGang@hotmail.com
 * @date : 2011-08-07
 * @vFldArr : the input that you want to be checked(要验证的字段)
 * @vTipArr : the notice of each requested field(对应的提示语)
 * @vPtnArr : the RegExp of each request field(对应的正则表达式)
 * @return : true or false
 * @version: 1.1 (use eleById=null)
 */
//the enter and handle func of validate
function ValidateForm(vFldArr, vTipArr, vPtnArr) {
	this.fldArr = vFldArr;
	this.tipArr = vTipArr;
	this.ptnArr = vPtnArr;

	//tip's className(提示语的css名)
	this.vTipClass = 'vTip';
	this.isChecked = false;
	this.isFocused = false;
	this.isValid = true;	
	this.eleById = null;
	//init functions(定义相关函数)
	this.vChkFld = validateField;
	this.vShwTip = showTip;
	this.vClsTip = clearTip;
	//RegExp prepared(提供的正则表达式)
	this.pTel = /^\d{11}$/;
	this.pEml = /^[\w-]{1,18}@[\da-zA-Z]{1,10}(\.(com|cn|net)|\.com\.cn)$/;
	this.pZip = /^\d{6}$/;
	//main function(主函数)
	this.vChk = function () {
		(true==this.isChecked) ? this.vClsTip() : this.isChecked=true;
		for ( var x=0; x<this.fldArr.length; x++ ) {
			this.eleById = document.getElementById(this.fldArr[x]);
			if ( this.vChkFld(x) !=0 ) this.vShwTip(x);
		}
		return this.isValid;
	}

	//check the input is not null or right for RegExp
	//0: no error; 1: is null; 2: format wrong
	function validateField(i) {
		var  res = 0;
		if ( f=this.eleById ) {
			if ( ''==f.value ) res=1;
			else if ( this.ptnArr[i] && !this.ptnArr[i].test(f.value) ) res=2;
			if ( res!=0 && true==this.isValid ) this.isValid = false;
		}
		return res;
	}
	//show the tip of requested field
	function showTip(i) {
		if ( f=this.eleById ) {
			var sp = document.createElement('SPAN');
			sp.id = this.fldArr[i]+'warn';
			sp.className = this.vTipClass;
			sp.innerHTML = this.tipArr[i];
			insertAfter(sp, f);
		}
		if ( false==this.isFocused ) { f.focus(); this.isFocused=true; }
	}
	//clear the tips of all
	function clearTip() {
		this.isFocused = false;
		this.isValid = true;
		for ( var x=0; x<this.tipArr.length; x++ ) {
			var ele = document.getElementById(this.fldArr[x]+'warn');
			if (ele) ele.innerHTML = '';
		}
	}
	function insertAfter(newEl, tEl) {
		var pEl = tEl.parentNode;
		(pEl.lastChild==tEl)? pEl.appendChild(newEl) 
							: pEl.insertBefore(newEl,tEl.nextSibling);
	}
}