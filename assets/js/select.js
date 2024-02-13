
function activateButton(button) {
  // Remove the "active" class from all buttons
  const buttons = document.querySelectorAll('button');
  buttons.forEach(btn => {
      btn.classList.remove('active');
  });

  // Add the "active" class to the clicked button
  button.classList.add('active');
}


//for div1
const orderNowButton = document.getElementById("orderNow");
const hideButton = document.getElementById("hide");
const d1 = document.getElementById("d1");

orderNowButton.addEventListener("click", () => {
    d1.style.display = "block";
});

hideButton.addEventListener("click", () => {
    d1.style.display = "none";
});


//for div2
const orderNowButton1 = document.getElementById("orderNow1");
const hideButton1 = document.getElementById("hide1");
const d2 = document.getElementById("d2");

orderNowButton1.addEventListener("click", () => {
    d2.style.display = "block";
});

hideButton1.addEventListener("click", () => {
    d2.style.display = "none";
});


//for div3
const orderNowButton2 = document.getElementById("orderNow2");
const hideButton2 = document.getElementById("hide2");
const d3 = document.getElementById("d3");

orderNowButton2.addEventListener("click", () => {
    d3.style.display = "block";
});

hideButton2.addEventListener("click", () => {
    d3.style.display = "none";
});


 //for div4
 const orderNowButton3 = document.getElementById("orderNow3");
 const hideButton3= document.getElementById("hide3");
 const d4 = document.getElementById("d4");

 orderNowButton3.addEventListener("click", () => {
     d4.style.display = "block";
 });

 hideButton3.addEventListener("click", () => {
     d4.style.display = "none";
 });