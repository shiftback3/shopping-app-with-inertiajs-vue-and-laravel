import { defineStore } from 'pinia'

export const useCartStore = defineStore({
  id: 'cart', // Cart ID
  state: () => ({
    items: [], // Initialize cart to empty array
  }),
  persist: {
    key: 'cart-items', // Local Storage Key for data persistance
  },
  getters: {
    // Get total itmes in the cart
    totalQuantity() {
      return this.items.reduce((total, item) => total + item.quantity, 0)
    },

     // Get total amount of product in the cart
     subTotal() {
      return this.items.reduce((total, item) => total + item.price * item.quantity, 0)
  
    },
  },
  actions: {

    // Add to cart action
    addToCart(product) {
      const existingProduct = this.items.find(item => item.id === product.id)
      if (existingProduct) {
        existingProduct.quantity++
      } else {
        this.items.push({...product, quantity: 1})
      }
    
    },
    // Action to remove single item from the cart
    removeSingleFromCart(product) {
      const index = this.items.findIndex(item => item.id === product.id)
      if (index !== -1) {
        if (this.items[index].quantity === 1) {
          this.items.splice(index, 1)
        } else {
          this.items[index].quantity--
        }
      }
    },
    // action to remove a particular product from the cart
       removeFromCart(product) {
      const index = this.items.findIndex(item => item.id === product.id)
      if (index !== -1) {
        this.items.splice(index, 1)
      }
    },
    // Clear or Empty cart
    clearCart() {
      this.items = []
    },
  },
})
