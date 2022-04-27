var index = partial = name = email = active = type = 0;
var total = 1;
var limit = 25;

function openModal(id) {
    $('.form-control').removeClass('is-invalid is-valid');
    document.getElementById('passwordDiv').style.display = 'block';
    document.getElementById('activeDiv').style.display = 'block';
    document.getElementById('addForm').reset();
    document.getElementById('userId').value = id;
    $('#modal').modal('show');
    if (id > 0) {
        document.getElementById('passwordDiv').style.display = 'none';
        document.getElementById('activeDiv').style.display = 'none';
        startLoading();
        if (id > 0) {
            $('#loaderTop').show();
            fetch(`${baseurl}usuarios/listar/${id}`, {
                method: "GET",
                credentials: 'same-origin',
                headers: {
                    'Accept': 'application/json',
                    'Content-Type': 'application/json'
                }
            }).then(response => {
                response.json().then(json => {
                    json = json.message[0];
                    document.getElementById('email').value = json.email;
                    document.getElementById('type').value = json.type;
                    document.getElementById('name').value = json.name;
                    endLoading();
                });
            });
        }
    }
}

const formAdd = document.getElementById('addForm');
formAdd.addEventListener('submit', e => {
    e.preventDefault();
    startLoading();
    if (!validateForm()) {
        endLoading();
        return;
    }
    let formData = formDataToJson('addForm');
    fetch(`${baseurl}usuarios`, {
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
                showNotify('success', json.message, 2000);
                setTimeout(function () {
                    $('#modal').modal('hide');
                    resetTable();
                }, 1000)
            } else {
                showNotify('danger', json.message, 2000);
            }
        });
    });
});

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
    if (formData.email.trim() == '') {
        errors.push('<b> E-mail</b>');
        ids.push('email');
    } else {
        greens.push('email')
    }
    if (formData.type < 0) {
        errors.push('<b> Tipo</b>');
        ids.push('type');
    } else {
        greens.push('type')
    }
    if (formData.userId == 0) {
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

const form = document.getElementById('filter');

form.addEventListener('submit', e => {
    e.preventDefault();
    let formData = formDataToJson('filter');
    partial = 0;
    index = 0;
    total = 1;
    active = formData.active;
    name = formData.name;
    email = formData.email;
    type = formData.type;
    $("#table tbody").empty();
    generateTable();
});

function resetTable() {
    index = partial = name = email = active = type = 0;
    total = 1;
    $("#table tbody").empty();
    generateTable();
}

function generateLines(user) {
    let actions = '';
    actions += `<i class="fa fa-pencil text-info" title="Editar" onclick="openModal(${user.id})"></i> `;
    actions = `<td class="text-center">${actions} </td>`;
    return `<tr class="middle">
                    <td>${user.name}</td>
                    <td class="text-center">${typeStr(user.type)}</td>
                    <td class="text-center">${user.email}</td>
                     <td class="text-center">${buttonStatus(user.active, user.id, 'usuarios')}</td>
                    ${actions}
                </tr>`;
}

function typeStr(type) {
    if (type == 1) {
        return 'Admin';
    } else {
        return 'Convencional';
    }
}

function generateTable() {
    $('.loaderTable').css('opacity', 1);
    fetch(`${baseurl}usuarios/listar/?index=${index}&name=${name}&email=${email}&type=${type}&active=${active}&limit=${limit}`, {
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
                $("#table tbody").append(`<tr><td colspan="5" class="text-center">Nenhum resultado encontrado</td></tr>`);
            }
            if (json.message.length > 0) generatePagination(total, 'tableBody', 'pagination', index, limit);
        });
    });
}

$(document).ready(function () {
    generateTable();
});