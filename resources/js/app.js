require("./tabulation");
require("./copybtn");

import smoothscroll from "smoothscroll-polyfill";
smoothscroll.polyfill();

window.tree = "";
require("./tau-prolog/execute-prolog");

window.openImage = () => {
  var url = window.treeDataUrl;
  var w = window.open("about:blank");
  setTimeout(() => {
    w.document.body.appendChild(w.document.createElement("img")).src = url;
  }, 0);
};
