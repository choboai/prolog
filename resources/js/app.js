// require("./bootstrap");

import Prism from "prismjs";

Prism.highlightAll();

Livewire.hook("element.updated", () => {
  Prism.highlightAll();
});

var Turbolinks = require("turbolinks");
Turbolinks.start();

document.addEventListener("turbolinks:load", function() {
  Prism.highlightAll();
});

const pl = require("tau-prolog");

const session = pl.create();

window.evaluate = function evaluate(mouseClickEvent) {
  // Consult
  session.consult(getProgram(), {
    success: function() {
      // Query

      const goal = getGoal(mouseClickEvent);
      //   console.log(goal);
      session.query(goal, {
        success: function(goal) {
          session.answer({
            success: function(answer) {
              showResult(session.format_answer(answer));
            },
            error: function(err) {
              /* Uncaught error */
              showError(err);
            },
            fail: function() {
              /* Fail */
              showError("false.");
            },
            limit: function() {
              /* Limit exceeded */
              showError("Limit exceeded");
            },
          });
        },
        error: function(err) {
          /* Error parsing goal */
          showError("Error parsing query! \n" + err);
        },
      });
    },
    error: function(err) {
      showError("Error parsing program! \n" + err);
    },
  });
  scrollTo("");
  scrollTo("results");
};

function getProgram() {
  const files = document.querySelectorAll(".prolog-files");
  return Array.from(files)
    .map((file) => getProgramFileValue(file))
    .reduce((program, file) => program + "\n" + file);
}

function getProgramFileValue(file) {
  return file.value;
}

function getGoal(mouseClickEvent) {
  return mouseClickEvent.target.closest("button").parentNode.previousSibling
    .previousSibling.value;
}

function showResult(text) {
  Livewire.emit("result", "success", text);
}

function showError(text) {
  Livewire.emit("result", "error", text);
}

function scrollTo(hash) {
  if (hash === "") {
    location.hash = "";
  }
  location.hash = "#" + hash;
}
