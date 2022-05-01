var index = partial = name = email = type = 0;
var total = 1;
var limit = 25;

function openModal(id) {
    $('.form-control').removeClass('is-invalid is-valid');
    document.getElementById('addForm').reset();
    document.getElementById('accountId').value = id;
    $('#modal').modal('show');
    if (id > 0) {
        startLoading();
        fetch(`${baseurl}contas/listar/${id}`, {
            method: "GET",
            credentials: 'same-origin',
            headers: {
                'Accept': 'application/json',
                'Content-Type': 'application/json'
            }
        }).then(response => {
            response.json().then(json => {
                json = json.message[0];
                document.getElementById('active').value = json.active;
                document.getElementById('name').value = json.name;
                endLoading();
            });
        });
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
    fetch(`${baseurl}contas`, {
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
        errors.push('<b> Conta</b>');
        ids.push('name');
    } else {
        greens.push('name')
    }

    for (let i = 0; i < greens.length; i++) {
        $('#' + greens[i]).addClass('is-valid')
    }

    return verifyMessage(errors, ids, classes);
}

function resetTable() {
    index = partial = name = email = type = 0;
    total = 1;
    $("#table tbody").empty();
    generateTable();
}

function generateLines(account) {
    let actions = '';
    actions += `<i class="fa fa-pencil text-info pointer" title="Editar" onclick="openModal(${account.id})"></i> `;
    actions = `<td class="text-center">${actions} </td>`;
    return `<tr class="middle">
                    <td>${account.name}</td>
                     <td class="text-center">${buttonStatus(account.active, account.id, 'contas')}</td>
                    ${actions}
                </tr>`;
}

function generateTable() {
    $('.loaderTable').css('opacity', 1);
    fetch(`${baseurl}contas/listar/?index=${index}&name=${name}&email=${email}&type=${type}&limit=${limit}`, {
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
                $("#table tbody").append(`<tr><td colspan="3" class="text-center">Nenhum resultado encontrado</td></tr>`);
            }
            if (json.message.length > 0) generatePagination(total, 'tableBody', 'pagination', index, limit);
        });
    });
}

$(document).ready(function () {
    generateTable();
});