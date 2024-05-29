import "./bootstrap.js";
/*
 * Welcome to your app's main JavaScript file!
 *
 * This file will be included onto the page via the importmap() Twig function,
 * which should already be in your base.html.twig.
 */
import "./styles/app.css";

//  import './styles/slider.css';

console.log("This log comes from assets/app.js - welcome to AssetMapper! 🎉");

// navbar (effet parralax):
 document.addEventListener("DOMContentLoaded", function(){
      
   window.addEventListener('scroll', function() {
       
     if (window.scrollY > 50) {
       document.getElementById('navbar_top').classList.add('fixed-top');
       // add padding top to show content behind navbar
        var navbar_height = document.querySelector('.navbar').offsetHeight;
       document.body.style.paddingTop = navbar_height + 'px';
     } else {
        document.getElementById('navbar_top').classList.remove('fixed-top');
        // remove padding top from body
       document.body.style.paddingTop = '0';
     } 
   });
 }); 




// cookies

const cookies = document.querySelector(".cookies");
console.log(cookies);
const btnSuccessCookie = document.querySelector(".btn-success");
console.log(btnSuccessCookie);

btnSuccessCookie.addEventListener("click", function () {
  console.log("bouton cliqué!");
  //   j'utilise la propriété style de la div cookies pour la faire disparaitre
  cookies.style.opacity = "0";
});

// footer icone pour remonter en haut de page



// document.addEventListener("DOMContentLoaded", function () {
//   const iconUpPage = document.querySelector(".icone-up-page");
//   console.log(iconUpPage);

//   iconUpPage.addEventListener("click", function () {
//     // !  le console.log("Clic détecté"); ne fonctionne pas 
//     console.log("Clic détecté");
//     // aller en haut de page
//     if (window.scrollY !== 0) {
//       window.scrollTo(0, 0);
//       console.log("devrait etre en haut")
//     } else {
//       console.log("vous etes en bas de page");
//     }
//   });
// });

// !ceci ne fonctionne pas non plus pour remonter vers le haut de la page ( une partie du code  fonctionne mais pas tout)
// bouton pour remonter en haut de page (code repris d'ici :https://mdbootstrap.com/snippets/standard/mdbootstrap/2964350#js-tab-view)
//Get the button
// attendre de charger le DOM
 document.addEventListener("DOMContentLoaded", function() {
   let mybutton = document.querySelector("#btn-back-to-top");
   console.log(mybutton);

   // When the user scrolls down 20px from the top of the document, show the button
  window.onscroll = function () {
    scrollFunction();
  };

  function scrollFunction() {
    if (
       document.body.scrollTop > 20 ||
      document.documentElement.scrollTop > 20
    ) {
      mybutton.style.display = "block";
     } else {
       mybutton.style.display = "none";
     }
   }
   // When the user clicks on the button, scroll to the top of the document
   mybutton.addEventListener("click", backToTop);

   function backToTop() {
     // document.body.scrollTop = 0;
     document.documentElement.scrollTop = 0;
   }
 });


