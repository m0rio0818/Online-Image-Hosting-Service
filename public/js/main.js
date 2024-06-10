const uploadImage = document.getElementById("upload_image");
const fileInuput = document.getElementById("file_input");

fileInuput.addEventListener("change", (e) => {
    const files = e.target.files;
    if (files) {
        const figureImage = document.querySelector('#figureImage')
        const file = files[0];
        figureImage.setAttribute('src', URL.createObjectURL(file))
        // figure.style.display = "block";
    } else {
        // figure.style.display = "none";
    }
})

const formSubmmit = document.getElementById("Form");

document.addEventListener("DOMContentLoaded", () => {

    uploadImage.addEventListener("click", () => {
        if (fileInuput.files.length > 0) {
            // 公開するかどうか
            const publish = document.getElementById("publish");
            // title
            const title = document.getElementById("title");
            const imageFile = fileInuput.files[0];

            const jsonData = {
                publish: publish.checked,
                title: title.value,
            }

            const formData = new FormData();
            formData.append("image", imageFile)
            formData.append("data", JSON.stringify(jsonData));

            const requestPath = "/";
            fetch(requestPath, {
                method: "POST",
                body: formData,
            })
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Network response was not ok');
                    }
                    return response.json();
                })
                .then(data => {
                    if (data["status"] == "alert") {
                        window.alert(data["message"])
                    }
                    else if (data["status"]) {
                        const modalArea = document.getElementById("modal-area");
                        modalArea.innerHTML = `
                            <dialog class="p-3 scale-in-top">
                                <div class="relative flex items-center flex-col justify-center w-full bg-white py-20">
                                    <div class="absolute top-0 right-1">
                                        <i id="close-btn" class="fa-solid fa-rectangle-xmark hover:text-red-500"></i>
                                    </div>
                                    <div class="my-4">
                                        <i class="fa-regular fa-circle-check fa-7x text-green-500"></i>
                                    </div>
                                    <h4 class="text-4xl py-1 font-bold ">Image Uploaded!</h4>
                                    <div class="flex justify-center mx-auto py-2">
                                        <p class="truncate text-center"><i class="px-1 fa-solid fa-upload"></i> Public URL : <br> 
                                        <a href=${data["create_url"]} class=" text-sky-400 hover:text-sky-600 hover:underline"> ${data["create_url"]}</a>
                                        </p>
                                    </div>
                                    <div class="flex justify-center mx-auto py-2">
                                        <p class="text-center"><i class="px-1 fa-solid fa-trash"></i> Delete URL : <br>
                                        <a href=${data["delete_url"]} class="text-sky-400 hover:text-sky-600 hover:underline"> ${data["delete_url"]}</a> </p>
                                    </div>
                                </div>
                            </dialog>
                        `;

                        const dialog = document.querySelector("dialog");
                        dialog.showModal();

                        const closeBtn = document.getElementById("close-btn");
                        closeBtn.addEventListener("click", () => {
                            dialog.close("animalNotChosen");
                        })
                    }

                })
            // .catch(error => {
            //     console.error('Error:', error);
            // });
        } else {
            window.alert("ファイルを選択してください");
        }
    })
})