const formFilter = document.getElementById('filter');
var client = destiny = start = end = partial = index = balance = 0;
var total = 1;
var limit = 25;

formFilter.addEventListener('submit', e => {
    e.preventDefault();
    let formData = formDataToJson('filter');
    partial = index = 0;
    total = 1;
    client = formData.client;
    destiny = formData.destiny;
    start = formData.start;
    end = formData.end;
    $("#table tbody").empty();
    generateTable();
});

function resetTable() {
    total = 1;
    partial = index = client = destiny = start = end = 0;
    $("#table tbody").empty();
    generateTable();
}

function generateLines(client) {

    let name = '';
    if (type < 3) name = `<td>${client.name}</td>`;
    let description = '';
    if (client.description != null) description = client.description;
    let code = '';
    if (client.code != null) code = client.code;
    let classe = '';
    let pre = '';
    if (client.type == false) {
        classe = 'text-danger';
        pre = '-';
    } else {
        classe = 'text-success';
    }

    let html = `<tr id="line${client.id}" class="middle">
                    ${name}
                    <td class="text-center">${client.dateList}</td>
                    <td class="text-center">${code}</td>
                    <td class="text-center">${description}</td>
                    <td class="text-center ${classe}"><b>${pre}${maskMoneySetPeso(client.valuePeso)}</b></td>
                    <td class="text-center">${maskMoneySetPeso(balance)}</td>
                </tr>`;

    if (client.type == false) {
        balance = parseFloat(balance) + parseFloat(client.valuePeso);
    } else {
        balance = parseFloat(balance) - parseFloat(client.valuePeso);
    }

    return html;
}

function generateTable() {
    if (total > partial) {
        $('.loaderTable').css('opacity', 1);
        fetch(`${baseurl}extratos/listar/?index=${index}&client=${client}&destiny=${destiny}&start=${start}&end=${end}&limit=${limit}`, {
            method: "GET",
            credentials: 'same-origin',
            headers: {
                'Accept': 'application/json',
                'Content-Type': 'application/json'
            }
        }).then(response => {
            $('.loaderTable').css('opacity', 0);
            response.json().then(json => {
                if (index == 0) balance = json.balance
                total = json.total;
                partial = json.partial;
                if (json.message.length > 0) {
                    let options = json.message.map(generateLines);
                    $("#table tbody").append(options);
                } else {
                    if (type == 1) {
                        $("#table tbody").append(`<tr><td colspan="6" class="text-center">Nenhum resultado encontrado</td></tr>`);
                    } else {
                        $("#table tbody").append(`<tr><td colspan="5" class="text-center">Nenhum resultado encontrado</td></tr>`);
                    }
                }
            });
        });
    }
}

$(document).ready(function () {
    generateTable();
    $(window).scroll(function (e) {
        if ($(window).scrollTop() + $(window).height() >= $(document).height() - 1) {
            e.preventDefault();
            e.stopPropagation();
            index++;
            generateTable();
        }
    });
});