<template>
    <div class="flex h-screen bg-gray-700">
      <div class="w-full max-w-xs m-auto bg-red-900 rounded p-5">
        <header>
          <img class="w-20 mx-auto mb-5" src="/image/logo.jpg" />
        </header>
        <form>
          <div>
            <label class="block mb-2 text-red-500" for="username">Username</label>
            <input class="w-full p-2 mb-6 text-red-700 border-b-2 border-red-500 outline-none focus:bg-gray-300" type="text" name="username">
          </div>
          <div>
            <label class="block mb-2 text-red-500" for="password">Password</label>
            <input class="w-full p-2 mb-6 text-red-700 border-b-2 border-red-500 outline-none focus:bg-gray-300" type="password" name="password">
          </div>
          <div>
            <input class="w-full bg-red-700 hover:bg-black text-white font-bold py-2 px-4 mb-6 rounded" type="submit">
          </div>
        </form>
        <footer>
          <a class="text-red-500 hover:text-black text-sm float-left" href="#">Forgot Password?</a>
          <a class="text-red-500 hover:text-black text-sm float-right" href="#">Create Account</a>
        </footer>
      </div>
    </div>
</template>
  