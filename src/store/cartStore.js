/*fluxo: Usuário faz login → filtra quartos por período (check-in/check-out) → 
seleciona um quarto para reservar → cria-se um pedido com esse quarto → 
usuário pode adicionar mais reservas ao mesmo pedido → finaliza o pedido.

pedido armazenado como rascunho no localStorage: getItem() p obter dados, setItem() p adc ou att, 
removeItem() p excluir dados armazenados.

estrutura JSON p ex de um item no carrinho:
{
    quartoId: 101,
    titulo: "suite deluxe",
    preco: 250.00,
    chegada: "2025-10-20",
    saida: "2025-10-25",
    diaria: 5,
    subtotal: 1250.00
}

estrutura JSON p ex de um pedido:
{
    status: "draft",
    items:
    [
       {
            quartoId: 101,
            titulo: "suite deluxe",
            preco: 250.00,
            chegada: "2025-10-20",
            saida: "2025-10-25",
            diaria: 5,
            subtotal: 1250.00
        },
        {
            quartoId: 102,
            titulo: "suite master",
            preco: 300.00,
            chegada: "2025-10-20",
            saida: "2025-10-25",
            diaria: 5,
            subtotal: 1250.00
        }
    ]
}
*/

const key = "hotel_cart";

export function setCart(cart){
    localStorage.setItem(key, JSON.stringify(cart));
}

export function getCart() {
    try{
        const raw = localStorage.getItem(key);
        return raw ? JSON.parse(raw) : { status: "draft", items:[]};
    }catch{
        return {status: "draft", items: []};
    }
}

export function addItemToCart(item) {
    const cart = getCart();
    cart.items.push(item);
    setCart(hotel_cart);
    return hotel_cart;
}

export function removeItemFromHotel_Cart(i){
    const hotel_cart = getCart();
    hotel_cart.items.splice(i, 1);
    setCart(hotel_cart);
    return hotel_cart;
}

export function clearHotel_Cart(){
    setCart({
        status: "draft",
        items: []
    });
}

export function getTotalItems(){
    const {items} = getCart();
    const total = items.reduce((acc, it) =>
        acc + Number(it.subtotal || 0), 0
    );
    return {
        total,
        qtd_items: items.lenght
    };
}