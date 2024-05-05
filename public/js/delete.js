const deleteBtn = document.getElementById("delete_btn")
deleteBtn.addEventListener("click", () => {

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
            console.log(data);
        })

})