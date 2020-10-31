window.copyButton = function copyButton() {
  return {
    isCopied: false,
    isTextareaHidden: true,
    copy(e) {
      let prologCode = null;
      let prologHl = null;

      if (
        e.target.closest("button").parentNode.parentNode.parentNode.nextSibling
          .nextSibling.nextSibling.nextSibling.style !== undefined
      ) {
        prologCode = e.target.closest("button").parentNode.parentNode.parentNode
          .nextSibling.nextSibling.nextSibling.nextSibling;
        prologHl = prologCode.previousSibling.previousSibling;
      } else {
        prologCode = e.target.closest("button").parentNode.parentNode.parentNode
          .nextSibling.nextSibling.nextSibling;
        prologHl = prologCode.previousSibling;
      }

      prologCode.style.display = "block";
      prologHl.style.display = "none";
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
