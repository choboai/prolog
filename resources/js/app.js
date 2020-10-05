require("./bootstrap");

const pl = require("tau-prolog");

const session = pl.create();

window.evaluate = function evaluate(event) {
  console.log(event);
  const program = document.querySelectorAll("#prolog-files textarea");
  console.log(program);
  const goal = document.querySelectorAll("#prolog-queries textarea");
  console.log(goal);
  // Consult
  session.consult(program, {
    success: function() {
      // Query
      session.query(goal, {
        success: function(goal) {
          // Answers
          session.answer({
            success: function(answer) {
              /* Answer */
              console.log(answer);
            },
            error: function(err) {
              /* Uncaught error */
            },
            fail: function() {
              /* Fail */
            },
            limit: function() {
              /* Limit exceeded */
            },
          });
        },
        error: function(err) {
          /* Error parsing goal */
        },
      });
    },
    error: function(err) {
      /* Error parsing program */
    },
  });
};
