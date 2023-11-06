import { defineStore } from 'pinia'

export const useCounterStore = defineStore('counter', {
  state: () => {
    return { count: 0 }
  },
  actions: {
    setcounter(like :number ) {
        this.count = like;
    },
    increment() {
      this.count++
    },
    decrement() {
      this.count--
    },
  },
  persist: true
})