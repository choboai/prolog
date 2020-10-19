// https://stackoverflow.com/questions/6637341/use-tab-to-indent-in-textarea
let textareas = document.querySelectorAll("textarea");
for (let index = 0; index < textareas.length; index++) {
  const element = textareas[index];
  element.addEventListener("keydown", function(e) {
    if (e.key == "Tab") {
      e.preventDefault();
      var start = this.selectionStart;
      var end = this.selectionEnd;

      // set textarea value to: text before caret + tab + text after caret
      this.value =
        this.value.substring(0, start) + "\t" + this.value.substring(end);

      // put caret at right position again
      this.selectionStart = this.selectionEnd = start + 1;
    }
  });
}
