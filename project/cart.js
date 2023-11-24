const products = [
    {
        id: 0,
        image: './image/img1.webp',
        title: 'Product 1',
        price: 120,
    },
    {
        id: 1,
        image: './image/img2.webp"',
        title: 'Product 2',
        price: 60,
    },
    {
        id: 2,
        image: './image/img3.webp',
        title: 'Product 3',
        price: 200,
    },
    {
        id: 3,
        image: 'image/img4',
        title: 'Product 4',
        price: 300,
    },
];

const categories = [...new Set(products.map((item) => item.title))];

let i = 0;
document.getElementById('root').innerHTML = products.map((item) => {
    var { image, title, price } = item;
    return `
        <div class='box'>
            <div class='img-box'>
                <img class='images' src="${image}" alt="${title}"></img>
            </div>
            <div class='bottom'>
                <p>${title}</p>
                <h2>$ ${price}.00</h2>
                <button onclick="addToCart(${item.id})">Add to cart</button>
            </div>
        </div>`;
}).join('');

var cart = [];

function addToCart(a) {
    cart.push(products[a]);
    displayCart();
}

function delElement(a){
    cart.splice(a,1);
    displayCart();
}
function displayCart(a){
    let j = 0;
    total = 0;

    document.getElementById('count').innerHTML = cart.length;
    document.getElementById('total').innerHTML = "$ "+0+".00";

    if (cart.length == 0) {
        document.getElementById('cartItem').innerHTML = "Your cart is empty";
    } else {
        document.getElementById("cartItem").innerHTML = cart.map((item) => {
            var { image, title, price } = item;
            total = total+price;
            document.getElementById('total').innerHTML = "$ "+total+".00";
            return `
                <div class='cart-item'>
                    <div class='row-img'>
                        <img class='rowing' src='${image}'>
                    </div>
                    <p style='font-size:12px'>${title}</p>
                    <h2 style='font-size:15px'>$ ${price}.00</h2>
                    <i class='fas fa-trash' onclick='delElement(${j++})'></i>
                </div>`;
        }).join('');
    }
}
