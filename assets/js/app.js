

/* Get all elements with class="close" */
var btnRemove = document.getElementsByClassName("btn-remove");
var i;

/* Loop through the elements, and hide the parent, when clicked on */
for (i = 0; i < btnRemove.length; i++) {
  btnRemove[i].addEventListener("click", function() {
  this.parentElement.style.display = 'none';
});