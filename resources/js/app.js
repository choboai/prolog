window.tree = "";

import smoothscroll from "smoothscroll-polyfill";
smoothscroll.polyfill();

require("./tau-prolog/execute-prolog");

import Prism from "prismjs";

Prism.highlightAll();

Livewire.hook("element.updated", () => {
  Prism.highlightAll();
});

window.copyButton = function copyButton() {
  return {
    isCopied: false,
    isTextareaHidden: true,
    copy(e) {
      let prologCode = e.target.closest("button").parentNode.parentNode
        .parentNode.nextSibling.nextSibling.nextSibling.nextSibling;
      prologCode.style.display = "block";
      prologCode.previousSibling.previousSibling.style.display = "none";
      this.isTextareaHidden = false;
      prologCode.select();
      prologCode.select();
      prologCode.setSelectionRange(0, 99999); /*For mobile devices*/
      document.execCommand("copy");

      this.isCopied = true;
    },
    toggle() {
      this.isTextareaHidden = false;
    },
  };
};

// var turbolinks = require("turbolinks");
// // Turbolinks.start();

// document.addEventListener("livewire:load", function(event) {
//   turbolinks.start();
// });

// document.addEventListener("turbolinks:load", function() {
//   Prism.highlightAll();
// });
