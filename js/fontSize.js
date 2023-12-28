let elements = document.getElementsByTagName("*");

for (e of elements) {
  let size = parseFloat(
    window.getComputedStyle(e, null).getPropertyValue("font-size")
  );
  if (body.classList.contains("large")) e.style.fontSize = size * 1.05 + "px";
  if (body.classList.contains("small")) e.style.fontSize = size * 0.95 + "px";
}
