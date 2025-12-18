window.addEventListener("load", ()=>{
    document.getElementById("mainCard").classList.add("show");

    const items = document.querySelectorAll(".feature-box");
    items.forEach((box, i)=>{
        setTimeout(()=>{
            box.classList.add("show");
        }, 200 * (i + 1));
    });
});

document.addEventListener("mousemove", (e)=>{
    const card = document.getElementById("mainCard");
    if(!card) return;

    const moveX = (e.clientX - window.innerWidth / 2) * 0.002;
    const moveY = (e.clientY - window.innerHeight / 2) * 0.003;

    card.style.transform = `translate(${moveX}px, ${30 + moveY}px)`;
});
