export async function finishedOrder(items) {
    const url = "api/orders/reservation";
    const body = {
       
        cliente_id: 1,

        pagamento: "pix",
        quartos: items.map(it => (
            {
                id: it.roomId,
                chegada: it.checkIn,
                saida: it.checkOut
            }
        ))
    };
    const res = await fetch(url, {
        method: "POST",
        headers: {
            "Accept": "application/json",
            "Content-Type": "application/json"
        },
        credentials: "same-origin",
        body: JSON.stringify(body)
    });
    let data = null;
    try {
        //retorno em json() da requisição armazenado em data
        data = await res.json();
    }
    catch { data = null; }
    if (!data) {
        const message = `erro ao enviar pedido: ${res.status}`;
        return {ok: false, raw: data, message}; }
    return {
        ok: true,
        raw: data
    }
}