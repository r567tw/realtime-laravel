require('./bootstrap');

Echo.private("notifications")
    .listen("UserSessionChaged",(e)=>{
        const notificationEl = document.getElementById("notification")
        console.log(e)
        notificationEl.innerText = e.message
        notificationEl.classList.remove("invisible")
        notificationEl.classList.add('alert-'+e.type)
    })








