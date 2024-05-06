const publicImages = document.getElementById("public_images");

const mimeType = {
    "png": "png",
    "jpg": "jpeg",
    "gif": "gif"
}

publicImages.addEventListener('click', function (event) {
    if (event.target.tagName === 'IMG') {
        // 画像のハッシュ値を取得する
        const imgSrc = event.target.src.split("/");
        const hashString = imgSrc[imgSrc.length - 1];
        const indexOfDot = hashString.indexOf(".");
        const parsehashString = hashString.substring(0, indexOfDot);
        const mime = mimeType[hashString.substring(indexOfDot + 1, hashString.length)];

        window.location.href = "/" + mime + "/" + parsehashString;
    }
});