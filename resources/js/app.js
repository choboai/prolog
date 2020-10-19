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
