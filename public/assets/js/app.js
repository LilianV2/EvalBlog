
let btn = document.getElementById("create-article-btn");
let closeBtn = document.getElementById('close-btn');
let form = document.querySelector(".create-article");

// Display the form when on-click to create an Article

btn.addEventListener("click", function (){
    form.style.display = "flex";
})

closeBtn.addEventListener("click", function (){
    form.style.display = "none";
})

