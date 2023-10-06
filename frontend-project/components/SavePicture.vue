<template>
    <div>
        <div id="imgPreview">
            <img id="previewImg" class="img-fluid rounded" src="/images/img_default.jpg">

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
            <button id="post">Post</button>
        </div>
        
    </div>
</template> 

<style>

#imgPreview{
    justify-items: center;
    width: 350px;
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