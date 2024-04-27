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

/*=============== DELETE MODAL ===============*/
/* Movie Modal */
const modalMovie = document.querySelector(".modal-movie");
const overlay = document.querySelector(".overlay");
const openModalMovieBtn = document.querySelector(".btn-openModalMovie");
const closeModalBtn = document.querySelector(".btn-close");
const closeModalBtn2 = document.querySelector(".btn-close2");

const openModalMovie = function () {
  modalMovie.classList.remove("hidden");
  overlay.classList.remove("hidden");
};

// openModalMovieBtn.addEventListener("click", openModalMovie);

const closeModalMovie = function () {
  modalMovie.classList.add("hidden");
  overlay.classList.add("hidden");
};

closeModalBtn.addEventListener("click", closeModalMovie);
closeModalBtn2.addEventListener("click", closeModalMovie);

overlay.addEventListener("click", closeModalMovie);

/*=============== SEE MORE SYNOPSIS/DESCRIPTION ===============*/
const synopsis = document.querySelector("#synopsis");
const readMoreBtn = document.querySelector("#read-more-btn");
const readLessBtn = document.querySelector("#read-less-btn");

synopsis.style.overflow = "hidden";
synopsis.style.height = "4em";
synopsis.style.textOverflow = "ellipsis";
readLessBtn.style.display = "none";

readMoreBtn.addEventListener("click", () => {
  synopsis.style.height = "auto";
  readMoreBtn.style.display = "none";
  readLessBtn.style.display = "flex";
});

readLessBtn.addEventListener("click", () => {
  synopsis.style.height = "4em";
  readLessBtn.style.display = "none";
  readMoreBtn.style.display = "flex";
});
