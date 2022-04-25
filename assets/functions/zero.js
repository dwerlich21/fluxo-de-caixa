const formAdd = document.getElementById('addEquipament');
const formFilter = document.getElementById('filter');
var name = partial = index = equipament = ges = 0;
var total = 1;
var orderBy = 'id';
var seqBy = 'desc';
var selectEnvironment = selectGes = selectGesFilter = selectDanger = selectDangerFilter = selectProcess = '';
var limit = 25;

function openModal(id) {
    formAdd.reset();
    $('.form-control').removeClass('is-invalid  is-valid');
    document.getElementById('equipamentId').value = 0;
    $('#modal').modal('show');
    if (id > 0) {
        startLoading();
        fetch(`${baseurl}equipamentos/${id}`, {
            method: "GET",
            credentials: 'same-origin',
            headers: {
                'Accept': 'application/json',
                'Content-Type': 'application/json'
            }
        }).then(response => {
            response.json().then(json => {
                json = json.message[0];
                document.getElementById('equipamentId').value = json.id;
                document.getElementById('activity').value = json.activity;
                document.getElementById('frequency').value = json.frequency;
                document.getElementById('post').value = json.post;
                document.getElementById('prevention').value = json.prevention;
                document.getElementById('source').value = json.source;
                endLoading();
            });
        });
    }
}

function validateFormDanger() {
    $('.form-control').removeClass('is-invalid is-valid');
    let errors = [];
    let ids = [];
    let radios = [];
    let classes = [];
    let greens = [];
    const formData = formDataToJson('addEquipament');

    if (formData.environment.trim() == '') {
        errors.push('<b> Ambiente</b>');
        classes.push('environment');
    } else {
        greens.push('environment')
    }


    for (let i = 0; i < greens.length; i++) {
        $('#' + greens[i]).addClass('is-valid')
    }

    return verifyMessage(errors, ids, radios, classes);
}

formAdd.addEventListener('submit', e => {
    e.preventDefault();
    startLoading();
    if (!validateFormDanger()) {
        endLoading();
        return;
    }
    let formData = formDataToJson('addEquipament');
    fetch(`${baseurl}equipamentos`, {
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
            if (response.status === 200) {
                formAdd.reset();
                showNotify('success', json.message, 1500);
                setTimeout(function () {
                    $('#modal').modal('hide');
                    resetTable();
                }, 2000);
            } else {
                showNotify('equipament', json.message, 1500);
            }
        });
    });
});

formFilter.addEventListener('submit', e => {
    e.preventDefault();
    let formData = formDataToJson('filter');
    partial = index = 0;
    total = 1;
    equipament = formData.equipament;
    ges = formData.ges;
    $("#equipamentTable tbody").empty();
    generateTable();
});

function delDanger(id) {
    fetch(`${baseurl}equipamentos/excluir/${id}`, {
        method: 'DELETE',
        credentials: 'same-origin',
        headers: {
            'Accept': 'application/json',
            'Content-Type': 'application/json'
        }
    }).then(response => {
        response.json().then(json => {
            if (response.status === 200) {
                showNotify('success', json.message, 2000);
                $('#line' + id).hide(200);
                total = parseInt(total) - 1;
                partial = parseInt(partial) - 1;
                $('#total').text(total);
                $('#partial').text(partial);
            } else {
                showNotify('equipament', json.message, 2000);
            }
        });
    });
}

function resetTable() {
    total = 1;
    partial = index = name = equipament = ges = 0;
    $("#equipamentTable tbody").empty();
    generateTable();
}

function generateDangerTable(equipament) {

    let actions = '';
    actions += `<i class="fa fa-pencil m-r-10 text-info pointer" title="Editar" onclick="openModal(${equipament.id})"></i>
                <i class="fa fa-trash text-equipament pointer" title="Excluir" onclick="delDanger(${equipament.id})"></i> <br>
                <a href="${baseurl}equipamentos/avaliar/${equipament.id}" class="text-center"><div class="badge badge-primary label-square m-t-5 pointer">
                 <span class="f-14">Avaliar</span>
            </div></a>`;
    actions = `<td class="text-center">${actions} </td>`;

    let ges = '';
    for (let i = 0; i < equipament.ges.length; i++) {
        ges += `${equipament.ges[i]};<br>`;
    }
    return `<tr id="line${equipament.id}" class="middle">
                <td class="text-center">${equipament.equipament}</td>
                <td class="text-center">${equipament.process}</td>
                <td class="text-center">${equipament.environment}</td>
                <td class="text-center">${equipament.prevention}</td>
                ${actions}
            </tr>`;
}

function generateTable() {
    $('.loaderTable').css('opacity', 1);
    fetch(`${baseurl}equipamentos/listar/?index=${index}&name=${name}&equipament=${equipament}&ges=${ges}&order=${orderBy}&seq=${seqBy}&limit=${limit}`, {
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
                let options = json.message.map(generateDangerTable);
                $("#equipamentTable tbody").append(options);
            } else {
                $("#equipamentTable tbody").append(`<tr><td colspan="8" class="text-center">Nenhum resultado encontrado</td></tr>`);
            }
            if (json.message.length > 0) generatePagination(total, 'equipamentTableBody', 'paginationDanger', index, limit);
        });
    });
}

$(document).ready(function () {
    generateTable();
});