const formAdd = document.getElementById('addForm');
const formFilter = document.getElementById('filter');
var name = partial = index = 0;
var total = 1;
var limit = 25;

function openModal(id) {
    formAdd.reset();
    $('.form-control').removeClass('is-invalid  is-valid');
    document.getElementById('clientId').value = id;
    $('#passwordDiv').show();
    $('#modal').modal('show');
    if (id > 0) {
        startLoading();
        $('#passwordDiv').hide();
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

    if (formData.name.trim() == '') {
        errors.push('<b> Nome</b>');
        ids.push('name');
    } else {
        greens.push('name')
    }
    if (formData.phone.trim() == '') {
        errors.push('<b> Telefone</b>');
        ids.push('phone');
    } else {
        greens.push('phone')
    }
    if (formData.country.trim() == '') {
        errors.push('<b> País</b>');
        ids.push('country');
    } else {
        greens.push('country')
    }
    if (formData.city.trim() == '') {
        errors.push('<b> Cidade</b>');
        ids.push('city');
    } else {
        greens.push('city')
    }
    if (formData.email.trim() == '') {
        errors.push('<b> E-mail</b>');
        ids.push('email');
    } else {
        greens.push('email')
    }
    if (formData.clientId == 0) {
        if (formData.password.trim() == '') {
            errors.push('<b> Senha</b>');
            ids.push('password');
        } else {
            greens.push('password')
        }
    }

    if (formData.password.trim() != '' && formData.password.length < 8) {
        showNotify('danger', 'A senha deve ter no mínimo 8 caracteres');
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
    fetch(`${baseurl}clientes`, {
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
                }, 2000);
            } else {
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
    $("#tabe tbody").empty();
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
            $('#totalDanger').text(json.total);
            $('#startDanger').text(json.total > 0 ? index * limit + 1 : 0);
            $('#endDanger').text(json.partial);
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
});