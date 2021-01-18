const titulo = document.getElementById("titulo");
const patrocinadores = document.getElementById("cash");
const desenvolvedores = document.getElementById("devs");
const gerentes = document.getElementById("gerente");
const clientes = document.getElementById("cliente");
const prazo = document.getElementById("prazo");

function gera() {
    if (titulo.value !== '' && patrocinadores.value !== '' && desenvolvedores.value !== '' && gerentes.value !==
        '' && clientes.value !== '' && prazo.value !== '') {
        var doc = new jsPDF();
        doc.addImage("fundo.png", 'PNG', 0, 0, 210, 297);
        doc.setFontSize(12);
        doc.text(titulo.value, 31, 49);
        doc.text(patrocinadores.value, 31, 68);
        doc.text(desenvolvedores.value.replaceAll(", ", "\n\n"), 73, 90);
        doc.text(gerentes.value, 73, 171);
        doc.text(patrocinadores.value, 73, 185);
        doc.text(clientes.value, 73, 197);
        doc.text(prazo.value, 73, 211);
        doc.save('tap.pdf');
    } else {
        alert("Preencha todos os campos obrigatórios.");
    }
}