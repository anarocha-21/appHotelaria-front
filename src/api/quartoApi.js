export async function addRoom(contentForm){
    const formData = new FormData(contentForm);
    const imputFotos = ['image/jpeg', 'image/png'];
    const inputFotos = contentForm.querrySelector('#formFileMultple');

    const imgs = inputFotos.files;
    for(let i = 0; i < imgs.length; i++);{
        if(!typeAccept.includes(imgs[i].type)){
            throw new Error(`Tipo de arquivo não suportado. Selecione um arquivo png ou jprg.`);
        }
    }
    const url = `api/quarto`;
    const response = await fetch(url, {
        method: "POST",
        body: formData 
    });
    if(!response.ok){
        throw new Error(`Erro ao enviar requisição: ${response.status}`);
    }
    const result = await response.json();
    return result;
}


/* Listar os quartos disponíveis de acordo com inicio, fim e qtd */
export async function listAvailableRoomsRequest({ chegada, saida, qtd }) {
    const params = new URLSearchParams();
    if (chegada) params.set("chegada", chegada);
    if (saida) params.set("saida", saida);
    if (qtd !== null && qtd !== "") params.set("qtd", String(qtd));

    const url = `api/quartos/disponiveis?${params.toString()}`;
    const response = await fetch(url, {
        method: "GET",
        headers: {
            "Accept": "application/json",
        },
        credentials: "same-origin"
    });
    let data = null;
    try {
        data = await response.json();
    }
    catch {
        data = null;
    }
    if (!response.ok) {
        const msg = data?.message || "Falha ao buscar quartos disponíveis!";
        throw new Error(msg);
    }
    const quartos = Array.isArray(data?.Quartos) ? data.Quartos : [];
    console.log(quartos);
    return quartos;
}