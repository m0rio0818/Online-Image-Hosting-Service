const deleteBtn = document.getElementById("delete_btn")
deleteBtn.addEventListener("click", () => {

    const confirmDialog = document.getElementById("confirm_dialog");
    confirmDialog.innerHTML = `
    <dialog class="p-3 jello-horizontal">
        <div class="relative flex items-center flex-col justify-center w-full bg-white py-20">
            <h1 class="text-2xl font-bold">Confirm !</h1>
            <h4 class="text-base text-center font-medium p-2">本当に削除しますがよろしいでしょうか？<br>
            削除すると元に戻せません。</h4>
            <div class="flex justify-center mx-auto py-2">
                <button id="delete_No"  class="mx-1 py-2 px-6 bg-gray-300 hover:bg-gray-500 text-white font-bold rounded-lg">Cancel</button>
                <button id="delete_Yes" class="mx-1 py-2 px-6 bg-sky-500 hover:bg-sky-700 text-white font-bold rounded-lg">Yes</button>
            </div>
        </div>
    </dialog>`

    const dialog = document.querySelector("dialog");
    dialog.showModal();

    const deleteNo = document.getElementById("delete_No");
    deleteNo.addEventListener("click", () => {
        console.log("削除しません");
        dialog.close("animalNotChosen");
    })


    const delete_Yes = document.getElementById("delete_Yes");
    delete_Yes.addEventListener("click", () => {
        const path = new URL(location.href).pathname;
        const parts = path.split("/");
        const deleteURL = parts[parts.indexOf("delete") + 1];

        const jsonData = {
            deleteURL: deleteURL,
        }

        const formData = new FormData();
        formData.append("data", JSON.stringify(jsonData));

        const requestPath = "delete";
        fetch(requestPath, {
            method: "POST",
            body: formData
        })
            .then(response => {
                return response.json();
            })
            .then(data => {
                if (data["status"]) {
                    dialog.innerHTML = `
                    <div class="relative flex items-center flex-col justify-center w-full bg-white p-10">
                        <div class="py-2">
                            <h1 class='text-center text-2xl font-bold wobble-hor-bottom '>画像データを削除しました。</h1>
                        </div>
                        <div class="py-2">
                            <button id="close" class="py-2 px-6 bg-sky-300 hover:bg-sky-500 text-white font-bold rounded-lg">Back to Top</button>
                        </div>    
                    </div>
                    `;

                    const close = document.getElementById("close");
                    close.addEventListener("click", () => {
                        window.location.href = "/";
                    })
                }
            })
    })



})