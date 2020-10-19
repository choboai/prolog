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
