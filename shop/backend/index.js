function toggleMenu(id, element) {
  const menu = document.getElementById(id);
  menu.classList.toggle('hidden');

  const arrow = element.querySelector('span');
  arrow.classList.toggle('rotate-180');
  arrow.classList.toggle('rotate-0');
}
