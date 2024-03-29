const formAdd = document.getElementById('addForm');
const formFilter = document.getElementById('filter');
var client = start = end = partial = index = 0;
var total = 1;
var limit = 25;

function setValuePeso() {
    let real = $('#valueReal').val();
    let price = $('#price').val();

    real = real.replace('R$', '');
    real = real.replace('.', '');
    real = parseFloat(real.replace(',', '.'));

    price = parseFloat(price.replace(',', '.'));

    let value = real * price;

    $('#valuePeso').val(maskMoneySetPeso(value));
    $('#code').focus();
}

function openModal(id) {
    formAdd.reset();
    $('.form-control').removeClass('is-invalid  is-valid');
    document.getElementById('financialId').value = id;
    // $('#valueReal').val(maskMoneySet('250.5'));
    $('#modal').modal('show');
    if (id > 0) {
        startLoading();
        fetch(`${baseurl}saidas/listar/${id}`, {
            method: "GET",
            credentials: 'same-origin',
            headers: {
                'Accept': 'application/json',
                'Content-Type': 'application/json'
            }
        }).then(response => {
            response.json().then(json => {
                json = json.message[0];
                document.getElementById('client').value = json.client;
                document.getElementById('date').value = json.dateList;
                document.getElementById('description').value = json.description;
                document.getElementById('valuePeso').value = maskMoneySetPeso(json.valuePeso);
                endLoading();
            });
        });
    }
}

function validateForm() {
    $('.form-control').removeClass('is-invalid is-valid');
    let errors = [];
    let ids = [];
    let classes = [];
    let greens = [];
    const formData = formDataToJson('addForm');

    if (formData.client.trim() == '') {
        errors.push('<b> Cliente</b>');
        ids.push('client');
    } else {
        greens.push('client')
    }
    if (formData.valuePeso.trim() == '') {
        errors.push('<b> Valor em Peso</b>');
        ids.push('valuePeso');
    } else {
        greens.push('valuePeso')
    }
    if (formData.date.trim() == '') {
        errors.push('<b> Date</b>');
        ids.push('date');
    } else {
        greens.push('date')
    }
    if (formData.description.trim() == '') {
        errors.push('<b> Descrição</b>');
        ids.push('description');
    } else {
        greens.push('description')
    }
    if (formData.date.trim() != '') {
        var today = new Date();
        var matches = /^(\d{2})[-\/](\d{2})[-\/](\d{4})$/.exec(formData.date);
        var date = new Date(`${matches[2]}/${matches[1]}/${matches[3]}`);
        if (date > today) {
            showNotify('danger', 'A Data deve ser anterior a data atual!', 2000);
            $('#date').addClass('is-invalid');
            return false;
        }
    }
    if (formData.date.trim() != '' && !isValidDate(formData.date)) {
        showNotify('danger', 'Data Inválida!', 1500);
        $('#date').addClass('is-invalid');
        return false;
    }

    for (let i = 0; i < greens.length; i++) {
        $('#' + greens[i]).addClass('is-valid')
    }

    return verifyMessage(errors, ids, classes);
}

formAdd.addEventListener('submit', e => {
    e.preventDefault();
    startLoading();
    if (!validateForm()) {
        endLoading();
        return;
    }
    let formData = formDataToJson('addForm');
    fetch(`${baseurl}saidas`, {
        method: 'POST',
        credentials: 'same-origin',
        headers: {
            'Accept': 'application/json',
            'Content-Type': 'application/json'
        },
        body: JSON.stringify(formData)
    }).then(response => {
        endLoading();
        response.json().then(json => {
            if (response.status === 201) {
                formAdd.reset();
                showNotify('success', json.message, 1500);
                setTimeout(function () {
                    $('#modal').modal('hide');
                    resetTable();
                }, 1500);
            } else {
                if (json.message == 'Código já cadastrado') {
                    $('#code').removeClass('is-invalid');
                    $('#code').addClass('is-invalid');
                }
                showNotify('danger', json.message, 1500);
            }
        });
    });
});

formFilter.addEventListener('submit', e => {
    e.preventDefault();
    let formData = formDataToJson('filter');
    partial = index = 0;
    total = 1;
    client = formData.client;
    start = formData.start;
    end = formData.end;
    $("#table tbody").empty();
    generateTable();
});

function resetTable() {
    total = 1;
    partial = index = client = destiny = code = 0;
    $("#table tbody").empty();
    generateTable();
}

function generateLines(client) {

    let actions = '';
    if (type == 1) {
        actions += `<i class="fa fa-pencil m-r-10 text-info pointer" title="Editar" onclick="openModal(${client.id})"></i>
                    <i class="fa fa-trash m-r-10 text-danger pointer" title="Excluir" onclick="deleteFinancial(${client.id})"></i>`;
        actions = `<td class="text-center">${actions} </td>`;
    }

    return `<tr id="line${client.id}" class="middle">
                <td>${client.name}</td>
                <td class="text-center">${client.dateList}</td>
                <td class="text-center">${maskMoneySetPeso(client.valuePeso)}</td>
                <td class="text-center">${client.description}</td>
                ${actions}
            </tr>`;
}

function deleteFinancial(id) {
    var result = confirm('Você tem certeza que deseja fazer isso?\nSua ação será permanente e você não poderá recuperar os dados excluídos!');
    if (result == true) {
        fetch(`${baseurl}saidas/excluir/${id}`, {
            method: "DELETE",
            credentials: 'same-origin',
            headers: {
                'Accept': 'application/json',
                'Content-Type': 'application/json'
            }
        }).then(response => {
            response.json().then(json => {
                if (response.status === 201) {
                    showNotify('success', json.message, 1500);
                    setTimeout(function () {
                        $('#line' + id).hide(200);
                    }, 1000);
                } else {
                    showNotify('danger', json.message, 1500);
                }
            });
        });
    } else {
        return false;
    }
}

function generateTable() {
    $('.loaderTable').css('opacity', 1);
    fetch(`${baseurl}saidas/listar/?index=${index}&client=${client}&start=${start}&end=${end}&limit=${limit}`, {
        method: "GET",
        credentials: 'same-origin',
        headers: {
            'Accept': 'application/json',
            'Content-Type': 'application/json'
        }
    }).then(response => {
        $('.loaderTable').css('opacity', 0);
        response.json().then(json => {
            $('#total').text(json.total);
            $('#start').text(json.total > 0 ? index * limit + 1 : 0);
            $('#end').text(json.partial);
            if (index == 0) $('#created').html(`<b>${json.created}</b>`)
            total = json.total;
            if (json.message.length > 0) {
                let options = json.message.map(generateLines);
                $("#table tbody").append(options);
            } else {
                if (type == 1) {
                    $("#table tbody").append(`<tr><td colspan="5" class="text-center">Nenhum resultado encontrado</td></tr>`);
                } else {
                    $("#table tbody").append(`<tr><td colspan="4" class="text-center">Nenhum resultado encontrado</td></tr>`);
                }
            }
            if (json.message.length > 0) generatePagination(total, 'tableBody', 'pagination', index, limit);
        });
    });
}

$(document).ready(function () {
    generateTable();
    $("#valuePeso").maskMoney({
        prefix: '$ ',
        allowNegative: true,
        thousands: '.',
        decimal: ',',
        affixesStay: false
    });
});