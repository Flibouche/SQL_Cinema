/*=============== SHOW MENU ===============*/
const navMenu = document.getElementById("nav-menu"),
  navToggle = document.getElementById("nav-toggle"),
  navClose = document.getElementById("nav-close");

/* Menu show */
if (navToggle) {
  navToggle.addEventListener("click", () => {
    navMenu.classList.add("show-menu");
  });
}

/* Menu hidden */
if (navClose) {
  navClose.addEventListener("click", () => {
    navMenu.classList.remove("show-menu");
  });
}

/*=============== REMOVE MENU MOBILE ===============*/
const navLink = document.querySelectorAll(".nav__link");

const linkAction = () => {
  const navMenu = document.getElementById("nav-menu");
  // When we click on each nav__link, we remove the show-menu class
  navMenu.classList.remove("show-menu");
};
navLink.forEach((n) => n.addEventListener("click", linkAction));

/*=============== SHOW SCROLL UP ===============*/
const scrollUp = () => {
  const scrollUp = document.getElementById("scroll-up");
  // When the scroll is higher than 350 viewport height, add the show-scroll class to the a tag with the scrollup class
  this.scrollY >= 350
    ? scrollUp.classList.add("show-scroll")
    : scrollUp.classList.remove("show-scroll");
};
window.addEventListener("scroll", scrollUp);

/*=============== MODALS ===============*/
/* Movie Modal */
const modal = document.querySelector(".modal");
const overlay = document.querySelector(".overlay");
const openModalBtn = document.querySelector(".btn-openModal");
const closeModalBtn = document.querySelector(".btn-close");
const closeModalBtn2 = document.querySelector(".btn-close2");

const openModal = function () {
  modal.classList.remove("hidden");
  overlay.classList.remove("hidden");
};
if (openModalBtn) {
  openModalBtn.addEventListener("click", openModal);
}

const closeModal = function () {
  modal.classList.add("hidden");
  overlay.classList.add("hidden");
};

if (closeModalBtn) {
  closeModalBtn.addEventListener("click", closeModal);
}
if (closeModalBtn2) {
  closeModalBtn2.addEventListener("click", closeModal);
}

if (overlay) {
  overlay.addEventListener("click", closeModal);
}

/* Register/Login Modal*/
const modal2 = document.querySelector(".modal2");
const overlay2 = document.querySelector(".overlay2");
const openModalBtn2 = document.querySelector(".btn-openModal2");
const closeModalBtn3 = document.querySelector(".btn-close3");

const openLogModal = function () {
  modal2.classList.remove("hidden");
  overlay2.classList.remove("hidden");
};

if (openModalBtn2) {
  openModalBtn2.addEventListener("click", openLogModal);
}

const closeModal2 = function () {
  modal2.classList.add("hidden");
  overlay2.classList.add("hidden");
};

if (closeModalBtn3) {
  closeModalBtn3.addEventListener("click", closeModal2);
}

if (overlay2) {
  overlay2.addEventListener("click", closeModal2);
}

/*=============== SEE MORE description/BIOGRAPHY ===============*/
const description = document.querySelector("#description");
const readMoreBtn = document.querySelector("#read-more-btn");
const readLessBtn = document.querySelector("#read-less-btn");

description.style.overflow = "hidden";
description.style.height = "4em";
description.style.textOverflow = "ellipsis";
readLessBtn.style.display = "none";

if (readMoreBtn) {
  readMoreBtn.addEventListener("click", () => {
    description.style.height = "auto";
    readMoreBtn.style.display = "none";
    readLessBtn.style.display = "flex";
  });
}

if (readLessBtn) {
  readLessBtn.addEventListener("click", () => {
    description.style.height = "4em";
    readLessBtn.style.display = "none";
    readMoreBtn.style.display = "flex";
  });
}
