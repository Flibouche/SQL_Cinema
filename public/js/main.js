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

/*=============== DELETE ITEM ===============*/
const btn = document.querySelector("#delete-button");

btn.addEventListener("click", function checker(event) {
  var result = confirm("Are you sure you want to delete this item ?");
  if (result == false) {
    event.preventDefault();
  }
});

const castingBtn = document.querySelectorAll(".delete-casting");

castingBtn.addEventListener("click", function checker(event) {
  var result = confirm("Are you sure you want to delete this item ?");
  if (result == false) {
    event.preventDefault();
  }
});

/*=============== SEE MORE SYNOPSIS/DESCRIPTION ===============*/
const synopsis = document.querySelector('#synopsis');
const readMoreBtn = document.querySelector('#read-more-btn');
const readLessBtn = document.querySelector('#read-less-btn');

synopsis.style.overflow = 'hidden'; 
synopsis.style.height = '2em';
synopsis.style.textOverflow = 'ellipsis';
readLessBtn.style.display = 'none';

readMoreBtn.addEventListener('click', () => {
  synopsis.style.height = 'auto';
  readMoreBtn.style.display = 'none';
  readLessBtn.style.display = 'flex'; 
});

readLessBtn.addEventListener('click', () => {
  synopsis.style.height = '2em';
  readLessBtn.style.display = 'none';
  readMoreBtn.style.display = 'flex';
});