"use strict";




let form = document.querySelector('.form__body'),
    formInputs = document.querySelectorAll('.form__input'),
    inputEmail = document.querySelector('.email'),
    inputPhone = document.querySelector('.phone'),
    inputPass = document.querySelector('.password'),
    inputPassre = document.querySelector('.password__repeat'),
    inputName = document.querySelector('.surname');

    


function validateEmail(email) {
    let re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    return re.test(String(email).toLowerCase());
}


function validateName(surname) {
    let re = /^[a-zA-Z]{2,20}\s+[a-zA-Z]{2,20}$/;
    return re.test(String(surname).toLowerCase());
}

function validatePhone(phone) {
    let re = /^([0-9]){9}$/;
    return re.test(String(phone));
}

function validatePass(password) {
    let re = /^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9]).{8,}$/g;
    return re.test(String(password));
}

form.addEventListener('submit', function(e){


    let emailVal = inputEmail.value,
        phoneVal = inputPhone.value,
        passVal = inputPass.value,
        nameVal = inputName.value,
        passreVal = inputPassre.value;



    if(!reg.test(nameVal) && (nameVal != '')){
      inputName.classList.add('error');
      showErr(inputName, 'Pouze latinská písmena');
      e.preventDefault();
      return false;
  } else {
      inputName.classList.remove('error');
  }
    if(nameVal == '') {
      inputName.classList.add('error');
      showErr(inputName, 'Toto pole je povinné.');
      e.preventDefault();
      return false;
  } else {
      inputName.classList.remove('error');
  }

    if(!validateEmail(emailVal) && emailVal != '') {
        inputEmail.classList.add('error');
        showErr(inputEmail, 'Nesprávný formát e-mailu');
        e.preventDefault();
        return false;
    } else {
        inputEmail.classList.remove('error');
    }

    if( emailVal == '') {
        inputEmail.classList.add('error');
        showErr(inputEmail, 'Toto pole je povinné.');
        e.preventDefault();
        return false;
    } else {
        inputEmail.classList.remove('error');
    }

   if(!validatePass(passVal) && passVal != '') {
        inputPass.classList.add('error');
        showErr(inputPass, 'Musí být velké malé písmeno a číslo');
        e.preventDefault();
        return false;
    } else {
        inputPass.classList.remove('error');
    }

   if( passVal == '') {
        inputPass.classList.add('error');
        showErr(inputPass, 'Toto pole je povinné.');
        e.preventDefault();
        return false;
    } else {
        inputPass.classList.remove('error');
    }


    if(passreVal !== passVal ) {
      inputPassre.classList.add('error');
      showErr(inputPassre, 'Musí být stejné jako předchozí');
      e.preventDefault();
      return false;
  } else {
      inputPassre.classList.remove('error');
  }


    if (!validatePhone(phoneVal) && phoneVal != '') {
        inputPhone.classList.add('error');
        showErr(inputPhone, 'Musí být devět čísel');
        e.preventDefault();
        return false;
    } else {
        inputPhone.classList.remove('error');
    } 
    if (phoneVal == '') {
        inputPhone.classList.add('error');
        showErr(inputPhone, 'Toto pole je povinné.');
        e.preventDefault();
        return false;
    } else {
        inputPhone.classList.remove('error');
    } 

});



function showErr(field, errText) {
   if (field.nextElementSibling 
       && field.nextElementSibling.textContent === errText) {
       return;
   }

   field.classList.add('error');

   const err = document.createElement('p');
   field.after(err);
   err.classList.add('err-message');
   err.textContent = errText;
   
   hideErr(field, err);
}

function hideErr(field, err) {
   field.addEventListener('input', () => {
       field.classList.remove('error');
       err.remove();
   });
}



const forma = document.forms['form'];


forma.addEventListener('input', inputHandler);


function inputHandler({target}){
   if(target.hasAttribute('pattern')){
      inputChack(target);
   }
}

function inputChack(el){
   const inputValue = el.value;
   const inputReg = el.getAttribute('pattern');
   const reg = new RegExp(inputReg);
   if(!reg.test(inputValue)){
    if(el.getAttribute('name') == 'name'){
        showErr(inputName, 'Pouze latinská písmena');
    }
    if(el.getAttribute('name') == 'email'){
        showErr(inputEmail, 'Nesprávný formát e-mailu');
    }
    if(el.getAttribute('name') == 'pswHash'){
        showErr(inputPass, 'Musí být velké malé písmeno a číslo');
    }
    if(el.getAttribute('name') == 'phone'){
        showErr(inputPhone, 'Musí být devět čísel');
    }
   } 

   if (inputPassre.value != inputPass.value || !reg.test(inputValue)){
    if(el.getAttribute('name') == 'psw_repeat'){
        showErr(inputPassre, 'Musí být stejné jako předchozí');
    }
   } else {
    el.classList.remove('error');
   }



}
