const formAdd = document.getElementById('addForm');
const formFilter = document.getElementById('filter');
var name = partial = index = 0;
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
        fetch(`${baseurl}clientes/${id}`, {
            method: "GET",
            credentials: 'same-origin',
            headers: {
                'Accept': 'application/json',
                'Content-Type': 'application/json'
            }
        }).then(response => {
            response.json().then(json => {
                json = json.message[0];
                document.getElementById('name').value = json.name;
                document.getElementById('phone').value = json.phone;
                document.getElementById('country').value = json.country;
                document.getElementById('city').value = json.city;
                document.getElementById('city').value = json.city;
                document.getElementById('email').value = json.email;
                document.getElementById('active').value = json.active;
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
    if (formData.sender.trim() == '') {
        errors.push('<b> Remetente</b>');
        ids.push('sender');
    } else {
        greens.push('sender')
    }
    if (formData.destiny.trim() == '') {
        errors.push('<b> Conta Destino</b>');
        ids.push('destiny');
    } else {
        greens.push('destiny')
    }
    if (formData.valueReal.trim() == '') {
        errors.push('<b> Valor em Real</b>');
        ids.push('valueReal');
    } else {
        greens.push('valueReal')
    }
    if (formData.price.trim() == '') {
        errors.push('<b> Cotação</b>');
        ids.push('price');
    } else {
        greens.push('price')
    }
    if (formData.valuePeso.trim() == '') {
        errors.push('<b> Valor em Peso</b>');
        ids.push('valuePeso');
    } else {
        greens.push('valuePeso')
    }
    if (formData.code.trim() == '') {
        errors.push('<b> Código</b>');
        ids.push('code');
    } else {
        greens.push('code')
    }
    if (formData.date.trim() == '') {
        errors.push('<b> Date</b>');
        ids.push('date');
    } else {
        greens.push('date')
    }
    var today = new Date();
    var matches = /^(\d{2})[-\/](\d{2})[-\/](\d{4})$/.exec(formData.date);
    var date = new Date(`${matches[2]}/${matches[1]}/${matches[3]}`);
    if (formData.date.trim() != '' && date > today) {
        showNotify('danger', 'A Data deve ser anterior a data atual!', 2000);
        $('#date').addClass('is-invalid');
        return false;
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
    fetch(`${baseurl}entradas`, {
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
    name = formData.name;
    $("#table tbody").empty();
    generateTable();
});

function resetTable() {
    total = 1;
    partial = index = name = 0;
    $("#table tbody").empty();
    generateTable();
}

function generateLines(client) {

    let actions = '';
    actions += `<i class="fa fa-pencil m-r-10 text-info pointer" title="Editar" onclick="openModal(${client.id})"></i>`;
    actions = `<td class="text-center">${actions} </td>`;

    return `<tr id="line${client.id}" class="middle">
                <td>${client.name}</td>
                <td class="text-center">${client.email}</td>
                <td class="text-center">${client.phone}</td>
                <td class="text-center">${client.country}</td>
                <td class="text-center">${buttonStatus(client.active, client.id, 'clientes')}</td>
                ${actions}
            </tr>`;
}

function generateTable() {
    $('.loaderTable').css('opacity', 1);
    fetch(`${baseurl}clientes/listar/?index=${index}&name=${name}&limit=${limit}`, {
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
            total = json.total;
            if (json.message.length > 0) {
                let options = json.message.map(generateLines);
                $("#table tbody").append(options);
            } else {
                $("#table tbody").append(`<tr><td colspan="8" class="text-center">Nenhum resultado encontrado</td></tr>`);
            }
            if (json.message.length > 0) generatePagination(total, 'tableBody', 'pagination', index, limit);
        });
    });
}

$(document).ready(function () {
    generateTable();
    $("#valueReal").maskMoney({
        prefix: 'R$ ',
        allowNegative: true,
        thousands: '.',
        decimal: ',',
        affixesStay: false
    });
});