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
    // formSubmmit.addEventListener("submit", (e) => {
    // e.preventDefault()
    uploadImage.addEventListener("click", () => {
        if (fileInuput.files.length > 0) {
            // 公開するかどうか
            const public = document.getElementById("publish");
            // title
            const title = document.getElementById("title");
            const imageFile = fileInuput.files[0];
            console.log(public.checked);
            console.log(title.value);

            const jsonData = {
                public: public.checked,
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
                    console.log('Success:', data);
                })
                .catch(error => {
                    console.error('Error:', error);
                });


        } else {
            window.alert("ファイルを選択してください");
        }
    })
})