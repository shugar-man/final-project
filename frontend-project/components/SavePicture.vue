<template>
    <div>
        <div id="imgPreview">
            <img id="previewImg" class="img-fluid rounded" src="~/assets/img/cat.jpg">

            <div class="items-center justify-center w-full">
                <label class="block">
                <span class="sr-only">Choose profile photo</span>
                <input type="file" @click="loadFile()" accept="image/*" id="fileInput" class="py-5 block w-full text-sm text-slate-500
                file:mr-4 file:py-2 file:px-4
                file:rounded-full file:border-0
                file:text-sm file:font-semibold
                file:bg-violet-50 file:text-violet-700
                hover:file:bg-violet-100"/>
                </label>
            </div>
            <div class="max-w-xl mt-20 mx-auto">
                <div class="w-full px-3">
                    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-password">
                        Description </label>
                    <textarea rows="10" class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"></textarea>
                </div>
                <form action="">
                    <div class="flex justify-between w-full px-3">
                        <button id="post">Post</button>
                    </div>
                </form>
            </div>
        </div>
        
    </div>
</template> 

<style>

#imgPreview{
    justify-items: center;
    width: 550px;
    padding: 3px;
    margin: auto;
    border: 3px solid #73AD21;
}

#post{
    position: relative;
    top: 50%;
    margin-top: 5rem;
    width: 10rem;
    border: 3px solid red;
    -ms-transform: translateY(-50%);
  transform: translateY(-50%);
}
</style>

<script setup lang="ts">

function loadFile(){

const fileInput = document.getElementById("fileInput") as HTMLInputElement;
const previewImage = document.getElementById("previewImg") as HTMLImageElement;
fileInput.addEventListener("change", (event) => {
const selectedFile = fileInput.files?.[0];

if (selectedFile) {
    // Create a URL for the selected file and set it as the image source
    const imageUrl = URL.createObjectURL(selectedFile);
    previewImage.src = imageUrl;
} else {
    // If no file is selected, clear the image source
    previewImage.src = "";
}
});



}

</script>