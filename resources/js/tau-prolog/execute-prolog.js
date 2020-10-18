const session = window.pl.create();

window.evaluate = function evaluate(mouseClickEvent) {
  // Consult
  //   console.log(getProgram());
  session.consult(getProgram(), {
    success: function() {
      // Query

      const goal = getGoal(mouseClickEvent);
      //   console.log(goal);
      session.query(goal, {
        success: function(goal) {
          session.answer({
            success: function(answer) {
              session.draw(100, "derivation");

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
      //   console.log(session.format_answer(err));
      showError("Error parsing program! \n" + err);
    },
  });
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
  window.tree = "";
}

function scrollTo(hash) {
  if (hash === "") {
    location.hash = "";
  }
  location.hash = "#" + hash;
}
