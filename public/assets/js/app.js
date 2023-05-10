
btn = document.getElementById("create-article-btn");
closeBtn = document.getElementById('close-btn');
form = document.querySelector(".create-article");

btn.addEventListener("click", function (){
    form.style.display = "flex";
})

closeBtn.addEventListener("click", function (){
    form.style.display = "none";
})