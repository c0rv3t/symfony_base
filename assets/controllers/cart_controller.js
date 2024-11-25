import { Controller } from 'stimulus';

export default class extends Controller {
    static targets = ["total", "icon", "quantity"];

    initialize() {
        this.cart = JSON.parse(localStorage.getItem('cart')) || [];
        this.updateCart();
    }

    addToCart(event) {
        event.preventDefault();
        const productId = event.target.dataset.productId;
        const productName = event.target.dataset.productName;
        const productPrice = parseFloat(event.target.dataset.productPrice);

        const existingProduct = this.cart.find(item => item.id === productId);

        if (existingProduct) {
            existingProduct.quantity += 1;
        } else {
            this.cart.push({
                id: productId,
                name: productName,
                price: productPrice,
                quantity: 1
            });
        }

        localStorage.setItem('cart', JSON.stringify(this.cart));

        this.updateCart();
    }

    removeFromCart(event) {
        event.preventDefault();
        const productId = event.target.dataset.productId;

        this.cart = this.cart.filter(item => item.id !== productId);

        localStorage.setItem('cart', JSON.stringify(this.cart));

        this.updateCart();
    }

    updateCart() {
        let total = 0;
        let itemCount = 0;
        this.cart.forEach(item => {
            total += item.price * item.quantity;
            itemCount += item.quantity;
        });

        this.totalTarget.innerHTML = `${total.toFixed(2)} €`;
        this.iconTarget.innerHTML = itemCount;
    }
}