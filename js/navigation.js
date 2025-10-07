/**
 * File navigation.js.
 *
 * Handles toggling the navigation menu for small screens and enables TAB key
 * navigation support for dropdown menus.
 */

document.addEventListener('DOMContentLoaded', function () {
	const offcanvas = document.getElementById('offcanvasNavbar');
  
	if (!offcanvas) return;
  
	// Only apply to dropdowns inside offcanvas
	offcanvas.querySelectorAll('.dropdown-toggle').forEach(function (toggleBtn) {
	  toggleBtn.addEventListener('click', function (e) {
		e.preventDefault();
		e.stopPropagation();
  
		const parentLi = toggleBtn.closest('.dropdown');
		const menu = parentLi.querySelector('.dropdown-menu');
  
		// Close other dropdowns in offcanvas
		offcanvas.querySelectorAll('.dropdown-menu.show').forEach(function (openMenu) {
		  if (openMenu !== menu) openMenu.classList.remove('show');
		});
  
		menu.classList.toggle('show');
	  });
	});
  
	// Click outside menu to close all
	document.addEventListener('click', function (e) {
	  if (!offcanvas.contains(e.target)) {
		offcanvas.querySelectorAll('.dropdown-menu.show').forEach(function (menu) {
		  menu.classList.remove('show');
		});
	  }
	});
  });

  