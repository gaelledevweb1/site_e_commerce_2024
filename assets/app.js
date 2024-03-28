import './bootstrap.js';
/*
 * Welcome to your app's main JavaScript file!
 *
 * This file will be included onto the page via the importmap() Twig function,
 * which should already be in your base.html.twig.
 */
  import './styles/app.css';
//  import './styles/slider.css';

console.log('This log comes from assets/app.js - welcome to AssetMapper! 🎉');

const btnNav = document.querySelector('.navbar-toggler');
console.log(btnNav,"btnNav clicked");
const menu = document.querySelector('.navbar-collapse');
btnNav.addEventListener('click', () => {
  
  menu.classList.toggle('show');
});

// cookies 

 const cookies = document.querySelector('.cookies');
 console.log(cookies);
 const btnSuccess = document.querySelector('.btn-success');
 console.log(btnSuccess);

  btnSuccess.addEventListener('click',function(){
      console.log('bouton cliqué!');
     //   j'utilise la propriété style de la div cookies pour la faire disparaitre
      cookies.style.opacity ='0';
  });

