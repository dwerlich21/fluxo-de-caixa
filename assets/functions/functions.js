function showNotify(type, message, delay) {
    let returnMessage = '';
    if (type == 'danger') {
        returnMessage = "<b><i class='fa fa-exclamation-triangle mr-2'></i></b> " + message;
    } else if (type == 'success') {
        returnMessage = "<b><i class='fa fa-check-circle mr-2'></i></b> " + message;
    }
    return $.notify({
        message: returnMessage,
    }, {
        type: type,
        allow_dismiss: false,
        placement: {
            from: "bottom",
            align: "center"
        },
        delay: delay,
        animate: {
            enter: 'animated fadeInDown',
            exit: 'animated fadeOutDown'
        },
    });
}

function formDataToJson(id) {
    var $form = $(`#${id}`);
    var unindexed_array = $form.serializeArray();
    var indexed_array = {};

    $.map(unindexed_array, function (n) {
        if (n['name'].indexOf("[]") != -1) {// é um multiselect
            let field = n['name'].replace("[]", "");
            if (indexed_array[field] == undefined) {
                indexed_array[field] = [];
            }
            indexed_array[field].push(n['value']);
        } else {
            indexed_array[n['name']] = n['value'];
        }
    });
    return indexed_array;
}

function setModalMaxHeight(element) {
    this.$element = $(element);
    this.$content = this.$element.find('.modal-content');
    var borderWidth = this.$content.outerHeight() - this.$content.innerHeight();
    var dialogMargin = $(window).width() < 768 ? 20 : 60;
    var contentHeight = $(window).height() - (dialogMargin + borderWidth);
    var headerHeight = this.$element.find('.modal-header').outerHeight() || 0;
    var footerHeight = this.$element.find('.modal-footer').outerHeight() || 0;
    var maxHeight = contentHeight - (headerHeight + footerHeight);

    this.$content.css({
        'overflow': 'hidden'
    });

    this.$element
        .find('.modal-body').css({
        'max-height': maxHeight,
        'overflow-y': 'auto'
    });
}

$('.modal').on('show.bs.modal', function () {
    $(this).show();
    setModalMaxHeight(this);
});

$(window).resize(function () {
    if ($('.modal.in').length != 0) {
        setModalMaxHeight($('.modal.in'));
    }
});

function removeDiv(id) {
    var campo = $("#" + id);
    campo.hide(200);
    document.getElementById(id).remove();
}

function maskCnpj(cnpj) {
    return cnpj.replace(/^(\d{2})(\d{3})(\d{3})(\d{4})(\d{2})/, "$1.$2.$3/$4-$5");
}

function maskPhone(phone, id) {

    let teste = document.getElementById(id).value;
    let caracter = teste.replace(/\D/gim, '');
    let tamanho = caracter.length;

    if (tamanho <= 10) {
        caracter = caracter.replace(/(\d{2})(\d)/, "($1) $2");
        caracter = caracter.replace(/(\d{4})(\d)/, "$1-$2");
        return document.getElementById(id).value = caracter
    } else {
        caracter = caracter.replace(/(\d{2})(\d)/, "($1) $2");
        caracter = caracter.replace(/(\d{5})(\d)/, "$1-$2");
        return document.getElementById(id).value = caracter.substring(0, 15)
    }
}

function validateCpfCnpj(val) {
    var cpf = val.trim();
    cpf = cpf.replace(/\./g, '');
    cpf = cpf.replace('-', '');
    cpf = cpf.replace('/', '');

    if (cpf.length == 11) {

        cpf = cpf.split('');

        var v1 = 0;
        var v2 = 0;
        var aux = false;

        for (var i = 1; cpf.length > i; i++) {
            if (cpf[i - 1] != cpf[i]) {
                aux = true;
            }
        }

        if (aux == false) {
            return false;
        }

        for (var i = 0, p = 10;
             (cpf.length - 2) > i; i++, p--) {
            v1 += cpf[i] * p;
        }

        v1 = ((v1 * 10) % 11);

        if (v1 == 10) {
            v1 = 0;
        }

        if (v1 != cpf[9]) {
            return false;
        }

        for (var i = 0, p = 11;
             (cpf.length - 1) > i; i++, p--) {
            v2 += cpf[i] * p;
        }

        v2 = ((v2 * 10) % 11);

        if (v2 == 10) {
            v2 = 0;
        }

        if (v2 != cpf[10]) {
            return false;
        } else {
            return true;
        }
    } else if (cpf.length == 14) {
        var cnpj = val.trim();

        cnpj = cnpj.replace(/\./g, '');
        cnpj = cnpj.replace('-', '');
        cnpj = cnpj.replace('/', '');
        cnpj = cnpj.split('');

        var v1 = 0;
        var v2 = 0;
        var aux = false;

        for (var i = 1; cnpj.length > i; i++) {
            if (cnpj[i - 1] != cnpj[i]) {
                aux = true;
            }
        }

        if (aux == false) {
            return false;
        }

        for (var i = 0, p1 = 5, p2 = 13;
             (cnpj.length - 2) > i; i++, p1--, p2--) {
            if (p1 >= 2) {
                v1 += cnpj[i] * p1;
            } else {
                v1 += cnpj[i] * p2;
            }
        }

        v1 = (v1 % 11);

        if (v1 < 2) {
            v1 = 0;
        } else {
            v1 = (11 - v1);
        }

        if (v1 != cnpj[12]) {
            return false;
        }

        for (var i = 0, p1 = 6, p2 = 14;
             (cnpj.length - 1) > i; i++, p1--, p2--) {
            if (p1 >= 2) {
                v2 += cnpj[i] * p1;
            } else {
                v2 += cnpj[i] * p2;
            }
        }

        v2 = (v2 % 11);

        if (v2 < 2) {
            v2 = 0;
        } else {
            v2 = (11 - v2);
        }

        if (v2 != cnpj[13]) {
            return false;
        } else {
            return true;
        }
    } else {
        return false;
    }
}

function verifyMessage(errors, ids, classes) {

    if (errors.length > 0) {
        let message = '';
        if (errors.length == 1) message = 'O campo';
        if (errors.length > 1) message = 'Os campos';

        for (i = 0; i < errors.length; i++) {
            message += errors[i];
            if (i == errors.length - 2) message += ' e';
            if (i < errors.length - 2) message += ',';
        }

        if (errors.length == 1) message += ' é obrigatório!';
        if (errors.length > 1) message += ' são obrigatórios!';

        for (i = 0; i < ids.length; i++) {
            $('#' + ids[i]).addClass('is-invalid');
        }
        for (i = 0; i < classes.length; i++) {
            $('.' + classes[i]).addClass('is-invalid');
        }
        showNotify('danger', message, 4000);
        return false;
    }
    return true;
}

function addClass(value, id) {
    if (value > 0) {
        return document.getElementById(id).classList.add('password');
    } else {
        return document.getElementById(id).classList.remove('password');
    }
}

function message() {
    showNotify('danger', 'Você deve responder todas as questões solicitadas!', 4000);
}

function newOrder(order, seq, hide, show) {
    orderBy = order;
    seqBy = seq;
    $('#' + hide).hide();
    $('#' + show).show();
    index = 0;
    resetTable();
}

function startLoading() {
    $('.loaderTop').show();
    $('.form-group').css('opacity', .2);
    $('.btn').attr('disabled', true);
}

function endLoading() {
    setTimeout(function () {
        $('.loaderTop').hide();
        $('.form-group').css('opacity', 1);
        $('.btn').attr('disabled', false);
    }, 500)
}

function delElement(route, id) {
    fetch(`${baseurl}${route}/excluir/${id}`, {
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

function generatePagination(total, body, id, indexPag, limitPag) {
    let div = Math.ceil(total / limitPag);

    $('#' + id).empty();
    if ((total / limitPag) <= 5) {
        let disabled = '';
        if (indexPag == 0) disabled = 'disabled';
        let buttons = `<li class="page-item ${disabled} pointer" onclick="addIndex('previous', ${div}, ${body})"><a class="page-link">Anterior</a></li>`;
        for (let i = 1; i <= div; i++) {
            let classe = '';
            if ((i - 1) == indexPag) classe = 'active';
            buttons += `<li class="page-item ${classe} pointer" onclick="addIndex(${i - 1}, ${div}, ${body})"><a class="page-link">${i}</a></li>`;
        }
        disabled = '';
        if (indexPag + 1 == div) disabled = 'disabled';
        buttons += `<li class="page-item pointer ${disabled}" onclick="addIndex('next', ${div}, ${body})"><a class="page-link">Próximo</a></li>`;
        $('#' + id).append(buttons);
    } else if ((total / limitPag) > 5) {
        let disabled = '';
        if (indexPag == 0) disabled = 'disabled';
        let buttons = `<li class="page-item ${disabled} pointer" onclick="addIndex('previous', ${div}, ${body})"><a class="page-link">Anterior</a></li>`;

        if (indexPag >= 3) buttons += `<li class="page-item"><a class="page-link">...</a></li>`;

        if (indexPag < 3) {
            for (let i = 1; i <= 5; i++) {
                let classe = '';
                if ((i - 1) == indexPag) classe = 'active';
                buttons += `<li class="page-item ${classe} pointer" onclick="addIndex(${i - 1}, ${div}, ${body})"><a class="page-link">${i}</a></li>`;
            }
        } else if (indexPag >= 3 && indexPag < (div - 2)) {
            for (let i = indexPag - 1; i <= indexPag + 3; i++) {
                let classe = '';
                if ((i - 1) == indexPag) classe = 'active';
                buttons += `<li class="page-item ${classe} pointer" onclick="addIndex(${i - 1}, ${div}, ${body})"><a class="page-link">${i}</a></li>`;
            }
        } else if (indexPag >= (div - 2)) {
            for (let i = div - 5; i <= Math.ceil(total / 1); i++) {
                let classe = '';
                if ((i - 1) == indexPag) classe = 'active';
                buttons += `<li class="page-item ${classe} pointer" onclick="addIndex(${i - 1}, ${div}, ${body})"><a class="page-link">${i}</a></li>`;
            }
        }

        if (indexPag < (Math.ceil(total / 1) - 3)) buttons += `<li class="page-item"><a class="page-link">...</a></li>`;

        if (indexPag + 1 == div) disabled = 'disabled';
        buttons += `<li class="page-item pointer ${disabled}" onclick="addIndex('next', ${div}, ${body})"><a class="page-link">Próximo</a></li>`;
        $('#' + id).append(buttons);
    }
}

function addIndex(value, div, body) {
    if (value == 'next') {
        if (index + 1 == div) return false;
        index++;
    } else if (value == 'previous') {
        if (index == 0) return false;
        index--;
    } else {
        index = value;
    }
    $('#' + body).empty();
    generateTable();
}

function getLimit(value, body) {
    limit = value;
    index = 0;
    $('#' + body).empty();
    generateTable();
}

function inputFile() {
    $('input:file').change(function (e) {
        let input = e.target;
        if (input.files.length > 0) {
            input.parentElement.classList.remove('btn-primary');
            input.parentElement.classList.remove('btn-danger');
            input.parentElement.classList.add('btn-success');
            input.text = input.value;
            let string = input.value.replace('fakepath', '');

            let labelId = input.getAttribute('id') + 'Label';
            document.getElementById(labelId).textContent = string.slice(4);
        } else {
            input.parentElement.classList.remove('btn-success');
            input.parentElement.classList.add('btn-danger');
            let labelId = input.getAttribute('id') + 'Label';
            document.getElementById(labelId).textContent = document.getElementById(labelId).getAttribute('default');
        }
    });
}

function isValidDate(date) {
    var matches = /^(\d{2})[-\/](\d{2})[-\/](\d{4})$/.exec(date);
    if (matches == null) return false;
    var d = matches[1];
    var m = matches[2];
    var y = matches[3];

    if (m > 12 || ((m == 1 || m == 3 || m == 5 || m == 7 || m == 8 || m == 10 || m == 12) && d > 31)
        || ((m == 4 || m == 6 || m == 9 || m == 11) && d > 30)
        || (m == 2 && (y % 4 == 0) && d > 29)
        || (m == 2 && (y % 4 != 0) && d > 28)) {
        return false;
    } else {
        return true;
    }
}

function buttonStatus(status, id, route) {
    if (status == 1) {
        return `
            <div class="badge badge-primary label-square pointer" onclick="changeStatus(${id}, 0, '${route}')">
               <span class="f-14">Ativo</span>
            </div>
            `;
    } else if (status == 0) {
        return `
            <div class="badge badge-danger label-square pointer" onclick="changeStatus(${id}, 1, '${route}')">
               <span class="f-14">Inativo</span>
            </div>
            `;
    }
}

function changeStatus(id, status, route) {
    fetch(`${baseurl}${route}/novo-status/?id=${id}&status=${status}`, {
        method: 'GET',
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
                    resetTable();
                }, 1000)
            } else {
                showNotify('danger', json.message, 1500);
            }
        });
    });
}

function maskMoneySet(value) {
    var money = parseFloat(value);
    money = money.toLocaleString('pt-br', {style: 'currency', currency: 'BRL'});
    return money;
}

function maskMoneySetPeso(value) {
    var money = parseFloat(value);
    money = money.toLocaleString('es-AR', {style: 'currency', currency: 'ARS'});
    return money;
}