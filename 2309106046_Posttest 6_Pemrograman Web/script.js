let sideBar = document.getElementById("sideBar")
let root = document.documentElement
let button = document.getElementById("toggleMode")
let icon = document.getElementById("toggleicon")
let modal = document.getElementById("modal")

document.getElementById("hamburgerMenu").addEventListener("click", function(event){
    event.stopPropagation()
    sideBar.classList.add("active")
})

window.addEventListener("click", function(){
    if(sideBar.classList.contains("active")){
        sideBar.classList.remove("active")
    }
})

button.addEventListener("click", function(){
    root.classList.toggle("dark")
    if(root.classList.contains("dark")){
        icon.src = "asset/sun.png"
        icon.alt = "sun"
    } else{
        icon.src = "asset/moon.png"
        icon.alt = "moon"
    }
})

window.addEventListener("click", function(){
    modal.classList.add("hidden")
})


