require("./tabulation");
require("./copybtn");

import smoothscroll from "smoothscroll-polyfill";
smoothscroll.polyfill();

window.tree = "";
require("./tau-prolog/execute-prolog");

import Prism from "prismjs";
Prism.highlightAll();
Livewire.hook("element.updated", () => {
  Prism.highlightAll();
});

window.openImage = (event) => {
  let w = window.open("about:blank");

  w.document.body.appendChild(w.document.createElement("img")).src =
    window.treeDataUrl;
};
