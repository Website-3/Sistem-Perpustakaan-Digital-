window.addEventListener("load", () => {

    const card = document.querySelector(".card");
    const reportBox = document.querySelector(".report-box");

    if(card) card.classList.add("show");

    setTimeout(() => {
        if(reportBox) reportBox.classList.add("show");
    }, 200);

    const form = document.getElementById("reportForm");

    if(form){
        form.addEventListener("submit", async function(e){
            e.preventDefault();

            let formData = new FormData(this);

            try{
                let send = await fetch("send_report.php", {
                    method:"POST",
                    body:formData
                });

                let result = await send.text();

                if(result.trim() === "OK"){
                    const popup = document.getElementById("successPopup");
                    popup.classList.add("show");

                    setTimeout(()=>{
                        popup.classList.remove("show");
                    }, 2200);

                    this.reset();
                }
            }catch(err){
                console.error("Gagal kirim:", err);
            }
        });
    }
});
