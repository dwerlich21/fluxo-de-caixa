const formAddCompany = document.getElementById('addCompany');

function validateFormCompany() {
    $('.form-control').removeClass('is-invalid is-valid');
    let errors = [];
    let ids = [];
    let radios = [];
    let classes = [];
    let greens = [];
    const formData = formDataToJson('addCompany');

    if (formData.cnpj.trim() == '') {
        errors.push('<b> CNPJ</b>');
        ids.push('cnpj');
    } else {
        greens.push('cnpj')
    }
    if (formData.name.trim() == '') {
        errors.push('<b> Razão Social</b>');
        ids.push('nameEdit');
    }else {
        greens.push('nameEdit')
    }
    if (formData.socialReason.trim() == '') {
        errors.push('<b> Nome Fantasia</b>');
        ids.push('socialReason');
    }else {
        greens.push('socialReason')
    }
    if (formData.cnae.trim() == '') {
        errors.push('<b> CNAE</b>');
        ids.push('cnae');
    }else {
        greens.push('cnae')
    }
    if (formData.zipCode.trim() == '') {
        errors.push('<b> CEP</b>');
        ids.push('zipCode');
    }else {
        greens.push('zipCode')
    }
    if (formData.state.trim() == '') {
        errors.push('<b> Estado</b>');
        ids.push('state');
    }else {
        greens.push('state')
    }

    if (formData.city.trim() == '') {
        errors.push('<b> Cidade</b>');
        ids.push('city');
    }else {
        greens.push('city')
    }
    if (formData.neighborhood.trim() == '') {
        errors.push('<b> Bairro</b>');
        ids.push('neighborhood');
    }else {
        greens.push('neighborhood')
    }
    if (formData.address.trim() == '') {
        errors.push('<b> Logradouro</b>');
        ids.push('address');
    }else {
        greens.push('address')
    }
    if (formData.number.trim() == '') {
        errors.push('<b> Número</b>');
        ids.push('number');
    }else {
        greens.push('number')
    }
    if (formData.numbersOfWorkers.trim() == '') {
        errors.push('<b> Qtd. Trabalhadores</b>');
        ids.push('numbersOfWorkers');
    }else {
        greens.push('numbersOfWorkers')
    }
    if (formData.phone.trim() == '') {
        errors.push('<b> Telefone</b>');
        ids.push('phone');
    }else {
        greens.push('phone')
    }
    if (formData.email.trim() == '') {
        errors.push('<b> E-mail</b>');
        ids.push('email');
    }else {
        greens.push('email')
    }
    if (formData.representative.trim() == '') {
        errors.push('<b> Representante</b>');
        ids.push('representative');
    }else {
        greens.push('representative')
    }
    if (formData.representativePosition.trim() == '') {
        errors.push('<b> Cargo Representante Legal</b>');
        ids.push('representativePosition');
    }else {
        greens.push('representativePosition')
    }

    for (let i = 0; i < greens.length; i++) {
        $('#' + greens[i]).addClass('is-valid')
    }

    return verifyMessage(errors, ids, radios, classes);
}

formAddCompany.addEventListener('submit', e => {
    e.preventDefault();
    startLoading();
    if (!validateFormCompany()) {
       endLoading();
        return;
    }
    let method = 'POST';
    let formData = formDataToJson('addCompany');
    fetch(`${baseurl}empresa/registrar`, {
        method: method,
        credentials: 'same-origin',
        headers: {
            'Accept': 'application/json',
        },
        body: new FormData(formAddCompany)
    }).then(response => {
        endLoading();
        response.json().then(json => {
            if (response.status === 200) {
                showNotify('success', json.message, 2000);
                formAddCompany.reset();
                setTimeout(function () {
                    window.location.href = baseurl + 'empresa';
                }, 2000);
            } else {
                showNotify('danger', json.message, 2000);
            }
        });
    });
})
;

$(document).ready(function () {
    $("#cnpj").keyup(function () {
        loadData();
    });
    inputFile();
});

var cnpj = 0;
function loadData() {
    var newCnpj = $('#cnpj').val().replace(/\D/g, '');
    if (cnpj != newCnpj && newCnpj.length == 14 && validateCpfCnpj(newCnpj) == true) {
        $('#cnpj').attr('readonly', true);
        $.getJSON(`https://www.sintegraws.com.br/api/v1/execute-api.php?token=DBD6189A-6779-47D4-A15D-C93BFA7FDC79&cnpj=${newCnpj}&plugin=RF`, function (dados) {
            if (dados.code == 0) {
                $('#cnae').val(dados.atividade_principal[0].code);
                $('#description').val(dados.atividade_principal[0].text);
                $('#socialReason').val(dados.fantasia);
                $('#nameEdit').val(dados.nome);
                $('#zipCode').val(dados.cep);
                $('#state').val(dados.uf);
                $('#city').val(dados.municipio);
                $('#neighborhood').val(dados.bairro);
                $('#address').val(dados.logradouro);
                $('#number').val(dados.numero);
                $('#complement').val(dados.complemento);
                $('#postage').val(dados.porte.toLowerCase().capitalize());
                $('#situation').val(dados.situacao.toLowerCase().capitalize());
                $('#typeCompany').val(dados.tipo.toLowerCase().capitalize());
                let secundaria = dados.atividades_secundarias;
                let texto = '';
                for (i = 0; i < secundaria.length; i++) {
                    texto += `${secundaria[i].code} - ${secundaria[i].text}\n`;
                    $('.modal-body').append(
                        `
                        <input type="hidden" name="cnaeSecondary[]" value="${secundaria[i].code}">
                        `
                    )
                }
                $('textarea#sesmt').text(texto);
            } else {
                showNotify('danger', dados.message, 2000);
            }
        });
        cnpj = newCnpj;
        setTimeout(function () {
            $('#cnpj').attr('readonly', false)
        }, 500)
    }
    if (newCnpj.length == 14 && validateCpfCnpj(newCnpj) == false) {
        divMessage.textContent = 'CNPJ Inválido!';
        showNotify('danger', 'CNPJ Inválido!', 2000);
    }
}

String.prototype.capitalize = function() {
    return this.charAt(0).toUpperCase() + this.substr(1);
};