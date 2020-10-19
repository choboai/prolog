let session = window.pl.create();

window.evaluate = function evaluate(mouseClickEvent) {
  session = window.pl.create();
  session.consult(getProgram(), {
    success: function() {
      // Query
      const goal = getGoal(mouseClickEvent);
      session.query(goal, {
        success: function(goal) {
          session.answer({
            success: function(answer) {
              showResult(session.format_answer(answer));
            },
            error: function(err) {
              /* Uncaught error */
              showError("Oops :\n" + err);
            },
            fail: function(answer) {
              /* Fail */
              showError(session.format_answer(answer));
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

  session = window.pl.create();

  session.consult(getProgram(), {
    success: function() {
      // Query
      const goal = getGoal(mouseClickEvent);
      session.query(goal, {
        success: function(goal) {
          session.draw(100, "derivation", getStyle(), getWriteOptions());
        },
        error: function(err) {
          window.tree = "";
        },
      });
    },
    error: function(err) {
      window.tree = "";
    },
  });
  document.querySelector("#results").scrollIntoView({ behavior: "smooth" });
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
  // page edit
  if (
    mouseClickEvent.target.closest("button").parentNode.previousSibling
      .previousSibling.value != null
  ) {
    return mouseClickEvent.target.closest("button").parentNode.previousSibling
      .previousSibling.value;
  }
  return mouseClickEvent.target.closest("button").parentNode.parentNode
    .parentNode.nextSibling.nextSibling.nextSibling.nextSibling.value;
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

function getStyle() {
  return require("./theme.json");
}

function getWriteOptions() {
  return {
    session: session,
    ignore_ops: true,
    quoted: false,
    numbervars: false,
  };
}
