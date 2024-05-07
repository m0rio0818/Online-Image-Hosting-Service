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
console.log(formSubmmit);

document.addEventListener("DOMContentLoaded", () => {
    uploadImage.addEventListener("click", () => {
        if (fileInuput.files.length > 0) {
            // 公開するかどうか
            const publish = document.getElementById("publish");
            // title
            const title = document.getElementById("title");
            const imageFile = fileInuput.files[0];
            console.log(publish.checked);
            console.log(title.value);

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
                        modalArea.classList.add("overlay", "fixed", "top-0", "left-0", "w-full", "h-screen", "flex", "items-center", "justify-center", "bg-opacity-90", "bg-gray-300")
                        modalArea.innerHTML = `
                        <div class="w-2/3">
                            <div class="relative flex items-center flex-col justify-center w-full bg-white py-20">
                                <div class="absolute top-0 right-1">
                                    <i id="close-btn" class="fa-solid fa-rectangle-xmark hover:text-red-500"></i>
                                </div>
                                <div class="py-2">
                                    <i class="fa-regular fa-circle-check fa-7x" style="color:green;"></i>
                                </div>
                                <h4 class="text-3xl">Image Uploaded!</h4>
                                <div class="flex justify-center mx-auto py-2">
                                    <div>
                                        <i class="fa-solid fa-upload"></i>
                                    </div>
                                    <p style="word-wrap: break-word;">public URL : <br> <a href=${data["create_url"]}> ${data["create_url"]}</a> </p>
                                </div>
                                <div class="py-2">
                                    <div>
                                        <i class="fa-solid fa-trash"></i>
                                    </div>
                                    <p style="overflow-wrap: break-word;">delete URL : <br> <a href=${data["delete_url"]}> ${data["delete_url"]}</a> </p>
                                </div>
                            </div>
                        </div>
                        `
                        const closeBtn = document.getElementById("close-btn");
                        closeBtn.addEventListener("click", () => {
                            window.location.href = "/";
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