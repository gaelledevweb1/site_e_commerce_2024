/**
 * This is the main JavaScript file for the app.
 * It will be included onto the page via the importmap() Twig function.
 */

import "./bootstrap.js";
import "./styles/app.css";

console.log("This log comes from assets/app.js - welcome to AssetMapper! 🎉");

/**
 * Event listener for the order form.
 * Retrieves the values of the address and transporter fields.
 * chargement du dom pour récupérer les valeurs des champs adresse et transporteur
 */
// document.addEventListener("DOMContentLoaded", (event) => {
//   const orderForm = document.querySelector(".orderForm");
//   console.log(orderForm);
//   orderForm.addEventListener("submit", (event) => {
//     event.preventDefault(); // Empêche l'envoi du formulaire

//     const valueAdress = document.querySelector("#order_adress").value;
//     console.log(valueAdress);
//     const selectedAdress = document.querySelector(
//       'input[name="order[adress]"]:checked'
//     );
//     const selectedAdressValue = selectedAdress ? selectedAdress.value : null;
//     console.log(selectedAdressValue);

//     let adressLabelText = null;
//     if (selectedAdress) {
//       const label = document.querySelector(`label[for="${selectedAdress.id}"]`);
//       adressLabelText = label ? label.textContent : null;
//       console.log(adressLabelText);
//     }
//     const valueTransporter = document.querySelector("#order_transporter").value;
//     console.log(valueTransporter);
//     const selectedTransporter = document.querySelector(
//       'input[name="order[transporter]"]:checked'
//     );
//     const selectedTransporterValue = selectedTransporter
//       ? selectedTransporter.value
//       : null;
//     console.log(selectedTransporterValue);

//     let transporterLabelText = null;
//     if (selectedTransporter) {
//       const label = document.querySelector(
//         `label[for="${selectedTransporter.id}"]`
//       );
//       transporterLabelText = label ? label.textContent : null;
//       console.log(transporterLabelText);
//     }

//     //  je decoupe le numero, le nom de la rue, le code postal et la ville de l'adresse
//     const adressArray = adressLabelText.split(",");
//     console.log(adressArray);
//     const parseAddress = require("parse-address");

//     const address = "15 rue de silly Boulogne 92100 France";
//     const parsed = parseAddress.parseLocation(address);

//     console.log(parsed);

//     //  je stocke les valeurs des champs adresse et transporteur dans un objet et leur label respectifs
//     const orderData = {
//       adress: valueAdress,
//       transporter: valueTransporter,
//       adressLabel: adressLabelText,
//       transporterLabel: transporterLabelText,
//     };

//     console.log(orderData);

//     // j'utilise fetch pour envoyer les données du formulaire sur le serveur

//     fetch("/order/verify", {
//       method: "POST",
//       headers: {
//         "Content-Type": "application/json",
//       },
//       body: JSON.stringify(orderData),
//     })
//       .then((response) => response.json())
//       .then((data) => {
//         console.log("Success:", data);
//         // je récupère le message d'erreur ou de succès et je l'affiche dans une alerte
//         if (data.error) {
//           alert(data.error);
//         } else {
//           alert(data.success);
//         }
//       })
//       .catch((error) => {
//         console.error("Error:", error);
//       });
//   });
// });

/**
 * Adds a fixed-top class to the navbar and adjusts padding when scrolling.
 */
document.addEventListener("DOMContentLoaded", function () {
  window.addEventListener("scroll", function () {
    if (window.scrollY > 50) {
      document.getElementById("navbar_top").classList.add("fixed-top");
      var navbar_height = document.querySelector(".navbar").offsetHeight;
      document.body.style.paddingTop = navbar_height + "px";
    } else {
      document.getElementById("navbar_top").classList.remove("fixed-top");
      document.body.style.paddingTop = "0";
    }
  });
});

const cookies = document.querySelector(".cookies");
const btnSuccessCookie = document.querySelector(".btn-success");

/**
 * Event listener for the success cookie button.
 * Hides the cookies div when clicked.
 */
btnSuccessCookie.addEventListener("click", function () {
  /**
   * Au click sur le bouton
   * on stocke le choix de l'utilisateur
   */

  //  je créé le locale storage avec la valeur 'oui';
  localStorage.setItem("bannière", "oui");
  cookies.style.opacity = "0";
});

//   je déclare la fonction check
function check() {
  console.log("fonction check () déclenché");
  //     je stocke la valeur du local storage
  let valeurCle = localStorage.getItem("bannière");
  console.log(valeurCle, "valeur de la clé bannière");
  //   si la valeur  de la clé bannière est egale à 'oui'
  // alors la DIV cookies devient invisible
  if (valeurCle === "oui") {
    console.log(" le stockage existe, la valeur de la clé est 'oui");
    cookies.remove();
  } else {
    console.log(
      'le stockage n\'existe pas, la valeur de la clé bannière sont "absentes"'
    );
  }
}
check();

/**
 * Event listener for the back-to-top button.
 * Shows the button when the user scrolls down,
 * and scrolls to the top of the document when clicked.
 */
document.addEventListener("DOMContentLoaded", function () {
  let mybutton = document.querySelector("#btn-back-to-top");

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

  mybutton.addEventListener("click", backToTop);

  function backToTop() {
    document.documentElement.scrollTop = 0;
  }
});
