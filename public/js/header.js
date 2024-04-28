// グレー消す => 緑を加えたい
function addHighLight(target, a_target) {
    target.classList.remove("hover:border-gray-400");
    target.classList.add("border-green-500");

    a_target.classList.remove("text-gray-500", "hover:text-black");
    a_target.classList.add("text-green-500");
}

// 緑消す => グレーを加えたい
function removeHighlight(target, a_target) {
    target.classList.remove("border-green-500");
    target.classList.add("hover:border-gray-400");

    a_target.classList.remove("text-green-500");
    a_target.classList.add("text-gray-500", "hover:text-black");
}


function checkHeader() {
    const currentUrl = window.location.href;
    const createSnippet = document.getElementById("create_Snippet");
    const a_createSnippet = document.getElementById("create_Snippet").querySelector("a");
    const snippetList = document.getElementById("snippet_List");
    const a_snippetList = document.getElementById("snippet_List").querySelector("a");;

    if (currentUrl.includes("snippet/")) {
        removeHighlight(createSnippet, a_createSnippet);
        removeHighlight(snippetList, a_snippetList);
    } else if (currentUrl.includes("snippet_List")) {
        removeHighlight(createSnippet, a_createSnippet);
        removeHighlight(snippetList, a_snippetList);
        addHighLight(snippetList, a_snippetList);
    } else {
        removeHighlight(createSnippet, a_createSnippet);
        removeHighlight(snippetList, a_snippetList);
        addHighLight(createSnippet, a_createSnippet);
    }
}

document.addEventListener("DOMContentLoaded", function () {
    checkHeader();
});