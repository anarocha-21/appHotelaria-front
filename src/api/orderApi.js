export async function finishedOrder(metodoPagamento, reservas) {
    const url = "api/orders/reservation";
    const body = {
       
        cliente_id: 1,

        pagamento: metodoPagamento,
        quartos: reservas.map(item => (
            {
                id: item.id,
                chegada: item.checkin,
                saida: item.checkout
            }
        ))
    };

    const token = getToken?.();
    const res = await fetch(url, {
        method: "POST",
        headers: {
            "Accept": "application/json",
            "Content-Type": "application/json",
            "Authorization": `Bearer ${token}`
        },
        credentials: "same-origin",
        body: JSON.stringify(body)
    });
    let data = null;
    try {
        //retorno em json() da requisição armazenado em data
        data = await res.json();
    }
    catch { 
        data = null; 
    }
    if (!data) {
        const message = `erro ao enviar pedido: ${res.status}`;
        return {ok: false, raw: data, message}; }
    return {
        ok: true,
        raw: data
    }
}